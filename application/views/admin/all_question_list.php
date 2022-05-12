
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-4">
              
              <?php if(!empty($msg)){ ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i> Alert!</h5>
                    <?php echo $msg; ?>
                </div>
            <?php } ?>
           
          </div>
          <div class="col-sm-8">
                <div class='col-sm-2 float-sm-right '><a href='<?php echo base_url('admin/addQuestions') ?>' class="btn btn-block bg-gradient-success">Add Question</a></div>
                
                <div class='col-sm-2 float-sm-right '><input id="inp_file_import" type="file" style="display: none;" />
                <input id="btn_add_import" type="button" class="btn btn-block bg-gradient-success" value="Import Excel"></div>
                <div class='col-sm-3 float-sm-right '><a href='<?php echo base_url('admin/download_question_formate') ?>' class="btn btn-block bg-gradient-success" target='_blank'>Download Excel Formate</a></div>
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
                <h3 class="card-title">List of All Question</h3>
              </div>
              <!-- /.card-header -->
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
                  <?php if(!empty($questions)) 
                  { 
                    foreach($questions as $que)
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
     $(document).on('click', '#btn_add_import', function() {
                $('#inp_file_import').click();
            });
            
            $(document).on('change', '#inp_file_import', function() {
                $("#add_wait").css("display", "block");
                
                var formData = new FormData();
                formData.append('uploadFile', $('#inp_file_import')[0].files[0]);
                $.ajax({ 
                    url:"<?php echo base_url(); ?>admin/importFile",
                    type: "POST",
                    data: formData, 
                    contentType: false,  
                    cache: false,
                    processData:false, 
                    dataType:'json',
                    success:function(data) {
                        console.log(data);
                        $("#add_wait").css("display", "none");
                        if(data.success == true) 
                        {
                            toastr.success(data.msg);
                            setTimeout(function() {
                                window.location.href = '<?php echo base_url(); ?>admin/allQuestions';
                            }, 2000);     
                            
                        } else {
                           toastr.error(data.msg);
                            setTimeout(function() {
                                window.location.href = '<?php echo base_url(); ?>admin/allQuestions';
                            }, 2000); 
                        }
                    },
                    error: function(err) 
                    {
                        console.log(err);
                    }
                });
            });
 </script>

 