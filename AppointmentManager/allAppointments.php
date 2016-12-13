<!--
advisors and students can filter appointments by date, time, advisor, availability. Otherwise, display in month/day/year hour:minute order
            
students can sign up for available appointments, which signs them out of their current appointment

advisors can edit appointment information
-->

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
            #toggle {
                display: none;
            }
            #toggle ~ select {
                position: absolute;
                display: none !important;
                z-index: 10;
            }
            #toggle:checked ~ select {
                display: block !important;
            }
        </style>

  </head>

    <body>
        <h1>Appointments</h1>

        <h2>Filter by: </h2>
        <form action="allAppointments.php" method="POST">
            
            <ul>
                <li> Start Date: 
                    <input type="date" name="startDate" min=<?php echo(date('Y-m-d')); sticky("startDate", date('Y-m-d')); ?> />
                </li>
                <li> End Date: 
                    <input type="date" name="endDate" <?php sticky("endDate", date('Y-m-d', strtotime("+1 months"))); ?> />
                </li>
                <li> Start Time:
                    <input type="time" name="startTime" <?php sticky("startTime", "09:00") ?> />
                </li>
                <li> End Time:
                    <input type="time" name="endTime" <?php sticky("endTime", "21:00"); ?> />
                </li>
                <li> 
                    Advisors:
                    <label><input type="checkbox" name="sessionLeader[]" value="CNMS Advisors" checked>CNMS advisors</label>
                    <label><input type="checkbox" name="sessionLeader[]" value="mbulger" checked>Ms. Michelle Bulger</label>
                    <label><input type="checkbox" name="sessionLeader[]" value="JulieCrosby" checked>Mrs. Julie Crosby</label>
                    <label><input type="checkbox" name="sessionLeader[]" value="ChristinePowers" checked>Ms. Christine Powers</label>
                </li>
                <li> 
                        <button type="submit" class="Submit" name="submit" ><span>Search appointments</span></button>
                </li>
            </ul>
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
                $advisors = $filters['sessionLeader'];

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
        ?>

    </body>
</html>