<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Accounts extends CI_Model {
  
  public function validate($email_address, $password)
  {
    
    $conditions = array(
        'email_address' => $email_address,
        'password' => $this->generate_secure_keys($email_address, $password, TRUE),
        'account_status' => 'active'
    );
    
    $this->db->select('first_name, last_name, email_address, '.TABLE_PERSONS.'.person_id, account_id');
    $this->db->join(TABLE_PERSONS, TABLE_ACCOUNTS.'.person_id = '.TABLE_PERSONS.'.person_id', 'inner');
    $query = $this->db->get_where(TABLE_ACCOUNTS, $conditions);
    
    if ($query->num_rows() > 0) {
      return $query->row_array();
    } else {
      return FALSE;
    }
    
  }
  
  public function generate_secure_keys($secret, $text, $return=FALSE)
  {    
    $hash = hash_hmac('ripemd160', $text, $secret);
    
    if ( $return ) {
      return $hash;
    } else {
      echo $hash;
    }
    
  }
  
  public function check_session()
  {
    $this->load->helper('url');
    
    if ( !($this->session->userdata('email_address') && $this->session->userdata('first_name') && $this->session->userdata('last_name')) ) {
      redirect('login');
    }
  }
  
}

/* End of file accounts.php */
/* Location: ./application/models/accounts.php */