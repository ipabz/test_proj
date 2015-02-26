<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Accounts extends CI_Model {
  
  public function __construct() {
    parent::__construct();
    
    if ( MEMCACHE ) {
      $this->load->library('memcached_library'); 
    }
    
  }
  
  public function validate($email_address, $password)
  {
    
    $conditions = array(
        'email_address' => $email_address,
        'password' => $this->generate_secure_keys($email_address, $password, TRUE),
        'account_status' => 'active'
    );
    
    $this->db->select('first_name, last_name, email_address, '.TABLE_PERSONS.'.person_id, account_id, api_key');
    $this->db->join(TABLE_PERSONS, TABLE_ACCOUNTS.'.person_id = '.TABLE_PERSONS.'.person_id', 'inner');
    $query = $this->db->get_where(TABLE_ACCOUNTS, $conditions);
    
    if ($query->num_rows() > 0) {
      return $query->row_array();
    } else {
      return FALSE;
    }
    
  }
  
  public function verify($code) {
    
    $this->db->where('verification_code', $code);
    $date = @date('Y-m-d H:i:s');
    
    $data = array(
        'account_status' => 'active',
        'date_verified' => $date,
        'last_updated' => $date
    );
    
    $this->db->update(TABLE_ACCOUNTS, $data);
    
  }
  
  public function get_accounts($account_id=NULL, $verification_code=NULL, $limit=1, $offset=0)
  {
    $this->db->limit($limit, $offset);
    
    if ($account_id !== NULL) {
      $this->db->where('account_id', $account_id);
    } else if ($verification_code !== NULL) {
      $this->db->where('verification_code', $verification_code);
    }
    
    $this->db->select('first_name, last_name, email_address, '.TABLE_PERSONS.'.person_id, account_id, password, account_status, '.TABLE_ACCOUNTS.'.date_created, '.TABLE_ACCOUNTS.'.last_updated, '.TABLE_ACCOUNTS.'.api_key');
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
          'first_name' => strtolower($data['first_name']),
          'last_name' => strtolower($data['last_name']),
          'gender' => $data['gender'],
          'date_created' => $datetime,
          'last_updated' => $datetime
      );
      
      $this->db->insert(TABLE_PERSONS, $person_data);
      $person_id = $this->db->insert_id();
      $code = $this->generate_secure_keys(trim($data['email_address']), $data['password'], TRUE);
      $verification_code = sha1($code);
      $api_key = sha1($verification_code . $code . $person_id . time());
      
      
      $account_data = array(
          'person_id' => $person_id,
          'email_address' => trim($data['email_address']),
          'password' => $code,
          'account_status' => DEFAULT_ACCOUNT_STATUS,
          'verification_code' => $verification_code,
          'api_key' => $api_key,
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
  
  public function validate_api_key($key)
  {
    
    $this->db->where('api_key', $key);
    $query = $this->db->get(TABLE_ACCOUNTS);
    
    if ($query->num_rows() > 0) {
      return TRUE;
    }
    
    return FALSE;
    
  }
  
  public function update($data=array())
  {
    $date = @date('Y-m-d H:i:s');
    
    $person_data = array(
        'first_name' => strtolower(trim($data['first_name'])),
        'last_name' => strtolower(trim($data['last_name'])),
        'gender' => trim($data['gender']),
        'last_updated' => $date
    );
    
    $this->db->where('person_id', $data['person_id']);
    $this->db->update(TABLE_PERSONS, $person_data);
    
    $account_data = array(
        'account_status' => $data['account_status'] 
    );
    
    $this->db->where('account_id', $data['account_id']);
    $this->db->update(TABLE_ACCOUNTS, $account_data);
    
    
  }
  
  public function get($conditions=array(), $limit=100,$offset=0)
  {
    $query = NULL;
    
    if ( MEMCACHE ) {
      
      $key = trim( implode('', str_replace(' ', '_', $conditions)) );
      
      if ($key === '') {
        $key = 'all_people';
      }
      
      $query = $this->memcached_library->get($key);
      
      if (trim($query) !== '') {
        $query = json_decode($query);
      }
      
    }
    
    if (!$query) {
    
      $this->db->limit($limit, $offset);

      if (count($conditions) > 0) {
        $this->db->where($conditions);
      }

      $this->db->select('first_name, last_name, email_address, '.TABLE_PERSONS.'.person_id, account_id, password, account_status, '.TABLE_ACCOUNTS.'.date_created, '.TABLE_ACCOUNTS.'.last_updated, '.TABLE_ACCOUNTS.'.api_key, gender');
      $this->db->join(TABLE_PERSONS, TABLE_ACCOUNTS.'.person_id = '.TABLE_PERSONS.'.person_id', 'inner');
      $query = $this->db->get(TABLE_ACCOUNTS);
      
      if ($limit === 1) {
        $result = $query->row_array();
      } else {
        $result = $query->result_array();
      }
      
      if ( MEMCACHE ) {        
        $this->memcached_library->add($key, json_encode($result));
      }
      
      $query = $result;
    
    }
    
    if (count($query) > 0) {
      return $query;
    } else {
      return FALSE;
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