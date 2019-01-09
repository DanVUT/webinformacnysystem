<?php 


$mysqli = new mysqli('localhost', 'xflore02', 'arurhu8n', 'xflore02');
    if ($mysqli->connect_error) {
        die('Connect Error (' . $mysqli->connect_errno . ') '
                . $mysqli->connect_error);
    }
    $query = 'INSERT INTO items(name) VALUES('.'"'.$_POST['item'].'"'.')';
    $result = $mysqli->query($query);

    $query = 'INSERT INTO news (content, date_created) VALUES("New Item: '. $_POST['item'].'.", '.'"'.date("y-m-d").'")';
    $result = $mysqli->query($query);

    header("Location: ../superuser.php");






?>