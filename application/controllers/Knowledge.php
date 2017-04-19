<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Knowledge extends CI_Controller
{
    public function index()
    {
        if($this->logdata->getType() == "mortal")
        {
            $this->load->library('pagination');
            //obtener solo las que se mostraran
            $this->db->order_by('fecha_hora', 'DESC');
            $entradas = $this->db->get("knowledge", "10", $this->uri->segment(2));
            $data['entradas'] = $entradas->result();
            
            //obtener el total
            $total = $this->db->get("knowledge");

            $config['base_url'] = '/knowledge';
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
            
            $this->load->view("mortal/knowledge", $data);
        }
        else
        {
            header("Location: /");
        }
    }

    public function entrada($id = "")
    {
        if($this->logdata->getType() == "mortal")
        {
            if($id!="")
            {
                $entrada = $this->db->query("SELECT * FROM knowledge WHERE id = ". $id);
                $entrada = $entrada->result();
                $this->load->view("mortal/entrada", ["entrada" => $entrada[0]]);
            }
            else
            {
                header("Location: /knowledge");    
            }
             
        }
        else
        {
            header("Location: /");
        }
    }

    public function search($search = "")
    {
         if($this->logdata->getType() == "mortal")
        {
            if($search!="")
            {
                $this->load->library('pagination');
                //obtener solo las que se mostraran
                $this->db->order_by('fecha_hora', 'DESC');
                $entradas = $this->db->get_where("knowledge", "tema LIKE '%" . $search . "%' OR titulo LIKE '%" . $search . "%' OR contenido LIKE '%" . $search . "%'" ,"10", $this->uri->segment(4));
                $data['entradas'] = $entradas->result();
                
                //obtener el total
                $total = $this->db->get_where("knowledge", "tema LIKE '%" . $search . "%' OR titulo LIKE '%" . $search . "%' OR contenido LIKE '%" . $search . "%'");

                $config['base_url'] = '/knowledge/search/'.$search;
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
                
                $this->load->view("mortal/knowledge", $data);
            }
            else
            {
                header("Location: /knowledge");    
            }
        }
        else
        {
            header("Location: /");
        }
    }

    public function tema($tema = "")
    {
        if($this->logdata->getType() == "mortal")
        {
            if($tema!="")
            {
                $this->load->library('pagination');
                //obtener solo las que se mostraran
                $this->db->order_by('fecha_hora', 'DESC');
                $entradas = $this->db->get_where("knowledge", "tema = '".$tema."'" ,"10", $this->uri->segment(4));
                $data['entradas'] = $entradas->result();
                
                //obtener el total
                $total = $this->db->get_where("knowledge", "tema = '".$tema."'");

                $config['base_url'] = '/knowledge/tema/'.$tema;
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
                
                $this->load->view("mortal/knowledge", $data);
            }
            else
            {
                header("Location: /knowledge");    
            }
        }
        else
        {
            header("Location: /");
        }
    }

   
}