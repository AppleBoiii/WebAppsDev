<!DOCTYPE html>


<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="../styles.css">
    <link rel="icon" type="image/x-icon" href="./favicon.ico">
    <style>
        input {
            margin: 5px;
        }

        .error {
            color: red;
        }

    </style>
    <title>To Do List</title>
</head>


<body>
    <div class="headerDiv">
        <h1>To-Do List</h1>
        <!-- 
    <img src="test.jpg" alt="Pic of me here." class="center"> -->
    </div>

    <nav>
        <img src="../transparent-blink.gif" alt="Blinking eye gif">
        <a href="../index.php">Home</a>

        <a href="#" class="dropDown-button"> Assignment 00</a>
        <div class="dropDown">
            <a href="../assignment00/index.html"><small>Biography</small></a>
            <a href="../assignment00/schedule.html"><small>My Class Schedule</small></a>
            <a href="../assignment00/sites.html"><small>External Sites</small></a>
        </div>
        <a href="../assignment01/index.php">Assignment 01</a>
        <a href="../assignment02/puzzle1.php">Assignment 02</a>
        <a href="../assignment03/index.php">Assignment 03</a>
    </nav>


    <div>
        <?php 

    function clarify($data) {
        $data = trim($data);
        $data = stripslashes($data);
        return htmlspecialchars($data);
    }
    function makeTable() {
        $conn = new mysqli("localhost", "stallingsj22", "password", "stallingsj22");

        if($conn->connect_error) {
            die("Connection failed: ".$conn->connect_error);
        }

        else {
            echo "<div> <p> connected successfully </p> </div>";
        }


        $query = "SELECT * FROM todo";
        $result = $conn->query($query);

        echo "<table>";

        echo "<tr> <th>Assignment</th> <th>Info</th> <th>Due</th> <th>Status</th> </tr>";

        while($row = $result->fetch_assoc()) {
            echo "<tr><td>".htmlspecialchars($row['NAME'])."</td><td>".htmlspecialchars($row['ABOUT'])."</td><td>".htmlspecialchars($row['DATE'])."</td><td>".htmlspecialchars($row['STATUS'])."</td></tr>";

        }

        echo "</table>";
        $conn->close();    
    }
    function updateTable($user, $pass, $db) {
        if(empty($_POST["name"])) return;
        
        $name = clarify($_POST["name"]);
        $about = "";
        $due = "";
        
        if(!empty($_POST["about"])) $about = $_POST["about"];
        if(!empty($_POST["due"])) $due = $_POST["due"];
        
        $conn = new mysqli("localhost", $user, $pass, $db);
                if($conn->connect_error) {
            die("Connection failed: ".$conn->connect_error);
        }

        else {
            $query = "INSERT INTO todo (ID, NAME, ABOUT, DATE, STATUS) VALUES (NULL, ".$name.", ".$about.", ".$due.", NULL)";
            $conn->query($query);
            return;
        }
    }
    
    $username = "stallingsj22";
    $password = "password";
    $db = "stallingsj22";
    updateTable($username, $password, $db);
    makeTable();

?>
    </div>

    <div>
        <form method="post" action="<?php echo htmlspecialchars($_server["PHP_SELF"]);?>">
            Name: <input type="text" name="name"> <span class="error">*</span> <br><br>

            About: <input type="text" name="about"> <br><br>

            Due By: <input type="date" name="due"> <br><br>
            <input type="submit">

        </form>

    </div>









    <script>
        var dropdown = document.getElementsByClassName("dropDown-button");
        for (var i = 0; i < dropdown.length; i++) {
            dropdown[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var dropdownContent = this.nextElementSibling;
                if (dropdownContent.style.display === "block") {
                    dropdownContent.style.display = "none";
                } else {
                    dropdownContent.style.display = "block";
                }
            });
        }

    </script>
</body>
