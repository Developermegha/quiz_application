
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit User</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit User</li>
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
                <button onclick="history.go(-1)" type="button" class="btn btn-warning float-right" >
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
                Back
              </button>
        
            </div>
          </div>
          <!-- /.card-header -->
            <div class="card-body">
                <form method="post" action="<?php echo base_url('admin/updateUser/'.$userdetails->id) ?>">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Enter User Name</label>
                                <input type="text" class="form-control" name="username" id="username" style="width: 100%;"  placeholder="Enter UserName"  required value="<?php echo $userdetails->username; ?>"> 
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Enter Email</label>
                                <input type="text" class="form-control" name="email" id="email" style="width: 100%;"  placeholder="Enter Email"  required value="<?php echo $userdetails->email; ?>"> 
                            </div>
                        </div>
                        
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Select User Type</label>
                                <select class="form-control select2" style="width: 100%;" name='role' id='role' required onchange='getAttributeFunction()'>
                                    <option value=''>Select User Type</option>
                                    <option value='1' <?php echo ($userdetails->role == 1) ? 'selected':''; ?> >Admin</option>
                                    <option value='2' <?php echo ($userdetails->role == 2) ? 'selected':''; ?> >Staff</option>
                                    </select>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Select Status</label>
                                <select class="form-control select2" style="width: 100%;" name='status' id='status' required >
                                    <option value=''>Select Status</option>
                                    <option value='1'  <?php echo ($userdetails->status == 1) ? 'selected':''; ?> >Active</option>
                                    <option value='0'  <?php echo ($userdetails->status == 0) ? 'selected':''; ?> >In-Active</option>
                                    </select>
                            </div>
                        </div>
                        
                        
                        <div class="col-md-12">
                            <div class="form-group text-center">
                                <input type="submit" value="Update User" name='submit' class="btn btn-success ">
                                <!--<input type="button" value="Cancel" name='submit' class="btn btn-danger ">-->
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
    