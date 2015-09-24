<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/assets/js/jquery.photomosaic.js"></script>
			<script>
    var $q = jQuery.noConflict();
			$q(function(){

    var $mosaic = $q('#mosaic');
     $q(document).ready(function(){
        $mosaic.photoMosaic({
        	input : 'html',
        	columns : 6,
        	modal_name : 'lightbox',
        	external_links : true,
        	random : true
        });
    });
	$q("a.popup").fancybox({
		openEffect	: 'fade',
		closeEffect	: 'fade',
		helpers : {
        overlay : {
            css : {
                'background' : 'rgba(43, 42, 46, 0.7)'
            }
        }
    }
	});
    });
</script>