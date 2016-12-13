<?php
session_start();
include('CommonMethods.php');
$COMMON = new Common(false); // common methods

// Get userName and isAdvisor 
$userName = $_SESSION['userName'];
$isAdvisor = $_SESSION['isAdvisor'];

// Get info from usersInfo for given username
$sql = "SELECT * FROM `usersInfo` WHERE `userName` ='$userName'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_row($rs);

// Save fieldOfStudy, isAdvisor, and appointmentID
$fieldOfStudy = $row['4'];
//$isAdvisor = $row['5'];
$appointmentID = $row['6'];

// Select meetings from appointments that contain fieldOfStudy
$sql = "SELECT * FROM `appointments`";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

if($isAdvisor == 1) {
	echo("<form action=\"advisor.php\" method=\"post\"><button type=\"submit\" class=\"BackButton\"><span>back</span></button></form>");
} else {
	echo("<form action=\"student.php\" method=\"post\"><button type=\"submit\" class=\"BackButton\"><span>back</span></button></form>");
}

?>
</div>
	<form action="logout.php" method="post">
		<button type="submit" class="Logout"><span>logout</span></button>
	</form>
<?php
// Create meeting button
if ($isAdvisor) {
	echo("<form method=\"link\" action=\"createAppointment.html\"><button type=\"submit\" class=\"Button\"><span>create appointment</span></button></form>");
}

echo("<a id=\"myAppointments\" class=\"SolidDescriptor Header\">appointments</a>\n");
echo("<table class=\"AppointmentTable\">");
// make so all columns take up same amount of space
echo("<col width = '50'%>");
echo("<col width = '50'%>");

// start box row
echo("<tr>");
$i = 0;

// If advisor, display all appointments
if($isAdvisor == 1)
  {
    while($row = mysql_fetch_row($rs))
      {
	$spaces =  $row['5']-$row['7'];
	$id = $row['0'];
	echo("<td>");
	// Get advisor firstName and lastName
        $advisorName = $row['4'];
        $sql1 = "SELECT * FROM `usersInfo` WHERE `userName` ='$advisorName'";
        $rs1 = $COMMON->executeQuery($sql1, $_SERVER["SCRIPT_NAME"]);
        $row1 = mysql_fetch_row($rs1);
        echo("<div class=\"Name\">".$row1['2']." ".$row1['3']."</div>");
	echo("<a id=\"appointmentDate\">".$row['1']."</a> ");
	echo("<a id=\"appointmentTime\">".$row['2']."</a> ");
	// Print out meeting type
	if($row['5']==1)
	  {
	    echo("<div><a class=\"SolidDescriptor\">Individual</a></div>");
	  }
            else
              {
                echo("<div><a class=\"SolidDescriptor\">Group</a></div>");
              }
			  
	echo("<div class=\"SpacesAvailable\"><a id=\"signedUp\">".$spaces." <a class=\"SolidDescriptor\">space");
	if ($spaces != 1) {
		echo("s");
	}
	echo(" available</a></div>");
	
	echo("</td>");
	$i++;
	if($i == 2)
	  {
	    //end box row and start new
	    echo("</tr>");
	    echo("<tr>");
	    $i=0;
	  }
      }
  }
else // if student display available appointments
  {
  
    //    if ($appointmentID != NULL) {
    //		$appointmentID = NULL;
    //	}
    while($row = mysql_fetch_row($rs))
      {
	// only prints meeting if space is available and for given major
	if(($row['7']<$row['5']) and (strpos($row['6'],$fieldOfStudy)) !== false)
	  {
	    // get number of spaces available
	    $spaces = $row['5']-$row['7'];
	    // save ID to send to viewAppointment page
	    $id = $row['0'];
	    // start box column
	    echo("<td>");
	    // Get advisor firstName and lastName
	    $advisorName = $row['4'];
	    $sql1 = "SELECT * FROM `usersInfo` WHERE `userName` ='$advisorName'";
	    $rs1 = $COMMON->executeQuery($sql1, $_SERVER["SCRIPT_NAME"]);
	    $row1 = mysql_fetch_row($rs1);
	    //echo("Advisor:         ".$row1['2']." ".$row1['3']."<br>");
	    //echo("Date:             ".$row['1']."<br>");
	    //echo("Time:             ".$row['2']."<br>");
		
		echo("<div class=\"Name\">".$row1['2']." ".$row1['3']."</div>");
		echo("<a id=\"appointmentDate\">".$row['1']."</a> ");
		echo("<a id=\"appointmentTime\">".$row['2']."</a> ");
		
	    // Print out meeting type
	    if($row['5']==1)
	      {
		echo("<div><a class=\"SolidDescriptor\">Individual</a></div>");
	      }
	    else
	      {
		echo("<div><a class=\"SolidDescriptor\">Group</a></div>");
	      }
		  
		echo("<div class=\"SpacesAvailable\"><a id=\"signedUp\">".$spaces." <a class=\"SolidDescriptor\">space");
		if ($spaces != 1) {
			echo("s");
		}
		echo(" available</a></div>");	    //Only show sign up if appointmentID = NULL
		//	    if($appointmentID == NULL)
		// {
		// link to page that confirms/denies appointment sign-up
			echo("<form method=\"POST\" action=\"joinAppointment.php\"><button id=\"signUp\" type=\"submit\" name=\"submit\" class=\"Button\" value='$id'\"><span>schedule</span></button></form>");

			// }
	    // end box column
	    echo("</td>");
	    // Only 5 meetings per row
	    $i++;
	    if($i == 2)
	      {
		//end box row and start new
		echo("</tr>");
		echo("<tr>");
		$i=0;
	      }
	  }
	
      }
  }
//end final box
echo("</tr></table>");
?>