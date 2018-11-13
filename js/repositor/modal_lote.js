function addSeeListeners()
{
	var defaultValues = {nome: "", codbarras:"", qtd:"", nr_lote:"", fornecedor:"", validade:""};
	var idLote = 1;

	$(".batch-btn.see").on('click', function(){
		idLote = $(this).parent().attr('data-id');

		$.ajax({
			type: "POST",
			url: "ajax_lote.php",
			data:{cd: idLote},
			success: function(result){
				result = JSON.parse(result);
				defaultValues.nome			= result['product']['nm_tipo_produto'];
				defaultValues.codbarras 	= result['batch']['id_cod_barras'];
				defaultValues.qtd 			= result['batch']['int_qtd'];
				defaultValues.nr_lote 		= result['batch']['nr_lote'];
				defaultValues.fornecedor 	= result['batch']['id_fornecedor'];
				defaultValues.validade 		= result['batch']['dt_validade'];
				
				$("#modal-title").text(defaultValues.nome);
				$("[name='codbarras']").val(defaultValues.codbarras);
				$("[name='qtd']").val(defaultValues.qtd);
				$("[name='nr_lote']").val(defaultValues.nr_lote);
				$("[name='fornecedor']").val(defaultValues.fornecedor);
				$("[name='validade']").val(defaultValues.validade);
			}
		});

		var that = $(this);
		that.parent().parent().fadeOut(500);
		setTimeout(function(){
			that.parent().parent().fadeIn(500);
		}, 600);

	});

	$("#modal-close").on('click', function(){
		$("body").css('position', 'static');
		$("#modal").removeClass("trigger-slide-modal-down");
		$("#modal").addClass("trigger-slide-modal-up");
		$("#black-layer").fadeOut("slow");
	});

	$(".modal-btn-wrapper.restore").on('click', function(){
		$("[name='codbarras']").val(defaultValues.codbarras);
		$("[name='qtd']").val(defaultValues.qtd);
		$("[name='nr_lote']").val(defaultValues.nr_lote);
		$("[name='fornecedor']").val(defaultValues.fornecedor);
		$("[name='validade']").val(defaultValues.validade);
	});
	$(".modal-btn-wrapper.submit").on('click', function(){
		var codbarras 	= $("[name='codbarras']").val();
		var qtd 		= $("[name='qtd']").val();
		var nr_lote 	= $("[name='nr_lote']").val();
		var fornecedor 	= $("[name='fornecedor']").val();
		var validade 	= $("[name='validade']").val();
		console.log(validade);

		$.ajax({
			type: "POST", 
			url: "ajax_alterar_lote.php",
			data: {codbarras: codbarras, qtd: qtd, nr_lote: nr_lote, fornecedor: fornecedor, validade: validade, id: idLote},
			success: function(result){
				console.log(result);
				result = JSON.parse(result);

				if(result['status'] == 'ERR_SQL')
				{
					mostrarAviso('erro', 'Falha no sistema');
					throw new Error();
				}
				else if(result['status'] == 'INVALID_BARCODE')
				{
					mostrarAviso('erro', 'Código de barras inválido');
					$('[name="codbarras"]').parent().css('border-color', 'red');
					throw new Error();
				}
				else if(result['status'] == 'INVALID_SUPPLIER')
				{
					mostrarAviso('erro', 'Fornecedor inválido');
					$("[name='fornecedor']").parent().css('border-color', 'red');
					throw new Error();
				}
				else if(result['status'] == 'INVALID_DATE')
				{
					mostrarAviso('erro', 'Data inválida');
					$("[name='validade']").parent().css('border-color', 'red');
					throw new Error();
				}
				else if(result['status'] == 'INVALID_QUANTITY')
				{
					mostrarAviso('erro', 'Quantidade inválida');
					$("[name='qtd']").parent().css('border-color', 'red');
					throw new Error();
				}
				else if(result['status'] == 'OK')
				{
					mostrarAviso('sucesso', 'Alteração realizada');
				}
			}
		});
	})
}