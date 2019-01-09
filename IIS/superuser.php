<?php 
session_start();

if($_SESSION['id_cat'] != -1){
    header("Location: login.html");
    return;
}

function ownerPicker(){
    $mysqli = new mysqli('localhost', 'xflore02', 'arurhu8n', 'xflore02');
    if ($mysqli->connect_error) {
        die('Connect Error (' . $mysqli->connect_errno . ') '
                . $mysqli->connect_error);
    }
    $query = 'SELECT id_owner, name FROM owners';
    $resultRace = $mysqli->query($query);
    $return = "<select class=\"owners\" name=\"owner\">";
    $return = $return."<option value=\"nothing\">Select owner to delete</option>";
    while($rowRace = $resultRace->fetch_assoc()){
        $return = $return."<option value=\"".$rowRace['id_owner']."\">ID ".$rowRace['id_owner']." ".$rowRace['name']."</option>";
    }
    $return = $return . "</select>";
    return $return;
}

function userPicker(){
$mysqli = new mysqli('localhost', 'xflore02', 'arurhu8n', 'xflore02');

    if ($mysqli->connect_error) {
        die('Connect Error (' . $mysqli->connect_errno . ') '
                . $mysqli->connect_error);
    }
    $query = 'SELECT id_cat, username FROM cats';
    $resultRace = $mysqli->query($query);
    $return = "<select class=\"owners\" name=\"user\">";
    $return = $return."<option value=\"nothing\">Select user to delete</option>";
    while($rowRace = $resultRace->fetch_assoc()){
        $return = $return."<option value=\"".$rowRace['id_cat']."\">".$rowRace['username']."</option>";
    }
    $return = $return . "</select>";
    return $return;
}

function racePicker(){
    $mysqli = new mysqli('localhost', 'xflore02', 'arurhu8n', 'xflore02');

    if ($mysqli->connect_error) {
        die('Connect Error (' . $mysqli->connect_errno . ') '
                . $mysqli->connect_error);
    }
    $query = 'SELECT id_race, name FROM races';
    $resultRace = $mysqli->query($query);
    $return = "<select class=\"races\" name=\"race\">";
    $return = $return."<option value=\"nothing\">Select Race</option>";
    while($rowRace = $resultRace->fetch_assoc()){
        $return = $return."<option value=\"".$rowRace['id_race']."\">".$rowRace['name']."</option>";
    }
    $return = $return . "</select>";
    return $return;
}





?>





<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link rel="stylesheet" type="text/css" href="CSS/welcomeCSS.css">
        <link rel="stylesheet" type="text/css" href="CSS/superuserCSS.css">
        <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Abel" rel="stylesheet">  
        <title>Catbook</title>
    </head>
    <body>
    <div class="upperpanel">
    <div class="catbook"><a id ="pagename">Catbook</a></div>
    <form class = "logout" action="logout.php"><input id="logoutbutton" type="submit" value="Logout"></form> 
    </div>

    <form class="newterritory" action="SUPERUSER/newterritory.php" method="post" ><input type="text" name="newterritory" required placeholder="New Territory"><input type="number" name="capacity" required placeholder="Capacity"><input type="submit" value="Submit Territory"></form>
    <form class="newitem" action="SUPERUSER/newitem.php" method="post"><input type="text" name="item" placeholder="New Item" required><input type="submit" value="Submit Item"></form>
    <form class="deleteTerritory" action="SUPERUSER/deleteterritory.php" method="post">
        <select id="territory" name="territory">
            <option value="nothing" selected>Select territory to delete</option>
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
        <input type = "submit" value="Delete Territory">
    </form>
    
    <form class="deleteItem" action="SUPERUSER/deleteitem.php" method="post">
        <select name="item">
            <option value="nothing" selected>Select item to delete</option>
                        <?php 
                            $mysqli = new mysqli('localhost', 'xflore02', 'arurhu8n', 'xflore02');
                            if ($mysqli->connect_error) {
                                die('Connect Error (' . $mysqli->connect_errno . ') '
                                        . $mysqli->connect_error);
                            }
                            $query = 'SELECT id_item, name FROM items';
                            $result = $mysqli->query($query);
                            while($row = $result->fetch_assoc()){
                                echo "<option value=\"".$row['id_item']."\">".$row['name']."</option>";
                            }
                        ?>
        </select>
        <input type="submit"value ="Delete Item">   
    </form>

    <form class="deleteOwner" action="SUPERUSER/deleteowner.php" method="post">
        <?php echo ownerPicker();?>
        <input type="submit"value ="Delete Owner">   
    </form>

    <form class="deleteUser" action="SUPERUSER/deleteuser.php" method="post">
        <?php echo userPicker();?>
        <input type="submit"value ="Delete User">   
    </form>
    <form class="deleteNews" action="SUPERUSER/deletenews.php"><input type="submit" value="Delete All News"></form>
    <form class="newOwner"action="SUPERUSER/newowner.php" method="post">
                <input class="owner" type="text" name ="ownerName" placeholder="Ownername" required><br>
                <input class="age" type="number" name ="ownerAge" placeholder="Age" min="1" required><br>
                <select name="gender"><option value="M">Male</option><option value="F">Female</option></select><br> 
                <input class="nickname" type="text" name ="nickname" placeholder="Nickname for cat" required><br>
                <input class="residence" type="text" name ="residence" placeholder="Residence" required><br>
                <?php echo racePicker().'<br>';?>
                <input class="formsub" type="submit" value="Submit new owner" required>
    </form>
    
    <form class="newRace"action="SUPERUSER/newrace.php" method="post">
                <input class="owner" type="text" name ="raceName" placeholder="Race Name" required><br>
                <input class="owner" type="text" name ="raceOrigin" placeholder="Race Origin" required><br>
                <input class="owner" type="text" name ="raceEyes" placeholder="Eyes Color " required><br>
                <input class="age" type="number" name ="fangLength" placeholder="Fang Length" min="1" required><br>
                <input class="formsub" type="submit" value="Submit new race" required>
    </form>
    

    </body>
</html>

