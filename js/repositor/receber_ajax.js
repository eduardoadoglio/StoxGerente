$(document).ready(function(){
    $("[name='codbarras']").on('change', function(){
        var codbarra = $("[name='codbarras']").val();

        $.ajax({
            type: "POST",
            url: "ajax_codbarras.php",
            data: {codbarra: codbarra},
            success: function(result){
                result = JSON.parse(result);

                if( result['status'] == 'EMPTY_FIELD' )
                    throw new Error();

                else if( result['status'] == 'PRODUCT_NOT_FOUND' )
                {
                    mostrarAviso('erro', 'Código de barras inválido');
                    throw new Error();
                }

                else if( result['status'] == 'ERR_SQL' )
                {
                    mostrarAviso('erro', 'Falha no sistema');
                    throw new Error();
                }
                
                else if( result['status'] == 'OK' )
                    $(".batch-title").text(result['content']);
                console.log(result);
            },
            error: function(xhr, ajaxOptions, thrownError){
                console.log(xhr);
            }
        });
    })
    $("#submit-btn").on('click', function(){
        var data = {
            codbarras:  $("[name='codbarras']").val(), 
            nr_lote:    $("[name='nr_lote']").val(),
            qtd:        $("[name='qtd']").val(), 
            data:       $("[name='data']").val(), 
            fornecedor: $("[name='fornecedor']").val()
        }
        console.log(data);
        $.ajax({
            type: "POST",
            url: "ajax_cadastrar_lote.php",
            data: data,
            success: function(result){
                console.log(result);
                result = JSON.parse(result);
                if( result['status'] == 'EMPTY_FIELD')
                {
                    var inputName = result['content'];
                    var element = $("[name='"+inputName+"']");
                    element.css('border-color', 'red');

                    mostrarAviso('erro', 'Preencha todos os campos');
                    throw new Error();
                }
                else if( result['status'] == 'INVALID_BARCODE')
                {
                    $("[name=codbarras]").css('border-color', 'red');
                    mostrarAviso('erro', 'Código de barras inválido');
                    throw new Error();
                }
                else if( result['status'] == 'INVALID_QUANTITY')
                {
                    $("[name=qtd]").css('border-color', 'red');
                    mostrarAviso('erro', 'Quantidade inválida');
                    throw new Error();
                }
                else if( result['status'] == 'INVALID_SUPPLIER')
                {
                    $("[name=fornecedor]").css('border-color', 'red');
                    mostrarAviso('erro', 'Fornecedor inválido');
                    throw new Error();
                }
                else if( result['status'] == 'INVALID_DATE')
                {
                    $("[name=data]").css('border-color', 'red');
                    mostrarAviso('erro', 'Data inválida');
                    throw new Error();
                }
                else if( result['status'] == 'NEAR_DATE')
                {
                    window.location = "http://127.0.0.1/stox/estocador/lotes.php?aviso=1&lote="+result['content'];
                }
                else if( result['status'] == 'OK')
                {
                    mostrarAviso('sucesso', 'Lote cadastrado');
                }
            },
            error: function(xhr, ajaxOptions, thrownError){
                console.log('erro do ajax');
            }
        });
    });
});