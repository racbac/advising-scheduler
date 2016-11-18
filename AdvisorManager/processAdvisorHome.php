<!--htmlHeader
   Project: CMSC331 Project 02, Fall 2016
   Authors: Felipe Bastos, Rachel Brackert, Travis Early, Nathaniel Fuller, Colin Ganley
   Date: 2016-12-13
   Email: fbastos1@umbc.edu, bac2@umbc.edu, te4@umbc.edu, fullern1@umbc.edu, cganley1@umbc.edu
-->

<?php
session_start();
$selectedOption = $_POST['next'];

switch ($selectedOption)
  {
  case "Edit Appointments":
    header('Location: editAppts.php');
    break;
  case "View Appointments":
    header('Location: viewAppts.php');
    break;
  case "Search Appointments":
    header('Location: searchAppts.php');
    break;
  case "Edit Your Account Info":
    header('Location: editAdvisorInfo.php');
    break;
  case "Logout":
    header('Location: processLogout.php');
    break;
  }


?>
