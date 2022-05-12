<?php
class AdminModel extends CI_Model
{
    public function fetchAllQuestion()
    {
        $this->db->select('*');
        $this->db->from('questionset');
        //$this->db->join('topics', 'topics.id = questionset.qst_attribute_name');
        //$this->db->join('course', 'course.id = questionset.course_id');
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
    
     public function fetchAllQuestion_staffwise()
    {
        $cid=$_SESSION['course_id'];
        $this->db->select('q.*,course.course_name,topics.topic_name');
        $this->db->from('questionset as q');
        $this->db->join('topics', 'topics.id = q.qst_attribute_name');
        $this->db->join('course', 'course.id = q.course_id');
        $this->db->where('q.course_id',$cid);
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
    
    public function fetchAlltopics_staffwise()
     {
         $cid=$_SESSION['course_id'];
        $response = array();
        $this->db->select('t.*,c.course_name');
        $this->db->from('topics as t');
        $this->db->join('course as c','c.id = t.course_id');
        $this->db->where('t.active',1);
        $this->db->where('t.is_deleted',0);
        $this->db->where('t.course_id',$cid);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $response = $query->result_array();
        }
        return $response;
        
    }
    public function fetchAllQuiz()
    {
        $this->db->select('quiz_master.*,course.course_name,quiz_type.quiztype,topics.topic_name');
        $this->db->from('quiz_master');
        $this->db->join('course', 'course.id = quiz_master.course_id','left');
        $this->db->join('quiz_type', 'quiz_type.id = quiz_master.type_id','left');
        $this->db->join('topics', 'topics.id = quiz_master.topic_id','left');
        $this->db->order_by('quiz_master.id','DESC');
        $this->db->where('quiz_master.is_deleted',0);
        //$this->db->group_by('questionset.quiz_id');
        $query = $this->db->get();
        // echo $this->db->last_query();
        if($query->num_rows() >= 1)
        {
            return $query->result_array();
        }
        else
        {
            return false;
        }
    }
    public function fetchCourse()
    {
        $this->db->select('*');
        $this->db->from('course');
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
    public function fetchAllUser()
    {
        $this->db->select('*');
        $this->db->from('admin');
        $this->db->where('is_deleted',0);
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
    public function fetchAlltopics()
     {
        $response = array();
        $this->db->select('t.*,c.course_name,qt.quiztype');
        $this->db->from('topics as t');
        $this->db->join('course as c','c.id = t.course_id','left');
        $this->db->join('quiz_type as qt','qt.id = t.quiz_type_id','left');
        $this->db->where('t.active',1);
        $this->db->where('t.is_deleted',0);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $response = $query->result_array();
        }
        return $response;
        
    }
    // get all courses 
    public function fetchAllCourse()
    {
        $response = array();
        $this->db->select('*');
        $this->db->from('course');
        //$this->db->where('status',1);
        // $this->db->where('t.is_deleted',0);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $response = $query->result_array();
        }
        return $response;
          
    }
    
     // get all topic 
    public function fetchAllTopic()
    {
        $response = array();
        $this->db->select('*');
        $this->db->from('topics');
        //$this->db->where('status',1);
        // $this->db->where('t.is_deleted',0);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $response = $query->result_array();
        }
        return $response;
          
    }
    
    
    //add new topics with course
    
    public function add_new_topic($data)
    {
        $response = false;
        if(!empty($data)){
            $query =$this->db->insert('topics',$data);
        
            if($this->db->affected_rows() > 0)
            {
                $response= true;   
            }
        }
        return $response;
    }
    
   
    
    
    
    //insert course
    public function add_course($data)
    {
        $response = false;
        $this->db->insert('course',$data);
         if($this->db->affected_rows() > 0)
            {
                $response= true;   
            }
            return $response;
    }
    
    //insert User
    public function add_User($data)
    {
        $response = false;
        $this->db->insert('admin',$data);
        if($this->db->affected_rows() > 0)
        {
            $response= true;
        }
        return $response;
    }
    
    public function add_Question($data)
    {
        $this->db->insert('questionset',$data);
        if($this->db->affected_rows() > 0)
        {
            $insert_id = $this->db->insert_id();
          
            if(isset($_FILES['question_img']))
            {
                $file_name = $_FILES['question_img']['name'];
                $file_tmp =$_FILES['question_img']['tmp_name'];
                move_uploaded_file($file_tmp, "uploads/".$file_name);
            }
           
            if(isset($_FILES['ans1_img']))
            {
                    $ans1_img = $_FILES['ans1_img']['name'];
                    $file_tmp1 =$_FILES['ans1_img']['tmp_name'];
                    move_uploaded_file($file_tmp1, "uploads/".$ans1_img);
            }
            if(isset($_FILES['ans2_img']))
            {
                    $ans2_img = $_FILES['ans2_img']['name'];
                    $file_tmp2 =$_FILES['ans2_img']['tmp_name'];
                    move_uploaded_file($file_tmp2, "uploads/".$ans2_img);
            }
                
            if(isset($_FILES['ans3_img']))
            {
                    $ans3_img = $_FILES['ans3_img']['name'];
                    $file_tmp3 =$_FILES['ans3_img']['tmp_name'];
                    move_uploaded_file($file_tmp3, "uploads/".$ans3_img);
            }
            
            if(isset($_FILES['ans4_img']))
            {
                    $ans4_img = $_FILES['ans4_img']['name'];
                    $file_tmp4 =$_FILES['ans4_img']['tmp_name'];
                    move_uploaded_file($file_tmp4, "uploads/".$ans4_img);
            }
                
            if(isset($_FILES['correct_ans_img']))
            {
                    $correct_ans_img = $_FILES['correct_ans_img']['name'];
                    $file_tmp5 =$_FILES['correct_ans_img']['tmp_name'];
                    move_uploaded_file($file_tmp5, "uploads/".$correct_ans_img);
            }
            $today = date("Y-m-d H:i:s"); 
            $res = array(
                        'question_id' =>$insert_id,
                        'image_question' =>$file_name,
                        'image_option_1' =>$ans1_img,
                        'image_option2' =>$ans2_img,
                        'image_option3' =>$ans3_img,
                        'image_option4' =>$ans4_img,
                        'created_by'=>$_SESSION['id'],
                        'created_on'=>$today,
                    );
            $this->db->insert('quiz_images',$res);
            if($this->db->affected_rows() > 0)
            {
                return true;
            }    
                    
            else
            {
                return false;
            }
            
            return true;
        }
        else
        {
            return false;
        }
         
        
        
    }
    /* add new quiz with new questions  */
    public function add_New_Quiz($data)
    {
        
        $q_img=$_FILES['question_img']['name'];
	    $a_img=$_FILES['answer_img']['name'];
	    
        $st=convertDateTimeToDatabase($data['quiz_start_time'],$data['quiz_start_time']);
        $et=convertDateTimeToDatabase($data['quiz_end_time'],$data['quiz_end_time']);
        
        $today = date("Y-m-d H:i:s"); 
        //$this->db->set('quiz_stauts_id',3);
        $this->db->set('course_id',$data['subject']);
        $this->db->set('name',$data['quiz_name']);
        $this->db->set('type_id',$data['qst_type']);
        $this->db->set('number_of_questions',$data['total_questions']);
        $this->db->set('max_marks',$data['max_marks']);
        $this->db->set('negative_marks',$data['negative_marks']);
        $this->db->set('quiz_total_time',$data['quiz_total_time']);
        $this->db->set('attemt_students',$data['total_attempt']);
        $this->db->set('quiz_start_time',$st);
        $this->db->set('quiz_end_time',$et);
        $this->db->set('topic_id',$data['attribute_name']);
        $this->db->set('is_deleted',0);
        $this->db->set('created_at',$today);
        $this->db->set('active',1);
        $this->db->insert('quiz_master');
        
        if($this->db->affected_rows() > 0)
        {
            $insert_id = $this->db->insert_id();
            $que=$data['question'];
            $ansarray=$data['answer'];
            $arre=array_chunk($ansarray, 5);
            for($i=0;$i<count($arre);$i++)
            {    
                $result = array(
                    'course_id' =>$data['subject'],
                    'quiz_id' =>$insert_id ,
                    'question' =>$que[$i],
                    'option_1' =>$arre[$i][0],
                    'option_2' =>$arre[$i][1] ,
                    'option_3' =>$arre[$i][2],
                    'option_4' =>$arre[$i][3] ,
                    'correct_option' =>$arre[$i][4] ,
                    //'qst_type'=>$data['qst_type'],
                    //'qst_attribute_name'=>$data['attribute_name'],
                    );
                $this->db->insert('questionset',$result);
                  
             
            }
            if((!empty($q_img)) || (!empty($img_a)))
            {
                $this->db->select('id');
                $this->db->from('questionset');
                $this->db->where('quiz_id',$insert_id);
                $query = $this->db->get();
                $response = $query->result_array();
                if($query->num_rows() > 0)
                {
                    $img_a=array_chunk($a_img, 4);
                    for($i=0;$i<count($response);$i++)
                    {
                        $res = array(
                            'question_id' =>$response[$i]['id'],
                            'image_question' =>$q_img[$i] ,
                            'image_option_1' =>$img_a[$i][0],
                            'image_option2' =>$img_a[$i][1],
                            'image_option3' =>$img_a[$i][2],
                            'image_option4' =>$img_a[$i][3],
                            'quiz_id' =>$insert_id,
                        );
                        $this->db->insert('quiz_images',$res);
                                
                    }
                }
            }
            
            return true;
        }
        else
        {
            return false;
        }
        
    }
    /* insert quiz without questios   */
    public function add_New_Quiz_Without_Questions($data)
    {
        $st=convertDateTimeToDatabase($data['quiz_start_time'],$data['quiz_start_time']);
        $et=convertDateTimeToDatabase($data['quiz_end_time'],$data['quiz_end_time']);
        
        $today = date("Y-m-d H:i:s"); 
        //$this->db->set('quiz_stauts_id',3);
        $this->db->set('course_id',$data['subject']);
        $this->db->set('name',$data['quiz_name']);
        $this->db->set('type_id',$data['qst_type']);
        $this->db->set('number_of_questions',$data['total_questions']);
        $this->db->set('max_marks',$data['max_marks']);
        $this->db->set('negative_marks',$data['negative_marks']);
        $this->db->set('quiz_total_time',$data['quiz_total_time']);
        $this->db->set('attemt_students',$data['total_attempt']);
        $this->db->set('quiz_start_time',$st);
        $this->db->set('quiz_end_time',$et);
        $this->db->set('topic_id',$data['attribute_name']);
        $this->db->set('is_deleted',0);
        $this->db->set('created_at',$today);
        $this->db->set('active',1);
        $this->db->insert('quiz_master');
        
        if($this->db->affected_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    
    
    /* insert quiz with previous questions  */
    public function insert_quiz_with_previous_questions($data)
    {
        $st=convertDateTimeToDatabase($data['quiz_start_time'],$data['quiz_start_time']);
        $et=convertDateTimeToDatabase($data['quiz_end_time'],$data['quiz_end_time']);
        
        $today = date("Y-m-d H:i:s"); 
        $que=$data['question'];
        $count=count($que);
        $this->db->set('name',$data['quiz_name']);
        $this->db->set('type_id',$data['qst_type']);
        $this->db->set('course_id',$data['subject']);
        $this->db->set('topic_id',$data['attribute_name']);
        $this->db->set('number_of_questions',$count);
        $this->db->set('max_marks',$data['max_marks']);
        $this->db->set('negative_marks',$data['negative_marks']);
        $this->db->set('quiz_total_time',$data['quiz_total_time']);
        $this->db->set('attemt_students',$data['total_attempt']);
        $this->db->set('quiz_start_time',$st);
        $this->db->set('quiz_end_time',$et);
        $this->db->set('active',1);
        $this->db->set('created_at',$today);
        $this->db->insert('quiz_master');
        if($this->db->affected_rows() > 0)
        {
            $insert_id = $this->db->insert_id();
           
            $query = $this->db->where_in("id", $que)->get("questionset");
            $result=$query->result_array();
            foreach($result as $r)
            {
            $res = array(
                    'course_id' =>$data['subject'],
                    'quiz_id' =>$insert_id ,
                    'question' =>$r['question'],
                    'option_1' =>$r['option_1'],
                    'option_2' =>$r['option_2'] ,
                    'option_3' =>$r['option_3'],
                    'option_4' =>$r['option_4'] ,
                    'correct_option' =>$r['correct_option'] ,
                    //'qst_type' =>$r['qst_type'],
                    //'qst_attribute_name' =>$r['qst_attribute_name']
                    );
                    
            $this->db->insert('questionset',$res);  
           
            }
            if($this->db->affected_rows() > 0)
            {
                return true;   
            }
            
            
        }
    }
    
    public function fetchtopics($topic,$course)
    {
        if($topic=='3')
        {
            $this->db->select('id,topic_name');
            $this->db->from('topics');
            $this->db->where('course_id',$course);
        }
        else
        {
            $this->db->select('id,topic_name');
            $this->db->from('topics');
            $this->db->where('course_id',$course);
            $this->db->where('quiz_type_id',$topic);
        }
        
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
    
    /*
    * get admin details from
    * session id
    */
    public function getUserDetails($id){
        $response =  array();
        if(!empty($id)){
            $this->db->select('*');
            $this->db->from('admin');
            $this->db->where('status',1);
            $this->db->where('id',$id);
            $query = $this->db->get();
            if($query->num_rows() > 0){
                $response = $query->row();
            }
        }
        return $response;
    }
    
    public function getStaffUserDetails($id){
        $response =  array();
        if(!empty($id)){
            
            $this->db->select('*');
            $this->db->from('admin');
            $this->db->where('role',2);
            $this->db->where('status',1);
            $this->db->where('id',$id);
            $query = $this->db->get();
            if($query->num_rows() > 0){
                $response = $query->row();
            }
        }
        return $response;
    }
    public function fetchQuizType()
    {
        $this->db->select('*');
        $this->db->from('quiz_type');
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
    
    public function fetchtopicsquestions($topic_name) 
    {
       // echo "select * from questionset where qst_type='$qst_type' and qst_attribute_name='$topic_name'";
        $this->db->select('questionset.id,questionset.question');
        $this->db->from('questionset');
     //   $this->db->join('topics','topics.course_id = questionset.course_id','left');
        // $this->db->join('quiz_master','quiz_master.id=questionset.quiz_id');
        // $this->db->join('quiz_master','quiz_master.course_id=questionset.course_id');
        // $this->db->where('quiz_master.topic_id',$topic_name);
        $this->db->where('questionset.topic_id',$topic_name);
        //$this->db->where('qst_attribute_name',$topic_name);
        $query = $this->db->get();
        // echo $this->db->last_query();
        if($query->num_rows() >= 1)
        {
            return $query->result_array();
        }
        else
        {
            return false;
        }
    }
   
   /*
   * update data of admin by id
   */
   public function updateAdminData($data,$id){
       $response = false;
       if(!empty($data) && !empty($id)){
           $this->db->set($data);
           $this->db->where('id',$id);
           $this->db->update('admin');
           if($this->db->affected_rows() > 0){
               $response = true;
           }
       }
       return $response;
   }
   
   /*
   * student soft deleted by student id
   */
   public function deleteStudentById($id){
       $response = false;
       if(!empty($id)){
           $this->db->set('is_deleted',1);
           $this->db->where('id',$id);
           $this->db->update('admin');
           if($this->db->affected_rows() > 0){
               $response = true;
           }
       }
       return $response;
   }
   
   /* get quiz details with id */
   public function getQuizDetails($id)
   {
        $this->db->select('*');
        $this->db->from('quiz_master as qm');
        $this->db->join('topics as t','t.id=qm.topic_id','left');
        $this->db->join('course as c','c.id = qm.course_id','left');
        $this->db->join('questionset as q','q.quiz_id=qm.id','left');
        $this->db->where('qm.id',$id);
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
   
   /*  soft delete quiz   */
   public function softDeleteQuiz($id)
   {
        $this->db->set('is_deleted','1');
        //$this->db->set('active','0');
        $this->db->where('id',$id);
        $this->db->update('quiz_master');
        if($this->db->affected_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
   }
   
   /*   get subject by ID */
   public function get_course($id)
   {
       $this->db->select('*');
       $this->db->from('course');
       $this->db->where('id',$id);
       $query=$this->db->get();
       $result=$query->result_array();
       return $result;
   }
   
   public function update_course($data)
   {
       
       $this->db->set('course_name',$data['course_name']);
       $this->db->set('status',$data['status']);
       $this->db->where('id',$data['sub_id']);
       $this->db->update('course');
       if($this->db->affected_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
   }
   public function DeleteSub($id)
   {
       
        $this->db->set('status','0');
        $this->db->where('id',$id);
        $this->db->update('course');
        if($this->db->affected_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
   }
   public function DeleteTopic($id)
   {
        $today = date("Y-m-d H:i:s"); 
        $this->db->set('is_deleted','1');
        $this->db->set('deleted_at',$today);
        $this->db->where('id',$id);
        $this->db->update('topics');
        if($this->db->affected_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
   }
   public function get_topic($id)
   {
       $this->db->select('*');
       $this->db->from('topics');
       $this->db->where('id',$id);
       $query=$this->db->get();
       $result=$query->result_array();
       return $result;
   }
   public function update_topic($data)
   {
       
        $res = array(
                'course_id' => $data['course_id'],
                'topic_name' =>$data['topic_name'],
                'active' => $data['status'],
                'is_deleted' => 0,
                'quiz_type_id' => $data['qst_type'],
                );
        $this->db->where('id',$data['topic_id']);
        $this->db->update('topics',$res);
         if($this->db->affected_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
   }
   /*
    * get total active quiz count
    */
    public function getTotalActiveQuiz()
    {
        $today = date("Y-m-d H:i:s");
        $this->db->select('count(id) as totalactive');
        $this->db->from('quiz_master');
        //$this->db->where('quiz_start_time <=', $today);
        //$this->db->where('quiz_end_time >=', $today);
        
        $this->db->where('active',1);
        $this->db->where('is_deleted',0);
        $query = $this->db->get();
        if($query->num_rows() > 0 ){
            $response = $query->row()->totalactive;
        }
        return $response;
    }
    /* get Total active quiz list  */
    public function getTotalActiveQuizList()
    {
        $today = date("Y-m-d H:i:s");        
        $this->db->select('quiz_master.*,course.course_name,quiz_type.quiztype,topics.topic_name');
        $this->db->from('quiz_master');
        $this->db->join('course', 'course.id = quiz_master.course_id');
        $this->db->join('quiz_type', 'quiz_type.id = quiz_master.type_id');
        $this->db->join('topics', 'topics.id = quiz_master.topic_id');
        //$this->db->where('quiz_master.quiz_start_time <=', $today);
        //$this->db->where('quiz_master.quiz_end_time >=', $today);
        $this->db->where('quiz_master.is_deleted',0);
        $this->db->where('quiz_master.active',1);
        //$this->db->group_by('questionset.quiz_id');
        $query = $this->db->get();
        // echo $this->db->last_query();
        if($query->num_rows() >= 1)
        {
            return $query->result_array();
        }
        else
        {
            return false;
        }
    }
    
    /* get Total deleted quiz count  */
    public function getTotalDeletedQuiz()
    {
        $today = date("Y-m-d H:i:s");    
        $this->db->select('count(id) as totaldel');
        $this->db->from('quiz_master');
        //$this->db->where('quiz_master.quiz_start_time <=', $today);
        //$this->db->where('quiz_master.quiz_end_time <', $today);
        $this->db->where('active',0);
        $this->db->where('is_deleted',0);
        $query = $this->db->get();
        if($query->num_rows() > 0 ){
            $response = $query->row()->totaldel;
        }
        return $response;
    }
    
    /*
    
    /* get Total deleted quiz list  */
    public function getTotalDeletedQuizList()
    {
        $today = date("Y-m-d H:i:s");        
        $this->db->select('quiz_master.*,course.course_name,quiz_type.quiztype,topics.topic_name');
        $this->db->from('quiz_master');
        $this->db->join('course', 'course.id = quiz_master.course_id');
        $this->db->join('quiz_type', 'quiz_type.id = quiz_master.type_id');
        $this->db->join('topics', 'topics.id = quiz_master.topic_id');
        //$this->db->where('quiz_master.quiz_start_time <=', $today);
        //$this->db->where('quiz_master.quiz_end_time <', $today);
        $this->db->where('quiz_master.is_deleted',0);
        $this->db->where('quiz_master.active',0);
        //$this->db->group_by('questionset.quiz_id');
        $query = $this->db->get();
        // echo $this->db->last_query();
        if($query->num_rows() >= 1)
        {
            return $query->result_array();
        }
        else
        {
            return false;
        }
    }
    
    /*
    * get total quiz count
    */
    public function getQuizCount()
    {
        $this->db->select('count(id) as totalQuiz');
        $this->db->from('quiz_master');
        $this->db->where('is_deleted',0);
        $query = $this->db->get();
        if($query->num_rows() > 0 ){
            $response = $query->row()->totalQuiz;
        }
        return $response;
    }
    
    /*  get total subject count */
    public function getSubjectCount()
    {
        $this->db->select('count(id) as totalCourse');
        $this->db->from('course');
        //$this->db->where('status',1);
        $query = $this->db->get();
        if($query->num_rows() > 0 ){
            $response = $query->row()->totalCourse;
        }
        return $response;
    }
    /* get subject wise quiz count */
    public function getSubjectWiseQuizCount()
    {
        $this->db->select('*,count(quiz_master.id) as count,course.course_name,topics.topic_name');
        $this->db->from('quiz_master');
        $this->db->join('course', 'course.id = quiz_master.course_id');
        $this->db->join('quiz_type', 'quiz_type.id = quiz_master.type_id');
        $this->db->join('topics', 'topics.id = quiz_master.topic_id');
        $this->db->where('quiz_master.is_deleted',0);
        $this->db->where('quiz_master.active',1);
        $this->db->group_by('course.course_name');
        $query = $this->db->get();
        // echo $this->db->last_query();
        if($query->num_rows() >= 1)
        {
            return $query->result_array();
        }
        else
        {
            return false;
        }
        
    }
    
    /*  get topicwise quiz   */
    public function getTopicWiseQuizCount()
    {
        $this->db->select('*,count(quiz_master.id) as count,course.course_name,topics.topic_name');
        $this->db->from('quiz_master');
        $this->db->join('course', 'course.id = quiz_master.course_id');
        $this->db->join('quiz_type', 'quiz_type.id = quiz_master.type_id');
        $this->db->join('topics', 'topics.id = quiz_master.topic_id');
        $this->db->where('quiz_master.is_deleted',0);
        $this->db->where('quiz_master.active',1);
        $this->db->group_by('topics.topic_name');
        $query = $this->db->get();
        // echo $this->db->last_query();
        if($query->num_rows() >= 1)
        {
            return $query->result_array();
        }
        else
        {
            return false;
        }
    }
    
    /* update quiz status by ID  */
    public function UpdateQuizStatus($id,$status)
    {
        $this->db->set('active',$status);
        $this->db->where('id',$id);
        $this->db->update('quiz_master');
        if($this->db->affected_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    /* fetch user group count   */
    public function getUserCount()
    {
        $this->db->select('admin_role.role,count(admin.role) as count,');
        $this->db->from('admin');
        $this->db->join('admin_role','admin_role.id=admin.role','left');
        $this->db->group_by('admin.role');
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
    /*  function to check quiz status for start and end date */
    public function updateQuizStatusByDate($today)
    {
        $this->db->set('active',0);
        //$this->db->where('quiz_master.quiz_start_time <=', $today);
        $this->db->where('quiz_master.quiz_end_time <=', $today);
        $this->db->update('quiz_master');
        if($this->db->affected_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    public function getStudentResult($studentid,$quizId,$attempt)
    {
    
        $this->db->select('quiz.*,quiz_master.name,quiz_master.number_of_questions,quiz_master.max_marks,quiz_master.negative_marks,quiz_master.quiz_total_time,course.course_name,topics.topic_name,quiz_master.attemt_students');
        $this->db->from('quiz');
        $this->db->join('quiz_master','quiz_master.id=quiz.quiz_id');
        $this->db->join('course','course.id=quiz_master.course_id');
        $this->db->join('topics','topics.id=quiz_master.topic_id');
        $this->db->where('quiz.student_id',$studentid);
        $this->db->where('quiz.quiz_id',$quizId);
        $this->db->where('quiz.attempt',$attempt);
        
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
    
    public function getStudResult($studentid,$quizId)
    {
    
        $this->db->select('quiz.*,quiz_master.name,quiz_master.number_of_questions,quiz_master.max_marks,quiz_master.negative_marks,quiz_master.quiz_total_time,course.course_name,topics.topic_name,quiz_master.attemt_students');
        $this->db->from('quiz');
        $this->db->join('quiz_master','quiz_master.id=quiz.quiz_id');
        $this->db->join('course','course.id=quiz_master.course_id');
        $this->db->join('topics','topics.id=quiz_master.topic_id');
        $this->db->where('quiz.student_id',$studentid);
        $this->db->where('quiz.quiz_id',$quizId);
        
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
    public function fetchResultByStudentAnsweredCorrectly($sid,$qid,$noOfQue)
    {
        $this->db->select('*');
        $this->db->from('quiz');
        $this->db->where('student_id', $sid); 
        $this->db->where('quiz_id', $qid); 
        $this->db->where('questions_status_id',5);
        if(!isset($this->attempts)){
            $attempt = 0;
        }else{
            $attempt = $this->attempts;
        }
        $this->db->where('quiz.attempt',$attempt);
        $this->db->order_by('id','DESC');
        $this->db->limit($noOfQue);
        $query = $this->db->get(); 
        // echo $this->db->last_query();
        return $query->num_rows();
            
    }
    public function fetchResultByStudentAnsweredInCorrectly($sid,$qid,$noOfQue)
    {
        $this->db->select('*');
        $this->db->from('quiz');
        $this->db->where('student_id', $sid); 
        $this->db->where('quiz_id', $qid); 
        $this->db->where('questions_status_id',9);
      if(!isset($this->attempts)){
            $attempt = 0;
        }else{
            $attempt = $this->attempts;
        }  $this->db->where('quiz.attempt',$attempt);
        $this->db->order_by('id','DESC');
        $this->db->limit($noOfQue);
        $query = $this->db->get(); 
        return $query->num_rows();
    }
    public function fetchResultByStudentUnAnswered($sid,$qid,$noOfQue)
    {
        $this->db->select('*');
        $this->db->from('quiz');
        $this->db->where('student_id', $sid); 
        $this->db->where('quiz_id', $qid); 
        $this->db->where('questions_status_id', 7);
          if(!isset($this->attempts)){
            $attempt = 0;
        }else{
            $attempt = $this->attempts;
        }
        $this->db->where('quiz.attempt',$attempt);
        $this->db->order_by('id','DESC');
        $this->db->limit($noOfQue);
        $query = $this->db->get(); 
        //echo $this->db->last_query();
        //exit;
        return $query->num_rows();
    }
    
    
    //physio count
    public function getQst_physio()
    {
        $this->db->select('count(id) as totalQst');
        $this->db->from('questionset');
        $this->db->where('course_id',1);
        $query = $this->db->get();
        if($query->num_rows() > 0 ){
            $response = $query->row()->totalQst;
        }
        return $response;
    }
    
     //biochemistry count
    public function getQst_biochem()
    {
        $this->db->select('count(id) as totalQst');
        $this->db->from('questionset');
        $this->db->where('course_id',2);
        $query = $this->db->get();
        if($query->num_rows() > 0 ){
            $response = $query->row()->totalQst;
        }
        return $response;
    }
    
    //bio count
    public function getQst_bio()
    {
        $this->db->select('count(id) as totalQst');
        $this->db->from('questionset');
        $this->db->where('course_id',7);
        $query = $this->db->get();
        if($query->num_rows() > 0 ){
            $response = $query->row()->totalQst;
        }
        return $response;
    }
    
     //physics count
    public function getQst_physics()
    {
        $this->db->select('count(id) as totalQst');
        $this->db->from('questionset');
        $this->db->where('course_id',8);
        $query = $this->db->get();
        if($query->num_rows() > 0 ){
            $response = $query->row()->totalQst;
        }
        return $response;
    }
    
    /* add new quiz with new questions  */
    public function add_New_Quiz1($data)
    {
        
        $q_img=$_FILES['question_img']['name'];
	    $a_img=$_FILES['answer_img']['name'];
	    
        $st=convertDateTimeToDatabase($data['quiz_start_time'],$data['quiz_start_time']);
        $et=convertDateTimeToDatabase($data['quiz_end_time'],$data['quiz_end_time']);
        
        $today = date("Y-m-d H:i:s"); 
        //$this->db->set('quiz_stauts_id',3);
        $this->db->set('course_id',$data['subject']);
        $this->db->set('name',$data['quiz_name']);
        $this->db->set('type_id',$data['qst_type']);
        $this->db->set('number_of_questions',$data['total_questions']);
        $this->db->set('max_marks',$data['max_marks']);
        $this->db->set('negative_marks',$data['negative_marks']);
        $this->db->set('quiz_total_time',$data['quiz_total_time']);
        $this->db->set('attemt_students',$data['total_attempt']);
        $this->db->set('quiz_start_time',$st);
        $this->db->set('quiz_end_time',$et);
        $this->db->set('topic_id',$data['attribute_name']);
        $this->db->set('is_deleted',0);
        $this->db->set('created_at',$today);
        $this->db->set('active',1);
        $this->db->insert('quiz_master');
        
        if($this->db->affected_rows() > 0)
        {
            $insert_id = $this->db->insert_id();
            $que=$data['question'];
            $ansarray=$data['answer'];
            $arre=array_chunk($ansarray, 5);
            
            if(isset($_FILES['answer_img']['name']))
            {
                $img_a=$_FILES['answer_img']['name'];
                $img_arre=array_chunk($img_a, 5);
                for($i=0;$i<count($arre);$i++)
                {
                    $result = array(
                        'course_id' =>$data['subject'],
                        'quiz_id' =>$insert_id ,
                        'question' =>$que[$i],
                        'option_1' =>$img_arre[$i][0],
                        'option_2' =>$img_arre[$i][1] ,
                        'option_3' =>$img_arre[$i][2],
                        'option_4' =>$img_arre[$i][3] ,
                        'correct_option' =>$img_arre[$i][4] ,
                       
                        );
                     $this->db->insert('questionset',$result);
                }
            }
           if(isset($data['answer']))
            {
                for($i=0;$i<count($arre);$i++)
                {
                    $result = array(
                    'course_id' =>$data['subject'],
                    'quiz_id' =>$insert_id ,
                    'question' =>$que[$i],
                    'option_1' =>$arre[$i][0],
                    'option_2' =>$arre[$i][1] ,
                    'option_3' =>$arre[$i][2],
                    'option_4' =>$arre[$i][3] ,
                    'correct_option' =>$arre[$i][4] ,
                    //'qst_type'=>$data['qst_type'],
                    //'qst_attribute_name'=>$data['attribute_name'],
                    );
                    
                     $this->db->insert('questionset',$result);
                }
            }
               
                  
             
            
            
            
            return true;
        }
        else
        {
            return false;
        }
        
    }
    /* upload xls questions ito db */
    public function import_questions_xls($dataa)  
    {
      
        $this->db->insert('questionset',$dataa);    
        if($this->db->affected_rows() > 0)
        {
            return true;
        }
    }
    
}

?>