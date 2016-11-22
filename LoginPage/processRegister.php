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

  //a password should never be part of an HTTP POST

  //get session vars to php for db connection
  $firstName = $_POST['firstName'];
  $lastName = $_POST['lastName'];
  $email = $_POST['email'];
  $username = $_POST['username'];
  $password1 = sha1($_POST['password1']);
  $password2 = sha1($_POST['password2']);

  $formRole = $_POST['studentRB'];

  if(formRole) { 
    $role = 'student';
  } else {
    $role = 'advisor';
  }

  //if passwords do not match redirect to error
  if (password1 != password2) {
      header('Location: ../error.html');
  }

  //adds registration attempt to metadata
  //a registered user is considered logged in
  $sql = "INSERT INTO login_attempts" .
  "(username)".
  "VALUES ".
  "('$username')";
  $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

  //adds user to db
  $sql = "INSERT INTO secure_login" .
  "(firstName, lastName, username, userRole, email, password)" .
  "VALUES " .
  "('$firstName', '$lastName', '$username', ROLEl, '$email', '$passsword')";
  $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

  //redirects for login
  header('Location: ./login.php');

?>
