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
$query = 'SELECT * FROM cats WHERE id_cat = '.'"'.$_SESSION['id_cat'].'"';
$result = $mysqli->query($query);
$row = $result->fetch_assoc();
$name = $row['name'];
$furpattern = $row['pattern'];
$furcolor = $row['color'];

$idrace = $row['id_race'];
$idowner = $row ['id_owner'];


$query = 'SELECT * FROM races WHERE id_race = '.$idrace;
$result = $mysqli->query($query);
$row = $result->fetch_assoc();
$racename = $row['name'];
$eyescolor = $row['eyes'];
$raceorigin = $row['origin'];
$fangslength = $row['fangs'];

$query = 'SELECT * FROM owners WHERE id_owner = '.$idowner;
$result = $mysqli->query($query);
$row = $result->fetch_assoc();
$query = 'SELECT name FROM races WHERE id_race = '.$row['id_race'];

$ownername = $row['name'];
$ownerage = $row['age'];
$ownergender = $row['gender'];
$ownercatnicname = $row['catnickname'];
$residence = $row['residence'];
$result = $mysqli->query($query);
$row = $result->fetch_assoc();
$ownerfavrace = $row['name'];


function ownerPicker(){
    $mysqli = new mysqli('localhost', 'xflore02', 'arurhu8n', 'xflore02');

    if ($mysqli->connect_error) {
        die('Connect Error (' . $mysqli->connect_errno . ') '
                . $mysqli->connect_error);
    }
    $query = 'SELECT id_owner, name, residence FROM owners';
    $resultRace = $mysqli->query($query);
    $return = "<select class=\"owners\" name=\"owner\">";
    $return = $return."<option value=\"nothing\">Select Your Owner</option>";
    while($rowRace = $resultRace->fetch_assoc()){
        $return = $return."<option value=\"".$rowRace['id_owner']."\">"."Name: ".$rowRace['name'].", Residence: ".$rowRace['residence']."</option>";
    }
    $return = $return . "</select>";
    return $return;
}

?>


<html>
    <head>
        <link rel="stylesheet" type="text/css" href="CSS/welcomeCSS.css">
        <link rel="stylesheet" type="text/css" href="CSS/profileCSS.css">
        <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Abel" rel="stylesheet"> 
        <title>Catbook</title>

        <script>
            function hideOwner(){
                var x = document.getElementById("ownerInfo");
                if (x.style.visibility === 'hidden') {
                    x.style.visibility = 'visible';
                } else {
                    x.style.visibility = 'hidden';
                }
            }
            function hideRace(){
                var x = document.getElementById("raceInfo")
                if (x.style.visibility === 'hidden') {
                    x.style.visibility = 'visible';
                } else {
                    x.style.visibility = 'hidden';
                }
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
            <li id="selected"><a href="profile.php">Profile</a></li>
            <li><a href="territories.php">Territories</a></li>
            <li><a href="property.php">Property</a></li>
            <li><a href="leased.php">Loans</a></li>
            <li><a href="lives.php">Lives</a></li>
        </ul>
    </div>
    <img src="avatar.jpg" alt="Mountain View">
        
        <ul id="catinfo">
            <li><a>Username: <?php echo $_SESSION['username'];?></a></li>
            <li><a>Name: <?php echo $name;?></a></li>
            <li><a>Fur pattern: <?php echo $furpattern;?></a></li>
            <li><a>Fur color: <?php echo $furcolor;?></a></li>
        </ul>

        <ul id="ownerinfo">
            <li><a>Owner Name: <?php echo $ownername;?></a></li>
            <li><a>Owner Age: <?php echo $ownerage;?></a></li>
            <li><a>Owner Gender: <?php echo $ownergender;?></a></li>
            <li><a>Owner's nickname for cat: <?php echo $ownercatnicname;?></a></li>
            <li><a>Owner's residence: <?php echo $residence;?></a></li>
            <li><a>Owner's favorite race: <?php echo $ownerfavrace;?></a></li>
        </ul>

        <ul id="raceinfo">
            <li><a>Race name: <?php echo $racename;?></a></li>
            <li><a>Race eyes color: <?php echo $eyescolor;?></a></li>
            <li><a>Race origin: <?php echo $raceorigin;?></a></li>
            <li><a>Race average fang length: <?php echo $fangslength;?> cm</a></li>
        </ul>
        


        <a id="need">Need a new owner?</a>
        <form action="changeowner.php" method="post">
            <?php echo  ownerPicker();?>
            <input id = "button" type="submit" value="Change owner">
        </form>





    </body>
</html>

