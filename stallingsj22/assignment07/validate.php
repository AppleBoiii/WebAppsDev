<?php 

include "../../db.php";
session_start();



if(isset($_SESSION["username"])&&isset($_SESSION["phash"]))
{
    $username = $_SESSION["username"];
   
    $userID = $row['ID'];
    
    echo $userID;
}
else echo "";


?>
