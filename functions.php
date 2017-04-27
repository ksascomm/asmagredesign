<?php

//add menu support
	add_theme_support( 'menus' );

//register menus
	function asmag_register_my_menus() {
  		register_nav_menus(
    		array( 'subpage-menu' => __( 'Subpage Menu' ), 'footer-menu' => __('Footer Menu'), 'issue-menu'=> __('Issue Menu'))
  		);
	}

// initiate register menus
	add_action( 'init', 'asmag_register_my_menus' );

//register thumbnail/featured image support
	add_theme_support( 'post-thumbnails' );

// name of the thumbnail, width, height, crop mode
	add_image_size( 'exclusive', 220, 110, true );
	add_image_size( 'homethumb', 60, 70, true );
	add_image_size( 'alumni', 150, 130, true );
	add_image_size( 'filterthumb', 235, 195, true);
	add_image_size( 'filterthumbbig', 520, 280, true);

//pagination function
	function asmag_pagination($prev = 'Ç', $next = 'È') {
    	global $wp_query, $wp_rewrite;
    	$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
    	$pagination = array(
    	    'base' => @add_query_arg('paged','%#%'),
    	    'format' => '',
    	    'total' => $wp_query->max_num_pages,
    	    'current' => $current,
    	    'prev_text' => __($prev),
    	    'next_text' => __($next),
    	    'type' => 'plain'
		);
    	if( $wp_rewrite->using_permalinks() )
    	    $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );

    	if( !empty($wp_query->query_vars['s']) )
    	    $pagination['add_args'] = array( 's' => get_query_var( 's' ) );

    	echo paginate_links( $pagination );
	};

//register sidebars
	if ( function_exists('register_sidebar') )
		register_sidebar(array(
			'name'          => 'Homepage Sidebar',
			'id'            => 'homepage-sb',
			'description'   => '',
			'before_widget' => '<div id="homepage-widget" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widgettitle">',
			'after_title'   => '</h2>'
			));
//Add Theme Options Page
	if(is_admin()){
		require_once('assets/functions/asmag-theme-settings-basic.php');
	}

	//Collect current theme option values
		function asmag_get_global_options(){
			$asmag_option = array();
			$asmag_option 	= get_option('asmag_options');
		return $asmag_option;
		}

	//Function to call theme options in theme files
		$asmag_option = asmag_get_global_options();

//Change Excerpt Length -- Add to functions.php
function asmag_new_excerpt_length($length) {
	return 20; //Change word count
}
add_filter('excerpt_length', 'asmag_new_excerpt_length');

//Add iframe shortcode
if ( !function_exists( 'iframe_embed_shortcode' ) ) {
	function iframe_embed_shortcode($atts, $content = null) {
		extract(shortcode_atts(array(
			'width' => '100%',
			'height' => '480',
			'src' => '',
			'frameborder' => '0',
			'scrolling' => 'no',
			'marginheight' => '0',
			'marginwidth' => '0',
			'allowtransparency' => 'true',
			'id' => '',
			'same_height_as' => ''
		), $atts));
		$src_cut = substr($src, 0, 35);
		if(strpos($src_cut, 'maps.google' )){
			$google_map_fix = '&output=embed';
		}else{
			$google_map_fix = '';
		}
		$return = '';
		if( $id != '' ){
			$id_text = 'id="'.$id.'" ';
		}else{
			$id_text = '';
		}
		$return .= '<div class="video-container"><iframe '.$id_text.' width="'.$width.'" height="'.$height.'" src="'.$src.$google_map_fix.'" frameborder="'.$frameborder.'" scrolling="'.$scrolling.'" marginheight="'.$marginheight.'" marginwidth="'.$marginwidth.'" allowtransparency="'.$allowtransparency.'" webkitAllowFullScreen allowFullScreen  wmode="transparent"></iframe></div>';
		// &amp;output=embed
		return $return;
	}
	add_shortcode('iframe', 'iframe_embed_shortcode');
}

//Add Volume/Issue Taxonomy
function create_my_taxonomies() {
	register_taxonomy('volume', array( 'post', 'page', 'accordion' ), array( 'hierarchical' => true, 'label' => 'Volume/Issue', 'query_var' => true, 'rewrite' => true));
}

add_action('init', 'create_my_taxonomies', 0);

//Conditional for Taxonomy
	function asmag_in_taxonomy($tax, $term, $_post = NULL) {
		// if neither tax nor term are specified, return false
		if ( !$tax || !$term ) { return FALSE; }
		// if post parameter is given, get it, otherwise use $GLOBALS to get post
		if ( $_post ) {
		$_post = get_post( $_post );
		} else {
		$_post =& $GLOBALS['post'];
		}
		// if no post return false
		if ( !$_post ) { return FALSE; }
		// check whether post matches term belongin to tax
		$return = is_object_in_term( $_post->ID, $tax, $term );
		// if error returned, then return false
		if ( is_wp_error( $return ) ) { return FALSE; }
	return $return;
	}
//Remove height and width attributes from image inserts
function myprefix_image_downsize( $value = false, $id, $size ) {
    if ( !wp_attachment_is_image($id) )
        return false;

    $img_url = wp_get_attachment_url($id);
    $is_intermediate = false;
    $img_url_basename = wp_basename($img_url);

    // try for a new style intermediate size
    if ( $intermediate = image_get_intermediate_size($id, $size) ) {
        $img_url = str_replace($img_url_basename, $intermediate['file'], $img_url);
        $is_intermediate = true;
    }
    elseif ( $size == 'thumbnail' ) {
        // Fall back to the old thumbnail
        if ( ($thumb_file = wp_get_attachment_thumb_file($id)) && $info = getimagesize($thumb_file) ) {
            $img_url = str_replace($img_url_basename, wp_basename($thumb_file), $img_url);
            $is_intermediate = true;
        }
    }

    // We have the actual image size, but might need to further constrain it if content_width is narrower
    if ( $img_url) {
        return array( $img_url, 0, 0, $is_intermediate );
    }
    return false;
}

add_filter( 'image_downsize', 'myprefix_image_downsize', 1, 3 );



function get_the_volume($post) {
			wp_reset_query();
			$post = get_queried_object_id();
			$terms = get_the_terms($post, 'volume');
			$asmag_option = asmag_get_global_options();
			if(is_array($terms)) {
				$term_slugs = array();
				foreach( $terms as $term) {
					if($term->slug != 'feature') {
						$term_slugs[] = $term->slug;
					}
					$volume = implode('', $term_slugs); }
				} else { $volume = $terms['volume']; }
			if(isset($_GET['volume'])) {
				$volume = $_GET['volume'];
			}
			if ($volume == null) {
			$volume = $asmag_option['asmag_current_issue']; }
	return $volume;
}

function get_the_volume_name($post) {
	$post = get_queried_object_id();
	$terms = get_the_terms($post, 'volume');
	$asmag_option = asmag_get_global_options();

		if(is_array($terms)) {
			$term_names = array();
			foreach( $terms as $term) {
				if($term->name != 'Feature') {
					$term_names[] = $term->name;
				}
			 }
			 $volume_name = implode('', $term_names);
		}

		else { $volume_name = $terms; }

		if(isset($_GET['volume'])) {
			$new_volume = $_GET['volume'];
			$new_volume_data = get_term_by('slug', $new_volume, 'volume');
			$volume_name = $new_volume_data->name;
		}

		if ($volume_name == null) {
			$new_volume = $asmag_option['asmag_current_issue'];
			$new_volume_data = get_term_by('slug', $new_volume, 'volume');
			$volume_name = $new_volume_data->name;
		}

	return $volume_name;
}




function delete_magazine_transients($post_id) {
	global $post;
	if (isset($_GET['post_type'])) {
		$post_type = $_GET['post_type'];
	}
	else {
		$post_type = $post->post_type;
	}
		$volumes = get_terms('volume');
		$issues = array();
		foreach($volumes as $volume) {
			$issues[] = $volume->slug;
		}
	switch($post_type) {

		case 'post' :
		  	foreach ($issues as $issue) {
		  		delete_transient('exclusives_' . $issue . '_query');
		  		delete_transient('alumni_' . $issue . '_query');
		  		delete_transient('toc_dropdown_' . $issue . '_query');
		  		delete_transient('front_' . $issue . '_query');
		  	}
		  	delete_transient('web_exclusives_query');
		break;

		case 'page' :
		  	foreach ($issues as $issue) {
		  		delete_transient('features_' . $issue . '_query');
		  		delete_transient('front_features_' . $issue . '_query');
		  	}
		break;
	}
}
add_action('save_post','delete_magazine_transients');


function add_category_to_pages() {
// Add tag metabox to page
register_taxonomy_for_object_type('post_tag', 'page');
// Add category metabox to page
register_taxonomy_for_object_type('category', 'page');
}
add_action( 'admin_init', 'add_category_to_pages' );

//remove scroll-to-top buttin from all pages but v12n1 cover story
add_filter( 'sbtt_button_markup', 'my_sbtt_filter' );
function my_sbtt_filter($button_markup) {
if ( !is_page('5153')) {
return "";
} else {
return $button_markup;
}
}

// Numbered Pagination
if ( !function_exists( 'wpex_pagination' ) ) {

	function wpex_pagination() {

		$prev_arrow = is_rtl() ? '&rarr;' : '&larr;';
		$next_arrow = is_rtl() ? '&larr;' : '&rarr;';

		global $wp_query;
		$total = $wp_query->max_num_pages;
		$big = 999999999; // need an unlikely integer
		if( $total > 1 )  {
			 if( !$current_page = get_query_var('paged') )
				 $current_page = 1;
			 if( get_option('permalink_structure') ) {
				 $format = 'page/%#%/';
			 } else {
				 $format = '&paged=%#%';
			 }
			echo paginate_links(array(
				'base'			=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format'		=> $format,
				'current'		=> max( 1, get_query_var('paged') ),
				'total' 		=> $total,
				'mid_size'		=> 3,
				'type' 			=> 'list',
				'prev_text'		=> $prev_arrow,
				'next_text'		=> $next_arrow,
			 ) );
		}
	}

}

/**
 * Create Custom Image Sizes for Responsive
 * Based on Foundations breakpoints for SM, MD, LG
 */
function namespace_add_image_sizes(){
  /* Soft proportional crops */
  add_image_size( 'xtra-large-hero', 1920 );
  add_image_size( 'large-hero', 1400 );
  add_image_size( 'medium-hero', 1024 );
  add_image_size( 'mobile-hero', 640 );
}
add_action( 'init', 'namespace_add_image_sizes');

/**********GET PAGE TITLE TO APPEAR IN <title> TAG******************/
function theme_slug_setup() {
   add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'theme_slug_setup' );

include_once (TEMPLATEPATH . '/assets/functions/asmag-metabox.php');

// Register scripts and stylesheets
require_once(get_template_directory().'/assets/functions/enqueue-scripts.php');
?>
