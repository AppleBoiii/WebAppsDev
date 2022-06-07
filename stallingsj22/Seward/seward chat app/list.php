<?php


include "../../db.php";

$sql = "SELECT * FROM chips";
$result = $conn->query($sql);
$i=1;
echo "<ol>";
while($row = $result->fetch_assoc()) 
{
    $type=$row['type'];
    $id=$row['ID'];
    echo "<li>$type
      <span class='glyphicon glyphicon-trash' onclick='remove($id);'></span>
    </li>";
    $i++;
}
echo "</ol>";


$conn->close();
?>
