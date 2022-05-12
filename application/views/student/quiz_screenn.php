<?php 
// echo $quizinfo->attemt_students;
// echo $getAttempt;
if(($quizinfo->attemt_students == $getAttempt) &&  $getAttempt != 0 && $quizinfo->attemt_students != 0 ){
    redirect('student/quizlist');
    // echo "ok";
    // exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Quiz</title>
  <link rel="shortcut icon" type="image/png" href="<?php echo base_url('assets/img/favicon.png') ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/flaticon.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/fontawesome-all.min.css') ?>">
  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/device.css') ?>">

</head>
<style>
.imageWrap
    {
        text-align: left;
        width: 200px;
        
    }
.img-fluid {
  max-width: 100%;
  height: auto;
}
.img-responsive {
  display: block;
  max-width: 100%;
  height: auto;
}
    .noAns{
        background-color:#ffffff;
    }
</style>

<body>

  <div class="active pageWrapper" id="wrapper">
  
    <div class="mainContent">
      <div class="container-fluid">
          <div class="pagecontentWrap">
              <div class="toggleButtonWrap">
                <button class="btn btn-primary" id="menu-toggle"><span class="flaticon-menu"></span></button>
              </div>
              <div class="row">
                <div class="col-md-8">
                    <div class="welcomeUser">
                      <h2><?php echo $quizinfo->name;?></h2>
                      <!--<p></p>-->
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="timerWrap">
                        <div class="title">
                          <h2>Duration</h2>
                        </div>
                        <div class="timer countdown">
                            <h2></h2>
                        </div>
                    </div>
                    <div class="RemarkstarWrap">
                      <div class="imgWrap">
                        <img src="<?php echo base_url('assets/img/star.png') ?>" class="img-fluid" alt="NEET Quiz DMSF"/>
                      </div>
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-8">
                    <div class="quetionData"></div>
                </div>
                
                
                <div class="col-md-4">
                  <div class="quizPallet">
                      <h2>question pallet</h2>
                      <ul class="totalQuiz" id="questionId_pallet">

                      </ul>
                      <div class="quizPalletBottom">
                          <ul>
                              <li class="mb-0">
                                  <span class="Ansred"></span>
                                  <p>Answered</p>
                              </li>
                              <li class="mb-0">
                                  <span class="noAns"></span>
                                  <p>Not Answered</p>
                              </li>
                              <!--<li class="mb-0">-->
                              <!--    <span class="noAnsMR"></span>-->
                              <!--    <p>Not Answered & Marked for Review</p>-->
                              <!--</li>-->
                              <!--<li class="mb-0">-->
                                  
                              <!--    <span class="AnsMR"></span>-->
                              <!--    <p>Answered & Marked for UnReview</p>-->
                              <!--</li>-->
                          </ul>
                      </div>
                  </div>
                  <div class="quizimgWrap">
                    <img src="<?php echo base_url('assets/img/quiz-img.png'); ?>" class="img-fluid" alt="NEET Quiz DMSF"/>
                  </div>
                  <div class="websiteLink">
                    <a href="www.yourwebsite.com" target="_blank">www.yourwebsite.com</a>
                  </div>
                </div>
              </div>
          </div>
      </div>
    </div>
  </div>

  <!--First modal popup start-->
    <div id="infomodal" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg">
      <!-- Modal content-->
            <div class="modal-content" style="background: cornsilk;">

                <div class="modal-body">
                <h4 class="modal-title text-center">Quiz Important Instructions </h4><hr>
                <form>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                  <p>1. There will be a total of 30 questions.</p><hr>
                                  <p>2. Each question will carry one mark.</p><hr>
                                  <p>3.The total time for the quiz is 30 minutes.</p><hr>
                                  <p>4. There will be no negative marking for wrong answers.</p><hr>
                                  <p>5. The quiz will be in an MCQ format with single or multiple correct answers. </p><hr>
                                  <p>6. For questions whose answers are selected, the palette will show green colour. </p><hr>
                                  <p>7. The questions that are skipped, the palette will show grey colour.</p><hr>
                                  <p>8. Once, the quiz starts, the student cannot switch windows. Your keyboard will be disabled for the entire duration of the quiz.</p><hr>
                                  <p>9. Top 3 performers will feature on the leaderboard.</p><hr>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <?php  
                        $studentid = $this->session->userdata('id');   $session_name = $this->session->userdata('username'); 
                        $TotalNumberOfQuestion = $quizinfo->number_of_questions; 
                        $QuizId = $quizinfo->id;  
                        
                        $attempt = ++$getAttempt;

                        ?> 
                     
                      <!-- <button type="button" class="btn btn-default" data-dismiss="modal" onclick="openFullscreen();">Close</button>  -->
                    </div>
                </form>
                  <button class = "btn btn-pop" id="go_quiz" onclick="SetQuestion( <?php echo $TotalNumberOfQuestion ?> , <?php echo $studentid; ?> , <?php echo $QuizId; ?> )" data-dismiss="modal" >Close</button>
                </div>
            </div>
      </div>
  </div>
  
<!--modal end-->

<!-- new modal start-->
    <div class="modal fade" id="timerCountDownModal" role="dialog">
        <div class="modal-dialog">
        
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <p>Opps Your Time is up. Please click the Ok button to get your result .</p>
            </div>
            <div class="modal-footer">
              <input type = "hidden" id = "updatePrimaryId"  value = "">
              <button type="button" onclick= "updatetimerCountDownSubmitAnswer()"  class="btn btn-default" >Ok</button>
             
            </div>
          </div>
          
        </div>
      </div>
<!-- modal end-->

  <!--<script src="<?php echo base_url('assets/js/jquery-1.12.4.min.js'); ?>"></script>-->
  <script src="<?php echo base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url('assets/plugins/jquery-ui/jquery-ui.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/js/popper.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
  
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
  <script src="<?php echo base_url('assets/js/main.js') ?>"></script>
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
  <script>
   $(document).ready(function(){
   
   $('#infomodal').modal('show');
});
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("active");
    });
  </script>
  <script>

var next      = "next";
var prev      = "prev"; 
var page      = 1;
var review    = 'review';
var submit    = 'submit';
var quiz_id   = <?php echo $quizinfo->id;?>;
var checked   = "checked";
var redirect  = 'redirect';
var unreview  = 'unreview';


var counterOfQuestion = 1;
var questiontext = "Question No ";
var counter = 10;
var timer2 = "<?php echo $quizinfo->quiz_total_time; ?>:01";


    /*display all question from the quiz with ajax call*/
    function SetQuestion(total_number_of_question , studentid , quiz_id){

        $.ajax({
            url: "<?php echo base_url()?>student/set_question",
            type: "POST",
            data: { quiz_id:quiz_id,studentid:studentid,total_number_of_question:total_number_of_question},
            success: function(data){
             var obj =  JSON.parse(data);
             var question_data = '';
             var questionNumber = '';
             var quetionNoList ='';
             var question_data = '';
             setInterval(countDownTimer, 1000);
        
             console.log(obj);
             console.log(obj[0].question);
            var totalnoofquestion  = total_number_of_question;
             for (var i = 0; i < total_number_of_question; i++) {
                  var counter = i + 1;
                  questionNumber+='<li class = "questionIdPallet" value= "'+counter+'" id = "questionSequence-'+counter+'" onclick= "questionSequenceRedirect('+counter+', '+redirect+')" >'+counter+'</li>';
                  if(counter ==1){
                      var active ='active';
                  }else{
                      active ='';
                  }
                  quetionNoList +='<li class="'+active+'">Q.no '+counter+'</li>'
                
              }
              $("#questionId_pallet").html(questionNumber); 
              $("#questionSequence-1").addClass('blackOutlinBorder');
              
              var selectedAns = obj[0].selected_answer;
              
              question_data+='<div class="quetionNoList"><ul>'+quetionNoList+'</ul></div>'+
                            '<div class="quetionWrap">'+
                            '<h4>' +questiontext+ +''+ +counterOfQuestion+ ') ' +obj[0].question+'</h4>'+
                          //  '<div class="imageWrap"><img src="https://kingsinternational.academy/quiz_application/uploads/'+obj[0].image_question+'" class="img-fluid" "></div>'+
                            '</div>'+
                            '<input type = "hidden" id = "hiddenquestionPrimaryId" name = "hiddenquestionPrimaryId" value = "'+obj[0].quizprimaryId+'">'+
                            '<div class="optionWrap">'+
                                '<ul>'+
                                    '<li>'+
                                        '<input type="radio" id = "optionA"   name="radio-group" onchange="getRadioButtonValue($(this).val())" value = "'+obj[0].option_1+'" '+(selectedAns === obj[0].option_1 ? 'checked' : '')+'> <label for="optionA">A</label>'+
                                        '<p>'+obj[0].option_1+'</p>'+
                                   '</li>'+
                                //   '<div class="imageWrap"><img src="https://kingsinternational.academy/quiz_application/uploads/'+obj[0].image_option_1+'" class="img-fluid" "></div>'+
                                    '<li>'+
                                        '<input type="radio" id = "optionB"  name="radio-group" onchange="getRadioButtonValue($(this).val())" value = "'+obj[0].option_2+'" '+(selectedAns === obj[0].option_2 ? 'checked' : '')+'> <label for="optionB">B</label>'+
                                        '<p>'+obj[0].option_2+'</p>'+
                                    '</li>'+
                                    // '<div class="imageWrap"><img src="https://kingsinternational.academy/quiz_application/uploads/'+obj[0].image_option2+'" class="img-fluid" "></div>'+
                                    '<li>'+
                                        '<input type="radio" id = "optionC"  name="radio-group" onchange="getRadioButtonValue($(this).val())" value = "'+obj[0].option_3+'" '+(selectedAns === obj[0].option_3 ? 'checked' : '')+'><label for="optionC">C</label>'+
                                        '<p>'+obj[0].option_3+'</p>'+
                                    '</li>'+
                                    // '<div class="imageWrap"><img src="https://kingsinternational.academy/quiz_application/uploads/'+obj[0].image_option3+'" class="img-fluid" "></div>'+
                                    '<li>'+
                                        '<input type="radio"  id = "optionD"  name="radio-group" onchange="getRadioButtonValue($(this).val())" value = "'+obj[0].option_4+'" '+(selectedAns === obj[0].option_4 ? 'checked' : '')+'>  <label for="optionD">D</label>'+
                                        '<p>'+obj[0].option_4+'</p>'+
                                    '</li>'+
                                    // '<div class="imageWrap"><img src="https://kingsinternational.academy/quiz_application/uploads/'+obj[0].image_option4+'" class="img-fluid" "></div>'+
                                '</ul>'+
                            '</div>'+
                            '<div class="ctaWrapper">'+
                              '<div class="btnsWrap">'+
                                // '<button class="btn btnPrev" onclick= "prevQuestion(''  , '+prev+' , '+quiz_id+')">Previous</button>'+
                                '<button class="btn btnNext" onclick= "nextQuestion( 1,'+next+','+quiz_id+')">Next</button>'+
                              '</div>'+
                              '<div class="buttonsWrap">'+
            
                            //   ( obj[0].mark_for_review == '' ?   '<button class="btn btnReviewMark"  onclick= "markForReview(1, '+review+')">Mark for Review</button>' :  '<button class="btn btnReviewMark"  onclick= "markForReview(1, '+unreview+')">UnMark for Review</button>' ) +
                              '<button class="btn btnSubmit" onclick="submitFinalAnswer(1, '+submit+' , '+obj[0].quizprimaryId+','+obj[0].id+' , '+quiz_id+')">Submit & End</button>'+
                              '</div>'+
                            '</div>';
                            // console.log(question_data);
                 $(".quetionData").html(question_data);    
                 $("#updatePrimaryId").val('"'+obj[0].quizprimaryId+'"');
            }
        });
        
    }
    
    /*
    * next button click event
    */
    function nextQuestion(questionSequenceId ,buttonAction,quizId ){
        counterOfQuestion ++;
        questionSequence(questionSequenceId,buttonAction,quizId)
    }
    
    /*
    * prev button click event
    */
    function prevQuestion(questionSequenceId ,buttonAction ,quizId){
        counterOfQuestion --;
        questionSequence(questionSequenceId,buttonAction,quizId);
    }

    /*
    *  maintain the question sequence
    * on next and prev button
    */
    function questionSequence(questionSequence,buttonAction,quizId){
        $.ajax({
            url: "<?php echo base_url()?>student/questionSequence",
            type: "POST",
            data: { questionSequence:questionSequence,quizid:quizId},
            success: function(data){
                var obj =  JSON.parse(data);
                quiz_id = obj.quiz_id;
                questionId = obj.id;
                quizPrimaryId = obj.quizprimaryId;
                ajaxCall(questionId , buttonAction ,quiz_id,questionSequence ,quizPrimaryId);
            }
          });
    
    }
    
    /*
    * get question on prev and next
    * button click
    */
    function ajaxCall(QuestionId , buttonAction ,quiz_id,questionSequence,quizPrimaryId){
        
        var TotalNumberOfQuestion = '<?php echo $TotalNumberOfQuestion; ?>';
          var quetionNoList ='';
        
        var nextquestionseq = '';
        if(buttonAction == 'next' ){
           var nextquestionseq = questionSequence + 1;
        }else if(buttonAction === 'prev' ){
           var nextquestionseq = questionSequence - 1;
        }else if(buttonAction == 'redirect'){
           var nextquestionseq = questionSequence;
        }else if (buttonAction == 'review' ){
           var nextquestionseq = questionSequence;
        }else if (buttonAction == 'unreview'){
           var nextquestionseq = questionSequence;
        }else if (buttonAction == 'submit'){
           var nextquestionseq = questionSequence + 1;
        }  
        console.log(buttonAction);
        
        $( "li" ).removeClass('blackOutlinBorder');
        $("#questionSequence-"+nextquestionseq).addClass('blackOutlinBorder');
        
                
        var answer = $("input[name='radio-group']:checked").val();
          for (var i = 0; i < TotalNumberOfQuestion; i++) {
                  var counter = i + 1;
                  console.log(nextquestionseq);
                 
                  if(counter == nextquestionseq){
                      var active ='active';
                  }else{
                      active ='';
                  }
                  quetionNoList +='<li class="'+active+'">Q.no '+counter+'</li>'
                
              }
           
        
        $.ajax({
            url: "<?php echo base_url()?>student/get_question_next_and_prev",
            type: "POST",
            data: {  quizId:quiz_id,submitedAnswer:answer,buttonAction:buttonAction,QuestionId:QuestionId,pageId:nextquestionseq,quizPrimaryId:quizPrimaryId},
            success: function(data){
                var obj =  JSON.parse(data);
                //console.log(obj);
                var selectedAns = obj[0].selected_answer;
                var question_data = '';
                $("#updatePrimaryId").val(obj[0].quizprimaryId);
                question_data+='<div class="quetionNoList"><ul>'+quetionNoList+'</ul></div>'+
                            '<div class="quetionWrap">'+
                            '<h4>' +questiontext+ +''+ +nextquestionseq+ ') '+obj[0].question+'</h4>'+
                            '<div class="imageWrap"><img src="https://kingsinternational.academy/quiz_application/uploads/'+obj[0].image_question+'" class="img-fluid" "></div>'+
                            
                            '</div>'+
                            '<div class="optionWrap">'+
                                '<ul>'+
                                    '<li>'+
                                        '<input type="radio" id="optionA"  name="radio-group" value = "'+obj[0].option_1+'" '+(selectedAns === obj[0].option_1 ? 'checked' : '')+'> <label for="optionA">A</label>'+
                                        '<p>'+obj[0].option_1+'</p>'+
                                        // '<div class="imageWrap"><img src="https://kingsinternational.academy/quiz_application/uploads/'+obj[0].image_option_1+'" class="img-fluid" "></div>'+
                                   '</li>'+
                                    '<li>'+
                                        '<input type="radio" id="optionB"  name="radio-group" value = "'+obj[0].option_2+'" '+(selectedAns === obj[0].option_2 ? 'checked' : '')+' > <label for="optionB">B</label>'+
                                        '<p>'+obj[0].option_2+'</p>'+
                                        // '<div class="imageWrap"><img src="https://kingsinternational.academy/quiz_application/uploads/'+obj[0].image_option2+'" class="img-fluid" "></div>'+
                                    '</li>'+
                                    '<li>'+
                                        '<input type="radio" id="optionC"  name="radio-group" value = "'+obj[0].option_3+'" '+(selectedAns === obj[0].option_3 ? 'checked' : '')+'><label for="optionC">C</label>'+
                                        '<p>'+obj[0].option_3+'</p>'+
                                        // '<div class="imageWrap"><img src="https://kingsinternational.academy/quiz_application/uploads/'+obj[0].image_option3+'" class="img-fluid" "></div>'+
                                    '</li>'+
                                    '<li>'+
                                        '<input type="radio" id="optionD"  name="radio-group" value = "'+obj[0].option_4+'" '+(selectedAns === obj[0].option_4 ? 'checked' : '')+'>  <label for="optionD">D</label>'+
                                        '<p>'+obj[0].option_4+'</p>'+
                                        // '<div class="imageWrap"><img src="https://kingsinternational.academy/quiz_application/uploads/'+obj[0].image_option4+'" class="img-fluid" "></div>'+
                                    '</li>'+
                                '</ul>'+
                            '</div>'+
                            '<div class="ctaWrapper">'+
                              '<div class="btnsWrap">'+
                               
                                
                                ( 1 != nextquestionseq ?  '<button class="btn btnPrev" onclick= "prevQuestion('+nextquestionseq+'  , '+prev+','+quiz_id+' )">Previous</button>' : '' ) +
                                ( TotalNumberOfQuestion != nextquestionseq ? '<button class="btn btnNext" onclick= "nextQuestion('+nextquestionseq+'  , '+next+','+quiz_id+' )">Next</button>' : '' ) +
                              
                              '</div>'+
                              '<div class="buttonsWrap">'+
                              //'<button class="btn btnReviewMark"  onclick= "markForReview('+nextquestionseq+', '+review+')">Mark for Review</button>'+
                               
                               /*( obj[0].mark_for_review == '' ?   '<button class="btn btnReviewMark"  onclick= "markForReview('+nextquestionseq+', '+review+')">Mark for Review</button>' :  '<button class="btn btnReviewMark"  onclick= "markForReview('+nextquestionseq+', '+unreview+')">UnMark for Review</button>' ) +*/
        
                               '<button class="btn btnSubmit" onclick="submitFinalAnswer('+nextquestionseq+', '+submit+', '+obj[0].quizprimaryId+','+obj[0].id+' , '+quiz_id+')">Submit & End</button>'+
                              '</div>'+
                            '</div>';
                            console.log(question_data);
                 $(".quetionData").html(question_data);  
                 if(buttonAction == 'next' ||  buttonAction == 'prev' ||  buttonAction == 'review' ||  buttonAction == 'unreview' ||  buttonAction == 'submit' ){
                  updateQuestionPalletStatus(QuestionId,questionSequence,quizPrimaryId);
                
                } 
              }
          });
    }
    
    /*
    * update the question pallet 
    *
    */
    function updateQuestionPalletStatus(questionId,questionSequence,quizPrimaryId){
        $.ajax({
        url: "<?php echo base_url()?>student/updateQuestionPalletStatus",
        type: "POST",
        data: { quizPrimaryId:quizPrimaryId },
        success: function(data){
            console.log(questionSequence);
          var obj =  JSON.parse(data);

          if(obj[0].questions_status_id == '7' && obj[0].mark_for_review == ''){
            $("#questionSequence-"+questionSequence).removeClass('markForReviewStatusClass');
          }
          else if(obj[0].questions_status_id == '7' && obj[0].mark_for_review == '8'){
            $("#questionSequence-"+questionSequence).addClass('markForReviewStatusClass');
          }
          
          if(obj[0].questions_status_id == '5' && obj[0].mark_for_review == ''){
            $("#questionSequence-"+questionSequence).addClass('Ansred');
            $("#questionSequence-"+questionSequence).removeClass('markForReviewStatusClass');
          }
          else if(obj[0].questions_status_id == '5' && obj[0].mark_for_review == '8'){
            $("#questionSequence-"+questionSequence).addClass('Ansred');
            $("#questionSequence-"+questionSequence).addClass('markForReviewStatusClass');
          }
          
          if(obj[0].questions_status_id == '9' && obj[0].mark_for_review == ''){
            $("#questionSequence-"+questionSequence).addClass('Ansred');
            $("#questionSequence-"+questionSequence).removeClass('markForReviewStatusClass');
          }
          else if(obj[0].questions_status_id == '9' && obj[0].mark_for_review == '8'){
            $("#questionSequence-"+questionSequence).addClass('Ansred');
            $("#questionSequence-"+questionSequence).addClass('markForReviewStatusClass');
          }
          
          if(obj[0].questions_status_id == '6' && obj[0].mark_for_review == ''){
              $("#questionSequence-"+questionSequence).css({'background-color':'white','color':'#332a7d'});
              $("#questionSequence-"+questionSequence).removeClass('markForReviewStatusClass');
          }
          else if(obj[0].questions_status_id == '6' && obj[0].mark_for_review == '8'){
              $("#questionSequence-"+questionSequence).addClass('noAns');
              $("#questionSequence-"+questionSequence).addClass('markForReviewStatusClass');
          }
          
        }
    });
    }


    /*
    *
    */
    function submitFinalAnswer(questionSequence,buttonAction,quizPrimaryId,questionId , quizId){

        if($("input[name='radio-group']:checked").is(':checked')) {
          var answer = $("input[name='radio-group']:checked").val();
          $.ajax({
              url: "<?php echo base_url()?>student/submitFinalAnswer",
              type: "POST",
              data: { 
                quizId:quizId,
                pageId:questionSequence,
                questionId:questionId,
                submitedAnswer:answer,
                quizPrimaryId:quizPrimaryId
               },
                success: function(data){
                  var obj =  JSON.parse(data);
                  if(obj ==  true){
                      updateQuestionPalletStatus(questionId,questionSequence,quizPrimaryId);          
                      countPendingAnswer(quizId); 
                  }else{
                     ajaxCall(questionId , buttonAction ,quizId,questionSequence,quizPrimaryId) ;
        
                  }
                }
            });
          }else{
           swal("Opps..!", "Kindly Fill the answer", "info");
          }
    }
    
    
    /*
    *
    */
    
    function countPendingAnswer(quizId){
        
        $.ajax({
  url: "<?php echo base_url()?>student/countPendingAnswer",
  type: "POST",
  data: { quizId:quizId },
  success: function(data){
  var obj =  JSON.parse(data);
//   console.log(obj['correct_answered'][0]['correct_answered']);
//   if(obj['un_answered'][0]['un_answered'] != "0" && obj['not_answered'][0]['questions_status'] == "0" && obj['mark_for_review'][0]['mark_for_review_question'] == "0" ){
    //   if(obj['un_answered'][0]['un_answered'] = !"0" && obj['not_answered'][0]['questions_status'] == "0" && obj['mark_for_review'][0]['mark_for_review_question'] == "0" && obj['correct_answered'][0]['correct_answered'] == "0" ){
    if(obj['correct_answered'][0]['correct_answered'] ){
          swal({
              title: "Are you sure you want to end the Test..?",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Yes, archive it!",
              cancelButtonText: "No, cancel please!",
              closeOnConfirm: false,
              closeOnCancel: false
            },
            function(isConfirm){
              if (isConfirm) {
                  
                     $.ajax({
                         url: "<?php echo base_url()?>student/updateResultAttempt",
                         type: "POST",
                         data: { quizId:quizId },
                         success: function(data){
                            var obj =  JSON.parse(data);
                            window.location.href = "<?php echo base_url('student/quiz_result/'.$QuizId.'/'.$attempt); ?>"
                         }
                         });
  //   location.reload();
            
     
            

              } else {
                  swal("Cancelled", "Your imaginary file is safe :)", "error");
              }
          });

         }else{
            swal("Oops..!", 'You have '+obj['un_answered'][0]['un_answered']+' un answered and '+obj['not_answered'][0]['questions_status']+'  Not Attempted question and have '+obj['mark_for_review'][0]['mark_for_review_question']+' mark for review  kindly answer the question  ', "info");
         }
      }
   });
    }
    
    /*
    */
    function getRadioButtonValue(submitAnswer){
        $('#updatePrimaryId').attr('data-updateSubmitAnswer', '"'+submitAnswer+'"'); 
    }

    
    
    /*
    * count down the quiz time
    */
    function countDownTimer(){
    
    
        var timer = timer2.split(':');
        //by parsing integer, I avoid all extra string processing
        var minutes = parseInt(timer[0], 10);
        var seconds = parseInt(timer[1], 10);
        
        --seconds;
        minutes = (seconds < 0) ? --minutes : minutes;
        seconds = (seconds < 0) ? 59 : seconds;
        seconds = (seconds < 10) ? '0' + seconds : seconds;
        
        //minutes = (minutes < 10) ?  minutes : minutes;
        $('.countdown').html(minutes + ':' + seconds);
        
        if (minutes < 0) clearInterval(countDownTimer);
        //check if both minutes and seconds are 0
        if ((seconds <= 0) && (minutes <= 0)) 
        
        clearInterval(countDownTimer);
        timer2 = minutes + ':' + seconds;
        
        if(timer2 == '0:00'){
            $('.timer').html("<h3>Count down complete</h3>")
            $('#timerCountDownModal').modal('show');  
        }
    }
    
    /*
    */
    function updatetimerCountDownSubmitAnswer(){
      var quizPrimaryId  =  $("#updatePrimaryId").val();
      var submitedAnswer =  $("#updatePrimaryId").attr('updateSubmitAnswer');
    
      console.log(submitedAnswer);
      $('#timerCountDownModal').modal('hide');  
    
      $.ajax({
      url: "<?php echo base_url()?>student/updatetimerCountDownSubmitAnswer",
      type: "POST",
      data: { quizPrimaryId:quizPrimaryId,
              submitedAnswer:submitedAnswer
             },
            success: function(data){
              var obj =  JSON.parse(data);
             window.location.href = "<?php echo base_url('student/quizlist'); ?>"
            }
        });
    }

</script>

</body>

</html>
