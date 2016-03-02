		<script type="text/javascript">
			$(function() {
				$(".events").bind('submit',function() {
					var location = document.querySelector('input[name=event]:checked').value;
					$("#end").val(location);
					$('#start').val("");
					$( "#search_results" ).slideUp("slow");
					$( "#displaymapping" ).slideDown("slow");
					return false;
				});
			});
		</script>
		<?php
   class MyDB extends SQLite3
   {
      function __construct()
      {
         $this->open('2016.db');
      }
   }
   
		$province = $_POST['province'];
		$event_name = $_POST['event_name'];
		$start_date =  $_POST['start_date'];
		$end_date = $_POST['end_date'];
	  
	$db = new MyDB();
	if(!$db){
		echo $db->lastErrorMsg();
	} else {
		/* echo "Opened database successfully\n"; */
	}
	
	if ($province == 0) {
			$provincesql = " WHERE location > 0";
	}else{
			$provincesql = " WHERE location = " . $province;
		}
	
	if ($event_name != ""){
		$titlesql =  " AND title LIKE \"%". $event_name . "%\"";
	}else{
		$titlesql = "";
	}
	
	if($start_date == NULL){
		$datesql = "";
	}else{
		if($start_date != NULL && $end_date != NULL){
			$datesql = " AND ((start_date BETWEEN '". $start_date ."' AND '". $end_date ."') OR (end_date BETWEEN '". $start_date ."' AND '". $end_date ."'))";
		}else{
			$datesql = " AND start_date = '". $start_date ."'";
		}
	}

   $sql = 'SELECT e.id AS \'event\',* from events AS e JOIN locations AS l ON location = l.id' . $provincesql . $datesql . $titlesql;
   
   $ret = $db->query($sql);
   echo "<form class='events' action=''>";
   while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
		echo "<input type='radio' name='event' id='". $row['event'] ."' value='". $row['addr_1'] ." ". $row['county'] ."' onclick='myFunction()' />";
		echo "<label for='". $row['event'] ."'>";
			echo "Name: ". $row['title'] . "\n";
			echo "Date: ". $row['start_date'] ."\n";
			echo " - ". $row['end_date'] ."\n";
/* 			echo "<div class='address' onclick='myFunction()'>"; */
			echo "Location: ".$row['addr_1'].", ";
			echo $row['addr_2'].", ";
			echo "Co. " . $row['county'];
/* 			echo "</div>"; */
		echo "</label></br>";
   }
   echo "<input type=\"submit\" value=\"Go\" name=\"sendevent\" id=\"sendevent\" />";
   echo "</form>";

   $db->close();
?>