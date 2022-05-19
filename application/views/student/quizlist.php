<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Quiz List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Quiz List</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card card-solid">
        <div class="card-body pb-0">
          <div class="row">
              <?php if(!empty($quizlist)) {
              foreach($quizlist as $key => $value){
              ?>
            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
              <div class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-0">
                  <b><?php echo $value->name; ?></b>
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b><?php echo $value->topic_name; ?></b></h2>
                      <p class="text-muted text-sm"><b>Course: </b><?php echo $value->course_name; ?></p>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fa fa-question-circle" aria-hidden="true"></i></span> No. of Question : <?php echo $value->number_of_questions; ?></li>
                        <li class="small"><span class="fa-li"><i class="fa fa-calendar" aria-hidden="true"></i></span>Start time : <?php echo $value->quiz_start_time; ?></li>
                        <li class="small"><span class="fa-li"><i class="fa fa-calendar" aria-hidden="true"></i></span>End time : <?php echo $value->quiz_end_time; ?></li> 
                  
                     <?php  
                    
                    if(isset($quizresult) && !empty($quizresult)){
                        
                    
                     foreach ($quizresult as $qzesult)
                     {
                     
                     // print_r($qzesult['quiz_id']); die;
                      
                     
                          
                     
                     // exit;  
                     }
                    } 
                      if( !empty($quizresult) && $qzesult['quiz_id'] == $value->id)
                      {
                          ?>
                         
                          
                          
                           <li class="small"><span class="fa-li"><i class="fa fa-calendar" aria-hidden="true"></i></span>Attempted : <a href="<?php echo base_url('')?>student/single_quiz_result/<?php echo $qzesult['quiz_id']  ?>">Result</a></li> 
                 
                 
                          <?php
                      }
                      else{
                          
                      }
                          ?>
                          
                          
                     
                     
                     
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="<?php echo base_url('assets/img/quiz_image.jpg') ?>" alt="user-avatar" class="img-circle img-fluid">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                    <a href="#" class="btn btn-sm bg-teal">
                      <i class="fas fa-comments"></i>
                    </a>
                    <?php 
                      $date = date("Y-m-d H:i");
                        $beforestart = strtotime($date) + 1200;
                        $date = date("Y-m-d H:i:s", $beforestart);
                    if( $value->quiz_end_time >= $date){ ?>
                    <a href="<?php echo base_url('student/quiz_screen/'.$value->id); ?>" class="btn btn-sm btn-primary" target="_blank">
                        
                      <i class="fas fa-user"></i> Start Quiz
                    </a>
                    <?php }else{?>
                    <a href="#" class="btn btn-sm btn-danger" >
                        
                      <i class="fas fa-user"></i> Quiz Expire
                    </a>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
            <?php }}?>
         
          </div>
        </div>
       
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
