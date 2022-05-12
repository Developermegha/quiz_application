<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staff extends CI_Controller {
    
    var $view_path = 'staff/';
    var $action = 'staff/';
    
    public function __construct(){
        parent::__construct();
        $this->load->model('Staff_model');
    }

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
/*	public function index()
	{
	    
		$this->load->view('staff/index.php');
	}*/
	
	/*
	* login
	*/
	public function login(){
	    $this->load->view('login');
	}
	
	
	/*
	* register page
	*/
	public function register(){
	    $this->load->view('register');
	}
	
	/*
	* Redirect to the dashboard page
	*/
// 	public function dashboard(){
	    
// 	    if($_SESSION['is_staff_loggedin'] == '1'){
// 	        $this->load->back_template($this->view_path."dashboard");    
// 	    }else{
// 	        redirect('staff/login');
// 	    }
	    
	    
	    
// 	}

		public function dashboard()
	{
	    if($_SESSION['is_staff_loggedin'] == '1')
	    {
	         $cid=$_SESSION['course_id'];
	         $data['quiz'] = $this->Staff_model->fetchAllQuiz();
	        $data['activeQuiz'] = $this->Staff_model->getTotalActiveQuiz($cid);
	        $data['allQuiz'] = $this->Staff_model->getQuizCount($cid);
	        $data['allSub'] = $this->Staff_model->getSubjectCount();
	        $data['delQuiz'] = $this->Staff_model->getTotalDeletedQuiz();
	        $data['subWiseCount'] = $this->Staff_model->getSubjectWiseQuizCount();
	        $data['userCount']=$this->Staff_model->getUserCount();
	        $data['studResult']=$this->Staff_model->getStudResult();
	        $data['topics'] = $this->Staff_model->gettopicCount($cid);
	        $data['topics'] = $this->Staff_model->gettopicCount($cid);
	        $data['units'] = $this->Staff_model->getunitCount($cid);
	        $data['syllabus'] = $this->Staff_model->getsyllabusCount($cid);
	        $this->load->back_template($this->view_path."dashboard",$data);
	        
	    }
	    else
	    {
	        redirect('staff/login');
	    }
	}
		public function getTopicQuestions()
    {
        if($_SESSION['is_staff_loggedin'] == '1'){
            
            $qst_type=$this->input->post('qst_type');
            $topic_name=$this->input->post('topic_name');
            $res= $this->AdminModel->fetchtopicsquestions($topic_name);
            echo json_encode($res);
        }else{
	        redirect('staff/login');
	    }
    }

    /*
    *
    */
    public function insert_user(){
        $this->load->back_template($this->view_path."add_new_user");    
    }
    
	/*
	* add user in admin
	*/
	public function insert_new_user(){
	    $email = $this->input->post('email');
	    $password = encrypt_script($this->input->post('password'));
	    $username = $this->input->post('username');
	    $role = $this->input->post('role');
	    
	    $userAr = array(
	        'username' => $username,
	        'email' => $email,
	        'password' => $password,
	        'role' => $role,
	        'created_at' => date('Y-m-d H:i:s'),
	        'is_deleted' => 0,
	        'status' => 1
	        );
	    $dataAr = $this->Staff_model->add_User($userAr);
	    if($dataAr){
	        redirect('admin/alluser');
	    }
	}
	
	/*
	* all user list 
	*/
	public function alluser(){
	    $data['users'] = $this->Staff_model->fetchAllUser();
	    $this->load->back_template($this->view_path."stafflist",$data);    
	}
	
	/*
	* Redirect to the Course list page
	*/
	public function allCourse()
	{
	    $data['courses'] = $this->Staff_model->fetchAllCourse();
	    $this->load->back_template($this->view_path."all_course",$data);
	}
	
	/*
	* Redirect to the add Course page
	*/
	public function addCourse()
	{
	    $this->load->back_template($this->view_path."add_new_course");
	}
	/* insert new course i db */
	
	public function insert_course()
	{
       
        $course = $this->input->post('course_name');
        $status = $this->input->post('status');
        $array = array('course_name' => $course,'status' => $status);
        $data = $this->Staff_model->add_course($array);
        if($data)
        {
            redirect('admin/allCourse');
        }
        else
        {
            $this->addCourse();
        }
    }
    
	/*
	* Redirect to the Course list page
	*/
	public function allTopics()
	{
	    $data['topics'] = $this->Staff_model->fetchAlltopics_staffwise();
	    $data['course'] = $this->Staff_model->fetchCourse();
	    $this->load->back_template($this->view_path."all_topics_staff",$data); 
	}
	
		public function allUnits()
	{
	    $data['topics'] = $this->Staff_model->fetchAllunits_staffwise();
	    $data['course'] = $this->Staff_model->fetchCourse();
	    $this->load->back_template($this->view_path."all_units_staff",$data); 
	}
	
	/*   Add New Topic view */
	
	public function addTopic()
	{
	    $data['course'] = $this->Staff_model->fetchCourse();
	    $this->load->back_template($this->view_path."add_new_topic_staff",$data);
	}
	/* insert new topi in db */
	
	public function insert_topic()
	{
	    $today = date("Y-m-d H:i:s"); 
        $data = array(
            'course_id' => $this->input->post('course_id'),
            'topic_name' =>$this->input->post('topic_name'),
            'created_at'=>$today,
            'active' => $this->input->post('status'),
            'is_deleted' => 0,
            'quiz_type_id' => $this->input->post('qst_type')
            ); 
        $result = $this->Staff_model->add_new_topic($data);
        if($result)
        {
            redirect('staff/allTopics');
        }
        else
        {
            $this->addTopic();
        }
	}
	
		public function DeleteTopic($id)
	{
	    if($_SESSION['is_staff_loggedin'] == '1')
	    {
	        $id;
    	    $result=$this->Staff_model->DeleteTopic($id);
    	    if($result)
               {
                    redirect('staff/allTopics'); 
               }
               
	    }
	    else
	    {
	        redirect('staff/login');
	    }
	}
	
	 /* edit topic  */
    
    public function edit_topic()
    {
        if($_SESSION['is_staff_loggedin'] == '1'){
            $id = $this->uri->segment(3);
            $data['topicdetails'] = $this->Staff_model->get_topic($id);
            $data['course'] = $this->Staff_model->fetchAllCourse();
            $this->load->back_template($this->view_path."edit_topic_staff",$data);
           
        }
        else{
	        redirect('staff/login');
	    }
    }
	/*   update topic by ID */
	 public function update_topic()
    {
        if($_SESSION['is_staff_loggedin'] == '1'){
            
            $res=$this->Staff_model->update_topic($_POST);
            if($res)
            {
                //$data['msg']='Topic Updated Successfully..!';
               redirect('staff/allTopics'); 
    	        
            }
            else
            {
                $data['msg']='Error';
                redirect('staff/allTopics'); 
            }
        }
        else{
	        redirect('staff/login');
	    }
    }
	
	
	
	/*
	* Redirect to the quiz list page
	*/
	public function allQuiz_staffwise()
	{
	    $data['quiz'] = $this->Staff_model->fetchAllQuiz();
	    $this->load->back_template($this->view_path."all_quiz_list_staffwise",$data);
	}
	/* select quiz with previous questions /New questions      */
	public function newQuiz()
	{
	   // print_r($_POST);
	   // exit;
	    if($_SESSION['is_staff_loggedin'] == '1'){
    	    if(!empty($_POST['quiz']))
    	    {
        	    $data['course'] = $this->AdminModel->fetchCourse();
                $data['quizType'] = $this->AdminModel->fetchQuizType();
        	    if($_POST['quiz']=='new_que')
        	    {
        	      
        	        $this->load->back_template($this->view_path."quiz_with_new_questions",$data);
        	    }
        	    else
        	    {
        	       
        	        $this->load->back_template($this->view_path."quiz_with_previous_questions",$data);
        	    }
    	    }
    	    else
    	    {
    	        $this->login();
    	    }
	    }else{
	        redirect('staff/login');
	    }
	}
	
	/* insert quiz with new questions   */
	public function insert_new_quiz()
	{
	    $result = $this->Staff_model->add_New_Quiz($_POST);
        if($result)
        {
            redirect('staff/allQuiz_staffwise');
        }
	}
	
	/* insert quiz with previous questions   */
	public function insert_quiz_previous_question()
	{
	    if($_SESSION['is_staff_loggedin'] == '1'){
    	    $res= $this->AdminModel->insert_quiz_with_previous_questions($_POST);
            if($res)
            {
                $data['quiz'] = $this->AdminModel->fetchAllQuiz();
        	    $data['msg']='New Quiz Added Successfuly..!';
        	     redirect('staff/allQuiz_staffwise');
        	   // $this->load->back_template($this->view_path."all_quiz_list_staffwise",$data);
            }
            else
            {
                $data['quiz'] = $this->AdminModel->fetchAllQuiz();
        	    $data['msg']='Please Try again...!';
        	     redirect('staff/allQuiz_staffwise');
        	   // $this->load->back_template($this->view_path."all_quiz_list_staffwise",$data);
            }
	    }else{
	        redirect('admin/login');
	    }
	}
	
	
	public function editQuiz()
	{
	    if($_SESSION['is_staff_loggedin'] == '1'){
	        $id = $this->uri->segment(3);
	        $data['quizdetails'] = $this->Staff_model->getQuizDetails($id) ;
            $this->load->back_template($this->view_path."editQuiz_staff",$data);
	        
	    }else{
	        redirect('staff/login');
	    }
	}
	
	

	
	
	/*  Redirect to profile page */
	public function editprofile()
	{
	   $id=$_SESSION['id'];
        $data['staffData'] = $this->Staff_model->getStaffUserDetails($id) ;
         $this->load->back_template($this->view_path."profile",$data);
	}
	
	public function profileupdate()
	{
	  $username=$this->input->post('first_name');
	  $email=$this->input->post('email');
	  $id=$_SESSION['id'];
	  $data=array(
	      "username"=>$username,
	      "email"=>$email
	      );
	     // print_r($data);die; 
	      $id = $this->Staff_model->updateStaffUserDetails($id,$data) ; 
	      redirect(base_url()."staff/editprofile"); 
	}
	
	public function change_password()
	{
	  $new_password=$this->input->post('new_password');
	  $password=encrypt_script($new_password);
	  $id=$_SESSION['id'];
	  $data=array(
	      "password"=>$password
	      );
	     // print_r($data);die; 
	      $id = $this->Staff_model->updateStaffPassword($id,$password); 
	      redirect(base_url()."staff/editprofile"); 
	}
	
	/*  Logout function  */
	public function staff_logout()
	{
        $this->session->sess_destroy();
        $this->session->set_userdata('is_staff_loggedin', false);
        redirect('staff/login');
	    
	}
	
		/*
	* Redirect to the all questions page
	*/
	public function allQuestions()
	{
	    if($_SESSION['is_staff_loggedin'] == '1'){ 
	       
    	    $data['questions']= $this->Staff_model->fetchAllQuestion_staffwise();
    	    $this->load->back_template($this->view_path."all_question_list",$data);
	    }else{
	        redirect('staff/login');
	    }
	}
	/* Add new question */
	public function addQuestions()
	{
	    if($_SESSION['is_staff_loggedin'] == '1'){ 
            $data['course'] = $this->Staff_model->fetchCourse();
            $this->load->back_template($this->view_path."add_new_question",$data);
	    }else{
	        redirect('staff/login');
	    }
	}
	
	public function getTopicList()
    {
        if($_SESSION['is_staff_loggedin'] == '1'){
            $topic=$this->input->post('att_type');
            $course=$this->input->post('sub');
            $res= $this->Staff_model->fetchtopics($topic,$course);
            echo json_encode($res);
        }else{
	        redirect('staff/login');
	    }
    }
	
	/*  insert new question in db  */
	
	public function insert_new_question()
	{
	    if($_SESSION['is_staff_loggedin'] == '1'){
            $data = array(
                'course_id' => $this->input->post('subject'),
                'question' =>$this->input->post('question'),
                'option_1' =>$this->input->post('answer_1'),
                'option_2' => $this->input->post('answer_2'),
                'option_3' =>$this->input->post('answer_3'),
                'option_4' => $this->input->post('answer_4'),
                'correct_option' =>$this->input->post('correct_answer') ,
                 'qst_type' =>$this->input->post('qst_type'),
                 'qst_attribute_name' =>$this->input->post('attribute_name'), 
                );
               // print_r($data);die;
            $result = $this->Staff_model->add_Question($data);
            if($result)
            {
                redirect(base_url()."staff/allQuestions");
               // $this->allQuestions();
            }
	    }else{
	        redirect('staff/login');
	    }
	}
}
?>