
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
              <?php if(!empty($msg)){ ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i> Alert!</h5>
                    <?php echo $msg; ?>
                </div>
            <?php } ?>
            </div>
          <div class="col-sm-6">
                <div class='col-sm-3 float-sm-right'>
                    <!--<a href='<?php echo base_url('admin/addCourse') ?>' class="btn btn-block bg-gradient-success">Add Course</a>-->
                    <button type="button" class="btn btn-block bg-gradient-success" data-toggle="modal" data-target="#add_course">
                     Add Course
                    </button>
                </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
           

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">List of Courses</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="course" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Course name</th>
                    <th>Status</th>
                    
                  </tr>
                  </thead>
                  <tbody>
                  <?php if(!empty($courses)) 
                  { 
                     
                      
                    foreach($courses as $c)
                    {?>
                        <tr>
                            <td><?php echo $c['id'] ?></td>
                            <td><?php echo $c['course_name'] ?></td>
                            <td><?php
                            if($c['status']==1)
                            {
                            ?>
                                <a href="#" class="btn btn-sm btn-success ">
                                    Active
                                </a>
                            <?php
                            }
                            else
                            {
                            ?>
                                <a href="#" class="btn btn-sm btn-danger">
                                    Deactive
                                </a>
                            <?php
                            }?>
                                <a class="btn btn-sm btn-danger " onclick='deleteSubj(<?php echo $c['id']  ?>);'>
                                    <i class="fas fa-trash"></i> Delete
                                </a>
                                <a  class="btn btn-sm btn-info editsub" onclick='editSubject(<?php echo $c['id'] ?>)' >
                                    <i class="fas fa-pen"></i> Edit
                                </a>
                           </td>
                            
                        </tr>
                  <?php  
                    }
                  }
                  ?>
                  </tbody>
                  
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 

 
    <!-- ./wrapper -->
    <!--modal -->
    <div class="modal fade" id="add_course">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method='post' action='<?php echo base_url('admin/insert_course'); ?>'>
                    <div class="modal-header">
              <h4 class="modal-title">Add New Course</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
                    <div class="modal-body">
                 
                <div class="form-group">
                    <label for="inputName">Subject Name</label>
                    <input type="text" id="course_name" name='course_name' class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Select Status</label>
                    <select class="form-control" name='status' id='status' required>
                            <option value='1'>Active</option>
                            <option value='0'>DeActive</option>
                    </select>
                </div>
            </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create new Subject</button>
                    </div>
                </form>
            </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    
    <!--modal -->
    <div class="modal fade" id="edit_course">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method='post' action='<?php echo base_url('admin/update_course'); ?>'>
                    <div class="modal-header">
              <h4 class="modal-title">Edit Subject</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
                    <div class="modal-body">
                 
                <div class="form-group">
                    <label for="inputName">Subject Name</label>
                    <input type="text" id="sub_name" name='course_name' class="form-control" required>
                    <input type="hidden" id="sub_id" name='sub_id' class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Select Status</label>
                    <select class="form-control" name='status' id='sub_status' required>
                            <option value='1'>Active</option>
                            <option value='0'>InActive</option>
                    </select>
                </div>
            </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
<script>
    function editSubject(id)
  {
      $('#edit_course').modal('show');
	    $.ajax({ 
                    url:"<?php echo base_url(); ?>admin/edit_course",
                    type: "POST",
                    data: {id:id}, 
                    
                    dataType:'json',
                    success:function(data) {
                        console.log(data);
                        $('#sub_name').val(data[0]['course_name']);
                        $('#sub_id').val(data[0]['id']);
                        $('#sub_status').val(data[0]['status']);
                        
                    },
                    error: function(err) 
                    {
                        console.log(err);
                    }
                });
  }
  function deleteSubj(id)
  {
     
      $.ajax({ 
            url:"<?php echo base_url(); ?>admin/DeleteSub",
            type: "POST",
            data: {id:id}, 
            dataType:'json',
            success:function(data) {
                console.log(data);
                if(data.success) 
                {
                    Swal.fire(data.msg);
                    setTimeout(function() {
                    window.location.href = '<?php echo base_url(); ?>admin/allCourse';
                    }, 1000); 
                } 
            },
            error: function(err) 
            {
                console.log(err);
            }
        });
  }
</script>

