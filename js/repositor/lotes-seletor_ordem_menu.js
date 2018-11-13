
$(document).ready(function(){
	

	$("#order-selector").on('click', function(){
		var pageName = location.pathname.substring(location.pathname.lastIndexOf("/") + 1);

		var nameParents = scanHtml('input.batch-product', 'div.batch', 'product');
		if( pageName == "prateleira.php" || pageName == "lotes.php")
	        var qtdParents = scanHtml('input.qtd', 'div.batch', 'qtd');
	    if( pageName == "lotes.php")
	        var dateParents = scanHtml('input.date-content', 'div.batch', 'date');
	    if( pageName == "produtos.php")
	    	var nameParents = scanHtml('div.product-product', 'div.product', 'product');
	    
	    var containers = $('.content').find('div.batch');
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
            	addSeeListeners();
            }
            else if( filter == "Validade" )
            {
                order(dateParents, containers, true);
                addSeeListeners();
            }
            else if( filter == "Nome" )
            {
                order(nameParents, containers, true);
                addSeeListeners();
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
            	addSeeListeners();
            }
            else if( filter == "Validade" )
            {
                order(dateParents, containers, false);
                addSeeListeners();
            }
            else if( filter == "Nome" )
            {
                order(nameParents, containers, false);
                addSeeListeners();
            }
		}
	});
});