<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>NEET QUIZ</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/fontawesome-free/css/all.min.css') ?>">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/adminlte.min.css') ?>">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="<?php base_url(); ?>"><b>NEET</b>Quiz</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="" method="post" id="login_frm">
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" id="email" name="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <label id="email-error" class="error" for="email"></label>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" id="password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <label id="password-error" class="error" for="password"></label>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mb-1">
        <a href="<?php echo base_url('admin/forgetpassword'); ?>"  data-toggle="modal" data-target="#modal-default" class="forgetpwd">I forgot my password</a>

      </p>
      <p class="mb-0">
          
        <a href="<?php echo base_url('admin/register'); ?>" class="text-center regid">Register</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>

  <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Forget Password</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?php echo base_url('login/forget_password');  ?>">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control required" placeholder="Email" id="admin_email" name="email" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <label>Role</label>
                     <div class="input-group mb-3">
                        
                         <select class="form-control" name="role">
                          <option value="1">Admin</option>
                          <option value="2">Staff</option>
                          <option value="3">Student</option>
                        </select>
                        
                    </div>
                    
                    
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" id="forget_password">Save changes</button></form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

<!-- /.login-box -->

<!-- jQuery -->
<script src="<?php echo base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/dist/js/adminlte.min.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/jquery-validation/jquery.validate.js') ?>"></script>
<script>
    $(document).ready(function(){
        var moduleUrl = window.location.pathname;
        if(moduleUrl == '/quiz_application/admin/login'){
            var ajaxurl =  '<?php echo base_url('admin/check_login'); ?>';
            $('.regid').attr('href','<?php echo base_url('admin/register')?>');
            $('.forgetpwd').attr('href','<?php echo base_url('student/forgetpassword')?>');
        }else if(moduleUrl == '/quiz_application/student/login'){
            var ajaxurl =  '<?php echo base_url('student/student_login'); ?>';
            $('.regid').attr('href','<?php echo base_url('student/register')?>');
            $('.forgetpwd').attr('href','<?php echo base_url('student/forgetpassword')?>');
        }else if(moduleUrl == '/quiz_application/staff/login'){
            var ajaxurl =  '<?php echo base_url('staff/staff_login'); ?>';
            
        }
        console.log(moduleUrl);
        console.log(ajaxurl);
        
        $('#login_frm').validate({
            
            rules:{
                password:{
                    minlength:6,
                    maxlength:10,
                },
                email:{
                    email:true,
                    required:true,
                },
                           },
            submitHandler:function(form){
                $.ajax({
                   url : ajaxurl,
                   type : 'POST',
                   data : $('#login_frm').serialize(),
                   success:function(resp){
                       
                       var result = JSON.parse(resp);
                    //   console.log(result.code);
                       if(result.code == 'success'){
                          
                           $('#msg').html('<span>'+result.msg+'</span>')
                           if(window.location.pathname == '/quiz_application/admin/login'){
                               var path = "<?php echo base_url('admin/dashboard'); ?>";
                           }else if(window.location.pathname == '/quiz_application/student/login'){
                               var path = "<?php echo base_url('student/dashboard'); ?>";
                           }else if(window.location.pathname == '/quiz_application/staff/login'){
                               var path = "<?php echo base_url('staff/dashboard'); ?>";
                           }
                           console.log(path);
                          setTimeout(function(){
                             window.location.href=path; 
                          },1000);
                       }else{
                           $('#msg').html('<span>'+result.msg+'</span>')
                       }
                   }
                });
            }
        
        });
        
        $('#forget_password').on('click',function(){
            if($('#admin_email').val() == ''){
                $('#admin_email-error').text('Please enter email');
            }else{
                $.ajax({
                    url:forgeturl,
                    type : 'POST',
                    data:{email:$('#admin_email').val()},
                      success:function(resp){
                          alert();
                      }
                   
                });
            }
           alert();
           
        });
       
    });
</script>
</body>
</html>
