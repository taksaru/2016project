<?php
	function generateNav($currentPage){
		$links = array (
				'home' 			=> array('text'=>'home',  			'url'=>'hompage.php'),
				'travel'		=> array('text'=>'travel',			'url'=>'travel.php'),
				'accommodation' => array('text'=>'accommodation',  	'url'=>'accommodation.php'),
				'gallery'		=> array('text'=>'gallery',  		'url'=>'gallery.php'),
				'feedback' 		=> array('text'=>'feedback',  		'url'=>'feedback.php'),
				
			);
			
		foreach($links as $page){
			if($page['text'] == $currentPage){
				echo "<li><a class='active' href='" . $page['url'] . "'>". ucfirst($page['text']) . "</a></li>";
			} else {
				echo "<li><a href='" . $page['url'] . "'>". ucfirst($page['text']) . "</a></li>";
			}
		}
	}
?>