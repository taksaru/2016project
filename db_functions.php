<?php
    class MyDB extends SQLite3{

        function __construct($db_url){
            $this -> open($db_url);
        }

        function execSQL($sql){
            $ret = $this->query($sql);
            if(!$ret){
                echo lastErrorMsg();
                return false;
            }else{
                return $ret;
            }
        }

        function getDate($year, $month, $day){
            $sql1 = "SELECT id FROM dates WHERE year = " . $year . " AND month = " . $month . " AND day = " . $day . ";";
            $sql2 = "SELECT COUNT(*) AS xyz FROM dates WHERE year = " . $year . " AND month = " . $month . " AND day = " . $day . ";";
            
            $ret1 = $this->execSQL($sql1);
            $ret2 = $this->querySingle($sql2);

            if($ret2 == 0){
                $sql = "INSERT INTO dates (year, month, day) VALUES (" . $year . ", " . $month . ", " . $day . ");";
                $this->execSQL($sql);
                return getDate($year, $month, $day);
            }else{
                $row = $ret1->fetchArray(SQLITE3_ASSOC);
                return $row['id'];
            }
            
        }

        function addFeedback($email, $feedback){
            $sql = "INSERT INTO feedback (email, feedback) VALUES ('" .$email . "', '" . $feedback . "');";
            execSQL($sql);
        }

        function displayFeedback(){
            $sql = 'SELECT * FROM feedback';
            $ret = execSQL($sql);
            if(!$ret){
                return false;
            }else{
            echo '<table>
                    <tr>
                        <th>Email Address</th>
                        <th>Feedback</th>
                    </tr>';
            while($row = $ret->fetchArray(SQLITE3_ASSOC)){
                echo "<tr>
                        <td>" . $row['email'] . "</td>
                        <td>" . $row['feedback'] ."</td>
                    </tr>";
            }
            echo '</table>';
            }
        }

        function addAttendee($first_name, $last_name, $email, $phone_number, $language, $event){
            $sql = "INSERT INTO attendees (first_name, last_name, email, phone_number, language, event_id)
                    VALUES ('" . $first_name . "', '" . $last_name . "', '" . $email . ", " . $phone_number . 
                        "', '" . $language . "', " . $event . ");";
            execSQL($sql);
            $sql = "UPDATE events SET attendee_count = attendee_count + 1 WHERE id = " . $event . ";";
            execSQL($sql);
        }

        // Returns the first name, last name, spoken language and event_id for the attendee in given order
        function getAttendeeInfo($attendee_id){
            $sql = "SELECT first_name, last_name, language, event_id FROM attendees WHERE id = " . $attendee_id . ";";
            $results = execSQL($sql);
            if(!$results){
                return false;
            }else{
                return $results->fetchArray(SQLITE3_ASSOC);
            }
        }

        //Returns title, dates (Start then end), location id and info text link for html build in given order
        function getEventInfo($event_id){
            $sql = "SELECT title, start_date, end_date, location, info_text FROM events WHERE id = " . $event_id . ";";
            $results = execSQL($sql);
            if(!$results){
                return false;
            }else{
                return $results->fetchArray(SQLITE3_ASSOC);
            } 
        }

        //Returns address line 1, address line 2, town, county and region/province in given order
        function getLocationInfo($location_id){
            $sql = "SELECT addr_1, addr_2, town, county, region FROM locations WHERE id = " . $location_id . ";";
            $results = execSQL($sql);
            if(!$results){
                return false;
            }else{
                return $results->fetchArray(SQLITE3_ASSOC);
            }
        }

        function printReceipt($attendee_id){
            $sql = "SELECT * FROM attendees WHERE id = " . $attendee_id . ";";
            $ret = execSQL($sql);

            if(!$ret){
                return false;
            }else{
                $row = $ret.fetchArray(SQLite3_ASSOC);
                echo '<p>Your ID Number is: ' . $row['id'] . '.</p>';
                echo '<p>Thank You ' . $row['first_name'] . ' ' . $row['last_name'] . ' for registering for the ' . getEventTitle($row['event_id']) . '.</p>';
                echo '<p>Your event ID number is displayed above. Please use this number and email as proof of registration.</p>';
                echo '<p>See you at ' . getEventTitle($row['event_id']) . '.</p>';
                echo '<p><a href="tbd">What\'s the best way of getting there?</a></p>';
                echo '<p><a href="tbd">Where can I stay?</a></p>';
                
            }
        }

        function displayEventSearchResults($results){
            echo '<table>
                <tr>
                    <th>Title</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Link</th>';
            while($row = $results->fetchArray(SQLite3_ASSOC)){
                echo '<tr>
                        <td>' . $row['title'] . '</td>
                        <td>' . dateToString($row['start_date']) . '</td>
                        <td>' . dateToString($row['end_date']) . '</td>
                        <td><a href="display_event?event_id=' . $row['id'] .'">Click Here</a></td>
                    </tr>';
            }
            echo '</table>'
        }

        //Outputs Date in DD/MM/YYYY format
        function dateToString($date_id){
            $sql = "SELECT day, month, year FROM dates WHERE id = " . $date_id . ";";
            $ret = execSQL($sql);
            $out = $ret['day'] . '/' . $ret['month'] . '/' . $ret['year'];
            return $out;
        }

        function searchEvents($title){
            $sql = "SELECT title, start_date, end_date, id FROM events WHERE title LIKE '%" . $title . "%';";
            $ret = execSQL($sql);
            if(!$ret){
                return false;
            }else{
                return $ret;
            }
        }

        function searchEvents($start_year, $start_month, $start_day, $end_year, $end_month, $end_day){
            $sql = "SELECT title, start_date, end_date, id FROM events WHERE start_date IN (
                SELECT id FROM dates 
                WHERE year < " . $start_year . 
                " AND month < " . $start_month . 
                " AND day < " . $start_day . ") AND end_date IN ( 
                SELECT id FROM dates 
                WHERE year < " . $start_year . 
                " AND month < " . $start_month . 
                " AND day < " . $start_day . ");";
            $ret = execSQL($sql);
            if(!$ret){
                return false;
            }else{
                return $ret;
            }
        }

        function searchEvents($title, $start_year, $start_month, $start_day, $end_year, $end_month, $end_day){
            $sql = "SELECT title, start_date, end_date, id FROM events WHERE start_date IN (
                SELECT id FROM dates 
                WHERE year < " . $start_year . 
                " AND month < " . $start_month . 
                " AND day < " . $start_day . ") AND end_date IN ( 
                SELECT id FROM dates 
                WHERE year < " . $start_year . 
                " AND month < " . $start_month . 
                " AND day < " . $start_day . ") AND tile LIKE '%" . $title "%';";
            $ret = execSQL($sql);
            if(!$ret){
                return false;
            }else{
                return $ret;
            }
        }

        function getEventTitle($event_id){
            $sql = "SELECT title FROM events WHERE id = " . $event_id . ";";
            $results = execSQL($sql);
            if(!$results){
                return false;
            }else{
                $row = $results->fetchArray(SQLITE3_ASSOC);
                return $row['title'];
            }
        }

        //Displays all previous events by date within a table (further sorting should be implented by javascript)
        function displayPreviousEvents(){
            $sql = 'SELECT id, title, date, event_id, type FROM events';
            $ret = execSQL($sql);
            if(!$ret){
                return false;
            }else{
            echo '<table>
                    <tr>
                        <th>Title</th>
                        <th>Date</th>
                        <th>Event</th>
                        <th>Type</th>
                        <th>Link</th>
                    </tr>';
            while($row = $ret->fetchArray(SQLITE3_ASSOC)){
                echo '<tr>
                        <td>' . $row['title'] . '</td>
                        <td>' . $row['date'] . '</td>
                        <td>' . getEventTitle($row['event']) . '</td>
                        <td>' . $row['type'] . '</td>
                        <td><a href="event_display.php?id=' . $row['id'] . '">Click Here</a></td> 
                    </tr>';
            }
            echo '</table>';
            }
        }

        function displayEvent($id){
            $sql = "SELECT type, link FROM events WHERE if = " . $id . ";";
            $ret = execSQL($sql);

            if(!$ret){
                return false;
            }else{
                $row = $ret->fetchArray(SQLITE3_ASSOC);
                    switch($row['type']){
                        case "audio":
                            echo '<audio controls>
                                <source src"' . $row['link'] . '" type="audio.mpeg">
                                </audio>';
                            break;

                        case "video":
                            echo '<iframe width="420" height="315" src="' . $row['link'] . '"></iframe>';
                            break;
                    }
                }
            }
        }

        function getAttendeeId($email, $event_id){
            $sql = "SELECT id FROM attendees WHERE email='" . $email . "' AND event_id = '" . $event_id . ";";
            $ret = execSQL($sql);

            if(!$ret){
                return false;
            }else{
                $row = $ret.fetchArray(SQLITE3_ASSOC);
                return $row['id'];
            }
        }
    }
    /*
    $db = new MyDB('2016.db');
    if(!$db){
        echo $db -> lastErrorMsg();
    }else{
        echo "Opened database succesfully";
    }
    */
?>  