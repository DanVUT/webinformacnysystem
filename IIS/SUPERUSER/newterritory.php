<?php 


$mysqli = new mysqli('localhost', 'xflore02', 'arurhu8n', 'xflore02');
    if ($mysqli->connect_error) {
        die('Connect Error (' . $mysqli->connect_errno . ') '
                . $mysqli->connect_error);
    }
    $query = 'INSERT INTO territories(name, capacity, current_state) VALUES('.'"'.$_POST['newterritory'].'"'. ', '. $_POST['capacity']. ', ' . 0 .')';
    $result = $mysqli->query($query);

    $query = 'INSERT INTO news (content, date_created) VALUES("New territory: '. $_POST['newterritory'].'. Capacity: '.$_POST['capacity'].'", '.'"'.date("y-m-d").'")';
    $result = $mysqli->query($query);
    header("Location: ../superuser.php");






?>