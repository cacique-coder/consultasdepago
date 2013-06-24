<?php
class Auth_model extends CI_Model {
  private $user;
  private $ldapconn;
  private $ldap_rdn;
  private $ldap_pass;

  function __construct(User_model $user = null) {
    parent::__construct();
    if ($user != null){
      $this->user=$user;
    }
  }

  public function always_in(){
    $this->set_auth_user();
    return true;
  }
  public function log_ldap(){
    $this -> connect_ldap();
    $this -> user_data();
    $this -> ldap_bind();
  if ($this->ldapbind) {
      $this->search_data();
      $this->set_auth_user();
      return true;
  } else {
    return false;
  }
  }
  public function get_user_auth(){
    $this->user;
  }

  public function search_data(){
    $result = ldap_search($this->ldapconn,$config['ldap']['tree'], "(cn=*)") or die ("Error in search query: ".ldap_error($ldapconn));
    $data = ldap_get_entries($ldapconn, $result);
    var_dump($data);
  // Falta programar esto... depende de lo que traiga la informacion
  // y no tengo ni idea
  }

  public function data_login_user(){
    return $this->user->data_session();
  }
  private function connect_ldap(){
    $this->ldapconn = ldap_connect($config['ldap']['host']) or die("Could not connect to LDAP server.");
  }
  private function user_data(){
    $this->ldap_rdn  = $this->user->login;     // ldap rdn or dn
    $this->ldap_pass = $this->user->password;  // associated password    
  }
  private function ldap_bind(){
  $this->ldapbind = ldap_bind($this->ldapconn, $this->ldap_rdn, $this->ldap_pass);
  }
  private function set_auth_user(){
    $this->user->set_auth();
  }

}