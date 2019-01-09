<?php
    $ids = $_POST['checkboxes'];
    $mysqli = new mysqli('localhost', 'xflore02', 'arurhu8n', 'xflore02');
    if ($mysqli->connect_error) {
        die('Connect Error (' . $mysqli->connect_errno . ') '
                . $mysqli->connect_error);
    }
    
    


    for($i = 0; $i < count($ids); $i++){
        $query = 'UPDATE occupation SET date_ended = '.'"'.date("y-m-d").'"'. " WHERE id = ".$ids[$i];
        $mysqli->query($query);
        $query = 'UPDATE territories SET current_state = current_state - 1 WHERE id_territory = '. $ids[$i];
        $mysqli->query($query);
    }

    
    header("Location: territories.php");


?>