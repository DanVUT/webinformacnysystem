
<?php 
session_start();
if(empty($_SESSION['id_cat'])){
    header("Location: index.html");
}
$mysqli = new mysqli('localhost', 'xflore02', 'arurhu8n', 'xflore02');

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
}

$query = 'DELETE FROM news WHERE date_created > '. '"'. date('y-m-d', strtotime('+7 days')) . '"';
$result = $mysqli->query($query);
$query = 'SELECT * FROM news';
$result = $mysqli->query($query);

?>

<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link rel="stylesheet" type="text/css" href="CSS/welcomeCSS.css">
        <link rel="stylesheet" type="text/css" href="CSS/newsCSS.css">
        <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Abel" rel="stylesheet">  
        <title>Catbook</title>
    </head>
    <body>
    <div class="upperpanel">
    <div class="catbook"><a id ="pagename">Catbook</a></div>
    <form class = "logout" action="logout.php"><input id="logoutbutton" type="submit" value="Logout"></form> 
    </div>
        
        <div class="menu">
            <ul>
                <li id="selected"><a href="welcome.php">News</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="territories.php">Territories</a></li>
                <li><a href="property.php">Property</a></li>
                <li><a href="leased.php">Loans</a></li>
                <li><a href="lives.php">Lives</a></li>
            </ul>
        </div>

        <?php 
            while($row = $result->fetch_assoc()){
                echo "<p>".$row['content']."</p>";
            }
        ?>





    </body>
</html>

