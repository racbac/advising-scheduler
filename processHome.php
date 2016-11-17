/*phpHeader
 * Project: CMSC331 Project 02, Fall 2016
 * Authors: Felipe Bastos, Rachel Brackert, Travis Earley, Nathaniel Fuller, Colin Ganley
 * Date: 2016-12-16
 * Email: fbastos1@umbc.edu, bac2@umbc.edu, te4@umbc.edu, fullern1@umbc.edu, cganley1@umbc.edu
 *
 */

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