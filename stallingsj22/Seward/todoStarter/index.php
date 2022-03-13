<html>

<body>

<?php
$servername = "localhost";
$username = "sewardn";
$password = "squirrel";
$dbname = "sewardn";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  echo "db connection failed";
}
else
{
    $sql = "SELECT * FROM chips";
    $result = $conn->query($sql);

    while($row = $result->fetch_assoc()) 
    {
        echo $row['ID']." ".$row['type']." <br>";
    }


    $conn->close();
}
?>





<form action="index.php" method="GET">
<input type="text" name="task" />
<input type="hidden" name="action" value="add" />
<input type="submit" />
</form>


</body>



</html>
