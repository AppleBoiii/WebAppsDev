<?php
//~ $chiptype="";
//~ if(isset($_GET["chiptype"])) $chiptype=$_GET["chiptype"];
//~ else
//~ {
    //~ header("Location: index.php");
//~ }

function getGet($s)
{
  if(isset($_GET[$s])) return $_GET[$s];
  else header("Location: error.php");
  return 0;
}


$action=getGet("action");





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
if($action=="add")
{
  $task=getGet("task");
  $stmt = $conn->prepare("INSERT INTO chips (`type`) VALUES (?)");
  $stmt->bind_param("s", $task);
  $task=strip_tags($task);
  // set parameters and execute
  $stmt->execute();
  //~ echo "New records created successfully";
  $stmt->close();
}
if($action=="delete")
{
  $taskid=getGet("taskid");
  $stmt = $conn->prepare("DELETE FROM chips WHERE ID=?");
  $stmt->bind_param("i", $taskid);
  $stmt->execute();
  $stmt->close();
}



$conn->close();

header("Location: index.php");


//<a href='index.php'>back</a>
?>
