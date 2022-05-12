
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            <!--<div class="col-sm-6">-->
            <!--    <div class='col-sm-3 float-sm-right '>-->
            <!--        <a href='#' data-toggle="modal" data-target="#modal-default" class="btn btn-block bg-gradient-success">Add Quiz</a>-->
            <!--    </div>-->
            <!--</div>-->
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
                <h3 class="card-title">All Quiz</h3>
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
                    <th>Active</th>
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
                                 <td>  <?php
                                    $cdate=date('Y-m-d H:i:s');
                                    $st=$q['quiz_start_time'];
                                    $et=$q['quiz_end_time'];
                                    // if(($cdate=$st) && ($cdate>=$et))
                                    if($q['active'] == 1)
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
                               </td>
                                 <td>
                                    
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
      
    function getTopicFunction()
    {
        var att_type=$("#qst_type").val();
        var sub=$("#subject").val();
        if(sub==0)
        {
            alert('Please select Subject');
        }
        $.ajax({ 
                    url:"<?php echo base_url('student/getTopicList')?>",
                    type: "POST",
                    data: {att_type:att_type ,sub:sub}, 
                    
                    dataType:'json',
                    success:function(data) {
                        console.log(data);
                        $('#att_type').show();
                        $('#topic').empty();
                        $('#topic').append('<option value="">Select Topic/Unit wise</option>');
                         for (var i = 0; i < data.length; i++) {
                            $('#topic').append('<option value="' + data[i].id + '">' + data[i].topic_name+ '</option>');
                         }
                    },
                    error: function(err) 
                    {
                        console.log(err);
                    }
                });
    }
  </script>