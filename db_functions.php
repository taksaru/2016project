<?php
    class MyDB extends SQLite3{
            function __construct(){
                $this -> open('2016.db')
            }
    }

    $db = new MyDB();
    if(!$db){
        echo $db -> lastErrorMsg();
    }else{
        echo "Opened database succesfully";
    }

    function addFeedback($db, $email, $feedback){
        $sql = "INSERT INTO feedback (email, feedback) VALUES ('" .$email . "', '" . $feedback "');"
    }

    function execSQL($db, $query){
        $ret = $db->exec($sql);
        if(!$ret){
            echo->lastErrorMsg();
            return false;
        }else{
            return $ret;
        }
    }

    function displayFeedback($db){
        $sql = 'SELECT * FROM feedback';
        $ret = execSQL($db, $sql);
        if(!ret){}else{
            echo '<table>
                    <tr>
                        <th>Email Address</th>
                    </tr>';
            while($row = $ret->fetchArray(SQLite3_ASSOC)){
                echo "<tr>
                        <td>" . $row['email'] . "</td>
                        <td>" . $row['feedback'] ."</td>
                    </tr>";
            }
            echo '</table>';
        }
    }
?>  