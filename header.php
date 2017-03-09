<!doctype html>
<html class="no-js" lang="en">
	<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		
		<?php $volume = get_the_volume($post); ?>

		<!-- CSS -->
		<link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/css/app.min.css">
		
		<?php if (is_page('on-display')) { ?>
			<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/features/on-display.css">
		<?php } ?>
		
		<?php if (is_page_template( 'lifespan-adult.php' ) || is_page_template( 'lifespan-baby.php' ) || is_page_template( 'lifespan-elder.php' ) || is_page_template( 'lifespan-expert.php' ) || is_page_template( 'lifespan-home.php' ) || is_page_template( 'lifespan-teen.php' ) ){ ?><link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/assets/css/features/learning-along-the-lifespan.css"> <?php } ?>
		
		<!-- JS -->
		<?php wp_enqueue_script('jquery'); ?>
		<script async src="<?php echo get_template_directory_uri() ?>/assets/js/modernizr.js"></script>
		<script src="<?php echo get_template_directory_uri() ?>/assets/js/headroom.js">></script>

		<!-- ETC -->
		<?php wp_head(); ?>
		
	<!-- Make IE a modern browser -->
	<!--[if IE]>
		<script src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://cdn.jsdelivr.net/css3-mediaqueries/0.1/css3-mediaqueries.min.js"></script>
	<![endif]-->
  	<!--[if lt IE 11]>
		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri() ?>/assets/css/app.ie.css">
		<div data-alert class="alert-box alert">
		<?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.'); ?>	
		</div>		
	<![endif]-->
	
	</head>

<body <?php body_class($volume); ?>>
<?php include_once("analytics.php") ?>	

<header>
		<?php if (is_page_template('template-tableofcontents.php') || is_page_template('template-tableofcontents-features.php')) :
				locate_template('/parts/header_homepage.php', true, false);
			else: 
				locate_template('/parts/header_subpage.php', true, false);  
		endif; ?>
</header>

