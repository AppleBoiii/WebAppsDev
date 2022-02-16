<!DOCTYPE html>
<html>

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
    <title>Riddle-Me This pt.2</title>
</head>

<body>
    <?php 
    
    $COOKIE_INFO = explode("&", $_COOKIE["USER_INFO"]);
    $name = $COOKIE_INFO[0];
    $email = $COOKIE_INFO[1];
    $dob = $COOKIE_INFO[2];
    
    $key = $COOKIE_INFO[3];
    $error = $answer = $hint = "";
    $color = 'red';
    $correct = false;
    
    
    if($key != "FF"){
        header("Location: cheater.php");
        die();
    }
    
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST["answer"])){
            $answer = strtoupper($_POST["answer"]);
            if(bin2hex($answer) == '53574147') {
                $error = "CORRECT";
                $correct = true;
            }

            else $error = "That's not correct!" ;
            
        }
    }
    
    if($correct) {
        $color = 'green';
        $key = $key.'EE';
        setcookie("USER_INFO" , $name."&".$email."&".$dob."&".$key, time() + (86400 * 30), "/");
        header('Location: puzzle3.php');
        die();
    }
    if(isset($_POST['button'])) $hint = "The answer may have to deal with their atomic symbols...";
    
    
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
        <a href="../assignment02/index.php">Assignment 02</a>
    </nav>

    <div>
        <p>Hello, <?php echo $name; ?></p>
        <p>Asking your birthday and email was completely useless information! Do not worry, it will be sold to the highest data mining company where ads specifically tailored for people like you will be created to spam every website you visit. In the meantime, let's solve some riddles. </p>

        <p>Just providing your email, date of birth, and name was the first step (way to go!). Now time for the next one:</p>

        <p>What do you get when you mix sulphur, tungsten, and silver?</p>


        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

            Answer: <input type="text" name="answer"> <span class="error" style="color: <?php echo $color; ?>;">*<?php echo $error; ?> </span> <br> <br>

            <input type="submit">
        </form>
        <p>To use a hint, hit the button below.</p>
        <form method="post">
            <input type="submit" name="button" value="Hint" />

        </form>
        <p><?php echo $hint; ?> </p>
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
