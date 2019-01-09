
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

$query = 'SELECT * FROM lives WHERE id_cat ='.$_SESSION['id_cat'];
$result = $mysqli->query($query);

function getTerritory($territory){

    $mysqli = new mysqli('localhost', 'xflore02', 'arurhu8n', 'xflore02');
    if ($mysqli->connect_error) {
        die('Connect Error (' . $mysqli->connect_errno . ') '
                . $mysqli->connect_error);
    }
    
    if($territory == NULL){
        $query = 'SELECT name FROM territories';
        $resultTerritory = $mysqli->query($query);
        $return = "<form name=\"death\" action=\"newlife.php\" method=\"post\" onsubmit=\"return checkSubmit()\"><select id=\"deadTerritory\" name=\"deadTerritory\"><option value=\"nothing\">Select territory where you died</option>";
        while($rowTerritory = $resultTerritory->fetch_assoc()){
            $return = $return."<option value=\"".$rowTerritory['name']."\">".$rowTerritory['name']."</option>";
        }
        $return = $return . "</select>";
        return $return;
    }
    
    $query = 'SELECT * FROM territories WHERE id_territory ='.$territory;
    $resultTerritory = $mysqli->query($query);
    $rowTerritory = $resultTerritory->fetch_assoc();
    return $rowTerritory['name'];
}

function getLength($started, $ended){
    if($ended == NULL){
        return "STILL ALIVE";
    }
    $started = strtotime($started);
    $ended = strtotime($ended);

    return ($ended-$started)/(60*60*24);
}

function getReason($reason){
    if($reason == NULL){
        return "<input type=\"text\" name=\"deadReason\" required><input id =\"button\"type=\"submit\" value=\"Submit death\"></form>";
    }
    return $reason;
}
?>


    

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="CSS/welcomeCSS.css">
        <link rel="stylesheet" type="text/css" href="CSS/livesCSS.css">
        <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Abel" rel="stylesheet"> 
        <title>Catbook</title>
        <script>
            function checkSubmit(){
                var territory = document.forms["death"]["deadTerritory"].value;
                var reason = document.forms["death"]["deadReason"].value;

                if(territory == "nothing"){
                    alert("Choose territory where you died");
                    return false;
                }
                if(reason.length > 50){
                    alert("Reason must be less than 50 characters long");
                    return false;
                }
                return true;
            }
        
        </script>
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
                <li><a href="leased.php">Loans</a></li>
                <li id="selected"><a href="lives.php">Lives</a></li>
            </ul>
        </div>


            <table class="lives">
                <tr>
                    <th>ID</th>
                    <th>Born place</th>
                    <th>Death place</th>
                    <th>Life length (days)</th>
                    <th>Reason of Death</th>
                </tr>
                <?php 
                    $i=1;
                    while ($row = $result->fetch_assoc()) {
                        if($i%2 == 0){
                            echo "<tr id=\"r1\">";    
                        }
                        else{
                            echo "<tr id=\"r2\">";
                        }
                        echo "<td>".$i."</td>";
                        echo "<td>".getTerritory($row['territory_born'])."</td>";
                        echo "<td>".getTerritory($row['territory_died'])."</td>";
                        echo "<td>".getLength($row['date_started'], $row['date_end'])."</td>";
                        echo "<td>".getReason($row['reason'])."</td>";
                        echo "</tr>";
                        $i = $i+1;
                    }
                    
                
                
                
                
                ?>
            </table>






    </body>
</html>

