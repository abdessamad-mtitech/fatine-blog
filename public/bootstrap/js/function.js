$(document).ready(function() {

	/*$('.carousel-inner, .first-slide, .carousel, .carousel-inner .item img').css('height', (window.innerHeight - 70) + 'px');


	$( window ).resize(function() {
 		$('.carousel-inner, .first-slide, .carousel, .carousel-inner .item img').css('height', (window.innerHeight - 70) + 'px');
		});*/

	//$('.first-slide').css('height', window.innerHeight + 'px');

	// filter items on button click
	$('.filters').on( 'click', 'a', function() {
	    var filterValue = $(this).attr('data-filter');
	    if(filterValue == '*') {
	    	$('.ref-item').show(600);
	    } else {
	    	$('.ref-item:not(' + filterValue + ')').hide(600);
			$('.ref-item' + filterValue).show(600);
	    }

	    $('.filters li a').removeClass('is-checked');
	    $(this).addClass('is-checked');
	    
	});


	/* Hide form input values on focus*/ 
    $('input[type="text"]').each(function(){
        var txtval = $(this).val();
        $(this).focus(function(){
            if($(this).val() == txtval){
                $(this).val('')
            }
        });
        $(this).blur(function(){
            if($(this).val() == ""){
                $(this).val(txtval);
            }
        });
    });

     $('textarea').each(function(){
        var txtval = $(this).val();
        $(this).focus(function(){
            if($(this).val() == txtval){
                $(this).val('')
            }
        });
        $(this).blur(function(){
            if($(this).val() == ""){
                $(this).val(txtval);
            }
        });
    });

     $('#main-menu .sub-menu a').click(function(e) {
        setTimeout(function() {
            $(window).scrollTop($(window).scrollTop() - 120);
        }, 0);
     });
   
});