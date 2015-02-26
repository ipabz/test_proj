<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Initial_schema extends CI_Migration {
  
  public function up()
  {
    $this->dbforge->add_key('person_id', TRUE);
    
    $person_fields = array(
        'person_id' => array(
            'type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE 
        ),
        'first_name' => array(
            'type' => 'VARCHAR', 'constraint' => 50, 'null' => FALSE
        ),
        'last_name' => array(
            'type' => 'VARCHAR', 'constraint' => 50, 'null' => FALSE
        ),
        'gender' => array(
            'type' => 'VARCHAR', 'constraint' => 1, 'null' => FALSE
        ),
        'date_created' => array(
            'type' => 'DATETIME', 'null' => FALSE
        ),
        'last_updated' => array(
            'type' => 'DATETIME', 'null' => FALSE
        )
    );
    
    $this->dbforge->add_field($person_fields);
    $this->dbforge->create_table('persons');

    $this->dbforge->add_key('account_id', TRUE);
     
    $account_fields = array(
        'account_id' => array(
            'type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE 
        ),
        'person_id' => array(
            'type' => 'INT', 'constraint' => 11, 'null' => FALSE 
        ),
        'email_address' => array(
            'type' => 'VARCHAR', 'constraint' => 50, 'null' => FALSE
        ),
        'password' => array(
            'type' => 'VARCHAR', 'constraint' => 100, 'null' => FALSE
        ),
        'account_status' => array(
            'type' => 'VARCHAR', 'constraint' => 20, 'null' => FALSE
        ),
        'verification_code' => array(
            'type' => 'VARCHAR', 'constraint' => 100, 'null' => FALSE
        ),
        'verification_code_expiry' => array(
            'type' => 'VARCHAR', 'constraint' => 30, 'null' => FALSE
        ),
        'api_key' => array(
            'type' => 'VARCHAR', 'constraint' => 100, 'null' => FALSE
        ),
        'account_status' => array(
            'type' => 'VARCHAR', 'constraint' => 20, 'null' => FALSE, 'default' => 'inactive'
        ),
        'date_created' => array(
            'type' => 'DATETIME', 'null' => FALSE
        ),
        'date_verified' => array(
            'type' => 'DATETIME', 'null' => TRUE
        ),
        'last_updated' => array(
            'type' => 'DATETIME', 'null' => FALSE
        )
    );
    
    $this->dbforge->add_field($account_fields);
    $this->dbforge->create_table('accounts');
    
  }
  
  public function down()
  {
    $this->dbforge->drop_table('persons');
    $this->dbforge->drop_table('accounts');
  }
  
}

/* End of file 001_initial_schema.php */
/* Location: ./application/controllers/001_initial_schema.php */