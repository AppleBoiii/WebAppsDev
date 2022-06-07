<!DOCTYPE html>

<html lang = "en">
<head>
<title> chatbox </title>

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="ie-edge">

<style>
body {
  margin: 0;
  font-family: Trebuchet MS;
}

.topnav {
  overflow: hidden;
  background-color: #333;
}

.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #555;
  color: white;
}

.topnav a.active {
  background-color: #9bd9ff;
  color: black;
}
    
h1 {
  font: Trebuchet MS;
  font-size: 30px;
  margin-bottom: 4px;
  text-align: left;
  margin-top: -30px;
  margin-left: 2px;
}

button {
  background-color: #333;
  font-family: Trebuchet MS;
  color: white;
}
    
.submit {
  border: none;
  text-decoration: none;
  display: inline-flex;
  font-size: 14px;
  margin: 2px 2px;
  cursor: pointer;
  font-family: Trebuchet MS;
  vertical-align: top;
  margin-top: 25px;
}

.message-center { 
  border: 1px solid black;
  height: 200px;
  margin-left: 20px;
  margin-right: 50px;
  border-radius: 20px;
  overflow-y: auto;
}
.task_input {
  font-size: 16px;
  margin-top: 10px;
  margin-bottom: 5px;
  margin-left: 5px;
}
.input_form {
 margin-left: 14px;
}
.adduserbox {
  margin-top: 10px;
  margin-bottom: 10px;
  margin-right: 5px;
  font-size: 16px;
}
.login {
  border: 2px solid black;
  display: inline-block;
  margin-bottom: 10px;
  margin-left: 5px;
  background: #ccedff;
  padding: 5px;
}
.loginbutton {
  font-size: 16px;   
}
.submitbutton {
  font-size: 16px;
  margin-right: 5px;
}
.delbutton {
  margin-left: 20px;
  margin-right: 10px;
}
.delbutton:hover {
  background-color: red;
}
td {
  border-bottom: 1px solid black;
}

</style>
</head>
    
<body>
    
<script>

var username;
var loggedIn;

    function changeScreen() {
        let loginScreen = document.getElementById('logindiv');
        let homeScreen = document.getElementById('messagediv');
        let logoutScreen = document.getElementById('logoutdiv');
        if (loggedIn == true) {

            loginScreen.style.display = 'none';
            homeScreen.style.display = 'initial';
            logoutScreen.style.display = 'initial';

        }
        else {
            homeScreen.style.display = 'none';
            logoutScreen.style.display = 'none';
        }
    }

    function checklogin() {

        var username = document.getElementById('username').value;
        var messagediv = document.getElementById('messagediv');

        if (username == '' || username == ' ') {
            console.log(username);
            return;
            
        } else {
            console.log(username);
            loggedIn = true;
            changeScreen();
        }

    }

    function getUsername() {
        username = document.getElementById('username').value;

        console.log(username);
    }
        
function updateList(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("messages").innerHTML = this.responseText;
    }
};
    
    xhttp.open("GET", "list.php", true);
    xhttp.send();
    
}
        
function add(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        updateList();
    }
};
    
    var task=document.getElementById("task").value;
    document.getElementById("task").value="";
    if(task=="")return;
    xhttp.open("GET", "add.php?task="+task, true);
    xhttp.send();
}
        
function remove(id){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    updateList();
    }
};
    
    xhttp.open("GET", "remove.php?id="+id, true);
    xhttp.send();
}
    
function enterAdd(e) {
    if (e.code === "Enter") add();
}
    
</script>
    
<div class="topnav">
  <a href="/honga22/index.php">home page</a>
  <a class = "active" href="/honga22/assignment06/chat.php">assignment 06</a>
</div>
<br>
<br>
    
<body onload=changeScreen();></body>
<!--<body onload=updateList();></body>-->

<h1 class="text-center">chatapp</h1>
    
<div class="logindiv" id='logindiv'>
<form onsubmit="checklogin();return false" class="login">
Add a username:
<input id='username' type='text'>
<input type='submit'>
</form>

</div>

<div class="logoutdiv" id='logoutdiv'>
    
hello [username]
logout button here
    
</div>


<?php
  
$_SESSION["username"] = "";
    
if(!empty($_POST['username'])){
    
 $_SESSION["submit"] = 'username';

}
    
$servername = "localhost";
$username = "honga22";
$password = "PXLblu87!";
$dbname = "honga22";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  echo "db connection failed";
}

if(!empty($_GET['task'])) {
    $stmt = $conn->prepare("INSERT INTO chatbox (task) VALUES (?)");
    $stmt->bind_param("s", $task);
    $task=strip_tags($_GET['task']);
    $stmt->execute();   
    
}
    
if(!empty($_GET['username'])) {
    $stmt = $conn->prepare("INSERT INTO chatbox (username) VALUES (?)");
    $stmt->bind_param("s", $username);
    $username=strip_tags($_GET['username']);
    $stmt->execute();
    
    $stmt->close();
    
    $conn->close();    
    
}

?>

<div class="message-center" id="messages">
<table onload="updateList();">

</table>
</div>
    
<div id="messagediv">
<form class="input_form">
		<!-- <input type="text" name="task" id="task" class="task_input" placeholder="Typing..." onkeydown='enterAdd(event); return false'>X -->
        <input type="hidden" name="action" value="add" />
		<!--<button type="submit" class="button" id="add_btn">Send</button>-->
        <input type="button" onclick="add();" class="button" value="Send"/>
</form> 
</div>
</body>


<br>

</html>