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
	
   $sql = 'SELECT * from events ' . $provincesql . $datesql . $titlesql;
   
   $ret = $db->query($sql);
   echo "<ul>";
   while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
		echo "<li>";
			echo "Name: ". $row['title'] . "\n";
			echo "Date: ". $row['start_date'] ."\n";
			echo " - ". $row['end_date'] ."\n";
		echo "</li>";
   }
   echo "</ul>";

   $db->close();
?>