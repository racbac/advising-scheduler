<!--
advisors and students can filter appointments by date, time, advisor, availability. Otherwise, display in month/day/year hour:minute order
            
students can sign up for available appointments, which signs them out of their current appointment

advisors can edit appointment information
-->
<?php session_start(); include('../Utilities/phpFuns.php'); ?>

<html>
    <head>
        <title>Appointments - UMBC CMNS Advising</title>
        <link rel="icon" type="image/png" href="http://sites.umbc.edu/wp-content/themes/umbc/assets/images/icon.png">

        <style>
            ul {
                list-style: none;
                list-style-type: none;

                position: relative;
                margin: 0;
                padding: 0;
            }
            
            li {
                position: relative;
                display: inline-block;
            }
        </style>

  </head>

    <body>
        <h1>Appointments</h1>

        <h2>Filter by: </h2>
        <form action="allAppointments.php" method="POST">
            
            <ul>
                <li> Start Date: 
                    <select name="startMonth">
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
                    <input name="startDay" type="number" min="1" max="31" <?php sticky("startDay", 1) ?> >
                    <input name="startYear" type="number" <?php sticky("startYear", date("Y")) ?> >
                </li>
                <li> End Date: 
                    <select name="endMonth" >
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
                        <button type="submit" class="Submit" name="submit" ><span>Search appointments</span></button>
                </li>
            </ul>
            <button type="submit" class="Submit" name="drop" ><span>Drop appointment</span></button>
        </form>

        <?php
            
            if (isset($_POST['submit'])) {
                include('../CommonMethods.php');
                $COMMON = new Common(false);            

                // get set filters in array
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
                    echo("End date must precede start date. ");
                }
                if ($filters['endTime'] < $filters['startTime'] and $filters['endTime'] and $filters['startTime']) {
                    $errors++;
                    echo("End time must precede start time. ");
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
                echo("<tr>");
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
                    echo("<div class=\"Name\">".$row1['firstName']." ".$row1['lastName']."</div>");
                    echo("<a id=\"appointmentDate\">".$row['date']."</a> ");
                    echo("<a id=\"appointmentTime\">".$row['start_time']."</a> ");
                    
                    // Print out meeting type
                    if($row['max_students']==1)
                    {
                        echo("<div><a class=\"SolidDescriptor\">Individual</a></div>");
                    } else {
                        echo("<div><a class=\"SolidDescriptor\">Group</a></div>");
                    }
                            
                    echo("<div class=\"SpacesAvailable\"><a id=\"signedUp\">".$spaces." <a class=\"SolidDescriptor\">space");
                    if ($spaces != 1) {
                        echo("s");
                    }
                    echo(" available</a></div>");
                    if($_SESSION['userRole'] == "advisor" )
                        {
                        // Print out button to edit appointment
                        echo("<form action='editAppointment.php' method='POST'>");
                        echo("<button type='submit' name='submit' value='$id'>Edit Appointment</button></form>");

                        // Print out button to print appointment info
                        echo("<form action='downloadMeeting.php' method='POST'>");
                        echo("<input type='checkbox' name='extra'>Extra Info");
                        echo("<button type='submit' name='submit' value='$id'>Download Appointment Info</button></form>");
                        }
                    else
                    {
                        // Print out button to sign up
                        echo("<form action='joinAppointment.php' method='POST'>");
                        echo("<button type='submit' name='submit' value='$id'>Sign Up</button></form>");
                    }
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
            } else if (isset($_POST['drop'])) {
                dropAppt($_SESSION['username']);
            }

        ?>

    </body>
</html>