<?php

$year;
if(isset($_GET['year'])) {
    $year = $_GET['year'];
}
else {
    die("Error getting year");
}



include "../../db.php";

$sql = "SELECT * FROM `picpages` WHERE file LIKE '%$year%' ORDER BY 'name'";
$result = $conn->query($sql);


while($row = $result->fetch_assoc()) {
    $file_loc = $row['file'];
    if(strpos($file_loc, 'default') > 0) $file_loc = 'imgs/default.jpg';
    $name = $row['name'];
    echo "<div class='picture_div'> <img class='picture' src='$file_loc'/> <p>$name</p></div>";

}
?>