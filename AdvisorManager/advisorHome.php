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
$user = $_SESSION['username'];
$sql = "SELECT * FROM `users` WHERE `username` = '$user'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_row($rs);

//check if it is the student registration is set to off or not
$sql = "SELECT `closed` FROM `offseason` WHERE `i` = 1";
$rs = $COMMON->executeQuery($sql,$_SERVER['SCRIPT_NAME']);
$check = mysql_fetch_row($rs)[0];

?>

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
				<a class="Subtitle">Welcome, </a><a class="Title"><?php echo($row[0]);?></a>
                                <div>
                               
                     			<form action="../AppointmentManager/createAppt.php"><button name="submit" id="SearchAppt" class="submit"><span>create appointment</span></button></form>
				</div>
				<div>
					<form action="../AppointmentManager/allAppointments.php"><button name="submit" id="SearchAppt" class="submit"><span>search appointments</span></button></form>
				</div>

                                  <div>
                                        <form action="createAdvisor.php"><button name="submit" id="SearchAppt" class="submit"><span>create advisor</span></button></form>
                                  </div>

                                <?php
                                if ($check == 0){
				  ?>
                                  <div>
                                          <form action="../Utilities/close.php"><button name="submit" id="CloseReg" class="submit"><span>close student registration</span></button></form>
                                  </div>
                                <?php
				}	
				else{
				  ?>
				  <div>
                                          <form action="../Utilities/close.php"><button name="submit" id="CloseReg" class="submit"><span>open student registration</span></button></form>
                                  </div>
				<?php
				}
                                ?>

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