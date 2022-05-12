 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Topic</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
            <form method='post' action='<?php echo base_url('staff/insert_topic'); ?>'>
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">New Topic</h3>
                 
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Select Subject</label>
                        <select class="form-control" name='course_id' id='course_id' required>
                            <option value=''></option>
                            <?php if(!empty($course)){
                            foreach($course as $c) {?> 
                                <option value='<?php echo $c['id']; ?>'><?php echo $c['course_name']; ?></option>
                            <?php } }?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputName">Topic Name</label>
                        <input type="text" id="topic_name" name='topic_name' class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Select Status</label>
                        <select class="form-control" name='status' id='status' required>
                            <option value='1'>Active</option>
                            <option value='0'>InActive</option>
                        </select>
                    </div>
                 
                </div>
                <!-- /.card-body -->
                <div class="col-12">
                    <input type="submit" value="Create new Topic" name='submit' class="btn btn-success float-left">
                </div>
            </div>        
            <!-- /.card -->
            </form>
        </div>
       
      </div>
      <div class="row">
        
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
