<?php
    
$servername = "localhost";
$username = "honga22";
$password = "PXLblu87!";
$dbname = "honga22";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  echo "db connection failed";
}

function getGet($s)
{
  if(isset($_GET[$s])) return $_GET[$s];
  die("fail: missing the $s variable");
  return 0;
}

$task=getGet("task");
$stmt = $conn->prepare("INSERT INTO chatbox (`task`) VALUES (?)");
$stmt->bind_param("s", $task);
$task=strip_tags($task);
$stmt->execute();

/*if(!empty($_GET['task'])) {
    $stmt = $conn->prepare("INSERT INTO chatbox (task) VALUES (?)");
    $stmt->bind_param("s", $task);
    $task=strip_tags($_GET['task']);
    $stmt->execute();   
    
}*/

$stmt->close();
$conn->close();

echo "success";