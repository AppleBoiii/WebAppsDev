 <?php
session_start();

if(isset($_GET['username']) && isset($_GET['password'])) {
    include "../../db.php";
    
    $username = $_GET['username'];
    $password = $_GET['password'];
    $options = [
        'const' => 12,
    ];
    $phash = password_hash($password, PASSWORD_BCRYPT, $options);
    
    $stmt = $conn->prepare("INSERT INTO users2 (username, password_hash) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $phash);
    
    if($stmt->execute()){
        echo "Success!"; 
            
        $_SESSION["username"] = $username;
        $_SESSION["phash"] = $phash;
        
    }
    
    else
    {
        echo ('execute() failed: ' . htmlspecialchars($stmt->error));
    }
    
    $stmt->close();
    $conn->close();
    
}
else {
    echo "Something else went wrong!";
}

?>
