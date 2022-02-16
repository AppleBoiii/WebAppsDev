<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="../styles.css">
    <link rel="icon" href="../favicon.ico">
    <title>Riddle-Me This pt.3</title>
</head>

<body>
    <?php 
    
    $COOKIE_INFO = explode("&", $_COOKIE["USER_INFO"]);
    $name = $COOKIE_INFO[0];
    $email = $COOKIE_INFO[1];
    $dob = $COOKIE_INFO[2];
    
    $key = $COOKIE_INFO[3];
    $error = $hint = $answer = "";
    $color = 'red';
    $correct = false;
    $answer_arr = array();
    $real_answer = ((2**6)/2)-1;
    
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        for($i = 0;$i<7; $i++) {    
            if(isset($_POST[$i])) $answer_arr[$i] = 2**$i;
        }
        $answer = array_sum($answer_arr);
        
        
        
        
        if ($answer == $real_answer and !empty($answer_arr)) {
            $color = "green";
            $error = "That is the right answer!";
            $correct = true;
        }

        
        else if(!empty($answer_arr)) {
            $error = "That is not the correct answer.";
            $answer = "";
        }
        
        if(isset($_POST['button'])) $hint = "Binary is just base 2 idiot";
    }
    
    
    if($correct == true) {
        $key = $key."DD";
        setcookie("USER_INFO", $name."&".$email."&".$dob."&".$key, time() + (86400 * 30), "/");
        header("Location: winner.php");
        die();
        
        
    }
    
    
    
    if($key != "FFEE"){
        header("Location: cheater.php");
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
        <p>Below are various check boxes buttons. If a selected button is a 1 and an unselected button is a 0, what is ((2^6)/2)-1 in binary? Note: counting starts from the left and to the right. For example, 000001 is 1. </p>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

            <input type="checkbox" name="6" value="64">
            <input type="checkbox" name="5" value="32">
            <input type="checkbox" name="4" value="16">
            <input type="checkbox" name="3" value="8">
            <input type="checkbox" name="2" value="4">
            <input type="checkbox" name="1" value="2">
            <input type="checkbox" name="0" value="1">
            <span class="error" style="color: <?php echo $color; ?>;">*<?php echo $error; ?> </span>
            <br> <br>
            <input type="submit" value="Submit answer.">
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
