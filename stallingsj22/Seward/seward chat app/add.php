<?php

function getGet($s)
{
  if(isset($_GET[$s])) return $_GET[$s];
  die("fail: missing the $s variable");
  return 0;
}


include "../../db.php";


$task=getGet("task");
$stmt = $conn->prepare("INSERT INTO chips (`type`) VALUES (?)");
$stmt->bind_param("s", $task);
$task=strip_tags($task);
// set parameters and execute
$stmt->execute();
//~ echo "New records created successfully";
$stmt->close();
$conn->close();

echo "success";
