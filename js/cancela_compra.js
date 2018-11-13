$(document).ready(function(){
	$("#btn-cancela-compra").on('click', function(){
		var bool = confirm("Deseja mesmo cancelar a compra?");
		if(bool){
			$("tr:not(:first-child)").html('');
			$("#preço-total").html("R$0.00");
			$("#item-name").html("Produto");
			$("#item-value").html('');
			$("#troco").html('R$0.00');
			$("#pagamento").html('R$0.00');
			cache = [];
		}
	});
});
