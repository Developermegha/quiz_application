<?php 
if( ! defined('BASEPATH')) exit('No direct script access allowed') ;

/*
*
*/

function r($data){
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}


/*
* this function used to get the ci instance
*/
// if(function_exists('get_instance')){
    
//     function get_instance(){
//         $ci = &get_instance();
//     }
// }

/*
*  this function get current date and time
*/
if(function_exists('get_current_date_time')){
    
    function get_current_date_time(){
        return date('Y-m-d H:i:s');
    }
}

/*
*  this function get current date
*/
if(function_exists('get_current_date')){
    
    function get_current_date(){
        return date('Y-m-d');
    }
}


/*
*  this function get current Year
*/
if(function_exists('get_current_year')){
    
    function get_current_year(){
        return date('Y');
    }
}


/*
* This is function using for encrypt password
*/
if(! function_exists('encrypt_script'))
{
    function encrypt_script($string){
        
        $ci = get_instance(); // CI_Loader instance
        $key = $ci->config->item('encryption_key');
        
        $secret_key = $key;
        $secret_iv = $key;
        
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $key = hash('sha256',$secret_key);
        $iv = substr(hash('sha256',$secret_iv),0,16);
        
        $output = base64_encode(openssl_encrypt($string,$encrypt_method,$key,0,$iv));
        return $output;
    }
}


/*
* This is function using for decrypt password
*/
if(!function_exists('decrypt_script'))
{
    function decrypt_script($string){
        
        $ci = get_instance(); // CI_Loader instance
        $key = $ci->config->item('encryption_key');
        
        $secret_key = $key;
        $secret_iv = $key;
        
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $key = hash('sha256',$secret_key);
        $iv = substr(hash('sha256',$secret_iv),0,16);
        
        $output = base64_encode(openssl_decrypt($string,$encrypt_method,$key,0,$iv));
        return $output;
    }
}

/*
* get session data of admin and student
*/
if(!function_exists('getSessionData')){
        
    function getSessionData($key)
    {
        $return_val = false;
        if(empty($key)){
           return $return_val;
        }
        
        $ci = get_instance();
        $allSession = $ci->session->userdata();
        $return_val = isset($allSession[$key]) ? $allSession[$key] : '';
        return $return_val;
    }
}


/*
* remove or destroy session
*/

if(!function_exists('removeSession')){
    
    function removeSession($key){
        $return_val = false;
        if(empty($return_val)){
            return $return_val;
        }
        
        $ci = get_instance();
        if($ci->session->userdata($key) != null){
            $ci->session->unset_userdata($key);
            $return_val = true;
        }
        return $return_val;
    }
}



/*
*   This function is used for 
*   convert datetime into dbtime
*/
if(!function_exists('convertDateTimeToDatabase'))
{
	function convertDateTimeToDatabase($date,$isTime='')
	{
	    if($date == '') {
	        return '';
	    } else {
	        if($isTime == '') {
	        	
				// echo date("Y-m-d",strtotime(str_replace("-", "/", $date)));
				// die;
	   			//return date("Y-m-d",strtotime(str_replace("/", "-", $date)));
	   			//$date = DateTime::createFromFormat("m/d/Y" , $date);
	            // return $date->format('Y-m-d');
	            return date("Y-m-d",strtotime(str_replace("-", "/", $date)));
	        } else {
	            //return date("Y-m-d H:i:s",strtotime(str_replace("/", "-", $date)));
	            // $date = DateTime::createFromFormat("m/d/Y H:i:s" , $date);
	            // return $date->format('Y-m-d H:i:s');
	            return date("Y-m-d H:i:s",strtotime(str_replace("-", "/", $date)));
	        }
	    }
	}
}

/*
 * This function convert dbtime
 * to usertime
 */
if(!function_exists('convertDbTimetoUserTime'))
{
	function convertDbTimetoUserTime($date,$isTime='')
	{
	    if($date == '') {
	        return '';
	    } else {
	        if($isTime == '') {
	            if($date != "0000-00-00" && $date != NULL) {
	                return date("m/d/Y",strtotime(str_replace("-", "/", $date)));
	            } else {
	                return '';
	            }
	        } else {
	        	if($date != "0000-00-00" && $date != NULL) {
	            	return date("m/d/Y h:i A",strtotime(str_replace("-", "/", $date)));
	            } else {
	                return '';	                
	            }
	        }
	    }
	}
}




?>