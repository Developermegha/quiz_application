<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Result</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                  <li class="breadcrumb-item active">Quiz List</li>
                </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
           
            <div class="row">
                <!-- /.col -->
                <div class="col-md-12">
            <!-- Application buttons -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><?php echo $studResult[0]['name']; ?> Result</h3>
              </div>
                <div class="card-body">
                    
                    <div class="row">
                         <?php 
                        $qid=$studResult[0]['quiz_id'];
                        $sid=$studResult[0]['student_id'];
                      
                        $noOfQue=$studResult[0]['number_of_questions'];
                        $total_mark=$studResult[0]['max_marks'];
                        $negMark=$studResult[0]['negative_marks']; 
                        $studResult[0]['quiz_total_time'];
                        $AnsC=$this->AdminModel->fetchResultByStudentAnsweredCorrectly($sid,$qid,$noOfQue);
                        $AnsIc=$this->AdminModel->fetchResultByStudentAnsweredInCorrectly($sid,$qid,$noOfQue);
                        $UnAns=$this->AdminModel->fetchResultByStudentUnAnswered($sid,$qid,$noOfQue);
                        $single_mark=($total_mark/$noOfQue);
                        $CAM=($AnsC*$single_mark);
                        $TNM=($AnsIc*$negMark);
                        $FM=($CAM-$TNM); 
                        $ICAM=($AnsIc*$single_mark);    
                        
                        
                            $per=($FM/$total_mark)*100;
                        ?>
                        <div class='col-4 text-center'>
                            <h3>Remark</h3>
                            <?php 
                            if($per<=50){ $remark="Your score is very low";}
                            else if($per>=50 && $per<=60)
                            {$remark="You need some more preparation"; }
                            else if($per>=60 && $per<=75)
                            {$remark="Well Done"; }
                            else if($per>=75 && $per<=85)
                            {$remark="Congratulations...Your score is very Good..!"; }
                            else if($per>=85 && $per<=100)
                            {$remark="Congratulations....!"; }
                                
                            ?>
                            <h4><?php echo $remark; ?></h4>
                            
                        </div>
                        <div class='col-4 text-center'>
                            <h3>Your Score </h3>
                            <h4><?php echo round($FM); ?>/<?php echo $total_mark ?></h4>
                           
                        </div>
                        <div class='col-4 text-center'>
                            <h3>Percetage</h3>
                            <h4><?php echo round($per);?>%</h4>
                            
                        </div>
                    </div>
                
               
               
               
              </div>
              <!-- /.card-body -->
                <div class="card-footer bg-transparent">
                    <div class="row">
                        <div class="col-4 text-center">
                            <input type="text" class="knob" data-readonly="true" value="<?php echo $AnsC;?>" data-width="100" data-height="100"
                                   data-fgColor="#28a745">
                                   <!--<input type="text" class="knob" data-readonly="true" value="20" data-width="60" data-height="60"-->
                                   <!--data-fgColor="#39CCCC">-->
                            <div>Correct</div>
                        </div>
                        <div class="col-4 text-center">
                            <input type="text" class="knob" data-readonly="true" value="<?php echo $AnsIc;?>" data-width="100" data-height="100"
                                   data-fgColor="#dc3545">
                                <div class="">Wrong</div>
                        </div>
                        <div class="col-4 text-center">
                            <input type="text" class="knob" data-readonly="true" value="<?php echo $UnAns;?>" data-width="100" data-height="100"
                                   data-fgColor="#ffc107">
                            <div class="">Skipped </div>
                        </div>
                        
                    </div>
                    <!-- /.row -->
                </div>
            </div>
          

           
          </div>
                <!-- /.col -->
            </div>
             <div class="row">
                <!-- /.col -->
                <div class="col-md-12">
                    <!-- Application buttons -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><?php echo $studResult[0]['name']; ?> Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <lable class='col-3 text-bold'>Quiz Name :</lable> <lable class='col-3'><?php echo $studResult[0]['name']; ?></lable>
                                <lable class='col-3 text-bold'>Course Name :</lable><lable class='col-3'><?php echo $studResult[0]['course_name']; ?></lable>
                                <lable class='col-3 text-bold'>Topic Name :</lable><lable class='col-3'><?php echo $studResult[0]['topic_name']; ?></lable>
                                <lable class='col-3 text-bold'>Total Time :</lable><lable class='col-3'><?php echo $studResult[0]['quiz_total_time']; ?> min</lable>
                                <lable class='col-3 text-bold'>Total Quiz Marks :</lable><lable class='col-3'><?php echo $studResult[0]['max_marks']; ?></lable>
                                <lable class='col-3 text-bold'>Negative Mark :</lable><lable class='col-3'><?php echo $studResult[0]['negative_marks']; ?></lable>
                                <lable class='col-3 text-bold'>Total Questions :</lable><lable class='col-3'><?php echo $studResult[0]['number_of_questions']; ?></lable>
                                <lable class='col-3 text-bold'>Total Attempt :</lable><lable class='col-3'><?php echo $TA=$studResult[0]['attemt_students']; ?></lable>
                            </div>
                            <hr>
                            <div class="row">
                                <lable class='col-3 text-bold'>Attempted Questions :</lable> <lable class='col-3'><?php echo $AQ=($AnsC+$AnsIc); ?></lable>
                                <lable class='col-3 text-bold'>Not Attempted Questions :</lable><lable class='col-3'><?php echo $NAQ=($noOfQue-$AQ); ?></lable>
                                <lable class='col-3 text-bold'>Time Taken by Student :</lable><lable class='col-3'><?php echo $studResult[0]['time taken']; ?></lable>
                                
                                <lable class='col-3 text-bold'>Remaining Attempt :</lable><lable class='col-3'><?php echo $RA=($TA-$studResult[0]['attempt']); ?></lable>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /. row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>