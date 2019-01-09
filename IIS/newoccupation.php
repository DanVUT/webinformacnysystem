<?php 
    session_start();
    $mysqli = new mysqli('localhost', 'xflore02', 'arurhu8n', 'xflore02');
    if ($mysqli->connect_error) {
        die('Connect Error (' . $mysqli->connect_errno . ') '
                . $mysqli->connect_error);
    }

    $query = 'SELECT * FROM occupation WHERE date_ended IS NULL AND id_cat = '.$_SESSION['id_cat']. " AND id_territory = ". $_POST['territory'];
    $result = $mysqli->query($query);

    if($result->num_rows){
        header("Location: territories.php?e=1");
        return;
    }

    $query = 'SELECT * FROM territories WHERE current_state = capacity AND id_territory = '. $_POST['territory'];
    $result = $mysqli->query($query);

    if(mysqli_num_rows($result)){
        header("Location: territories.php?e=2");
    }


    $query = 'INSERT INTO occupation (id_cat, id_territory, date_started) VALUES ('.$_SESSION['id_cat'].', '.$_POST['territory'].', "'.date("y-m-d").'")';
    $mysqli->query($query);

    $query = 'UPDATE territories SET current_state = current_state + 1 WHERE id_territory = ' . $_POST['territory'];
    $mysqli->query($query);

    
    header("Location: territories.php");





?>