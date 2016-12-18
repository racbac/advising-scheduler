<?php

    function dropAppt($student, $connect = false) {
        if ($connect == false) {
            include('../CommonMethods.php');
            $connect = new Common(false);
        }
        // get curr appointment id
        $sql = "SELECT `appointmentID` FROM `students_academic_info` WHERE `username` = '$student'";
        $rs = $connect->executeQuery($sql, $_SERVER['SCRIPT_NAME']);
        $apptID = mysql_fetch_assoc($rs)['appointmentID'];
        if ($apptID != NULL) {
            // decrease number of students attending in appointments
            $sql = "UPDATE `appointments` SET `curr_students` = `curr_students` - 1 WHERE `appointment_ID` = '$apptID'";
            $rs = $connect->executeQuery($sql, $_SERVER['SCRIPT_NAME']);
            // set student's appointment to NULL
            $sql = "UPDATE `students_academic_info` SET `appointmentID` = NULL WHERE `username` = '$student'";
            $rs = $connect->executeQuery($sql, $_SERVER['SCRIPT_NAME']);
        }
        unset($connect);
    }

    function sticky($name, $default = false) {
        if(isset($_POST[$name])) 
            echo(" value=".$_POST[$name]); 
        else if ($default != false)
            echo(" value=".$default);
    }
    function stickySelect($name, $value, $default) {
        if(isset($_POST[$name])) {
            if ($_POST[$name] == $value) { 
                echo(" selected"); 
            }
        }
        else if ($value == $default) {
            echo(" selected");
        }
    }

?>