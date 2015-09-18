<?php
/*
Template Name: Lifespan - Teen
*/
?>
<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?> <!--Start the loop -->
<div id="lifespan_teen" class="lifespan">
<div class="row">

	
	<div class="small-12 medium-6 columns" id="story">
		<h3><?php the_title(); ?></h3>
		<?php the_content(); ?>
		<p><em>&#8212;<?php the_author(); ?></em></p>
	</div>
	
	<div class="small-12 medium-4 columns">
		<?php locate_template('parts/v10n2_lifespan_nav.php', true, false);	?>			
	</div>
</div>
</div>
<?php endwhile; endif;
 	locate_template('parts/footer_feature.php', true, false);				
 	get_footer(); ?>