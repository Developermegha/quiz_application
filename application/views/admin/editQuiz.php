
<?php //print_r($quizdetails); ?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Quiz</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/allQuiz'); ?>">Home</a></li>
              <li class="breadcrumb-item active">Edit Quiz</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-6">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">General</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="inputName">Quiz Name</label>
                <input type="text" id="inputName" class="form-control" value="<?php echo $quizdetails[0]['name'] ?>">
              </div>
              
              
              <div class="form-group">
                <label for="inputClientCompany">Subject Name</label>
                <input type="text" id="inputClientCompany" name='subject' class="form-control" value="<?php echo $quizdetails[0]['course_name'] ?>">
              </div>
              <div class="form-group">
                <label for="inputProjectLeader">Topic Name</label>
                <input type="text" id="inputProjectLeader" name='topic' class="form-control" value="<?php echo $quizdetails[0]['topic_name'] ?>">
              </div>
              <div class="form-group">
                <label for="inputProjectLeader">Total Marks</label>
                <input type="text" id="inputProjectLeader" name='max_marks' class="form-control" value="<?php echo $quizdetails[0]['max_marks'] ?>">
              </div>
              <div class="form-group">
                <label for="inputProjectLeader">Negative Marks</label>
                <input type="text" id="inputProjectLeader" name='negative_mark' class="form-control" value="<?php echo $quizdetails[0]['negative_marks'] ?>">
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <div class="col-md-6">
          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">Quiz Dates</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group">
                 <label>Total Quiz Time</label>
                <input type="text" class="form-control" name="quiz_total_time"  value='<?php echo $quizdetails[0]['quiz_total_time'] ?>' style="width: 100%;" required> 
                
              </div>
              <div class="form-group">
                <label>Quiz Start time:</label>
                <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                    <input type="text" name="quiz_start_time" class="form-control datetimepicker-input" data-target="#reservationdatetime" value='<?php echo $quizdetails[0]['quiz_start_time'] ?>' required/>
                    <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
              </div>
              <div class="form-group">
                <label>Quiz End time:</label>
                <div class="input-group date" id="reservationdatetime1" data-target-input="nearest">
                    <input type="text"  name="quiz_end_time" class="form-control datetimepicker-input" data-target="#reservationdatetime1" value='<?php echo $quizdetails[0]['quiz_end_time'] ?>' required/>
                    <div class="input-group-append" data-target="#reservationdatetime1" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
              </div>
              <div class="form-group">
                 <label>Total Questions</label>
                <input type="text" class="form-control" name="number_of_questions"  value='<?php echo $quizdetails[0]['number_of_questions'] ?>' style="width: 100%;" required> 
                
              </div>
              <div class="form-group">
                <label for="inputStatus">Status</label>
                <?php $id=$quizdetails[0]['quiz_id']; ?>
                <select id="quiz_status" name='quiz_status' class="form-control" onchange='changeQuizStatus(<?php echo $id ?>);'>
                  <?php if($quizdetails[0]['active']=='1' ){ ?>
                  <option value='1' selected>Active</option>
                  <option value='0'>Expired</option>
                  <?php } else { ?>
                  <option value='1' >Active</option>
                  <option value='0' selected>Expired</option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
         
          <!-- /.card -->
        </div>
      </div>
        
     
    </section>
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">Questions</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
                <table id="questions" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Id</th>
                    
                    <th>Question</th>
                    <th>Option 1</th>
                    <th>Option 2</th>
                    <th>Option 3</th>
                    <th>Option 4</th>
                    <th>Correct Option</th>
                    
                  </tr>
                  </thead>
                  <tbody>
                  <?php if(!empty($quizdetails)) 
                  { 
                    foreach($quizdetails as $que)
                    {?>
                        <tr>
                            <td><?php echo $que['id'] ?></td>
                           
                            <td><?php echo $que['question'] ?></td>
                            <td><?php echo $que['option_1'] ?></td>
                            <td><?php echo $que['option_2'] ?></td>
                            <td><?php echo $que['option_3'] ?></td>
                            <td><?php echo $que['option_4'] ?></td>
                            <td><?php echo $que['correct_option'] ?></td>
                            
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
        
      </div>
        
      <div class="row">
        <div class="col-12">
          <a href="#" class="btn btn-secondary">Cancel</a>
          <input type="submit" value="Save Changes" class="btn btn-success float-right">
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script>
      function changeQuizStatus(id)
  {
        var id=id;alert(id);
        var status=$('#quiz_status').val();
        
        $.ajax({ 
            url:"<?php echo base_url(); ?>admin/changeQuizStatus",
            type: "POST",
            data: {id:id ,status:status}, 
            dataType:'json',
            success:function(data) {
                console.log(data);
                if(data.success) 
                {
                    Swal.fire(data.msg);
                    setTimeout(function() {
                    window.location.href = '<?php echo base_url(); ?>admin/allQuiz';
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