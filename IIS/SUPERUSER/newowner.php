<?php
    $mysqli = new mysqli('localhost', 'xflore02', 'arurhu8n', 'xflore02');
    if ($mysqli->connect_error) {
        die('Connect Error (' . $mysqli->connect_errno . ') '
                . $mysqli->connect_error);
    }
    echo $query = 'INSERT INTO owners (name, age, gender, catnickname, residence, id_race) VALUES ('.'"'.$_POST['ownerName'].'"'. ', '.$_POST['ownerAge']. ', '.'"'.$_POST['gender'].'"'.', '.'"'.$_POST['nickname'] .'"'.', '. '"'.$_POST['residence'].'"'.' , '.$_POST['race'].')';
    $result = $mysqli->query($query);
    
    $query = 'INSERT INTO news (content, date_created) VALUES("New owner: '. $_POST['ownerName'].'. From: '.$_POST['residence'].'", '.'"'.date("y-m-d").'")';
    $result = $mysqli->query($query);

    header("Location: ../superuser.php");

?>