<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <!--post is used so that the registration query is only performed once -->
        <!--attendee_registration.php method="post" VIP -->
        <form action="attendee_registration.php" method="post">
            <label for="first_name">First Name:</label>
            <input id="first_name" type="text" placeholder="First Name">
            <label for="last_name">Last Name:</label>
            <input id="last_name" type="text" placeholder="Last Name">
            <label for="email">Email Address:</label>
            <input id="email" type="text" placeholder="e-mail address">
            <label for="phone"></label>
            <input id="phone" type="text" placeholder="Phone Number">
            <!--Make Invisible with CSS-->
            <div id="invisible values">
            <?php
                $event_id = $_GET['event_id'];
                $language = $_GET['language'];

                echo '<input id="event_id" value="'. $event_id . '"type="text">';
                echo '<input id="language" value="'. $language . '"type="text">';

            ?>
            </div>
            <input type="submit" value="submit">
        </form>
    </body>
</html>