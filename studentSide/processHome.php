<?php
session_start();
$click = $_POST['next'];

switch ($click)
  {
  case "Search for An Appointment":
    header('Location: searchAppointments.php');
    break;
  case "View My Appointment":
    header('Location: viewAppointment.php');
    break;
  case "Pre-Advising Worksheet":
    header('Location: advisingWorksheet.php');
    break;
  case "Edit My Information":
    header('Location: editInformation.php');
    break;
  case "Logout":
    header('Location: logout.php');
    break;
  }
?>