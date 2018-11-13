<html>
    <head>
        <title>trek</title>
        <script src="../js/jquery-3.3.1.min.js" charset="utf-8"></script>
        <link rel="stylesheet" type="text/css" href="../css/caixa.css">
        <script src="../js/jquery.scrollTo.min.js"></script>
        <link rel="stylesheet" href="../css/fontawesome-5.0.10/web-fonts-with-css/css/fontawesome-all.min.css">
        <?php
            session_start();
            if(!isset($_SESSION['id'])){
                header("location: /stox/login.php");
            }
        ?>
    </head>
    <body>
        <header>
            <div class="user-info">
                <?php echo $_SESSION['nome'] ?>
            </div>
            <div class="control-panel">
                <button id="signout"><i class="fas fa-sign-out-alt"></i></button>
            </div>
        </header>
        <div id="abrircaixa-setcaixa">
            <span>Número do caixa não setado!</span><br><br>
            <input type="number" id="numero-caixa" /><button id="button-setcaixa">Setar</button>
        </div>

        <div id="abrircaixa-abrircaixa">
            <span>Caixa Fechado!!</span><br><br>
            <input type="number" id="dinheiro-caixa" placeholder="Dinheiro" /><button id="button-cashcaixa">Setar</button>
        </div>



        <script>
        $(document).ready(function(){
            if(localStorage.getItem("id_caixa") == null){
                $("#abrircaixa-setcaixa").css("display","block");
            }

            $("#button-setcaixa").click(function setnumcaixa(){
                if($("#numero-caixa").val() == ""){
                    alert("Número Nulo!");
                } else {
                    localStorage.setItem("id_caixa", $("#numero-caixa").val());
                    window.location.reload(false);
                }
            });
            $("#button-cashcaixa").click(function setcashcaixa(){
                if($("#dinheiro-caixa").val() == ""){
                    alert("Número Nulo!");
                } else {
                    localStorage.setItem("dinheiro_caixa", $("#dinheiro-caixa").val());
                    window.location.href = "/stox/caixa/caixa.php";
                }
            });
            //localStorage.setItem("id_caixa", "1");
            //localStorage.removeItem("id_caixa");
            //document.write(localStorage.getItem("id_caixa"));
        });
        </script>
    </body>
    </html>
