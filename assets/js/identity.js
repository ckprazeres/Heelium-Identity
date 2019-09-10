jQuery( document ).ready( function( $ ) {

	//Mobile menu icon animation
	$('#mobile-menu-icon').click(function(){
		$(this).toggleClass('open');
	});

	//Prevent # links in main nav scroll to top of page
	$('a.dropdown-toggle').click(function (e) {
		e.preventDefault();
	})

});