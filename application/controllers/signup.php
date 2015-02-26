<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Signup extends CI_Controller {

    public function __construct() {
      parent::__construct();
      $this->load->helper(array('form', 'url'));
      $this->load->model('accounts');
    }
  
	public function index()
	{
        $data['page_title'] = 'Sign Up';
        $data['error'] = '';
        
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('first_name', 'First Name', 'required'); 
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
        $this->form_validation->set_rules('email_address', 'Email Address', 'required|valid_email');
        $this->form_validation->set_rules('repeat_email_address', 'Repeat Email Address', 'required|matches[email_address]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('gender', 'Gender', 'required');
        
        if ($this->form_validation->run() == FALSE) {
          $data['error'] = validation_errors();
		} else {
          
          $user_data['first_name'] = $this->input->post('first_name', TRUE);
          $user_data['last_name'] = $this->input->post('last_name', TRUE);
          $user_data['email_address'] = trim( $this->input->post('email_address', TRUE) );
          $user_data['password'] = $this->input->post('password', TRUE);
          $user_data['gender'] = $this->input->post('gender', TRUE);
          
          if ( $verification_code = $this->accounts->create($user_data) ) {
            
            if ( SEND_EMAIL ) {
              
              $this->load->library('email');
            
              $config['mailtype'] = 'html';
              $this->email->initialize($config);

              $this->email->from('testproj@demo.ivanclintpabelona.com', 'Test Proj');
              $this->email->to($user_data['email_address']); 

              $this->email->subject('Test Proj: Account Verification');

              $msg = "Hi ".  ucfirst($user_data['first_name']).", <br /><br />";
              $msg .= "Thank you for creating an account with us. Please click the link below to verify.<br><br>";
              $msg .= "<a href='".site_url('account/verify/'.$verification_code)."'>Verify Account</a><br><br>";
              $msg .= "Thanks and regards";

              $this->email->message($msg);	

              $this->email->send();
              
            }
            
            redirect('signup/success');
            
          } else {
            $data['error'] = 'An error occured while creating your account. Please try again in a while.';
          }
          
        }
        
		$this->load->view('common/header', $data);
		$this->load->view('signup_page');
        $this->load->view('common/footer');
	}
    
    public function success()
    {
      
      $data['page_title'] = 'Sign Up Success';
      $data['html'] = '<div class="alert alert-success">You\'ve successfully created an account. Please check your email to verify it.</div>';
      $data['html'] .= '<div class="text-center"><a class="btn btn-success" href="'.site_url('login').'">Proceed to login page</a></div>';
      $data['html'] .= '<br><br><br><br><br><br><div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title"><strong>Note</strong></h3>
        </div>
        <div class="panel-body">
          <div class="container-fluid">Since this is for testing purposes only, the accout is active after signing up. So you can already proceed to the login page.</div></div></div>';
      
      $this->load->view('common/header', $data);
      $this->load->view('status_page');
      $this->load->view('common/footer');
      
    }
    
}

/* End of file signup.php */
/* Location: ./application/controllers/signup.php */