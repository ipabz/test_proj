<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
      parent::__construct();
      $this->load->helper(array('form', 'url'));
      $this->load->model('accounts');
    }
  
	public function index()
	{
        $data['page_title'] = 'Log In';
        $data['error'] = '';
        
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('email_address', 'Email Address', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');    
        
		if ($this->form_validation->run() == FALSE) {
          $data['error'] = validation_errors();
		} else {
			
          $email = $this->input->post('email_address', TRUE);
          $password = $this->input->post('password', TRUE);
          
          if ( $this->input->post('remember_me') ) {
            $this->session->set_userdata('_email', $email);
            $this->session->set_userdata('_password', $password);
            $this->session->set_userdata('_remember_me', $this->input->post('remember_me'));
          } else {
            $this->session->unset_userdata('_email');
            $this->session->unset_userdata('_password');
            $this->session->unset_userdata('_remember_me');
          }
          
          if ( $user_data = $this->accounts->validate($email, $password) ) {
            $this->session->set_userdata($user_data);
            redirect('users');
          } else {
            $data['error'] = 'Account does not exists for the email address and password you entered. Please try again!';
          }
          
		}
        
        if ( $this->session->userdata('_remember_me') === '1') {
          
          $_POST['email_address'] = $this->session->userdata('_email');
          $_POST['password'] = $this->session->userdata('_password');
          $_POST['remember_me'] = $this->session->userdata('_remember_me');
          
        }
        
        $this->load->view('common/header', $data);
		$this->load->view('login_page');
        $this->load->view('common/footer');
	}   
    
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */