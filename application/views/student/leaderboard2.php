<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Leaderboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Leaderboard</li>
            </ol>
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
                <!--<h3 class="card-title">DataTable with minimal features & hover style</h3>-->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <div class="col-md-12 table-custom-filters ">
                    <div class="row">
                        <div class="col-sm-4">
                            <label>Quiz Name</label>
                            
                            <select name="quizfilter" id="quizfilter" class="form-control" >
                                <option value="">Select the quiz</option>
                                <?php if(!empty($quizlist) ) {foreach($quizlist as $key => $value){?>
                                
                                <option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
                                <?php } }?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-right">
                            <button type="button" class="btn btn-primary" id="applyFilters">Search</button>
                            <button type="button" class="btn btn-default" id="clearFilters">Clear</button>
                        </div>
                    </div>
                </div>
                <table id="leaderboard1" class="table table-hover table-striped">
                  <thead>
                  <tr>
                      <th>Rank</th>
                    <th>Username</th>
                    <th>Quiz name</th>
                    
                    <th>Score</th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                      
                 
                  </tbody>
                
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          
          
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
      $(document).ready(function() {
          var quizfilterVal ='';
                
                
                $('.table-custom-filters').on("click", "#applyFilters", function (e) {
                    e.preventDefault();
                    quizfilterVal = $('#quizfilter').val();
                    
                    dataTable.ajax.reload();
                });

                // reset all filters
                $('.table-custom-filters').on("click", "#clearFilters", function (e) {
                    e.preventDefault();
                    quizfilterVal = '';
                    $('#quizfilter').val('');
                    dataTable.ajax.reload();
                });

                var dataTable = $('#leaderboard1').DataTable({
                // dom:"<'row'<'col-sm-12'l>>"+"<'row'<'col-sm-5'i><'col-sm-7'p>>",
                    dom:"<'row'<'col-sm-6'l><'col-sm-6'p>>" +
                    "<'row'<'col-sm-12 h-scroll'tr>>" +
                    "<'row'<'col-sm-6'i><'col-sm-6'p>>",
                    "paging": true,
                    "order": [],
                    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                    "processing" : true,
                    "serverSide" : true,
                    "ajax": {

                        "url": "<?php echo base_url('student/getLeaderboardListQuizWise');?>",
                        "type": "POST",
                        data:function(d){
                            d.quizfilter = quizfilterVal;
                           
                        },
                      
                    },
                    columns: [
                        { data: "no",orderable: false,name:"no"},
                        { data: "full_name",orderable: true,name:"full_name"},
                        { data: "quiz_name",orderable: true,name:"quiz_name"},
                        { data: "finalscore",orderable: false,name:"finalscore"},
                        { data: "action",orderable: false,name:"action"},
                    ],
                    fnServerParams: function(data) {
                        data['order'].forEach(function(items, index) {
                            data['order'][index]['column'] = data['columns'][items.column]['name'];
                        });
                    }
                });
      });

  </script>