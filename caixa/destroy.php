<?php
session_start();
session_destroy();
header("location: /stox/login.php");
?>
