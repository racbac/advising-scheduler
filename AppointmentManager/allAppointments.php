<!--
advisors and students can filter appointments by date, time, advisor, availability. Otherwise, display in month/day/year hour:minute order
            
students can sign up for available appointments, which signs them out of their current appointment

advisors can edit appointment information
-->
   <?php ob_start(); session_start(); if(!$_SESSION['userToken']) { header('Location: ../LoginPage/login.php'); } include('../Utilities/phpFuns.php'); include('../CommonMethods.php'); $COMMON = new Common(false); ?>

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
                <form action=<?php if($_SESSION['userRole'] == "advisor" ) echo('../AdvisorManager/advisorHome.php'); else echo('../StudentManager/studentHome.php'); ?> method="post"><button type="submit" class="BackButton"><span>back</span></button></form>
            </div>
            
            <form action="allAppointments.php" method="post" class="Main-Form">
            
            <?php
            if (isset($_POST['switchAppt'])) { // switch appointment
                dropAppt($_SESSION['username'], $COMMON);
                joinAppt($_SESSION['username'], $_POST['switchAppt']);
                echo("<div class='SuccessDiv'>
                    <div class='InnerSuccessDiv'>
                        <a class='SuccessBackground'>success</a>
                        <a class='Success'>Appointment joined. Refreshing...</a>
                    </div>
                    </div>");
                    header("Refresh:3 url=./allAppointments.php");
            }


            else if (isset($_POST['join'])) { // join appointment
                $success = joinAppt($_SESSION['username'], $_POST['join']);
                if ($success) { // successfully joined
                    echo("<div class='SuccessDiv'>
                        <div class='InnerSuccessDiv'>
                            <a class='SuccessBackground'>success</a>
                            <a class='Success'>Appointment joined. Refreshing...</a>
                        </div>
                        </div>");
                        header("Refresh:3 url=./allAppointments.php");
                } else { // already has appointment
                    echo("<a class='Descriptor'> Are you sure you want to switch appointments?</a>");
                    echo("<div><button type='submit' name='switchAppt' class='submit' value='".$_POST['join']."' >Yes, switch appointments</button></div>");        
                }
            }
            ?>
                <a class="Descriptor">I want to find an appointment starting between...</a>
                <div id="dateDescriptor">
                    <a class="DateDescriptor Month">month:</a>
                    <a class="DateDescriptor Day">day:</a>
                    <a class="DateDescriptor Year">year:</a>
                </div>
                <div class="dateSelector">
                    <select name="startMonth" class="DateTime">
                        <option value="1" required <?php stickySelect("startMonth", 1, date("m")) ?> >January</option>
                        <option value="2" required <?php stickySelect("startMonth", 2, date("m")) ?> >February</option>
                        <option value="3" required <?php stickySelect("startMonth", 3, date("m")) ?> >March</option>
                        <option value="4" required <?php stickySelect("startMonth", 4, date("m")) ?> >April</option>
                        <option value="5" required <?php stickySelect("startMonth", 5, date("m")) ?> >May</option>
                        <option value="6" required <?php stickySelect("startMonth", 6, date("m")) ?> >June</option>
                        <option value="7" required <?php stickySelect("startMonth", 7, date("m")) ?> >July</option>
                        <option value="8" required <?php stickySelect("startMonth", 8, date("m")) ?> >August</option>
                        <option value="9" required <?php stickySelect("startMonth", 9, date("m")) ?> >September</option>
                        <option value="10" required <?php stickySelect("startMonth", 10, date("m")) ?> >October</option>
                        <option value="11" required <?php stickySelect("startMonth", 11, date("m")) ?> >November</option>
                        <option value="12" required <?php stickySelect("startMonth", 12, date("m")) ?> >December</option>
                    </select>
                <input name="startDay" required class="DateTime" type="number" min="1" max="31" <?php sticky("startDay", 1) ?> >
                <input name="startYear" required class="DateTime" type="number" <?php sticky("startYear", date("Y")) ?> >
                </div>

                <a class="Descriptor">...and</a>
                <div id="dateDescriptor">
                    <a class="DateDescriptor Month">month:</a>
                    <a class="DateDescriptor Day">day:</a>
                    <a class="DateDescriptor Year">year:</a>
                </div>
                <div class="dateSelector">
                    <select name="endMonth" class="DateTime">
                        <option value="1" required <?php stickySelect("endMonth", 1, date("m")) ?> >January</option>
                        <option value="2" required <?php stickySelect("endMonth", 2, date("m")) ?> >February</option>
                        <option value="3" required <?php stickySelect("endMonth", 3, date("m")) ?> >March</option>
                        <option value="4" required <?php stickySelect("endMonth", 4, date("m")) ?> >April</option>
                        <option value="5" required <?php stickySelect("endMonth", 5, date("m")) ?> >May</option>
                        <option value="6" required <?php stickySelect("endMonth", 6, date("m")) ?> >June</option>
                        <option value="7" required <?php stickySelect("endMonth", 7, date("m")) ?> >July</option>
                        <option value="8" required <?php stickySelect("endMonth", 8, date("m")) ?> >August</option>
                        <option value="9" required <?php stickySelect("endMonth", 9, date("m")) ?> >September</option>
                        <option value="10" required <?php stickySelect("endMonth", 10, date("m")) ?> >October</option>
                        <option value="11" required <?php stickySelect("endMonth", 11, date("m")) ?> >November</option>
                        <option value="12" required <?php stickySelect("endMonth", 12, date("m")) ?> >December</option>
                    </select>
                    <input name="endDay" required class="DateTime" type="number" min="1" max="31" <?php sticky("endDay", 31) ?> >
                    <input name="endYear" required class="DateTime" type="number" <?php sticky("endYear", date("Y")) ?> >
                </div>

                <div id="dateDescriptor">
                    <a class="DateDescriptor Hour" id="endingDescriptor">hour:</a>
                    <a class="DateDescriptor Minute" id="endingDescriptor">minute:</a>
                </div>
                    <a class="Descriptor">I want the appointment to start on or after...</a>
                <div class="timeSelector" id="ending">
                    <input name="startHour" required class="DateTime" id="picker" pattern="(1[012]|0?[1-9])" <?php sticky("startHour", "08") ?> > :
                    <input name="startMin" required class="DateTime" id="picker" pattern="[0-5][0-9]" <?php sticky("startMin", "00") ?> >
                    <select name="startAmPm" required class="DateTime" id="picker" >n>
                        <option value="AM" <?php stickySelect("startAmPm", "AM", "AM") ?> >AM</option>
                        <option value="PM" <?php stickySelect("startAmPm", "PM", "AM") ?> >PM</option>
                    </select>
                </div>

                <div id="dateDescriptor">
                    <a class="DateDescriptor Hour" id="endingDescriptor">hour:</a>
                    <a class="DateDescriptor Minute" id="endingDescriptor">minute:</a>
                </div>
                <a class="Descriptor">...and end before</a>
                <div class="timeSelector" id="ending">
                    <input name="endHour" required class="DateTime" id="picker" pattern="(1[012]|0?[1-9])" <?php sticky("endHour", "09") ?> > :
                    <input name="endMin" required class="DateTime" id="picker" pattern="[0-5][0-9]" <?php sticky("endMin", "00") ?> >
                    <select name="endAmPm" required class="DateTime" id="picker" >
                        <option value="AM" <?php stickySelect("endAmPm", "AM", "PM"); ?> >AM</option>
                        <option value="PM" <?php stickySelect("endAmPm", "PM", "PM"); ?> >PM</option>
                    </select>
                </div>
                <a class="Descriptor">who do you want to meet with?</a>
                <table class="AdvisorTable">
                    <tr>
            <td><label class="CheckboxDescriptor"><input type="checkbox" name="sessionLeader[]" value="mbulger" <?php stickyCheck("sessionLeader", "mbulger", array("mbulger","julie11","cpowers1","cnms")); ?> >Ms. Michelle Bulger</label></td>
                        <td><label class="CheckboxDescriptor"><input type="checkbox" name="sessionLeader[]" value="julie11" <?php stickyCheck("sessionLeader", "julie11", array("mbulger","julie11","cpowers1","cnms")); ?>>Mrs. Julie Crosby</label></td>
                    </tr>
                    <tr>    
                        <td><label class="CheckboxDescriptor"><input type="checkbox" name="sessionLeader[]" value="cpowers1" <?php stickyCheck("sessionLeader", "cpowers1", array("mbulger","julie11","cpowers1","cnms")); ?>>Ms. Christine Powers</label></td>
                        <td><label class="CheckboxDescriptor"><input type="checkbox" name="sessionLeader[]" value="cnms" <?php stickyCheck("sessionLeader", "cnms", array("mbulger","julie11","cpowers1","cnms")); ?>>CNMS advisors</label></td>
                    </tr>
                </table>
                <button type="submit" id="SearchAppt" class="submit" name="search"><span>search appointments</span></button>
                <button type="submit" id="SearchAppt" class="submit" name="all"><span>view all</span></button>
            </form>


            <?php
            $sql = "SELECT * FROM `appointments` WHERE 1";
            if (isset($_POST['search']) or isset($_POST['all'])) {
                
                if (isset($_POST['all'])) { // view all appointments
                    if($_SESSION['userRole'] == "student"){
                        $sql .= " AND `status` = 0 AND `curr_students` < `max_students`";
                    }
                }
                if (isset($_POST['search'])) { // search appointments
                    // get filters in array
                    $filters = array();
                    foreach ($_POST as $key => $field) {
                        if (isset($field)) {
                            $filters[$key] = $field;
                        }
                    }

                    $filters["startDate"] = date("Y-m-d", strtotime($_POST['startYear']."-".$_POST['startMonth']."-".$_POST['startDay']));
                    $filters["endDate"] = date("Y-m-d", strtotime($_POST['endYear']."-".$_POST['endMonth']."-".$_POST['endDay']));
                    $filters['startTime'] = date("H:i", strtotime($_POST['startHour'].":".$_POST['startMin']." ".$_POST['startAmPm']));
                    $filters['endTime'] = date("H:i", strtotime($_POST['endHour'].":".$_POST['endMin']." ".$_POST['endAmPm']));

                    // validate filters
                    $errors = 0;
                    if ( $filters['endDate'] < $filters['startDate'] and $filters['endDate'] and $filters['startDate']) {
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
                    if($_SESSION['userRole'] == "student"){
                        $sql .= " AND `status` = 0  AND `curr_students` < `max_students`";
                    } 
                    if (isset($filters['startDate'])) {
                        if (isset($filters['endDate']) )
                        { $sql .= " AND `date` BETWEEN '$filters[startDate]' and '$filters[endDate]'"; }
                    { $sql .= " AND `date` >= '$filters[startDate]'"; }
                    }
                    if (isset($filters['endDate']) )
                        {$sql .= " AND `date` <= '$filters[endDate]'";}
                    if (isset($filters['startTime']) )
                        {$sql .= " AND `start_time` >= '$filters[startTime]'";}
                    if (isset($filters['endTime']) )
                        {$sql .= " AND `end_time` <= '$filters[endTime]'";}
                    if (isset($filters['sessionLeader']))
                        { $sql .= " AND `advisor_ID` IN ('".implode("', '", $filters['sessionLeader'])."')"; }

                     
                }
                // print appointments
                $sql .= " ORDER BY `date`, `start_time` ASC";
                $rs = $COMMON->executeQuery($sql, $_SERVER['SCRIPT_NAME']);
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
                        echo("<form action='../AdvisorManager/editAppointment.php' method='POST'>");
                        echo("<button type='submit' name='id' class='edit' value='$id'><span>edit appointment</span></button></form>");

                        // Print out button to print appointment info
                        echo("<form action='downloadMeeting.php' method='POST'>");
                        echo("<label class='CheckboxDescriptor'><input type='checkbox' name='extra'>extra info</label>");
                        echo("<button type='submit' name='id' value='$id' class='edit'><span>download appointment info</span></button></form>");
                        }
                    else
                    {
                        // Print out button to sign up
                        echo("<form action='allAppointments.php' method='POST'>");
                        echo("<button class='signup' type='submit' name='join' value='$id'><span id='signUp'>sign up</span></button></form>");

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