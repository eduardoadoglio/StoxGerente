
$(document).ready(function(){
	

	$("#order-selector").on('click', function(){
		var pageName = location.pathname.substring(location.pathname.lastIndexOf("/") + 1);

		var nameParents = scanHtml('div.batch-product', 'div.batch', 'product');
		var containers = $('.content').find('div.batch');

		if( pageName == "prateleira.php" || pageName == "lotes.php")
	        var qtdParents = scanHtml('div.qtd', 'div.batch', 'qtd');
	    if( pageName == "lotes.php")
	        var dateParents = scanHtml('div.date-content', 'div.batch', 'date');
	    if( pageName == "produtos.php"){
	    	var nameParents = scanHtml('div.product-product', 'div.product', 'product');
	    	containers = $('.content').find('div.product');
	    }
	    
	    
		var filter = $("[data-checked='checked']").text();

		if( $(this).hasClass("up") )
		{
			$(this).removeClass();
			$(this).addClass("down");
			$(this).find('i').removeClass();
			$(this).find('i').addClass('fas fa-long-arrow-alt-down');
			$(this).css('color', '#FF7272');

			if( filter == "Quantidade" )
			{
                order(qtdParents, containers, true);
            }
            else if( filter == "Validade" )
            {
                order(dateParents, containers, true);
            }
            else if( filter == "Nome" )
            {
                order(nameParents, containers, true);
            }
		}
		else
		{
			$(this).removeClass();
			$(this).addClass("up");
			$(this).find('i').removeClass();
			$(this).find('i').addClass('fas fa-long-arrow-alt-up');
			$(this).css('color', '#81d491');

			if( filter == "Quantidade" )
			{
                order(qtdParents, containers, false);
            }
            else if( filter == "Validade" )
            {
                order(dateParents, containers, false);
            }
            else if( filter == "Nome" )
            {
                order(nameParents, containers, false);
            }
		}
	});
});