!function ($) {
  $(function(){
	
	$('.dropdown-toggle').dropdown()
	
	$('.navbar').scrollspy()
	
	$(".collapse").collapse()
	
	 
	
    // make code pretty
    window.prettyPrint && prettyPrint()
})
}(window.jQuery)


jQuery(document).ready(function($){
	$(function() {
	  $('a[href*=#]:not([href=#])').click(function() {
	    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
	      var target = $(this.hash);
	      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
	      if (target.length) {
	        $('html,body').animate({
	          scrollTop: target.offset().top - 80
	        }, 1000);
	        return false;
	      }
	    }
	  });
	});
});