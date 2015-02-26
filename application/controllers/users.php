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
        $data['home'] = 'active';
        $data['api_key'] = '';
        
        $data['html'] = '<strong>Howdy '.ucwords($this->session->userdata('first_name')).'!</strong>';
        $data['html'] .= '<br><br><div class="well">Welcome to this test project.</div>';
        
		$this->load->view('common/header', $data);
		$this->load->view('users_page');
        $this->load->view('common/footer');
	}
    
    public function api_key()
	{
        $data['page_title'] = 'Users Page';
        $data['home'] = '';
        $data['api_key'] = 'active';
        
        $data['html'] = '<strong>Your API Key</strong> <br><br><div class="well">'.$this->session->userdata('api_key').'</div>';
        
        $data['html'] .= $this->load->view('api_page', array('api_key'=>$this->session->userdata('api_key')), TRUE);
        
		$this->load->view('common/header', $data);
		$this->load->view('users_page');
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