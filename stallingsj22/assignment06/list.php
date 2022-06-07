<?php 
include '../../db.php';

$sql = 'SELECT * FROM messages ORDER BY senttime DESC';
$result = $conn->query($sql);

$i = 0;
while($row = $result->fetch_assoc()) {
    $message = $row['text'];
    $messageID = $row['ID'];
    $username = $row['USERID'];
    
    $sql = "SELECT username FROM users WHERE username='".$username."' ORDER BY date";
    //$username = ($conn->query($sql))->fetch_assoc();
    
                    
    echo "<div id=".$messageID." class='message'><span>".$username." Says : ".$message."</span> <button  class='delButton' type='button' onclick='deleteMessage(".$messageID.")'> x</button> </div>";
    $i++;
    if($i>20) {
        break;
    }
}


$conn->close();

?>
