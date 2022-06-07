<?php

if(password_verify($_GET['pword'],$_GET['phash']))
{
    echo "success";
}
else echo "fail";

?>
