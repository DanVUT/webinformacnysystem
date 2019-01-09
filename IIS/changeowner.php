<?php 
    session_start();
    $mysqli = new mysqli('localhost', 'xflore02', 'arurhu8n', 'xflore02');


    if ($mysqli->connect_error) {
        die('Connect Error (' . $mysqli->connect_errno . ') '
                . $mysqli->connect_error);
    }
    echo $query = 'UPDATE cats SET id_owner = ' . $_POST['owner']. ' WHERE id_cat = ' . $_SESSION['id_cat'];
    $mysqli->query($query);

    header('Location: profile.php');




?>