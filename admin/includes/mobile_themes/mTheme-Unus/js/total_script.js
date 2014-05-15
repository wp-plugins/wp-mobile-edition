$(document).ready(function() {
// Topo link
    $('a[href=#top]').click(function(){
        $('html, body').animate({scrollTop:0}, 'slow');
        return false;
    });

// menu
	 $('.fdx_catlink > a').click(function() {
     $('.fdx_categories2').slideToggle('slow');
     $('.fdx_search,.fdx_contact').slideUp();

	});

	$('.fdx_searchlink > a').click(function() {
		$('.fdx_search').slideToggle('slow');
        $('.fdx_categories2,.fdx_contact').slideUp();
	});

	$('.fdx_contactlink > a').click(function() {
		$('.fdx_contact').slideToggle('slow');
        $('.fdx_categories2,.fdx_search').slideUp();

	});
//end
});
   
