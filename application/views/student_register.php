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
      <p class="login-box-msg">Register a new Student</p>

      <form action="" method="post" id="registration_form">
        <div class="input-group mb-3">
          <input type="text" class="form-control required" placeholder="User Name" id='user_name' name='user_name'>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        
        <label id="user_name-error" class="error" for="user_name"></label>
        <div class="input-group mb-3">
          <input type="text" class="form-control required" placeholder="First Name" id='first_name' name='first_name'>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <label id="first_name-error" class="error" for="first_name"></label>
        <div class="input-group mb-3">
          <input type="text" class="form-control required" placeholder="Last Name" id='last_name' name='last_name'>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <label id="last_name-error" class="error" for="last_name"></label>
        
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
          <input type="text" class="form-control required" placeholder="Mobile"  id='mobile' name='mobile'>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <label id="mobile-error" class="error" for="mobile"></label>
        <div class="input-group mb-3">
          <input type="text" class="form-control required" placeholder="Otp "  id='otp' name='otp'>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <label id="otp-error" class="error" for="otp"></label>
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
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block" name="submit" id="submit" value="submit">Register</button>
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
        
        $('#registration_form').validate({
            rules: {
                user_name: {
                    required: true,
                    minlength: 5,
                    remote: {
                        url: "<?php echo base_url(); ?>/Student/checkUserNameExists",
                        type: "post",
                        data: {
                            user_name: function () {
                                return $("#user_name").val();
                            },
                            success: function (data) {
                                return true;
                            }
                        }
                    }
                },
                first_name: {
                    required: true,
                },
                last_name: {
                    required: true,
                },
                mobile: {
                    
                    required:true,
                    number: true,
                    minlength:9,
                    maxlength:10,
                      remote: {
                        url: "<?php echo base_url(); ?>student/sendSmsOtp",
                        type: "post",
                        data: {
                            mobile_number: function () {
                                return $("#mobile").val();
                            },
                            success: function (data) {
                                return true;
                            }
                        }
                    }
                },
                email: {
                    required: true,
                    email: true,
                      remote: {
                        url: "<?php echo base_url('Student/checkEmailExists'); ?>",
                        type: "post",
                        data: {
                            email: function () {
                                return $("#email").val();
                            },
                             success: function (data) {
                                return true;
                            }
                        }
                    }
                },
                password: {
                    required: true,
                    minlength: 5
                },
                otp: {
                    remote: {
                        url: "<?php echo base_url('student/checkOtpExists'); ?>",
                        type: "post",
                        data: {
                            mobile: function () {
                                return $("#mobile").val();
                            }
                        }
                    }
                },
            },
            messages: {
                user_name: {
                    required: "Username is required",
                    minlength: "Username must contain at least 5 characters",
                    remote: "Username already exists",
                },
                first_name: {
                    required: "First name is required",
                },
                last_name: {
                    required: "Last name is required",
                },
                mobile: {
                    required:"Mobile number is required",
                    number: "Please enter valid mobile number.",
                    minlength: "Please enter mobile number 10 digit format.",
                    maxlength: "Please enter mobile number 10 digit format.",
                },
                email: {
                    required: "Email is required",
                    email: "Enter a valid email. Ex: example@gmail.com",
                     remote: "Email already exists",
                },
                password: {
                    required: "Password is required",
                    minlength: "Password must contain at least 5 characters"
                },
                referral_code: {
                    remote: "Please enter correct referral code.",
                },
                otp: {
                    remote: "Please enter correct otp.",
                },
            },
            submitHandler:function(form){
                $.ajax({
                   url : "<?php echo base_url('student/register_student'); ?>" ,
                   type : 'POST',
                   data : $('#registration_form').serialize(),
                   success:function(resp){
                       var result = JSON.parse(resp);
                       if(result.code == 'success'){
                           $('#msg').html('<span>'+result.msg+'</span>')
                           setTimeout(function(){
                              window.location.href="<?php echo base_url('student/login'); ?>"; 
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
