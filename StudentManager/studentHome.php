<!--
   Project: CMSC331 Project 02, Fall 2016
   Authors: Felipe Bastos, Rachel Backert, Travis Earley, Nathaniel Fuller, Colin Ganley
   Date: 2016-12-13
   Email: fbastos1@umbc.edu, bac2@umbc.edu, te4@umbc.edu, fullern1@umbc.edu, cganley1@umbc.edu

   Homepage for student displays basic profile information and their advising appointment. 
   Contains links to change their appointment or edit their additional information. 
-->
<!DOCTYPE html>
<meta charset="UTF-8">
<html>
    <head>
       <title>Your Profile</title>
		<link rel="icon" type="image/png" href="http://sites.umbc.edu/wp-content/themes/umbc/assets/images/icon.png">
		<link href="https://fonts.googleapis.com/css?family=Catamaran:300" rel="stylesheet">
		<link href="../main.css" rel="stylesheet" type="text/css">
    </head>
	<body>
		<div id="wrapper">
			<header>
				<div id="Top-Header">
					<div id="Page-Title">
						<a class="Title">your profile</a>
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

			<div class="Main-Form">
				<?php
					session_start();
                                        //verify user is logged in
                                        if(!$_SESSION['userToken']) { header('Location: ../LoginPage/login.php'); }
					include("../CommonMethods.php");
					$COMMON = new Common(false);
                                        //check if the page is in the offseason
                                        $sql = "SELECT `closed` FROM `offseason` WHERE `i` = 1";
                                        $rs = $COMMON->executeQuery($sql,$_SERVER['SCRIPT_NAME']);
                                        $check = mysql_fetch_row($rs)[0];
                                        if ($check == 1){
					  header("Location: ../LoginPage/awayPage.php");
					}
					// get basic info
                                        $_SESSION['userRole'] = "student";
					$curr_user = $_SESSION['username'];
					$sql = "SELECT `firstName`,`lastName` FROM `users` WHERE `username` = '".$curr_user."'";
					$rs = $COMMON->executeQuery($sql,$_SERVER['SCRIPT_NAME']);
					$user_data = mysql_fetch_assoc($rs);

					// get academic info
					$sql = "SELECT `major`,`appointmentID` FROM students_academic_info WHERE `username` = '".$curr_user."'";
					$rs = $COMMON->executeQuery($sql,$_SERVER['SCRIPT_NAME']);
					$academic_data = mysql_fetch_assoc($rs);
                
					// display
					echo("<div class='Restraint'><div class='LHeavy'><a class='Subtitle'>welcome, </a><a class='Title'>".$user_data['firstName']." ".$user_data['lastName']."</a></div>");
					


					echo("<div class='Subtitle Header'>".$academic_data['major']."</div></div>");


					// get appt info
					$sql = "SELECT * FROM `appointments` WHERE `appointment_ID` = '".$academic_data['appointmentID']."'";
					$rs = $COMMON->executeQuery($sql, $_SERVER['SCRIPT_NAME']);
					$appt_data = mysql_fetch_assoc($rs);
					// display appointment or lack thereof
					if (!$appt_data) {
						echo("<a class='CenteredDescriptor'>you are not scheduled for a meeting.</a>");
					}
					else {
						// get advisor name
						$sql = "SELECT `firstName`,`lastName` FROM `users` WHERE `username` = '".$appt_data['advisor_ID']."'";
						$rs = $COMMON->executeQuery($sql,$_SERVER['SCRIPT_NAME']);
						$appt_data = array_merge($appt_data, mysql_fetch_assoc($rs));
                   	
						echo("<a class='Descriptor'>your appointment</a>\n<div>\n<ul>");

						echo("<li>Date: ".$appt_data['date']."</li>\n");
						echo("<li>Time: ".$appt_data['start_time']."</li>\n");
						echo("<li>Location: ".$appt_data['location']."</li>\n");
						echo("<li>Advisor: ".$appt_data['firstName']." ".$appt_data['lastName']."</li>\n");                    
                    
						// handle differences in displaying group vs individual meetings
						if ($appt_data['max_students'] == 1) {
							echo("<li>Type: Individual</li>\n");
						}
						else {
							echo("<li>Type: Group</li>\n");
							echo("<li>Students attending: ".$appt_data['curr_students']."</li>\n");
						}
                    echo("</ul></div>\n");
					}
				?>
				<div>
					<form action="../AppointmentManager/allAppointments.php"><button name="submit" id="SearchAppt" class="submit"><span>view appointments</span></button></form>
				</div>

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