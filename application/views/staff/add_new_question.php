
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Question</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Question</li>
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
                <form method="post" action="<?php echo base_url('staff/insert_new_question') ?>">
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
                            <select class="form-control select2" style="width: 100%;" name='qst_type' id='qst_type' required onchange='getAttributestaffFunction()'>
                                <option value=''>Select Question Type</option>
                                <option value='1'>Topicwise Question</option>
                                <option value='2'>Unitwise Question</option>
                                <option value='3'>All Syllabus Question</option>
                            </select>
                        </div>
                    
                    </div>
                  
                    <div class="col-md-6">
                        <div class="form-group" style='display:none;' id='att_type'>
                            <label>Select  Topic/Unit</label>
                            <select class="form-control select2" style="width: 100%; " name='attribute_name' id='attribute_name' required>
                                    <option value=''>Select Attribute</option>
                            </select>
                        </div>
                    </div>
                
                 
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Enter Question</label>
                            <input type="text" class="form-control" name="question" style="width: 100%;"  placeholder="Enter Question"  required> 
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Enter Answer_1</label>
                            <input type="text" class="form-control" name="answer_1" style="width: 100%;"  placeholder="Answer_1"  required> 
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Enter Answer_2</label>
                            <input type="text" class="form-control" name="answer_2" style="width: 100%;"  placeholder="Answer_2"  required> 
                        </div>
                    </div>
                     <div class="col-md-6">
                        <div class="form-group">
                            <label>Enter Answer_3</label>
                            <input type="text" class="form-control" name="answer_3" style="width: 100%;"  placeholder="Answer_3"  required> 
                        </div>
                    </div>
                     <div class="col-md-6">
                        <div class="form-group">
                            <label>Enter Answer_4</label>
                            <input type="text" class="form-control" name="answer_4" style="width: 100%;"  placeholder="Answer_4"  required> 
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Enter Correct_Aswer</label>
                            <input type="text" class="form-control" name="correct_answer" style="width: 100%;"  placeholder="Correct_Aswer"  required> 
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group text-center">
                            <input type="submit" value="Add Question" name='submit' class="btn btn-success ">
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
    