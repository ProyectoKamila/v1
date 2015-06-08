function activate(){
	console.log('execute activate');
	$('.vip').slideDown();

}
function desactivate(){
	console.log('execute activate');
	$('#forms').slideUp();
}
function game(id){
	console.log(id);
	$('.option-game').slideUp();
	$('.'+id).slideDown();
}
function menu_movil(){
	console.log('menu_movil');
	$('.menu-movil').slideDown();
	$('#menu-movil').attr('onclick','cerrar_movil();');
}
function cerrar_movil(){
	console.log('menu_movil');
	$('.menu-movil').slideUp();
	$('#menu-movil').attr('onclick','menu_movil();');
}


function mostrar_create_sala (){
    console.log('mostrar_create_sala');
    $('#sales').addClass('sales-close');
    $('.create-salas').addClass('create-salas-visible');
    $('.playing').slideUp();
}
function ocultar_create_sala (){
    console.log('ocultar_create_sala');
    $('#sales').removeClass('sales-close');
    $('.create-salas').removeClass('create-salas-visible');
    $('.playing').slideDown();
}
function ocultar_carga (){
    console.log('ocultar_create_sala');
    $('#torbo').slideUp('');
    
}
