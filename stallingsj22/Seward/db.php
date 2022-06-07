<?php
$servername = "localhost";
$username = "sewardn";
$password = "squirrel";
$dbname = "sewardn";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    header("Location: http://compsci.asmsa.org/sewardn/error.html");
} ?>
