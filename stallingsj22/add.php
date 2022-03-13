<?php
$chiptype="";
if(isset($_GET["chiptype"])) $chiptype=$_GET["chiptype"];
else
{
    header("Location: index.php");
}




$servername = "localhost";
$username = "sewardn";
$password = "squirrel";
$dbname = "sewardn";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  //~ die("Connection failed: " . $conn->connect_error);
  header("Location: index.php");
}

// prepare and bind
$stmt = $conn->prepare("INSERT INTO chips (`type`) VALUES (?)");
$stmt->bind_param("s", $chiptype);
$chiptype=strip_tags($chiptype);
// set parameters and execute
$stmt->execute();




//~ echo "New records created successfully";

$stmt->close();
$conn->close();

header("Location: index.php");

?>
