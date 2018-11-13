$(document).ready(function(){
	$("#btn-confirma-compra").on('click', function(){
		var bool = confirm("Deseja mesmo confirmar a compra?");
		if(bool){
			$.ajax({
				type: "POST",
				url: "confirmar.php",
				data: {},
				success: function(result){
					
				}
			});

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