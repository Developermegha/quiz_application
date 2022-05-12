
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New User</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add User</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title"></h3>

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
                <form method="post" action="<?php echo base_url('admin/insert_new_user') ?>">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Enter User Name</label>
                                <input type="text" class="form-control" name="username" id="username" style="width: 100%;"  placeholder="Enter UserName"  required> 
                            </div>
                        </div>
                                    
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Enter Password</label>
                                <input type="password" class="form-control" name="password" id="password" style="width: 100%;"  placeholder="Enter Password"  required> 
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Enter Email</label>
                                <input type="text" class="form-control" name="email" id="email" style="width: 100%;"  placeholder="Enter Email"  required> 
                            </div>
                        </div>
                        
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Select User Type</label>
                                <select class="form-control select2" style="width: 100%;" name='role' id='role' required onchange='getCourseList()'>
                                    <option value=''>Select User Type</option>
                                    <option value='1'>Admin</option>
                                    <option value='2'>Staff</option>
                                    </select>
                            </div>
                            
                        </div>
                      
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Select Status</label>
                                <select class="form-control select2" style="width: 100%;" name='status' id='status' required >
                                    <option value=''>Select Status</option>
                                    <option value='1'>Active</option>
                                    <option value='0'>In-Active</option>
                                    </select>
                            </div>
                            
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" id='role_div' style='display:none;'>
                                <label>Select Course</label>
                                <select class="form-control select2" style="width: 100%;" name='course' id='course' required >
                                    <option value=''></option>
                                    <?php if(!empty($courses))
                                    { 
                                    foreach($courses as $c)
                                    {
                                    ?>
                                        <option value='<?php echo $c['id'] ?>'><?php echo $c['course_name'] ?></option>
                                    <?php } } ?>
                                </select>
                            </div>
                            
                        </div>
                        <div class="col-md-12">
                            <div class="form-group text-center">
                                <input type="submit" value="Add User" name='submit' class="btn btn-success ">
                                <input type="button" value="Cancel" name='submit' class="btn btn-danger ">
                            </div>
                        </div>

                </div>
                    <!-- /.row -->
                </form>
            </div>
          
        </div>
        <!-- /.card -->

       
       
        
        
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
    