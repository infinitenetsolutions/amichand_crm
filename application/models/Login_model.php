<?php

class Login_model extends CI_Model {
   public function __construct()
   {
   		$this->table='table_employee';
   		$this->primery_key='id';
   }
  
  
    function all_user(){
      return $this->db->select('*')
              ->from($this->table)
              //->where('status',md5("visible"))
              ->get()
              ->result_array();
  }
    

    function validate($username,$password){
     // echo "working";
    	return $this->db->select('*')
				    	->from($this->table)
				    	->where('username',$username)
				    	->get()
				    	->result_array();
  }

  function check_account_exist($username){
      return $this->db->select('*')
              ->from($this->table)
              ->where('username',$username)
              ->get()
              ->num_rows();
  }
function reset_password($newpass){
      // return $this->db->set('username',$username, FALSE)
      //         ->where('username',$username)
      //         ->update('orders', $data);

      //         $this->db->
      //         $this->db->where('id', 2);
      //         $this->db->update('mytable'); 
  }



  

}





