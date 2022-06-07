<html>
<head>
    <title>Fav Chips</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script>
        function updateList() 
        {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
            document.getElementById("list").innerHTML = this.responseText;
            }
            };
            xhttp.open("GET", "list.php", true);
            xhttp.send();
        }
        
        function add() 
        {
            //add it to the html in gray
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
        
        function remove(id) 
        {
            //add it to the html in gray
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
            updateList();
            }
            };
            xhttp.open("GET", "remove.php?id="+id, true);
            xhttp.send();
        }
        function maybeAdd(e) 
        {
            if (e.code === "Enter") add();
        }
    
    </script>

</head>

<body onload="updateList();">

<div id="list"></div>





<input type="text" name="task" id="task" onkeydown="maybeAdd(event);"/>
<input type="button" onclick="add();" value="add" />



</body>



</html>
