<?php
session_start();
$user = $_SESSION['username'];
$office = $_SESSION['office'];
date_default_timezone_set('EST');
$today = date("Y-m-d");

if($_SESSION['apptExists'] == true)
  {
    header('Location: updateAppts.php');
  }

?>
<html>
<head>
<title>Edit Appointments</title>
<style>
table, th, td {
border: 1px solid gray;
border-collapse: collapse;
font-family:helvetica;
}

th, td {
padding: 10px;
text-align: left;
}

tr:nth-child(even) {
background-color:#eee;
}

tr:nth-child(odd) {
background-color:#fff;
}

</style>
</head>
<body>


<form action='processAppts.php' method='post' name='formEdit'>
<fieldset class='group'>
<legend><caption><label for='selectedDate'> Appointment Date: </label><input id='selectedDate' type='date' name='selectedDate' value='<?php echo $today; ?>' min='<?php echo $today; ?>'/></caption></legend>
<ul class='checkbox'>
  <table style='width:35%'>
  <tr>
    <th>Time</th>
    <th>Maximum Number of Students<br/>(1 = Individual and >1 = Group)</th>
    <th>Location</th>
  </tr>
  <tr>
    <td><input type='checkbox' id='cb1' name='apptTimes[]' value='0800' /><label for='cb1'>8:00 AM</label></td>
    <td><input id='num1' type='number' name='numStudents[]' value='1' min='1' max='10'/></td>
    <td><input type='text' id='loc1' name='locations[]' size='5' maxlength='20'></td>
  </tr>
  <tr>
    <td><input type='checkbox' id='cb2' name='apptTimes[]' value='0830' /><label for='cb2'>8:30 AM</label></td>
    <td><input id='num2' type='number' name='numStudents[]' value='1' min='1' max='10'/></td>
    <td><input type='text' id='loc2' name='locations[]' size='5' maxlength='20'></td>
  </tr>
  <tr>
    <td><input type='checkbox' id='cb3' name='apptTimes[]' value='0900' /><label for='cb3'>9:00 AM</label></td>
    <td><input id='num3' type='number' name='numStudents[]' value='1' min='1' max='10'/></td>
    <td><input type='text' id='loc3' name='locations[]' size='5' maxlength='20'></td>
  </tr>
  <tr>
    <td><input type='checkbox' id='cb4' name='apptTimes[]' value='0930' /><label for='cb4'>9:30 AM</label></td>
    <td><input id='num4' type='number' name='numStudents[]' value='1' min='1' max='10'/></td>
    <td><input type='text' id='loc4' name='locations[]' size='5' maxlength='20'></td>
  </tr>
  <tr>
    <td><input type='checkbox' id='cb5' name='apptTimes[]' value='1000' /><label for='cb5'>10:00 AM</label></td>
    <td><input id='num5' type='number' name='numStudents[]' value='1' min='1' max='10'/></td>
    <td><input type='text' id='loc5' name='locations[]' size='5' maxlength='20'></td>
  </tr>
  <tr>
    <td><input type='checkbox' id='cb6' name='apptTimes[]' value='1030' /><label for='cb6'>10:30 AM</label></td>
    <td><input id='num6' type='number' name='numStudents[]' value='1' min='1' max='10'/></td>
    <td><input type='text' id='loc6' name='locations[]' size='5' maxlength='20'></td>
  </tr>
  <tr>
    <td><input type='checkbox' id='cb7' name='apptTimes[]' value='1100' /><label for='cb7'>11:00 AM</label></td>
    <td><input id='num7' type='number' name='numStudents[]' value='1' min='1' max='10'/></td>
    <td><input type='text' id='loc7' name='locations[]' size='5' maxlength='20'></td>
  </tr>
  <tr>
    <td><input type='checkbox' id='cb8' name='apptTimes[]' value='1130' /><label for='cb8'>11:30 AM</label></td>
    <td><input id='num8' type='number' name='numStudents[]' value='1' min='1' max='10'/></td>
    <td><input type='text' id='loc8' name='locations[]' size='5' maxlength='20'></td>
  </tr>
  <tr>
    <td><input type='checkbox' id='cb9' name='apptTimes[]' value='1200' /><label for='cb9'>12:00 PM</label></td>
    <td><input id='num9' type='number' name='numStudents[]' value='1' min='1' max='10'/></td>
    <td><input type='text' id='loc9' name='locations[]' size='5' maxlength='20'></td>
  </tr>
  <tr>
    <td><input type='checkbox' id='cb10' name='apptTimes[]' value='1230' /><label for='cb10'>12:30 PM</label></td>
    <td><input id='num10' type='number' name='numStudents[]' value='1' min='1' max='10'/></td>
    <td><input type='text' id='loc10' name='locations[]' size='5' maxlength='20'></td>
  </tr>
  <tr>
    <td><input type='checkbox' id='cb11' name='apptTimes[]' value='1300' /><label for='cb11'>1:00 PM</label></td>
    <td><input id='num11' type='number' name='numStudents[]' value='1' min='1' max='10'/></td>
    <td><input type='text' id='loc11' name='locations[]' size='5' maxlength='20'></td>
  </tr>
  <tr>
    <td><input type='checkbox' id='cb12' name='apptTimes[]' value='1330' /><label for='cb12'>1:30 PM</label></td>
    <td><input id='num12' type='number' name='numStudents[]' value='1' min='1' max='10'/></td>
    <td><input type='text' id='loc12' name='locations[]' size='5' maxlength='20'></td>
  </tr>
  <tr>
    <td><input type='checkbox' id='cb13' name='apptTimes[]' value='1400' /><label for='cb13'>2:00 PM</label></td>
    <td><input id='num13' type='number' name='numStudents[]' value='1' min='1' max='10'/></td>
    <td><input type='text' id='loc13' name='locations[]' size='5' maxlength='20'></td>
  </tr>
  <tr>
    <td><input type='checkbox' id='cb14' name='apptTimes[]' value='1430' /><label for='cb14'>2:30 PM</label></td>
    <td><input id='num14' type='number' name='numStudents[]' value='1' min='1' max='10'/></td>
    <td><input type='text' id='loc14' name='locations[]' size='5' maxlength='20'></td>
  </tr>
  <tr>
    <td><input type='checkbox' id='cb15' name='apptTimes[]' value='1500' /><label for='cb15'>3:00 PM</label></td>
    <td><input id='num15' type='number' name='numStudents[]' value='1' min='1' max='10'/></td>
    <td><input type='text' id='loc15' name='locations[]' size='5' maxlength='20'></td>
  </tr>
  <tr>
    <td><input type='checkbox' id='cb16' name='apptTimes[]' value='1530' /><label for='cb16'>3:30 PM</label></td>
    <td><input id='num16' type='number' name='numStudents[]' value='1' min='1' max='10'/></td>
    <td><input type='text' id='loc16' name='locations[]' size='5' maxlength='20'></td>
  </tr>
  <tr>
    <td><input type='checkbox' id='cb17' name='apptTimes[]' value='1600' /><label for='cb17'>4:00 PM</label></td>
    <td><input id='num17' type='number' name='numStudents[]' value='1' min='1' max='10'/></td>
    <td><input type='text' id='loc17' name='locations[]' size='5' maxlength='20'></td>
  </tr>
  <tr>
    <td><input type='checkbox' id='cb18' name='apptTimes[]' value='1630' /><label for='cb18'>4:30 PM</label></td>
    <td><input id='num18' type='number' name='numStudents[]' value='1' min='1' max='10'/></td>
    <td><input type='text' id='loc18' name='locations[]' size='5' maxlength='20'></td>
  </tr>
</table><br/>
<input type='submit' value='Save Appointments'>
</ul>
</fieldset><br/><br/>

</form>
</body>
</html>
