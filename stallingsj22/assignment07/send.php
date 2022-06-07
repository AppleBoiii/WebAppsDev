<?php
function getGet($x) {
    if(isset($_GET[$x])) {
        return $_GET[$x];
    }
    else return false;
    
}

include "../../db.php";

$msg = getGet("message");
$userID = getGet("username");

if($msg==false || $userID==false) echo "Something stupid happened";

$stmt = $conn->prepare("INSERT INTO msgs2 (userID, message) VALUES (?, ?)");
$stmt->bind_param('ss', $userID, $msg);

if($stmt->execute()){
    echo "Success!";
} 
else {
    echo "".htmlspecialchars($stmt->error());
}


$stmt->close();
$conn->close();



#

?>
