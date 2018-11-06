$(document).ready(function(){

	// Funções de Dropdown do usuário
	$('.dropdown-arrow').on('click', function(){
		$('.user-info').toggleClass('visible');
		if($('.notification-info').hasClass('visible')){
			$('.notification-info').removeClass('visible');
		}
	})
	$('#content').not('.user-info').on('click', function(){
		$('.user-info').removeClass('visible');
	})

	// Funções de Dropdown das notificações
	
	$('.dropdown-bell').on('click', function(){
		$('.notification-info').toggleClass('visible');
		if($('.user-info').hasClass('visible')){
			$('.user-info').removeClass('visible');
		}
	})
	$('#content').not('.notification-info').on('click', function(){
		$('.notification-info').removeClass('visible');
	})

	// Links do Side-Menu

	$('#a').click(function(){
		window.location = "index.php";
	})
	$('#b').click(function(){
		window.location = "funcionarios.php";
	})
	$('#c').click(function(){
		window.location = "lotes.php";
	})
	$('#d').click(function(){
		window.location = "movimentacoes.php";
	})
	$('#e').click(function(){
		window.location = "produtos.php";
	})

	// Ativação do Night Mode

	$('.trigger').on('click', function(){
		if($('.night-btn').hasClass('nightmode')){
			$('.night-btn').removeClass('nightmode');
			$('.night-btn').addClass('daymode');
			localStorage.setItem('nightmode','false');
			$.ajax({
				type: 'POST',
				url: 'include/nightmode.php',
				data: {cookie: localStorage.getItem('nightmode')},
				success:function(result){
					location.reload();
				}
			})
		}
		else if($('.night-btn').hasClass('daymode')){
			$('.night-btn').removeClass('daymode');
			$('.night-btn').addClass('nightmode');
			localStorage.setItem('nightmode','true');
			$.ajax({
				type: 'POST',
				url: 'include/nightmode.php',
				data: {cookie: localStorage.getItem('nightmode')},
				success:function(result){
					location.reload();
				}
			})
		}
	})

	// LocalStorage do Night Mode (verificar se é realmente necessário depois)

	var nightmode = localStorage.getItem("nightmode");
	if(nightmode == "true"){
		$('#checkstyle').attr('href', 'css/night_mode.css');
	}
	else{
			$('#checkstyle').attr('href', 'css/home_content.css');
	}

})

// Cookie do Night Mode
var createCookie = function(name, value, days) {
    var expires;
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
    }
    else {
        expires = "";
    }
    document.cookie = name + "=" + value + expires + "; path=/";
}

function getCookie(c_name) {
    if (document.cookie.length > 0) {
        c_start = document.cookie.indexOf(c_name + "=");
        if (c_start != -1) {
            c_start = c_start + c_name.length + 1;
            c_end = document.cookie.indexOf(";", c_start);
            if (c_end == -1) {
                c_end = document.cookie.length;
            }
            return unescape(document.cookie.substring(c_start, c_end));
        }
    }
    return "";
}
