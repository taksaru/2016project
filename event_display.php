<?php
    $id = $_GET['id'];
    if(!$id){
        echo 'ERROR: NO GIVEN ID';
    }else{
        $db = new MyDB();
        $db->displayEvent($id);
    }
?>