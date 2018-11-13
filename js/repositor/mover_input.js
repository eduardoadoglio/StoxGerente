var oldHtml = "";
var vrfMove = false;
var parent;

function addMoveListeners(){
    $(".batch-btn-wrapper").on('click', 'a.move', function(){
        if(vrfMove){
            parent.html(oldHtml);
        }
        vrfMove = true;
        parent = $(this).parent();
        oldHtml = parent.html();

        parent.html('<input type="number" min="0" class="move-input" id="lote'+parent.attr("data-id")+'" placeholder="Quantidade">');
        parent.append('<div class="move-confirm-btn"><i class="fas fa-check-square"></i></div>');
        parent.append('<div class="move-cancel-btn"><i class="fas fa-ban"></i></div>');
        parent.css('justify-content', 'flex-start');

        $(".move-input").keydown(function (e){
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                (e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                (e.keyCode == 67 && (e.ctrlKey === true || e.metaKey === true)) ||
                (e.keyCode == 88 && (e.ctrlKey === true || e.metaKey === true)) ||
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                     return;
            }
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
    });

    $(".batch-btn-wrapper").on('click', '.move-cancel-btn', function(){
        parent.html(oldHtml);
        addSeeListeners();
    });

    $(".batch-btn-wrapper").on('click', '.move-confirm-btn', function(){
        var valor = $(this).parent().find('.move-input').val();
        var id = $(this).parent().attr("data-id");
        var that = $(this).parent().parent();
        parent.html(oldHtml);

        if( valor <= 0 )
        {
            mostrarAviso("erro", "Quantidade inválida");
            throw new Error();
        }

        $.ajax({
            type: "POST",
            url: 'ajax_cadastrar_movimentacao.php',
            data: {id: id, qtd: valor},
            success: function(result){
                console.log(result);
                result = JSON.parse(result);

                if(result['status'] == 'INVALID_QUANTITY')
                {
                    console.log(result);
                    mostrarAviso('erro', 'Quantidade inválida');
                    throw new Error();
                }
                if(result['status'] == 'ERR_SQL')
                {
                    console.log(result);
                    mostrarAviso('erro', 'Falha no sistema');
                    throw new Error();
                }

                that.find(".qtd").html(result['content']); //Atualiza o campo azulzinho de quantidade do lote
                mostrarAviso('sucesso', 'Movimentação cadastrada');
            },
            error: function(xhr, ajaxOptions, thrownError){
                console.log('erro do ajax');
            }
        });
    });
}