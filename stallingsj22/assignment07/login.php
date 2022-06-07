<?php 
function getPost($x) {
    if(isset($_POST[$x])) {
        return $_POST[$x];
    }
    else return false;
    
}

include "../../db.php";

$username = getPost('username');
$password = getPost('password');

if($username == false || $password == false) echo "Error";

$stmt = $conn->prepare("SELECT password_hash FROM users2 WHERE username=?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$hash = $row['password_hash'];

if(password_verify($password, $hash)) {
    session_start();
    $_SESSION['username'] = $username;
    $_SESSION['phash'] = $hash;

    echo "Success!";
}
else {
    echo "Error";
}


?>
