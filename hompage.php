
<!--
================================================== 
PHILIP SPILLANE
115140149
CS3305
TEAM GLIDER WEBSITE 
GLIDERS HOME PAGE
================================================== 
-->

<!DOCTYPE html>

<head>

<!-- Basic Page Needs
================================================== -->
<meta charset="utf-8">
<title>Glider Hompage</title>



<!-- CSS
================================================== -->
<link rel="stylesheet" href="searchBox/style.css" />
<link rel="stylesheet" href="searchBox/responsive.css" />

<!-- Java Script
================================================== -->
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>


<script type="text/javascript" src="js/jquery-ui-1.8.24.custom.min.js"></script>

<script type="text/javascript" src="js/selectnav.min.js">

</script>

<script type="text/javascript" src="js/theme.js"></script>

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

<!--CALLENDER  ADD SCRIPT
		================================================== -->
		<link rel='stylesheet' type='text/css' href='fullcalendar/fullcalendar.css' />
<script type='text/javascript' src='fullcalendar/jquery-1.5.2.min.js'></script>
<script type='text/javascript' src='fullcalendar/jquery-ui-1.8.11.custom.min.js'></script>
<script type='text/javascript' src='fullcalendar/fullcalendar.min.js'></script>
<script type='text/javascript' src='js/CallenderAd.js'></script>


</head>
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
						generateNav('home');
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
		<!--SEARCH BOX
		================================================== -->
	<div id = "searchBox">
		
			<div class="two-third">
				<div id="searchmodule" class="tabs">
					<img src="img/icons/search.png" style="width:70px;height:70px;" class="search-icon">
					<ul class="tab-control">
						<li><a href="#flight-search">National Events</a></li>
						<li><a href="#hotel-search">International Events</a></li>
						<li><a href="#travel-search">All Events</a></li>
					</ul>
					<div id="flight-search" class="tab-content">
						<form action="#">
							<div class="field">
								<label for="flight-from">Search For National Event:</label>
								<input type="text" id="event-search" class="input-text input" placeholder="Search" autocomplete="off" />
							</div>
						
							<div class="field half">
								<label for="flight-depart">From:</label>
								<input type="text" id="nat-frm" class="input-text input-cal input" placeholder="01/01/2016" autocomplete="off" />
							</div>
							<div class="field half even">
								<label for="flight-return">To:</label>
								<input type="text" id="nat-to" class="input-text input-cal input" placeholder="12/31/2015" autocomplete="off"/>
							</div>
							<div class="province">
								 Select Province: 
                            	<select name="Province" class="Province">
                           	 <option value="All">All Provinces</option>
                            <option value="Connacht">Connacht</option>
                            <option value="Leinster">Leinster</option>
                            <option value="Munster">Munster</option>
                            <option value="Ulster">Ulster</option>  
                          </select>
							</div>
							
							<button type="submit" class="submit">Search</button>
							<br class="clear" />
						</form>
					</div>
					<!--flight search -->
					
					<div id="hotel-search" class="tab-content">
						<form action="#">
						<div class="field">
								<label for="flight-from">Search For International Event:</label>
								<input type="text" id="event-search" class="input-text input" placeholder="Search" autocomplete="off" />
							</div>
						
							<div class="field half">
								<label for="flight-depart">From:</label>
								<input type="text" id="int-frm" class="input-text input-cal input" placeholder="01/01/2016" autocomplete="off" />
							</div>
							<div class="field half even">
								<label for="flight-return">To:</label>
								<input type="text" id="nat-to" class="input-text input-cal input" placeholder="12/31/2015" autocomplete="off" />
							</div>
							<div class="province">
								 Select Province: 
                            	<select name="Province" class="Province">
                           	 <option value="All">All Provinces</option>
                            <option value="Connacht">Connacht</option>
                            <option value="Leinster">Leinster</option>
                            <option value="Munster">Munster</option>
                            <option value="Ulster">Ulster</option>  
                          </select>
							
							<button type="submit" class="submit">Search</button>
							<br class="clear" /></div>
						</form>
					</div>
					<!--hotel search -->
					
					<div id="travel-search" class="tab-content">
						<form action="#">
							<div class="field">
								<label for="flight-from">Search For Event:</label>
								<input type="text" id="event-search" class="input-text input" placeholder="Search" autocomplete="off" />
							</div>
						
							<div class="field half">
								<label for="flight-depart">From:</label>
								<input type="text" id="all-frm" class="input-text input-cal input" placeholder="01/01/2016" autocomplete="off" />
							</div>
							<div class="field half even">
								<label for="flight-return">To:</label>
								<input type="text" id="all-to" class="input-text input-cal input" placeholder="12/31/2015" autocomplete="off" />
							</div>
							<div class="province">
								 Select Province: 
                            	<select name="Province" class="Province">
                           	 <option value="All">All Provinces</option>
                            <option value="Connacht">Connacht</option>
                            <option value="Leinster">Leinster</option>
                            <option value="Munster">Munster</option>
                            <option value="Ulster">Ulster</option>  
                          </select></div>
							<button type="submit" class="submit button_style">Search</button>
							<br class="clear" />
						</form>
					</div>
					<!--travel search -->
				</div>
			</div>
			<!--searchmodule -->
			
			<div class="one-third last">
				
			</div>
			<!--action-box -->
			
			
			<br class="clear" />
		
	</div>
		<!--end content -->

	<div class="event_container">

		<table style="width:100%">
 		<tr>

 			<td>
 				<img src="img/event_Img/cultnight.jpg" alt="" border=3 height=300 width=260>
 			</td>
 		<td></td>
 		<td>
 		<h3> The World Culture Festival 2016</h3>

		<p id="description">

			The World Culture Festival 2016 is a celebration of The Art of Living's 35 years of service, humanity, spirituality and human values. It will take place on March 11-13, 2016 in New Delhi, India. The festival will celebrate the diversity in cultures from across the world while simultaneously highlighting our unity as a human family. </p>
			<br>
			<p id="details" style="background:#ECF6CE;"> Where? Cork City, Cork, Munster <br>
			    When?  14:00  13/2/2016</p>
			  <br>
			<button type="submit" style="align=left;">More Info...</button>
		</td>
		</tr>
		<tr>
			<td>
				<a href="reg_form.html">
				<button type="submit">Register For This Event</button>
			</a>

			</td>

		</tr>

			

		</table>

	</div>

	<!-- CALLENDER AD
		================================================== -->

	<div id ='calenderAd'>
	<h4> what is coming up?</h4>
		<div id='calendar'></div>
	</div>

	<!-- SLIDE SHOW - SHOWS WHAT THE WEBSITE IS ALL ABOUT
	======================================================-->

	 
	<div id="comslider_in_point_911021"></div>

	<script type="text/javascript">
	var oCOMScript911021=document.createElement('script');
	oCOMScript911021.src="comslider911021/comsliderd.js?timestamp=1455219745";
	oCOMScript911021.type='text/javascript';
	document.getElementsByTagName("head").item(0).appendChild(oCOMScript911021);
	</script>
		

	
	
</div>
<!--wrapper -->

</body>
</html>