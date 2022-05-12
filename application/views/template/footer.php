<footer class="main-footer">
    <strong>Copyright &copy; 2020-<?php echo date("Y"); ?> <a href="#">Neet Quiz</a>.</strong>
    All rights reserved.
    <!--<div class="float-right d-none d-sm-inline-block">-->
    <!--  <b>Version</b> 3.2.0-rc-->
    <!--</div>-->
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->

<!-- Sparkline -->
<script src="<?php echo base_url('assets/plugins/sparklines/sparkline.js') ?>"></script>
<!-- JQVMap -->

<!-- jQuery Knob Chart -->
<script src="<?php echo base_url('assets/plugins/jquery-knob/jquery.knob.min.js') ?>"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url('assets/plugins/moment/moment.min.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/daterangepicker/daterangepicker.js') ?>"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo base_url('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') ?>"></script>
<!-- Summernote -->
<script src="<?php echo base_url('assets/plugins/summernote/summernote-bs4.min.js') ?>"></script>
<!-- overlayScrollbars -->
<script src="<?php echo base_url('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') ?>"></script>
<!-- SweetAlert2 -->
<script src="<?php echo base_url('assets/plugins/sweetalert2/sweetalert2.min.js') ?>"></script>
<!-- Toastr -->
<script src="<?php echo base_url('assets/plugins/toastr/toastr.min.js') ?>"></script>

<!-- DataTables  & Plugins -->
<script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js')?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')?>"></script>
<script src="<?php echo base_url('assets/plugins/jszip/jszip.min.js')?>"></script>
<script src="<?php echo base_url('assets/plugins/pdfmake/pdfmake.min.js')?>"></script>
<script src="<?php echo base_url('assets/plugins/pdfmake/vfs_fonts.js')?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables-buttons/js/buttons.html5.min.js')?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables-buttons/js/buttons.print.min.js')?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables-buttons/js/buttons.colVis.min.js')?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

<!-- Bootstrap Switch -->
<script src="<?php echo base_url('assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js')?>"></script>

<!-- ChartJS -->
<script src="<?php echo base_url('assets/plugins/chart.js/Chart.min.js')?>"></script>
<!-- fullCalendar 2.2.5 -->
<script src="<?php echo base_url('assets/plugins/moment/moment.min.js')?>"></script>
<script src="<?php echo base_url('assets/plugins/fullcalendar/main.js') ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/dist/js/adminlte.js') ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('assets/dist/js/demo.js') ?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url('assets/dist/js/pages/dashboard.js') ?>"></script>



<script>
  $(function () {
     //Date and time picker
    //-------------
    
    $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });
    $('#reservationdatetime1').datetimepicker({ icons: { time: 'far fa-clock' } });
    
    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })
    
    
    $("#quiz_list").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#quiz_list_wrapper .col-md-6:eq(0)');
    
    
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    
    $("#questions").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#questions_wrapper .col-md-6:eq(0)');
    
    $("#activequiz_list").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#activequiz_list_wrapper .col-md-6:eq(0)');
    
    $("#deactivequiz_list").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#deactivequiz_list_wrapper .col-md-6:eq(0)');
    
    $("#subquiz_list").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#subquiz_list_wrapper .col-md-6:eq(0)');
    
    $("#topicquiz_list").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#topicquiz_list_wrapper .col-md-6:eq(0)');
    
    
    
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
    });
    
    $('#course').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
    });
    
   
  
      $('#leaderboard').DataTable({
          'dom': 'lrt',
      "paging": true,
      "lengthChange": false,
      
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
    });
  
   
    
    
    
  
    
    $("body").on("click", ".edittopic", function(event){    
	    var id=$(this).attr('data-id');
	   
	    $('#topic-edit').modal('show');
	    $.ajax({ 
                    url:"<?php echo base_url(); ?>admin/edit_topic",
                    type: "POST",
                    data: {id:id}, 
                    
                    dataType:'json',
                    success:function(data) {
                        console.log(data);
                        $('#topic_name').val(data[0]['topic_name']);
                        $('#topic_id').val(data[0]['id']);
                        
                    },
                    error: function(err) 
                    {
                        console.log(err);
                    }
                });
	    
    });
    
    
  });
  
  function getCourseList()
  {
      var role=$('#role').val();
     
      if(role=='2')
      {
          $('#role_div').show();
          $('#course').prop('required', true);   
      }
      else
      {
          $('#role_div').hide();
          $('#course').prop('required', false);   
      }
  }
  function getAttributestaffFunction()
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
  
  
  
    function getAttributeFunction()
    {
        var att_type=$("#qst_type").val();
        var sub=$("#subject").val();
        if(sub==0)
        {
            alert('Please select Subject');
        }
        $.ajax({ 
                    url:"<?php echo base_url(); ?>admin/getTopicList",
                    type: "POST",
                    data: {att_type:att_type ,sub:sub}, 
                    
                    dataType:'json',
                    success:function(data) {
                        console.log(data);
                        $('#att_type').show();
                        $('#attribute_name').empty();
                        //   <option value=''>Select Attribute</option>
                           $('#attribute_name').append('<option value="">Select Attribute</option>');
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
    function getQuestionFunction()
    {
        //var qst_type=$("#qst_type").val();
        var topic_name=$("#attribute_name").val();
        
        
        $.ajax({ 
                    url:"<?php echo base_url(); ?>admin/getTopicQuestions",
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
</body>
</html>