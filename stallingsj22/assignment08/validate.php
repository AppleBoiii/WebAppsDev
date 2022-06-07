<?php
session_start();
include "../../db.php";

function checkGet() {
    if(isset($_GET['return'])) {
       die($_SESSION['email']);
    }
}

checkGet();
if($_SESSION['name'] != '' && $_SESSION['email'] != '') {
    $email = $_SESSION['email'];
    $name = $_SESSION['name'];
    $year = explode("@", $email);
    $year = "20".substr($year[0], strlen($year[0])-2);
    $_SESSION['year'] = $year;
    //echo $email;

    $file = 'imgs/'.$year.'_default.jpg';

    $sql = $conn->prepare("INSERT INTO picpages (name, email, file) VALUES (?, ?, ?)");
    $sql->bind_param('sss', $name, $email, $file);
    $sql->execute();

    $conn->close();

}
else echo "bad";

?>