<?php

    if(isset($_COOKIE['userid'])){
        if(isset($_COOKIE['instituteid'])){
            setcookie("instituteid","",time()-3600);
            setcookie("userid","",time()-3600);
            setcookie("password","",time()-3600);
        }
    }
    header("Location: index.php");
?>
