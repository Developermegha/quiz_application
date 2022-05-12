<?php 
class Loginmodel extends CI_model{
    
    /*
    * get admin /students details 
    * to check creddentials
    */
    public function checkLoginDetails(){
        $response = array();
        
            $this->db->select('*');
            $this->db->from('admin');   
            $this->db->where('email',$this->email);
            $this->db->where('password',$this->password);
            $this->db->where('is_deleted',0);
            $query = $this->db->get();
            // echo $this->db->last_query();
            if($query->num_rows() > 0){
                $response = $query->row();
            }
        
        return $response;
    }
    
     public function checkUsersDetails($email,$role){
        $response = array();
        
            $this->db->select('*');
            $this->db->from('admin');   
            $this->db->where('email',$email);
            $this->db->where('role',$role);
           // $this->db->where('is_deleted',0);
            $query = $this->db->get();
            // echo $this->db->last_query();
            if($query->num_rows() > 0){
                $response = $query->row();
            }
        
        return $response;
    }
    
    /*
    * Add new user to the db
    */
    public function add_new_user($data){
        $response = false;
        if(!empty($data)){
            $this->db->insert('admin',$data);
            $last_id = $this->db->insert_id();
            $response = true;
        }
        return $response;
    }
    
    /*
    * check student details 
    * for login credential
    */
    public function checkStudentDetails(){
         $response = array();
        
            $this->db->select('*');
            $this->db->from('user');   
            $this->db->where('email',$this->email);
            $this->db->where('password',$this->password);
            $this->db->where('is_deleted',0);
            $this->db->where('is_active',1);
            
            $query = $this->db->get();
        
            if($query->num_rows() > 0){
                $response = $query->row();
            }
        
        return $response;
    }
    
    public function checkStaffDetails(){
         $response = array();
        
            $this->db->select('*'); 
            $this->db->from('admin');   
            $this->db->where('email',$this->email);
            $this->db->where('password',$this->password);
            $this->db->where('is_deleted',0);
            $this->db->where('status',1);
            $this->db->where('role',2); // 1- Student , 2- Staff
            $query = $this->db->get();
        
            if($query->num_rows() > 0){
                $response = $query->row();
            }
        
        return $response;
    }
}
?>