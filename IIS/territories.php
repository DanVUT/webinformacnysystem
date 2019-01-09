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
    
    $query = 'SELECT * FROM occupation WHERE date_ended IS NULL AND id_cat ='.$_SESSION['id_cat'];
    $result1 = $mysqli->query($query);

    $query = 'SELECT * FROM occupation WHERE date_ended IS NOT NULL AND id_cat ='.$_SESSION['id_cat'];
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

?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="CSS/welcomeCSS.css">
        <link rel="stylesheet" type="text/css" href="CSS/territoriesCSS.css">
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
        <li id="selected"><a href="territories.php">Territories</a></li>
        <li><a href="property.php">Property</a></li>
        <li><a href="leased.php">Loans</a></li>
        <li><a href="lives.php">Lives</a></li>
    </ul>
</div>
            <?php if(isset($_GET['e'])){
                if($_GET['e']==1){
                    echo "<p id=\"error\">You aleady occupy that territory</p>";
                }   
                else if ($_GET['e']==2){
                    echo "<p id=\"error\">Territory is full</p>";
                }
            }    
            ?>

            <form class="newOccupation"action="newoccupation.php" method="post">
                <select id="territory" name="territory">
                    <?php 
                        $mysqli = new mysqli('localhost', 'xflore02', 'arurhu8n', 'xflore02');
                        if ($mysqli->connect_error) {
                            die('Connect Error (' . $mysqli->connect_errno . ') '
                                    . $mysqli->connect_error);
                        }
                        $query = 'SELECT id_territory, name FROM territories';
                        $result = $mysqli->query($query);
                        while($row = $result->fetch_assoc()){
                            echo "<option value=\"".$row['id_territory']."\">".$row['name']."</option>";
                        }
                    ?>
                </select>
                <input id="newOccupationButton" type = "submit" value="Submit New Occupation">
            </form>

            <form action="editterritories.php" method="post">
                <table class="currentTerritories" cellspacing="0" cellspadding="0">
                    <tr>
                        <th>ID</th>
                        <th>Territory</th>
                        <th>Occupied Since</th>
                        <th>End Occupation</th>
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
                    
                    //echo "<tr>";
                        echo "<td>".$i."</td>";
                        echo "<td>".getTerritory($row['id_territory'])."</td>";
                        echo "<td>".$row['date_started']."</td>";
                        echo "<td>"."<input type=\"checkbox\" name=\"checkboxes[]\" value=\"".$row['id']."\">"."</td>";
                    echo "</tr>";
                    $i = $i + 1;
                    }
                    ?>
                </table>
                <input class="subform" type="submit" value = "Submit changes">
            </form>
            

            <table class="historyTerritories">
                    <tr>
                        <th>ID</th>
                        <th>Territory</th>
                        <th>Occupied Since</th>
                        <th>Occupied Until</th>
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
                    //echo "<tr>";
                        echo "<td>".$i."</td>";
                        echo "<td>".getTerritory($row['id_territory'])."</td>";
                        echo "<td>".$row['date_started']."</td>";
                        echo "<td>".$row['date_ended']."</td>";;
                    echo "</tr>";
                    $i = $i + 1;
                    }
                    ?>
            </table>





    </body>
</html>

