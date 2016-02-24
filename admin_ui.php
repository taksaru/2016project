<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <?php
            require 'db_functions.php';

            $db = new MyDB('2016.db');
            if($_POST){
                $action = $_POST['action'];
                if(!$action){

                }else{
                    $sql;
                    switch($action){
                        case "delete_accomodation":
                            $id = $_POST['id'];
                            $db->deleteAccomodation($id);
                            break;
                        case "new_accomdation":
                            $name = $_POST['accomodation_name'];
                            $location = $_POST['accomodation_location'];
                            $stars = $_POST['accomodation_stars'];
                            $link = $_POST['accomodation_link'];
                            $cost = $_POST['accomodation_cost'];
                            $db->addAccomodation($name, $location, $stars, $link, $cost);
                            break;
                        case "delete_attendee":
                            $id = $_POST['id'];
                            $db->deleteAttendee($id);
                            break;
                        case "delete_date":
                            $id = $_POST['id'];
                            $db->deleteDate($id);
                            break;
                        case "new_date":
                            $year = $_POST['year'];
                            $month = $_POST['month'];
                            $day = $_POST['day'];
                            $db->getDate($year, $month, $day);
                            break;
                        case "delete_event":
                            $id = $_POST['id'];
                            $db->deleteEvent($id);
                            break;
                        case "new_event":
                            $title = $_POST['event_title'];
                            $start_date = $_POST['event_start'];
                            $end_date = $_POST['event_end'];
                            $location = $_POST['event_location'];
                            $info_text = $_POST['event_info_text'];
                            $db->addEvent($title, $start_date, $end_date, $location, $info_text);
                            break;
                        case "delete_location":
                            $id = $_POST['id'];
                            $db->deleteLocation($id);
                            break;
                        case "new_location":
                            $region = $_POST['region'];
                            $addr_1 = $_POST['addr_1'];
                            $addr_2 = $_POST['addr_2'];
                            $town = $_POST['town'];
                            $county = $_POST['county'];
                            $db->addLocation($region, $addr_1, $addr_2, $town, $county);
                            break;
                        case "delete_travel":
                            $id = $_POST['id'];
                            $db->deleteTravel($id);
                        case "new_travel":
                            $travel_type = $_POST['travel_type'];
                            $location = $_POST['travel_location'];
                            $link = $_POST['travel_link'];
                            $cost = $_POST['travel_cost'];
                            $contact = $_POST['travel_contact'];
                            $db->addTravel($travel_type, $location, $link, $cost, $contact);
                            break;
                        case "delete_recording":
                            $id = $_POST['id'];
                            $db->deleteRecording($id);
                            break;
                        case "new_recording":
                            $title = $_POST['recording_title'];
                            $date = $_POST['recording_date'];
                            $event_id = $_POST['recording_event'];
                            $type = $_POST['recording_type'];
                            $link = $_POST['recording_link'];
                            $db->addRecording($title, $date, $type, $link);
                            break;
                        case "delete_feedback":
                            $id = $_POST['id'];
                            $db->deleteFeedback($id);
                            break;
                    }
                }
            }
        ?>
        <h1>Databases</h1>
        <h2>Accomodation</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Location ID</th>
                <th>Stars</th>
                <th>Link</th>
                <th>Cost</th>
                <th>Delete?</th>
            </tr>
            <?php
                $sql = "SELECT * FROM accomodation;";
                $ret = $db->execSQL($sql);
                while($row = $ret->fetchArray(SQLITE3_ASSOC)){
                    echo '<tr>
                            <td>' . $row['id'] . '</td>
                            <td>' . $row['name'] . '</td>
                            <td>' . $row['location'] . '</td>
                            <td>' . $row['stars'] . '</td>
                            <td>' . $row['link'] . '</td>
                            <td>' . $row['cost'] . '</td>
                            <td>
                                <form action="' . $_SERVER['PHP_SELF'] . '" method="post">
                                    <input type="hidden" name="action" value="delete_accomodation">
                                    <input type="hidden" name="id" value="' . $row['id'] . '">
                                    <input type="submit" value="DELETE"> 
                                </form>
                            </td>
                        </tr>';
                }
            ?>
            <tr>
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                    <td><input type="hidden" name="action" value="new_accomodation"></td>
                    <td><input id="accomodation_name" type="text" placeholder="Name"></td>
                    <td><input id="accomodation_location" type="number"></td>
                    <td><input id="accomodation_stars" type="number" min="1" max="5"></td>
                    <!-- Javascript option to pull from clipboard? -->
                    <td><input id="accomodation_link" type="text"></td>
                    <td><input id="accomodation_cost" type="number" hint="Average Cost of stay"></td>
                    <td><input type="submit" value="Submit"></td>
                </form>
            </tr>
        </table>
        <h2>Attendees</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>E-mail</th>
                <th>Phone #</th>
                <th>Language</th>
                <th>Event ID</th>
                <th>Delete?</th>
            </tr>
            <?php
                $sql = "SELECT * FROM attendees;";
                $ret = $db->execSQL($sql);
                while($row = $ret->fetchArray(SQLITE3_ASSOC)){
                    echo '<tr>
                            <td>' . $row['id'] . '</td>
                            <td>' . $row['first_name'] . '</td>
                            <td>' . $row['last_name'] . '</td>
                            <td>' . $row['email'] . '</td>
                            <td>' . $row['phone_number'] . '</td>
                            <td>' . $row['language'] . '</td>
                            <td>' . $row['event_id'] . '</td>
                            <td>
                                <form action="' . $_SERVER['PHP_SELF'] . '" method="post">
                                    <input type="hidden" name="action" value="delete_attendee">
                                    <input type="hidden" name="id" value="' . $row['id'] . '">
                                    <input type="submit" value="DELETE"> 
                                </form>
                            </td>
                        </tr>';
                }
            ?>
            <!-- No Manual Adding of Attendees -->
        </table>
        <h2>Dates</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Year</th>
                <th>Month</th>
                <th>Day</th>
                <th>Delete?</th>
            </tr>
            <?php
                $sql = "SELECT * FROM dates;";
                $ret = $db->execSQL($sql);
                while($row = $ret->fetchArray(SQLITE3_ASSOC)){
                    echo '<tr>
                            <td>' . $row['id'] . '</td>
                            <td>' . $row['year'] . '</td>
                            <td>' . $row['month'] . '</td>
                            <td>' . $row['day'] . '</td>
                            <td>
                                <form action="' . $_SERVER['PHP_SELF'] . '" method="post">
                                    <input type="hidden" name="action" value="delete_date">
                                    <input type="hidden" name="id" value="' . $row['id'] . '">
                                    <input type="submit" value="DELETE"> 
                                </form>
                            </td>
                        </tr>';
                }
            ?>
            <tr>
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                    <td><input type="hidden" name="action" value="new_date"></td>
                    <td><input name="year" id="year" type="number" placeholder="2016"></td>
                    <td><input name="month" id="month" type="number" min="1" max="12"></td>
                    <td><input name="day" id="day" type="number" min="1" max="31"></td>
                    <td><input type="submit" value="Submit"></td>
                </form>
            </tr>
        </table>
        <h2>Events</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Location ID</th>
                <th>Info Text Link</th>
                <th>Delete ?</th>
            </tr>
            <?php
                $sql = "SELECT * FROM events;";
                $ret = $db->execSQL($sql);
                while($row = $ret->fetchArray(SQLITE3_ASSOC)){
                    echo '<tr>
                            <td>' . $row['id'] . '</td>
                            <td>' . $row['title'] . '</td>
                            <td>' . $row['start_date'] . '</td>
                            <td>' . $row['end_date'] . '</td>
                            <td>' . $row['location'] . '</td>
                            <td>' . $row['info_text'] . '</td>
                            <td>
                                <form action="' . $_SERVER['PHP_SELF'] . '" method="post">
                                    <input type="hidden" name="action" value="delete_event">
                                    <input type="hidden" name="id" value="' . $row['id'] . '">
                                    <input type="submit" value="DELETE"> 
                                </form>
                            </td>
                        </tr>';
                }
            ?>
            <tr>
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                    <td><input type="hidden" name="action" value="new_event"></td>
                    <td><input id="event_title" type="text" placeholder="Title"></td>
                    <td><input id="event_start" type="number"></td>
                    <td><input id="event_end" type="number"></td>
                    <td><input id="event_location" type="number"></td>
                    <td><input type="submit" value="Submit"></td>
                </form>
            </tr>
        </table>
        <h2>Locations</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Region</th>
                <th>Address Line 1</th>
                <th>Address Line 2</th>
                <th>Town</th>
                <th>County</th>
                <th>Delete ?</th>
            </tr>
            <?php
                $sql = "SELECT * FROM locations;";
                $ret = $db->execSQL($sql);
                while($row = $ret->fetchArray(SQLITE3_ASSOC)){
                    echo '<tr>
                            <td>' . $row['id'] . '</td>
                            <td>' . $row['region'] . '</td>
                            <td>' . $row['addr_1'] . '</td>
                            <td>' . $row['addr_2'] . '</td>
                            <td>' . $row['town'] . '</td>
                            <td>' . $row['county'] . '</td>
                            <td>
                                <form action="' . $_SERVER['PHP_SELF'] . '" method="post">
                                    <input type="hidden" name="action" value="delete_location">
                                    <input type="hidden" name="id" value="' . $row['id'] . '">
                                    <input type="submit" value="DELETE"> 
                                </form>
                            </td>
                        </tr>';
                }
            ?>
            <tr>
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                    <td><input type="hidden" name="action" value="new_location"></td>
                    <td><input id="region" type="text" placeholder="Region"></td>
                    <td><input id="addr_1" type="text" placeholder="Address Line 1"></td>
                    <td><input id="addr_2" type="text" placeholder="Address Line 2"></td>
                    <td><input id="town" type="text" placeholder="Town"></td>
                    <td><input id="county" type="text" placeholder="County"></td>
                    <td><input type="submit" value="Submit"></td>
                </form>
            </tr>
        </table>
        <h2>Travel</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Travel Type</th>
                <th>Location</th>
                <th>Link</th>
                <th>Cost</th>
                <th>Contact</th>
                <th>Delete ?</th>
            </tr>
            <?php
                $sql = "SELECT * FROM travel;";
                $ret = $db->execSQL($sql);
                while($row = $ret->fetchArray(SQLITE3_ASSOC)){
                    echo '<tr>
                            <td>' . $row['id'] . '</td>
                            <td>' . $row['travel_type'] . '</td>
                            <td>' . $row['location'] . '</td>
                            <td>' . $row['link'] . '</td>
                            <td>' . $row['cost'] . '</td>
                            <td>' . $row['contact'] . '</td>
                            <td>
                                <form action="' . $_SERVER['PHP_SELF'] . '" method="post">
                                    <input type="hidden" name="action" value="delete_travel">
                                    <input type="hidden" name="id" value="' . $row['id'] . '">
                                    <input type="submit" value="DELETE"> 
                                </form>
                            </td>
                        </tr>';
                }
            ?>
            <tr>
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                    <td><input type="hidden" name="action" value="new_travel"></td>
                    <td><input id="travel_type" type="text" placeholder="Name"></td>
                    <td><input id="travel_location" type="number"></td>
                    <td><input id="travel_link" type="number"></td>
                    <td><input id="travel_cost" type="number"></td>
                    <td><input id="travel_contact" type="text" placeholder="Email or Phone Number"></td>
                    <td><input type="submit" value="Submit"></td>
                </form>
            </tr>
        </table>
        <h2>Recordings</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Date ID</th>
                <th>Event ID</th>
                <th>Type</th>
                <th>Link</th>
                <th>Delete ?</th>
            </tr>
            <?php
                $sql = "SELECT * FROM recordings;";
                $ret = $db->execSQL($sql);
                while($row = $ret->fetchArray(SQLITE3_ASSOC)){
                    echo '<tr>
                            <td>' . $row['id'] . '</td>
                            <td>' . $row['title'] . '</td>
                            <td>' . $row['date'] . '</td>
                            <td>' . $row['event_id'] . '</td>
                            <td>' . $row['type'] . '</td>
                            <td>' . $row['link'] . '</td>
                            <td>
                                <form action="' . $_SERVER['PHP_SELF'] . '" method="post">
                                    <input type="hidden" name="action" value="delete_recording">
                                    <input type="hidden" name="id" value="' . $row['id'] . '">
                                    <input type="submit" value="DELETE"> 
                                </form>
                            </td>
                        </tr>';
                }
            ?>
            <tr>
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                    <td><input type="hidden" name="action" value="new_recording"></td>
                    <td><input id="recording_title" type="text" placeholder="Title"></td>
                    <td><input id="recording_date" type="number"></td>
                    <td><input id="recording_event" type="number"></td>
                    <td><input id="recording_type" type="text"></td>
                    <td><input id="recording_link" type="text"></td>
                    <td><input type="submit" value="Submit"></td>
                </form>
            </tr>
        </table>
        <h2>Feedback</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Feedback</th>
                <th>E-mail</th>
                <th>Delete ?</th>
            </tr>
            <?php
                $sql = "SELECT * FROM feedback;";
                $ret = $db->execSQL($sql);
                while($row = $ret->fetchArray(SQLITE3_ASSOC)){
                    echo '<tr>
                            <td>' . $row['id'] . '</td>
                            <td>' . $row['feedback'] . '</td>
                            <td>' . $row['email'] . '</td>
                            <td>
                                <form action="' . $_SERVER['PHP_SELF'] . '" method="post">
                                    <input type="hidden" name="action" value="delete_feedback">
                                    <input type="hidden" name="id" value="' . $row['id'] . '">
                                    <input type="submit" value="DELETE"> 
                                </form>
                            </td>
                        </tr>';
                }
            ?>
        </table>
    <body>
</html>