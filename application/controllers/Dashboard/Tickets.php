<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tickets extends CI_Controller
{
    public function index($state = "")
    {
        if($this->logdata->getType() == "SU")
        {
            if($state == "")
            {
                $this->load->view('SU/tickets', ['state'=>"all"]);
            }
            else
            {
                $this->load->view('SU/tickets', ['state'=>$state]);
            }
        }
        else
        {
            header("Location: /");
        }
    }

    public function usuario($id)
    {
        if($this->logdata->getType() == "SU")
        {
            $this->load->view('SU/tickets', ["id" => $id, 'state'=>""]);
        }
        else
        {
            header("Location: /");
        }
    }

    public function delete($id)
    {
        $this->db->where('id_ticket', $id);
        $this->db->delete('tickets');
        header('Location: /dashboard/tickets/');
    }

    public function update()
    {
        var_dump($_POST);
        if(isset($_POST['prioridad']))
        {
            $update = array(
                "porcentaje" => $_POST['porcentaje'],
                "prioridad" => $_POST['prioridad']
            );
            $this->db->where('id_ticket', $_POST['ticket_su']);
            $this->db->update('tickets', $update);
        }
        $message = $_POST['detalles'];
        if($message != "")
        {
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
                    $filepath = "/img/estados/$filename.$mimetype";    
                
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
        }
        $insert = array(
            "estado" => $_POST['estado_actual'],
            "detalles" => $message
        );
        $this->db->insert('estados', $insert);
        $estadoID = $this->db->insert_id();

        $insert = array(
            "id_estado" => $estadoID,
            "id_ticketSU" => $_POST['ticket_su']
        );
        $this->db->insert('ticketsu_tiene_estado', $insert);
        
        $checking = count($this->db->query('SELECT * FROM tech_service.ticket_tiene_tema WHERE id_ticketSU = '.$_POST['ticket_su'])->result())>0;
            
        if(isset($_POST['SubTema']) && is_numeric($_POST['SubTema']))
        {
            
            $insert = array(
                "id_ticketSU" => $_POST['ticket_su'],
                "idTema" => $_POST['SubTema']
            );
            if($checking):
                $this->db->where('id_ticketSU', $_POST['ticket_su']);
                $this->db->update('ticket_tiene_tema', $insert);
            else:
                $this->db->insert('ticket_tiene_tema', $insert);
            endif;
            
        }
        else
        {
            $insert = array(
                "nombre" => (isset($_POST['SubTema'])?$_POST['SubTema']:""),
                "id_tema" => $_POST['TemaTicket']
            );
            
            $this->db->insert('sub_temas_ticket', $insert);
            $temaId = $this->db->insert_id();

            $insert = array(
                "id_ticketSU" => $_POST['ticket_su'],
                "idTema" => $temaId
            );
            if($checking):
                $this->db->where('id_ticketSU', $_POST['ticket_su']);
                $this->db->update('ticket_tiene_tema', $insert);
            else:
                $this->db->insert('ticket_tiene_tema', $insert);
            endif;
            
        }
        
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

                $config['upload_path']          = './fileUploads/estados';
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
                        "id_estado" => $estadoID,
                        "id_file" => $fileID
                    );
                    $this->db->insert('files_estados', $insert);
                }
                else
                {
                }
            }
        }
        header('Location: /dashboard/tickets/'. $_POST['id_ticket']);
    }
}