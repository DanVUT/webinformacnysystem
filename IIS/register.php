<?php 
    function placesPicker(){
	$mysqli = new mysqli('localhost', 'xflore02', 'arurhu8n', 'xflore02');

        if ($mysqli->connect_error) {
            die('Connect Error (' . $mysqli->connect_errno . ') '
                    . $mysqli->connect_error);
        }
        $query = 'SELECT id_territory, name FROM territories';
        $resultTerritory = $mysqli->query($query);
        $return = "<select class=\"territories\" name=\"bornTerritory\">";
        $return = $return."<option value=\"nothing\">Select Born Territory</option>";
        while($rowTerritory = $resultTerritory->fetch_assoc()){
            $return = $return."<option value=\"".$rowTerritory['id_territory']."\">".$rowTerritory['name']."</option>";
        }
        $return = $return . "</select>";
        return $return;
    }

    function patternPicker(){
        $return = "<select class=\"patterns\" name=\"pattern\">";
        $return = $return."<option value=\"nothing\">Select Pattern</option>";
        $return = $return."<option value=\"Solid\">Solid</option>";
        $return = $return."<option value=\"Tabby\">Tabby</option>";
        $return = $return."<option value=\"Bicolor\">Bicolor</option>";
        $return = $return."<option value=\"Tortoiseshell\">Tortoiseshell</option>";
        $return = $return."<option value=\"Calico\">Calico</option>";
        $return = $return."<option value=\"Colorpoint\">Colorpoint</option>";
        $return = $return . "</select>";
        return $return;
    }

    function colorPicker(){
        $return = "<select class=\"colors\" name=\"color\">";
        $return = $return."<option value=\"nothing\">Select Color</option>";
        $return = $return."<option value=\"White\">White</option>";
        $return = $return."<option value=\"Black\">Black</option>";
        $return = $return."<option value=\"Red\">Red</option>";
        $return = $return."<option value=\"Blue\">Blue</option>";
        $return = $return."<option value=\"Cream\">Cream</option>";
        $return = $return."<option value=\"Brown\">Brown</option>";
        $return = $return."<option value=\"Cinnamon\">Cinnamon</option>";
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

    function ownerPicker(){
        $mysqli = new mysqli('localhost', 'xflore02', 'arurhu8n', 'xflore02');
        if ($mysqli->connect_error) {
            die('Connect Error (' . $mysqli->connect_errno . ') '
                    . $mysqli->connect_error);
        }
        $query = 'SELECT id_owner, name FROM owners';
        $resultRace = $mysqli->query($query);
        $return = "<select class=\"owners\" name=\"owner\">";
        $return = $return."<option value=\"nothing\">Select Your Owner</option>";
        while($rowRace = $resultRace->fetch_assoc()){
            $return = $return."<option value=\"".$rowRace['id_owner']."\">".$rowRace['name']."</option>";
        }
        $return = $return . "</select>";
        return $return;
    }
    

?>

<html>
    <head>
        <title>Register</title>
        <link rel="stylesheet" type="text/css" href = "CSS/registerCSS.css">
        
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script>
        $( function() {
            $( "#datepicker" ).datepicker({dateFormat:"yy-mm-dd"});
        } );
        </script>
        <script type="text/javascript">
        function validateForm() {
            var username = document.forms["register"]["Username"].value;
            var password = document.forms["register"]["Password"].value;
            var name = document.forms["register"]["name"].value;
            var born = document.forms["register"]["datepicker"].value;
            var pattern = document.forms["register"]["pattern"].value;
            var race = document.forms["register"]["race"].value;
            var owner = document.forms["register"]["owner"].value;
            var color = document.forms["register"]["color"].value;
            var territory = document.forms["register"]["bornTerritory"].value;
            if (username == "") {
                alert("Username must be filled out");
                return false;
            }
            if (!username.match(/^[0-9a-zA-Z]+$/)){
                alert("Username must contain only alphanumeric characters");
                return false;     
            }
            if (username.length > 50){
                alert("Username must be less than 50 characters long");
                return false;     
            }
            if(password == "") {
                alert("Password must be filled out");
                return false;
            }
            if (!password.match(/^[0-9a-zA-Z]+$/)){
                alert("Password must contain only alphanumeric characters");
                return false;     
            }
            if (password.length < 6){
                alert("Password must have at least 6 characters");
                return false;     
            }
            if (password.length > 50){
                alert("Password must be less than 50 characters long");
                return false;     
            }
            if (name == "") {
                alert("Username must be filled out");
                return false;
            }
            if (name.length > 50) {
                alert("Name must be less than 50 characters long");
                return false;
            }
            if (!name.match(/^[0-9a-zA-Z]+$/)){
                alert("Catname must contain only alphanumeric characters");
                return false;     
            }
            if (born == "") {
                alert("Born date must be filled out");
                return false;
            }
            if (pattern == "nothing") {
                alert("Pattern must be selected");
                return false;
            }
            if (race == "nothing") {
                alert("Race must be selected");
                return false;
            }
            if (owner == "nothing") {
                alert("Owner must be selected");
                return false;
            }
            if (color == "nothing") {
                alert("Color must be selected");
                return false;
            }
            if (territory == "nothing") {
                alert("Born territory must be selected");
                return false;
            }
        }
        </script>
    </head>
    
    <body>
     
    <?php 
        if(isset($_GET['e'])){
            if($_GET['e'] == 1){
                echo "<p class=\"error\">Fill all fields</p>";
            }
            if($_GET['e'] == 2){
                echo "<p class=\"error\">User already exists</p>";
            }
        }
    
    ?> 
    <div class="register">
            <form name = "register" onsubmit="return validateForm()" action="newaccount.php" method="post">
                <input class="user" type="text" name ="Username" placeholder="Username"><br>
                <input class="pass" type="password" name ="Password" placeholder="Password"><br>
                <input class="name" type="text" name ="name" placeholder="Name"><br>
                <input class="born" type="text" id="datepicker" name = "BornDate" placeholder="Born"><br>
                <?php echo racePicker().'<br>';?>
                <?php echo patternPicker().'<br>';?>
                <?php echo colorPicker().'<br>';?>
                <?php echo placesPicker().'<br>';?>
                <?php echo ownerPicker().'<br>';?>
                <input class="formsub" type="submit" value="Register">
            </form>
            <p class="already">Already got an account? <a href="index.html">Click here</a></p>
    </div>
     
    </body>
</html>