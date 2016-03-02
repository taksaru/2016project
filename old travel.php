<!--
================================================== 
Robbie Deane
113381296
CS3305
TEAM GLIDER WEBSITE 
GLIDERS HOME PAGE
================================================== 
-->


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

		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>

		<script type="text/javascript">
			$(function() {
				$("#lets_search").bind('submit',function() {
					var start_date = $('#start_date').val();
					var end_date = $('#end_date').val();
					var province = $('#province').val();
					var event_name = $('#event_name').val();
					$.post('db_query.php',{start_date:start_date,end_date:end_date,province:province,event_name:event_name}, function(data){
					$("#search_results").html(data);
					});
					return false;
				});
			});
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
						generateNav('travel');
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
	
		<!--===== PART ONE: SEARCH FOR EVENT =====-->
		<div class="findevent">
			<form id="lets_search" action="">
			<fieldset>
				<legend>Choose Your Event</legend>
				<label for="start_date">Events From:</label>
				<input type="date" name="start_date" id="start_date">
				<label for="end_date">To:</label>
				<input type="date" name="end_date" id="end_date">
				</br>
				<label for="province">Province:</label>
				<select id="province" name="province">
					<option value="0">All</option>
					<option value="1">Connaught</option>
					<option value="2">Leinster</option>
					<option value="3">Munster</option>
					<option value="4">Ulster</option>
				</select>
				<label for="event_name">Event Name:</label>
				<input type="text" id="event_name" name="event_name"/>
				<input type="submit" value="send" name="send" id="send"/>
			
			</fieldset>
			</form>
			
			<div id="search_results"></div>
		</div>
		
		<!--===== PART TWO: SEARCH FOR DIRECTIONS TO EVENT =====-->
		<form>
			<fieldset>
				<legend>Plan My Trip</legend>
				<label for="date">Date of Event:</label>
				<input type="datetime-local" name="due_date_time" id="date">
			
			</fieldset>
		</form>
		<div class="mapcontent">
		<div id="floating-panel">
    <b>Start: </b>
    <select id="start" onchange="calcRoute();">
      <option value="chicago, il">Chicago</option>
      <option value="st louis, mo">St Louis</option>
      <option value="joplin, mo">Joplin, MO</option>
      <option value="oklahoma city, ok">Oklahoma City</option>
      <option value="amarillo, tx">Amarillo</option>
      <option value="gallup, nm">Gallup, NM</option>
      <option value="flagstaff, az">Flagstaff, AZ</option>
      <option value="winona, az">Winona</option>
      <option value="kingman, az">Kingman</option>
      <option value="barstow, ca">Barstow</option>
      <option value="san bernardino, ca">San Bernardino</option>
      <option value="los angeles, ca">Los Angeles</option>
    </select>
    <b>End: </b>
    <select id="end" onchange="calcRoute();">
      <option value="chicago, il">Chicago</option>
      <option value="st louis, mo">St Louis</option>
      <option value="joplin, mo">Joplin, MO</option>
      <option value="oklahoma city, ok">Oklahoma City</option>
      <option value="amarillo, tx">Amarillo</option>
      <option value="gallup, nm">Gallup, NM</option>
      <option value="flagstaff, az">Flagstaff, AZ</option>
      <option value="winona, az">Winona</option>
      <option value="kingman, az">Kingman</option>
      <option value="barstow, ca">Barstow</option>
      <option value="san bernardino, ca">San Bernardino</option>
      <option value="los angeles, ca">Los Angeles</option>
    </select>
    </div>
    <div id="map"></div>
    <script>
function initMap() {
  var directionsService = new google.maps.DirectionsService;
  var directionsDisplay = new google.maps.DirectionsRenderer;
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 7,
    center: {lat: 41.85, lng: -87.65}
  });
  directionsDisplay.setMap(map);

  var onChangeHandler = function() {
    calculateAndDisplayRoute(directionsService, directionsDisplay);
  };
  document.getElementById('start').addEventListener('change', onChangeHandler);
  document.getElementById('end').addEventListener('change', onChangeHandler);
}

function calculateAndDisplayRoute(directionsService, directionsDisplay) {
  directionsService.route({
    origin: document.getElementById('start').value,
    destination: document.getElementById('end').value,
    travelMode: google.maps.TravelMode.DRIVING
  }, function(response, status) {
    if (status === google.maps.DirectionsStatus.OK) {
      directionsDisplay.setDirections(response);
    } else {
      window.alert('Directions request failed due to ' + status);
    }
  });
}

    </script>
	
	<script>
	$(document).ready(function(){ 

	$("#send").click(setTimeout(function(){
        $("#searchresults").slideDown();
    }, 5000));
	});

    </script>
	
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyByqIHX5GJjPMgNsNKgtyF6aXq3dEmspU4&signed_in=true&callback=initMap"
        async defer></script>
		
	</div>
   
    </body>
</html>