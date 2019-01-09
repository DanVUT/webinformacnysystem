<?php 
    session_start();
    $mysqli = new mysqli('localhost', 'xflore02', 'arurhu8n', 'xflore02');
    if ($mysqli->connect_error) {
        die('Connect Error (' . $mysqli->connect_errno . ') '
                . $mysqli->connect_error);
    }

    $query = 'SELECT * FROM properties WHERE id_item = '.$_POST['item']. ' AND date_ended IS NULL AND id_cat = '.$_SESSION['id_cat']. " AND id_territory = ". $_POST['territory'];
    $result = $mysqli->query($query);

    if($result->num_rows){
        echo $query = 'UPDATE properties SET count = ' . $_POST['count'] . ' WHERE id_item = '.$_POST['item']. ' AND date_ended IS NULL AND id_cat = '.$_SESSION['id_cat']. " AND id_territory = ". $_POST['territory'];
        $mysqli->query($query);
        header("Location: property.php");
        return;
    }

    $query = 'INSERT INTO properties(id_cat, id_territory, date_started, id_item, count ,leased) VALUES ('.$_SESSION['id_cat'].', '.$_POST['territory'].', "'.date("y-m-d").'" , '.$_POST['item'].', '.$_POST['count'] .', FALSE)';
    $mysqli->query($query);

    header("Location: property.php");





?>