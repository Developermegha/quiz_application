<?php 
class Studentmodel extends CI_Model{
    
    var $order = array('id' => 'asc');
	var $column_search = array('user_name');
	var $checkLimit = 0;
    
    /*
    * get student attempted quiz count
    */
    public function getStudentAttemtedQuiz(){
        $id = $this->session->userdata['id'];
        
        
    }
    
    /*
    *
    */
    public function getActiveQuizList(){
        
        // $date = date("Y-m-d H:i");
        // $beforestart = strtotime($date) + 1200;
        // $date = date("Y-m-d H:i:s", $beforestart);
        
        $response = array();
        $this->db->select('qm.*,qt.quiztype,c.course_name,t.topic_name');
        $this->db->from('quiz_master as qm');
        $this->db->join('course as c','c.id = qm.course_id','LEFT');
        $this->db->join('quiz_type as qt','qt.id = qm.type_id','LEFT');
        $this->db->join('topics as t','t.id = qm.topic_id AND t.is_deleted = 0 AND t.active =1','LEFT');
      
        $this->db->where('qm.active',1);
        $this->db->where('qm.is_deleted',0);
        // $this->db->where('qm.quiz_start_time <=',$date);
        // $this->db->where('qm.quiz_end_time >=',$date);
        $query = $this->db->get();
        // echo $this->db->last_query();
        if($query->num_rows() > 0){
            $response = $query->result();
        }
        return $response;
    }
    
    /*
    */
    public function getAttemptedStudentCount(){
        $this->db->select('count(quiz_id) as totalattempts');
        $this->db->from('student_quiz_result');
        $this->db->where('student_id',$this->session->userdata['id']);
        // $this->db->group_by('quiz_id');
        $query = $this->db->get();
        // echo $this->db->last_query();
    
        if($query->num_rows() > 0)
        {
            $response = $query->row()->totalattempts;
        }
        return $response;
        
    }
    
    /*
    * get total active quiz count
    */
    public function getTotalActiveQuizCount(){
        
        $this->db->select('count(id) as totalactive');
        $this->db->from('quiz_master');
        $this->db->where('active',1);
        $this->db->where('is_deleted',0);
        $query = $this->db->get();
        if($query->num_rows() > 0 ){
            $response = $query->row()->totalactive;
        }
        return $response;
    }
    
    /*
    * get total quiz count
    */
    public function getQuizCount(){
         $this->db->select('count(id) as totalQuiz');
        $this->db->from('quiz_master');
        $this->db->where('is_deleted',0);
        $query = $this->db->get();
        if($query->num_rows() > 0 ){
            $response = $query->row()->totalQuiz;
        }
        return $response;
    }
    
    /*
    * studnet not attempted quiz count
    */
    public function getNotAttemptedQuiz(){
        
    }
    
    /*
    * this function get student data
    */
    public function getStudentDetails($id){
        $response = array();
        if(!empty($id)){
            $this->db->select('*');
            $this->db->from('user');
            $this->db->where('is_active',1);
            $this->db->where('is_deleted',0);
            
            $this->db->where('id',$id);
            $query = $this->db->get();
            // echo $this->db->last_query();
            if($query->num_rows() > 0 ){
                $response = $query->row();
            }
        }
        return $response;
    }
    
    /*
    * insert the new student details in db
    */
    public function addNewStudent($data){
        $response = false;
        if(!empty($data)){
            $this->db->insert('user',$data);
            if($this->db->affected_rows() > 0 ){
                $response = true;
            }
        }
        return $response;
    }
    
    /*
    * check the otp enter by student is exits
    * or not in db
    */
    public function check_otp_exists($mobile, $otp ) {
        // this is 20 min ago time
        // $minute_ago = date("Y-m-d H:i:s", mktime(date("H"), date("i") - 20, date("s"), date("m"), date("d"), date("Y")));
        $this->db->select('registration_otp.otp');
        $this->db->from('registration_otp');
        $this->db->where('registration_otp.mobile', $mobile);
        $this->db->where('registration_otp.otp', $otp);
        // $this->db->where('registration_otp.created_at >=',  $minute_ago);
        $this->db->order_by('registration_otp.id',"desc");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    /*
    * check the duplicate record of username
    */
     public function check_user_name_exists($user_name) {
        $this->db->select('id');
        $this->db->from('user');
        $this->db->where('user_name', $user_name);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return false;
        } else {
            return true;
        }
    }


    /*
    */
    public function send_sms_otp($mobile_number, $otp) {
        $data = array('mobile' =>(int) $mobile_number, 'otp' => $otp);
        $insert_registration_otp = $this->db->insert('registration_otp', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    
    /*
    * check for the dublicate record of email
    */
    public function check_email_exists($email) {
        $this->db->select('id');
        $this->db->from('user');
        $this->db->where('email', $email);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return false;
        } else {
            return true;
        }
    }
    
    /*
    */
    public function getActiveQuiz(){
        $response = array();
        $this->db->select('qm.*,qt.quiztype,c.course_name,t.topic_name');
        $this->db->from('quiz_master as qm');
        $this->db->join('course as c','c.id = qm.course_id','LEFT');
        $this->db->join('quiz_type as qt','qt.id = qm.type_id','LEFT');
        $this->db->join('topics as t','t.id = qm.topic_id AND t.is_deleted = 0 AND t.active =1','LEFT');
        $this->db->where('qm.active',1);
        $this->db->where('qm.is_deleted',0);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $response = $query->result();
        }
        return $response;
        
    }
    
       /*
   * update data of student by id
   */
   public function updateStudentData($data,$id){
       $response = false;
       if(!empty($data) && !empty($id)){
           $this->db->set($data);
           $this->db->where('id',$id);
           $this->db->update('user');
           if($this->db->affected_rows() > 0){
               $response = true;
           }
       }
       return $response;
   }


    /*
    * get the quiz by id
    */
    public function getQuizByid($id)
    {
        $response = array();
        if(!empty($id)){
            $this->db->select('qm.*,q.attempt');
            $this->db->from('quiz_master as qm');
            $this->db->join('quiz as q','q.quiz_id = qm.id','LEFT');
            $this->db->where('qm.id',$id);
            
            $query = $this->db->get();
            // echo $this->db->last_query();
            if($query->num_rows() > 0){
                $response = $query->row();
            }
        }
        return $response;
        // exit();
    }
    
    
    /*
    
    */
    public function getTotalAttempt($quiz_id,$student_id){
        $response = 0;
        if(!empty($quiz_id) && !empty($student_id)){
            $this->db->select('attempts');
            $this->db->from('student_quiz_result');
            $this->db->where('quiz_id',$quiz_id);
            $this->db->where('student_id',$student_id);
            $this->db->order_by('id','desc');
            $this->db->limit(1);
            $query = $this->db->get();
            // echo $this->db->last_query();
            
            if($query->num_rows() > 0){
                $response = $query->row()->attempts;
            }
        }
        return $response;
    }
    
    /*
    * change password
    */
    public function updatepassword($id,$password){
        $response = false;
        if(!empty($id) && !empty($password)){
            $this->db->set('password',$password);
            $this->db->where('id',$id);
            $this->db->where('is_active',1);
            $this->db->update('user');
            if($this->db->affected_rows() >0){
                $response  =true;
            }
        }
        return $response;
    }
    
    
    /*
    *
    */
    public function getQuizResultById($id,$quizId,$attempt){
        $result = array();
        if(!empty($id) && !empty($quizId)){
            $this->db->select('*');
            $this->db->from('quiz');
            $this->db->where('student_id',$id);
            if($attempt == ''){
                $attempt = 0;
            }
            $this->db->where('attempt',$attempt);
            $this->db->where('status',1);
            $this->db->where('quiz_id',$quizId);
            $query  = $this->db->get();
            if($query->num_rows() >0){
                $result = $query->row();
            }
        }
        return $result;
    }
    
    
    
    public function getQuizResult($studentid){
      
            $this->db->select('*');
            $this->db->from('quiz');
            $this->db->where('student_id',$studentid);
           
          //  $this->db->where('attempt',$attempt);
            $this->db->where('status',1);
          //  $this->db->where('quiz_id',$quizId);
            $query  = $this->db->get();
            if($query->num_rows() >0){
                $result = $query->result_array();
            }
        
        return $result;
    }
    
    
    
    
    /*
    * get attempt count of student
    */
    public function getStudentAttemptsCount($quiz_id,$student_id){
        $response =0;
        if(!empty($quiz_id) && !empty($student_id)){
            $this->db->select('attempts');
            $this->db->from('student_quiz_result');
            $this->db->where('quiz_id',$quiz_id);
            $this->db->where('student_id',$student_id);
            $this->db->order_by('id','desc');
            $this->db->limit(1);
            $query = $this->db->get();
            // echo $this->db->last_query();
            if($query->num_rows() >0){
                $response = $query->row()->attempts;
            }
            return $response;
        }
    }
    
    /*
    * insert the result of quiz by studenttid
    */
    
    public function insertQuizResult($data)
    {
        $response = false;
        if(!empty($data)){
            $this->db->insert('student_quiz_result',$data);
            if($this->db->affected_rows() > 0){
                $response = true;
            }
        }
        return $response;
    }
    
    /*
    *
    */
    
    
    
    /* copy paste*/
    
        
    public function student_insert_question($data, $total_number_of_question)
    {
           $insertStudent          =  $this->db->insert('quiz', $data);
           $insert_id              = $this->db->insert_id();
           return                    $insert_id;
            
    }
    
    
    public function get_question_redirect( $questionId , $quizId, $submitedAnswer ,$pageId,$quizPrimaryId ){
            $StudentSessionId         = $this->session->userdata['id'];   
            $offset = ( $pageId - 1) * 1;
          
            
            $this->db->select('questionset.* , quiz.id as quizprimaryId,quiz.selected_answer,quiz.mark_for_review');
            $this->db->from('questionset', 'quiz');
            $this->db->join('quiz', 'quiz.q_id = questionset.id');
            $this->db->where('student_id', $StudentSessionId);
            $this->db->limit(1, $offset);
            $query = $this->db->get();  
            return  $query->result_array(); 
    
    }


    
    public function get_question_next($questionId , $quizId, $submitedAnswer, $pageId , $quizPrimaryId ){
    
    //echo "<pre>";print_r($quizPrimaryId);"</pre>";die;
    
       $offset = ( $pageId - 1) * 1;
       $StudentSessionId         = $this->session->userdata['id'];     
      
      if( $submitedAnswer == ""){
           $this->db->where('id', $quizPrimaryId);
           $this->db->where('quiz_id', $quizId);
           $this->db->where('student_id', $StudentSessionId);
           $this->db->set('selected_answer', '');
           $this->db->set('questions_status_id', 6);
           $this->db->where_not_in('quiz.status',1);
           $this->db->update('quiz');  
       }
    
    
       $this->db->select('questionset.*, quiz.id as quizprimaryId,quiz.selected_answer,quiz.mark_for_review');
       $this->db->from('questionset', 'quiz');
       $this->db->join('quiz', 'quiz.quiz_id = questionset.quiz_id');
        //  $this->db->join('quiz_images','quiz_images.question_id = quiz.qset_id','LEFT');
       $this->db->where('student_id', $StudentSessionId);
    //   $this->db->where_not_in('questionset.id',$questionId);
      $this->db->where('questionset.quiz_id',$quizId);
       $this->db->where_not_in('quiz.status',1);
       $this->db->limit(1, $offset);
       $query = $this->db->get(); 
        // echo $this->db->last_query();
       return  $query->result_array();  
    
    }
    
    
    public function get_question_prev($questionId , $quizId, $submitedAnswer,$pageId, $quizPrimaryId){
    
        $offset = ( $pageId - 1) * 1;
      
        $StudentSessionId         = $this->session->userdata['id'];   
    
       if( $submitedAnswer == ""){
           $this->db->where('id', $quizPrimaryId);
           $this->db->where('quiz_id', $quizId);
           $this->db->where('student_id', $StudentSessionId);
           $this->db->set('selected_answer', '');
           $this->db->set('questions_status_id', 6);
              $this->db->where_not_in('quiz.status',1);
           $this->db->update('quiz');  
       }
       
       $this->db->select('questionset.* ,quiz_images.*, quiz.id as quizprimaryId,quiz.selected_answer,quiz.mark_for_review');
       $this->db->from('questionset', 'quiz');
       $this->db->join('quiz', 'quiz.quiz_id = questionset.quiz_id');
    $this->db->join('quiz_images','quiz_images.question_id = quiz.qset_id','LEFT');
       $this->db->where('student_id', $StudentSessionId);
        $this->db->where('questionset.quiz_id',$quizId);
       $this->db->where_not_in('quiz.status',1);
       $this->db->order_by('questionset.id','asc');
        $this->db->limit(1, $offset);
    
       $query = $this->db->get();  
    // echo $this->db->last_query();
       return  $query->result_array(); 
    
    }
    
    
    
    public function get_question_review( $questionId , $quizId, $submitedAnswer,$pageId, $quizPrimaryId ){

        $offset = ( $pageId - 1) * 1;
        $StudentSessionId         = $this->session->userdata['id'];   
    
       if( $submitedAnswer != ""){
           $this->db->where('id', $quizPrimaryId);
           $this->db->where('quiz_id', $quizId);
           $this->db->where('student_id', $StudentSessionId);
           $this->db->set('mark_for_review', 8);
           $this->db->where_not_in('status',1);
           $this->db->update('quiz');     
       }else{
           $this->db->where('id', $quizPrimaryId);
           $this->db->where('quiz_id', $quizId);
           $this->db->where('student_id', $StudentSessionId);
           $this->db->set('selected_answer', '');
           $this->db->set('mark_for_review', 8);
           $this->db->where_not_in('status',1);
           $this->db->update('quiz');  
       }
    
    
       $this->db->select('questionset.* , quiz.id as quizprimaryId,quiz.selected_answer,quiz.mark_for_review');
       $this->db->from('questionset', 'quiz');
       $this->db->join('quiz', 'quiz.q_id = questionset.id');
       $this->db->where('student_id', $StudentSessionId);
          $this->db->where('questionset.quiz_id',$quizId);
       $this->db->where_not_in('quiz.status',1);
       $this->db->limit(1, $offset);
       $query = $this->db->get();  
       return  $query->result_array();
    
    }

    public function get_question_unreview( $questionId , $quizId, $submitedAnswer,$pageId, $quizPrimaryId ){
    
        $offset = ( $pageId - 1) * 1;
        $StudentSessionId         = $this->session->userdata['id'];   
    
       if( $submitedAnswer != ""){
           $this->db->where('id', $quizPrimaryId);
           $this->db->where('quiz_id', $quizId);
           $this->db->where('student_id', $StudentSessionId);
           $this->db->set('mark_for_review', '');
           $this->db->where_not_in('status',1);
           $this->db->update('quiz');     
       }else{
           $this->db->where('id', $quizPrimaryId);
           $this->db->where('quiz_id', $quizId);
           $this->db->where('student_id', $StudentSessionId);
           $this->db->set('selected_answer', '');
           $this->db->set('mark_for_review', '');
           $this->db->where_not_in('status',1);
           $this->db->update('quiz');  
       }
    
    
       $this->db->select('questionset.* , quiz.id as quizprimaryId,quiz.selected_answer,quiz.mark_for_review');
       $this->db->from('questionset', 'quiz');
       $this->db->join('quiz', 'quiz.q_id = questionset.id');
       $this->db->where('student_id', $StudentSessionId);
          $this->db->where('questionset.quiz_id',$quizId);
       $this->db->where_not_in('quiz.status',1);
       
       $this->db->limit(1, $offset);
       $query = $this->db->get();  
       return  $query->result_array();
    }
    
    /*
    * get the details of quiz id
    */   
    public function updateQuestionPalletStatus($quizPrimaryId){

        $this->db->select('id,questions_status_id,mark_for_review');
        $this->db->from('quiz');
        $this->db->where('id', $quizPrimaryId);  
        $query = $this->db->get();

        return  $query->result_array(); 
    }

    public function submit_answer_of_student( $pageId, $quizId, $submitedAnswer, $questionId ){
        $StudentSessionId         = $this->session->userdata['id'];
       // $offset = ( $pageId - 1) * 1; 
       // echo "<pre>";print_r($offset);"</pre>";die;

        if( $submitedAnswer == ""){
            $this->db->where('qset_id', $questionId);
            $this->db->where('quiz_id', $quizId);
            $this->db->set('selected_answer', '');
            $this->db->set('questions_status_id', 6);
            $this->db->where_not_in('status',1);
            $this->db->update('quiz'); 

        }

        $this->db->select('questionset.* , quiz.id as quizprimaryId,quiz.selected_answer,quiz.mark_for_review');
        $this->db->from('questionset', 'quiz');
        $this->db->join('quiz', 'quiz.qset_id = questionset.id');
        $this->db->where('student_id', $StudentSessionId);
        $this->db->where('questions_status_id', 7);
        $this->db->where_not_in('quiz.status',1);
        $this->db->or_where('questions_status_id', 9);
        
        $this->db->limit(1,$pageId);
        $query = $this->db->get(); 
        // echo "<pre>";print_r($this->db->last_query());"</pre>";die;
        // if($query->num_rows() > 0 ){
        //     // return  $query->result_array();   
        // }else{
            
        // }
        return true;
    }


    public function submit_answer_of_student_timerEndsUp( $pageId, $quizId, $submitedAnswer, $questionId ){
        $StudentSessionId         = $this->session->userdata['id'];
       // $offset = ( $pageId - 1) * 1; 
       // echo "<pre>";print_r($offset);"</pre>";die;

        if( $submitedAnswer == ""){
            $this->db->where('qset_id', $questionId);
            $this->db->where('quiz_id', $quizId);
            $this->db->set('selected_answer', '');
            $this->db->set('questions_status_id', 6);
            $this->db->update('quiz'); 

        }

        $this->db->select('questionset.* , quiz.id as quizprimaryId,quiz.selected_answer,quiz.mark_for_review');
        $this->db->from('questionset', 'quiz');
        $this->db->join('quiz', 'quiz.qset_id = questionset.id');
        $this->db->where('student_id', $StudentSessionId);
        $this->db->where('questions_status_id', 7);
        $this->db->where('questions_status_id', 9);
        $this->db->where_not_in('quiz.status',1);
        $this->db->limit(1,$pageId);
        $query = $this->db->get(); 
       // echo "<pre>";print_r($this->db->last_query());"</pre>";die;
        if($query->num_rows() > 0 ){
            return  $query->result_array();    
        }else{
            return true;
        }
    }
    
    public function countPendingAnswer($quizId){
        
        $data = array();
        $StudentSessionId         = $this->session->userdata['id'];
        
        $this->db->select('COUNT(questions_status_id) As questions_status');
        $this->db->from('quiz');
        $this->db->where('student_id', $StudentSessionId); 
        $this->db->where('quiz_id', $quizId); 
        $this->db->where('questions_status_id', 6); 
        $query = $this->db->get(); 
        $data['not_answered']  = $query->result_array();
        
        $this->db->select('COUNT(questions_status_id) As un_answered');
        $this->db->from('quiz');
        $this->db->where('student_id', $StudentSessionId); 
        $this->db->where('quiz_id', $quizId); 
        $this->db->where('questions_status_id', 7); 
        $query = $this->db->get(); 
        $data['un_answered']  = $query->result_array(); 
        
        $this->db->select('COUNT(questions_status_id) As correct_answered');
        $this->db->from('quiz');
        $this->db->where('student_id', $StudentSessionId); 
        $this->db->where('quiz_id', $quizId); 
        $this->db->where('questions_status_id', 5); 
        $query = $this->db->get(); 
        $data['correct_answered']  = $query->result_array(); 
        // echo $this->db->last_query();die;
        
        
        $this->db->select('COUNT(mark_for_review) As mark_for_review_question');
        $this->db->from('quiz');
        $this->db->where('student_id',$StudentSessionId); 
        $this->db->where('quiz_id', $quizId); 
        $this->db->where('mark_for_review', 8); 
        $query = $this->db->get(); 
        $data['mark_for_review']  = $query->result_array(); 
        
        return $data;
        
        
        }
        
        
        /*
        */
        
        public function getLastActiveQuiz(){
            $response = array();
            $this->db->select('qm.*');
            $this->db->from('quiz_master as qm');
            $this->db->join('student_quiz_result as sq','sq.quiz_id = qm.id','right');
            $this->db->where('qm.active',1);
            $this->db->where('qm.is_deleted',0);
            $this->db->order_by('qm.id','desc');
            $query = $this->db->get();
            if($query->num_rows() > 0){
                $response = $query->row();
            }
            return $response;
            
        }
        
        
        /*
        */
        public function getAllStudentMarks($quiz_id){
            
            $response = array();
            if(!empty($quiz_id)){
                $this->db->select('u.*,sqr.quiz_id,sqr.correct_ans,sqr.incorrect_ans,sqr.unanswered,qm.name as quiz_name');
                $this->db->from('user as u');
                $this->db->join('student_quiz_result as sqr','sqr.student_id = u.id','LEFT');
                $this->db->join('quiz_master as qm','qm.id = sqr.quiz_id','LEFT');
                $this->db->where('sqr.quiz_id',$quiz_id);
                $this->db->group_by('u.id');
                $query = $this->db->get();
                if($query->num_rows() > 0){
                    $response = $query->result();
                }
            }
            return $response;
        }
        
        
        /*
        *
        */
        public function getQuizData($quizId)
        {
            $response = array();
            if(!empty($quizId)){
                $this->db->select('*');    
                $this->db->from('quiz_master as qm');
                $this->db->join('student_quiz_result as sq','sq.quiz_id = qm.id','Left');
                $this->db->where('qm.id',$quizId);
                $query = $this->db->get();
                if($query->num_rows() > 0){
                    $response = $query->row();
                }
            }
            return $response;
            
            
        }
        
        /*
        * get all quiz result attempted by student
        */
        public function getstudentQuizsResult($student_id){
            $response = array();
            if(!empty($student_id)){
                $this->db->select('u.*,sqr.quiz_id,sqr.correct_ans,sqr.incorrect_ans,sqr.unanswered,qm.name as quiz_name,qm.max_marks,qm.negative_marks,c.course_name,qm.number_of_questions');
                $this->db->from('user as u');
                $this->db->join('student_quiz_result as sqr','sqr.student_id = u.id','left');
                $this->db->join('quiz_master as qm','qm.id = sqr.quiz_id','LEFT');
                $this->db->join('course as c','c.id = qm.course_id','Left');
                // $this->db->('qm.id','');
                $this->db->where('qm.id is NOT NULL', NULL, FALSE);

                $this->db->where('u.id',$student_id);
                $this->db->order_by('qm.id','desc');
                // $this->db->limit(2);
                $query = $this->db->get();
                if($query->num_rows() > 0){
                    $response = $query->result();
                }
               
            }
            return $response;
        }
        
     
	public function _get_datatables_query()
	{
	$this->db->select('u.*,sqr.quiz_id,sqr.correct_ans,sqr.incorrect_ans,sqr.unanswered,qm.name as quiz_name');
	$this->db->from('user as u');
	$this->db->join('student_quiz_result as sqr','sqr.student_id = u.id','LEFT');
	$this->db->join('quiz_master as qm','qm.id = sqr.quiz_id','LEFT');
	
	$this->db->where('sqr.quiz_id',$this->quizId);
	$this->db->order_by('sqr.correct_ans','desc');
	$this->db->order_by('sqr.incorrect_ans','asc');
	
                $this->db->group_by('u.id');
                
                
	$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($_POST['order']['0']['column'], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
		$this->db->where('u.is_deleted',0);
	}

	public function get_datatables()
	{
// 		$this->_applyFilter();
	
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
	 
		return $query->result();
	}


	public function count_filtered()
	{
// 		$this->_applyFilter();
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
// 		$this->_applyFilter();
		$this->_get_datatables_query();
		return $this->db->count_all_results();
	}
	
	public function getbronzecount($studentId){
        $this->db->select('count(quiz_id) as totalbronze');
        $this->db->from('student_quiz_result');
        $this->db->where('student_id',$studentId);
        $this->db->where('quiz_result >=',50);
        // $this->db->group_by('quiz_id');
        $query = $this->db->get();
        // echo $this->db->last_query();
    
        if($query->num_rows() > 0)
        {
            $response = $query->row()->totalbronze;
        }
        return $response;
        
    }
    	public function getsilvercount($studentId){
        $this->db->select('count(quiz_id) as totalsilver');
        $this->db->from('student_quiz_result');
        $this->db->where('student_id',$studentId);
        $this->db->where('quiz_result >=',60);
        // $this->db->group_by('quiz_id');
        $query = $this->db->get();
        // echo $this->db->last_query();
    
        if($query->num_rows() > 0)
        {
            $response = $query->row()->totalsilver;
        }
        return $response;
        
    }
    
    	public function getgoldcount($studentId){
        $this->db->select('count(quiz_id) as totalgold');
        $this->db->from('student_quiz_result');
        $this->db->where('student_id',$studentId);
        $this->db->where('quiz_result >=',70);
        // $this->db->group_by('quiz_id');
        $query = $this->db->get();
        // echo $this->db->last_query();
    
        if($query->num_rows() > 0)
        {
            $response = $query->row()->totalgold;
        }
        return $response;
        
    }
    
    	public function getplatinumcount($studentId){
        $this->db->select('count(quiz_id) as totalplatinum');
        $this->db->from('student_quiz_result');
        $this->db->where('student_id',$studentId);
        $this->db->where('quiz_result >=',80);
        // $this->db->group_by('quiz_id');
        $query = $this->db->get();
        // echo $this->db->last_query();
    
        if($query->num_rows() > 0)
        {
            $response = $query->row()->totalplatinum;
        }
        return $response;
        
    }
	
    /*
    * get all quiz as event
    */
    public function getQuizAsEvent(){
        $this->db->select('*');
        $this->db->from('quiz_master');
        $this->db->where('active',1);
        $this->db->where('is_deleted',0);
        $query = $this->db->get();
        if($query->num_rows()>0){
            $response = $query->result();
        }
        return $response;
    }
    
    public function getStudentResult($studentid,$quizId)
    {
    
        $this->db->select('quiz.*,quiz_master.name,quiz_master.number_of_questions,quiz_master.max_marks,quiz_master.negative_marks,quiz_master.quiz_total_time,course.course_name,topics.topic_name,quiz_master.attemt_students');
        $this->db->from('quiz');
        $this->db->join('quiz_master','quiz_master.id=quiz.quiz_id');
        $this->db->join('course','course.id=quiz_master.course_id');
        $this->db->join('topics','topics.id=quiz_master.topic_id');
        $this->db->where('quiz.student_id',$studentid);
        $this->db->where('quiz.quiz_id',$quizId);
       // $this->db->where('quiz.attempt',$attempt);
        
        $query = $this->db->get();
       
        if($query->num_rows() >= 1)
        {
            return $query->result_array();
        }
        else
        {
            return false;
        }
        
    }
}
?>