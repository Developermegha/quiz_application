<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Student Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="<?php echo base_url('assets/dist/img/user4-128x128.jpg') ?>"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?php echo (isset($_SESSION['username']) && !empty($_SESSION['username']) ) ? $_SESSION['username']: ''; ?></h3>

                <p class="text-muted text-center">Awards</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Bronze</b> <a class="float-right"> <?php echo $bronze_awards;  ?></a><img src="https://kingsinternational.academy/quiz_application/assets/img/troffy.gif" style="width: 80px;margin-left: 15px;">
                  </li>
                  <li class="list-group-item">
                    <b>Silver</b> <a class="float-right"><?php echo $silver_awards;  ?></a><img src="https://kingsinternational.academy/quiz_application/assets/img/troffy.gif" style="width: 80px;margin-left: 15px;">
                  </li>
                  <li class="list-group-item">
                    <b>Gold</b> <a class="float-right"><?php echo $gold_awards;  ?></a><img src="https://kingsinternational.academy/quiz_application/assets/img/troffy.gif" style="width: 80px;margin-left: 15px;">
                  </li>
                  <li class="list-group-item">
                    <b>Platinum</b> <a class="float-right"><?php echo $platinum_awards;  ?></a><img src="https://kingsinternational.academy/quiz_application/assets/img/troffy.gif" style="width: 80px;margin-left: 15px;">
                  </li>
                </ul>

                <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <!--<li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a></li>-->
                  <li class="nav-item"><a class="nav-link active" href="#allstudentdata" data-toggle="tab">All Details</a></li>
                  <li class="nav-item"><a class="nav-link" href="#changepassword" data-toggle="tab">Change Password</a></li>
                  <li class="nav-item"><a class="nav-link" href="#performance" data-toggle="tab">performance</a></li>
                  
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                    <div class="active tab-pane" id="allstudentdata">
                        <form class="form-horizontal" method="post" id="profileupdate" action="<?php echo base_url('student/updateDetail/'.$studentAr->id); ?>">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">First Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="first_name"  name="first_name" placeholder="First Name" value="<?php  echo $studentAr->first_name; ?>" required>
                        </div>
                      </div>
                       <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Last Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" value="<?php  echo $studentAr->last_name; ?>" required>
                        </div>
                      </div>
                     
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php  echo $studentAr->email; ?>" required>
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Mobile</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile" value="<?php  echo $studentAr->mobile; ?>" required>
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger" >Submit</button>
                        </div>
                      </div>
                    </form>
                    </div>
                    <!-- /.tab-pane -->
                  
                    <div class="tab-pane" id="changepassword">
                    <form class="form-horizontal" action="<?php echo base_url('student/change_password'); ?>" method="post" id="changepsdfrm">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Old Password</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control " id="old_password" name="old_password" placeholder="Old Password" value="<?php echo $studentAr->password;?>" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">New Password</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" id="new_password" name="new_password" placeholder="New Password" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Retype New Password</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Retype New Password" required>
                        </div>
                      </div>
                      <input type="hidden" id="id" name ="id" value ="<?php echo $studentAr->id; ?>">
                      
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                    <!-- /.tab-pane -->
                     <div class="tab-pane" id="performance">
                    <form class="form-horizontal" action="<?php echo base_url('student/change_password'); ?>" method="post" id="changepsdfrm">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Old Password</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control " id="old_password" name="old_password" placeholder="Old Password" value="<?php echo $studentAr->password;?>" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">New Password</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" id="new_password" name="new_password" placeholder="New Password" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Retype New Password</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Retype New Password" required>
                        </div>
                      </div>
                      <input type="hidden" id="id" name ="id" value ="<?php echo $studentAr->id; ?>">
                      
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script>
      $('document').ready(function(){
          $('#changepsdfrm').validate({
              
             rules:{
                 old_password:{
                     required:true
                 },
                 new_password:{
                     required:true
                 },
                 confirm_password:{
                     required: true,
                     equalTo:new_password
                 },
             },
          });
      });
  </script>