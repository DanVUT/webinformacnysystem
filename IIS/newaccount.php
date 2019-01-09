<?php
    if($_POST['Username'] == "" || $_POST['Password'] == "" || $_POST['owner'] == "nothing" || $_POST['BornDate'] == "" || $_POST['name'] == "" || $_POST['bornTerritory'] == "nothing" || $_POST['race'] == "nothing" || $_POST['pattern'] == "nothing" || $_POST['color'] == "nothing"){
        header('Location: register.php?e=1');
        return;
    }

    
    $mysqli = new mysqli('localhost', 'xflore02', 'arurhu8n', 'xflore02');
    if ($mysqli->connect_error) {
        die('Connect Error (' . $mysqli->connect_errno . ') '
                . $mysqli->connect_error);
    }
    $query = 'SELECT * FROM cats WHERE username = '. '"'.$_POST['Username'].'"';
    $result = $mysqli->query($query);
    if($result->num_rows){
        header('Location: register.php?e=2');
        return;
    }

    $query = 'INSERT INTO cats (id_race, name, pattern, color, id_owner, username, password) VALUES ('.$_POST['race'].','.'"'.$_POST['name'].'"'.','.'"'.$_POST['pattern'].'"'.','.'"'.$_POST['color'].'"'.','.$_POST['owner'].','.'"'.$_POST['Username'].'"'.','.'"'.$_POST['Password'].'")';                
    $mysqli->query($query);

    $query = 'SELECT id_cat FROM cats WHERE username ='.'"'.$_POST['Username'].'"';
    $result = $mysqli->query($query);
    $row = $result->fetch_assoc();
    $idcat = $row['id_cat'];

    $query = 'INSERT INTO lives (id_cat, territory_born, date_started) VALUES ('.$idcat.",".$_POST['bornTerritory'].",".'"'.$_POST['BornDate'].'")';
    $mysqli->query($query);

    header('Location: index.html');




?>