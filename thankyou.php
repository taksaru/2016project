<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <?php
            require 'db_functions.php';

            $feedback = $_GET['feedback'];
            $email = $_GET['email'];

            $db = new myDB('2016.db');

            $db->addFeedback($email, $feedback);
        ?>
        <h1>Thank you for your Feedback</h1>
    </body>
</html>