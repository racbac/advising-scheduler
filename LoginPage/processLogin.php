<!--htmlHeader
   Project: CMSC331 Project 02, Fall 2016
   Authors: Felipe Bastos, Rachel Brackert, Travis Early, Nathaniel Fuller, Colin Ganley
   Date: 2016-12-13
   Email: fbastos1@umbc.edu, bac2@umbc.edu, te4@umbc.edu, fullern1@umbc.edu, cganley1@umbc.edu
-->

<?php
  include('../CommonMethods.php');
  session_start();
  $debug = false;
  $COMMON = new Common($debug);

  //sets session vars
  $_SESSION['username'] = $_POST['username'];

  //a password should never be part of an HTTP POST
  //get session vars to php for db connection
  $username = $_SESSION['username'];
  $password = sha1($_POST['password']);

  //gets user from user db
  $sql = "SELECT * FROM `users` WHERE `username` = '$username' AND `password` = '$password'";
  $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
  $row = mysql_fetch_assoc($rs);

//if user is in db
if($row) {
    $_SESSION['username'] = $row['username']; //assign user if needed
    $_SESSION['userToken'] = true; //a validated user
    $_SESSION['userRole'] = $row['userRole']; // advisor or student

  
    if ($row['userRole'] == "advisor") {
        header('Location: ../AdvisorManager/advisorHome.php');
    } else {
        header('Location: ../StudentManager/studentHome.php');
    }
}

//else returns to login page
else {
    session_unset();
    header('Location: login.php');
}
?>
