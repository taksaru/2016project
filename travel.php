<!DOCTYPE html>
<html>
    <head>

        <!--NAVIGATION BAR SCRIPTS
        ================================================== -->
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
					$( "#displaymapping" ).slideUp( "slow" );
					$( "#search_results" ).slideDown("slow");
					return false;
				});
			});
		</script>
		<?php
			if (!isset($_POST["event"]) && empty($_POST["event"])){
				echo "<style>#displaymapping{display: none;</style>";
			}
		?>
    </head>
	<body>
    <!--NAVIGATION BAR
        ================================================== -->

    <div class="header">
        <div class="logo">
            <a href="hompage.html"> <img src="img/glider.png" alt="" title=""> </a>
        </div>
        <div class="top-nav">
            <ul class="res">
                <?php 
					include "generatenav.php";
					generateNav('travel');
				?>
            </ul>
        </div>
            
        <div class="social">
            <ul>
                <li><a class="fa" href="#"> </a></li>
                <li><a class="tw" href="#"> </a></li>
                <li><a class="p" href="#"> </a></li>
            </ul>
        </div>
	</div>
	
		<!--===== PART ONE: SEARCH FOR EVENT =====-->
		<div class="findevent">
			<form id="lets_search" action="">
			<fieldset>
				<legend>Choose An<?php
					if (isset($_POST["event"]) && !empty($_POST["event"])){
						echo "other";
					}
				?> Event</legend>
				<div class="inputevents">
					<label for="start_date">Events From:</label>
					<input type="date" name="start_date" id="start_date" />
					<label for="end_date">To:</label>
					<input type="date" name="end_date" id="end_date" />

					<label for="province">Province:</label>
					<select id="province" name="province">
						<option value="0">All</option>
						<option value="1">Connaught</option>
						<option value="2">Leinster</option>
						<option value="3">Munster</option>
						<option value="4">Ulster</option>
					</select>
					<label for="event_name">Event Name:</label>
					<input type="text" id="event_name" name="event_name" />
					<input type="submit" value="send" name="send" id="send" />
				</div>
			</fieldset>
			</form>
			
			<div id="search_results"></div>
		</div>
		
		<!--===== PART TWO: SEARCH FOR DIRECTIONS TO EVENT =====-->
		
		<div id="displaymapping">
			<form id="travelling_locations" action="">
				<fieldset>
					<label for="travelling_from">Travelling From:</label>
					<input type="Text" name="travelling_from" id="start">
					<input style="display: none;" type="Text" value="<?php
			if (isset($_POST["event"]) && !empty($_POST["event"])){
				echo $_POST['event'];
			}
				?>" name="travelling_from" id="end">
					<select id="mode" size="4">
					  <option selected value="DRIVING">Driving</option>
					  <option value="WALKING">Walking</option>
					  <option value="BICYCLING">Bicycling</option>
					  <option value="TRANSIT">Transit</option>
					</select>
					<p id="error_msg"></p>
				</fieldset>
			</form>
			<div id="right-panel"></div>
			<div id="map"></div>
	<script>
		function initMap() {
		  var directionsDisplay = new google.maps.DirectionsRenderer;
		  var directionsService = new google.maps.DirectionsService;
		  var map = new google.maps.Map(document.getElementById('map'), {
			zoom: 7,
			center: {lat: 53.5, lng: -7.78}
		  });
		  directionsDisplay.setMap(map);
		  directionsDisplay.setPanel(document.getElementById('right-panel'));
		  
			document.getElementById('mode').addEventListener('change', function() {
				calculateAndDisplayRoute(directionsService, directionsDisplay);
			});

		  var onChangeHandler = function() {
			calculateAndDisplayRoute(directionsService, directionsDisplay);
		  };
		  document.getElementById('start').addEventListener('change', onChangeHandler);
		  document.getElementById('end').addEventListener('change', onChangeHandler);
		}

		function calculateAndDisplayRoute(directionsService, directionsDisplay) {
			document.getElementById("error_msg").innerHTML = "";
			var selectedMode = document.getElementById('mode').value;
		  var start = document.getElementById('start').value;
		  var end = document.getElementById('end').value;
		  directionsService.route({
			origin: start,
			destination: end,
			travelMode: google.maps.TravelMode[selectedMode]
		  }, function(response, status) {
			if (status === google.maps.DirectionsStatus.OK) {
			  directionsDisplay.setDirections(response);
			  $('html, body').animate({
				scrollTop: $("#displaymapping").offset().top
				}, 2000);
			} else {
			  document.getElementById("error_msg").innerHTML = "Please try a different search request";
			}
		  });
		}

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyByqIHX5GJjPMgNsNKgtyF6aXq3dEmspU4&signed_in=true&libraries=places&callback=initMap"
        async defer></script>

		
	</div>
   
    </body>
</html>