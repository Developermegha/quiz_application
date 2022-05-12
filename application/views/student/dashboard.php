
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Active Quiz</span>
                <span class="info-box-number">
                  <?php echo $activeCount; ?>
                  <small></small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Quiz</span>
                <span class="info-box-number"><?php echo $allQuizs; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Attempted Quiz</span>
                <span class="info-box-number"><?php echo $attemtedStudentCount; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <!--<div class="col-12 col-sm-6 col-md-3">-->
          <!--  <div class="info-box mb-3">-->
          <!--    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>-->

          <!--    <div class="info-box-content">-->
          <!--      <span class="info-box-text">Not Attempted Quiz</span>-->
          <!--      <span class="info-box-number">2,000</span>-->
          <!--    </div>-->
              <!-- /.info-box-content -->
          <!--  </div>-->
            <!-- /.info-box -->
          <!--</div>-->
          <!-- /.col -->
        </div>
        <!-- /.row -->

        
        <div class="row">
          <div class="col-md-3">
            <div class="sticky-top mb-3">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Draggable Events</h4>
                </div>
                <div class="card-body">
                   the events 
                  <div id="external-events">
                    <div class="external-event bg-success">Lunch</div>
                    <div class="external-event bg-warning">Go home</div>
                    <div class="external-event bg-info">Do homework</div>
                    <div class="external-event bg-primary">Work on UI design</div>
                    <div class="external-event bg-danger">Sleep tight</div>
                    <div class="checkbox">
                      <label for="drop-remove">
                        <input type="checkbox" id="drop-remove">
                        remove after drop
                      </label>
                    </div>
                  </div>
                </div>
               
              </div>
               
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Create Event</h3>
                </div>
                <div class="card-body">
                  <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                    <ul class="fc-color-picker" id="color-chooser">
                      <li><a class="text-primary" href="#"><i class="fas fa-square"></i></a></li>
                      <li><a class="text-warning" href="#"><i class="fas fa-square"></i></a></li>
                      <li><a class="text-success" href="#"><i class="fas fa-square"></i></a></li>
                      <li><a class="text-danger" href="#"><i class="fas fa-square"></i></a></li>
                      <li><a class="text-muted" href="#"><i class="fas fa-square"></i></a></li>
                    </ul>
                  </div>
                 
                  <div class="input-group">
                    <input id="new-event" type="text" class="form-control" placeholder="Event Title">

                    <div class="input-group-append">
                      <button id="add-new-event" type="button" class="btn btn-primary">Add</button>
                    </div>
                 
                  </div>
                 
                 
                </div>
              </div>
            </div>
          </div>
           
          <div class="col-md-9">
            <div class="card card-primary">
              <div class="card-body p-0">
                 THE CALENDAR 
                <div id="calendar"></div>
              </div>
               
            </div>
             
          </div>
           
        </div>
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <!--<div class="col-md-8">-->
          <!--  <div class="card card-primary">-->
          <!--    <div class="card-body p-0">-->
                <!-- THE CALENDAR -->
          <!--      <div id="calendar"></div>-->
                
          <!--    </div>-->
              <!-- /.card-body -->
          <!--  </div>-->
            <!-- /.card -->
          <!--</div>-->
          
              
          <!-- /.col -->
 <div class="col-md-6">
               <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Leaderboard of Last Active Quiz</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body p-0">
                    <table class="table table-sm">
                      <thead>
                        <tr>
                          <th style="width: 10px">#</th>
                          <th>Username</th>
                          <th>Quiz name</th>
                          <th style="width: 40px">Score</th>
                        </tr>
                      </thead>
                      <tbody>
                           <?php $i=1;
                           if(!empty($allstudents)){
                           foreach($allstudents as $key =>$value){?>
                        <tr>
                                
                          <td><img class="animation__shake" src="<?php echo base_url('assets/img/trophy.jpg') ?>"  height="30" width="30"></td>
                          <td><?php echo $value->user_name; ?></td>
                          <td>
                              <?php if(round($value->percentage) >70){?>
                            <div class="progress progress-xs">
                              <div class="progress-bar bg-success" style="width: <?php echo round($value->percentage,2); ?>%"></div>
                            </div>
                            <?php }else if(round($value->percentage) <70){ ?>
                            <div class="progress progress-xs">
                              <div class="progress-bar bg-primary" style="width: <?php echo round($value->percentage,2); ?>%"></div>
                            </div>
                            <?php } else if(round($value->percentage) <40){?>
                            <div class="progress progress-xs">
                              <div class="progress-bar bg-danger" style="width: <?php echo round($value->percentage,2); ?>%"></div>
                            </div>
                            <?php }?>
                          </td>
                          <td>
                              <?php if(round($value->percentage) >70){?>
                              <span class="badge bg-success"><?php echo round($value->percentage,2); ?>%</span>
                                <?php }else if(round($value->percentage) <70){?>  
                                <span class="badge bg-primary"><?php echo round($value->percentage,2); ?>%</span>
                                <?php }else{ ?>
                                    <span class="badge bg-danger"><?php echo round($value->percentage,2); ?>%</span>
                                <?php } ?>
                            </td>
                              
                        </tr>
                      <?php } }?>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
                </div>
            <div class="col-md-6">
            <!-- PRODUCT LIST -->
                <div class="card">
              <div class="card-header">
                <h3 class="card-title">Quiz Results</h3>

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
              <div class="card-body p-0">
                <ul class="products-list product-list-in-card pl-2 pr-2">
                <?php 
                if(!empty($studentAttemptedQuizResult) &&  $studentAttemptedQuizResult !=''){
                foreach($studentAttemptedQuizResult as $key => $value){?>    
                  <li class="item">
                    <div class="product-img">
                      <img src="<?php echo base_url('assets/img/quiz_image.jpg') ?>" alt="Product Image" class="img-size-50">
                    </div>
                    <div class="product-info">
                      <a href="javascript:void(0)" class="product-title"><?php echo $value->quiz_name; ?>
                        <span class="badge badge-warning float-right"><?php echo $value->course_name; ?></span></a>
                      <span class="product-description">
                          <?php 
                          $single_mark=($value->max_marks/$value->number_of_questions);
                          $correctMarks=($value->correct_ans*$single_mark);
	              $totalNegmarks=($value->incorrect_ans*$value->negative_marks);
	              $finalresult=($correctMarks-$totalNegmarks); 
	              $per=($finalresult/$value->max_marks)*100;
                          
                          ?>
                       <!--<b>Correct Ans : </b> <?php echo $value->correct_ans; ?><br>-->
                       <!-- <b>In- Correct Ans : </b><?php echo $value->incorrect_ans; ?><br>-->
                       <!-- <b>Un- Correct Ans : </b><?php echo $value->unanswered; ?><br>-->
                        <b>Percentage : <?php echo round($per); ?>%</b>
                      </span>
                    </div>
                  </li>
                  <?php }} ?>
                  <!-- /.item -->
              
                </ul>
              </div>
              <!-- /.card-body -->
              <div class="card-footer text-center">
                <a href="<?php echo base_url('student/quizlist'); ?>" class="uppercase">View All Quiz</a>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
        
            </div>
          <!-- /.col -->
        </div>
       <div class="row">
             <div class="col-md-12">
                <!-- TABLE: LATEST ORDERS -->
                <div class="card">
                  <div class="card-header border-transparent">
                    <h3 class="card-title">Latest Quiz</h3>
    
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
                  <div class="card-body p-0">
                    <div class="table-responsive">
                      <table class="table m-0">
                        <thead>
                        <tr>
                          <th>Quiz name</th>
                          <th>Topic</th>
                          <th>Course</th>
                          <th>Active</th>
                          <!--<th>Quiz Type</th>-->
                          <th>Start Quiz</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php $second = $activeQuiz[0]->name;?>
                            <?php foreach($activeQuiz as $key => $value){?>
                            <tr>
                                <?php
                                $quiz_id = $value->id; $startdate = $value->quiz_start_time; 
                                
                                $enddate = $value->quiz_end_time; ?>
                                <td><?php echo $quiz_name = $value->name; ?></td>
                                <td><?php echo $value->topic_name; ?></td>
                                 <td><?php echo $value->course_name; ?></td>
                                  <td><span class="badge badge-warning float-right"><?php echo ($value->active == 1) ? 'Active' :'Inactive'; ?></span></a></td>
                                  <!--<td><?php echo $value->quiztype; ?></td>-->
                                  <td> 
                                  <a href="<?php echo base_url('student/quiz_screen/'.$value->id); ?>" class="btn btn-sm btn-primary" target="_blank">
                        
                      <i class="fas fa-user"></i> Start Quiz
                    </a>
                                  </td>
                                  </tr>
                            <?php }?>
                        </tbody>
                      </table>
                    </div>
                    <!-- /.table-responsive -->
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer clearfix">
                    <!--<a href="javascript:void(0)" class="btn btn-sm btn-info float-left">Place New Order</a>-->
                    <a href="<?php echo base_url('student/quizlist'); ?>" class="btn btn-sm btn-secondary float-right">View All Quiz</a>
                  </div>
                  <!-- /.card-footer -->
                </div>
                <!--/.card -->
            </div>
          
          
        </div>
        <!-- /.row -->
        
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  
<script>
  $(function () {

    /* initialize the external events
     -----------------------------------------------------------------*/
    function ini_events(ele) {
      ele.each(function () {

        // create an Event Object (https://fullcalendar.io/docs/event-object)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        }

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject)

        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex        : 1070,
          revert        : true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        })

      })
    }

    ini_events($('#external-events div.external-event'))

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()

    var Calendar = FullCalendar.Calendar;
    var Draggable = FullCalendar.Draggable;

    var containerEl = document.getElementById('external-events');
    var checkbox = document.getElementById('drop-remove');
    var calendarEl = document.getElementById('calendar');

    // initialize the external events
    // -----------------------------------------------------------------

    new Draggable(containerEl, {
      itemSelector: '.external-event',
      eventData: function(eventEl) {
        return {
          title: eventEl.innerText,
          backgroundColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
          borderColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
          textColor: window.getComputedStyle( eventEl ,null).getPropertyValue('color'),
        };
      }
    });

    var calendar = new Calendar(calendarEl, {
      headerToolbar: {
        left  : 'prev,next today',
        center: 'title',
        right : 'dayGridMonth,timeGridWeek,timeGridDay'
      },
      themeSystem: 'bootstrap',
      //Random default events
      events: [
          
        {
          title          : '<?php echo $quiz_name; ?>',
        //   start          : new Date(y, m, d, 10, 30),
        //   allDay         : true,
          start          : new Date(y, m, d),
          end            : new Date(y, m, d +3),
          url            : 'https://kingsinternational.academy/quiz_application/student/quiz_screen/<?php echo $quiz_id;?>',
          backgroundColor: '#0073b7', //Blue
          borderColor    : '#0073b7' //Blue
        },
        {
          title          : '<?php echo $second;?>',
          start          : new Date(y, m, d),
          end            : new Date(y, m, d+5),
          url            : 'https://www.google.com/',
          backgroundColor: '#28a745', //Primary (light-blue)
          borderColor    : '#28a745' //Primary (light-blue)
        }
      ],
      editable  : true,
      droppable : true, // this allows things to be dropped onto the calendar !!!
      drop      : function(info) {
        // is the "remove after drop" checkbox checked?
        if (checkbox.checked) {
          // if so, remove the element from the "Draggable Events" list
          info.draggedEl.parentNode.removeChild(info.draggedEl);
        }
      }
    });

    calendar.render();
    // $('#calendar').fullCalendar()

    /* ADDING EVENTS */
    var currColor = '#3c8dbc' //Red by default
    // Color chooser button
    $('#color-chooser > li > a').click(function (e) {
      e.preventDefault()
      // Save color
      currColor = $(this).css('color')
      // Add color effect to button
      $('#add-new-event').css({
        'background-color': currColor,
        'border-color'    : currColor
      })
    })
    $('#add-new-event').click(function (e) {
      e.preventDefault()
      // Get value and make sure it is not null
      var val = $('#new-event').val()
      if (val.length == 0) {
        return
      }

      // Create events
      var event = $('<div />')
      event.css({
        'background-color': currColor,
        'border-color'    : currColor,
        'color'           : '#fff'
      }).addClass('external-event')
      event.text(val)
      $('#external-events').prepend(event)

      // Add draggable funtionality
      ini_events(event)

      // Remove event from text input
      $('#new-event').val('')
    })
  })
</script>