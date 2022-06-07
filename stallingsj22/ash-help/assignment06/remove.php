<?php

$servername = "localhost";
$username = "honga22";
$password = "PXLblu87!";
$dbname = "honga22";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  echo "db connection failed";
}

if(isset($_POST['deletebutton'])) {
            $sql = "DELETE FROM chatbox WHERE ID=".($_POST['deletebutton']);
            $result = $conn->query($sql);

}

$stmt->execute();

$stmt->close();
$conn->close();

echo "success";