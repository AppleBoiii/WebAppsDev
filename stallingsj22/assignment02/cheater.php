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
    <title>CHEATER</title>
</head>

<body>
    <?php 
    
    $COOKIE_INFO = explode("&", $_COOKIE["USER_INFO"]);
    $name = $COOKIE_INFO[0];
    $email = $COOKIE_INFO[1];
    $dob = $COOKIE_INFO[2];
    $key = $COOKIE_INFO[3];
    ?>



    <div class="headerDiv">
        <h1 style="color: red;">CHEATER!</h1>
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
        <p>Congrats. You cheated - and got caught!</p>
        <p>Instead of making it so that you can no longer play the game until your cookies expire, you will be allowed to retry the game. Please do not try to cheat any more because it is not fun. </p>


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
