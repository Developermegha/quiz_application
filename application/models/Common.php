<?php 
class Common extends CI_Model
{
    
    function insert_data($tablename='',$data=''){
        $return = array();
        if(!empty($data)){
            $this->db->insert($tablename,$data);
            $userid = $this->db->insert_id();
            $return = $userid;
        }
        return $return;
    }
}

?>