<!--
advisors and students can filter appointments by date, time, advisor, availability. Otherwise, display in month/day/year hour:minute order
            
students can sign up for available appointments, which signs them out of their current appointment

advisors can edit appointment information
-->

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
                <form action="../AdvisorManager/advisorHome.php" method="post"><button type="submit" class="BackButton"><span>back</span></button></form>
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
                    <input name="endDay" class="DateTime" type="number" min="1" max="31" <?php sticky("endDay", 31) ?> >
                    <input name="endYear" class="DateTime" type="number" <?php sticky("startYear", date("Y")) ?> >
                </div>

                <div id="dateDescriptor">
                    <a class="DateDescriptor Hour" id="endingDescriptor">hour:</a>
                    <a class="DateDescriptor Minute" id="endingDescriptor">minute:</a>
                </div>
                    <a class="Descriptor">when does the meeting start?</a>
                    <div class="timeSelector" id="ending">
                    <input type="number" class="DateTime" name="startHour" min="1" max="12" <?php sticky("startHour", "8") ?> > :
                    <input type="number" class="DateTime" name="startMin" min="0" max="59" <?php sticky("startMin", "00") ?> >
                    <select name="startAmPm" class="DateTime">
                        <option value="AM" <?php stickySelect("startAmPm", "AM", "AM") ?> >AM</option>
                        <option value="PM" <?php stickySelect("startAmPm", "PM", "AM") ?> >PM</option>
                    </select>
                </div>

                <div id="dateDescriptor">
                    <a class="DateDescriptor Hour" id="endingDescriptor">hour:</a>
                    <a class="DateDescriptor Minute" id="endingDescriptor">minute:</a>
                </div>
                <a class="Descriptor">and when does it end?</a>
                <div class="timeSelector" id="ending">
                    <input type="number" class="DateTime" name="endHour" min="1" max="12" <?php sticky("endHour", "9") ?> > :
                    <input type="number" class="DateTime" name="endMin" min="0" max="59" <?php sticky("endMin", "00") ?> >
                    <select name="endAmPm" class="DateTime">
                        <option value="AM" <?php stickySelect("endAmPm", "AM", "PM") ?> >AM</option>
                        <option value="PM" <?php stickySelect("endAmPm", "PM", "PM") ?> >PM</option>
                    </select>
                </div>

                <a class="Descriptor">who do you want to meet with?</a>
                <label><input type="checkbox" name="sessionLeader[]" value="mbulger" checked>Ms. Michelle Bulger</label>
                <label><input type="checkbox" name="sessionLeader[]" value="JulieCrosby" checked>Mrs. Julie Crosby</label>
                <label><input type="checkbox" name="sessionLeader[]" value="ChristinePowers" checked>Ms. Christine Powers</label>
                <label><input type="checkbox" name="sessionLeader[]" value="CNMS Advisors" checked>CNMS advisors</label>
                <button type="submit" class="Submit" name="submit"><span>Search appointments</span></button>
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
                $filters["startDate"] = date("Y-m-d", strtotime($_POST['startYear']."-".$_POST['startMonth']."-".$_POST['startDay']));
                $filters["endDate"] = date("Y-m-d", strtotime($_POST['endYear']."-".$_POST['endMonth']."-".$_POST['endDay']));
                $advisors = $filters['sessionLeader'];
                $filters['startTime'] = date("H:i", strtotime($_POST['startHour'].":".$_POST['startMin']." ".$_POST['startAmPm']));
                $filters['endTime'] = date("H:i", strtotime($_POST['endHour'].":".$_POST['endMin']." ".$_POST['endAmPm']));

                // validate
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
                    if ($filters['endDate']) {
                        $sql .= " AND `date` BETWEEN '$filters[startDate]' and '$filters[endDate]'";
                    }
                    $sql .= " AND `date` >= '$filters[startDate]'";
                }
                if ($filters['endDate']) {
                    $sql .= " AND `date` <= '$filters[endDate]'";
                }
                if ($filters['startTime']) {
                    $sql .= " AND `start_time` >= '$filters[startTime]'";
                }
                if ($filters['endTime']) {
                    $sql .= " AND `end_time` <= '$filters[endTime]'";
                }
                if ($advisors) {
                    
                    $sql .= " AND `advisor_ID` IN ('".implode("', '", $advisors)."')";
                }
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

        ?>
