<?php
       
   function deleteDB($conn) {
    if(empty($_GET['delete'])) return;
    else {
        $sql = "DELETE FROM todo WHERE ID=".$_GET['delete'];
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

else deleteDB($conn);

header('Location: index.php?');


?>
