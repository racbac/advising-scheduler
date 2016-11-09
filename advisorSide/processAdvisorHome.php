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