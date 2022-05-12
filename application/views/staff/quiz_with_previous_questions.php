
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Quiz with Existing Questions</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Quiz</li>
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
                <form method="post" action="<?php echo base_url('staff/insert_quiz_previous_question') ?>"> 
                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Select Subject</label>
                            
                            <select class="form-control select2" style="width: 100%;" name='subject' id='subject' required>
                                <option value=''>Select Subject</option>
                            <?php if(!empty($course))
                            {
                                foreach($course as $q)
                                { ?>
                                    <option value='<?php echo $q['id'] ?>'><?php echo $q['course_name'] ?></option>
                                <?php } } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Select Question Type</label>
                            <select class="form-control select2" style="width: 100%;" name='qst_type' id='qst_type' required onchange='getstaffAttributeFunction()'>
                                <option value=''>Select Question Type</option>
                                <option value='1'>Topicwise Question</option>
                                <option value='2'>Unitwise Question</option>
                                <option value='3'>All Syllabus Question</option>
                            </select>
                        </div>
                    
                    </div>
                  
                    <div class="col-md-6">
                        <div class="form-group" >
                            <label>Select  Topic/Unit</label>
                            <select class="form-control select2" style="width: 100%; " name='attribute_name' id='attribute_name' required onchange='getstaffQuestionFunction()'>
                                    <option value=''>Select Attribute</option>
                            </select>
                        </div>
                    </div>
                
                 
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Enter Quiz Name</label>
                            <input type="text" class="form-control" name="quiz_name"  placeholder="Enter Quiz Name" style="width: 100%;"  required> 
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Enter Marks</label>
                            <input type="text" class="form-control" name="max_marks"  placeholder="Enter Max Marks" style="width: 100%;" required> 
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Enter Negative Marks</label>
                            <input type="text" class="form-control" name="negative_marks"  placeholder="Enter Negative Marks" style="width: 100%;" required> 
                        </div>
                    </div>
                     <div class="col-md-6">
                        <div class="form-group">
                            <label>Total Quiz Time</label>
                            <input type="text" class="form-control" name="quiz_total_time"  placeholder="Enter Total Time" style="width: 100%;" required> 
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Total Attempt</label>
                            <input type="text" class="form-control" name="total_attempt"  placeholder="Enter Max Marks" style="width: 100%;" required> 
                        </div>
                    </div>
                    <!-- <div class="col-md-6">-->
                    <!--    <div class="form-group">-->
                    <!--        <label>Start Time</label>-->
                    <!--        <input type="text" class="form-control"   placeholder="Enter Max Marks" style="width: 100%;" required> -->
                    <!--    </div>-->
                    <!--</div>-->
                     <!-- Date and time -->
                    <div class="col-md-6"> 
                        <div class="form-group">
                          <label>Quiz Start time:</label>
                            <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                <input type="text" name="quiz_start_time" class="form-control datetimepicker-input" data-target="#reservationdatetime" required/>
                                <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6"> 
                        <div class="form-group">
                          <label>Quiz End time:</label>
                            <div class="input-group date" id="reservationdatetime1" data-target-input="nearest">
                                <input type="text"  name="quiz_end_time" class="form-control datetimepicker-input" data-target="#reservationdatetime1" required/>
                                <div class="input-group-append" data-target="#reservationdatetime1" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Select  Questions</label>
                            <select class="form-control " style="width: 100%; " name='question[]' id='question' multiple required>
                                 <option value=''>Select Questions</option>
                            </select>
                        </div>
                    </div>
                   <div class="col-md-12">
                        <div class="form-group text-center">
                            <input type="submit" value="Add Quiz" name='submit' id='submit' class="btn btn-success "> 
                            
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
  <script>
      function getstaffAttributeFunction()
    {
        var att_type=$("#qst_type").val();
        var sub=$("#subject").val();
        if(sub==0)
        {
            alert('Please select Subject');
        }
        $.ajax({ 
                    url:"<?php echo base_url(); ?>staff/getTopicList",
                    type: "POST",
                    data: {att_type:att_type ,sub:sub}, 
                    
                    dataType:'json',
                    success:function(data) {
                        console.log(data);
                        $('#att_type').show();
                        $('#attribute_name').empty();
                       
                         for (var i = 0; i < data.length; i++) {
                            $('#attribute_name').append('<option value="' + data[i].id + '">' + data[i].topic_name+ '</option>');
                         }
                    },
                    error: function(err) 
                    {
                        console.log(err);
                    }
                });
    }
    function getstaffQuestionFunction()
    {
        //var qst_type=$("#qst_type").val();
        var topic_name=$("#attribute_name").val();
        
        
        $.ajax({ 
                    url:"<?php echo base_url(); ?>staff/getTopicQuestions",
                    type: "POST",
                    data: {topic_name:topic_name}, 
                    
                    dataType:'json',
                    success:function(data) {
                        console.log(data);
                        $('#question').empty();
                         for (var i = 0; i < data.length; i++) {
                            $('#question').append('<option value="' + data[i].id + '">' + data[i].question+ '</option>');
                            
                         }
                       
                        
                    },
                    error: function(err) 
                    {
                        console.log(err);
                    }
                });
    }
  </script>
    