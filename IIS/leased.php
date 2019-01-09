
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

$query = 'SELECT * FROM properties WHERE leased = FALSE AND date_ended IS NULL AND id_cat ='.$_SESSION['id_cat'];
$result1 = $mysqli->query($query);

$query = 'SELECT * FROM properties WHERE leased = TRUE AND date_ended IS NULL AND id_cat ='.$_SESSION['id_cat'];
$result2 = $mysqli->query($query);

function getTerritory($territory){
    $mysqli = new mysqli('localhost', 'xflore02', 'arurhu8n', 'xflore02');
    if ($mysqli->connect_error) {
        die('Connect Error (' . $mysqli->connect_errno . ') '
                . $mysqli->connect_error);
    }            

    $query = 'SELECT * FROM territories WHERE id_territory ='.$territory;
    $resultTerritory = $mysqli->query($query);
    $rowTerritory = $resultTerritory->fetch_assoc();

    return $rowTerritory['name'];
}

function getItem($item){
    $mysqli = new mysqli('localhost', 'xflore02', 'arurhu8n', 'xflore02');
    if ($mysqli->connect_error) {
        die('Connect Error (' . $mysqli->connect_errno . ') '
                . $mysqli->connect_error);
    }            

    $query = 'SELECT * FROM items WHERE id_item ='.$item;
    $resultItem = $mysqli->query($query);
    $rowItem = $resultItem->fetch_assoc();

    return $rowItem['name'];
}



?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="CSS/welcomeCSS.css">
        <link rel="stylesheet" type="text/css" href="CSS/leaseCSS.css">
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
            <li><a href="welcome.php">News</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="territories.php">Territories</a></li>
            <li><a href="property.php">Property</a></li>
            <li id="selected"><a href="leased.php">Loans</a></li>
            <li><a href="lives.php">Lives</a></li>
        </ul>
    </div>



            <form action="newlease.php" method="post">
                <table class = "properties">
                    <tr>
                        <th>ID</th>
                        <th>Property</th>
                        <th>Territory</th>
                        <th>Lease to host</th>
                    </tr>
                    <?php
                    $i = 1;
                    while($row = $result1->fetch_assoc()){
                    if($i%2 == 0){
                        echo "<tr id=\"r1\">";    
                    }
                    else{
                        echo "<tr id=\"r2\">";
                    }
                        echo "<td>".$i."</td>";
                        echo "<td>".getItem($row['id_item'])."</td>";
                        echo "<td>".getTerritory($row['id_territory'])."</td>";
                        echo "<td>"."<input type=\"checkbox\" name=\"checkboxes[]\" value=\"".$row['id']."\">"."</td>";
                    echo "</tr>";
                    $i = $i + 1;
                    }
                    ?>
                </table>
                <input class="subform1" type="submit" value = "Submit changes">
            </form>


            <form action="deletelease.php" method="post">
                <table class = "leases">
                    <tr>
                        <th>ID</th>
                        <th>Property</th>
                        <th>Territory</th>
                        <th>End Leasing</th>
                    </tr>
                    <?php
                    $i = 1;
                    while($row = $result2->fetch_assoc()){
                    if($i%2 == 0){
                        echo "<tr id=\"r1\">";    
                    }
                    else{
                        echo "<tr id=\"r2\">";
                    }
                        echo "<td>".$i."</td>";
                        echo "<td>".getItem($row['id_item'])."</td>";
                        echo "<td>".getTerritory($row['id_territory'])."</td>";
                        echo "<td>"."<input type=\"checkbox\" name=\"checkboxes[]\" value=\"".$row['id']."\">"."</td>";
                    echo "</tr>";
                    $i = $i + 1;
                    }
                    ?>
                </table>
                <input class="subform2" type="submit" value = "Submit changes">
            </form>








    </body>
</html>

