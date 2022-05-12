
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
                <form method="post" action="<?php echo base_url('admin/insert_new_question') ?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
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
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Select Topic</label>
                                <select class="form-control" name='topic_id' id='topic_id' required>
                                    <option value=''></option>
                                    <?php if(!empty($topic)){
                                    foreach($topic as $t) {?> 
                                    <option value='<?php echo $t['id']; ?>'><?php echo $t['topic_name']; ?></option>
                                    <?php } }?>
                                </select>
                            </div>
                        </div>
                 
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Enter Question</label>
                                <input type="text" class="form-control" name="question" style="width: 100%;"  placeholder="Enter Question"  required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Enter Question Image</label>
                               <input type='file' class="form-control" name="question_img" style="width: 100%;" > 
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Enter Answer_1</label>
                                <input type="text" class="form-control" name="answer_1" style="width: 100%;"  placeholder="Answer_1"  >
                                
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Enter Answer_1 Image</label>
                                
                                <input type='file' class="form-control" name="ans1_img" style="width: 100%;" > 
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
                                <label>Enter Answer_2 Image</label>
                                <input type='file' class="form-control" name="ans2_img" style="width: 100%;" > 
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
                                <label>Enter Answer_3 Image</label>
                                <input type='file' class="form-control" name="ans3_img" style="width: 100%;" >
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
                                <label>Enter Answer_4 Image</label>
                                <input type='file' class="form-control" name="ans4_img" style="width: 100%;" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Enter Correct_Aswer</label>
                                <input type="text" class="form-control" name="correct_answer" style="width: 100%;"  placeholder="Correct_Aswer"  required> 
                                
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Enter Correct_Aswer Image</label>
                                <input type='file' class="form-control" name="correct_ans_img" style="width: 100%;" >
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
    