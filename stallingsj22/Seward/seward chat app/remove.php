<?php

function getGet($s)
{
  if(isset($_GET[$s])) return $_GET[$s];
  die("fail: missing the $s variable");
  return 0;
}


include "../../db.php";


$id=getGet("id");
$stmt = $conn->prepare("DELETE FROM chips WHERE ID=?");
$stmt->bind_param("i", $id);

// set parameters and execute
$stmt->execute();
//~ echo "New records created successfully";
$stmt->close();
$conn->close();

echo "success";
