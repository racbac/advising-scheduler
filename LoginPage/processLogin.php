/*phpHeader
 * Project: CMSC331 Project 02, Fall 2016
 * Authors: Felipe Bastos, Rachel Brackert, Travis Earley, Nathaniel Fuller, Colin Ganley
 * Date: 2016-12-16
 * Email: fbastos1@umbc.edu, bac2@umbc.edu, te4@umbc.edu, fullern1@umbc.edu, cganley1@umbc.edu
 *
 */

<?php
session_start();
$debug = false;
include('CommonMethods.php');
$COMMON = new Common($debug);

$_SESSION['umbc_ID'] = ($_POST['umbc_ID']);
$_SESSION['password'] = ($_POST['password']);
$_SESSION['userValue'] = false;

$umbc_ID = $_SESSION['umbc_ID'];
$password = $_SESSION['password'];
$encrypted_pass = md5($password);

$sql = "SELECT * FROM `students_basic_info` WHERE `umbc_ID` = '$umbc_ID' AND `password` = '$encrypted_pass'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_row($rs);

if($row)
  {
    $studentID = $row['0'];
    $last = $row['1'];
    $first = $row['2'];
    $umbc_ID = $row['3'];
    $email = $row['4'];
    $_SESSION['studentID'] = $studentID;
    $_SESSION['last'] = $last;
    $_SESSION['first'] = $first;
    $_SESSION['umbc_ID'] = $umbc_ID;
    $_SESSION['email'] = $email;
    header('Location: homescreen.php');
  }
else
  {
    $_SESSION['userValue'] = true;
    header('Location: loginStudent.php');
  }

?>