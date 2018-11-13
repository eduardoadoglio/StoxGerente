<html>
    <head>
        <title>trek</title>
        <script src="../js/jquery-3.3.1.min.js" charset="utf-8"></script>
        <link rel="stylesheet" type="text/css" href="../css/caixa.css">
    </head>
    <body>
        <div class="info-container">
            Leite Lacta 300ml
        </div>
    </body>
</html>

<script>
$.ajax({
type: "POST",
url: 'submission.php',
data: {name: 'Wayne', age: 27},
success: function(data){
    alert(data);
}
});
</script>

<script>

</script>
