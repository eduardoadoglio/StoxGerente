$(document).ready(function(){
	$("#input-pagamento").val("0.00");
	$("#input-pagamento").on('change', function(){
		var valPagamento = parseFloat( $("#input-pagamento").val() );
		var valCompra = parseFloat( $("#preço-total").html().replace("R$", '') );

		$("#troco").html("R$"+parseFloat(valPagamento - valCompra).toFixed(2));
	});
});