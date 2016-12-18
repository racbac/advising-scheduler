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
			
			<form action="createAppt.php" method="post" class="Main-Form">
			
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
          <a class='Error'>Meeting must start after current time.</a>
        </div>
      </div>");
  }

  // appointment mustn't already exist
  $sql = "SELECT `advisor_ID`, `date`, `start_time`, `end_time` FROM `appointments` WHERE `advisor_ID` = '$posted[sessionLeader]' and `date` = '$posted[date]' and `start_time` = '$posted[startTime]'";
  $rs = $COMMON->executeQuery($sql, $_SERVER['SCRIPT_NAME']);


  if (mysql_num_rows($rs) != 0) {
    $errors++;
    echo("<div class='ErrorDiv'>
        <div class='InnerErrorDiv'>
          <a class='ErrorBackground'>error</a>
          <a class='Error'>An appointment with this advisor, date, time and location already exists.</a>
        </div>
      </div>");
  }
  
  if ($errors == 0) {
    $sql = "INSERT INTO `appointments` (`advisor_ID`, `date`, `start_time`, `end_time`, `location`, `max_students`, `curr_students`) VALUES ('$posted[sessionLeader]', '$posted[date]', '$posted[startTime]', '$posted[endTime]', '$posted[location]', '$posted[apptSize]', 0)";
    $rs = $COMMON->executeQuery($sql, $_SERVER['SCRIPT_NAME']);
  }

}

function sticky($name, $default) {
    if(isset($_POST[$name])) 
        echo(" value=".$_POST[$name]); 
    else 
        echo(" value=".$default);
    }

?>


				<a class="Descriptor">when is your appointment?</a>
				<div id="dateDescriptor">
					<a class="DateDescriptor Month">month:</a>
					<a class="DateDescriptor Day">day:</a>
					<a class="DateDescriptor Year">year:</a>
				</div>
				<div class="dateSelector">
					<select name="month" class="DateTime" id="picker" required>
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
					<input name="day" type="number" min="1" max="31" class="DateTime" required>
					<input name="year" type="number" class="DateTime" value="2017" required>
				</div>
				<div id="dateDescriptor">
					<a class="DateDescriptor Hour">hour:</a>
					<a class="DateDescriptor Minute">minute:</a>
				</div>
				<div class="timeSelector">
					<select name="startHour" class="DateTime" id="picker" required>
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
					<select name="startMin" class="DateTime" id="picker" required>
						<option value="00">00</option>
						<option value="15">15</option>
						<option value="30">30</option>
						<option value="45">45</option>
					</select>
					<select name="startAmPm" class="DateTime" id="picker" required>
						<option value="AM">AM</option>
						<option value="PM">PM</option>
					</select>
				</div>
				<div id="dateDescriptor">
					<a class="DateDescriptor Hour" id="endingDescriptor">hour:</a>
					<a class="DateDescriptor Minute" id="endingDescriptor">minute:</a>
				</div>
				<a class="Descriptor">and when does it end?</a>
				<div class="timeSelector" id="ending">
					<select name="endHour" class="DateTime" id="picker" required>
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
					<select name="endMin" class="DateTime" id="picker" required>
						<option value="00">00</option>
						<option value="15">15</option>
						<option value="30">30</option>
						<option value="45">45</option>
					</select>
					<select name="endAmPm" class="DateTime" id="picker" required>
						<option value="AM">AM</option>
						<option value="PM">PM</option>
					</select>
				</div>
				
				<a class="Descriptor">how many students is it for?</a>
				<input class="inputField" type="number" name="apptSize" <?php if(isset($_POST['apptSize'])) echo(" value=".$_POST['apptSize']); ?> placeholder="1-40" min="1" max="40" required>
		
				<br>
				<a class="Descriptor">who will be the leader for the session?</a>
				<select class="inputField" name="sessionLeader" <?php if(isset($_POST['sessionLeader'])) echo(" value=".$_POST['sessionLeader']); ?> required>
					<option value="mbulger">Ms. Michelle Bulger</option>
					<option value="julie11">Mrs. Julie Crosby</option>
					<option value="cpowers1">Ms. Christine Powers</option>
					<option value="cnms">CNMS Advisors</option>
				</select>
				
				<br>
				<a class="Descriptor">and where is it?</a>
				<input class="inputField" type="text" name="location" value="<?php if(isset($_POST['location'])) echo($_POST['location']); ?>">
				
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
