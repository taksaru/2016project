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

        //Deletes attendee table entry based on ID
        function deleteAttendee($id){
            $sql = "DELETE FROM attendees WHERE id = " . $id . ";";
            execSQL($sql);
        }

        //Deletes Event table entry based on ID
        function deleteEvent($id){
            $sql = "DELETE FROM events WHERE id = " . $id . ";";
            execSQL($sql);
            //Possibly Delete txt file (look later)
        }

        //Deletes accomodation table entry based on ID
        function deleteAccomodation($id){
            $sql = "DELETE FROM accomodation WHERE id = " . $id . ";";
            execSQL($sql);
        }

        //Deletes Location table entry based on ID
        function deleteLocation($id){
            $sql = "DELETE FROM locations WHERE id = " . $id . ";";
            execSQL($sql);
        }

        //Deletes accomodation table entry based on ID
        function deleteTravel($id){
            $sql = "DELETE FROM travel WHERE id = " . $id . ";";
            execSQL($sql);
        }

        //Deletes recordings table entry based on ID
        function deleteRecording($id){
            $sql = "DELETE FROM recordings WHERE id = " . $id . ";";
            execSQL($sql);
            //Look into file deletion later
        }

        //Deletes feedback table entry based on ID
        function deleteFeedback($id){
            $sql = "DELETE FROM feedback WHERE id = " . $id . ";";
            execSQL($sql);
        }

        //Deletes feedback table entry based on ID
        function deleteDate($id){
            $sql = "DELETE FROM dates WHERE id = " . $id . ";";
            execSQL($sql);
        }

        //Adds new Accomodation Entry
        function addAccomodation($name, $location, $stars, $link, $cost){
            $sql = "INSERT INTO accomodation (name, location, stars, link, cost) VALUES ('" . $name .
                "', '" . $location . "', " . $stars . ", '" . $link . "', " . $cost . ");";
            execSQL($sql);
        }

        //Adds new Location Entry
        function addLocation($region, $addr_1, $addr_2, $town, $county){
            $sql = "INSERT INTO locations (region, addr_1, addr_2, town, county) VALUES ('" . $region .
                "', '" . $addr_1 . "', '" . $addr_2 . "', '" . $town . "', '" . $county . "');";
            execSQL($sql);
        }

        //Adds new Recordings Entry
        function addRecording($title, $date, $event_id, $type, $link){
            $sql = "INSERT INTO recordings (title, date, event_id, type, link) VALUES ('" . $title .
                "', " . $date . ", " . $event_id . ", '" . $type . "', '" . $link . "');";
            execSQL($sql);
        }

        //Adds new Travel Entry
        function addTravel($travel_type, $location, $link, $cost, $contact){
            $sql = "INSERT INTO travel (travel_type, location, link, cost, contact) VALUES ('" . $travel_type .
                "', " . $location . ", '" . $link . "', " . $cost . ", '" . $contact . "');";
            execSQL($sql);
        }

        //Adds new Event Entry
        function addEvent($title, $start_date, $end_date, $location, $info_link){
            $sql = "INSERT INTO events (title, start_date, end_date, location, info_text) VALUES ('" . $title .
                "', " . $start_date . ", " . $end_date . ", " . $location . ", '" . $info_link . "');";
            execSQL($sql);
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