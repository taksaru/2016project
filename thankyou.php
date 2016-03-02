<!DOCTYPE html>
<html>
    <head>

            <!--NAVIGATION BAR SCRIPTS
        ================================================== -->
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">

        <link href="css/searchBar.css" rel="stylesheet" type="text/css" media="all"/>
        
        <link href="css/styles.css" rel="stylesheet" type="text/css" media="all"/>
        <!-- Custom Theme files -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); }>
        </script>          
    </head>
    <body>
    <!--NAVIGATION BAR
        ================================================== -->

    <div class="header">
    <div class="container">
        <div class="header-main">
            <div class="logo">
                <a href="hompage.html"> <img src="img/glider.png" alt="" title=""> </a>
            </div>
            <div class="head-right">
              <div class="top-nav">
                    <span class="menu"> <img src="img/glider.png" alt=""/></span>
                <ul class="res">
                    <?php 
                        include "generatenav.php";
                        generateNav('feedback');
                    ?>
                <div class="clearfix"> </div>
                </ul>
                <!-- script-for-menu -->
                             <script>
                               $( "span.menu" ).click(function() {
                                 $( "ul.res" ).slideToggle( 300, function() {
                                 // Animation complete.
                                  });
                                 });
                            </script>
            <!-- /script-for-menu -->
             </div>
            
            <div class="social">
                <ul >
                    <li><a class="fa" href="#"> </a></li>
                    <li><a class="tw" href="#"> </a></li>
                    <li><a class="p" href="#"> </a></li>
                </ul>
                </div>
                
            
            <div class="clearfix"> </div>
               <!-- search-scripts -->
                    <script src="js/classie.js"></script>
                    <script src="js/uisearch.js"></script>
                        <script>
                            new UISearch( document.getElementById( 'sb-search' ) );
                        </script>
              <!-- //search-scripts -->
        </div>
        </div>
        </div>
    </div>
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


            //require 'db_functions.php';

            $feedback = $_POST['commentBox'];
            $email = $_POST['email'];


            //Convert whitespaces and underscore to dash
            //$feedback = preg_replace("/[\s_]/", "_", $feedback);
            //$email = preg_replace('/@/', '^', $email);

            $insert = "INSERT INTO feedback (feedback, email) VALUES ('".$feedback."','".$email."');";

           $ret = $db->prepare($insert);

           if(!$ret){
             echo "<p>".$db->lastErrorMsg()."<p>";
          } else {
              echo "Records created successfully\n";
           }

           $display = $db->query($getAllValues);
            
            while($row = $display->fetchArray(SQLITE3_ASSOC) )
            {
                echo $row['feedback'];
                echo $row['feedback'];
            }



            echo "<p>$feedback</p>";
            

        ?>
        <h2>Thank you for your Feedback</h2>

        <p> something!!!!!</p>
    </body>
</html>