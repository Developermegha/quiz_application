
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
                <div class='col-sm-3 float-sm-right '>
                    <a href='#' data-toggle="modal" data-target="#modal-default" class="btn btn-block bg-gradient-success">Add Quiz</a>
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
                <h3 class="card-title">List of All Quiz</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  
                <table id="quiz_list" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Subject</th>
                    <th>Topic</th>
                    <th>Quiz Type</th>
                    <th>Action</th>
                    
                  </tr>
                  </thead>
                  <tbody>
                      <?php 
                      if(!empty($quiz))
                      {
                          foreach($quiz as $q)
                          {?>
                             <tr>
                                 <td><?php echo $id=$q['id'] ?></td>
                                 <td><?php echo $q['name'] ?></td>
                                 <td><?php echo $q['course_name'] ?></td>
                                 <td><?php echo $q['topic_name'] ?></td>
                                 <td><?php echo $q['quiztype'] ?></td>
                                 <td>
                                    
                                 <?php
                                    $today = date("Y-m-d H:i:s"); 
                                    //if($q['quiz_start_time']<=$today && $q['quiz_end_time']>=$today)
                                    if($q['active']==1)
                                    {
                                    ?>
                                        <a href="#" class="btn btn-sm btn-success" >
                                            Active
                                        </a>
                                       
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                        <a href="#" class="btn btn-sm btn-warning" >
                                        Expired
                                        </a>
                                    <?php } ?>
                                    <a href="<?php echo base_url()?>admin/editQuiz/<?php echo $id ?>" class="btn btn-sm btn-info" >
                                        <i class="fas fa-pen"></i> Edit
                                    </a>
                                    <a href="#" class="btn btn-sm btn-danger" onclick='deleteQuiz(<?php echo $id=$q['id'] ?>);'>
                                    <i class="fas fa-trash"></i> Delete
                                    </a>
                                    
                                </td>
                             </tr> 
                          <?php }
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
    function deleteQuiz(id)
    {
        var id=id;
        $.ajax({ 
                    url:"<?php echo base_url(); ?>admin/deleteQuiz",
                    type: "POST",
                    data: {id:id}, 
                    
                    dataType:'json',
                    success:function(data) {
                        if(data.success) 
                        {

                            Swal.fire(data.msg);
                            setTimeout(function() {
                                window.location.href = '<?php echo base_url(); ?>admin/allQuiz';
                                }, 1000); 

                        } 
                        else 
                        {
                            Swal.fire(data.msg);
                        }
                        
                    },
                    error: function(err) 
                    {
                        Swal.fire(data.msg);
                    }
                });
        
    }
</script>
