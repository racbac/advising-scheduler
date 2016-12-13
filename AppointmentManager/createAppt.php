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

  <select name="month" required>
      <option value="1">January</option>
      <option value="2">February</option>
      <option value="3">March</option>
      <option value="4">April</option>
      <option value="5">May</option>
      <option value="6">June</option>
      <option value="7">July</option>
      <option value="8">August</option>
      <option value="9">September</option>
      <option value="10">October</option>
      <option value="11">November</option>
      <option value="12">December</option>
  </select>
  <input type="number" min="1" max="31" required>


  <input type="date" name="date" min=<?php echo(date('Y-m-d')); if(isset($_POST['date'])) echo(" value=".$_POST['date']); ?> />
  <!-- LINE BREAK -->
  <br>
  <!-- LINE BREAK -->
  Start Time:
  <!-- <input type="time" name="startTime" <?php if(isset($_POST['startTime'])) echo(" value=".$_POST['startTime']); ?> /> -->

  <select name="startHour">
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    <option value="6">6</option>
    <option value="7">7</option>
    <option value="8">8</option>
    <option value="9">9</option>
    <option value="10">10</option>
    <option value="11">11</option>
    <option value="12">12</option>
  </select>
  <select name="startMin">
    <option value="00">00</option>
    <option value="15">15</option>
    <option value="30">30</option>
    <option value="45">45</option>
  </select>
  <select name="startAmPm">
    <option value="AM">AM</option>
    <option value="PM">PM</option>
  </select>

  End Time:
  <!--<input type="time" name="endTime" <?php if(isset($_POST['endTime'])) echo(" value=".$_POST['endTime']); ?> />-->
  <select name="endHour">
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    <option value="6">6</option>
    <option value="7">7</option>
    <option value="8">8</option>
    <option value="9">9</option>
    <option value="10">10</option>
    <option value="11">11</option>
    <option value="12">12</option>
  </select>
  <select name="endMin">
    <option value="00">00</option>
    <option value="15">15</option>
    <option value="30">30</option>
    <option value="45">45</option>
  </select>
  <select name="endAmPm">
    <option value="AM">AM</option>
    <option value="PM">PM</option>
  </select>
  <br>

  Appointment Size:
  <input type="number" name="apptSize" <?php if(isset($_POST['apptSize'])) echo(" value=".$_POST['apptSize']); ?> placeholder="1-40" min="1" max="40">

  <br>

  Session Leader:
  <select name="sessionLeader" <?php if(isset($_POST['sessionLeader'])) echo(" value=".$_POST['sessionLeader']); ?>>
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

  $posted = array("sessionLeader" => $_POST['sessionLeader'], "date" => $_POST['date'], "startTime" => date("H:i", strtotime($_POST['startHour'].":".$_POST['startMin']." ".$_POST['startAmPm'])) , "endTime" => date("H:i", strtotime($_POST['endHour'].":".$_POST['endMin']." ".$_POST['endAmPm'])), "location" => $_POST['location'], "apptSize" => $_POST['apptSize']);

  // validate input; note that input elements validate the date, appointment size, advisor, and location
  $errors = 0;
  // end time must succeed start time
  if ($posted["startTime"] > $posted["endTime"]) {
    $errors++;
    echo("Meeting must end later than it starts. ");
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

?>