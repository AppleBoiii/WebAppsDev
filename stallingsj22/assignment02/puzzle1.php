<!DOCTYPE html>


<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="../styles.css">
    <link rel="icon" href="../favicon.ico">
    <style>
        input {
            margin: 5px;
        }

        .error {
            color: red;
        }

    </style>
    <title>Riddle-Me This</title>
</head>

<body>
    <?php
    
    function clarify($data) {
        $data = trim($data);
        $data = stripslashes($data);
        return htmlspecialchars($data);
    }
    
    $nameError = $dobError = $emailError = $error = $name = $email = $dob = "";
    $continue = false;
    
    setcookie("USER_INFO", ""."&".""."&".""."&", time() + (86400 * 30), "/");
    
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(empty($_POST["name"]) or empty($_POST["email"]) or empty($_POST["dob"])) {
            $error = " You are missing one or more of the required fields.";
        }
        
    $name = clarify($_POST["name"]);
    if(!preg_match("/^[a-zA-Z-' ]/",$name) and !empty($name)){
        $nameError = "Incorrect name formatting.";
        $name = "";
    }


    $email = clarify($_POST["email"]);
    if(!filter_var(clarify($email), FILTER_VALIDATE_EMAIL) and !empty($email)) {
        $emailError = "Invalid email address.";
        $email = "";
    }

    $dob = $_POST["dob"];
    }
    
    if(!empty($name) and !empty($email) and !empty($dob) ) {
        header("Location: puzzle2.php");
        setcookie("USER_INFO", $name."&".$email."&".$dob."&FF", time() + (86400 * 30), "/");
        die();
    }

    
    ?>





    <div class="headerDiv">
        <h1>Riddle-Me This!</h1>
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
    </nav>


    <div>
        <p><strong>To begin, enter in the following biographical information. Names can only contain standard alphabetical letters. Email Addresses must contain an @ symbol. <?php echo $error ?></strong></p>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            Name: <input type="text" name="name"> <span class="error">*<?php echo $nameError; ?> </span> <br><br>

            Date of Birth: <input type="date" name="dob"> <span class="error">*<?php echo $dobError; ?></span> <br><br>

            Email Address: <input type="text" name="email"> <span class="error">*<?php echo $emailError; ?></span> <br><br>
            <input type="submit">
        </form>
    </div>

    <div>
        <?php 
    echo $name;
    echo "<br>";
    
    echo $email;
    echo "<br>";
    echo $dob;
    ?>
    </div>

    <script>
        function show() {
            if (document.getElementById("img").style.display === "none") {
                document.getElementById("img").style.display = "block";
            } else {
                document.getElementById("img").style.display = "none";
            }
        }

    </script>
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

</html>
