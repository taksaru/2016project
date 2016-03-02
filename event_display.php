<?php
    $id = $_GET['id'];
    if(!$id){
        echo 'ERROR: NO GIVEN ID';
    }else{
        $db = new MyDB('2016.db');
        $db->displayEvent($id);
    }
?>