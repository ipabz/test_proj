<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');

class V1 extends REST_Controller {
    
    public function __construct() {
      parent::__construct();
      $this->load->helper(array('form', 'url'));
      $this->load->model('accounts');
    }
    
    public function people_get()
    {
      $condition = array();
      
      if ( ! $this->get('api_key') ) {
        $this->response(array('error' => 'API Call not allowed!'), 403);
      } else {
        
        if (! $this->accounts->validate_api_key(trim($this->get('api_key')))) {
          $this->response(array('error' => 'API Call not allowed!'), 403);
        }
        
      }
      
      if( $this->get('email_address') ) {
          $condition['email_address'] = trim($this->get('email_address'));
      }
      
      if( $this->get('first_name') ) {
          $condition['first_name'] = strtolower(trim($this->get('first_name')));
      }
      
      if( $this->get('last_name') ) {
          $condition['last_name'] = strtolower(trim($this->get('last_name')));
      }

      $query = $this->accounts->get( $condition );
      $people = FALSE;
      
      if ($query) {
        $people = $query;
      }

      if($people) {
          $this->response($people, 200); // 200 being the HTTP response code
      } else {
          $this->response(array('error' => 'Person could not be found'), 404);
      }
      
    }
    
    public function person_put($id="")
    {
      $api_key = $this->input->get('api_key');

      if ( ! $api_key ) {
        $this->response(array('error' => 'API Call not allowed!'), 403);
      } else {
        
        if (! $this->accounts->validate_api_key(trim($api_key))) {
          $this->response(array('error' => 'API Call not allowed!'), 403);
        }
        
      }
      
      if ($id === "") {
        $this->response(array('error' => 'Person could not be found'), 404);
      } else {
        $condition[TABLE_PERSONS.'.person_id'] = $id;
        $query = $this->accounts->get( $condition, 1 );
        
        if ($query) {
          
          $person = $query;
 
          if ($this->put('first_name')) { 
            $person['first_name'] = $this->put('first_name');
          }
          
          if ($this->put('last_name')) {
            $person['last_name'] = $this->put('last_name');
          }
          
          if ($this->put('gender')) {
            $person['gender'] = $this->put('gender');
          }
          
          if ($this->put('account_status')) {
            $person['account_status'] = $this->put('account_status');
          }
         
          $this->accounts->update($person);
          
          $this->response($person, 200);
        }
        
      }
      
    }
  
	
}

/* End of file v1.php */
/* Location: ./application/controllers/api/v1.php */