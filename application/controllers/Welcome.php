<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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

		$this->load->library('form_validation');
	  }
	  	
	 public function index()
	{
		$this->load->view('welcome_message');
	}
	public function aficher(){
		echo "hi anass";
	}
	public function insert(){
		
		if($this->input->is_ajax_request())
		{

			$this->form_validation->set_rules('name', 'name', 'required');
			$this->form_validation->set_rules('email', 'email', 'required');
				if ($this->form_validation->run() == false){
					$data =array('responce'=>'error','message'=>validation_errors());
				}
				else{
					$ajax_data=$this->input->post();
					
					
				  $data =array('response'=>'success','message'=>$ajax_data);

				} 	

		}else {
			echo "No direct script access allowed";
		}
		echo json_encode($data);
		
	}
}
