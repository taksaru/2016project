<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <?php
            require 'db_functions.php';

            $action = $_GET['action'];
            if(!$action){

            }else{
                switch($action){
                    case "delete_accomodation":
                        $id = $_GET['id'];
                        deleteAccomodation($id);
                        break;
                    case "new_accomdation":
                        $name = $_GET'accomodation_name'];
                        $location = $_GET['accomodation_location'];
                        $stars = $_GET['accomodation_stars'];
                        $link = $_GET['accomodation_link'];
                        $cost = $_GET['accomodation_cost'];
                    case "new_date":
                        getDate();
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
            <tr>
                <!-- Sample Row -->
                <td>Holder ID</td>
                <td>Holder Name</td>
                <td>Placeholder</td>
                <td>1-5</td>
                <td>Placeholder</td>
                <td>Placeholder</td>
                <!-- PHP research To be completed -->
                <td>
                    <form action="admin_ui.php?action=delete_accomodation?id={HOLDER ID}" method="post">
                        <input type="submit" value="DELETE">
                    </form>
                </td>
            </tr>
            <tr>
                <!-- Blank Row at End for new Additions 
                    Use of hint attribute could be wrong -->
                <form action="THIS?action=new_accomodation" method="post">
                    <td></td>
                    <td><input id="accomodation_name" type="text" placeholder="Name"></td>
                    <td><input id="accomodation_location" type="text" placeholder="Location ID" hint="Find the ID in the Location Table"></td>
                    <!-- To be changed to numerical from 1-5 -->
                    <td><input id="accomodation_stars" type="text"></td>
                    <!-- Javascript option to pull from clipboard? -->
                    <td><input id="accomodation_link" type="text"></td>
                    <td><input id="accomodation_cost" type="integer" hint="Average Cost of stay"></td>
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
            <!-- Sample Placeholder Row -->
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
        </table>
        <h2>Feedback</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Feedback</th>
                <th>E-mail</th>
                <th>Delete ?</th>
            </tr>
            </tr>
        </table>
    <body>
</html>