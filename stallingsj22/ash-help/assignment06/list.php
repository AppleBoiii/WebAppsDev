<?php

$servername = "localhost";
$username = "honga22";
$password = "PXLblu87!";
$dbname = "honga22";

$conn = new mysqli($servername, $username, $password, $dbname);

/*if ($conn->connect_error) {
  echo "db connection failed";
}

$sql = "SELECT * FROM chatbox";
$result = $conn->query($sql);*/
    
    if(isset($_POST['deletebutton'])) {
            $sql = "DELETE FROM chatbox WHERE ID=".($_POST['deletebutton']);
            $result = $conn->query($sql);
       }
            if ($conn->connect_error) {
                echo "db connection failed";
            }
            else {
                $sql = "SELECT * FROM chatbox";
                $result = $conn->query($sql);
                
        while($row = $result->fetch_assoc()) {

echo "<tr><td>".$row['task']."<td>"."<form method='post' class='delform'><button class='delbutton' name='deletebutton' value='".$row['ID']."'>remove</button></form></td><td>".$row['timestamp']."</td></tr>";   
    
            }	 
    }


//$conn->close();
?>
