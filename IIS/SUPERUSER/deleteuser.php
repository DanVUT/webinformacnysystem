<?php
    $mysqli = new mysqli('localhost', 'xflore02', 'arurhu8n', 'xflore02');
    if ($mysqli->connect_error) {
        die('Connect Error (' . $mysqli->connect_errno . ') '
                . $mysqli->connect_error);
    }
    $query = 'DELETE FROM cats WHERE id_cat = '. $_POST['user'];
    $result = $mysqli->query($query);
    
    $query = 'DELETE FROM occupation WHERE id_cat = '. $_POST['user'];
    $result = $mysqli->query($query);

    $query = 'DELETE FROM lives WHERE id_cat = '. $_POST['user'];
    $result = $mysqli->query($query);

    $query = 'DELETE FROM properties WHERE id_cat = '. $_POST['user'];
    $result = $mysqli->query($query);

    header("Location: ../superuser.php");
?>