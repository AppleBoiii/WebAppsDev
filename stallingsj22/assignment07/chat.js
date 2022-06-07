var username;
var loggedIn = false;
var lastReceived = "";



setInterval(function () {
    updateChat();
}, 500);

function checkLogin() {
    var serverResponse;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            serverResponse = this.responseText;
            // console.log(serverResponse);
            checkStatus(serverResponse);
            //calls validate.php to echo out a serverResponse,
            //which will be the username if validate.php detects a valid session
        }
    };

    xhttp.open('GET', 'validate.php', true);
    xhttp.send();

}

function login() {
    var username = document.getElementById('loginUsername').value;
    var password = document.getElementById('ddd').value;
    var serverResponse = "";

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            serverResponse = this.responseText;
            if (serverResponse == "Success!") {
                checkLogin();
            } else {
                badLogin();
            }
        }
    };

    xhttp.open('POST', 'login.php', true);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhttp.send('username=' + username + '&password=' + password);
}

function badLogin() {
    var x = document.getElementById('loginError');
    x.innerHTML = "*Incorrect username or password. Please verify your credentials and try again";
}

function register() {
    var regExp = /[a-zA-Z]/g;
    username = document.getElementById('registerUsername').value;
    if (!regExp.test(username)) {
        badRegister();
        console.log("I failed>");
        return;
    }
    userame = username.trim();

    var password = document.getElementById('registerPassword').value;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            if (this.responseText == "Success!") checkLogin();
            else badRegister();
        }
    };

    xhttp.open('GET', 'register.php?username=' + username + '&password=' + password, true);
    xhttp.send();
}

function badRegister() {
    var x = document.getElementById('registerError');
    x.innerHTML = "*Bad username. Either pre-exists or does not contain at least 1 letter. Please pick another username and try again.";
}

function signOut() {
    //console.log("Called!");
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            loggedIn = false;
            var e = document.getElementById('login_div');
            var f = document.getElementById('home_div');
            f.style.display = 'none';
            e.style.display = 'initial';
        }
    };

    xhttp.open('GET', 'signout.php', true);
    xhttp.send();

}

function updateChat() {
    if (!loggedIn) return;
    else {
        var home = document.getElementById('home_div');
        home.style.dispay = 'block';
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                e = document.getElementById('messages');
                e.innerHTML = this.responseText;
                // console.log(this.responseText);
                if (e.innerHTML == lastReceived) {
                    return;
                } else {
                    lastReceived = e.innerHTML;
                    window.scrollBy(0, -1000);
                }
            }
        };

        xhttp.open('GET', 'update.php', true);
        xhttp.send();
    }
}

function checkStatus(serverResponse) {
    if (serverResponse == null || serverResponse == "") return;
    username = serverResponse;
    loggedIn = true;
    updateScreen();
}

function updateScreen() {
    if (!loggedIn) return;
    var e = document.getElementById('login_div');
    var f = document.getElementById('home_div');
    var g = document.getElementById('welcome_div');
    var h = document.getElementById('loginError');
    var i = document.getElementById('registerError');


    e.style.display = 'none';
    f.style.display = 'initial';
    g.innerHTML = "<h3>Welcome</h3>";
    h.innerHTML = "";
    i.innerHTML = "";
}


function sendMessage() {
    if (!loggedIn) return; //must be loggedIn to send message
    var message = document.getElementById('sentMessage').value;
    document.getElementById('sentMessage').value = "";

    //console.log("I'm called");


    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            //console.log(this.serverResponse);
            updateChat();
        }
    };

    xhttp.open("GET", "send.php?message=" + message + "&username=" + username, true);
    xhttp.send();
}

function maybeSend(e) {
    if (e.code === "Enter") sendMessage();
}

function changePfp() {
    var home = document.getElementById('home_div');
    var pfp = document.getElementById('pfp');
    home.style.display = 'none';
    pfp.style.display = 'initial';

}

function changeBack() {
    var home = document.getElementById('home_div');
    var pfp = document.getElementById('pfp');
    home.style.dispay = 'block';
    console.log("called!");
    pfp.style.display = 'none';
}
