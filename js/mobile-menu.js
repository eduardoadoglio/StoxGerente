$(document).ready(function(){
  $('#hamburger').on('click', function(){
    $('.side-mobile').toggleClass('show');
    $('#layer').css('display', 'block');
    $('body').css('overflow', 'hidden');
  })
  $('#close-btn, #layer').on('click', function(){
    $('.side-mobile').removeClass('show');
    $('.side-mobile').addClass('close-menu');
    $('#layer').css('display', 'none');
    $('body').css('overflow', 'auto');
    setTimeout(RemoverClasse, 500);
  })

});
function RemoverClasse(){
  $('.side-mobile').removeClass('close-menu');
}
