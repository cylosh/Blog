// tooltip

$('i.fa').tooltip();

// initiate configuration of different modules

$(document).ready(function() {
 
  	$("#owl-header").owlCarousel({
 
      	navigation : false, // Show next and prev buttons
      	slideSpeed : 300,
      	autoPlay: true,
      	pagination: false,
      	paginationSpeed : 1000,
      	singleItem:true
 
      	// "singleItem:true" is a shortcut for:
      	// items : 1, 
      	// itemsDesktop : false,
      	// itemsDesktopSmall : false,
      	// itemsTablet: false,
      	// itemsMobile : false
 
  	});
	
	$('#showdown').click(function(){
		$('body').animate({
			scrollTop: $(".navbar-header").offset().top},1500);});

	
	$('body').animate({
		scrollTop: $("#scrolltojs").offset().top},3000);

});