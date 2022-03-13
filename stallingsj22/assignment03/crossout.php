<?php
    

    function checkComplete($conn) {
        if(empty($_GET['status'])) header('Location: index.php?');
        else {
            $sql = "UPDATE todo SET STATUS=(1 - STATUS) WHERE ID=".$_GET['status'];
            $result = $conn->query($sql);
            header("Location: index.php?");
            
        }
    }

    $username = "stallingsj22";
    $password = "password";
    $db = "stallingsj22";  
        
    $conn = new mysqli("localhost", $username, $password, $db);
    if($conn->connect_error) {
        header('Location: index.php?');
    }
    else {
        checkComplete($conn);
    }
    
header('Location: index.php?');

?>
