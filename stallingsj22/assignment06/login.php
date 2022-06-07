<?php 
function getInfo($s) {
    if(isset($_GET[$s])) return $_GET[$s];
    die("Error: Missing $s variable");
    return 0;
}

include '../../db.php';

$user = getInfo('user');

$stmt = $conn->prepare("INSERT INTO users (username) values (?)");
//$stmt = $conn->prepare(" IF NOT EXISTS(SELECT * FROM users WHERE username = ".$user.") INSERT INTO users (username) values (?) ");
$stmt->bind_param('s', $user);
$stmt->execute();

$stmt->close();
$conn->close();


?>
