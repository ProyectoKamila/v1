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
$(function() {
        console.log('el documento está preparado');

});