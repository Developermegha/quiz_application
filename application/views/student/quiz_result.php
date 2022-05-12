<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Quiz Result</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        
        <!-- /.row -->
        <div class="row">
            <div class="card-body p-0">
                <ul class="users-list clearfix">
                <?php 
                $qid=$studResult[0]['quiz_id'];
                $sid=$studResult[0]['student_id'];
              
                $noOfQue=$studResult[0]['number_of_questions'];
                $total_mark=$studResult[0]['max_marks'];
                $negMark=$studResult[0]['negative_marks']; 
                $studResult[0]['quiz_total_time'];
                $attempt = $studResult[0]['attempt'];
                $this->AdminModel->attempts = $attempt;
                $AnsC=$this->AdminModel->fetchResultByStudentAnsweredCorrectly($sid,$qid,$noOfQue);
                $AnsIc=$this->AdminModel->fetchResultByStudentAnsweredInCorrectly($sid,$qid,$noOfQue);
                $UnAns=$this->AdminModel->fetchResultByStudentUnAnswered($sid,$qid,$noOfQue);
                $single_mark=($total_mark/$noOfQue);
                $CAM=($AnsC*$single_mark);
                $TNM=($AnsIc*$negMark);
                $FM=($CAM-$TNM); 
                
                $ICAM=($AnsIc*$single_mark);    
                
                
                    $per=($FM/$total_mark)*100;
                    if($per>=85 && $per<=100)
                    {
                    for($i=0;$i<6;$i++)
                    {?>
                        <li class='col-2 col-sm-2 col-md-2 center'>
                            <img src='<?php echo base_url() ?>assets/img/medallion_burst.gif'  />
                        </li>
                    <?php 
                    } 
                    }?>
                </ul>
            </div>
        </div> 
        
        
         <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title"><?php echo $studResult[0]['name']; ?> Result</h5>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <div class="btn-group">
                    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                      <i class="fas fa-wrench"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                      <!--<a href="#" class="dropdown-item">Action</a>-->
                      <!--<a href="#" class="dropdown-item">Another action</a>-->
                      <!--<a href="#" class="dropdown-item">Something else here</a>-->
                      <!--<a class="dropdown-divider"></a>-->
                      <!--<a href="#" class="dropdown-item">Separated link</a>-->
                    </div>
                  </div>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box">
                                <div class="info-box-content text-center">
                                    <span class="info-box-number">Correct Answer</span>
                                    <span class="info-box-number">
                                    <?php echo $AnsC ?>
                                    </span>
                                </div>
                            </div>
                        </div> 
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box">
                                <div class="info-box-content text-center">
                                    <span class="info-box-number">Incorrect Answer</span>
                                    <span class="info-box-number">
                                        <?php echo $AnsIc; ?>
                                    </span>
                                </div>
                            </div>
                        </div> 
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box">
                                <div class="info-box-content text-center">
                                    <span class="info-box-number">Questions For Review</span>
                                    <span class="info-box-number">
                                    0
                                    </span>
                                </div>
                            </div>
                        </div> 
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box">
                                <div class="info-box-content text-center">
                                    <span class="info-box-number">Negative Marks</span>
                                    <span class="info-box-number">
                                        <?php echo $TNM;?>
                                    </span>
                                </div>
                            </div>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-md-4"> 
                        <?php   
                                $per=($FM/$total_mark)*100;
                                if($per<=50)
                                {
                                    ?>
                                     <span class="info-box-icon bg-warning "><?php echo "Your score is very low.Please try again ..."; ?></span>
                                   
                                <?php
                                    
                                }
                                else if($per>=50 && $per<=60)
                                {
                                 ?>   
                                  <span class="info-box-icon bg-warning "><?php echo "You need some more preparation..."; ?></span>
                                 
                               
                                <?php
                                    
                                }
                                else if($per>=60 && $per<=75)
                                {
                                    echo  "Well Done.";
                                }
                                else if($per>=75 && $per<=85)
                                {
                                    
                                ?>
                                <span class="info-box-icon bg-warning "><?php echo "Congratulations...Your score is very Good..!"; ?></span>
                                <img src='<?php echo base_url() ?>assets/img/medallion_burst.gif' class='center' />
                                <?php
                                }
                                else if($per>=85 && $per<=100)
                                {
                                    
                                ?>
                                <span class="info-box-icon bg-warning "><?php echo "Congratulations...!"; ?></span>
                                <img src='<?php echo base_url() ?>assets/img/troffy.gif' class='center' style='width:70%;'/>
                                <?php  }
                                ?> 
                                </div>
                        <div class="col-md-4">
                            <div class='row'>
                                <div class='col-12'><h3>Your Score is : <b><?php echo round($FM,2); ?>/<?php echo $total_mark ?></b></h3></div>
                                <div class='col-12'><h3>Your Percentage : <b><?php echo round($per,2); ?>%</b></h3></div>
                            </div>
                        </div>
                    </div>    
                        
                <!-- /.row -->
              </div>
              <!-- ./card-body -->
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-success"></span>
                      <h5 class="description-header"><?php echo $noOfQue=$studResult[0]['number_of_questions']; ?></h5>
                      <span class="description-text">TOTAL QUESTIONS</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-warning"></span>
                      <h5 class="description-header"><?php  echo $attempque=$AnsC+$AnsIc; ?></h5>
                      <span class="description-text">ATTEMPTED QUESTIONS</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-success"></span>
                      <h5 class="description-header"><?php echo $notattemoque=$noOfQue-$attempque ?></h5>
                      <span class="description-text">NON ATTEMPTED QUESTIONS </span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block">
                      <span class="description-percentage text-danger"></span>
                      <h5 class="description-header">0</h5>
                      <span class="description-text">QUESTIONS FOR REVIEW</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                </div>
                <!-- /.row -->
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <div class="col-md-8">
              <div class="card">
              <div class="card-header">
                <h3 class="card-title">Result With Chart</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-8">
                    <div class="chart-responsive">
                      <canvas id="pieChart" height="150"></canvas>
                    </div>
                    <!-- ./chart-responsive -->
                  </div>
                  <!-- /.col -->
                  <div class="col-md-4">
                      <ul class="chart-legend clearfix">
                      <li><i class="far fa-circle text-danger"></i> Total</li>
                      <li><i class="far fa-circle text-success"></i> Attempted</li>
                      <li><i class="far fa-circle text-warning"></i> Not_Attempted</li>
                      <li><i class="far fa-circle text-info"></i> Review</li>
                      <li><i class="far fa-circle text-primary"></i> Correct</li>
                      <li><i class="far fa-circle text-secondary"></i> Incorrect</li>
                    </ul>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer p-0">
               
              </div>
              <!-- /.footer -->
            </div>
          </div>
            <div class="col-md-4">
            <!-- Info Boxes Style 2 -->
            <div class="info-box mb-3 bg-success">
              <span class="info-box-icon"><i class="fas fa-check"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Correct Answer</span>
                <span class="info-box-number"><?php echo $AnsC ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box mb-3 bg-danger">
              <span class="info-box-icon"><i class="fas fa-thumbs-down"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Incorrect Answer</span>
                <span class="info-box-number"><?php echo $AnsIc; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box mb-3 bg-warning">
              <span class="info-box-icon"><i class="fas fa-thumbs-up"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Marks</span>
                <span class="info-box-number"><?php echo $FM; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box mb-3 bg-info">
              <span class="info-box-icon"><i class="fas fa-percentage"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Percentage</span>
                <span class="info-box-number"><?php echo $per; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->

          
          </div>
          
        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
   <script>
      $(function () {
          //-------------
  // - PIE CHART -
  //-------------
  // Get context with jQuery - using jQuery's .get() method.
  var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
  var pieData = {
    labels: [
      'Total',
      'Attempted',
      'Not_Attempted',
      'Review',
      'Correct',
      'Incorrect'
    ],
    datasets: [
      {
        data: [<?php echo $noOfQue ?>, <?php  echo $AnsC+$AnsIc; ?>, <?php echo $notattemque=$noOfQue-$attempque ?>, <?php echo $AnsC ?>, <?php echo $AnsC ?>, <?php echo $AnsIc ?>],
        backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de']
      }
    ]
  }
  var pieOptions = {
    legend: {
      display: false
    }
  }
  // Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  // eslint-disable-next-line no-unused-vars
  var pieChart = new Chart(pieChartCanvas, {
    type: 'doughnut',
    data: pieData,
    options: pieOptions
  })

  //-----------------
  // - END PIE CHART -
  //-----------------
      });
  </script>