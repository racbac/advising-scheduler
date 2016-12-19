<!--
Project: CMSC331 Project 02, Fall 2016
Authors: Felipe Bastos, Rachel Backert, Travis Earley, Nathaniel Fuller, Colin Ganley
Date: 2016-12-16
Email: fbastos1@umbc.edu, bac2@umbc.edu, te4@umbc.edu, fullern1@umbc.edu, cganley1@umbc.edu
Users enter new account information using this sticky form. 
-->
<!DOCTYPE html>
<meta charset="UTF-8">
<html>
    <head>
       <title>Create an appointment</title>
		<link rel="icon" type="image/png" href="http://sites.umbc.edu/wp-content/themes/umbc/assets/images/icon.png">
		<link href="https://fonts.googleapis.com/css?family=Catamaran:300" rel="stylesheet">
		<link href="../main.css" rel="stylesheet" type="text/css">
    </head>
    <body>
		<div id="wrapper">
			<header>
				<div id="Top-Header">
					<div id="Page-Title">
						<a class="Title">create an appointment</a>
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
				<form action="../AdvisorManager/advisorHome.php" method="post"><button type="submit" class="BackButton"><span>back</span></button></form>
			</div>
						
				<?php
                                        session_start();
                                        if(!$_SESSION['userToken']) {header('Location: ../LoginPage/login.php');}
					if (isset($_POST['submit'])) {
					$updated = true;
					include('../CommonMethods.php');
					$COMMON = new Common(false);
					$posted = array("sessionLeader" => $_POST['sessionLeader'], "date" => date("Y-m-d", strtotime($_POST['year']."-".$_POST['month']."-".$_POST['day'])), "startTime" => date("H:i", strtotime($_POST['startHour'].":".$_POST['startMin']." ".$_POST['startAmPm'])) , "endTime" => date("H:i", strtotime($_POST['endHour'].":".$_POST['endMin']." ".$_POST['endAmPm'])), "location" => $_POST['location'], "apptSize" => $_POST['apptSize']);
					// validate input; note that input elements validate the date, appointment size, advisor, and location
					$errors = 0;
					// end time must succeed start time
					if ($posted["startTime"] > $posted["endTime"]) {
						$errors++;
						echo("<div class='ErrorDiv'>
							<div class='InnerErrorDiv'>
							  <a class='ErrorBackground'>error</a>
							  <a class='Error'>Meeting must end later than it starts.</a>
							</div>
						  </div>");
					  }
					  // date must be past today
					  if ($posted['date'] < date("Y-m-d")) {
						$errors++;
						echo("<div class='ErrorDiv'>
							<div class='InnerErrorDiv'>
							  <a class='ErrorBackground'>error</a>
							  <a class='Error'>Meeting must start after current date.</a>
							</div>
						  </div>");
					  }
					  // appointment mustn't already exist
					  $sql = "SELECT * FROM `appointments` WHERE `advisor_ID` = '$posted[sessionLeader]' and `date` = '$posted[date]' and ((`start_time` BETWEEN '$posted[startTime]' and '$posted[endTime]') or (`end_time` BETWEEN '$posted[startTime]' and '$posted[endTime]'))";
					  $rs = $COMMON->executeQuery($sql, $_SERVER['SCRIPT_NAME']);
					  if (mysql_num_rows($rs) != 0) {
						$errors++;
							echo("<div class='ErrorDiv'>
									<div class='InnerErrorDiv'>
									  <a class='ErrorBackground'>error</a>
									  <a class='Error'>An appointment with this advisor, date, and time already exists.</a>
									</div>
								</div>");}
					  
					  if ($errors == 0) {
						$sql = "INSERT INTO `appointments` (`advisor_ID`, `date`, `start_time`, `end_time`, `location`, `max_students`, `curr_students`) VALUES ('$posted[sessionLeader]', '$posted[date]', '$posted[startTime]', '$posted[endTime]', '$posted[location]', '$posted[apptSize]', 0)";
						$rs = $COMMON->executeQuery($sql, $_SERVER['SCRIPT_NAME']);

						echo("<div class='SuccessDiv'>
							<div class='InnerSuccessDiv'>
							  <a class='SuccessBackground'>success</a>
							  <a class='Success'>Appointment created.</a>
							</div>
						  </div>");

					  }
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
				
				<form action="createAppt.php" method="post" class="Main-Form">		
					<a class="Descriptor">when is your appointment?</a>
					<div id="dateDescriptor">
						<a class="DateDescriptor Month">month:</a>
						<a class="DateDescriptor Day">day:</a>
						<a class="DateDescriptor Year">year:</a>
					</div>
					<div class="dateSelector">
						<select name="month" class="DateTime" id="picker" required>
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
						<input name="day" type="number" min="1" max="31" class="DateTime" <?php sticky("day", date("d")); ?> required>
						<input name="year" type="number" class="DateTime" <?php sticky("year", date("Y")) ?> required>
					</div>
					
					<a class="Descriptor">when does it start?</a>
					<div id="dateDescriptor">
						<a class="DateDescriptor Hour">hour:</a>
						<a class="DateDescriptor Minute">minute:</a>
					</div>
					<div class="timeSelector">
						<input class="DateTime" id="picker" name="startHour" pattern="(1[012]|0?[1-9])" <?php sticky("startHour", "08") ?> required>
						<input class="DateTime" id="picker" name="startMin"  pattern="[0-5][0-9]" <?php sticky("startMin", "00") ?> required>
						<select class="DateTime" id="picker" name="startAmPm" required>
							<option value="AM" <?php stickySelect("startAmPm", "AM", "AM") ?> >am</option>
							<option value="PM" <?php stickySelect("startAmPm", "PM", "AM") ?> >pm</option>
						</select>
					</div>
					<div id="dateDescriptor">
						<a class="DateDescriptor Hour" id="endingDescriptor">hour:</a>
						<a class="DateDescriptor Minute" id="endingDescriptor">minute:</a>
					</div>
					<a class="Descriptor">and when does it end?</a>
					<div class="timeSelector" id="ending">
						<input class="DateTime" id="picker" name="endHour" pattern="(1[012]|0?[1-9])" <?php sticky("endHour", "09") ?> required>
						<input class="DateTime" id="picker" name="endMin" pattern="[0-5][0-9]" <?php sticky("endMin", "00") ?> required>
						<select class="DateTime" id="picker" name="endAmPm" required>
							<option value="AM" <?php stickySelect("endAmPm", "AM", "PM") ?> >am</option>
							<option value="PM" <?php stickySelect("endAmPm", "PM", "PM") ?> >pm</option>
						</select>
					</div>
					
					<a class="Descriptor">how many students is it for?</a>
					<input class="inputField" type="number" name="apptSize" <?php sticky("apptSize","10"); ?> placeholder="1-40" min="1" max="40" required>
		
				<br>
				<a class="Descriptor">who will be the leader for the session?</a>
				<select class="inputField" name="sessionLeader" required>
					<option value="mbulger" <?php stickySelect("sessionLeader", "cmns", "cmns") ?> >Ms. Michelle Bulger</option>
					<option value="julie11" <?php stickySelect("sessionLeader", "cmns", "cmns") ?> >Mrs. Julie Crosby</option>
					<option value="cpowers1" <?php stickySelect("sessionLeader", "cmns", "cmns") ?> >Ms. Christine Powers</option>
					<option value="cnms" <?php stickySelect("sessionLeader", "cmns", "cmns") ?>>CNMS Advisors</option>
				</select>
				
				<br>
				<a class="Descriptor">and where is it?</a>
				<input class="inputField" type="text" name="location" <?php sticky("location"); ?> >

				
					<div>
						<button name="submit" id="Create" class="submit"><span>create</span></button>
					</div>

					
			</form>
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

