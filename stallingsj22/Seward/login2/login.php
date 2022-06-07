<?php

include "../../db.php";
if(isset($_POST["username"])&&isset($_POST["password"]))
{
    $username=$_POST["username"];
    $password=$_POST["password"];
    
    $stmt = $conn->prepare("SELECT password_hash FROM users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result(); // get the mysqli result
    $row = $result->fetch_assoc();
    $hash=$row['password_hash'];
    if(password_verify($password,$hash))
    {
        session_start();
        $_SESSION["username"]=$username;
        $_SESSION["hash"]=$hash;
        
        header("Location: index.php");
    }
    else
    {
        die("bad password");
    }
}

?>
<html>

<body>

<form action="" method="POST">
<input type="text" name="username" />
<input type="password" name="password" />
<input type="submit" />
</form>

</body>


</html>
