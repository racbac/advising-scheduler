<!--
advisors and students can filter appointments by date, time, advisor, availability. Otherwise, display in month/day/year hour:minute order
            
students can sign up for available appointments, which signs them out of their current appointment

advisors can edit appointment information
-->
<?php ob_start(); session_start(); include('../Utilities/phpFuns.php');  ?>

<!DOCTYPE html>
<meta charset="UTF-8">
<html>
    <head>
       <title>Appointment Search</title>
        <link rel="icon" type="image/png" href="http://sites.umbc.edu/wp-content/themes/umbc/assets/images/icon.png">
        <link href="https://fonts.googleapis.com/css?family=Catamaran:300" rel="stylesheet">
        <link href="../main.css" rel="stylesheet" type="text/css">
    </head>

    <body>

        <div id="wrapper">
            <header>
                <div id="Top-Header">
                    <div id="Page-Title">
                        <a class="Title">find an appointment</a>
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
                <form action=<?php session_start(); if($_SESSION['userRole'] == "advisor" ) echo('../AdvisorManager/advisorHome.php'); else echo('../StudentManager/studentHome.php'); ?> method="post"><button type="submit" class="BackButton"><span>back</span></button></form>
            </div>
            
            <form action="allAppointments.php" method="post" class="Main-Form">
                <a class="Descriptor">I want to find an appointment starting between...</a>
                <div id="dateDescriptor">
                    <a class="DateDescriptor Month">month:</a>
                    <a class="DateDescriptor Day">day:</a>
                    <a class="DateDescriptor Year">year:</a>
                </div>
                <div class="dateSelector">
                    <select name="startMonth" class="DateTime">
                        <option value="1" <?php stickySelect("startMonth", 1, date("m")) ?> >January</option>
                        <option value="2" <?php stickySelect("startMonth", 2, date("m")) ?> >February</option>
                        <option value="3" <?php stickySelect("startMonth", 3, date("m")) ?> >March</option>
                        <option value="4" <?php stickySelect("startMonth", 4, date("m")) ?> >April</option>
                        <option value="5" <?php stickySelect("startMonth", 5, date("m")) ?> >May</option>
                        <option value="6" <?php stickySelect("startMonth", 6, date("m")) ?> >June</option>
                        <option value="7" <?php stickySelect("startMonth", 7, date("m")) ?> >July</option>
                        <option value="8" <?php stickySelect("startMonth", 8, date("m")) ?> >August</option>
                        <option value="9" <?php stickySelect("startMonth", 9, date("m")) ?> >September</option>
                        <option value="10" <?php stickySelect("startMonth", 10, date("m")) ?> >October</option>
                        <option value="11" <?php stickySelect("startMonth", 11, date("m")) ?> >November</option>
                        <option value="12" <?php stickySelect("startMonth", 12, date("m")) ?> >December</option>
                    </select>
                <input name="startDay" class="DateTime" type="number" min="1" max="31" <?php sticky("startDay", 1) ?> >
                <input name="startYear" class="DateTime" type="number" <?php sticky("startYear", date("Y")) ?> >
                </div>

                <a class="Descriptor">...and</a>
                <div id="dateDescriptor">
                    <a class="DateDescriptor Month">month:</a>
                    <a class="DateDescriptor Day">day:</a>
                    <a class="DateDescriptor Year">year:</a>
                </div>
                <div class="dateSelector">
                    <select name="endMonth" class="DateTime">
                        <option value="1" <?php stickySelect("endMonth", 1, date("m")) ?> >January</option>
                        <option value="2" <?php stickySelect("endMonth", 2, date("m")) ?> >February</option>
                        <option value="3" <?php stickySelect("endMonth", 3, date("m")) ?> >March</option>
                        <option value="4" <?php stickySelect("endMonth", 4, date("m")) ?> >April</option>
                        <option value="5" <?php stickySelect("endMonth", 5, date("m")) ?> >May</option>
                        <option value="6" <?php stickySelect("endMonth", 6, date("m")) ?> >June</option>
                        <option value="7" <?php stickySelect("endMonth", 7, date("m")) ?> >July</option>
                        <option value="8" <?php stickySelect("endMonth", 8, date("m")) ?> >August</option>
                        <option value="9" <?php stickySelect("endMonth", 9, date("m")) ?> >September</option>
                        <option value="10" <?php stickySelect("endMonth", 10, date("m")) ?> >October</option>
                        <option value="11" <?php stickySelect("endMonth", 11, date("m")) ?> >November</option>
                        <option value="12" <?php stickySelect("endMonth", 12, date("m")) ?> >December</option>
                    </select>
<<<<<<< HEAD
                    <input name="endDay" class="DateTime" type="number" min="1" max="31" <?php sticky("endDay", 31) ?> >
                    <input name="endYear" class="DateTime" type="number" <?php sticky("startYear", date("Y")) ?> >
                </div>

                <div id="dateDescriptor">
                    <a class="DateDescriptor Hour" id="endingDescriptor">hour:</a>
                    <a class="DateDescriptor Minute" id="endingDescriptor">minute:</a>
                </div>
                    <a class="Descriptor">I want the appointment to start on or after...</a>
                <div class="timeSelector" id="ending">
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
                <a class="Descriptor">...and end before</a>
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
                <a class="Descriptor">who do you want to meet with?</a>
                <table class="AdvisorTable">
                    <tr>
                        <td><label class="CheckboxDescriptor"><input type="checkbox" name="sessionLeader[]" value="mbulger" checked>Ms. Michelle Bulger</label></td>
                        <td><label class="CheckboxDescriptor"><input type="checkbox" name="sessionLeader[]" value="julie11" checked>Mrs. Julie Crosby</label></td>
                    </tr>
                    <tr>    
                        <td><label class="CheckboxDescriptor"><input type="checkbox" name="sessionLeader[]" value="cpowers1" checked>Ms. Christine Powers</label></td>
                        <td><label class="CheckboxDescriptor"><input type="checkbox" name="sessionLeader[]" value="cnms" checked>CNMS advisors</label></td>
                    </tr>
                </table>
                <button type="submit" id="SearchAppt" class="submit" name="submit"><span>search appointments</span></button>
            </form>


            <?php
            if (isset($_POST['submit'])) {
                include('../CommonMethods.php');
                $COMMON = new Common(false);
                //session_start();
                
=======
                    <input name="endDay" type="number" min="1" max="31" <?php sticky("endDay", 31) ?> >
                    <input name="endYear" type="number" <?php sticky("startYear", date("Y")) ?> >
                </li>
                <li> Start Time:
                    <input name="startHour" pattern="(1[012]|0?[1-9])" <?php sticky("startHour", "08") ?> > :
                    <input name="startMin"  pattern="[0-5][0-9]" <?php sticky("startMin", "00") ?> >
                    <select name="startAmPm" >
                        <option value="AM" <?php stickySelect("startAmPm", "AM", "AM") ?> >AM</option>
                        <option value="PM" <?php stickySelect("startAmPm", "PM", "AM") ?> >PM</option>
                    </select>
                </li>
                <li> End Time:
                    <input name="endHour" pattern="(1[012]|0?[1-9])" <?php sticky("endHour", "09") ?> > :
                    <input name="endMin" pattern="[0-5][0-9]" <?php sticky("endMin", "00") ?> >
                    <select name="endAmPm" >
                        <option value="AM" <?php stickySelect("endAmPm", "AM", "PM"); ?> >AM</option>
                        <option value="PM" <?php stickySelect("endAmPm", "PM", "PM"); ?> >PM</option>
                    </select>
                </li>
                <li> 
                    Advisors:
                    <label><input type="checkbox" name="sessionLeader[]" value="cnms" checked>CNMS advisors</label>
                    <label><input type="checkbox" name="sessionLeader[]" value="mbulger" checked>Ms. Michelle Bulger</label>
                    <label><input type="checkbox" name="sessionLeader[]" value="julie11" checked>Mrs. Julie Crosby</label>
                    <label><input type="checkbox" name="sessionLeader[]" value="cpowers1" checked>Ms. Christine Powers</label>
                </li>
                <li> 
                        <button type="submit" class="Submit" name="search" ><span>Search appointments</span></button>
                </li>
            </ul>

        </form>

        <?php
>>>>>>> rachel

            include('../CommonMethods.php');
            $COMMON = new Common(false);


            if (isset($_POST['switchAppt'])) { // switch appointment
                dropAppt($_SESSION['username'], $COMMON);
                joinAppt($_SESSION['username'], $_POST['switchAppt']);
                echo("<div class='SuccessDiv'>
                    <div class='InnerSuccessDiv'>
                        <a class='SuccessBackground'>success</a>
                        <a class='Success'>Appointment joined. Refreshing...</a>
                    </div>
                    </div>");
                    header("Refresh;3 url=./allAppointments.php");
            }


            if (isset($_POST['join'])) { // join appointment
                $success = joinAppt($_SESSION['username'], $_POST['join']);
                if ($success) { // successfully joined
                    echo("<div class='SuccessDiv'>
                        <div class='InnerSuccessDiv'>
                            <a class='SuccessBackground'>success</a>
                            <a class='Success'>Appointment joined. Refreshing...</a>
                        </div>
                        </div>");
                        header("Refresh;3 url=./allAppointments.php");
                } else { // already has appointment
                    echo("Are you sure you want to switch appointments?");
                    echo("<form action='allAppointments.php' method='POST'><button type='submit' name='switchAppt' value='".$_POST['join']."' >Yes, switch appointments</button></form>");        
                }
            }
            
            

            else if (isset($_POST['search'])) { // search appointments
                // get filters in array
                $filters = array();
                foreach ($_POST as $key => $field) {
                    if (isset($field)) {
                        $filters[$key] = $field;
                    }
                }
                // parse times
                $filters["startDate"] = date("Y-m-d", strtotime($_POST['startYear']."-".$_POST['startMonth']."-".$_POST['startDay']));
                $filters["endDate"] = date("Y-m-d", strtotime($_POST['endYear']."-".$_POST['endMonth']."-".$_POST['endDay']));
                $advisors = $filters['sessionLeader'];
                $filters['startTime'] = date("H:i", strtotime($_POST['startHour'].":".$_POST['startMin']." ".$_POST['startAmPm']));
                $filters['endTime'] = date("H:i", strtotime($_POST['endHour'].":".$_POST['endMin']." ".$_POST['endAmPm']));

                // validate filters
                $errors = 0;
                if ($filters['endDate'] < $filters['startDate'] and $filters['endDate'] and $filters['startDate']) {
                    $errors++;
                    echo("<div class='ErrorDiv'>
							<div class='InnerErrorDiv'>
							  <a class='ErrorBackground'>error</a>
							  <a class='Error'>Start date must precede end date.</a>
							</div>
						  </div>");
                }
                
                if ($filters['endTime'] < $filters['startTime'] and $filters['endTime'] and $filters['startTime']) {
                    $errors++;
                    echo("<div class='ErrorDiv'>
							<div class='InnerErrorDiv'>
							  <a class='ErrorBackground'>error</a>
							  <a class='Error'>Start time must precede end time.</a>
							</div>
						  </div>");
                }

                // build query
                $sql = "SELECT * FROM `appointments` WHERE 1";
                if ($filters['startDate']) {
                    if ($filters['endDate']) 
                       { $sql .= " AND `date` BETWEEN '$filters[startDate]' and '$filters[endDate]'"; }
                   { $sql .= " AND `date` >= '$filters[startDate]'"; }
                }
                if ($filters['endDate']) 
                    {$sql .= " AND `date` <= '$filters[endDate]'";}
                if ($filters['startTime']) 
                    {$sql .= " AND `start_time` >= '$filters[startTime]'";}
                if ($filters['endTime']) 
                    {$sql .= " AND `end_time` <= '$filters[endTime]'";}
                if ($advisors)
                    { $sql .= " AND `advisor_ID` IN ('".implode("', '", $advisors)."')"; }

                $sql .= " ORDER BY `date`, `start_time` ASC";
                $rs = $COMMON->executeQuery($sql, $_SERVER['SCRIPT_NAME']);


                // print appointments
                echo("<table class='AdvisorTable'><tr>");
                $i = 0;
                while($row = mysql_fetch_assoc($rs))
                {
                    $spaces =  $row['max_students']-$row['curr_students'];
                    $id = $row['appointment_ID'];
                    echo("<td>");
                    
                    // Get advisor firstName and lastName
                    $sql1 = "SELECT `firstName`, `lastName` FROM `users` WHERE `username` ='$row[advisor_ID]'";
                    $rs1 = $COMMON->executeQuery($sql1, $_SERVER["SCRIPT_NAME"]);
                    $row1 = mysql_fetch_assoc($rs1);
                    echo("<a id=\"appointmentDate\">".$row['date']." </a>");
                    echo("<a id=\"appointmentTime\">".$row['start_time']."</a>");
                    echo("<div><a id=\"advisorName\">".$row1['firstName']." ".$row1['lastName']."</a>");
                    
                    // Print out meeting type
                    if($row['max_students']==1)
                    {
                        echo("<a class='GroupDescriptor'> individual</a></div>");
                    } else {
                        echo("<a class='GroupDescriptor'> group</a></div>");
                    }
                            
                    echo("<div class='SpacesDescriptor'><a id='spacesCount'>".$spaces." space");
                    if ($spaces != 1) {
                        echo("s");
                    }
                    echo(" available</a></div>");
                    if($_SESSION['userRole'] == "advisor" )
                        {
                        // Print out button to edit appointment
<<<<<<< HEAD
                        echo("<form action='../AdvisorManager/editAppointment.php' method='POST'>");
                        echo("<button type='submit' name='id' value='$id'>Edit Appointment</button></form>");
=======
                        echo("<form action='editAppointment.php' method='POST'>");
                        echo("<button type='submit' name='submit' value='$id'>Edit Appointment</button></form>");
>>>>>>> rachel

                        // Print out button to print appointment info
                        echo("<form action='downloadMeeting.php' method='POST'>");
                        echo("<input type='checkbox' name='extra'>Extra Info");
<<<<<<< HEAD
                        echo("<button type='submit' name='id' value='$id'>Download Appointment Info</button></form>");
                        }
                    else
                    {
                        // Print out button to sign up
                        echo("<form action='joinAppointment.php' method='POST'>");
                        echo("<button class='signup' type='submit' name='id' value='$id'><span id='signUp'>sign up</span></button></form>");
=======
                        echo("<button type='submit' name='submit' value='$id'>Download Appointment Info</button></form>");
                        }

                    else // student
                    {
                        // Print out button to sign up
                        /*echo("<form action='joinAppointment.php' method='POST'>");
                        echo("<button type='submit' name='submit' value='$id'>Sign Up</button></form>");*/
                        echo("<form action='allAppointments.php' method='POST'>\n<button type='submit' name='join' value='$id'>Sign Up</button></form>");

>>>>>>> rachel
                    }
                    echo("</td>");
                   
                    $i++;
                    if($i == 2) {
                        //end box row and start new
                        echo("</tr>");
                        echo("<tr>");
                        $i=0;
                    }
                }
                echo("</table>");
            }

<<<<<<< HEAD
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
=======
>>>>>>> rachel
        ?>

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

