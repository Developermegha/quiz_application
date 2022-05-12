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
                    <!--<a href='<?php echo base_url('admin/addTopic') ?>' class="btn btn-block bg-gradient-success float-sm-right">Add Topic</a>-->
                    <button type="button" class="btn btn-block bg-gradient-success" data-toggle="modal" data-target="#topic-add">
                     Add Topic
                    </button>
                </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card card-solid">
        <div class="card-body pb-0">
          <div class="row">
            <?php if(!empty($topics)) 
                {
                    foreach($topics as $t)
                    {?>
                        <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                            <div class="card bg-light d-flex flex-fill">
                                <div class="card-header border-bottom-0">
                                   <b>Topic: </b> <?php echo $t['topic_name'] ?>
                                </div>
                                <div class="card-body pt-0">
                                  <div class="row">
                                    <div class="col-12">
                                      <h2 class="lead"><b></b></h2>
                                      <p ><b>Course: </b>  <?php echo $t['course_name'] ?> 
                                            
                                      </p>
                                      <p><b>Quiz Type: </b> <?php echo $t['quiztype'] ?> </p>
                                      
                                    </div>
                                     
                                  </div>
                                </div>
                                <div class="card-footer">
                                   <div class="text-right1">
                                        <?php if($t['active']==1){ ?>
                                        <a href="#" class="btn btn-sm btn-success">
                                           Active
                                        </a>
                                        <?php } 
                                        else
                                        {?>
                                        <a href="#" class="btn btn-sm btn-danger">
                                        </a>
                                        <?php } ?>
                                        <a href="#" class="btn btn-sm bg-danger" onclick='deleteTopic(<?php echo $t['id']  ?>);'>
                                          <i class="fas fa-trash"></i> Delete
                                        </a>
                                        <a href="<?php echo base_url()?>admin/edit_topic/<?php echo $t['id'] ?>"  class="btn btn-sm btn-primary" >
                                          <i class="fas fa-pen"></i> Edit
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                        
                    }
                }
            ?>  
            
            
            
            
          </div>
        </div>
        
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
    <!--modal -->
    <div class="modal fade" id="topic-add">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method='post' action='<?php echo base_url('admin/insert_topic'); ?>'>
                    <div class="modal-header">
                        <h4 class="modal-title">Add New Topic</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
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
                            <label for="inputName">Topic/Unit Name</label>
                            <input type="text" id="topic_name" name='topic_name' class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Select Status</label>
                            <select class="form-control" name='status' id='status' required>
                                <option value='1'>Active</option>
                                <option value='0'>InActive</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Select Quiz Type</label>
                            <select class="form-control select2" style="width: 100%;" name='qst_type' id='qst_type' required >
                                <option value=''>Select Question Type</option>
                                <option value='1'>Topicwise Question</option>
                                <option value='2'>Unitwise Question</option>
                                <option value='3'>All Syllabus Question</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create new Topic</button>
                    </div>
                </form>
            </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    
    <script>
        function deleteTopic(id)
    {
     
      $.ajax({ 
            url:"<?php echo base_url(); ?>admin/DeleteTopic",
            type: "POST",
            data: {id:id}, 
            dataType:'json',
            success:function(data) {
                console.log(data);
                if(data.success) 
                {
                    Swal.fire(data.msg);
                    setTimeout(function() {
                    window.location.href = '<?php echo base_url(); ?>admin/allTopics';
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