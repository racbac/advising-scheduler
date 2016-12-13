Skip to content
This repository
Search
Pull requests
Issues
Gist
 @racbac
 Watch 1
  Unstar 1
  Fork 0 cganley1/cs331-proj2 Private
 Code  Issues 0  Pull requests 1  Projects 0  Wiki  Pulse  Graphs
Branch: master Find file Copy pathcs331-proj2/LoginPage/processLogin.php
a7ce2cc  14 minutes ago
@cganley1 cganley1 login page changes
1 contributor
RawBlameHistory     
43 lines (33 sloc)  1.1 KB
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
Contact GitHub API Training Shop Blog About
© 2016 GitHub, Inc. Terms Privacy Security Status Help