<?php

session_start();
$_SESSION['user'] = 0;
echo'You have been logged out!';
echo'<br><a href="./index.html"> Go to website </a>';




?>