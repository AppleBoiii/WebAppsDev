     <?php 
include '../../db.php';

$sql = 'SELECT * FROM msgs2 JOIN users2 ON users2.ID=msgs2.userID ORDER BY date DESC';
$result = $conn->query($sql);

$i = 0;
while($row = $result->fetch_assoc()) {
    $message = $row['message'];
    $messageID = $row['ID'];
    $username = $row['username'];
    $pfp_loc = $row['pfp'];

    
    /*
    <p style="float: left;"><img src="http://placekitten.com/g/200/200" height="200px" width="200px" border="1px"></p>
    */
                    
    echo "<img src='".$pfp_loc."'><div id=".$messageID." class='message'><span>".$username." Says : ".$message."</span> </div> <br>";
    $i++;
    if($i>25) {
        break;
    }
}


$conn->close();

?>
