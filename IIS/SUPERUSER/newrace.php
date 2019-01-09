<?php
    $mysqli = new mysqli('localhost', 'xflore02', 'arurhu8n', 'xflore02');
    if ($mysqli->connect_error) {
        die('Connect Error (' . $mysqli->connect_errno . ') '
                . $mysqli->connect_error);
    }
    echo $query = 'INSERT INTO races (name, eyes, origin, fangs) VALUES ('.'"'.$_POST['raceName'].'"'. ', ' . '"'.$_POST['raceEyes'].'"'. ', '.'"'.$_POST['raceOrigin'].'"'.', '.$_POST['fangLength'] .')';
    $result = $mysqli->query($query);
    
    header("Location: ../superuser.php");

?>