<?php

function redirect()
{
    header("Location: login.php");
    //~ die("access denied");
}

include "../../db.php";
session_start();

if(isset($_SESSION["username"])&&isset($_SESSION["hash"]))
{
    $username=$_SESSION["username"];
    $hash=$_SESSION["hash"];
    
    $stmt = $conn->prepare("SELECT password_hash FROM users WHERE username=? AND password_hash=?");
    $stmt->bind_param("ss", $username,$hash);
    $stmt->execute();
    $result = $stmt->get_result(); // get the mysqli result
    $row = $result->fetch_assoc();
    if($row);
    else redirect();
}
else redirect();
?>
