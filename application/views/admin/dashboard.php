<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
    <!-- /.content-header -->
     
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php if(!empty($allQuiz)){
                echo $allQuiz; } else
                {
                ?> 0 <?php } ?></h3>

                <p>Total Quiz Count</p>
              </div>
              <div class="icon">
                <i class="ion ion-list"></i>
              </div>
              <a href="<?php echo base_url('admin/allQuiz') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php if(!empty($activeQuiz)){
                echo $activeQuiz; } else
                {
                ?> 0 <?php } ?></h3>

                <p>Active Quiz Count</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo base_url()?>admin/activeQuiz/Active" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php if(!empty($delQuiz)){
                echo $delQuiz; } else
                {
                ?> 0 <?php } ?></h3>

                <p>Expired Quiz List</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="<?php echo base_url()?>admin/activeQuiz/Expired" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3><?php print_r($allSub) ?></h3>
    
                        <p>Total Subjects</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="<?php echo base_url('admin/allCourse') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
          <!-- ./col -->
        </div>
                  
        <!-- Main row -->
        <div class="row">
             <div class="col-md-6">
                <!-- USERS LIST -->
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">LeaderBoard</h3>

                    <div class="card-tools">
                      <span class="badge badge-danger"></span>
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body p-0">
                    <ul class="users-list clearfix">
                      <li>
                        <img src="<?php echo base_url(); ?>assets/img/blank_profile.png" alt="User Image">
                        <a class="users-list-name" href="#">Alexander Pierce</a>
                        <span class="users-list-date">Score -Subject</span>
                        
                      </li>
                      <li>
                        <img src="<?php echo base_url(); ?>assets/img/blank_profile.png" alt="User Image">
                        <a class="users-list-name" href="#">Norman</a>
                        <span class="users-list-date">Score-Subject</span>
                      </li>
                      <li>
                        <img src="<?php echo base_url(); ?>assets/img/blank_profile.png" alt="User Image">
                        <a class="users-list-name" href="#">Jane</a>
                        <span class="users-list-date">Score-Subject</span>
                      </li>
                      <li>
                        <img src="<?php echo base_url(); ?>assets/img/blank_profile.png" alt="User Image">
                        <a class="users-list-name" href="#">John</a>
                        <span class="users-list-date">Score-Subject</span>
                      </li>
                      <li>
                        <img src="<?php echo base_url(); ?>assets/img/blank_profile.png" alt="User Image">
                        <a class="users-list-name" href="#">Alexander</a>
                        <span class="users-list-date">Score-Subject</span>
                      </li>
                      <li>
                        <img src="<?php echo base_url(); ?>assets/img/blank_profile.png" alt="User Image">
                        <a class="users-list-name" href="#">Sarah</a>
                        <span class="users-list-date">Score-Subject</span>
                      </li>
                      <li>
                        <img src="<?php echo base_url(); ?>assets/img/blank_profile.png" alt="User Image">
                        <a class="users-list-name" href="#">Nora</a>
                        <span class="users-list-date">Score-Subject</span>
                      </li>
                      <li>
                        <img src="<?php echo base_url(); ?>assets/img/blank_profile.png" alt="User Image">
                        <a class="users-list-name" href="#">Nadia</a>
                        <span class="users-list-date">Score-Subject</span>
                      </li>
                    </ul>
                    <!-- /.users-list -->
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer text-center">
                    <!--<a href="javascript:">View All Users</a>-->
                  </div>
                  <!-- /.card-footer -->
                </div>
                <!--/.card -->
              </div>
             <div class="col-md-6">
                <div class="card">
                    <div class="card-header border-transparent">
                        <h3 class="card-title">Subject Wise Quiz Count</h3>
        
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
                  <div class="card-body p-0">
                    <div class="table-responsive">
                      <table class="table m-0 scrollable">
                        <thead>
                        <tr>
                          
                          <th>Subject Name</th>
                          
                          <th>Quiz Count</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(!empty($subWiseCount)) {
                        foreach($subWiseCount as $val) {?>    
                        <tr>
                          
                          <td><?php echo $val['course_name']; ?></td>
                          
                          <td>
                            <span class="badge badge-success"><?php echo $val['count']; ?></span>
                          </td>
                        </tr>
                        <?php } } ?>
                        </tbody>
                      </table>
                    </div>
                    <!-- /.table-responsive -->
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer clearfix">
                        <a href="<?php echo base_url()?>admin/activeQuiz/Topicwise" class="btn btn-sm btn-secondary float-left">View Topic Wise Quiz</a>
                        <a href="<?php echo base_url()?>admin/activeQuiz/Subjectwise" class="btn btn-sm btn-secondary float-right">View All</a>
                  </div>
                  <!-- /.card-footer -->
                </div> 
            </div>
           
              
        </div>
        <div class="row">
            <div class='col-md-6'>
                <div class="card card-widget widget-user-2 shadow-sm">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-warning">
                    <h6>User Count</h6>
                    </div>
                    <div class="card-footer p-0">
                        <ul class="nav flex-column">
                        <?php foreach($userCount as $u){ 
                        if(($u['count']%2)==0)
                        {
                           $color='info'; 
                        }
                        else
                        {
                            $color='success'; 
                        }
                        ?>
                          <li class="nav-item">
                            <a href="#" class="nav-link">
                              <?php echo $u['role']; ?><span class="float-right badge bg-<?php echo $color; ?>"> <?php echo $u['count']; ?></span>
                            </a>
                          </li>
                  
                    <?php } ?>
                  
                        </ul>
                        <div class="card-footer clearfix">
                            <a href="<?php echo base_url()?>admin/alluser" class="btn btn-sm btn-warning float-right">View All</a>
                        </div>
                        <!-- /.card-footer -->
                    </div>
                </div>
            </div>
           
            <div class="col-md-6">
            <!-- DONUT CHART -->
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Donut Chart</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            </div>
           
        </div>
        
        <br>
        
        <!-- /.col -->
        <div class="col-md-6">
            <p class="text-center">
                <strong>Question Bank</strong>
            </p>
            <div class="progress-group">
                Physiology
                <span class="float-right"><b><?php echo $qst_physio ?></b>/100</span>
                <div class="progress progress-sm">
                    <div class="progress-bar bg-primary" style="width: <?php echo $qst_physio ?>%"></div>
                </div>
            </div>
            <!-- /.progress-group -->
            <div class="progress-group">
                Biochemistry
                <span class="float-right"><b><?php  echo $qst_biochem   ?></b>/100</span>
                <div class="progress progress-sm">
                    <div class="progress-bar bg-danger" style="width: <?php  echo $qst_biochem   ?>%"></div>
                </div>
            </div>
            <!-- /.progress-group -->
            <div class="progress-group">
                <span class="progress-text">physics</span>
                <span class="float-right"><b><?php  echo $qst_physics   ?></b>/100</span>
                <div class="progress progress-sm">
                    <div class="progress-bar bg-success" style="width: <?php  echo $qst_physics   ?>%"></div>
                </div>
            </div>
            <!-- /.progress-group -->
            <div class="progress-group">
                Biology
                <span class="float-right"><b><?php  echo $qst_bio   ?></b>/100</span>
                <div class="progress progress-sm">
                    <div class="progress-bar bg-warning" style="width: <?php  echo $qst_bio   ?>%"></div>
                </div>
            </div>
            <!-- /.progress-group -->
        </div>
        <!-- /.col --><br>
        
        
       
        <section class="col-lg-6 ">
             <!-- Calendar -->
            <div class="card bg-gradient-success">
              <div class="card-header border-0">

                <h3 class="card-title">
                  <i class="far fa-calendar-alt"></i>
                  Calendar
                </h3>
                <!-- tools card -->
                <div class="card-tools">
                  <!-- button with a dropdown -->
                  <div class="btn-group">
                    <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52">
                      <i class="fas fa-bars"></i>
                    </button>
                    <div class="dropdown-menu" role="menu">
                      <a href="#" class="dropdown-item">Add new event</a>
                      <a href="#" class="dropdown-item">Clear events</a>
                      <div class="dropdown-divider"></div>
                      <a href="#" class="dropdown-item">View calendar</a>
                    </div>
                  </div>
                  <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
                <!-- /. tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body pt-0">
                <!--The calendar -->
                <div id="calendar" style="width: 100%"></div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- Map card -->
            <div class="card bg-gradient-primary">
              
              
              <!-- /.card-body-->
              <div class="card-footer bg-transparent">
                <div class="row">
                  <div class="col-4 text-center">
                    <div id="sparkline-1"></div>
                    <div class="text-white">Visitors</div>
                  </div>
                  <!-- ./col -->
                  <div class="col-4 text-center">
                    <div id="sparkline-2"></div>
                    <div class="text-white">Online</div>
                  </div>
                  <!-- ./col -->
                  <div class="col-4 text-center">
                    <div id="sparkline-3"></div>
                    <div class="text-white">Sales</div>
                  </div>
                  <!-- ./col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- /.card -->

            

           
          </section>
        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    
  </div>
  <!-- /.content-wrapper -->
  <script>
      $(function () {
           //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    
    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    var donutData        = {
      labels: [
          'All',
          'Active',
          'Expired',
          
      ],
      datasets: [
        {
          data: [<?php echo $allQuiz ?>,<?php echo $activeQuiz ?>,<?php echo $delQuiz ?>],
          backgroundColor : ['#f39c12', '#00a65a', '#f56954'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var pieData        = {
      labels: [
          'All',
          'Active',
          'Expired',
         
      ],
      datasets: [
        {
          data: [<?php echo $allQuiz ?>,<?php echo $activeQuiz ?>,<?php echo $delQuiz ?>],
          backgroundColor : ['#f39c12', '#00a65a', '#f56954'],
        }
      ]
    }
    new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: pieData,
      options: donutOptions
    });

   
          
      });
  </script>