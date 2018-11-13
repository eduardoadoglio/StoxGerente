<?php
session_start();
if( !isset($_SESSION['id']) )
    header("Location: ../login.php");
?>
<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
<meta charset="utf8">
<title>Estocador</title>
<link rel="stylesheet" media="screen and (min-width: 1px) and (max-width: 539px)" href="../css/estocador.css">
<link rel="stylesheet" media="screen and (min-width: 540px) and (max-width: 799px)" href="../css/estocador-md.css">
<link rel="stylesheet" media="screen and (min-width: 800px)" href="../css/estocador-lg.css">
<link rel="stylesheet" href="../css/fontawesome-5.0.10/web-fonts-with-css/css/fontawesome-all.min.css">
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300" rel="stylesheet">
<script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="../js/repositor/modal.js"></script>
<script type="text/javascript">
window.onorientationchange = function(){
    var orientation = window.orientation;
    switch(orientation)
    {
      case 0:
        window.location.reload();
        break;
      case 90:
        window.location.reload();
         break;
      case -90:
        window.location.reload();
        break;
    }
}
</script>