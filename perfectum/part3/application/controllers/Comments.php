<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comments extends CI_Controller {

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
		$this->load->model('comments_model');
	}
	
	
	public function index()
	{
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('email');
        
        if(isset($_POST['email'])) {
	        $this->form_validation->set_rules('email', 'email', 'required|valid_email',  
		        array('required' => '<div class="alert alert-danger" role="alert">Поле email должно быть заполнено</div>', 
		        'valid_email' => '<div class="alert alert-danger" role="alert">Поле email должно содержать действительный адрес электронной почты.</div>')
	        );
	        $this->form_validation->set_rules('message', 'message', 'required', 
	            array('required' => '<div class="alert alert-danger" role="alert">Поле сообщения должно быть заполнено</div>')
	        );
	        
            if ($this->form_validation->run() === TRUE) {
				$this->input->post(NULL, TRUE);
		        $this->comments_model->add_comment();
		        redirect(base_url().'index.php/comments/index', 'refresh');
			}
	    }
 
		$config['base_url'] = base_url().'index.php/comments/index';
		$config['total_rows'] = $this->comments_model->record_count();
		$config['per_page'] = 5;
		$config['uri_segment'] = 3;
		$config['num_links'] = 2;
		$config['first_link'] = "<<";
		$config['last_link'] = ">>";
		$config['num_tag_open'] = " <div class='btn btn-outline-dark btn-lg'>";
		$config['num_tag_close'] = "</div> ";
		$config['first_tag_open'] = " <div class='btn btn-outline-dark btn-lg'>";
		$config['first_tag_close'] = "</div> ";
		$config['last_tag_open'] = " <div class='btn btn-outline-dark btn-lg'>";
		$config['last_tag_close'] = "</div> ";
		$config['next_tag_open'] = " <div class='btn btn-outline-dark btn-lg'>";
		$config['next_tag_close'] = "</div> ";
		$config['prev_tag_open'] = " <div class='btn btn-outline-dark btn-lg'>";
		$config['prev_tag_close'] = "</div> ";
		$config['cur_tag_open'] = " <div class='btn btn-outline-dark btn-lg'>";
		$config['cur_tag_close'] = "</div> ";

		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		
		$data['comments'] = $this->comments_model->get_comments($config['per_page'], $page);		
		$data['pagination'] = $this->pagination->create_links();
        		
		$this->load->view('header', $data);
		$this->load->view('comment', $data);
		$this->load->view('footer', $data);
		
	}
	
  
}
