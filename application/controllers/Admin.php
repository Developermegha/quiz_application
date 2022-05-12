<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    
    var $view_path = 'admin/';
    var $action = 'admin/';
    
    public function __construct(){
        parent::__construct();
        $this->load->model('AdminModel');
        $this->load->library('upload');
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
	 /* function to check status of quiz    */
	public function index()
	{
	    
		$today = date("Y-m-d H:i:s");  
        $CI = & get_instance(); 
        $status = $CI->AdminModel->updateQuizStatusByDate($today);
        return $status;
	}
	
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
	public function dashboard()
	{
	    if($_SESSION['is_admin_loggedin'] == '1')
	    {
	        $data['activeQuiz'] = $this->AdminModel->getTotalActiveQuiz();
	        $data['allQuiz'] = $this->AdminModel->getQuizCount();
	        $data['allSub'] = $this->AdminModel->getSubjectCount();
	        $data['delQuiz'] = $this->AdminModel->getTotalDeletedQuiz();
	        $data['subWiseCount'] = $this->AdminModel->getSubjectWiseQuizCount();
	        $data['userCount']=$this->AdminModel->getUserCount();
	        //$data['studResult']=$this->AdminModel->getStudResult();
	        $data['qst_physio']=$this->AdminModel->getQst_physio();
	         $data['qst_biochem']=$this->AdminModel->getQst_biochem();
	          $data['qst_physics']=$this->AdminModel->getQst_physics();
	           $data['qst_bio']=$this->AdminModel->getQst_bio();
	       // print_r($data['qst_physio']);die;
	        $this->load->back_template($this->view_path."dashboard",$data);
	        
	    }
	    else
	    {
	        redirect('admin/login');
	    }
	}
	/*   active quiz list */
	
	public function activeQuiz()
	{
	    if($_SESSION['is_admin_loggedin'] == '1')
	    {
	        $status = $this->uri->segment(3);
	        $data['status']=$status;
	        $data['activeQuiz'] = $this->AdminModel->getTotalActiveQuizList();
	        $data['deactiveQuiz'] = $this->AdminModel->getTotalDeletedQuizList();
	        $data['subWiseQuiz'] = $this->AdminModel->getSubjectWiseQuizCount();
	        $data['topicWiseQuiz'] = $this->AdminModel->getTopicWiseQuizCount();
	        $this->load->back_template($this->view_path."active_quiz_list",$data);
	        
	    }
	    else
	    {
	        redirect('admin/login');
	    }
	}


    /*
    *
    */
    public function insert_user(){
        if($_SESSION['is_admin_loggedin'] == '1')
        {
            $data['courses'] = $this->AdminModel->fetchAllCourse();
            $this->load->back_template($this->view_path."add_new_user",$data); 
        }
        else
        {
	        redirect('admin/login');
	    }
    }
    
	/*
	* add user in admin
	*/
	public function insert_new_user(){
	    if($_SESSION['is_admin_loggedin'] == '1'){
	        if(!empty($this->input->post('course')))
	        {
	            $course_id=$this->input->post('course');
	        }
	        else
	        {
	            $course_id='0';
	        }
    	    $email = $this->input->post('email');
    	    $password = encrypt_script($this->input->post('password'));
    	    $username = $this->input->post('username');
    	    $role = $this->input->post('role');
    	    $status = $this->input->post('status');
    	    
    	    $userAr = array(
    	        'username' => $username,
    	        'email' => $email,
    	        'password' => $password,
    	        'role' => $role,
    	        'status' => $status,
    	        'created_at' => date('Y-m-d H:i:s'),
    	        'is_deleted' => 0,
    	        'course_id'=>$course_id,
    	        
    	        );
    	    $dataAr = $this->AdminModel->add_User($userAr);
    	    if($dataAr){
    	        redirect('admin/alluser');
	        }
	    }else{
	        redirect('admin/login');
	    }
	}
	
	/*
	* all user list 
	*/
	public function alluser(){
	    if($_SESSION['is_admin_loggedin'] == '1'){
    	    $data['users'] = $this->AdminModel->fetchAllUser();
    	    $this->load->back_template($this->view_path."stafflist",$data);
	    }else{
	        redirect('admin/login');
	    }
	}
	
	/*
	* Redirect to the Course list page
	*/
	public function allCourse()
	{
	    if($_SESSION['is_admin_loggedin'] == '1'){
    	    $data['courses'] = $this->AdminModel->fetchAllCourse();
    	    $data['msg']='';
    	    $this->load->back_template($this->view_path."all_course",$data);
	    }else{
	        redirect('admin/login');
	    }
	}
	
	/*
	* Redirect to the add Course page
	*/
	public function addCourse()
	{
	     if($_SESSION['is_admin_loggedin'] == '1'){
	        $this->load->back_template($this->view_path."add_new_course");
	     }else{
	        redirect('admin/login');
	    }
	}
	/* insert new course i db */
	
	public function insert_course()
	{
        if($_SESSION['is_admin_loggedin'] == '1'){
            $course = $this->input->post('course_name');
            $status = $this->input->post('status');
            $array = array('course_name' => $course,'status' => $status);
            $res = $this->AdminModel->add_course($array);
            if($res)
            {
                $data['msg']='Subject Added Successfully..!';
                $data['courses'] = $this->AdminModel->fetchAllCourse();
    	        $this->load->back_template($this->view_path."all_course",$data);
            }
            else
            {
                $data['msg']='Error..!';
                $data['courses'] = $this->AdminModel->fetchAllCourse();
    	        $this->load->back_template($this->view_path."all_course",$data);
            }
        }else{
	        redirect('admin/login');
	    }
    }
    
    /*  Edit subject/Course  */
    
    public function edit_course()
	{
        if($_SESSION['is_admin_loggedin'] == '1'){
            $id=$this->input->post('id');
            $data = $this->AdminModel->get_course($id);
            echo json_encode($data);
        }
        else{
	        redirect('admin/login');
	    }
	}
	public function update_course()
	{
	    if($_SESSION['is_admin_loggedin'] == '1'){
           
            
            $res= $this->AdminModel->update_course($_POST);
            if($res)
            {
                $data['msg']='Course Updated Successfully..!';
                $data['courses'] = $this->AdminModel->fetchAllCourse();
    	        $this->load->back_template($this->view_path."all_course",$data);
            }
            else
            {
                $data['msg']='Error';
                $data['courses'] = $this->AdminModel->fetchAllCourse();
    	        $this->load->back_template($this->view_path."all_course",$data);
            }
            
            
        }
        else{
	        redirect('admin/login');
	    }
	}
	
	/*   delete Subject */
	public function DeleteSub()
	{
	    if($_SESSION['is_admin_loggedin'] == '1')
	    {
	        $id=$this->input->post('id');
    	    $result=$this->AdminModel->DeleteSub($id);
    	    if($result)
               {
                    $res = array('success' => 1,'msg' => " Record Deleted Successfully...");
                    echo json_encode($res);
               }
               else
               {
                    $res = array('error' => 0,'msg' => "Error...");
                    echo json_encode($res);
               } 
	    }
	    else
	    {
	        redirect('admin/login');
	    }
	}
	
	/*
	* Redirect to the Topic list page
	*/
	public function allTopics()
	{
	    if($_SESSION['is_admin_loggedin'] == '1'){
    	    $data['topics'] = $this->AdminModel->fetchAlltopics();
    	    $data['course'] = $this->AdminModel->fetchAllCourse();
    	    $this->load->back_template($this->view_path."all_topics",$data);
	    }else{
	        redirect('admin/login');
	    }
	}
	
	/*   Add New Topic view */
	
	public function addTopic()
	{
	    if($_SESSION['is_admin_loggedin'] == '1'){
    	    $data['course'] = $this->AdminModel->fetchAllCourse();
    	    $this->load->back_template($this->view_path."add_new_topic",$data);
	    }else{
	        redirect('admin/login');
	    }
	}
	/* insert new topi in db */
	
	public function insert_topic()
	{
    	if($_SESSION['is_admin_loggedin'] == '1'){
    	    $today = date("Y-m-d H:i:s"); 
            $data = array(
                'course_id' => $this->input->post('course_id'),
                'topic_name' =>$this->input->post('topic_name'),
                'created_at'=>$today,
                'active' => $this->input->post('status'),
                'is_deleted' => 0,
                'quiz_type_id' => $this->input->post('qst_type')
                ); 
            $result = $this->AdminModel->add_new_topic($data);
            if($result)
            {
                redirect('admin/allTopics');
            }
            else
            {
                $this->addTopic();
            }
    	}else{
	        redirect('admin/login');
	    }
	}
	
	/*  delete topic  */
	public function DeleteTopic()
	{
	    if($_SESSION['is_admin_loggedin'] == '1')
	    {
	        $id=$this->input->post('id');
    	    $result=$this->AdminModel->DeleteTopic($id);
    	    if($result)
               {
                    $res = array('success' => 1,'msg' => " Topic Deleted Successfully...");
                    echo json_encode($res);
               }
               else
               {
                    $res = array('error' => 0,'msg' => "Error...");
                    echo json_encode($res);
               } 
	    }
	    else
	    {
	        redirect('admin/login');
	    }
	}
	
	 /* edit topic  */
    
    public function edit_topic()
    {
        if($_SESSION['is_admin_loggedin'] == '1'){
            $id = $this->uri->segment(3);
            $data['topicdetails'] = $this->AdminModel->get_topic($id);
            $data['course'] = $this->AdminModel->fetchAllCourse();
            $this->load->back_template($this->view_path."edit_topic",$data);
           
        }
        else{
	        redirect('admin/login');
	    }
    }
	/*   update topic by ID */
	 public function update_topic()
    {
        if($_SESSION['is_admin_loggedin'] == '1'){
            
            $res=$this->AdminModel->update_topic($_POST);
            if($res)
            {
                $data['msg']='Topic Updated Successfully..!';
                $data['topics'] = $this->AdminModel->fetchAlltopics();
    	        $data['course'] = $this->AdminModel->fetchAllCourse();
    	        $this->load->back_template($this->view_path."all_topics",$data);
    	        
            }
            else
            {
                $data['msg']='Error';
                $data['topics'] = $this->AdminModel->fetchAlltopics();
    	        $data['course'] = $this->AdminModel->fetchAllCourse();
    	        $this->load->back_template($this->view_path."all_topics",$data);
            }
        }
        else{
	        redirect('admin/login');
	    }
    }
	
	
	/*
	* Redirect to the quiz list page
	*/
	public function allQuiz()
	{
	    if($_SESSION['is_admin_loggedin'] == '1'){
    	    $data['quiz'] = $this->AdminModel->fetchAllQuiz();
    	    $data['msg']='';
    	    $this->load->back_template($this->view_path."all_quiz_list",$data);
	    }else{
	        redirect('admin/login');
	    }
	}
	/* select quiz with previous questions /New questions      */
	public function newQuiz()
	{
	   // print_r($_POST);
	   // exit;
	    if($_SESSION['is_admin_loggedin'] == '1'){
    	    if(!empty($_POST['quiz']))
    	    {
        	    $data['course'] = $this->AdminModel->fetchCourse();
                $data['quizType'] = $this->AdminModel->fetchQuizType();
        	    if($_POST['quiz']=='new_que')
        	    {
        	      
        	        //$this->load->back_template($this->view_path."quiz_with_new_questions",$data);
        	         $this->load->back_template($this->view_path."quiz_with_new_questions_new",$data);
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
	        redirect('admin/login');
	    }
	}
	
	/* insert quiz with new questions   */
	public function insert_new_quiz()
	{
	   
	    if($_SESSION['is_admin_loggedin'] == '1'){
	        
	        if($_POST['total_questions']>1)
	        {
	            if(isset($_FILES['question_img']) || isset($_FILES['answer_img']))
    	        {
    	            foreach($_FILES['question_img']['tmp_name'] as $key => $tmp_name)
                    {
                        $file_name = $_FILES['question_img']['name'][$key];
                        //$file_size =$_FILES['question_img']['size'][$key];
                        $file_tmp =$_FILES['question_img']['tmp_name'][$key];
                        //$file_type=$_FILES['question_img']['type'][$key];  
                        move_uploaded_file($file_tmp, "uploads/".$file_name);
                        
                    }
                    foreach($_FILES['answer_img']['tmp_name'] as $key => $tmp_name)
                    {
                        $file_name = $_FILES['answer_img']['name'][$key];
                      // $file_size =$_FILES['answer_img']['size'][$key];
                        $file_tmp =$_FILES['answer_img']['tmp_name'][$key];
                        //$file_type=$_FILES['answer_img']['type'][$key];  
                        move_uploaded_file($file_tmp, "uploads/".$file_name);
                    }
    	        }
    	        $result = $this->AdminModel->add_New_Quiz($_POST);
    	        //$result = $this->AdminModel->add_New_Quiz1($_POST);
                if($result)
                {
                    $data['quiz'] = $this->AdminModel->fetchAllQuiz();
            	    $data['msg']='New Quiz Added Successfuly..!';
            	    $this->load->back_template($this->view_path."all_quiz_list",$data);
                    //redirect('admin/allQuiz');
                }
                else
                {
                    $data['quiz'] = $this->AdminModel->fetchAllQuiz();
            	    $data['msg']='Please Try again...!';
            	    $this->load->back_template($this->view_path."all_quiz_list",$data);
                }
	        }
	        else
	        {
	            $result = $this->AdminModel->add_New_Quiz_Without_Questions($_POST);
                if($result)
                {
                    $data['quiz'] = $this->AdminModel->fetchAllQuiz();
            	    $data['msg']='New Quiz without Questions Added Successfuly..!';
            	    $this->load->back_template($this->view_path."all_quiz_list",$data);
                    //redirect('admin/allQuiz');
                }
                else
                {
                    $data['quiz'] = $this->AdminModel->fetchAllQuiz();
            	    $data['msg']='Please Try again...!';
            	    $this->load->back_template($this->view_path."all_quiz_list",$data);
                }
	        }
	    }
	    else
	    {
	        redirect('admin/login');
	    }
	}
	
	/* insert quiz with previous questions   */
	public function insert_quiz_previous_question()
	{
	    if($_SESSION['is_admin_loggedin'] == '1'){
    	    $res= $this->AdminModel->insert_quiz_with_previous_questions($_POST);
            if($res)
            {
                $data['quiz'] = $this->AdminModel->fetchAllQuiz();
        	    $data['msg']='New Quiz Added Successfuly..!';
        	    $this->load->back_template($this->view_path."all_quiz_list",$data);
            }
            else
            {
                $data['quiz'] = $this->AdminModel->fetchAllQuiz();
        	    $data['msg']='Please Try again...!';
        	    $this->load->back_template($this->view_path."all_quiz_list",$data);
            }
	    }else{
	        redirect('admin/login');
	    }
	}
		/* Redirect to edit quiz with id   */
	public function editQuiz()
	{
	    if($_SESSION['is_admin_loggedin'] == '1'){
	        $id = $this->uri->segment(3);
	        $data['quizdetails'] = $this->AdminModel->getQuizDetails($id) ;
            $this->load->back_template($this->view_path."editQuiz",$data);
	        
	    }else{
	        redirect('admin/login');
	    }
	}
	
	/*  change quiz status  */
	public function changeQuizStatus()
	{
	    if($_SESSION['is_admin_loggedin'] == '1'){
	       
	        $id=$this->input->post('id');
	        $status=$this->input->post('status');
	        $res=$this->AdminModel->UpdateQuizStatus($id,$status);
	        if($res)
            {
                $res = array('success' => 1,'msg' => "Quiz Status Updated Successfully...");
                echo json_encode($res);
            }
            else
            {
                $res = array('error' => 0,'msg' => "Error...");
                echo json_encode($res);
            } 
	    }else{
	        redirect('admin/login');
	    }
	}
	
	
	/* delete quiz      */
	public function deleteQuiz()
	{
	    if($_SESSION['is_admin_loggedin'] == '1'){
	       
	        $id=$this->input->post('id');
	        $res=$this->AdminModel->softDeleteQuiz($id);
	        if($res)
            {
                $res = array('success' => 1,'msg' => "Quiz Deleted Successfully...");
                echo json_encode($res);
            }
            else
            {
                $res = array('error' => 0,'msg' => "Error...");
                echo json_encode($res);
            } 
	    }else{
	        redirect('admin/login');
	    }
	}
	public function getTopicQuestions()
    {
        if($_SESSION['is_admin_loggedin'] == '1'){
            
            $qst_type=$this->input->post('qst_type');
            $topic_name=$this->input->post('topic_name');
            $res= $this->AdminModel->fetchtopicsquestions($topic_name);
            echo json_encode($res);
        }else{
	        redirect('admin/login');
	    }
    }
	/*
	* Redirect to the all questions page
	*/
	public function allQuestions()
	{
	    if($_SESSION['is_admin_loggedin'] == '1')
	    { 
    	    $data['questions']= $this->AdminModel->fetchAllQuestion();
    	    $data['msg']='';
    	    $this->load->back_template($this->view_path."all_question_list",$data);
	    }
	    else
	    {
	        redirect('admin/login');
	    }
	}
	/* Add new question */
	public function addQuestions()
	{
	    if($_SESSION['is_admin_loggedin'] == '1'){ 
	        $data['course'] = $this->AdminModel->fetchAllCourse(); 
	         $data['topic'] = $this->AdminModel->fetchAllTopic();
           $this->load->back_template($this->view_path."add_new_question",$data);
	    }else{
	        redirect('admin/login');
	    }
	}
	
	/*  insert new question in db  */
	
	public function insert_new_question()
	{
	    if($_SESSION['is_admin_loggedin'] == '1')
	    {
            $data = array(
                 'course_id' => $this->input->post('course_id'),
                'question' =>$this->input->post('question'),
                'option_1' =>$this->input->post('answer_1'),
                'option_2' => $this->input->post('answer_2'),
                'option_3' =>$this->input->post('answer_3'),
                'option_4' => $this->input->post('answer_4'),
                'correct_option' =>$this->input->post('correct_answer') ,
                'image_id' =>0 ,
                'topic_id' =>$this->input->post('topic_id') ,
                );
            $result = $this->AdminModel->add_Question($data);
            if($result)
            {
                $data['questions']= $this->AdminModel->fetchAllQuestion();
        	    $data['msg']='New Question Added Successfuly..!';
        	    $this->load->back_template($this->view_path."all_question_list",$data);
            }
            else
            {
                $data['questions']= $this->AdminModel->fetchAllQuestion();
        	    $data['msg']='Please Try again...!';
        	    $this->load->back_template($this->view_path."all_question_list",$data);
            }
	    }
	    else
	    {
	        redirect('admin/login');
	    }
	}
	
	public function getTopicList()
    {
        if($_SESSION['is_admin_loggedin'] == '1'){
            $topic=$this->input->post('att_type');
            $course=$this->input->post('sub');
            $res= $this->AdminModel->fetchtopics($topic,$course);
            echo json_encode($res);
        }else{
	        redirect('admin/login');
	    }
    }
	
	
	/*  Redirect to profile page */
	public function editprofile()
	{
	    if($_SESSION['is_admin_loggedin'] == '1'){
    	    $id = getSessionData('id');
            $data['adminData'] = $this->AdminModel->getUserDetails($id) ;
            
    	    $this->load->back_template($this->view_path."profile",$data);
	    }else{
	        redirect('admin/login');
	    }
	}
	
	
	/*
	* edit page for user details 
	*/
	public function editUser(){
	    
	    if($_SESSION['is_admin_loggedin'] == '1'){
    	    $id = $this->uri->segment('3');
            $data['userdetails'] = $this->AdminModel->getUserDetails($id) ;
            
    	    $this->load->back_template($this->view_path."edit_user",$data);
	    }else{
	        redirect('admin/login');
	    }
	}
	
	/*
	* udapte user by id 
	*/
	public function updateUser(){
	    if($_SESSION['is_admin_loggedin'] == '1'){
    	    $id = $this->uri->segment(3);
    	    $username = $this->input->post('username');
    	    $email = $this->input->post('email');
    	    $role = $this->input->post('role');
    	    $status = $this->input->post('status');
    	    
    	    
    	    $dataAr = array(
    	        'username' => $username,
    	        'email' => $email,
    	        'role' => $role,
    	        'status' => $status
    	        );
    	        
    	    $result = $this->AdminModel->updateAdminData($dataAr,$id);
    	    if($result){
    	        redirect('admin/allUsers');
    	    }
	    }else{
	        redirect('admin/login');
	    }
	}
	
	/*
	* update the profile 
	*/
	public function updateStudent(){
	    if($_SESSION['is_admin_loggedin'] == '1'){
    	    $username = $this->input->post('username');
    	    $email = $this->input->post('email');
    	    
    	    $dataAr = array(
    	        'username' => $username,
    	        'email' => $email
    	        );
    	    $id = getSessionData('id');
    	    $updateAr = $this->AdminModel->updateAdminData($dataAr,$id);
    	    if($updateAr){
    	        redirect('admin/editprofile');
    	    }
	    }else{
	        redirect('admin/login');
	    }
	}
	
    /*
    * delete student
    */	
    public function deleteStudent(){
        if($_SESSION['is_admin_loggedin'] == '1'){
            $id = $this->input->post('id');
            $deleteStudent = $this->AdminModel->deleteStudentById($id);
            if($deleteStudent){
                redirect('admin/allUsers');
            }
        }else{
	        redirect('admin/login');
	    }
    }
	
	/*  Logout function  */
	public function admin_logout()
	{
        $this->session->sess_destroy();
        $this->session->set_userdata('is_admin_loggedin', false);
        redirect('admin/login');
	    
	}
    
    
    /* quiz result page  view */
    public function quiz_result()
    {
        if($_SESSION['is_admin_loggedin'] == '1')
        {
    	    $sid=1;
    	    $quid=56;
    	    $data['studResult']=$this->AdminModel->getStudResult($sid,$quid);
    	    //$this->load->back_template($this->view_path."quiz_result",$data);
    	    $this->load->back_template($this->view_path."quiz_result1",$data);
	    }
	    else
	    {
	        redirect('admin/login');
	    }
    }
    
    /* insert quiz with new questions   */
	public function insert_new_quiz_update()
	{
	   
	    if($_SESSION['is_admin_loggedin'] == '1'){
	        
	        if($_POST['total_questions']>1)
	        {
	            if(isset($_FILES['question_img']) || isset($_FILES['answer_img']))
    	        {
    	            foreach($_FILES['question_img']['tmp_name'] as $key => $tmp_name)
                    {
                        $file_name = $_FILES['question_img']['name'][$key];
                        //$file_size =$_FILES['question_img']['size'][$key];
                        $file_tmp =$_FILES['question_img']['tmp_name'][$key];
                        //$file_type=$_FILES['question_img']['type'][$key];  
                        move_uploaded_file($file_tmp, "uploads/".$file_name);
                        
                    }
                    foreach($_FILES['answer_img']['tmp_name'] as $key => $tmp_name)
                    {
                        $file_name = $_FILES['answer_img']['name'][$key];
                      // $file_size =$_FILES['answer_img']['size'][$key];
                        $file_tmp =$_FILES['answer_img']['tmp_name'][$key];
                        //$file_type=$_FILES['answer_img']['type'][$key];  
                        move_uploaded_file($file_tmp, "uploads/".$file_name);
                    }
    	        }
    	        $result = $this->AdminModel->add_New_Quiz($_POST);
                if($result)
                {
                    $data['quiz'] = $this->AdminModel->fetchAllQuiz();
            	    $data['msg']='New Quiz Added Successfuly..!';
            	    $this->load->back_template($this->view_path."all_quiz_list",$data);
                    //redirect('admin/allQuiz');
                }
                else
                {
                    $data['quiz'] = $this->AdminModel->fetchAllQuiz();
            	    $data['msg']='Please Try again...!';
            	    $this->load->back_template($this->view_path."all_quiz_list",$data);
                }
	        }
	        else
	        {
	            $result = $this->AdminModel->add_New_Quiz_Without_Questions($_POST);
                if($result)
                {
                    $data['quiz'] = $this->AdminModel->fetchAllQuiz();
            	    $data['msg']='New Quiz without Questions Added Successfuly..!';
            	    $this->load->back_template($this->view_path."all_quiz_list",$data);
                    //redirect('admin/allQuiz');
                }
                else
                {
                    $data['quiz'] = $this->AdminModel->fetchAllQuiz();
            	    $data['msg']='Please Try again...!';
            	    $this->load->back_template($this->view_path."all_quiz_list",$data);
                }
	        }
	    }
	    else
	    {
	        redirect('admin/login');
	    }
	}
	
	
	/* Import questions excel ito db  */
    public function importFile()
    {
        $path = 'uploads/questions/';
        require_once APPPATH ."/third_party/PHPExcel.php";
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'xlsx|xls';
        $config['remove_spaces'] = true;
        $config['encrypt_name'] = true;
        $this->load->library('upload', $config); 
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('uploadFile'))
        {
            $error = array('error' => $this->upload->display_errors());
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
        }
        if (empty($error))
        {
            if (!empty($data['upload_data']['file_name']))
            {
                $import_xls_file = $data['upload_data']['file_name'];
            }
            else
            {
                $import_xls_file = 0;
            }
            $inputFileName = $path . $import_xls_file; 
            try
            {
                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
                $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                $flag = true;
                $i = 0;
                foreach ($allDataInSheet as $value)
                {
                    
                   $dataa = array('course_id' =>  $inserdata[$i]['course_id'] =  $value['A'], 'question' =>  $inserdata[$i]['question'] = $value['B'],'option_1' =>  $inserdata[$i]['option_1'] = $value['C'],'option_2' =>  $inserdata[$i]['option_2'] = $value['D'],'option_3' =>  $inserdata[$i]['option_3'] = $value['E'],'option_4' =>  $inserdata[$i]['option_4'] = $value['F'],'correct_option' =>  $inserdata[$i]['correct_option'] = $value['G']); 
                    
                      $result = $this->AdminModel->import_questions_xls($dataa);  
                
                   
                    $i++;
                }
                if ($result)
                {
                    $res = array('success' => true, 'msg' => "Successfully Imported");
                    echo json_encode($res);
                }
                else
                {
                    $res = array('success' => false, 'msg' => "Something went wrong please went wrong");
                    echo json_encode($res);
                }
              
            }
            catch(Exception $e)
            {
                die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
                $res = array('success' => false, 'msg' => $e);
                echo json_encode($res);
            }
        }
        else
        {
            $res = array('success' => false, 'msg' => $error['error']);
            echo json_encode($res);
        }
    }
    public function download_question_formate()
    {
       
        $this->load->helper('download');
        
        
        // $pth    =   file_get_contents("uploads/questions/Questions file Formate.xlsx");
        $pth    =   file_get_contents("uploads/questions/sample_questions_Add.xlsx");
        
        $nme    =   "Questions file Formate.xlsx";
        force_download($nme, $pth);
        redirect('admin/allQuestions');
        
    }
	
}
?>