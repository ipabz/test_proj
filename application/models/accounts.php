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
  
  public function get_accounts($account_id=NULL, $limit=1, $offset=0)
  {
    $this->db->limit($limit, $offset);
    
    if ($account_id !== NULL) {
      $this->db->where('account_id', $account_id);
    }
    
    $this->db->select('first_name, last_name, email_address, '.TABLE_PERSONS.'.person_id, account_id, password, account_status, '.TABLE_ACCOUNTS.'.date_created, '.TABLE_ACCOUNTS.'.last_updated');
    $this->db->join(TABLE_PERSONS, TABLE_ACCOUNTS.'.person_id = '.TABLE_PERSONS.'.person_id', 'inner');
    $query = $this->db->get(TABLE_ACCOUNTS);
    
    if ($query->num_rows() > 0) {
      return $query;
    } else {
      return FALSE;
    }
    
  }
  
  public function create($data=array())
  {
    if ( !($valid_data = $this->validate(trim($data['email_address']), $data['password'])) ) {
    
      $datetime = @date('Y-m-d H:i:s');

      $person_data = array(
          'first_name' => $data['first_name'],
          'last_name' => $data['last_name'],
          'gender' => $data['gender'],
          'date_created' => $datetime,
          'last_updated' => $datetime
      );
      
      $this->db->insert(TABLE_PERSONS, $person_data);
      $person_id = $this->db->insert_id();
      $code = $this->generate_secure_keys(trim($data['email_address']), $data['password'], TRUE);
      $verification_code = sha1($code);
      
      $account_data = array(
          'person_id' => $person_id,
          'email_address' => trim($data['email_address']),
          'password' => $code,
          'account_status' => DEFAULT_ACCOUNT_STATUS,
          'verification_code' => $verification_code,
          'verification_code_expiry' => strtotime('+1 day', time()),
          'date_created' => $datetime,
          'last_updated' => $datetime
      );
      
      $this->db->insert(TABLE_ACCOUNTS, $account_data);
      
      return $verification_code;
    
    }
    
    return FALSE;
    
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