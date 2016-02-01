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

            //need design of receipt before it can be implemented

            
        ?>
    </body>
</html>