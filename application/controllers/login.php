<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
        $data['page_title'] = 'Log In';
        
        $this->load->view('common/header', $data);
		$this->load->view('login');
        $this->load->view('common/footer');
	}
    
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */