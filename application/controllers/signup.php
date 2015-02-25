<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Signup extends CI_Controller {

    public function __construct() {
      parent::__construct();
      $this->load->helper(array('form', 'url'));
    }
  
	public function index()
	{
        $data['page_title'] = 'Sign Up';
        $data['error'] = '';
        
		$this->load->view('common/header', $data);
		$this->load->view('signup_page');
        $this->load->view('common/footer');
	}
    
}

/* End of file signup.php */
/* Location: ./application/controllers/signup.php */