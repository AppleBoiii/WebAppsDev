<?php
require_once 'vendor/autoload.php';
session_start();

$clientID = "992258582545-macdim4ud077k5bi9upi2c9ausi72oje.apps.googleusercontent.com";
$clientSecret = "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";
$redirectUri = 'https://compsci.asmsa.org/stallingsj22/assignment08/index.php';



$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope('email');
$client->addScope('profile');

?>

<html lang="en">
<head>
<script src="https://apis.google.com/js/platform.js" async defer></script>
<meta name="google-signin-client_id" content="992258582545-macdim4ud077k5bi9upi2c9ausi72oje.apps.googleusercontent.com">
<link rel="stylesheet" href="./style.css"/>


<script>
    var loggedIn;
    var currentYear;
    var userYear;
    var email;
    var pfpshow;

    function uploadShow(){
        pfpshow = true;

        if (!pfpshow) return;
        else {
            var upload = document.getElementById('profileupload');
            upload.style.display='block';
            //upload.style.width = 32;

            var showbtn = document.getElementById('showbutton');
            showbtn.style.display='none';
        }
    }

    function uploadHide(){
        pfpshow = false;

        if (!pfpshow){
            var upload = document.getElementById('profileupload');
            upload.style.display='none';

            var showbtn = document.getElementById('showbutton');
            showbtn.style.display='block';
        }
        else {
            return;
        }
    }

/*
    function uploadChange(x) {
        var e = document.getELementById('profile');
        if(x) {
            e.innerHTML = "<form action='upload.php' method='post' enctype='multipart/form-data' class='uploadform'>"+
        "<h3>Upload Profile Picture</h3> <input type='file' name='fileToUpload' id='fileToUpload' class='uploadpad'/>"+
    "<br> <br>"+
        "<input type='submit' value='Upload Image' name='submit' title=' ' class='upload'> </form>"+   
"<button id='hidebutton' onclick='uploadChange(0);' class='uploadbtn'>Hide Upload</button>";
        }
        else {
            e.innerHTML = " <button id='showbutton' onclick='uploadChange(1);' class='uploadbtn'>Upload Profile Picture</button> ";
        }
    }
*/
    function checkLogin() {
        if(loggedIn) loadBody(); 
        else {
            var xhttp = new XMLHttpRequest();

            xhttp.onreadystatechange = function() {
                if(this.readyState == 4 && this.status == 200) {
                    //console.log(this.responseText);
                    if(!this.responseText.includes("bad")) {
                        email = this.responseText;
                        loggedIn = true;
                        loadBody();
                    } 
                    else {
                        //else code to tell them to login
                        return;
                    }
                }
            };

            xhttp.open('GET', 'validate.php', true);
            xhttp.send();
        }
    }

    function loadBody() {
        if(!loggedIn) return;
        
        var e = document.getElementById('signin');
        var f = document.getElementById('pic_div');
        var g = document.getElementById('profile');
        var h = document.getElementById('searchdiv');
        if(e) e.style.display = 'none';
        f.style.display = 'block';
        g.style.display = 'flex';
        h.style.display = 'flex';


        getTime();
        let newHTML = "";
        newHTML += "<div class='test'>"
        for(var i=currentYear;i<=currentYear+2;i++) {
            newHTML += "<button onclick='collapse("+i+"); getPics("+i+");' class='collapse-btn'>Class of "+i+"</button>"
        }
        newHTML += "</div>";
        for(var i=currentYear;i<=currentYear+2;i++) {
         newHTML +=    "<div id='"+i+"' class='collapse'></div>";
        }

        f.innerHTML = newHTML;
    }

    function getTime() {
        var dateObj = new Date();
        var month = dateObj.getUTCMonth()+1;
        var year = dateObj.getFullYear();
        if(month >= 8) year++;
        //console.log(month + "/" + year);
        currentYear = year;
        //currentYear = 2015;
    }

    function search() {
        var input = document.getElementById('searchbar');
        input = input.value.toUpperCase();
        var users = document.getElementsByClassName('picture_div');
        
        for(i = 0;i<users.length;i++) {
            name = users[i].getElementsByTagName('p')[0].innerText;
            if(name.toUpperCase().indexOf(input) > -1) users[i].style.display = "";
            else users[i].style.display = 'none';
        }
    }

    function getPics(x) {
       // console.log(x);
        var e = document.getElementById(x);
        var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function() {
            if(this.readyState == 4 && this.status == 200) {
                e.innerHTML = "<br> <h2> Class of "+x+"</h2><br><br>" +this.responseText+"</br>";
            }
        };

        xhttp.open('GET', 'list.php?year='+x);
        xhttp.send();
    }

    function collapse(x) {
        var e = document.getElementById(x);
        if(e.style.display == 'block') e.style.display= 'none';
        else e.style.display = 'block';
    }

    /*
    function changeName(e) {
        if(e.code === 'Enter') {
            var e = document.getElementById('namechange');
            name = e.innerHTML;
            
            var xhttp = new XMLHttpRequest();

            xhttp.onreadystatechange = function() {
            if(this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                }
            };

            xhttp.open('GET', 'change.php?name='+name);
            xhttp.send();
            }
    }
    */

</script>
</head>

<body onload="checkLogin();">

<div class="bodyform">
<h1 class="title">ASMSA Pic Pages</h1>    
</div>


<?php
if(isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    try {
        $client->setAccessToken($token['access_token']);
    }
    catch(Exception $e) {
        header("Location: index.php?");
    }

    $google_oauth = new Google_Service_Oauth2($client);
$google_account_info = $google_oauth->userinfo->get();
$email = $google_account_info->email;
$name = $google_account_info->name;

$_SESSION['name'] = $name;
$_SESSION['email'] = $email;
}

else {
    //header("Location: ".$client->createAuthURl());
    echo "<div id='signin' class='signindiv'> <h3>Click the button below to sign in via google. </h3> <button class='signinbutton'><a href='".$client->createAuthUrl()."'>Sign In </a></button> </div>";
}
?>

<!-- 



-->
<!--divs for the main screen-->
<div id="profile" class="profilediv">
<button id="showbutton" onclick="uploadShow();" class="uploadbtn">Edit Profile</button>

<div id='profileupload'>

<form action='upload.php' method='post' enctype='multipart/form-data' class='uploadform'>
        <h3>Upload Profile Picture</h3>
        <input type='file' name='fileToUpload' id='fileToUpload' class="uploadpad"/>
    <br>
    <br>
        <input type='submit' value='Upload Image' name='submit' title=" " class="upload">
    </form>   
   <!-- <div id='editname' class='editnamediv'>
    <h3>Change Your Name</h3>
    <input type='text' id='namechange' onkeydown='changeName(event);' placeholder='Edit Name...'/>
    
    </div> -->

    <button id="hidebutton" onclick="uploadHide();" class="uploadbtn">Close Edit Profile</button>
</div>
</div>

<div id='searchdiv'>
<input type='text' id='searchbar' onkeyup='search();' placeholder='Search for a person...'>
</div>

<div id="pic_div" class="picdiv">
</div>
<!-- -->






</body>
</html>