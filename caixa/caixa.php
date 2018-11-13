<html>
    <head>
        <title>trek</title>
        <script src="../js/jquery-3.3.1.min.js" charset="utf-8"></script>
        <link rel="stylesheet" type="text/css" href="../css/caixa.css">
        <link rel="stylesheet" href="../css/fontawesome-5.0.10/web-fonts-with-css/css/fontawesome-all.min.css">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
        <script src="../js/jquery.scrollTo.min.js"></script>
        <?php
            session_start();
            if(!isset($_SESSION['id'])){
                header("location: /stox/login.php");
            }

        ?>
    </head>

    <body>

        <div class="modal">
            <h1>Compra Realizada!</h1>
        </div>
        <div class="flex-row">

            <nav>
                <header>
                    <div class="user-info">
                        <span id="idFuncionario" style="display:none;"><?php echo $_SESSION['id'] ?></span>
                        <?php echo $_SESSION['nome'] ?>
                    </div>
                    <span id="data">12 de nov 16:48</span>
                    <!-- <div class="control-panel">
                        <button></button>
                        <button></button>
                        <button></button>
                    </div> -->
                </header>
                <table cellspacing="4" class="table-header">
                    <tr><th>Nome</th><th>Marca</th><th>Qtd</th><th>$ Un.</th><th>$ Sub-Total</th><th>% Desc.</th><th>$ Total</th></tr>
                </table>
                <div id="items-container">
                    <table cellspacing="4" class="table-items" id="items">
                        <!--  Aqui será inserido os itens registrados  !-->
                    </table>
                </div>
                <footer>
                    <div class="buttons">
                        <div class="batch-btn-wrapper">
                            <a href="#" id="finalizar" onclick="return false" class="batch-btn"><i class="fas fa-check"></i><span>Finalizar Compra</span></a>
                            <a href="#" id="cancelar" onclick="return false" class="batch-btn" style="background-color:rgb(179, 46, 46)"><i class="fas fa-trash"></i><span>Cancelar Compra</span></a>
                        </div>
                    </div>
                    <div class="inputs">
                        <input type="text" id="codbarra" /> x
                        <input type="number" value="1" min="1" id="qtd" />
                    </div>

                </footer>
            </nav>
            <aside>
                <div class="button-wrapper">
                    <button>Dinheiro</button>
                    <button>Cartão</button>
                    <button>Misto</button>
                </div>
                <div class="item-troco">

                    <div class="dinheiro-container">
                        Dinheiro:<br><input type="number" step="any" id="dinheiro" value="0" />
                    </div>
                    <div class="troco-container">
                        Troco:<br><input type="text" type="number" step="any" id="troco" value="0"/>
                    </div>

                    <!-- <span id="item-info-nome"></span><hr style="width:120px;transform:skewX(40deg);;">
                    <span id="item-info-val"></span> <span id="item-info-qtd"></span><br> -->
                </div>
                <div class="item-info">

                    <span>Leite Qualitá</span>
                    <span>6</span>
                    <span>,00</span>
                    <span>x1</span>


                    <!-- <button class="cartao-button" id="cartao-btn"><i class='fas fa-money-bill-alt'></i></button>
                    <div class="dinheiro-container">
                        Dinheiro:<br><input type="number" step="any" id="dinheiro" value="0" />
                    </div>
                    <div class="troco-container">
                        Troco:<br><input type="text" type="number" step="any" id="troco" value="0"/>
                    </div>
                    <div class="debito-container">
                        <input type="button" value="Débito" id="debito" placeholder="0" />
                    </div>
                    <div class="credito-container">
                        <input type="button" value="Crédito" id="credito" placeholder="0" />
                    </div> -->


                </div>
                <div id="item-valor">

                </div>

            </aside>
        </div>

    </body>
</html>


<script>

$(document).ready(function(){
    // Definição de Varíaveis para o sistema;
    var total = 0;
    var cache = new Array();
    var moneycc = 1;
    var moneycaixa;
    var desconto;
    var item;
    function log_items(codbarra,nome,marca,qtd,val,desconto) {
        this.codbarra = codbarra;
        this.nome = nome;
        this.marca = marca;
        this.qtd = qtd;
        this.val = val;
        this.desconto = desconto;
    }
    function deleterow(items) {
        var table = document.getElementById(items);
        var rowCount = table.rows.length;

        table.deleteRow(rowCount -1);
    }
    function playbeep(){
        var audio = new Audio("../sounds/beep.mp3");
        audio.play();
    }
    function playcashout(){
        var audio = new Audio("../sounds/cashout.wav");
        audio.play();
    }
    function deleteCompra(){
        cache = new Array();
        total = 0;
        moneycc = 1;
        $("#items").html("");
        $("#item-valor").html("R$ <span>"+total+"</span>");
        $(".dinheiro-container").css("display","block");
        $(".troco-container").css("display","block");
        $(".debito-container").css("display","none");
        $(".credito-container").css("display","none");
        $("#cartao-btn").html("<i class='fas fa-money-bill-alt'></i>");
        $("#cartao-btn").blur();
        $("#debito").blur();
        $("#credito").blur();
        $("#debito").removeClass("permafocus");
        $("#credito").removeClass("permafocus");
        $("#dinheiro").val(0);
        $("#troco").val(0);
    }

    moneycaixa = localStorage.getItem("dinheiro_caixa");
    $("#moneycaixa").html(moneycaixa);

    $("#item-valor").html("R$ <span>"+total+"</span>");

    $(window).keyup(function(event) {
        if( event.keyCode == 45 ){ // INSERT
               $("#codbarra").focus();
               $("#codbarra").select();
        }
        else if( event.keyCode == 35 ) { // END
            $("#qtd").focus();
            $("#qtd").select();
        }
        else if(event.keyCode == 33){ //PgUp
          if(moneycc == 1){
            $("#dinheiro").focus();
            $("#dinheiro").select();
          } else {
            if( $("#debito").is(":focus") == true ) {
              $("#credito").focus();
              moneycc = 2;
              $("#credito").addClass("permafocus");
              $("#debito").removeClass("permafocus");
            } else {
              $("#debito").focus();
              moneycc = 3;
              $("#debito").addClass("permafocus");
              $("#credito").removeClass("permafocus");
            }
          }
        }
        else if(event.keyCode == 34){ //PgDwn
            if ($("#cartao-btn").is(":focus") == true ) {
                if(moneycc == 1){
                    $(".dinheiro-container").css("display","none");
                    $(".troco-container").css("display","none");
                    $(".debito-container").css("display","block");
                    $(".credito-container").css("display","block");
                    $("#cartao-btn").html("<i class='far fa-credit-card'></i>");
                    $("#cartao-btn").blur();
                    $("#dinheiro").blur();
                    $("#dinheiro").val(0);
                    $("#troco").val(0);
                    moneycc = 2;
                    $("#debito").addClass("permafocus");
                    $("#debito").focus();
                } else {
                    $(".dinheiro-container").css("display","block");
                    $(".troco-container").css("display","block");
                    $(".debito-container").css("display","none");
                    $(".credito-container").css("display","none");
                    $("#cartao-btn").html("<i class='fas fa-money-bill-alt'></i>");
                    $("#cartao-btn").blur();
                    $("#debito").blur();
                    $("#credito").blur();
                    $("#debito").removeClass("permafocus");
                    $("#credito").removeClass("permafocus");
                    moneycc = 1;
                }
            } else {
                $("#cartao-btn").focus();
            }
        }
        else if ( event.keyCode == 13 ) { // Enter
            if ( ($("#codbarra").is(':focus') == true) || ($("#qtd").is(':focus') == true)){
                var codbarra = $("#codbarra").val();

                if( codbarra == ""){
                    throw new Error("Código vazio");
                }

                $.ajax({
                    type: "POST",
                    url: 'actions.php',
                    data: {cod: codbarra, action: 1},
                    success: function(result){

                        item = JSON.parse(result);

                        if( item.nm_tipo_produto == undefined){
                            throw new Error("Código não encontrado");
                        } else {

                            $.ajax({ // Procura se o produto possui algum desconto
                                type: "POST",
                                url: 'actions.php',
                                data: {cod: codbarra, action: 4},
                                success: function(result){
                                    desconto = result;
                                    multiplier = $("#qtd").val(); // Pega a quantidade do item

                                    if (desconto != "") {
                                        parseInt(desconto);
                                        totalItem = item.int_preco_venda * (100 - desconto) / 100 * multiplier;
                                    } else {
                                        desconto = "-";
                                        totalItem = item.int_preco_venda * multiplier;
                                    }

                                    total += totalItem; // Aumenta o valor total a pagar;
                                    $("#item-valor").html("R$ <span>"+total+"</span>");
                                    // adicionar array pro log;
                                    $("#items").append("<tr><th>"+item.nm_tipo_produto+"</th><th>"+item.nm_marca_produto+"</th><th>"+multiplier+"</th><th>"+item.int_preco_venda+"</th><th>"+item.int_preco_venda*multiplier+"</th><th>"+desconto+"</th><th>"+totalItem+"</th></tr>")
                                    $('#items-container').scrollTo("max"); // Scrolla a tabela pro final quando é add um item
                                    cache.push(new log_items(codbarra,item.nm_tipo_produto,item.nm_marca_produto,multiplier,item.int_preco_venda,desconto)); //Enfia os dados do item adicionado no Array cache, como um objeto.
                                    codbarra = null;
                                    $("#codbarra").val(null);
                                    $("#qtd").val(1);

                                    // Adicionando informações no item-info
                                    $("#item-info-nome").html(cache[cache.length - 1].nome);
                                    $("#item-info-qtd").html("x"+cache[cache.length - 1].qtd);
                                    $("#item-info-val").html(cache[cache.length - 1].val);
                                }
                            });
                        }
                    }
                });
                $("#codbarra").focus();
            }
            else if ($("#dinheiro").is(':focus') == true){
                alert($("#dinheiro").val());
            }
        }
        else if( event.keyCode == 46){ // del
            deleterow("items");
            total -= cache[cache.length - 1].val;
            cache.pop();
            $("#item-valor").html("R$ <span>"+total+"</span>");
        }
        else if( event.keyCode == 27){ //esc
            if ($("#cancelar").is(":focus") == true ) {
                if($(".modal").hasClass("in")){
                    $(".modal").removeClass("in");
                    $("#cancelar").blur();
                } else {
                    deleteCompra();
                    $("#cancelar").blur();
                }
            } else {
                $("#cancelar").focus();
            }
        }
        else if( event.keyCode == 192){ // aspas
            if ($("#finalizar").is(":focus") == true ) {

                if (total == 0 ) {
                    alert("Não há item na lista!");
                    $("#finalizar").blur();
                } else {

                    $.ajax({
                        type: "POST",
                        url: 'actions.php',
                        data: {total: total,troco: $("#troco").val(),funcionario:$("#idFuncionario").html(),moneycc: moneycc, venda: JSON.stringify(cache), action: 2},
                        success: function(result){
                            if (moneycc == 1) {
                                localStorage.setItem("dinheiro_caixa", parseInt(moneycaixa) + parseInt(total));
                                $("#moneycaixa").html(localStorage.getItem("dinheiro_caixa"));
                            }
                            deleteCompra();
                            $(".modal").addClass("active");
                            $("#finalizar").blur();
                        }
                    });
                }
            } else {
                $("#finalizar").focus();
            }
            // var print = "Loja do CheqTrek<br><br>===========================================<br><br>";
            // cache.forEach(function(value, i){
            //     print += value.nome+"             Qtd:"+value.qtd+" x "+value.val+"<br>";
            // });
            // print += "<br>===========================================<br><br>";
            // print += "Total: "+total;
            // var printout = window.open("");
            // printout.document.write(print);
        }
        // else if( event.keyCode = 118){ //F7
        //     if ($("#signout").is(":focus") == true ) {
        //         window.location.href = "/stox/caixa/destroy.php";
        //     } else {
        //         $("#signout").focus();
        //     }
        // }
    });

    $("#dinheiro").on("input",function(){
        if($("#dinheiro").val() == 0) {
            $("#troco").val(0);
        } else{
            $("#troco").val($("#dinheiro").val() - total);
        }
    });


});



</script>
<audio class="audios" id="beep" preload="none">
<source src="../sounds/beep.mp3" type="audio/mpeg">
