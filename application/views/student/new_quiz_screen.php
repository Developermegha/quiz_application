
<?php  
if(!empty($existuser))
{

if($existuser[0]['student_id']=$this->session->userdata['studentid'])
{

  redirect(base_url()."student/resultdemo");
}

}
 ?>
<head>
<title>NEET | Quiz Screen</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">


<style>
/* Safari syntax */
:-webkit-full-screen {
background-color: white;
}

/* IE11 */
:-ms-fullscreen {
background-color: white;
}

/* Standard syntax */
:fullscreen {
background-color: white;

}
body.modal-open .mainContent{
-webkit-filter: blur(5px);
-moz-filter: blur(5px);
-o-filter: blur(5px);
-ms-filter: blur(5px);
filter: blur(5px);
}

.blackOutlinBorder{
border:2px solid black;
}

.WhiteOutlinBorder{
border:2px solid White;
}

.Ansred{
color:white;
}

.notAnswered{
background-color: #88dff0;
}
</style>

</head>
<body onclick="openFullscreen();">
<div class="mainContent ">
<div class="container-fluid">
<div class="pagecontentWrap ">
<div class="toggleButtonWrap">
 <!--  <button onclick="openFullscreen();">Open Fullscreen</button> -->

</div>

<div class="row">
   <div class="col-md-8">
     
  </div> 
  <div class="col-md-4">
      <div class="timerWrap">
          <div class="title">
            <h2>Duration</h2>
          </div>
          <div class="timer">
              <!-- <h2 id="time">10</h2>Seconds </h2> -->
              <div class="countdown"></div>
          </div>
      </div>
      <div class="RemarkstarWrap">
        <div class="imgWrap">
          <img src="<?php echo base_url()?>assets/quiz/img/star.png" class="img-fluid" alt="NEET Quiz DMSF"/>
        </div>
      </div>
  </div>
</div>
<div class="row">
  <div class="col-md-8">
     <div class="quetionData" id = "quetionData">
     </div>
  </div>
  
  <div class="col-md-4">
    <div class="quizPallet">
        <h2>question pallet</h2>
        <ul style="display-inline" class="totalQuiz" id = "questionId_pallet">
        </ul>
        <div class="quizPalletBottom">
            <ul>
                <li>
                  <span class="Ansred"></span>
                    <p>Answered</p>
                </li>
                <li>
                    <span></span>
                    <p>Not Answered</p>
                </li>
                <li class="mb-0">
                    <span class="noAnsMR"></span>
                    <p>Not Answered & Marked for Review</p>
                </li>
                <li class="mb-0">
                    <span class="AnsMR"></span>
                    <p>Answered & Marked for UnReview</p>
                </li>
            </ul>
        </div>
    </div>
    <div class="quizimgWrap">
      <img src="<?php echo base_url()?>assets/quiz/img/quiz-img.png" class="img-fluid" alt="NEET Quiz DMSF"/>
    </div>
    <div class="websiteLink">
      <p>www.kingsfmge.com</p>
    </div>
  </div>


</div>
</div>
</div>
</div>
</body>
<div id="myexitModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
  <!-- Modal content-->
      <div class="modal-content" style="background: cornsilk;">
          <div class="modal-body">
          <h4 class="modal-title text-center">Quiz Important Instructions </h4><hr>
              <div class="container">
                  <form>
                    <div> 
                      <div class="row">
                          <div class="col-md-12">
                          <p>Do you really want to exit the test?</p><hr>
                          </div>
                      </div>
                      </div>
                        <div class="modal-footer">
                        <a href="<?php echo base_url('student/quiz')   ?>">   <button type="button" class="btn btn-default">Yes</button> </a>
                        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="openFullscreen();">No</button> 
                        </div>
                  </form>
              </div>
         </div>
      </div>
  </div>
</div>
<div>
<div id="myModal" class="modal fade" role="dialog">
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
                        $studentid = $this->session->userdata('studentid');   $session_name = $this->session->userdata('name'); 
                        $TotalNumberOfQuestion = $quizinfo[0]['number_of_questions']; 
                        $QuizId = $quizinfo[0]['id'];  

                        ?> 
                     
                      <!-- <button type="button" class="btn btn-default" data-dismiss="modal" onclick="openFullscreen();">Close</button>  -->
                    </div>
                </form>
                  <button class = "btn btn-pop" id="go_quiz" onclick="SetQuestion( <?php echo $TotalNumberOfQuestion ?> , <?php echo $studentid; ?> , <?php echo $QuizId; ?> )" data-dismiss="modal" >Close</button>
                </div>
            </div>
      </div>
  </div>

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

  <div id="countPendingAnswer" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Modal header</h3>
    </div>
    <div class="modal-body">
        <p>One fine body…</p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        <button class="btn btn-primary">Save changes</button>
    </div>
</div>

</div>


<script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/tether/1.2.0/js/tether.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>

<script src="jquery-3.5.1.min.js"></script>

<script type="text/javascript" src="path_to/jquery.js"></script>
<script type="text/javascript" src="path_to/jquery.simplePagination.js"></script>
<script src="sweetalert2.all.min.js"></script>
<script src="sweetalert2.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

<script>

var next      = "next";
var prev      = "prev"; 
var page      = 1;
var review    = 'review';
var submit    = 'submit';
var quiz_id   = 1;
var checked   = "checked";
var redirect  = 'redirect';
var unreview  = 'unreview';


var counterOfQuestion = 1;
var questiontext = "Question No ";
var counter = 10;
var timer2 = "<?php echo $quizinfo[0]['quiz_total_time']; ?>:01";

function SetQuestion(total_number_of_question , studentid , quiz_id){

$.ajax({
url: "<?php echo base_url()?>student/set_question",
type: "POST",
data: { 
      quiz_id:quiz_id,
      studentid:studentid,
      total_number_of_question:total_number_of_question
    },
    success: function(data){
     var obj =  JSON.parse(data);
     var question_data = '';
     var questionNumber = '';
     setInterval(countDownTimer, 1000);
     

     console.log(obj);

     for (var i = 0; i < total_number_of_question; i++) {
          var counter = i + 1;
          questionNumber+='<li class = "questionIdPallet" value= "'+counter+'" id = "questionSequence-'+counter+'" onclick= "questionSequenceRedirect('+counter+', '+redirect+')" >'+counter+'</li>';
        
      }
      $("#questionId_pallet").html(questionNumber); 
      $("#questionSequence-1").addClass('blackOutlinBorder');
      var question_data = '';
      var selectedAns = obj[0].selected_answer;
      
      question_data+='<div class="quetionWrap">'+
                    '<h4>' +questiontext+ +''+ +counterOfQuestion+ ') ' +obj[0].question+'</h4>'+
                    '</div>'+
                    '<input type = "hidden" id = "hiddenquestionPrimaryId" name = "hiddenquestionPrimaryId" value = "'+obj[0].quizprimaryId+'">'+
                    '<div class="optionWrap">'+
                        '<ul>'+
                            '<li>'+
                                '<input type="radio" id = "optionA"   name="radio-group" onchange="getRadioButtonValue($(this).val())" value = "'+obj[0].option_1+'" '+(selectedAns === obj[0].option_1 ? 'checked' : '')+'> <label for="optionA">A</label>'+
                                '<p>'+obj[0].option_1+'</p>'+
                           '</li>'+
                            '<li>'+
                                '<input type="radio" id = "optionB"  name="radio-group" onchange="getRadioButtonValue($(this).val())" value = "'+obj[0].option_2+'" '+(selectedAns === obj[0].option_2 ? 'checked' : '')+'> <label for="optionB">B</label>'+
                                '<p>'+obj[0].option_2+'</p>'+
                            '</li>'+
                            '<li>'+
                                '<input type="radio" id = "optionC"  name="radio-group" onchange="getRadioButtonValue($(this).val())" value = "'+obj[0].option_3+'" '+(selectedAns === obj[0].option_3 ? 'checked' : '')+'><label for="optionC">C</label>'+
                                '<p>'+obj[0].option_3+'</p>'+
                            '</li>'+
                            '<li>'+
                                '<input type="radio"  id = "optionD"  name="radio-group" onchange="getRadioButtonValue($(this).val())" value = "'+obj[0].option_4+'" '+(selectedAns === obj[0].option_4 ? 'checked' : '')+'>  <label for="optionD">D</label>'+
                                '<p>'+obj[0].option_4+'</p>'+
                            '</li>'+
                        '</ul>'+
                    '</div>'+
                    '<div class="ctaWrapper">'+
                      '<div class="btnsWrap">'+
                        // '<button class="btn btnPrev" onclick= "prevQuestion('+obj[0].id+'  , '+prev+' , '+quiz_id+')">Previous</button>'+
                        '<button class="btn btnNext" onclick= "nextQuestion( 1 ,'+next+')">Next</button>'+
                      '</div>'+
                      '<div class="buttonsWrap">'+
    
                       ( obj[0].mark_for_review == '' ?   '<button class="btn btnReviewMark"  onclick= "markForReview(1, '+review+')">Mark for Review</button>' :  '<button class="btn btnReviewMark"  onclick= "markForReview(1, '+unreview+')">UnMark for Review</button>' ) +
                      '<button class="btn btnSubmit" onclick="submitFinalAnswer(1, '+submit+' , '+obj[0].quizprimaryId+','+obj[0].id+' , '+quiz_id+')">Submit & End</button>'+
                      '</div>'+
                    '</div>';
         $("#quetionData").html(question_data);  
         $("#updatePrimaryId").val('"'+obj[0].quizprimaryId+'"');
    }
});
}

function getRadioButtonValue(submitAnswer){
  $('#updatePrimaryId').attr('data-updateSubmitAnswer', '"'+submitAnswer+'"'); 
}

function   markForReview(questionSequenceId , buttonAction) {
   questionSequence(questionSequenceId,buttonAction);
}

function nextQuestion(questionSequenceId ,buttonAction ){
  counterOfQuestion ++;
  questionSequence(questionSequenceId,buttonAction)
  //ajaxCall(nextQuestionId , next ,quiz_id);
}

function prevQuestion(questionSequenceId ,buttonAction ){
  counterOfQuestion --;
  questionSequence(questionSequenceId,buttonAction);
//ajaxCall(nextQuestionId , prev ,quiz_id);
}
function questionSequenceRedirect(questionSequenceId, buttonAction){
  questionSequence(questionSequenceId,buttonAction);
}

function questionSequence(questionSequence,buttonAction){
$.ajax({
url: "<?php echo base_url()?>student/questionSequence",
type: "POST",
data: { questionSequence:questionSequence},
      success: function(data){
        var obj =  JSON.parse(data);
        quiz_id = obj.quiz_id;
        questionId = obj.id;
        quizPrimaryId = obj.quizprimaryId;
        ajaxCall(questionId , buttonAction ,quiz_id,questionSequence ,quizPrimaryId);
    }
  });

}





function ajaxCall(QuestionId , buttonAction ,quiz_id,questionSequence,quizPrimaryId){

var TotalNumberOfQuestion = '<?php echo $TotalNumberOfQuestion; ?>';


var nextquestionseq = '';
if(buttonAction == 'next' ){
   var nextquestionseq = questionSequence + 1;
}else if(buttonAction == 'prev' ){
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


$( "li" ).removeClass('blackOutlinBorder');
$("#questionSequence-"+nextquestionseq).addClass('blackOutlinBorder');

        
var answer = $("input[name='radio-group']:checked").val();

$.ajax({
url: "<?php echo base_url()?>student/get_question_next_and_prev",
type: "POST",
data: {  
         quizId:quiz_id, 
         submitedAnswer:answer,
         buttonAction:buttonAction,
         QuestionId:QuestionId,
         pageId:nextquestionseq,
         quizPrimaryId:quizPrimaryId

      },
      success: function(data){
        var obj =  JSON.parse(data);
        //console.log(obj);
        var selectedAns = obj[0].selected_answer;
        var question_data = '';
        $("#updatePrimaryId").val(obj[0].quizprimaryId);
        question_data+='<div class="quetionWrap">'+
                    '<h4>' +questiontext+ +''+ +nextquestionseq+ ') '+obj[0].question+'</h4>'+
                    '</div>'+
                    '<div class="optionWrap">'+
                        '<ul>'+
                            '<li>'+
                                '<input type="radio" id="optionA"  name="radio-group" value = "'+obj[0].option_1+'" '+(selectedAns === obj[0].option_1 ? 'checked' : '')+'> <label for="optionA">A</label>'+
                                '<p>'+obj[0].option_1+'</p>'+
                           '</li>'+
                            '<li>'+
                                '<input type="radio" id="optionB"  name="radio-group" value = "'+obj[0].option_2+'" '+(selectedAns === obj[0].option_2 ? 'checked' : '')+' > <label for="optionB">B</label>'+
                                '<p>'+obj[0].option_2+'</p>'+
                            '</li>'+
                            '<li>'+
                                '<input type="radio" id="optionC"  name="radio-group" value = "'+obj[0].option_3+'" '+(selectedAns === obj[0].option_3 ? 'checked' : '')+'><label for="optionC">C</label>'+
                                '<p>'+obj[0].option_3+'</p>'+
                            '</li>'+
                            '<li>'+
                                '<input type="radio" id="optionD"  name="radio-group" value = "'+obj[0].option_4+'" '+(selectedAns === obj[0].option_4 ? 'checked' : '')+'>  <label for="optionD">D</label>'+
                                '<p>'+obj[0].option_4+'</p>'+
                            '</li>'+
                        '</ul>'+
                    '</div>'+
                    '<div class="ctaWrapper">'+
                      '<div class="btnsWrap">'+
                       
                        
                        ( 1 != nextquestionseq ?  '<button class="btn btnPrev" onclick= "prevQuestion('+nextquestionseq+'  , '+prev+' )">Previous</button>' : '' ) +
                        ( TotalNumberOfQuestion != nextquestionseq ? '<button class="btn btnNext" onclick= "nextQuestion('+nextquestionseq+'  , '+next+' )">Next</button>' : '' ) +
                      
                      '</div>'+
                      '<div class="buttonsWrap">'+
                      //'<button class="btn btnReviewMark"  onclick= "markForReview('+nextquestionseq+', '+review+')">Mark for Review</button>'+
                       
                       ( obj[0].mark_for_review == '' ?   '<button class="btn btnReviewMark"  onclick= "markForReview('+nextquestionseq+', '+review+')">Mark for Review</button>' :  '<button class="btn btnReviewMark"  onclick= "markForReview('+nextquestionseq+', '+unreview+')">UnMark for Review</button>' ) +

                       '<button class="btn btnSubmit" onclick="submitFinalAnswer('+nextquestionseq+', '+submit+', '+obj[0].quizprimaryId+','+obj[0].id+' , '+quiz_id+')">Submit & End</button>'+
                      '</div>'+
                    '</div>';
         $("#quetionData").html(question_data);  
         if(buttonAction == 'next' ||  buttonAction == 'prev' ||  buttonAction == 'review' ||  buttonAction == 'unreview' ||  buttonAction == 'submit' ){
           updateQuestionPalletStatus(QuestionId,questionSequence,quizPrimaryId);
        } 
      }
  });

}

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

function countPendingAnswer(quizId){
  $.ajax({
  url: "<?php echo base_url()?>student/countPendingAnswer",
  type: "POST",
  data: { quizId:quizId },
  success: function(data){
  var obj =  JSON.parse(data);
  console.log(obj['correct_answered'][0]['correct_answered']);
//   if(obj['un_answered'][0]['un_answered'] != "0" && obj['not_answered'][0]['questions_status'] == "0" && obj['mark_for_review'][0]['mark_for_review_question'] == "0" ){
    //   if(obj['un_answered'][0]['un_answered'] >= "0" && obj['not_answered'][0]['questions_status'] == "0" && obj['mark_for_review'][0]['mark_for_review_question'] == "0" && obj['correct_answered'][0]['correct_answered'] != "0" ){
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
               location.reload();
            //   window.location.href = "https://www.kingsinternational.academy/neet_quiz/student/resultdemo";

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



function updateQuestionPalletStatus(questionId,questionSequence,quizPrimaryId){

$.ajax({
  url: "<?php echo base_url()?>student/updateQuestionPalletStatus",
  type: "POST",
  data: { quizPrimaryId:quizPrimaryId },
        success: function(data){
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
              $("#questionSequence-"+questionSequence).addClass('notAnswered');
              $("#questionSequence-"+questionSequence).removeClass('markForReviewStatusClass');
          }
          else if(obj[0].questions_status_id == '6' && obj[0].mark_for_review == '8'){
              $("#questionSequence-"+questionSequence).addClass('notAnswered');
              $("#questionSequence-"+questionSequence).addClass('markForReviewStatusClass');
          }
          
        }
    });
}



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

function updatetimerCountDownSubmitAnswer(){
  var quizPrimaryId  =  $("#updatePrimaryId").val();
  var submitedAnswer =  $("#updatePrimaryId").attr('updateSubmitAnswer');

  console.log(submitedAnswer);

  $.ajax({
  url: "<?php echo base_url()?>student/updatetimerCountDownSubmitAnswer",
  type: "POST",
  data: { quizPrimaryId:quizPrimaryId,
          submitedAnswer:submitedAnswer
         },
        success: function(data){
          var obj =  JSON.parse(data);
        
        }
    });
}






</script>

<script>
$(window).load(function(){  

$('#myModal').modal('show');


}); 



$(document).bind('cut copy paste', function (e) {
e.preventDefault();
});

$(document).on("contextmenu",function(e){
return false;
});


navigator.keyboard.lock();
var elem = document.documentElement;
function openFullscreen() {
if (elem.requestFullscreen) {
// elem.requestFullscreen();
} else if (elem.webkitRequestFullscreen) { /* Safari */
elem.webkitRequestFullscreen();
} else if (elem.msRequestFullscreen) { /* IE11 */
elem.msRequestFullscreen();
}
}  

$("body").keydown(function(event) { 
return false;
});

document.querySelector("body").addEventListener("keydown",function(e){
console.log(e.which);
if (e.which == 27 ){
//alert("Escape pressed!");
$('#myexitModal').modal('show');

return false;
}

if (e.which == 44 ){
alert("dont try again");
// $('#myModal').modal('show');

return false;
}
});

</script>

<script type="text/javascript">
const copyToClipboard = () => {
var textToCopy = "Print screen disabled";
navigator.clipboard.writeText(textToCopy);
}

$(window).keyup((e) => {
if (e.keyCode == 44) {
setTimeout(
copyToClipboard(), 
1000
);
}

if (e.keyCode == 91 || e.keyCode == 93) {
window.event.keyCode = 0;
window.event.returnValue = false;
return false;
}

});


window.onunload = function(){
alert("The window is closing now!");
}
</script>


<script>
if (document.addEventListener)
{
document.addEventListener('fullscreenchange', exitHandler, false);
document.addEventListener('mozfullscreenchange', exitHandler, false);
document.addEventListener('MSFullscreenChange', exitHandler, false);
document.addEventListener('webkitfullscreenchange', exitHandler, false);
}

function exitHandler()
{
if (document.webkitIsFullScreen === false)
{
///fire your event
$('#myexitModal').modal('show');
}
else if (document.mozFullScreen === false)
{
///fire your event
$('#myexitModal').modal('show');
}
else if (document.msFullscreenElement === false)
{
///fire your event
$('#myexitModal').modal('show');
}
}  
</script> 
<script type="text/javascript">
var wrapper = function () { //ignore this

var closing_window = false;
$(window).on('focus', function () {
closing_window = false; 
//if the user interacts with the window, then the window is not being 
//closed
});

$(window).on('blur', function () {

closing_window = true;
if (!document.hidden) { //when the window is being minimized
closing_window = false;
}
$(window).on('resize', function (e) { //when the window is being maximized
closing_window = false;
});
$(window).off('resize'); //avoid multiple listening
});

$('html').on('mouseleave', function () {
closing_window = true; 
//if the user is leaving html, we have more reasons to believe that he's 
//leaving or thinking about closing the window
});

$('html').on('mouseenter', function () {
closing_window = false; 
//if the user's mouse its on the page, it means you don't need to logout 
//them, didn't it?
});

$(document).on('keydown', function (e) {

if (e.keyCode == 91 || e.keyCode == 18) {
closing_window = false; //shortcuts for ALT+TAB and Window key
}

if (e.keyCode == 116 || (e.ctrlKey && e.keyCode == 82)) {
closing_window = false; //shortcuts for F5 and CTRL+F5 and CTRL+R
}
});

// Prevent logout when clicking in a hiperlink
$(document).on("click", "a", function () {
closing_window = false;
});

// Prevent logout when clicking in a button (if these buttons rediret to some page)
$(document).on("click", "button", function () {
closing_window = false;

});
// Prevent logout when submiting
$(document).on("submit", "form", function () {
closing_window = false;
});
// Prevent logout when submiting
$(document).on("click", "input[type=submit]", function () {
closing_window = false;
});

var toDoWhenClosing = function() {

//write a code here likes a user logout, example: 
//$.ajax({
//    url: '/MyController/MyLogOutAction',
//    async: false,
//    data: {

//    },
//    error: function () {
//    },
//    success: function (data) {
//    },
//});
};


window.onbeforeunload = function () {
if (closing_window) {
toDoWhenClosing();
}
};
};
</script>
</html>

