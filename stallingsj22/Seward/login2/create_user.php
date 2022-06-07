<?php
$msg="";
if(isset($_POST["username"])&&isset($_POST["ps1"])&&isset($_POST["ps1"]))
{
    include "../../db.php";
    $username=$_POST["username"];
    $ps1=$_POST["ps1"];
    $ps2=$_POST["ps2"];
    $options = [
        'cost' => 12,
    ];
    $phash=password_hash($ps1, PASSWORD_BCRYPT, $options);
    
    $stmt = $conn->prepare("INSERT INTO users (username, password_hash) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $phash);
    if($stmt->execute())
    {
        header("Location: login.php");
        $msg="inserted";
    }
    else
    {
        die('execute() failed: ' . htmlspecialchars($stmt->error));
    }
}




?>


<html>
<head>
<script>
function validate()
{
    var ps1=document.getElementById("ps1");
    var ps2=document.getElementById("ps2");
    
    if(ps1.value==ps2.value) document.getElementById("myform").submit();
    else
    {
        document.getElementById("msg").innerHTML="Passwords don't match!";
    }
}

</script>

</head>
<body>
<p id="msg"><?= $msg ?></p>
<form method="POST" id="myform">
<input type="text" name="username" />
<input type="password" name="ps1" id="ps1"/>
<input type="password" name="ps2" id="ps2" />
<input type="button" value="submit" onclick="validate();"/>
</form>

</body>

</html>
