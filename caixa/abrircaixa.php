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
            <span id="id_funcionario"><?php echo $_SESSION['id'] ?></span>
            <div class="control-panel">
                <button id="signout"><i class="fas fa-sign-out-alt"></i></button>
            </div>
        </header>
        <div class="abrir-caixa">
            <h1>Caixa Fechado!!</h1>
            <input type="number" id="dinheiro_caixa" min="1" placeholder="Dinheiro" /> <br><br>
        </div>

        <div class="pin-prompt">
            <h1>Gerente, insira sua senha para abrir o caixa.</h1>
            <input type="password" id="pin"><br><br>
            <button id="button_pin">Enviar</button>
        </div>



        <script>
        $(document).ready(function(){
            if(localStorage.getItem("id_caixa") == null){
                var num_caixa = prompt("Número do caixa nulo!\nInsira o número do caixa:");
                if (num_caixa != null){
                    localStorage.setItem("id_caixa", num_caixa);
                }
            }
            $(window).keyup(function(event) {
                if( event.keyCode == 35 ){ //END 1
                    $("#dinheiro_caixa").focus();
                    $("#dinheiro_caixa").select();

                }
                else if( event.keyCode == 40 ){ //Arrowdown 2
                    $("#pin").focus();
                    $("#pin").select();

                }
                else if( event.keyCode == 45 ){ //Insert 0
                    pin = $("#pin").val();
                    id_caixa = localStorage.getItem("id_caixa");
                    dinheiro_caixa = $("#dinheiro_caixa").val();
                    id_funcionario = $("#id_funcionario").html();
                    $.ajax({
                        type: "POST",
                        url: 'actions.php',
                        data: {pin, id_caixa, dinheiro_caixa,id_funcionario, action: 3},
                        success: function(result){
                            if(result == true){
                                localStorage.setItem("dinheiro_caixa", dinheiro_caixa);
                                window.location.href = "/stox/caixa/caixa.php";
                            } else {
                                alert("Senha Errada!");
                            }
                        }
                    });
                    //localStorage.setItem("dinheiro_caixa", $("#dinheiro_caixa").val());

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
