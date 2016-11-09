<?php

session_start();

$debug = false;
include('CommonMethods.php');
$COMMON = new Common($debug);

$futurePlans = $_POST['futurePlans'];
$resources = $_POST['resources'];
$experience = $_POST['experience'];
$current_course1 = $_POST['current_course1'];
$current_course2 = $_POST['current_course2'];
$current_course3 = $_POST['current_course3'];
$current_course4 = $_POST['current_course4'];
$current_course5 = $_POST['current_course5'];
$current_course6 = $_POST['current_course6'];
$current_course7 = $_POST['current_course7'];
$current_course8 = $_POST['current_course8'];
$current_course9 = $_POST['current_course9'];
$current_course10 = $_POST['current_course10'];
$next_course1 = $_POST['next_course1'];
$next_course2 = $_POST['next_course2'];
$next_course3 = $_POST['next_course3'];
$next_course4 = $_POST['next_course4'];
$next_course5 = $_POST['next_course5'];
$next_course6 = $_POST['next_course6'];
$next_course7 = $_POST['next_course7'];
$next_course8 = $_POST['next_course8'];
$next_course9 = $_POST['next_course9'];
$next_course10 = $_POST['next_course10'];

$reason_course1 = $_POST['reason_course1'];
$reason_course2 = $_POST['reason_course2'];
$reason_course3 = $_POST['reason_course3'];
$reason_course4 = $_POST['reason_course4'];
$reason_course5 = $_POST['reason_course5'];
$reason_course6 = $_POST['reason_course6'];
$reason_course7 = $_POST['reason_course7'];
$reason_course8 = $_POST['reason_course8'];
$reason_course9 = $_POST['reason_course9'];
$reason_course10 = $_POST['reason_course10'];

$credits_course1 = $_POST['credits_course1'];
$credits_course2 = $_POST['credits_course2'];
$credits_course3 = $_POST['credits_course3'];
$credits_course4 = $_POST['credits_course4'];
$credits_course5 = $_POST['credits_course5'];
$credits_course6 = $_POST['credits_course6'];
$credits_course7 = $_POST['credits_course7'];
$credits_course8 = $_POST['credits_course8'];
$credits_course9 = $_POST['credits_course9'];
$credits_course10 = $_POST['credits_course10'];

$credits_earned  = $_POST['credits_earned'];
$gpa = $_POST['gpa'];
$upper_credits = $_POST['upper_credits'];
$writing_intensive = $_POST['writing_intensive'];
$phys_ed = $_POST['phys_ed'];
$english = $_POST['english'];
$arts_hum = $_POST['arts_hum'];
$soc_sci = $_POST['soc_sci'];
$math = $_POST['math'];
$science = $_POST['science'];
$culture = $_POST['culture'];
$req_201_lang = $_POST['req_201_lang'];
$assessment = $_POST['assessment'];
$resource1 = $_POST['resource1'];
$resource2 = $_POST['resource2'];
$resource3 = $_POST['resource3'];
$resource4 = $_POST['resource4'];
$resource5 = $_POST['resource5'];
$resource6 = $_POST['resource6'];
$resource7 = $_POST['resource7'];
$resource8 = $_POST['resource8'];

$time_commitments = $_POST['time_commitments'];
$commitment_hours = $_POST['commitment_hours'];
$commute = $_POST['commute'];
$new_commute = $_POST['new_commute'];
$new_work = $_POST['new_work'];
$fam_responsibilties = $_POST['fam_responsibilities'];
$new_extracurr = $_POST['new_extracurr'];
$new_commutehours $_POST['new_commutehours'];
$new_workhours = $_POST['new_workhours'];
$new_familyhours = $_POST['new_familyhours'];
$new_extracurrhours = $_POST['new_extracurrhours'];
$comments = $_POST['comments']


  $sql = "INSERT INTO `students_advising_info` (`id`, `futureplans`, `resources`, `experience`, `current_course1`, `current_course2`, `current_course3`, `current_course4`, `current_course5`, `current_course6`, `current_course7`, `current_course8`, `current_course9`, `current_course10`, `next_course1`, `next_course2`, `next_course3`, `next_course4`, `next_course5`, `next_course6`, `next_course7`, `next_course8`, `next_course9`, `next_course10`, `reason_course1`, `reason_course2`, `reason_course3`, `reason_course4`, `reason_course5`, `reason_course6`, `reason_course7`, `reason_course8`, `reason_course9`, `reason_course10`, `credits_course1`, `credits_course2`, `credits_course3`, `credits_course4`, `credits_course5`, `credits_course6`, `credits_course7`, `credits_course8`, `credits_course9`, `credits_course10`, `credits_earned`, `gpa`, `upper_credits`, `writing_intensive`, `phys_ed`, `english`, `arts_hum`, `soc_sci`, `math`, `science`, `culture`, `req_201_lang`, `assessment`, `resource1`, `resource2`, `resource3`, `resoucre4`, `resource5`, `resource6`, `resource7`, `resource8`, `time_commitments`, `commitment_hours`, `commute`, `new_commute`, `new_work`, `fam_responsibilities`, `new_extracurr`, `new_commutehours`, `new_workhours`, `new_familyhours`, `new_extracurrhours`, `comments`) VALUES ('$futurePlans', '$resources', '$experience', '$current_course1', '$current_course2', '$current_course3', '$current_course4', '$current_course5', '$current_course6', '$current_course7', '$current_course8', '$current_course9', '$current_course10', '$next_course1', '$next_course2', '$next_course3', '$next_course4', '$next_course5', '$next_course6', '$next_course7', '$next_course8', '$next_course9', '$next_course10', '$reason_course1', '$reason_course2', '$reason_course3', '$reason_course4', '$reason_course5', '$reason_course6', '$reason_course7', '$reason_course8', '$reason_course9', '$reason_course10', credits_course1, credits_course2, credits_course3, credits_course4, credits_course5, credits_course6, credits_course7, credits_course8, credits_course9, credits_course10, credits_earned, gpa, upper_credits, writing_intensive, phys_ed, english, arts_hum, soc_sci, math, science, culture, req_201_lang, 'assessment', resource1, resource2, resource3, resoucre4, resource5, resource6, resource7, resource8, 'time_commitments', commitment_hours, commute, new_commute, new_work, fam_responsibilities, new_extracurr, new_commutehours, new_workhours, new_familyhours, new_extracurrhours, 'comments')";

$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);


?>