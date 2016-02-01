<?php
    class MyDB extends SQLite3{

        function __construct($db_url){
            $this -> open($db_url);
        }

        function execSQL($query){
            $ret = $this->exec($sql);
            if(!$ret){
                echo->lastErrorMsg();
                return false;
            }else{
                return $ret;
            }
        }

        function addFeedback($email, $feedback){
            $sql = "INSERT INTO feedback (email, feedback) VALUES ('" .$email . "', '" . $feedback "');";
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
            while($row = $ret->fetchArray(SQLite3_ASSOC)){
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
        }

        // Returns the first name, last name, spoken language and event_id for the attendee in given order
        function getAttendeeInfo($attendee_id){
            $sql = "SELECT first_name, last_name, language, event_id FROM attendees WHERE id = " . $attendee_id . ";";
            $results = execSQL($sql);
            if(!$results){
                return false;
            }else{
                return $results->fetchArray(SQLite3_ASSOC);
            }
        }

        //Returns title, dates (Start then end), location id and info text link for html build in given order
        function getEventInfo($event_id){
            $sql = "SELECT title, start_date, end_date, location, info_text FROM events WHERE id = " . $event_id . ";";
            $results = execSQL($sql);
            if(!$results){
                return false;
            }else{
                return $results->fetchArray(SQLite3_ASSOC);
            } 
        }

        //Returns address line 1, address line 2, town, county and region/province in given order
        function getLocationInfo($location_id){
            $sql = "SELECT addr_1, addr_2, town, county, region FROM locations WHERE id = " . $location_id . ";";
            $results = execSQL($sql);
            if(!$results){
                return false;
            }else{
                return $results->fetchArray(SQLite3_ASSOC);
            }
        }


        function getEventTitle($event_id){
            $sql = "SELECT title FROM events WHERE id = " . $event_id ";";
            $results = execSQL($sql);
            $if(!$results){
                return false;
            }else{
                $row = $results->fetchArray(SQLite3_ASSOC);
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
            while($row = $ret->fetchArray(SQLite3_ASSOC)){
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
                $row = $ret.fetchArray(SQLite3_ASSOC){
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
    }

    $db = new MyDB();
    if(!$db){
        echo $db -> lastErrorMsg();
    }else{
        echo "Opened database succesfully";
    }  
?>  