
function getSortedKeys(obj) // retorna as APENAS os índices em string de um array associativo
{
    var keys = []; 
    for(var key in obj) keys.push(key);
    return keys.sort(function(a,b){return obj[a]-obj[b]});
}
function getAlphabeticallySortedKeys(obj)
{
    var keys = []; 
    for(var key in obj) keys.push(key);
    return keys.sort(function(a, b){
		var nameA=obj[a].toLowerCase()
		var nameB=obj[b].toLowerCase();
		if (nameA > nameB)
			return 1;
		if (nameA < nameB)
			return -1;
		return 0; 
	});
}

function getReversed(array)
{
	var newArray = [];
	for( var index = array.length-1; index >= 0; index--)
	{
		newArray.push(array[index]);
	}
	return newArray;
}

function scanHtml(number_class, sorted_container, type)
{
	if( type == 'date' )
	{
		var index = 0;
		var tags = $(document).find(number_class);
		var qtdIds = [];
		for( index=0; index < tags.length; index++)
		{
			var content = tags[index].innerHTML;
			var id = tags[index].id;
			qtdIds[id] = content;
		}

		for( index in qtdIds )
		{
			qtdIds[index] = qtdIds[index].split("/").reverse().join("/"); // converte de dd/mm/yy para yy/mm/dd
			var time = new Date(qtdIds[index]).getTime(); // converte a data em tempo em segundos
			qtdIds[index] = time;
		}
		sorted = getSortedKeys(qtdIds);
		var parents = new Array();
		for( var index = 0; index < sorted.length; index++ )
		{
			var parent = $("#"+sorted[index]).closest(sorted_container).html();
			parents.push(parent);
		}
		return parents;
	}

	else if( type == 'qtd' )
	{
		var index = 0;
		var tags = $(document).find(number_class);
		var qtdIds = [];
		for( index=0; index < tags.length; index++)
		{
			var content = tags[index].innerHTML;
			var id = tags[index].id;
			qtdIds[id] = content;
		}
		sorted = getSortedKeys(qtdIds);
		var parents = new Array();
		for( var index = 0; index < sorted.length; index++ )
		{
			var parent = $("#"+sorted[index]).closest(sorted_container).html();
			parents.push(parent);
		}

		return parents;
	}

	else if( type == 'product')
	{
		var index = 0;
		var tags = $(document).find(number_class);
		var qtdIds = [];
		
		for( index=0; index < tags.length; index++)
		{
			var content = tags[index].innerHTML;
			var id = tags[index].id;
			qtdIds[id] = content;
		}

		sorted = getAlphabeticallySortedKeys(qtdIds);
		var parents = new Array();
		for( var index = 0; index < sorted.length; index++ )
		{
			var parent = $("#"+sorted[index]).closest(sorted_container).html();
			parents.push(parent);
		}

		return parents;
	}
}

function order(sortedParents, containers, reverse) //divs dos conteúdos html dos pais ordenadas e todas as divs pai
{
	if( reverse )
		sortedParents = getReversed(sortedParents);

	for( var index = 0; index < containers.length; index++ )
	{
		var container = containers[index];
		container.innerHTML = sortedParents[index];
	}
}

function disorder(containers, oldHtml)
{
	for( var index = 0; index < containers.length; index++)
    {
        containers[index].innerHTML = oldHtml[index];
    }
    addMoveListeners();
}