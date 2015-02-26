<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Install extends CI_Controller {

    public function __construct() {
      parent::__construct();
      $this->load->helper(array('form', 'url'));
      $this->load->model('accounts');
    }
  
	public function index()
	{      
      $this->load->library('migration');
      $success = $this->migration->current();
      
      $data['page_title'] = 'Install';
      
      if ( $success ) {        
        
      $data['html'] = '<div class="alert alert-success">Database successfully migrated to the latest version.</div>';
      $data['html'] .= '<div class="text-center"><a class="btn btn-success" href="'.site_url('login').'">Proceed to login page</a></div>';
        
      } else {
        
        $data['html'] = '<div class="alert alert-danger">An error occured while doing database migrations!</div>';
        
      }
      
      $this->load->view('common/header', $data);
      $this->load->view('status_page');
      $this->load->view('common/footer');
      
	}
    
}

/* End of file install.php */
/* Location: ./application/controllers/install.php */