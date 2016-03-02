<!DOCTYPE html>
<html>
    <head>

        <style>

        body 
        {
            background-image: url("http://www.rgbstock.com/cache1s6IGR/users/x/xy/xymonau/300/nrmoMm4.jpg");
            background-size:cover;
            font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
            text-align: center;
        }

       .form-container 
       {
           border: 1px solid #f2e3d2;
           background: #ffffff;
           background: -webkit-gradient(linear, left top, left bottom, from(#d1f0ed), to(#ffffff));
           background: -webkit-linear-gradient(top, #d1f0ed, #ffffff);
           background: -moz-linear-gradient(top, #d1f0ed, #ffffff);
           background: -ms-linear-gradient(top, #d1f0ed, #ffffff);
           background: -o-linear-gradient(top, #d1f0ed, #ffffff);
           background-image: -ms-linear-gradient(top, #d1f0ed 0%, #ffffff 100%);
           -webkit-border-radius: 8px;
           -moz-border-radius: 8px;
           border-radius: 8px;
           -webkit-box-shadow: rgba(000,000,000,0.9) 0 1px 2px, inset rgba(255,255,255,0.4) 0 0px 0;
           -moz-box-shadow: rgba(000,000,000,0.9) 0 1px 2px, inset rgba(255,255,255,0.4) 0 0px 0;
           box-shadow: rgba(000,000,000,0.9) 0 1px 2px, inset rgba(255,255,255,0.4) 0 0px 0;
           font-family: 'Helvetica Neue',Helvetica,sans-serif;
           text-decoration: none;
           vertical-align: middle;
           min-width:300px;
           padding:20px;
           width:800px;

            margin-left: auto;
            margin-right: auto;
        }


        </style>

    </head>
    <body>




        <h1>Thank you for Registering With Glider.com</h1>
         <div class="form-container">
        <?php

            // CONNECT TO THE DATA BASE
            class MyDB extends SQLite3
            {
                function __construct()
                {
                    $this->open('2016.db');
                }
            }

             $db = new MyDB();
            if(!$db){
                echo $db->lastErrorMsg();
            } else {
                echo "[[Opened database successfully YAY!!!]]";
            }
   
            //GET REG USER DETAILS
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $event = $_POST['event'];
            $language = $_POST['language'];

            echo $email;

            
            $title = "Culture Festival";

            //$db = new MyDB('2016.db');

            //$db->addAttendee($first_name, $last_name, $email, $phone, $language, $event);

            //$id = $db->getAttendeeId($email, $event);
            //$title = $db->getEventTitle($event);

            $eventID = "11";

            $id = getID($eventID, $db);

            //executeSQL($sql);

              
           
          $incert_sql =<<<EOF
              INSERT INTO attendees (id, first_name, last_name, email, phone_number, language, event_id)
              VALUES ($id, $first_name, $last_name, $email, $phone_number, $language, $eventID );
EOF;

           $ret = $db->query($incert_sql);

           if(!$ret){
             echo $db->lastErrorMsg();
          } else {
              echo "Records created successfully\n";
           }

        


            // DISPLAY RECIPT TO THE USER

            echo '<h3>Your ID Number is: ' . $id . '.</h3>';
            echo '<p>Thank You ' . $first_name . ' ' . $last_name . ' for registering for the '. $title;
            echo '<p>Your Registration ID number is displayed above. Please use this number and email as proof of registration.</p>';
            echo '<p>See you at '. $title . '.</p>';

            // NAVIGATE BACK TO THE HOME SCREEN
            echo '<p><a href="travel.php">What\'s the best way of getting there?</a></p>';
            echo '<p><a href="tbd">Where can I stay?</a></p>';
             echo '<p><a href="hompage.php"> << Back to the Home Page</a></p>';

            //PHP FUNCTIONS=======================================================

            

             //MAKE AN ID 
             function getID($eventID)
             {
                $rand ="";


                //get a random number
                for ($x = 0; $x <= 1; $x++)
                {
                  $rand = $rand . rand(1, 9);
                }

                //get the secound the user logged on
                $time = date("s");
  
                return  $eventID . $rand . $time;
             }


<<<<<<< HEAD
           $db->printReceipt($id);
=======
>>>>>>> Philip
        ?>
    </body></div>
</html>