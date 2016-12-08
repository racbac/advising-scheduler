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
  $formRole = $_POST['formRole'];

  //if passwords do not match redirect to error
  if ($password1 != $password2) {
     header('Location: ../error.html');
  }

  //adds user to db
  $sql = "INSERT INTO users" .
  "(firstName, lastName, username, userRole, email, password)" .
  "VALUES " .
  "('$firstName', '$lastName', '$username', '$formRole', '$email', '$password1')";
  $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

  echo '<pre>';
    var_dump($_SESSION);
  echo '</pre>';

  //redirects for login 
  header('Location: ./login.php');

?>
