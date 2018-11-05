<?php
$cookie = $_POST['cookie'];
setcookie('nightmode',$cookie,time()+(86400*365), "/");
?>
