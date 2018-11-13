
$(document).ready(function(){
    var pageName = location.pathname.substring(location.pathname.lastIndexOf("/") + 1);

    var nameParents = scanHtml('div.batch-product', 'div.batch', 'product');
    var containers = $('.content').find('div.batch');
    var oldHtml = new Array();

    if( pageName == "prateleira.php" || pageName == "lotes.php")
    {
        var qtdParents = scanHtml('div.qtd', 'div.batch', 'qtd');
    }
    if( pageName == "lotes.php")
    {
        var dateParents = scanHtml('div.date-content', 'div.batch', 'date');
    }
    if( pageName == "produtos.php")
    {
        var nameParents = scanHtml('div.product-product', 'div.product', 'product');
        containers = $('.content').find('div.product');
    }
    if( pageName == "movimentacoes.php"){
        var dateParents = scanHtml('div.date-content', 'div.batch', 'date');
    }
    for( var index = 0; index < containers.length; index++)
    {
        oldHtml.push(containers[index].innerHTML);
    }

    var last = undefined;
    $(".filter").on('click', function(){
        /*
        Primeiro verifica se está checado, se estiver, descheca. Depois, descheca o último que foi clicado. por último, checa se já não estiver checado
         */
        if( pageName == 'produtos' ) 
        {
            var containers = $('.content').find('div.product');
        }
        else{
            var containers = $('.content').find('div.batch');
        }

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
                var nameParents = scanHtml('div.batch-product', 'div.batch', 'product');
                var containers = $('.content').find('div.batch');
                if( pageName == "prateleira.php" || pageName == "lotes.php")
                    var qtdParents = scanHtml('div.qtd', 'div.batch', 'qtd');
                if( pageName == "lotes.php")
                    var dateParents = scanHtml('div.date-content', 'div.batch', 'date');
                if(pageName == "produtos.php"){
                    nameParents = scanHtml('div.product-product', 'div.product', 'product');
                    containers = $('.content').find('div.product');
                }

                if( $(this).text() == "Quantidade" )
                    order(qtdParents, containers, true);
                else if( $(this).text() == "Validade" )
                    order(dateParents, containers, true);
                else if( $(this).text() == "Nome" )
                    order(nameParents, containers, true);
            }
            else
            {
                var nameParents = scanHtml('div.batch-product', 'div.batch', 'product');
                var containers = $('.content').find('div.batch');
                if( pageName == "prateleira.php" || pageName == "lotes.php")
                    var qtdParents = scanHtml('div.qtd', 'div.batch', 'qtd');
                if( pageName == "lotes.php")
                    var dateParents = scanHtml('div.date-content', 'div.batch', 'date');
                if(pageName == "produtos.php"){
                    nameParents = scanHtml('div.product-product', 'div.product', 'product');
                    containers = $('.content').find('div.product');
                }

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