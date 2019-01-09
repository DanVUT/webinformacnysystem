<?php
/*    Using "mysqli" instead of "mysql" that is obsolete.
* Change the value of parameter 3 if you have set a password on the root userid
* Add port number 3307 in parameter number 5 to use MariaDB instead of MySQL
*
*     Utilisation de "mysqli" � la place de "mysql" qui est obsol�te.
* Changer la valeur du 3e param�tre si vous avez mis un mot de passe � root
* Ajouter le port 3307 en param�tre 5 si vous voulez utiliser MariaDB
*/
session_start();

$mysqli = new mysqli('localhost', 'xflore02', 'arurhu8n', 'xflore02');

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
}
echo '<p>Connection OK '. $mysqli->host_info.'</p>';
echo '<p>Server '.$mysqli->server_info.'</p>';


$username = '"'.$_POST["Username"].'"';
$password = $_POST["Password"];
$query = 'SELECT name,id_cat, username, password, id_owner FROM cats WHERE username ='.$username;
$result = $mysqli->query($query);
if($result){
    $row = $result->fetch_assoc();
    //echo $row['password'].'<br>';
    if ($username === '"admin"' && $password === "Catbook123"){
        $_SESSION['id_cat'] = -1;
        header('Location: superuser.php');
    }
    else if ($password === $row["password"]) {
        header('Location: welcome.php');
        $_SESSION['id_cat']= $row['id_cat'];
        $_SESSION['username'] = $_POST["Username"];
        $_SESSION['id_owner'] = $row['id_owner'];
        $_SESSION['name'] = $row['name'];
    }
    else {
        header('Location: loginE.html');

    }

}
else{
    header('Location: loginE.html');
}




//$row = $result->fetch_assoc();
//echo '<p>'.$row['username'].'</p>';
$mysqli->close();
?>
