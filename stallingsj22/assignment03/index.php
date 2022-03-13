<!DOCTYPE html>

<?php 
   function clarify($data) {
        $data = trim($data);
        $data = stripslashes($data);
        return htmlspecialchars($data);
    }

    function makeTable($conn) {
        $table = "";

        $query = "SELECT * FROM todo";
        $result = $conn->query($query);

        $table.="<table> <tr> <th>Name</th> <th>About</th></tr>";

        while($row = $result->fetch_assoc()) {
            $status = htmlspecialchars($row['STATUS']) == 1 ? 'strikeout' : '';
            
            $table.="<tr><td class='".$status."'><span style='display: none;'>".htmlspecialchars($row['ID'])."</span>".htmlspecialchars($row['NAME'])."</td><td class='".$status."'>".htmlspecialchars($row['ABOUT'])."</td><td>".drawDeletebtn($row['ID'])."</td></tr>";

        }

        $table.="</table>";   
        
        return $table;
    }
        
    function updateDB($conn) {
        
        $stmt = $conn->prepare("INSERT INTO todo (NAME, ABOUT, DATE) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $about, $due);
        
        if(empty($_POST["name"])) return;
        $name = clarify($_POST["name"]);
        $about = NULL;
        $due = NULL;
        
        if(!empty($_POST["about"])) $about = $_POST["about"];
        if(!empty($_POST["due"])) $due = $_POST["due"];
        
        
        if($stmt->execute() === FALSE) echo "<div> ERROR </div> ";
        
        $statusChange = NULL;
        if(!empty($_GET["id"])) {
            $statusChange = $_GET["id"];
            
            $stmt = $conn->prepare("DELETE FROM todo WHERE ID=(?)");
            $stmt->bind_param("i", $statusChange);
            if($stmt->execute() === FALSE) echo "<div> ERROR </div> ";
            
            
        }
        #echo "<div> updating table... </div>";
        $stmt->close();
        $conn->close();
        
        header("Location: index.php?");
    }  

    function drawDeletebtn($ID) {
        return #$"<form method='post' style='background-color: inherit;'> 
        
        #<button class='complete' name='status' type='submit' value='".$ID."'>MARK DONE</button>
        
        #<button class='delete' name='delete' type='submit' value='".$ID."'>DELETE</button> 
        
        #</form>
        
        "
        
        <a href='./crossout.php?status=".$ID."'> <img class='homeImage' src='https://upload.wikimedia.org/wikipedia/commons/c/c6/Sign-check-icon.png' alt='Mark item Finished Button Link'></a>
        <br>
        <a href='./delete.php?delete=".$ID."'> <img class='homeImage' src='https://upload.wikimedia.org/wikipedia/commons/thumb/a/a3/Delete-button.svg/862px-Delete-button.svg.png' alt='Delete Item Button Link'></a>
        ";
    }    
    
    $username = "stallingsj22";
    $password = "password";
    $db = "stallingsj22";  
        
    $conn = new mysqli("localhost", $username, $password, $db);
    if($conn->connect_error) {
    die("Connection failed: ".$conn->connect_error);
    }
?>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="./styles.css">
    <link rel="icon" type="image/x-icon" href="./favicon.ico">
    <style>

    </style>
    <title>To Do List</title>
</head>


<body>
    <div class="headerDiv">
        <h1>To-Do List</h1>
        <!-- 
    <img src="test.jpg" alt="Pic of me here." class="center"> -->
    </div>


    <div class='todoDiv'>
        <?php 
    $table = makeTable($conn);
    echo $table;
    
    updateDB($conn);
        
    $conn->close();
?>
    </div>


    <div class='inputDiv'>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <input style='margin-left: 10px;' type="text" name="name" placeholder="Name.."> <span class="error">*</span> <br>
            <input type="text" name="about" placeholder="About..."> <br>
            <input type="submit" value="Add">
        </form>

        <br> <br>
        <a href='../index.php'> <img class='homeImage' src='https://cdn-icons-png.flaticon.com/512/60/60817.png' alt='Home Button Link'></a>

    </div>

</body>
