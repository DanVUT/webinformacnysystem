<?php
    $mysqli = new mysqli('localhost', 'xflore02', 'arurhu8n', 'xflore02');
    if ($mysqli->connect_error) {
        die('Connect Error (' . $mysqli->connect_errno . ') '
                . $mysqli->connect_error);
    }
    $query = 'DELETE FROM news';
    $result = $mysqli->query($query);
    
    header("Location: ../superuser.php");
?>