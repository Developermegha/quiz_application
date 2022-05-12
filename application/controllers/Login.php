<?php
class Login extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        $this->load->model('Loginmodel','loginmodel');
        
    }
    
    /*
    * Login the correct credentials of admin
    */
    public function check_login(){
        
        
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $remember = $this->input->post('remember');
        
        if(empty($email)  || empty($password) ){
            $this->response['code'] = RES_MISSING;
            $this->response['msg'] = 'Parameter missing or invalid url';
            echo json_encode($this->response);
            return false;
            
        }
        
        $this->loginmodel->email = $email;
        $this->loginmodel->password = encrypt_script($password);
        
        $loginDetails = $this->loginmodel->checkLoginDetails();
        
        if($remember){
            setcookie('neet_admin',$email,time()+(2592000),"/"); //30 days time
        }
     
     
        if($loginDetails){
            //$this->session->sess_destroy();
            $session_array= array(
                'id' => $loginDetails->id,
                'username' => $loginDetails->username,
                'email' => $loginDetails->email,
                'role' => $loginDetails->role,
                'is_admin_loggedin' => true,
            );
            $this->session->set_userdata($session_array);
    
            $this->response['code']  = RES_SUCCESS;
            $this->response['msg'] = 'Login Successfully!';
            echo json_encode($this->response);    
        }else{
            $this->response['code']  = RES_MISSING;
            $this->response['msg'] = 'Credentials not match';
            echo json_encode($this->response);    
        }
        
        
        
            
        
    }
    
    
    
    /*
    * register the admin details
    */
    public function register_admin(){
        $username = $this->input->post('username');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $retype_password = $this->input->post('retype_password');
        
        if(empty($email)  || empty($password) || empty($username) || empty($retype_password)   ){
            $this->response['code'] = RES_MISSING;
            $this->response['msg'] = 'Parameter missing or invalid url';
            echo json_encode($this->response);
            return false;
            
        }
        
        if($password != $retype_password  ){
            $this->response['code'] = RES_MISSING;
            $this->response['msg'] = 'Not match the password enter';
            echo json_encode($this->response);
            return false;
            
        }
        
        $dataAr = array(
            'email' => $email,
            'password' => encrypt_script($password),
            'username' => $username,
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'role'  => '1' // 1 = admin ,2- staff 
        
        );
        
        $result = $this->loginmodel->add_new_user($dataAr);
        if($result){
            $this->response['code']  = RES_SUCCESS;
            $this->response['msg'] = 'Added Successfully!';
            echo json_encode($this->response);
        }else{
            $this->response['code']  = RES_MISSING;
            $this->response['msg'] = 'Not Added Successfully!';
            echo json_encode($this->response);
        }
      
    }
    
    /*
    * forget password 
    */
    public function forget_password(){
       $email = $this->input->post('email');
        $role = $this->input->post('role');
        if($role === 1)
        {
            $user_role="admin";
        }
        elseif($role === 2)
        {
           $user_role="staff";
           {
               
           }
        }
        elseif($role === 3)
        {
            $user_role="student";
        }
        
        if($email != '' && $role !='')
        {
         $loginDetailsUsers = $this->loginmodel->checkUsersDetails($email,$role); 
         if($loginDetailsUsers)
         {
           //  print_r($loginDetailsUsers->role);die;
             if($loginDetailsUsers->role === '1' )
             {
                 
                 
               redirect(base_url()."admin/login");   
             }
             elseif($loginDetailsUsers->role === '2')
             {
                  $pswd=$loginDetailsUsers->password; 
       $message="your password is - " .$pswd ;
       $from_email = "admin@kingsinternational.academy";
        $to_email = $this->input->post('email');
        //Load email library
        $this->load->library('email');
        $this->email->from('admin@kingsinternational.academy', 'forgot password');
        $this->email->to($loginDetailsUsers->email); 
        $this->email->subject('Forgot password');
        $this->email->message($message);
        $mail=$this->email->send();
                 redirect(base_url()."staff/login");
             }
             elseif($loginDetailsUsers->role === '3')
             {
               redirect(base_url()."student/login");   
             }
          
         }
         else
         {
             
         }
        }
    }
    
    
    /*
    * register students
    */
    public function register_student(){
        
    }
    
    /*
    * login of  student
    */
    public function student_login(){
        
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $remember = $this->input->post('remember');
        
        if(empty($email)  || empty($password) ){
            $this->response['code'] = RES_MISSING;
            $this->response['msg'] = 'Parameter missing or invalid url';
            echo json_encode($this->response);
            return false;
            
        }
        
        $this->loginmodel->email = $email;
        $this->loginmodel->password = encrypt_script($password);
        
        $loginDetails = $this->loginmodel->checkStudentDetails();
        
        if($remember){
            setcookie('neet_admin',$email,time()+(2592000),"/"); //30 days time
        }
     
     
        if($loginDetails){
        
            
            $session_array= array(
                'id' => $loginDetails->id,
                'username' => $loginDetails->user_name,
                'email' => $loginDetails->email,
                'mobile' => $loginDetails->mobile,
                'is_student_loggedin' => true
                
            );
            
            
            $this->session->set_userdata($session_array);
    
            $this->response['code']  = RES_SUCCESS;
            $this->response['msg'] = 'Login Successfully!';
            echo json_encode($this->response);    
        }else{
            $this->response['code']  = RES_MISSING;
            $this->response['msg'] = 'Credentials not match';
            echo json_encode($this->response);    
        }
        
        
      
    }
    
    /*
    * 
    */
     public function staff_login(){
        
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $remember = $this->input->post('remember');
        
        if(empty($email)  || empty($password) ){
            $this->response['code'] = RES_MISSING;
            $this->response['msg'] = 'Parameter missing or invalid url';
            echo json_encode($this->response);
            return false;
            
        }
        
        $this->loginmodel->email = $email;
        $this->loginmodel->password = encrypt_script($password);
        
        $loginDetailsstaff = $this->loginmodel->checkStaffDetails();
        
        if($remember){
            setcookie('neet_admin',$email,time()+(2592000),"/"); //30 days time
        }
     
     
        if($loginDetailsstaff){
        
            
            $session_array= array(
                'id' => $loginDetailsstaff->id,
                'username' => $loginDetailsstaff->username,
                'email' => $loginDetailsstaff->email,
                'course_id' => $loginDetailsstaff->course_id,
                'is_staff_loggedin' => true
                
            );
            
            
            $this->session->set_userdata($session_array);
    
            $this->response['code']  = RES_SUCCESS;
            $this->response['msg'] = 'Login Successfully!';
            echo json_encode($this->response);    
        }else{
            $this->response['code']  = RES_MISSING;
            $this->response['msg'] = 'Credentials not match';
            echo json_encode($this->response);    
        }
        
        
      
    }
}
?>