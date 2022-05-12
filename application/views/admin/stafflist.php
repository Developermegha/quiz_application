
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
              
          </div>
          <div class="col-sm-6">
                  <div class='col-sm-3 float-sm-right '><a href='<?php echo base_url('admin/addUser') ?>' class="btn btn-block bg-gradient-success">Add User</a></div>
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
                <h3 class="card-title">List of Users</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="adminlist" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Active</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php if(!empty($users)) 
                  { 
                    foreach($users as $us)
                    {?>
                        <tr>
                            <td><?php echo $us['id'] ?></td>
                            <td><?php echo $us['username'] ?></td>
                            <td><?php echo $us['email'] ?></td>
                            <td><?php echo $us['role'] ==1 ? ' <a href="#" class="btn btn-sm btn-success">
                                    Admin
                                </a>' : '<a href="#" class="btn btn-sm btn-warning">
                                    Staff
                                </a>' ; ?></td>
                            <td><?php echo  $us['status'] == 1 ? '<a href="#" class="btn btn-sm btn-info">Active</a>' : '<a href="#" class="btn btn-sm btn-primary">In-Active</a>' ?></td>
                            <td> <button type="button"  onclick="remove_class(<?php echo $us['id']; ?>)" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                                
                                <a href="<?php echo base_url('admin/editUser/'.$us['id']); ?>" class="btn btn-sm btn-info">
                                    <i class="fas fa-pen"></i> Edit
                                </a></td>
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
 
<script>
$(document).ready(function(){
    $('#adminlist').DataTable(); 
});
   
</script>
<script>
        function remove_class(i)
        {
            $.confirm({
                title: 'Confirm!',
                content: 'Are You Sure To Delete!',
                buttons: {
                    confirm: function () {
                        $.ajax({
                            url: "<?php echo base_url('admin/deleteStudent'); ?>", 
                            type: "POST", 
                            data: {id:i},
                            dataType: 'json',
                            success: function (data) {
                                console.log(data);
                                if(data.success == true)
                                {
                                    $.alert('Deleted!!');
                                    window.location.reload();
                                }
                                else
                                {
                                    $.alert('Something went wrong!');
                                }
                            },
                            error:function(e){
                                console.log(e);
                            }
                        }); 
                    },
                    cancel: function () {
                        $.alert('Canceled!');
                    }                    
                }
            });
        }
    </script>