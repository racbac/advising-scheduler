<!--htmlHeader
Project: CMSC331 Project 02, Fall 2016
   Authors: Felipe Bastos, Rachel Backert, Travis Earley, Nathaniel Fuller, Colin Ganley
   Date: 2016-12-13
   Email: fbastos1@umbc.edu, bac2@umbc.edu, te4@umbc.edu, fullern1@umbc.edu, cganley1@umbc.edu
-->

<?php
   session_start();
if(!$_SESSION['userToken']) { header('Location: ../LoginPage/login.php'); }
if($_SESSION['userRole'] != "advisor") {header('Location: ../LoginPage/processLogout.php');}
$debug = false;
include('../CommonMethods.php');

$COMMON = new Common($debug);
$appt = $_POST['id'];
$sql = "SELECT * FROM `appointments` WHERE `appointment_ID` = '$appt'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

$fields = mysql_fetch_assoc($rs);
$location = $fields['location'];
$max_students = $fields['max_students'];

$sql = "SELECT `username` FROM `students_academic_info` WHERE `appointmentID` = '$appt'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

$check = true;
if(mysql_num_rows($rs) == 0){
  $check = false;
}

$sql = "SELECT `status` FROM `appointments` WHERE `appointment_ID` = '$appt'";
$rs2 = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$status = mysql_fetch_row($rs2);
?>

<!DOCTYPE html>
<meta charset="UTF-8">
<html>
    <head>
       <title>Edit Appointment</title>
		<link rel="icon" type="image/png" href="http://sites.umbc.edu/wp-content/themes/umbc/assets/images/icon.png">
		<link href="https://fonts.googleapis.com/css?family=Catamaran:300" rel="stylesheet">
		<link href="../main.css" rel="stylesheet" type="text/css">
    </head>
	<body>
		<div id="wrapper">
			<header>
				<div id="Top-Header">
					<div id="Page-Title">
						<a class="Title">edit appointment</a>
					</div>
					<a href="http://umbc.edu"><img src="../umbc50.png" title="UMBC: An Honors University in Maryland" class="umbc-logo"></a>
				</div>
				<div id="Cnms-Banner">
					<a href="http://cnms.umbc.edu"><img src="../cnms.png" class="banner"></a>
				</div>
			</header>
			<form action="../LoginPage/processLogout.php" method="post" style="text-align: center;">
				<button type="submit" class="Logout"><span>logout</span></button>
			</form>
			<div class="BackDiv">
				<form action="../AppointmentManager/allAppointments.php" method="post"><button type="submit" class="BackButton"><span>back</span></button></form>
			</div>
			<div class="Main-Form">
				<form action='processEditAppointments.php' method='post' name='EditMeeting'>
					<a class="Descriptor">where is the meeting?</a>
					<input class="inputField" placeholder="Location" type='text' size='25' maxlength='25' name='location'  value="<?php if(isset($_POST['max_students'])) echo($_POST['max_students']);?>"><br/>
					<a class="Descriptor">how many students is it for?</a>
					<input class="inputField" type="number" name="max_students" <?php if(isset($_POST['max_students'])) echo(" value=".$_POST['max_students']); ?> placeholder="1-40" min="1" max="40">
					<div>
					<?php
                                        if($status[0] == 0){
					  echo "<input id='closeReg' type='checkbox' name='close' value='yes'> <label for='closeReg' class='radialDescriptor'>Close Registration</label>";
					}
					else{
					  echo "<input id='closeReg' type='checkbox' name='close' value='yes'> <label for='closeReg' class='radialDescriptor'>Open Registration</label>";
					}
                                        ?>
					</div>
					<?php 
					//creates a checkbox for every students in the appointment
					if ($check == true){
						echo "<a class='Descriptor'>Do you want to remove specific students?</a><table class='AdvisorTable'>";
						$i = 0;
						while($students = mysql_fetch_row($rs)){
							if (!($i % 2)) {
								echo "<tr>";
							}

							echo "<td><input type='checkbox' id='id.".$students[0]."' name='students[]' value='".$students[0]."'><label for='id.".$students[0]."' class='CheckboxDescriptor'>".$students[0]."</label></td>";
							
							$i += 1;

							if (!($i % 2)) {
								echo "</tr>";
							}
						}
						echo "</table>";
					}

					?>
					
					<input type='hidden' name='id' value='<?php echo "$appt"; ?>'>
					<div>
						<button name="submit" id="Create" class="submit"><span>update</span></button>
					</div>
				</form>
			</div>
			<div id="Inner-Footer">
				<div class="main-inner-footer-field">College of Natural and Mathematical Sciences</div>
				<div class="inner-footer-field">University Center Room 116</div>
				<div class="inner-footer-field">(410) 455-5827</div>
				<div class="inner-footer-field"><a class="inner-footer-link" href="mailto:cnms@umbc.edu">cnms@umbc.edu</a></div>
			</div>
		</div>
		<div id="Footer">
			<div>
				<a href="http://umbc.edu"><img src="../footer.png" title="UMBC: An Honors University in Maryland" class="umbc-footer"></a>
			</div>
			<div>
				<a href="http://about.umbc.edu">About UMBC</a> 
				| 
				<a href="http://about.umbc.edu/visitors-guide/contact-us">Contact Us</a> 
				| 
				<a href="http://umbc.edu/go/equal-opportunity">Equal Opportunity</a> 
				| 
				Follow UMBC:
				<a href="https://facebook.com/umbcpage" title="Follow on Facebook">
					<img class="facebook-footer" src="../fbft.png">
				</a> 
				<a href="https://twitter.com/umbc" title="Follow on Twitter">
					<img class="twitter-footer" src="../twft.png">
				</a> 
				<a href="http://umbc.edu/news" title="UMBC News">
					<img class="rss-footer" src="../rssft.png">
				</a>
			</div>
			<div>
				© University of Maryland, Baltimore County  •  1000 Hilltop Circle  •  Baltimore, MD 21250
			</div>
		</div>	
	</body>
</html>


