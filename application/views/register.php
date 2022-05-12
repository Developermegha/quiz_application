<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Registration Page</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/fontawesome-free/css/all.min.css') ?>">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/adminlte.min.css') ?>">
</head>
<style>
    .error{
        color:red;
    }
</style>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="../../index2.html"><b>Admin</b>LTE</a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new Admin</p>

      <form action="" method="post" id="register_frm">
        <div class="input-group mb-3">
          <input type="text" class="form-control required" placeholder="User name" id='username' name='username'>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <label id="username-error" class="error" for="username"></label>
        <div class="input-group mb-3">
          <input type="email" class="form-control required" placeholder="Email"  id='email' name='email'>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <label id="email-error" class="error" for="email"></label>
        <div class="input-group mb-3">
          <input type="password" class="form-control required" placeholder="Password" id='password' name='password'>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <label id="password-error" class="error" for="password"></label>
        <div class="input-group mb-3">
          <input type="password" class="form-control required" placeholder="Retype password" id='retype_password' name='retype_password'>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <label id="retype_password-error" class="error" for="retype_password"></label>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
               I agree to the <a href="#">terms</a>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
        <div class="row">
          <div class="col-12">
            <div id="msg"></div>
          </div>
          
          <!-- /.col -->
        </div>
      </form>

      <!--<div class="social-auth-links text-center">-->
      <!--  <p>- OR -</p>-->
      <!--  <a href="#" class="btn btn-block btn-primary">-->
      <!--    <i class="fab fa-facebook mr-2"></i>-->
      <!--    Sign up using Facebook-->
      <!--  </a>-->
      <!--  <a href="#" class="btn btn-block btn-danger">-->
      <!--    <i class="fab fa-google-plus mr-2"></i>-->
      <!--    Sign up using Google+-->
      <!--  </a>-->
      <!--</div>-->

      <!--<a href="login.html" class="text-center">I already have a membership</a>-->
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="<?php echo base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/dist/js/adminlte.min.js') ?>"></script>
<!-- jquery validation -->
<script src="<?php echo base_url('assets/plugins/jquery-validation/jquery.validate.js') ?>"></script>
<script>
    $(document).ready(function(){
        
        $('#register_frm').validate({
            
            rules:{
                password:{
                    minlength:6,
                    maxlength:10,
                },
                email:{
                    email:true,
                    required:true,
                },
                username:{
                    required:true
                },
                retype_password:{
                    required:true
                }
            },
            submitHandler:function(form){
                $.ajax({
                   url : "<?php echo base_url('admin/register_admin'); ?>" ,
                   type : 'POST',
                   data : $('#register_frm').serialize(),
                   success:function(resp){
                       var result = JSON.parse(resp);
                       if(result.code == 'success'){
                           $('#msg').html('<span>'+result.msg+'</span>')
                           setTimeout(function(){
                              window.location.href="<?php echo base_url('admin/login'); ?>"; 
                           },1000);
                       }else{
                           $('#msg').html('<span>'+result.msg+'</span>')
                       }
                   }
                });
            }
        
        });
       
    });
</script>
</body>
</html>
