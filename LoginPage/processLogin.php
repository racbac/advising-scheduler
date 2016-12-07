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
  $_SESSION['password'] = sha1($_POST['password']);

  //a password should never be part of an HTTP POST

  //get session vars to php for db connection
  $username = $_SESSION['username'];
  $password = $_SESSION['password'];

  //gets user from user db
  $sql = "SELECT * FROM `users` WHERE `username` = '$username' AND `password` = '$password'";
  $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
  $row = mysql_fetch_row($rs);

//if user is in db
if($row) {
    $_SESSION['username'] = $row['1']; //assign user if needed
    $_SESSION['userToken'] = true; //a validated user
    //no saving password hash
    unset($_SESSION['password']);

    $username = $_SESSION['username'];

    echo('<pre>');
    var_dump($_SESSION);
    echo('<pre>');

    header('Location: ../homescreen.php');
}

//else returns to login page
else {
    session_unset();
    header('Location: ../error.html');
}
    echo('<pre>');
    var_dump($_SESSION);
    echo('</pre>');

?>
