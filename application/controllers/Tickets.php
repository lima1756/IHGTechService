<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tickets extends CI_Controller
{
    public function index($id="")
    {
        if($this->logdata->getType() == "mortal")
        {
            if($id!="")
            {
                $this->load->view("mortal/tickets", ["idTicket" => $id]);
            }
            else
            {
                $this->load->view("mortal/tickets");
            }
        }
        else
        {
            header("Location: /");
        }
    }

    public function newTicket()
    {
        $idSU = 0;
        $idMortal = 0;
        if(isset($_POST['usuario']))
        {
            $idMortal = $_POST['usuario'];
        }
        else
        {
            $idMortal = $this->logdata->getData("id");
        }
        if(isset($_POST['SUid'])){
            $idSU = $_POST['SUid'];
        }
        else
        {
            $idSU = $this->toWho();
        }
        $message = $_POST['descripcionForm'];
        $dom = new \DomDocument();
        $dom->loadHtml(mb_convert_encoding($message, "HTML-ENTITIES", "UTF-8"), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);    
        $images = $dom->getElementsByTagName('img');
       // foreach <img> in the submited message
        foreach($images as $img){
            $src = $img->getAttribute('src');
            
            // if the img source is 'data-url'
            if(preg_match('/data:image/', $src)){                
                // get the mimetype
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimetype = $groups['mime'];                
                // Generating a random filename
                $filename = uniqid();
                $filepath = "/img/foro/$filename.$mimetype";    
              
                $new_src = $filepath;
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);



                $ifp = fopen("." . $filepath, "x+"); 

                $data = explode(',', $src);

                fwrite($ifp, base64_decode($data[1])); 
                fclose($ifp); 

            } // <!--endif
        } // <!-
        $message = $dom->saveHTML();
        
        $insert = array(
            "id_mortal" => $idMortal,
            "pregunta" => $_POST['preguntaForm'],
            "descripcion" => $message
        );
        $this->db->insert('tickets', $insert);
        $ticketId = $this->db->insert_id();

        $insert = array(
            "id_SU" => $idSU,
            "id_ticket" => $ticketId,
            "porcentaje" => 0
        );
        $this->db->insert('ticket_sus', $insert);
        $ticketSUId = $this->db->insert_id();

        $insert = array(
            "estado" => "Nuevo"
        );
        $this->db->insert('estados', $insert);
        $estadoId = $this->db->insert_id();

        $insert = array(
            "id_ticketSU" => $ticketSUId,
            "id_estado" => $estadoId
        );
        $this->db->insert('ticketsu_tiene_estado', $insert);


        $originalNames=$_FILES['files']['name'];
        $files = $_FILES;
        $count = count($_FILES['files']['name']);
        
        for($i=0; $i<$count; $i++)
        {
            if(!empty($files['files']['name'][$i]))
            {
                $rand = md5(uniqid(rand(),true));
                $_FILES['files']['name']= $files['files']['name'][$i];
                $_FILES['files']['type']= $files['files']['type'][$i];
                $_FILES['files']['tmp_name']= $files['files']['tmp_name'][$i];
                $_FILES['files']['error']= $files['files']['error'][$i];
                $_FILES['files']['size']= $files['files']['size'][$i];    

                $format=explode('.',$files['files']['name'][$i]);
                $format=end($format);

                $config['upload_path']          = './fileUploads/tickets';
                $config['allowed_types']        = 'log|txt|doc|docx|xlsx|ini|rar|zip';
                $config['max_size']             = 10000000;
                $config['file_name']            = $rand.'.'.$format;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);     
                if($this->upload->do_upload('files'))
                {
                    $insert = array(
                        "nombreOriginal" => $originalNames[$i],
                        "extension" => $format,
                        "nombreAlmacenado" => $this->upload->data()['file_name']
                    );
                    $this->db->insert('files', $insert);
                    $fileID = $this->db->insert_id();
                    $insert = array(
                        "id_ticket" => $ticketId,
                        "id_file" => $fileID
                    );
                    $this->db->insert('files_tickets', $insert);
                }
                else
                {
                }
            }
        }
        header('Location: /dashboard/tickets/'. $ticketId);
    }

    private function toWho()
    {
        $SUs = $this->db->query("SELECT id_usuario FROM superusers");
        $SUs = $SUs->result();
        $points = array();
        foreach($SUs as $SU){
            $points[$SU->id_usuario]=0;
            $tasks = $this->db->query("SELECT prioridad, COUNT('prioridad') AS count FROM ticket_sus WHERE id_SU = " . $SU->id_usuario . " GROUP BY prioridad");
            $tasks = $tasks->result();
            foreach($tasks as $task){
                if($task->prioridad=="bajo"){
                    $points[$SU->id_usuario]=$points[$SU->id_usuario] + ($task->count * 1);
                }
                elseif($task->prioridad=="medio"){
                    $points[$SU->id_usuario]=$points[$SU->id_usuario] + ($task->count * 2);
                }
                elseif($task->prioridad=="alto"){
                    $points[$SU->id_usuario]=$points[$SU->id_usuario] + ($task->count * 4);
                }
                elseif($task->prioridad == NULL){                   
                    $points[$SU->id_usuario]=$points[$SU->id_usuario] + ($task->count * 4);
                }
            }
        }
        $min=99999999;
        foreach($points as $point){
            if($point<$min){
                $min=$point;
            }
        }
        
        $myKey=0;
        foreach($points as $key => $point)
        {
            if($point==$min){
                $myKey=$key;
            }
        }
        return $myKey;
    }
}