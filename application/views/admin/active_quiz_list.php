
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0"><?php echo $status ?> Quiz List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/Dashboard') ?>">Home</a></li>
              <li class="breadcrumb-item active">Active Quiz</li>
            </ol>
          </div><!-- /.col -->
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
                <h3 class="card-title">List of <?php echo $status ?> Quiz</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                
                
                <?php if(!empty($activeQuiz)){
                    if($status=='Active'){
                ?>
                    <table id="activequiz_list" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th>Id</th> 
                            <th>Name</th>
                            <th>Subject</th>
                            <th>Topic</th>
                            
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                         
                              if(!empty($activeQuiz))
                              {
                                  foreach($activeQuiz as $q)
                                  {?>
                                     <tr>
                                         <td><?php echo $q['id'] ?></td>  
                                         <td><?php echo $q['name'] ?></td>
                                         <td><?php echo $q['course_name'] ?></td>
                                         <td><?php echo $q['topic_name'] ?></td>
                                         
                                        
                                     </tr> 
                                  <?php }
                              }
                          
                          
                          ?>
                      </tbody>
                    </table>
                <?php } } ?>
                
                <?php if(!empty($deactiveQuiz)){
                    if($status=='Expired'){
                ?>
                    <table id="deactivequiz_list" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th>ID</th>  
                            <th>Name</th>
                            <th>Subject</th>
                            <th>Topic</th>
                            
                            
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                            if(!empty($deactiveQuiz))
                              {
                                  foreach($deactiveQuiz as $q)
                                  {?>
                                     <tr>
                                        <td><?php echo $q['id'] ?></td>
                                        <td><?php echo $q['name'] ?></td>
                                         <td><?php echo $q['course_name'] ?></td>
                                         <td><?php echo $q['topic_name'] ?></td>
                                        
                                        
                                     </tr> 
                                  <?php }
                              }
                          
                          
                          ?>
                      </tbody>
                 
                </table>
                <?php } }?>
                
                
                <?php if(!empty($subWiseQuiz)){
                if($status=='Subjectwise'){
                ?>
                    <table id="subquiz_list" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            
                            <th>Subject</th>
                            <th>Topic</th>
                            <th>Count</th>
                            
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                             if(!empty($subWiseQuiz))
                              {
                                  foreach($subWiseQuiz as $q)
                                  {?>
                                     <tr>
                                        
                                         <td><?php echo $q['course_name'] ?></td>
                                         <td><?php echo $q['topic_name'] ?></td>
                                         <td><?php echo $q['count'] ?></td>
                                        
                                     </tr> 
                                  <?php }
                              }
                          
                          
                          ?>
                      </tbody>
                 
                </table>
                <?php } }?>
                
                <?php if(!empty($topicWiseQuiz)){
                if($status=='Topicwise'){?>
                    <table id="topicquiz_list" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            
                            <th>Subject</th>
                            <th>Topic</th>
                            <th>Count</th>
                            
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                             if(!empty($topicWiseQuiz))
                              {
                                  foreach($topicWiseQuiz as $q)
                                  {?>
                                     <tr>
                                        
                                         <td><?php echo $q['course_name'] ?></td>
                                         <td><?php echo $q['topic_name'] ?></td>
                                         <td><?php echo $q['count'] ?></td>
                                        
                                     </tr> 
                                  <?php }
                              }
                          
                          
                          ?>
                      </tbody>
                 
                </table>
                <?php } }?>
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
   

