<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct() {
      parent::__construct();
      $this->load->model('accounts');
      $this->accounts->check_session();
    }
  
	public function index()
	{
        $data['page_title'] = 'Users Page';
        
		$this->load->view('common/header', $data);
		//$this->load->view('login');
        $this->load->view('common/footer');
	}
    
    public function logout()
    {
      $this->session->sess_destroy();
      redirect('login');
    }
}

/* End of file users.php */
/* Location: ./application/controllers/users.php */