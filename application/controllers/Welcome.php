<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
      
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('crud_model');

        $this->load->library('form_validation');
    }
        
    public function index()
    {
        $this->load->view('welcome_message');
    }
    public function aficher()
    {
        echo "hi anass";
    }
    public function insert()
    {
        if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules('name', 'name', 'required');
            $this->form_validation->set_rules('email', 'email', 'required|valid_email');
            if ($this->form_validation->run() == false) {
                $data =array('responce'=>'error','message'=>validation_errors());
            } else {
                $ajax_data=$this->input->post();
                if ($this->crud_model->insert_entry($ajax_data)) {
                    $data =array('response'=>'Success','message'=>'data inserted sucssesfly');
                } else {
                    $data =array('response'=>'errors','message'=>'data failed to insert');
                }
            }
        } else {
            echo "No direct script access allowed";
        }
        echo json_encode($data);
    }
    public function fetch()
    {
        if ($this->input->is_ajax_request()) {
            $posts=$this->crud_model->get_entry();
            echo json_encode($posts);
        }
    }
    public function delete()
    {
        if ($this->input->is_ajax_request()) {
            $del_id=$this->input->post('del_id');
            if ($this->crud_model->del_entry($del_id)) {
                $data =array('response'=>'Success','message'=>'the data had deleted');
            } else {
                $data =array('response'=>'error','message'=>'the data had failed to delete');
            }

            echo json_encode($data);
        }
    }
    
    public function edit()
    {
        if ($this->input->is_ajax_request()) {
           
            $edit_id=$this->input->post('edit_id');
            
            if ($posts=$this->crud_model->edit_entry($edit_id)) {
                 
                $data =array('response'=>'Success','post'=>$posts);
             } 
            else {
                $data =array('response'=>'error','post'=>'the data had failed to delete');
            }
        }
        else{
            echo "No direct script access allowed";
        }
        
          echo json_encode($data);   // bach nban liya resultat flconsole
    }
    public function update()
    {
        
        if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules('name', 'name', 'required');
            $this->form_validation->set_rules('email', 'email', 'required|valid_email');
            if ($this->form_validation->run() == true) {
                $data =array('responce'=>'error','message'=>validation_errors());
            } 
            else {
                $data['id']=$this->input->post('edit_id');
                $data['name']=$this->input->post('edit_name');
                $data['email']=$this->input->post('edit_email');
                // echo $data;
                if($this->crud_model->update_entry($data)){
                    $data =array('response'=>'Success','message'=>'data updated sucssesfly');
                }
                else
                {
                    $data =array('response'=>'error','message'=>'updating failled');
                }
            }
                
        }

        else {
            echo "No direct script access allowed";
        }
        echo json_encode($data);
      
        
        }
  
}

           