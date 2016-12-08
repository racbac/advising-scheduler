<!--
   Project: CMSC331 Project 02, Fall 2016
   Authors: Felipe Bastos, Rachel Brackert, Travis Early, Nathaniel Fuller, Colin Ganley
   Date: 2016-12-13
   Email: fbastos1@umbc.edu, bac2@umbc.edu, te4@umbc.edu, fullern1@umbc.edu, cganley1@umbc.edu

   Homepage for student displays basic profile information and their advising appointment. 
   Contains links to change their appointment or edit their additional information. 
-->
<!DOCTYPE html>
<html>
    <head>
        <title>Student Home - UMBC CMNS Advising</title>
    </head>

    <body>
        <header>
            <div class="navigation_bar">
                <a href="../ScheduleViewer/searchAppointments.php">Search Appointments</a>
                <a href="../LoginPage/processLogout.php">Logout</a>
            </div>
        </header>
        
        <h1>Student Home</h1>
        <h2>Basic Info</h2>
            <?php
                session_start();
                // verify user is logged in            
                if (!isset($_SESSION['username'])) {
                    header('Location: ../homescreen.php');
                    exit();
                }
                include("../CommonMethods.php");
                $COMMON = new Common(false);

                // get basic info
                $curr_user = $_SESSION['username'];
                $sql = "SELECT `firstName`,`lastName` FROM `users` WHERE `username` = '".$curr_user."'";
                $rs = $COMMON->executeQuery($sql,$_SERVER['SCRIPT_NAME']);
                $user_data = mysql_fetch_assoc($rs);

                // get academic info
                $sql = "SELECT `major`,`appointmentID` FROM students_academic_info WHERE `username` = '".$curr_user."'";
                $rs = $COMMON->executeQuery($sql,$_SERVER['SCRIPT_NAME']);
                $academic_data = mysql_fetch_assoc($rs);
                
                // display
                echo($user_data['firstName']." ".$user_data['lastName']."\n");
                echo("Major next semester: ".$academic_data['major']."\n");
            ?>
        <h2>Appointment Info</h2>
            <?php
                // get appt info
                $sql = "SELECT * FROM `appointments` WHERE `appointment_ID` = '".$academic_data['appointmentID']."'";
                $rs = $COMMON->executeQuery($sql, $_SERVER['SCRIPT_NAME']);
                $appt_data = mysql_fetch_assoc($rs);
                // display appointment or lack thereof
                if (!$appt_data) {
                    echo("You are not scheduled for a meeting.");
                }
                else {
                    // get advisor name
                    $sql = "SELECT `firstName`,`lastName` FROM `users` WHERE `username` = ".$appt_data['advisor_ID']."'";
                    $rs = $COMMON->executeQuery($sql,$_SERVER['SCRIPT_NAME']);
                    $appt_data = array_merge($appt_data, mysql_fetch_assoc($rs));
                   
                    echo("Date: ".$appt_data['date']."\n");
                    echo("Time: ".$appt_data['time']."\n");
                    echo("Location: ".$appt_data['location']."\n");
                    echo("Advisor: ".$appt_data['firstName']." ".$appt_data['lastName']."\n");                    
                    
                    // handle differences in displaying group vs individual meetings
                    if ($appt_data['max_students'] == 1) {
                        echo("Type: Individual\n");
                    }
                    else {
                        echo("Type: Group\n");
                        echo("Students attending: ".$appt_data['curr_students']."\n");
                    }
                    
                }
            ?>
    </body>
</html>