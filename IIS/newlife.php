<?php 
session_start();

$mysqli = new mysqli('localhost', 'xflore02', 'arurhu8n', 'xflore02');
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
}
echo '<p>Connection OK '. $mysqli->host_info.'</p>';
echo '<p>Server '.$mysqli->server_info.'</p>';




$query = 'SELECT id_territory FROM territories WHERE name = '. '"'.$_POST['deadTerritory'].'"';
$result = $mysqli->query($query); 
$row = $result->fetch_assoc();

$idterritory = $row['id_territory'];


$query = 'UPDATE lives SET territory_died = ' . $idterritory . ', reason = '. '"'. $_POST['deadReason'] . '"'. ", date_end =".'"'.date('Y-m-d').'"' ." WHERE reason IS NULL AND id_cat = ".$_SESSION['id_cat'];
$mysqli->query($query); 


$query = 'SELECT * FROM lives WHERE id_cat ='. $_SESSION['id_cat'];
$result = $mysqli->query($query);


if(mysqli_num_rows($result) < 9){
    echo $query = 'INSERT INTO lives (date_started, territory_born, id_cat) VALUES ('.'"'.date('Y-m-d').'" ,'.$idterritory.','.$_SESSION['id_cat'].')';
    $mysqli->query($query);
}


header('Location: lives.php');





?>