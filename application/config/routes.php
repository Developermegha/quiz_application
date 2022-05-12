<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['admin'] = 'Admin';
$route['admin/login'] = 'Admin/login';
$route['admin/register'] = 'Admin/register';

$route['admin/register_admin'] = 'Login/register_admin';
$route['admin/check_login'] = 'Login/check_login';
$route['admin/dashboard'] = 'Admin/dashboard';
$route['admin/allQuiz'] = 'Admin/allQuiz';
$route['admin/allQuestions'] = 'Admin/allQuestions';
$route['admin/addQuestion'] = 'Admin/addQuestion';
$route['admin/logout'] = 'Admin/admin_logout';
$route['admin/profile'] = 'Admin/editprofile';
$route['admin/allCourse'] = 'Admin/allCourse';
$route['admin/addCourse'] = 'Admin/addCourse';
$route['admin/update_course'] = 'Admin/update_course';
$route['admin/allTopics'] = 'Admin/allTopics';
$route['admin/addTopic'] = 'Admin/addTopic';
$route['admin/insert_course'] = 'Admin/insert_course';
$route['admin/insert_topic'] = 'Admin/insert_topic';
$route['admin/insert_new_question'] = 'Admin/insert_new_question';
$route['admin/insert_new_quiz'] = 'Admin/insert_new_quiz';
$route['admin/newQuiz'] = 'Admin/newQuiz';
$route['admin/getQuizType'] = 'Admin/getQuizType';
$route['admin/insert_quiz_previous_question'] = 'Admin/insert_quiz_previous_question';
$route['admin/alluser'] = 'Admin/alluser';
$route['admin/addUser'] = 'Admin/insert_user';
$route['admin/activeQuiz'] = 'Admin/activeQuiz';
// $route['admin/add_user'] = 'Admin/insert_user';


/*student routes*/
$route['student/register'] = 'Student/register';
$route['student/login'] = 'student';
$route['student/student_login'] = 'Login/student_login';
$route['student/logout'] = 'Student/student_logout';
$route['student/allQuiz'] = 'Student/getAllQuiz';

//$route['staff/login'] = 'staff';
$route['staff/staff_login'] = 'Login/staff_login';
$route['staff/logout'] = 'Staff/staff_logout';

