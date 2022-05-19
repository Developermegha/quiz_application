<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller {
    
    var $view_path = 'student/';
    var $action = 'student/';
    
    public function __construct(){
        parent::__construct();
        $this->load->model('Studentmodel','studentmodel');
        $this->load->model('Adminmodel','Adminmodel');
    }
  
    /*
    * student dashboard
    */
    public function index(){
        
        $this->load->view('login');
    }
    
     /*
    * register students
    */
    public function register_student(){
        
        $firstname = $this->input->post('first_name');
        $lastname = $this->input->post('last_name');
        $username = $this->input->post('user_name');
        $email = $this->input->post('email');
        $mobile = $this->input->post('mobile');
        $otp = $this->input->post('otp');
        $password = $this->input->post('password');
        $retype_password = $this->input->post('retype_password');
        
        if(empty($email)  || empty($password) || empty($username) || empty($retype_password) || empty($firstname)  || empty($username)  ){
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
            'user_name' => $username,
            'first_name' => $firstname,
            'last_name' => $lastname,
            'mobile' => $mobile,
            'email' => $email,
            'password' => encrypt_script($password),
            'is_active' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            
        
        );
        
        $result = $this->studentmodel->addNewStudent($dataAr);
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
    * student register
    */
    public function register(){
        $this->load->view('student_register');
    }
  
      
    /*
    * student dashboard
    */
    public function dashboard(){
        
        if($_SESSION['is_student_loggedin'] == true){
            $student_id         = $this->session->userdata['id'];
	        $data['activeCount'] = $this->studentmodel->getTotalActiveQuizCount();
	        $data['allQuizs'] = $this->studentmodel->getQuizCount();
	        $data['activeQuiz'] = $this->studentmodel->getActiveQuizList();
	        $data['attemtedStudentCount'] = $this->studentmodel->getAttemptedStudentCount();
	        $data['studentAttemptedQuizResult'] = $this->studentmodel->getstudentQuizsResult($student_id);
	       // echo "<pre>";
	       // print_r($data);
	       // exit();
	          $quizId = $this->studentmodel->getLastActiveQuiz($student_id);
	          if($quizId){
	              $data['quizdata'] = $this->studentmodel->getQuizData($quizId->id);
	              $data['allstudents'] = $this->studentmodel->getAllStudentMarks($quizId->id); 
	              
	              $single_mark=($data['quizdata']->max_marks/$data['quizdata']->number_of_questions);
	              $sorts = array();	
	              foreach($data['allstudents'] as $key => $value){
	                  $correctMarks=($value->correct_ans*$single_mark);
	                  $totalNegmarks=($value->incorrect_ans*$data['quizdata']->negative_marks);
	                  $finalresult=($correctMarks-$totalNegmarks); 
	                  $per=($finalresult/$data['quizdata']->max_marks)*100;
	                  $value->finalscore  = $finalresult;
	                  $value->percentage  = $per;
	                  $sorts['finalscore'][$key] = $value->finalscore;
	                  
	              }
	              //print_r($data['allstudents']);
	              //print_r($sorts);
	              array_multisort($sorts['finalscore'], SORT_DESC,$data['allstudents']);
	              $data['sorts'] = $sorts;
	        
	          }
	          
	            //exit();
     
	        $this->load->back_template($this->view_path."dashboard",$data);
	        
	    }else{
	        redirect('student/login');
	    }
    }
    
       	public function getTopicList()
    {
        
            $topic=$this->input->post('att_type');
            $course=$this->input->post('sub');
            $res= $this->AdminModel->fetchtopics($topic,$course);
            echo json_encode($res);
        
    }
    
    /*
    * edit student profile
    */
    public function editProfile(){
        if($_SESSION['is_student_loggedin'] == true){
            $studentId = getSessionData('id');
            $data['studentAr'] = $this->studentmodel->getStudentDetails($studentId);
            $data['bronze_awards'] = $this->studentmodel->getbronzecount($studentId);
             $data['silver_awards'] = $this->studentmodel->getsilvercount($studentId);
              $data['gold_awards'] = $this->studentmodel->getgoldcount($studentId);
               $data['platinum_awards'] = $this->studentmodel->getplatinumcount($studentId);
            $this->load->back_template($this->view_path."profile",$data);
        }else{
              redirect('student/login');
        }
    }
    
    /*
    * send sms of otp to the mobile 
    */
    public function sendSmsOtp(){
        
           $apikey = "NjtxLSp4y0yXpWDCLukERA";
        $apisender = "TRAEDU";
        $otp = rand(1000, 9999);
        $for = "registration";
        $msg = "Your login otp for $for is $otp.

        Thank you for choosing Transworld Educare.";
        $mobile_number = $this->input->post('mobile_number');
        $send_sms_otp_result = $this->studentmodel->send_sms_otp($mobile_number, $otp);
        $num = "91".$mobile_number; // MULTIPLE NUMBER VARIABLE PUT HERE...!
        $ms = rawurlencode($msg); //This for encode your message content
        $url = 'https://www.smsgatewayhub.com/api/mt/SendSMS?APIKey=' . $apikey . '&senderid=' . $apisender . '&channel=2&DCS=0&flashsms=0&number=' . $num . '&text=' . $ms . '&route=1';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 2);
        $data = curl_exec($ch);
        /* result of API call*/
        $data = json_decode($data, TRUE);
        if ($data['ErrorMessage'] == "Success") {
            $result = true;
        } else {
            // $result['message'] = "Fail";
            $result = false;
        }
        echo json_encode($result);
        die;  
        
    }
    
    /*
    * verify the correct otp is enter
    */
    public function checkOtpExists(){
        $otp = $this->input->post('otp');
        $mobile = $this->input->post('mobile');
        $result = $this->studentmodel->check_otp_exists($mobile, $otp);
        echo json_encode($result);   
    }
    
    /*
    * check the username exits or not
    */
    public function checkUserNameExists() {
        $user_name = $this->input->post('user_name');
        $result = $this->studentmodel->check_user_name_exists($user_name);
        echo json_encode($result);
    }
    
    /*
    * check the email exits or not
    */
    public function checkEmailExists() {
        $email = $this->input->post('email');
        $result = $this->studentmodel->check_email_exists($email);
        echo json_encode($result);
    }
    
    /*
    * update student data
    */
    public function updateDetail(){
        
        $id= $this->uri->segment(3);
        $dataAr = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'user_name' => $this->input->post('user_name'),
            'email' => $this->input->post('email'),
            'mobile' => $this->input->post('mobile'),
            );
            
        $update = $this->studentmodel->updateStudentData($dataAr,$id);
        if($update){
            redirect('student/editprofile');
            }
    }
    
    /*
    * change password method
    */
    public function change_password(){
        
        
        $oldpassword = $this->input->post('old_password');
        $newpassword = encrypt_script($this->input->post('new_password'));
        $id = $this->input->post('id');
        
        
        $result = $this->studentmodel->updatepassword($id,$newpassword);
        if($result){
            redirect('student/editprofile');
        }
        
    }
    
    
    /*
    * quiz list
    */
    public function quizlist(){
        $studentid = $this->session->userdata['id']; 
        $data['quizlist'] =  $this->studentmodel->getActiveQuizList();
       $data['quizresult'] = $this->studentmodel->getQuizResult($studentid);
        $this->load->back_template($this->view_path."quizlist",$data);
    }
    
    /* all quiz with filter*/
    public function getAllQuiz(){
        $data['quiz'] = $this->AdminModel->fetchAllQuiz();
        $data['courses'] = $this->AdminModel->fetchAllCourse();
        $this->load->back_template($this->view_path."all_quiz_list",$data);
    }
    
    /*
    * quiz screen 
    */
    public function quiz_screen(){
        
        if($_SESSION['is_student_loggedin'] == true){
            $quizid = $this->uri->segment('3');
            
            $StudentSessionId         = $this->session->userdata['id'];
            $data['QuizTypeId']       = $this->uri->segment('3');
            
            
                if(isset($data['QuizTypeId'])){
                    $data['quizinfo'] = $this->studentmodel->getQuizByid($data['QuizTypeId']); 
                    $data['getAttempt'] = $this->studentmodel->getTotalAttempt($data['QuizTypeId'],$StudentSessionId); 
                    }else{
                    $data['quizinfo'] =  "Please select the Quiz Type";
                }
                
            $this->load->view('student/quiz_screen',$data);
        }else{
              redirect('student/login');
        }
    }
    
    /*
    * ajax call to set all question
    * of the quiz 
    */
    // public function set_question(){

    //     $quiz_id                  = $this->input->post('quiz_id');
    //     $studentid                = $this->session->userdata['id'];
    //     $total_number_of_question = $this->input->post('total_number_of_question');
    //     // $mark_for_review          = ''

    //     $this->db->select('*');
    //     $this->db->from('questionset');
    //     $this->db->where('quiz_id', $quiz_id );  
    //     $this->db->limit($total_number_of_question);
    //     $this->db->order_by('id','asc');
    //     $query = $this->db->get(); 
        

    //     $total_number_of_question_quiz_id=  $query->result_array();
        
        
    //     $questionset = array();
    //     // shuffle($total_number_of_question_quiz_id);
    //     foreach ($total_number_of_question_quiz_id as  $value) {
            
    //         $questionset[]  =   $value['id'];
    //         $data = array(
    //             'quiz_id'               => $this->input->post('quiz_id'),
    //             'student_id'            => $this->input->post('studentid'),
    //             'qset_id'                  => $value['id'],
    //             'questions_status_id'   => 7
    //             );
    //         $get_question_id = $this->studentmodel->student_insert_question($data, $total_number_of_question);
        
    //     }
        
    //     // student_quiz_result insert
    //     // $dataAr = array(
    //     //     'quiz_id' => $this->input->post('quiz_id'),
    //     //     'student_id' => $this->input->post('studentid'),
    //     //     'attempts' => 1,
    //     //     'quiz_status' => 3,//in-progress
    //     //     'created_at' => date('Y-m-d H:i:s'),,
    //     //     'is_deleted' => 0,
    //     //     'quiz_result' => ''
    //     //     );
    //     // $insertquiz = $this->studentmodel->insertQuizAttempt($dataAr);
        
        
    //     // $arrayQuestionReverse = array_reverse($questionset);
    //     $this->db->select('questionset.* , quiz.id as quizprimaryId, quiz.selected_answer, quiz.mark_for_review');
    //     $this->db->from('questionset', 'quiz');
    //     $this->db->join('quiz', 'quiz.quiz_id = questionset.quiz_id');
    //     // $this->db->where( 'quiz.student_id =',$studentid);
    //     $this->db->where( 'questionset.quiz_id =',$quiz_id);
        
    //     $this->db->limit(1);
    //     $query = $this->db->get();
    //     // echo $this->db->last_query();
    //     $all_question_questionId = $query->result_array();

    //     echo json_encode($all_question_questionId);
       

    // }
       public function set_question(){

         $quiz_id                  = $this->input->post('quiz_id');
         $studentid                = $this->session->userdata['id'];
         $total_number_of_question = $this->input->post('total_number_of_question');
            //  $mark_for_review          = 

         $this->db->select('*');
         $this->db->from('questionset');
         $this->db->where('quiz_id', $quiz_id );  
         $this->db->limit($total_number_of_question);
         $query = $this->db->get(); 
        

         $total_number_of_question_quiz_id=  $query->result_array();
         $questionset = array();
        
         $getAttempt = $this->studentmodel->getTotalAttempt($quiz_id,$studentid); 
         ++$getAttempt;
        //  shuffle($total_number_of_question_quiz_id);
         foreach ($total_number_of_question_quiz_id as  $value) {
         
          $questionset[]  =   $value['id'];


          $data = array(
             'quiz_id'               => $this->input->post('quiz_id'),
             'student_id'            => $this->input->post('studentid'),
             'qset_id'                  => $value['id'],
             'questions_status_id'   => 7,
             'status' => 2,         //1- completed  , 2 -inprogress 
             'attempt'  =>$getAttempt
          );
         $get_question_id = $this->studentmodel->student_insert_question($data, $total_number_of_question);
        
      }
          $arrayQuestionReverse = array_reverse($questionset);
       // echo "<pre>";print_r($arrayQuestionReverse);"</pre>";die;
         $this->db->select('questionset.* ,quiz.id as quizprimaryId, quiz.selected_answer, quiz.mark_for_review,quiz_images.*');
         $this->db->from('questionset', 'quiz');
         $this->db->join('quiz', 'quiz.qset_id = questionset.id');
          $this->db->join('quiz_images','quiz_images.question_id = quiz.qset_id','LEFT');
         $this->db->where( 'quiz.qset_id =',$questionset[0]);
         $this->db->where( 'quiz.student_id =',$studentid);
         $this->db->where_not_in('quiz.status',1);
         $this->db->limit(1);
         $query = $this->db->get();
         // echo $this->db->last_query();
         $all_question_questionId = $query->result_array();

         // echo "<pre>";print_r($this->db->last_query());"</pre>";die;

          echo json_encode($all_question_questionId);
         // echo "<pre>";print_r($this->db->last_query());"</pre>";die;

     }
    
    /*
    * pass the selected answer 
    * to udpate in the quiz given 
    * by student
    */
//  
    public function questionSequence(){

        $questionSequence = $this->input->post('questionSequence');
        $studentid                = $this->session->userdata['id'];
        $quizid = $this->input->post('quizid');

        $this->db->select('questionset.* , quiz.id as quizprimaryId');
        $this->db->from('questionset', 'quiz');
        $this->db->join('quiz', 'quiz.qset_id = questionset.id');
        
        $this->db->where('quiz.quiz_id',$quizid);
        $this->db->where('quiz.student_id',$studentid);
        $this->db->where_not_in('quiz.status',1);
        $this->db->order_by('questionset.id','Asc');
        $query = $this->db->get(); 
        // echo $this->db->last_query();
        $result = $query->result_array();
        // print_r(range(1, count($result)));
        // echo "<pre>";
        // print_r(array_values($result));
        
        $FilteredquestionSequence = array_combine(range(1, count($result)), array_values($result));
     
        echo json_encode( $FilteredquestionSequence[$questionSequence] );    
        
     

    }
    
    /*
    * get the next question of the quiz
    */
    public function get_question_next_and_prev(){

        $quizId          = $this->input->post('quizId');
        $pageId          = $this->input->post('pageId');
        $question_id     = $this->input->post('QuestionId');
        $buttonAction    = $this->input->post('buttonAction');
        $quizPrimaryId   = $this->input->post('quizPrimaryId');
        $submitedAnswer  = $this->input->post('submitedAnswer');
        $StudentSessionId= $this->session->userdata['id']; 
        
        if($buttonAction ==  'redirect'){
             $resultRedirect = $this->studentmodel->get_question_redirect( $question_id,$quizId, $submitedAnswer,$pageId,$quizPrimaryId );
             echo json_encode($resultRedirect);
             die;   
        }    

        if($submitedAnswer != "" ){

            $this->db->select('negative_marks,max_marks,number_of_questions');
            $this->db->from('quiz_master');
            $this->db->where('id' , $quizId );
            $query = $this->db->get();
            $quizeResult = $query->result_array();

            $this->db->select('correct_option');
            $this->db->from('questionset');
            $this->db->where('quiz_id' , $quizId );
            $this->db->where('id' , $question_id );
            $query = $this->db->get();
            
            $result = $query->result_array();

        
            if($result[0]['correct_option'] == $submitedAnswer){
            
                $questionWiseMarks =   $quizeResult[0]['max_marks'] / $quizeResult[0]['number_of_questions']; 
                $this->db->where('id', $quizPrimaryId);
                // $this->db->where('qset_id', $question_id);
                $this->db->where('quiz_id', $quizId);
                $this->db->where('student_id', $StudentSessionId);
                $this->db->set('selected_answer', $submitedAnswer);
                $this->db->set('marks', $questionWiseMarks);
                 $this->db->where_not_in('status',1);
                $this->db->set('questions_status_id', 5);
                $this->db->update('quiz');   
                // echo $this->db->last_query();

            }else {
    
                $this->db->where('id', $quizPrimaryId);
                // $this->db->where('qset_id', $question_id);
                $this->db->where('student_id', $StudentSessionId);
                $this->db->where('quiz_id', $quizId);
                $this->db->set('marks', $quizeResult[0]['negative_marks']);
                $this->db->set('selected_answer', $submitedAnswer);
                $this->db->set('questions_status_id', 9);
                 $this->db->where_not_in('status',1);
                $this->db->update('quiz');
                

            }
             
            $this->db->where('id', $quizPrimaryId);
            // $this->db->where('qset_id', $question_id);
            $this->db->where('student_id', $StudentSessionId);
            $this->db->set('correct_answer', $result[0]['correct_option']);
             $this->db->where_not_in('status',1);
            $this->db->update('quiz');

        }
        // exit();

        if( $buttonAction == 'next'){
           $result =  $this->studentmodel->get_question_next($question_id,$quizId, $submitedAnswer, $pageId,$quizPrimaryId);
        }else if ($buttonAction == 'prev' ){
            $result = $this->studentmodel->get_question_prev($question_id,$quizId, $submitedAnswer ,$pageId,$quizPrimaryId );
        }else if($buttonAction == 'review'){
             $result = $this->studentmodel->get_question_review($question_id,$quizId, $submitedAnswer,$pageId,$quizPrimaryId );
        }else if($buttonAction == 'unreview'){
             $result = $this->studentmodel->get_question_unreview($question_id,$quizId, $submitedAnswer,$pageId,$quizPrimaryId );
        }else if($buttonAction == 'submit'){
            $result = $this->studentmodel->submit_answer_of_student($pageId,$quizId, $submitedAnswer, $question_id );
        }
        echo json_encode($result);
        die;
    }
    
    /*
    * update 
    */
    public function updateQuestionPalletStatus(){
        $quizPrimaryId  = $this->input->post('quizPrimaryId');
        $getSubmittedStatus = $this->studentmodel->updateQuestionPalletStatus( $quizPrimaryId );
        echo json_encode($getSubmittedStatus);
        die;
    }
    
    public function submitFinalAnswer(){

       // echo "<pre>";print_r($_POST);"</pre>";die;
        
        $quizId          = $this->input->post('quizId');
        $pageId          = $this->input->post('pageId');
        $question_id     = $this->input->post('questionId');
        $quizPrimaryId   = $this->input->post('quizPrimaryId');
        $submitedAnswer  = $this->input->post('submitedAnswer');
        $StudentSessionId= $this->session->userdata['id'];



        if($submitedAnswer != "" ){

            $this->db->select('negative_marks,max_marks,number_of_questions');
            $this->db->from('quiz_master');
            $this->db->where('id' , $quizId );
            $query = $this->db->get();
            $quizeResult = $query->result_array();

    
            $this->db->select('correct_option');
            $this->db->from('questionset');
            $this->db->where('quiz_id' , $quizId );
            $this->db->where('id' , $question_id );
            $query = $this->db->get();
            $result = $query->result_array();
            // echo $this->db->last_query();
            // print_r($result[0]['correct_option']);
            // print_r($submitedAnswer);
            if($result[0]['correct_option'] == $submitedAnswer){

                $questionWiseMarks =   $quizeResult[0]['max_marks'] / $quizeResult[0]['number_of_questions']; 
                // $this->db->where('id', $quizPrimaryId);
                $this->db->where('qset_id', $question_id);
                $this->db->where('quiz_id', $quizId);
                $this->db->where('student_id', $StudentSessionId);
                $this->db->set('selected_answer', $submitedAnswer);
                $this->db->set('marks', $questionWiseMarks);
                $this->db->set('questions_status_id', 5);
                 $this->db->where_not_in('status',1);
                $this->db->set('correct_answer', $result[0]['correct_option']);
                $this->db->update('quiz'); 
                // echo $this->db->last_query();

            }else {

                $this->db->where('id', $quizPrimaryId);
                $this->db->where('qset_id', $question_id);
                $this->db->where('student_id',$StudentSessionId );
                $this->db->where('quiz_id', $quizId);
                $this->db->set('marks', $quizeResult[0]['negative_marks']);
                $this->db->set('selected_answer', $submitedAnswer);
                $this->db->set('questions_status_id', 9);
                 $this->db->where_not_in('status',1);
                $this->db->update('quiz');

            }
            // exit();
            
            
          
        }

        $getSubmittedAnswer = $this->studentmodel->submit_answer_of_student($pageId,$quizId, $submitedAnswer, $question_id );
        echo json_encode($getSubmittedAnswer);
        die;
    }

    public function countPendingAnswer(){
        $quizId = $this->input->post('quizId');
        
        $countPendingAnswer = $this->studentmodel->countPendingAnswer( $quizId );
        
        echo json_encode($countPendingAnswer);


    }
    
    /*
    update quiz attempt
    
    */
    public  function updateResultAttempt()
    {
          $quizId = $this->input->post('quizId');
        $StudentSessionId= $this->session->userdata['id'];
          //get the student attempts from the tb 
            $getstudentatttemt = $this->studentmodel->getStudentAttemptsCount($quizId,$StudentSessionId);
            
            $totalattempt = ++$getstudentatttemt;
            $studResult = $this->AdminModel->getStudResult($StudentSessionId,$quizId);
            $this->AdminModel->attempts = $studResult[0]['attempt'];
            $correctAns=$this->AdminModel->fetchResultByStudentAnsweredCorrectly($StudentSessionId,$quizId,$studResult[0]['number_of_questions']);
            $incorrectAns=$this->AdminModel->fetchResultByStudentAnsweredInCorrectly($StudentSessionId,$quizId,$studResult[0]['number_of_questions']);
            $unAns=$this->AdminModel->fetchResultByStudentUnAnswered($StudentSessionId,$quizId,$studResult[0]['number_of_questions']);
            
               $datas['quizdata'] = $this->studentmodel->getQuizData($quizId);
                 $single_mark=($datas['quizdata']->max_marks/$datas['quizdata']->number_of_questions);
	          $sorts = array();	
	        
	              $correctMarks=($correctAns*$single_mark);
	              $totalNegmarks=($incorrectAns*$datas['quizdata']->negative_marks);
	               $finalresult=($correctMarks-$totalNegmarks); 
	               $per=($finalresult/$datas['quizdata']->max_marks)*100;
	        
            // print_r($correctAns);
            // print_r($incorrectAns);
            
              /* add the result of quiz in table*/
            $dataArr = array(
                'quiz_id' => $quizId,
                'student_id' => $StudentSessionId,
                'attempts' => $totalattempt,
                'quiz_status' => 1,
                'is_deleted' =>'0',
                'created_at' => date('Y-m-d H:i:s'),
                'correct_ans' => $correctAns,
                'incorrect_ans' =>$incorrectAns ,
                'unanswered' =>$unAns,
                'quiz_result' =>$per."%"
                );
                
              
// $date1=($studResult[0]['responded_time']);
//     $date2=date('Y-m-d H:i:s');
//     $diff=date_diff($date1,$date2);
//     $interval = $diff->format("%R%a days");
// $min = $interval->i;
             
//              $date_expire = $studResult[0]['responded_time'];    
// $date = new DateTime($date_expire);
// $now = new DateTime();

// $min = $date->diff($now)->format("%i min");


            //   $this->db->where('id', $quizPrimaryId);
                // $this->db->where('qset_id', $question_id);
                $this->db->where('quiz_id', $quizId);
                $this->db->where('student_id', $StudentSessionId);
                $this->db->set('status',1);
                $this->db->set('responded_time', date('Y-m-d H:i:s'));
                
                $this->db->update('quiz'); 
                // echo $this->db->last_query();
                // exit();
              
          //student_quiz_result
            $insertResult = $this->studentmodel->insertQuizResult($dataArr);
            $data['msg'] ="success";
            
            echo json_encode($data);
      
    }
    
    
    /*
    */
    public function updatetimerCountDownSubmitAnswer(){
        // echo "<pre>";print_r($_POST);"</pre>";die;
        $quizId          = $this->input->post('quizId');
        $pageId          = $this->input->post('pageId');
        $question_id     = $this->input->post('questionId');
        $quizPrimaryId   = $this->input->post('quizPrimaryId');
        $submitedAnswer  = $this->input->post('submitedAnswer');
        $StudentSessionId= $this->session->userdata['id'];



        if($submitedAnswer != "" ){

            $this->db->select('negative_marks,max_marks,number_of_questions');
            $this->db->from('quiz_master');
            $this->db->where('id' , $quizId );
            $query = $this->db->get();
            $quizeResult = $query->result_array();

            $this->db->select('correct_option');
            $this->db->from('questionset');
            $this->db->where('quiz_id' , $quizId );
            $this->db->where('id' , $question_id );
            $query = $this->db->get();
            $result = $query->result_array();

            if($result[0]['correct_option'] == $submitedAnswer){

                $questionWiseMarks =   $quizeResult[0]['max_marks'] / $quizeResult[0]['number_of_questions']; 
                $this->db->where('id', $quizPrimaryId);
                $this->db->where('qset_id', $question_id);
                $this->db->where('quiz_id', $quizId);
                $this->db->where('student_id', $StudentSessionId);
                $this->db->set('selected_answer', $submitedAnswer);
                $this->db->set('marks', $questionWiseMarks);
                $this->db->set('questions_status_id', 5);
                $this->db->update('quiz');   

            }else {

                $this->db->where('id', $quizPrimaryId);
                $this->db->where('qset_id', $question_id);
                $this->db->where('student_id', $StudentSessionId);
                $this->db->where('quiz_id', $quizId);
                $this->db->set('marks', $quizeResult[0]['negative_marks']);
                $this->db->set('selected_answer', $submitedAnswer);
                $this->db->set('questions_status_id', 9);
                $this->db->update('quiz');

            }
             
            $this->db->where('id', $quizPrimaryId);
            $this->db->where('qset_id', $question_id);
            $this->db->where('student_id', $StudentSessionId);
            $this->db->set('correct_answer', $result[0]['correct_option']);
            $this->db->update('quiz');

        }

        $getSubmittedAnswer = $this->studentmodel->submit_answer_of_student_timerEndsUp($pageId,$quizId, $submitedAnswer, $question_id );
        echo json_encode($getSubmittedAnswer);
        die;

    }
    
    /*
    * quiz result scrren dispaly
    */
    public function quizresult(){
        $quizId = $this->uri->segment('3');
        
        $studentid = $this->session->userdata['id'];
        $data['quizresult'] = $this->studentmodel->getQuizResultById($studentid,$quizId);
        $this->load->view('student/result_screen');
    }

    public function countDownTimer(){
        $quizId = $this->input->post('quizId');

        $this->db->select('quiz_total_time');
        $this->db->from('quiz_master');
        $this->db->where('id' , $quizId);
        $query = $this->db->get();
        $result = $query->result_array();
        $duration = "";
            foreach ($result as  $value) {
                $duration = $value;

            }
           $sesionDusration   = $this->session->set_userdata('duration', $duration['quiz_total_time']);
           $sessionStarTime   = $this->session->set_userdata('start_time',date("Y-m-d H:i:s") );
           $end_time          = date('Y-m-d H:i:s' , strtotime('+'.$sesionDusration.'miniutes',strtotime( $sessionStarTime ) ) );
           $sessionEndTime    = $this->session->set_userdata('end_time',$end_time );
          
           $fromTime   = date("Y-m-d H:i:s");
           $toTime     = $this->session->userdata('end_time');

           $convertIntoStrtotimeFromTime = strtotime($fromTime);
           $convertIntoStrtotimeToTime   = strtotime($toTime);

           $difernceInSecond             = $convertIntoStrtotimeToTime - $convertIntoStrtotimeFromTime;

           $timer = gmdate("i:s" , $difernceInSecond );

          // echo "<pre>";print_r($timer);"</pre>";die; 
           echo json_encode($timer);  
           die;



    }

    
    /*
    * student logout
    */
    public function student_logout(){
        $this->session->sess_destroy();
        $this->session->set_userdata('is_student_loggedin', false);
        redirect('student/login');
    }
    
    /* quiz result page  view */
    public function quiz_result()
    {
        
        if($_SESSION['is_student_loggedin'] == '1')
        {
              $quizId = $this->uri->segment('3');
            $studentid = $this->session->userdata['id'];
            $attempt = $this->uri->segment('4');
            
    	    $data['studResult']=$this->AdminModel->getStudentResult($studentid,$quizId,$attempt);
    	    $this->load->back_template($this->view_path."quiz_result",$data);
	    }
	    else
	    {
	        redirect('admin/login');
	    }
    }
    
    
    /*
    * quiz screen testing
    */
    public function quiz_screen_testing(){
        
        if($_SESSION['is_student_loggedin'] == true){
            $quizid = $this->uri->segment('3');
            
            $StudentSessionId         = $this->session->userdata['id'];
            $data['QuizTypeId']       = $this->uri->segment('3');
            
            
                if(isset($data['QuizTypeId'])){
                    $data['quizinfo'] = $this->studentmodel->getQuizByid($data['QuizTypeId']); 
                    $data['getAttempt'] = $this->studentmodel->getTotalAttempt($data['QuizTypeId'],$StudentSessionId); 
                    }else{
                    $data['quizinfo'] =  "Please select the Quiz Type";
                }
              
             // print_r($data['quizinfo']);die;  
            $this->load->view('student/quiz_screenn',$data);
        }else{
              redirect('student/login');
        }
    }
    
    // end of testing
    
    
    
       //testing purpose
    
    /* public function set_question(){

         $quiz_id                  = $this->input->post('quiz_id');
         $studentid                = $this->session->userdata['id'];
         $total_number_of_question = $this->input->post('total_number_of_question');
          $mark_for_review          = '';

         $this->db->select('*');
         $this->db->from('questionset');
         $this->db->where('quiz_id', $quiz_id );  
         $this->db->limit($total_number_of_question);
         $this->db->order_by('id','asc');
         $query = $this->db->get(); 
        

         $total_number_of_question_quiz_id=  $query->result_array();
        
        
         $questionset = array();
          shuffle($total_number_of_question_quiz_id);
         foreach ($total_number_of_question_quiz_id as  $value) {
            
             $questionset[]  =   $value['id'];
             $data = array(
                 'quiz_id'               => $this->input->post('quiz_id'),
                 'student_id'            => $this->input->post('studentid'),
                 'qset_id'                  => $value['id'],
                 'questions_status_id'   => 7
                 );
             $get_question_id = $this->studentmodel->student_insert_question($data, $total_number_of_question);
        
         }
        
        //  student_quiz_result insert
          $dataAr = array(
              'quiz_id' => $this->input->post('quiz_id'),
              'student_id' => $this->input->post('studentid'),
              'attempts' => 1,
              'quiz_status' => 3,
              'created_at' => date('Y-m-d H:i:s'),
              'is_deleted' => 0,
              'quiz_result' => '' 
              );
          $insertquiz = $this->studentmodel->insertQuizAttempt($dataAr);
        
        
          $arrayQuestionReverse = array_reverse($questionset);
         $this->db->select('questionset.* , quiz.id as quizprimaryId, quiz.selected_answer, quiz.mark_for_review');
         $this->db->from('questionset', 'quiz');
         $this->db->join('quiz', 'quiz.quiz_id = questionset.quiz_id');
          $this->db->where( 'quiz.student_id =',$studentid);
         $this->db->where( 'questionset.quiz_id =',$quiz_id);
        
         $this->db->limit(1);
         $query = $this->db->get();
          echo $this->db->last_query();
         $all_question_questionId = $query->result_array();

         echo json_encode($all_question_questionId);
       

     }*/
    
    
    public function result(){
        
        $this->load->back_template($this->view_path."result_screen");
    }
 
    public function leaderboard(){
        
        $student_id         = $this->session->userdata['id'];
        $data['quizlist'] =  $this->studentmodel->getActiveQuizList();
//         $quizId = $this->studentmodel->getLastActiveQuiz($student_id);
//         $data['quizdata'] = $this->studentmodel->getQuizData($quizId->id);
//         $data['allstudents'] = $this->studentmodel->getAllStudentMarks($quizId->id);
//         $single_mark=($data['quizdata']->max_marks/$data['quizdata']->number_of_questions);
        
// 		$sorts = array();	
//         foreach($data['allstudents'] as $key => $value){
//             $correctMarks=($value->correct_ans*$single_mark);
//             $totalNegmarks=($value->incorrect_ans*$data['quizdata']->negative_marks);
//             $finalresult=($correctMarks-$totalNegmarks); 
//             $value->finalscore  = $finalresult;
//               $sorts['finalscore'][$key] = $value->finalscore;

//         }
//         array_multisort($sorts['finalscore'], SORT_DESC,$data['allstudents']);
//         $data['sorts'] = $sorts;
     
        $this->load->back_template($this->view_path."leaderboard2",$data);
    }
    
    
    protected function applyFilter()
	{
		if($this->input->post("quizfilter") != "")
		{
			$this->studentmodel->quizId = $this->input->post("quizfilter");
			
		}
	
	}
	
    /*
    * get leaderboard list quiz wise
    */
    public function getLeaderboardListQuizWise(){
        
        $this->applyfilter();
        
        $student_id         = $this->session->userdata['id'];
        $quizId = $this->studentmodel->getLastActiveQuiz($student_id);
        if($this->input->post("quizfilter") != "")
		{
			$quizId->id = $this->input->post("quizfilter");
			
		}
        $datas['quizdata'] = $this->studentmodel->getQuizData($quizId->id);
        $id = $quizId->id;
        $this->studentmodel->quizId = $id;
        $allstudents = $this->studentmodel->get_datatables();
        $single_mark=($datas['quizdata']->max_marks/$datas['quizdata']->number_of_questions);
        
// 		
		$data=array();
		$no = $_POST['start']+1;
// 		echo "<pre>";
// 		print_r($allstudents);
// 		exit();
		foreach ($allstudents as $key => $admindata)
		{
			$row[]=array();
			$row["DT_RowId"] = ($admindata->id);
			$row["no"] = $no;
			$row["full_name"]=$admindata->user_name;
			$row["quiz_name"]=$admindata->quiz_name;
// 			$data['quizdata'] = $this->studentmodel->getQuizData($quizId->id);
			 $correctMarks=($admindata->correct_ans*$single_mark);
            $totalNegmarks=($admindata->incorrect_ans*($datas['quizdata']->negative_marks));
            $finalresult=($correctMarks-$totalNegmarks); 
            $admindata->finalscore  = $finalresult;
               $sorts['finalscore'][$key] = $admindata->finalscore;

			$row["finalscore"]= round($admindata->finalscore,2);
			$row['tropy']= '<img class="animation__shake" src="https://kingsinternational.academy/quiz_application/assets/img/trophy.jpg" height="60" width="60">';
		    $row['action'] = '<td><a href="'.base_url('student/quiz_result/').$admindata->quiz_id.'/'.$admindata->attempts.'" class="btn btn-sm btn-info">
                                        <i class="fa fa-eye" aria-hidden="true"></i>View
                                    </a></td>';
			$data[]=$row;
			$no++;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->studentmodel->count_all('active'),
			"recordsFiltered" => $this->studentmodel->count_filtered('active'),
			"data" => $data,
		
		);

		//output to json format
		echo json_encode($output);
    }
    
    
    public function single_quiz_result($quizid)
    {
         
        $studentid = $this->session->userdata['id'];
        $quizid= $quizid;
        $data['studResult']=$this->studentmodel->getStudentResult($studentid,$quizid);
    	$this->load->back_template($this->view_path."quiz_result",$data); 
    }
    
    
    
}
