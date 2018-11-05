$(document).ready(function(){
	$('.dropdown-arrow').on('click', function(){
		$('.user-info').toggleClass('visible');
	})
	$('#content').not('.user-info').on('click', function(){
		$('.user-info').removeClass('visible');
	})
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

	var nightmode = localStorage.getItem("nightmode");
	if(nightmode == "true"){
		$('#checkstyle').attr('href', 'css/night_mode.css');
	}
	else{
			$('#checkstyle').attr('href', 'css/home_content.css');
	}

	$('#a').on('click', function(){
		window.location.href = "index.php";
	})
	$('#b').on('click', function(){
		window.location.href = "funcionarios.php";
	})
	$('#c').on('click', function(){
		window.location.href = "listas.php";
	})
	$('#d').on('click', function(){
		window.location.href = "movimentacoes.php";
	})
	$('#e').on('click', function(){
		window.location.href = "logs.php";
	})
})
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
