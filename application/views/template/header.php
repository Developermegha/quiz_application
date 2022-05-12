<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>NEET QUIZ - Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- fullCalendar -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/fullcalendar/main.css') ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/fontawesome-free/css/all.min.css') ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') ?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
  <!-- JQVMap -->
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/daterangepicker/daterangepicker.css')?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/adminlte.min.css') ?>">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') ?>">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/daterangepicker/daterangepicker.css') ?>">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/summernote/summernote-bs4.min.css') ?>">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') ?>">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/toastr/toastr.min.css') ?>">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
    <!-- jQuery -->
    <script src="<?php echo base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?php echo base_url('assets/plugins/jquery-ui/jquery-ui.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/plugins/jquery-validation/jquery.validate.js') ?>"></script>
    <script src="<?php echo base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

</head>
<style>
    .error{
        color:red;
    }
</style>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?php echo base_url('assets/dist/img/AdminLTELogo.png') ?>" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Home</a>
      </li>
      <!--<li class="nav-item d-none d-sm-inline-block">-->
      <!--  <a href="#" class="nav-link">Contact</a>-->
      <!--</li>-->
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
  
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="<?php echo base_url('assets/dist/img/AdminLTELogo.png')?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">NEET QUIZ</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo base_url('assets/dist/img/user2-160x160.jpg') ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo (isset($_SESSION['username']) && !empty($_SESSION['username']) ) ? $_SESSION['username']: ''; ?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
          
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <?php if(isset($_SESSION['is_admin_loggedin']) && $_SESSION['is_admin_loggedin'] == true) {?>
            
          <li class="nav-item">
            <a href="<?php echo base_url('admin/dashboard') ?>" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <!--<span class="right badge badge-danger"></span>-->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-list"></i>
              <p>
                Course
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('admin/allCourse') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Course</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('admin/allTopics') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Topic</p>
                </a>
              </li>
              
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-list"></i>
              <p>
                Question
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('admin/allQuestions') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Questions</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('admin/addQuestions') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New Question</p>
                </a>
              </li>
              
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-list"></i>
              <p>
                Quiz
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('admin/allQuiz') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Quiz</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" data-toggle="modal" data-target="#modal-default" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New Quiz</p>
                </a>
              </li>
              
            </ul>
          </li>
            <li class="nav-item">
            <a href="<?php echo base_url('admin/alluser') ?>" class="nav-link">
              <i class="far fa-user-circle"></i>
              <p>
                Users
                <!--<span class="right badge badge-danger"></span>-->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('admin/editprofile') ?>" class="nav-link">
              <i class="far fa-user-circle"></i>
              <p>
                Profile
                <!--<span class="right badge badge-danger"></span>-->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('admin/logout') ?>" class="nav-link">
              <i class="fas fa-sign-out-alt"></i>
              <p>
                Logout
                <!--<span class="right badge badge-danger"></span>-->
              </p>
            </a>
          </li>
          <?php }else if(isset($_SESSION['is_student_loggedin']) && $_SESSION['is_student_loggedin'] == true){?>
          <li class="nav-item">
            <a href="<?php echo base_url('student/dashboard') ?>" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <!--<span class="right badge badge-danger"></span>-->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('student/editProfile') ?>" class="nav-link">
              <i class="far fa-user-circle"></i>
              <p>
                Profile
                <!--<span class="right badge badge-danger"></span>-->
              </p>
            </a>
          </li>
             <li class="nav-item">
            <a href="<?php echo base_url('student/quizlist') ?>" class="nav-link">
              <i class="far fa-user-circle"></i>
              <p>
                Active Quizs
                <!--<span class="right badge badge-danger"></span>-->
              </p>
            </a>
          </li>
          
            <li class="nav-item">
            <a href="<?php echo base_url('student/allQuiz') ?>" class="nav-link">
              <i class="far fa-user-circle"></i>
              <p>
                All Quizs
                <!--<span class="right badge badge-danger"></span>-->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('student/leaderboard') ?>" class="nav-link">
              <i class="far fa-user-circle"></i>
              <p>
                Leaderboard
                <!--<span class="right badge badge-danger"></span>-->
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="<?php echo base_url('student/logout') ?>" class="nav-link">
              <i class="fas fa-sign-out-alt"></i>
              <p>
                Logout
                <!--<span class="right badge badge-danger"></span>-->
              </p>
            </a>
          </li>
          <?php }else{?>
          <!--<li class="nav-item">-->
          <!--  <a href="<?php echo base_url('student/dashboard') ?>" class="nav-link">-->
          <!--   <i class="nav-icon fas fa-tachometer-alt"></i>-->
          <!--    <p>-->
          <!--      Dashboard-->
                <!--<span class="right badge badge-danger"></span>-->
          <!--    </p>-->
          <!--  </a>-->
          <!--</li>-->
          <!--<li class="nav-item">-->
          <!--  <a href="<?php echo base_url('student/editProfile') ?>" class="nav-link">-->
          <!--    <i class="far fa-user-circle"></i>-->
          <!--    <p>-->
          <!--      Profile-->
                <!--<span class="right badge badge-danger"></span>-->
          <!--    </p>-->
          <!--  </a>-->
          <!--</li>-->
          <!--<li class="nav-item">-->
          <!--  <a href="<?php echo base_url('student/logout') ?>" class="nav-link">-->
          <!--    <i class="fas fa-sign-out-alt"></i>-->
          <!--    <p>-->
          <!--      Logout-->
                <!--<span class="right badge badge-danger"></span>-->
          <!--    </p>-->
          <!--  </a>-->
          <!--</li>-->
          <?php }?>
        </ul>
      
      
       <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <?php if(isset($_SESSION['is_staff_loggedin']) && $_SESSION['is_staff_loggedin'] == true) {?>
            
          <li class="nav-item">
            <a href="<?php echo base_url('staff/dashboard') ?>" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <!--<span class="right badge badge-danger"></span>-->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-list"></i>
              <p>
                Topic/Unit
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
              <li class="nav-item">
                <a href="<?php echo base_url('staff/allTopics') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Topic</p>
                </a>
              </li>
              
               <li class="nav-item">
                <a href="<?php echo base_url('staff/allUnits') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Unit</p>
                </a>
              </li>
              
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-list"></i>
              <p>
                Question
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('staff/allQuestions') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Questions</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('staff/addQuestions') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New Question</p>
                </a>
              </li>
              
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-list"></i>
              <p>
                Quiz
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('staff/allQuiz_staffwise') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Quiz</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" data-toggle="modal" data-target="#modal-default" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New Quiz</p>
                </a>
              </li>
              
            </ul>
          </li>
          
          <li class="nav-item">
            <a href="<?php echo base_url('staff/editprofile') ?>" class="nav-link">
              <i class="far fa-user-circle"></i>
              <p>
                Profile
                <!--<span class="right badge badge-danger"></span>-->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('staff/logout') ?>" class="nav-link">
              <i class="fas fa-sign-out-alt"></i>
              <p>
                Logout
                <!--<span class="right badge badge-danger"></span>-->
              </p>
            </a>
          </li>
          <?php }?>
         
        </ul>
        
        
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  
  
  <!--modal -->
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method='post' action='<?php echo base_url('admin/newQuiz'); ?>'>
                    <div class="modal-header">
                        <h4 class="modal-title">Select Quiz Type</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="icheck-success d-inline">
                                <input type="radio" name="quiz" checked id="radioSuccess1" value='new_que'>
                                <label for="radioSuccess1">Add Quiz with New Questions
                                </label>
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="icheck-success d-inline">
                                <input type="radio" name="quiz" id="radioSuccess2" value='pre_que'>
                                <label for="radioSuccess2">Add Quiz with Existing Questions
                                </label>
                              </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    
     <div class="modal fade" id="modal-default1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method='post' action='<?php echo base_url('staff/newQuiz'); ?>'> 
                    <div class="modal-header">
                        <h4 class="modal-title">Select Quiz Type(Staff)</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="icheck-success d-inline">
                                <input type="radio" name="quiz" checked id="radioSuccess1" value='new_que'>
                                <label for="radioSuccess1">Add Quiz with New Questions
                                </label>
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="icheck-success d-inline">
                                <input type="radio" name="quiz"  id="radioSuccess2" value='pre_que'>
                                <label for="radioSuccess2">Add Quiz with Existing Questions
                                </label>
                              </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!-- /.modal -->
    
    <?php if(isset($_SESSION['is_staff_loggedin']) && $_SESSION['is_staff_loggedin'] == true) {?> 
     
    
    <?php   }  ?>