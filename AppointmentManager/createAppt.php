<html>
<head>
  <title>Create an Appointment - UMBC CMNS Advising</title>
  <link rel="icon" type="image/png" href="http://sites.umbc.edu/wp-content/themes/umbc/assets/images/icon.png">
</head>

<form action="../LoginPage/processLogout.php" method="post">
  <input type="submit" name="logout" value="Log Out">
</form>
<h1>Create an Appointment</h1>
<form action="createAppt.php" method="post" id="Main-form">
  Meeting Date: 

  <select name="month">
    <option value="1" <?php stickySelect("month", 1, date("m")) ?> >January</option>
    <option value="2" <?php stickySelect("month", 2, date("m")) ?> >February</option>
    <option value="3" <?php stickySelect("month", 3, date("m")) ?> >March</option>
    <option value="4" <?php stickySelect("month", 4, date("m")) ?> >April</option>
    <option value="5" <?php stickySelect("month", 5, date("m")) ?> >May</option>
    <option value="6" <?php stickySelect("month", 6, date("m")) ?> >June</option>
    <option value="7" <?php stickySelect("month", 7, date("m")) ?> >July</option>
    <option value="8" <?php stickySelect("month", 8, date("m")) ?> >August</option>
    <option value="9" <?php stickySelect("month", 9, date("m")) ?> >September</option>
    <option value="10" <?php stickySelect("month", 10, date("m")) ?> >October</option>
    <option value="11" <?php stickySelect("month", 11, date("m")) ?> >November</option>
    <option value="12" <?php stickySelect("month", 12, date("m")) ?> >December</option>
  </select>
  <input name="day" type="number" min="1" max="31" <?php sticky("day", 1) ?> >
  <input name="year" type="number" <?php sticky("year", date("Y")) ?> >


  <br>
Start Time:
  <input name="startHour" pattern="(1[012]|0?[1-9])" <?php sticky("startHour", "08") ?> > :
  <input name="startMin"  pattern="[0-5][0-9]" <?php sticky("startMin", "00") ?> >
  <select name="startAmPm" >
      <option value="AM" <?php stickySelect("startAmPm", "AM", "AM") ?> >AM</option>
      <option value="PM" <?php stickySelect("startAmPm", "PM", "AM") ?> >PM</option>
  </select>

  End Time:
  <!--<input type="time" name="endTime" <?php if(isset($_POST['endTime'])) echo(" value=".$_POST['endTime']); ?> />-->
  <input name="endHour" pattern="(1[012]|0?[1-9])" <?php sticky("endHour", "09") ?> > :
  <input name="endMin" pattern="[0-5][0-9]" <?php sticky("endMin", "00") ?> >
  <select name="endAmPm" >
      <option value="AM" <?php stickySelect("endAmPm", "AM", "PM") ?> >AM</option>
      <option value="PM" <?php stickySelect("endAmPm", "PM", "PM") ?> >PM</option>
  </select>
  <br>

  Appointment Size:
  <input type="number" name="apptSize" <?php if(isset($_POST['apptSize'])) echo(" value=".$_POST['apptSize']); ?> placeholder="1-40" min="1" max="40" required>

  <br>

  Session Leader:
  <select name="sessionLeader" <?php if(isset($_POST['sessionLeader'])) echo(" value=".$_POST['sessionLeader']); ?> required>
    <option value="mbulger">Ms. Michelle Bulger</option>
    <option value="JulieCrosby">Mrs. Julie Crosby</option>
    <option value="ChristinePowers">Ms. Christine Powers</option>
    <option value="CNMS Advisors">CNMS Advisors</option>
  </select>

  <br>

  Location:
  <input type="text" name="location" <?php if(isset($_POST['location'])) echo(" value=".$_POST['location']); ?> required>

  <br>
  <br>

  <button type="submit" class="Submit" name="submit" ><span>Create Appointment</span></button>
  <a href="../AdvisorManager/advisorHome.php">Return to homepage</a>
</form>

</html>

<?php

if (isset($_POST['submit'])) {
  $updated = true;
  session_start();
  include('../CommonMethods.php');
  $COMMON = new Common(false);

  $posted = array("sessionLeader" => $_POST['sessionLeader'], "date" => date("Y-m-d", strtotime($_POST['year']."-".$_POST['month']."-".$_POST['day'])), "startTime" => date("H:i", strtotime($_POST['startHour'].":".$_POST['startMin']." ".$_POST['startAmPm'])) , "endTime" => date("H:i", strtotime($_POST['endHour'].":".$_POST['endMin']." ".$_POST['endAmPm'])), "location" => $_POST['location'], "apptSize" => $_POST['apptSize']);

  // validate input; note that input elements validate the date, appointment size, advisor, and location
  $errors = 0;
  // end time must succeed start time
  if ($posted["startTime"] > $posted["endTime"]) {
    $errors++;
    echo("Meeting must end later than it starts. ");
  }

  // date must be past today
  if ($posted['date'] < date("Y-m-d")) {
    $errors++;
    echo("Meeting must be today or later. ");
  }

  // appointment mustn't already exist
  $sql = "SELECT `advisor_ID`, `date`, `start_time`, `end_time` FROM `appointments` WHERE `advisor_ID` = '$posted[sessionLeader]' and `date` = '$posted[date]' and `start_time` = '$posted[startTime]'";
  $rs = $COMMON->executeQuery($sql, $_SERVER['SCRIPT_NAME']);


  if (mysql_num_rows($rs) != 0) {
    $errors++;
    echo("Appointment with this advisor, date, and time already exists. ");
  }
  
  if ($errors == 0) {
    $sql = "INSERT INTO `appointments` (`advisor_ID`, `date`, `start_time`, `end_time`, `location`, `max_students`, `curr_students`) VALUES ('$posted[sessionLeader]', '$posted[date]', '$posted[startTime]', '$posted[endTime]', '$posted[location]', '$posted[apptSize]', 0)";
    $rs = $COMMON->executeQuery($sql, $_SERVER['SCRIPT_NAME']);

    if ($rs) {
      echo("Success!");
    }
  }

}

function sticky($name, $default) {
    if(isset($_POST[$name])) 
        echo(" value=".$_POST[$name]); 
    else 
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