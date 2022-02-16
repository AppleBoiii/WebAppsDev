<html lang="en">

<head>
    <link rel="stylesheet" href="../styles.css">
    <style>
        /*         .header {
            border: 2px solid black;
            background-color: #e0e5e6;
        }
        
        body {
            background-color: #b5c1c4;
        }
        
        div {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 1%;
        } */

        .center2 {
            margin: auto;
            width: 50%;
        }

        table,
        th,
        td {
            border: 1px solid #b5c1c4;
            border-collapse: collapse;
            text-align: center;
        }

        th,
        td {
            background-color: #d1dbde;
            padding: 15px;
            height: 50px;
            width: 50px;
        }

        table {
            box-shadow: 1px 1px 20px grey;
        }

        td:hover {
            background-color: #b7c1c4;
        }

        button:hover {
            background-color: #a0b3b8;
        }

        button {
            background-color: #a8b3b5;
            margin-right: 5px;
            box-shadow: 1px 1px 20px grey;
        }

        a {
            color: black;
            text-decoration: none;
        }

    </style>
    <title>INFINITY COLUMNS</title>
</head>

<body>
    <div class="headerDiv">
        <h1>Exponetiation Table</h1>
    </div>

    <div class="center2">

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
            <table>
                <?php

            function science_notation($x) {
                $i = 0;
                while($x > 10) {
                    $x /= 10;
                    $i += 1;
                }
                $x = round($x, 3);

                return $x."E+".$i;

            }
            $ROWS = 5;
            $COLUMNS = 5;
            $row_data = "";
            if(isset($_GET["ROWS"])) $ROWS = $_GET["ROWS"];
            if(isset($_GET["COLUMNS"])) $COLUMNS = $_GET["COLUMNS"];

            for($i = 0; $i < $ROWS+1; $i++) { //+1 because  header row
                echo "<tr>";
                for($j = 0; $j < $COLUMNS+1; $j++) {
                    $pow = pow($i, $j);
                    $num = $pow >= pow(10, 6) ? science_notation($pow) : $pow;

                    if ($i==0 & $j==0) echo "<td></td>";
                    else if($i == 0 & $j > 0) echo "<th> {$j} </th>";
                    else if($i > 0 & $j == 0) echo "<td><b> $i </b></td>";
                    else echo "<td> ". $num ."</td>";
                }
                echo "</tr>";
            }
        ?>
            </table>
        </div>

        <div style="padding: 15px;">
            <button type="button"><a href="index.php?COLUMNS=<?=$COLUMNS+1?>&ROWS=<?=$ROWS?>">Add Column </a></button>
            <button type="button"><a href="index.php?COLUMNS=<?=$COLUMNS-1?>&ROWS=<?=$ROWS?>">Remove Column </a></button>
            <button type="button"><a href="index.php?COLUMNS=<?=$COLUMNS?>&ROWS=<?=$ROWS+1?>">Add Row </a></button>
            <button type="button"><a href="index.php?COLUMNS=<?=$COLUMNS?>&ROWS=<?=$ROWS-1?>">Remove Row </a></button>
        </div>

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

</html>
