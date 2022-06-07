<?php 

function getInfo($s) {
    if(isset($_GET[$s])) return $_GET[$s];
    die("Error: Missing $s variable");
    return 0;
}

include '../../db.php';
 
$msg = getInfo('msg');
$user = getInfo('user');

/*
$userID;
$stmt = "SELECT userid FROM users WHERE username=".$user;
$result = $conn->query($stmt);
$userID = $result->fetch_assoc();
*/
$stmt = $conn->prepare('INSERT INTO messages (text, userid) VALUES (?, ?)');
$stmt->bind_param('ss', $msg, $userID);
$userID = $user;
$stmt->execute();

$stmt->close();
$conn->close();




?>
