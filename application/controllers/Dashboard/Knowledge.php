<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Knowledge extends CI_Controller
{
    public function index()
    {
        if($this->logdata->getType() == "SU")
        {
            $this->load->view('SU/knowledge');
        }
        else
        {
            header("Location: /");
        }
    }

    public function submit()
    {
        $message = $_POST['contenido'];
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
                $filepath = "/img/knowledge/$filename.$mimetype";    
              
                $new_src = $filepath;
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);



                $ifp = fopen("." . $filepath, "x+"); 

                $data = explode(',', $src);

                fwrite($ifp, base64_decode($data[1])); 
                fclose($ifp); 

            } 
        } 
        $message = $dom->saveHTML();


        if($_POST['id']!=""){
            if($_POST['select_tema']=="null"){
                $this->db->replace('knowledge', ['id' => $_POST['id'], 'titulo' => $_POST['Titulo'], 'contenido' => $message, 'tema' => $_POST['input_tema']]);
            }
            else{
                $this->db->replace('knowledge', ['id' => $_POST['id'], 'titulo' => $_POST['Titulo'], 'contenido' => $message, 'tema' => $_POST['select_tema']]);    
            }
        }
        else{
            if($_POST['select_tema']=="null"){
                $this->db->insert('knowledge', ['titulo' => $_POST['Titulo'], 'contenido' => $message, 'tema' => $_POST['input_tema'], 'id_superuser' => $this->logdata->getdata("id")]);
            }
            else{
                $this->db->insert('knowledge', ['titulo' => $_POST['Titulo'], 'contenido' => $message, 'tema' => $_POST['select_tema'], 'id_superuser' => $this->logdata->getdata("id")]);
            }
            $_POST['id'] = $this->db->insert_id();
        }
        if(isset($_POST['adjuntos']))
        {
            foreach($_POST['adjuntos'] as $a)
            $adjunt = $this->db->query("SELECT * FROM files WHERE id_file = ". $a);
            $adjunt = $adjunt->result();
            if(unlink("./fileUploads/knowledge/".$adjunt[0]->nombreAlmacenado))
            {
                echo "Logrado";
            }
            else
            {
                echo "NO";
            }
            $this->db->delete('files_knowledge', array('id_file' => $a));
            $this->db->delete('files', array('id_file' => $a));
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

                $config['upload_path']          = './fileUploads/knowledge';
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
                        "id_knowledge" => $_POST['id'],
                        "id_file" => $fileID
                    );
                    $this->db->insert('files_knowledge', $insert);
                }
                else
                {
                }
            }
        }
        header('Location: /dashboard/knowledge');
    }

    public function drop()
    {
        if(isset($_POST['id'])){
            $this->db->delete('knowledge', array('id' => $_POST['id']));
            $files = $this->db->query("SELECT files.* FROM files INNER JOIN files_knowledge ON files.id_file = files_knowledge.id_file");
            $files = $files->result();
            foreach($files as $f)
            {
                if(unlink("./fileUploads/knowledge/".$f->nombreAlmacenado))
                {
                    echo "Logrado";
                }
                else
                {
                    echo "NO";
                }
                $this->db->delete('files', array('id_file' => $f->id_file));
                $this->db->delete('files_knowledge', array('id_file' => $f->id_file));
            }
            
            
        }
      header('Location: /dashboard/knowledge');
    }
}