<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AjaxFAQ extends CI_Controller
{
    public function index()
    {
        $questions= $this->db->query("SELECT * FROM knowledge WHERE id = " . $_POST['id']);
        $questions=$questions->result();
        $files = $this->db->query("SELECT files.id_file, files.nombreOriginal, files.nombreAlmacenado FROM files INNER JOIN files_knowledge on files.id_file = files_knowledge.id_file WHERE id_knowledge = ". $_POST['id']);
        $files = $files->result();
        if(count($files)>0)
        {
            $questions[0]->files = $files;
        }
        echo json_encode($questions[0]);
    }
}