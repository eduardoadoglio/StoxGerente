
$(document).ready(function(){
    var pageName = location.pathname.substring(location.pathname.lastIndexOf("/") + 1);

    var nameParents = scanHtml('input.batch-product', 'div.batch', 'product');
    if( pageName == "prateleira.php" || pageName == "lotes.php")
        var qtdParents = scanHtml('input.qtd', 'div.batch', 'qtd');
    if( pageName == "lotes.php")
        var dateParents = scanHtml('input.date-content', 'div.batch', 'date');
    if( pageName == "produtos.php")
            var nameParents = scanHtml('div.product-product', 'div.product', 'product');
    
    var oldHtml = new Array();

    var containers = $('.content').find('div.batch');
    for( var index = 0; index < containers.length; index++)
    {
        oldHtml.push(containers[index].innerHTML);
    }

    var last = undefined;
    $(".filter").on('click', function(){
        /*
        Primeiro verifica se está checado, se estiver, descheca. Depois, descheca o último que foi clicado. por último, checa se já não estiver checado
         */
        var containers = $('.content').find('div.batch');
        var isChecked = $(this).attr('data-checked'); /* valor ANTES da alteração abaixo*/
        if(isChecked == 'checked')
        {
            null;      
        }

        if( last != undefined ) /* se isso for pra cima, vai atrapalhar a checagem do isChecked */
        {
            null; 
        }
        

        if(isChecked == 'unchecked')
        {
            var orderVal = document.getElementById("order-selector").className;
            console.log(orderVal);
            $(document).find('.filter i').removeClass('far fa-check-square');
            $(document).find('.filter i').addClass('far fa-square');
            $(document).find('.filter').attr('data-checked', 'unchecked');
            
            $(this).find("i").removeClass();
            $(this).find("i").addClass('far fa-check-square');
            $(this).attr('data-checked', 'checked');
            last = $(this);
            
            if(orderVal == "down")
            {
                if( pageName == "prateleira.php" || pageName == "lotes.php")
                    var qtdParents = scanHtml('input.qtd', 'div.batch', 'qtd');
                if( pageName == "lotes.php")
                    var dateParents = scanHtml('input.date-content', 'div.batch', 'date');

                var nameParents = scanHtml('input.batch-product', 'div.batch', 'product');
                var containers = $('.content').find('div.batch');
                console.log(containers);
                if( $(this).text() == "Quantidade" )
                    order(qtdParents, containers, true);
                else if( $(this).text() == "Validade" )
                    order(dateParents, containers, true);
                else if( $(this).text() == "Nome" )
                    order(nameParents, containers, true);
            }
            else
            {
                if( pageName == "prateleira.php" || pageName == "lotes.php")
                    var qtdParents = scanHtml('input.qtd', 'div.batch', 'qtd');
                if( pageName == "lotes.php")
                    var dateParents = scanHtml('input.date-content', 'div.batch', 'date');

                var nameParents = scanHtml('input.batch-product', 'div.batch', 'product');
                var containers = $('.content').find('div.batch');
                if( $(this).text() == "Quantidade" )
                    order(qtdParents, containers, false);
                else if( $(this).text() == "Validade" )
                    order(dateParents, containers, false);
                else if( $(this).text() == "Nome" )
                    order(nameParents, containers, false);
            }
        }
    })
});