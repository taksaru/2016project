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

     <!--FEEDBACK BOXES
        ================================================== -->

     <!--SCRIPT FOR WORD COUNT
        ================================================== -->

    
        <script type="text/javascript" src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js'></script>
        <script type="text/javascript">
            $(document).ready(function() {
                var text_max = 250;
            $('#textarea_feedback').html(text_max + ' characters remaining');

            $('#textarea').keyup(function() {
                var text_length = $('#textarea').val().length;
                var text_remaining = text_max - text_length;

            $('#textarea_feedback').html(text_remaining + ' characters remaining');
                });
            });

        </script>

        <!--COMMENT FORM
        ================================================== -->
	<section class="content">
        <noscript>
            <p>No Javascript</p>
        </noscript>
		<div class="form">
        <form action="thankyou.php" method="post">
			<div class="prompt"><p>Give us some Feedback on an event <br><div id="textarea_feedback"></div></p></div>
            <div class="commentBox">
            <textarea name="commentBox" id="textarea" rows="8" cols="50" maxlength="250" placeholder="Feedback..." required></textarea></div>
            <div class="emailBox">
            <label for="email">Email Address:</label>
            <input class="form-field" id="email" name="email" type="email" required placeholder="e-mail address">
			</div>
			<div class="btn"><input class="submitBtn" type="submit" value="Submit" name = "name"></div>
        </form>
		</div>
        <div class="infoBox">
            <p>
                Do you need to get in touch with us for any reason? Whether you have any questions, feedback or complaints on a event you went to, having trouble working the website or registration.
                All you have to do is write us a note and provide us with your email and we’ll get back to you. If its about an event, please enter the title and the date the event was held. Your Registration ID and personal information is optional except for the email.
                Thank you.
            </p>
        </div>
	</section>
    </body>
</html>