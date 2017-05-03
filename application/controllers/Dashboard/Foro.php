<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Foro extends CI_Controller
{
    public function index()
    {
        if($this->logdata->getType() == "SU")
        {
            $this->load->library('pagination');
            //obtener solo las que se mostraran
            $this->db->order_by('fecha_hora', 'DESC');
            $this->db->where('id_nota IS NULL', null, false);
            $entradas = $this->db->get("foro", "10", $this->uri->segment(3));
            $data['foro'] = $entradas->result();
            
            //obtener el total
            $this->db->where('id_nota IS NULL', null, false);
            $total = $this->db->get("foro");

            $config['base_url'] = '/dashboard/foro';
            $config['total_rows'] = $total->num_rows();
            $config['per_page'] = 10;

            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';

            $config['first_tag_open'] = '<li>';
            $config['last_tag_open'] = '<li>';

            $config['next_tag_open'] = '<li>';
            $config['prev_tag_open'] = '<li>';

            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';

            $config['first_tag_close'] = '</li>';
            $config['last_tag_close'] = '</li>';

            $config['next_tag_close'] = '</li>';
            $config['prev_tag_close'] = '</li>';

            $config['cur_tag_open'] = '<li class="active"><span><b>';
            $config['cur_tag_close'] = '</b></span></li>';

            $this->pagination->initialize($config);
            
            $this->load->view("SU/foro", $data);
        }
        else
        {
            header("Location: /");
        }
    }

    public function tema($id)
    {
        if($this->logdata->getType() == "SU")
        {
            $this->load->view('SU/tema', ['id' => $id]);
        }
        else
        {
            header("Location: /");
        }
    }

    public function nuevo()
    {
        $message = $_POST['comentario'];
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
            "id_ticket_su" => $_POST['id_ticket_su'],
            "id_SU" => $this->logdata->getData("id"),
            "Titulo" => $_POST['titulo'],
            "mensaje" => $message
        );
        $this->db->insert('foro', $insert);
        $foroID = $this->db->insert_id();
        var_dump($foroID);
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

                $config['upload_path']          = './fileUploads/foro';
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
                        "id_foro" => $foroID,
                        "id_file" => $fileID
                    );
                    $this->db->insert('files_foro', $insert);
                }
                else
                {
                }
            }
        }
        header('Location: /dashboard/foro/tema/'. $_POST['id_ticket_su']);
    }

    public function respuesta()
    {
        $message = $_POST['comentario'];
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
            "id_ticket_su" => $_POST['id_ticket_su'],
            "id_SU" => $this->logdata->getData("id"),
            "id_nota" => $_POST['last'],
            "mensaje" => $message
        );
        $this->db->insert('foro', $insert);
        $foroID = $this->db->insert_id();
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

                $config['upload_path']          = './fileUploads/foro';
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
                        "id_foro" => $foroID,
                        "id_file" => $fileID
                    );
                    $this->db->insert('files_foro', $insert);
                }
                else
                {
                }
            }
        }
        header('Location: /dashboard/foro/tema/'. $_POST['id_ticket_su']);
    }
}