
var modalLock = false; // Garante que apenas um modal será exibido por vez
function mostrarAviso(tipo, texto)
{
	if( modalLock == false )
	{
		modalLock = true;
		if(tipo == 'sucesso')
		{
			var iconClass = 'far fa-thumbs-up';
			var cor = '#81d491';
		}
		else if(tipo == 'erro')
		{
			var iconClass = 'fas fa-exclamation-triangle';
			var cor = '#FF4343';
		}
		else
		{
			var iconClass = 'fas fa-exclamation-triangle';
			var cor = '#FFDA43';
		}
		$("#modal-aviso").css('background-color', cor);
		$("#modal-aviso i").removeClass();
		$("#modal-aviso i").addClass(iconClass);
		$("#modal-text").text(texto);
		$("#modal-aviso").addClass("trigger-slide-aviso-down");

		setTimeout(function(){
			$("#modal-aviso").removeClass();
			$("#modal-aviso").addClass('trigger-slide-aviso-up');
		}, 3000);
		setTimeout(function(){
			$("#modal-aviso").removeClass();
			modalLock = false;
		}, 4100);
	}
}
