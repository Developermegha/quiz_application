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
              <li class="breadcrumb-item active">Profile</li>
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

                <p class="text-muted text-center">Software Engineer</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Followers</b> <a class="float-right">1,322</a>
                  </li>
                  <li class="list-group-item">
                    <b>Following</b> <a class="float-right">543</a>
                  </li>
                  <li class="list-group-item">
                    <b>Friends</b> <a class="float-right">13,287</a>
                  </li>
                </ul>

                <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <!--<div class="card card-primary">-->
            <!--  <div class="card-header">-->
            <!--    <h3 class="card-title">About Me</h3>-->
            <!--  </div>-->
              <!-- /.card-header -->
            <!--  <div class="card-body">-->
            <!--    <strong><i class="fas fa-book mr-1"></i> Education</strong>-->

            <!--    <p class="text-muted">-->
            <!--      B.S. in Computer Science from the University of Tennessee at Knoxville-->
            <!--    </p>-->

            <!--    <hr>-->

            <!--    <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>-->

            <!--    <p class="text-muted">Malibu, California</p>-->

            <!--    <hr>-->

            <!--    <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>-->

            <!--    <p class="text-muted">-->
            <!--      <span class="tag tag-danger">UI Design</span>-->
            <!--      <span class="tag tag-success">Coding</span>-->
            <!--      <span class="tag tag-info">Javascript</span>-->
            <!--      <span class="tag tag-warning">PHP</span>-->
            <!--      <span class="tag tag-primary">Node.js</span>-->
            <!--    </p>-->

            <!--    <hr>-->

            <!--    <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>-->

            <!--    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>-->
            <!--  </div>-->
              <!-- /.card-body -->
            <!--</div>-->
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
                  
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                    <div class="active tab-pane" id="allstudentdata">
                        <form class="form-horizontal" method="post" id="profileupdate" action="<?php echo base_url('admin/updateStudent'); ?>">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">User Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="username" name="username" placeholder="User Name" value="<?php  echo $adminData->username; ?>" required>
                        </div>
                      </div>
                     
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php  echo $adminData->email; ?>" required>
                        </div>
                      </div>
                      
                      
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger" id="dataupdate">Submit</button>
                        </div>
                      </div>
                    </form>
                    </div>
                    <!-- /.tab-pane -->
                  
                    <div class="tab-pane" id="changepassword">
                    <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Old Password</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" id="old_password" name="old_password" placeholder="Old Password" value="<?php echo decrypt_script('VjFiQnhUTys1UklreFBmanJBRno5UT09');?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">New Password</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" id="new_password" name="new_password" placeholder="New Password">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Retype New Password</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Retype New Password">
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                    <!-- /.tab-pane -->
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
  