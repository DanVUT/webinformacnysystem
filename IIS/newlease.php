<?php 
    session_start();
    $ids = $_POST['checkboxes'];
    $mysqli = new mysqli('localhost', 'xflore02', 'arurhu8n', 'xflore02');
    if ($mysqli->connect_error) {
        die('Connect Error (' . $mysqli->connect_errno . ') '
                . $mysqli->connect_error);
    }

    for($i = 0; $i < count($ids); $i++){
        $query = 'UPDATE properties SET leased = TRUE WHERE id = ' . $ids[$i];
        $mysqli->query($query);
    }
    header("Location: leased.php");




?>