<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <h1>Thank you for Registering</h1>
        <h1>Receipt</h1>
        <?php

            $first_name = $_GET['first_name'];
            $last_name = $_GET['last_name'];
            $email = $_GET['email'];
            $phone = $_GET['phone'];
            $event = $_GET['event'];
            $language = $_GET['language'];
            require 'db_functions.php';

            $db = new MyDB('2016.db');

            $db->addAttendee($first_name, $last_name, $email, $phone, $language, $event);

            $id = $db->getAttendeeId($email, $event);
            $title = $db->getEventTitle($event);

            echo '<p>Your ID Number is: ' . $id . '.</p>';
            echo '<p>Thank You ' . $first_name . ' ' . $last_name . ' for registering for the ' . $title . '.</p>';
            echo '<p>Your event ID number is displayed above. Please use this number and email as proof of registration.</p>';
            echo '<p>See you at ' . $title '.</p>';
            echo '<p><a href="tbd">What\'s the best way of getting there?</a></p>';
            echo '<p><a href="tbd">Where can I stay?</a></p>'
        ?>
    </body>
</html>