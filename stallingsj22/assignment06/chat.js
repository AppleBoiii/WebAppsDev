var loggedIn;
var userID;
var lastReceived;


setInterval(function () {
    updateChat();
}, 500);

function setCookie(cname, cvalue, days) {
    const d = new Date();
    d.setTime(d.getTime() + (days * 24 * 60 * 60 * 1000));
    let expires = 'expires=' + d.toUTCString();
    document.cookie = cname + '=' + cvalue + ';' + expires + ';';
}

function checkCookie() {
    let username = getCookie('username');
    if (username == '') return false;
    else return true;
}

function getCookie(cname) {
    let name = cname + '=';
    let decodedCookie = decodeURI(document.cookie);
    let ca = decodedCookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function changeScreen() {
    if (loggedIn) return;
    else {
        let loginScreen = document.getElementById('login')
        loginScreen.style.display = 'none';

        let homeScreen = document.getElementById('home');
        homeScreen.style.display = 'block';
        updateChat();
    }
}

function login() {
    if (!checkCookie()) {
        var username = document.getElementById('enterUsername').value;
        if (username == '') return;

        var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                checkLogin();
            }
        };
        xhttp.open('GET', 'login.php?user=' + username, true);
        xhttp.send();

        setCookie('username', username, 1);
        userID = username;
    } else {
        userID = getCookie('username');
    }

    changeScreen();
}

function updateChat() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            e = document.getElementById('messages');
            e.innerHTML = this.responseText;
            console.log(this.responseText);
            if (e.innerHTML == lastReceived) {
                return;
            } else {
                lastReceived = e.innerHTML;
                window.scrollBy(0, -1000);
            }

        }
    };

    xhttp.open('GET', 'list.php', true);
    xhttp.send();
}

function sendMessage() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            updateChat();
        }
    };

    var message = document.getElementById('sentMessage').value;
    document.getElementById('sentMessage').value = '';
    if (message == '') return;

    xhttp.open('GET', 'add.php?user=' + userID + '&msg=' + message, true);
    xhttp.send();

}
