<?php
/*
Template Name: Lifespan - Home
*/
?>
<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?> <!--Start the loop -->
<div id="lifespan_home">
<div id="head" class="lifespan"></div>
<div class="row">
	<div class="small-12 columns">
		<h3 class="featuretitle"><?php the_title(); ?></h3>
		<h4 class="tagline"><?php if ( get_post_meta($post->ID, 'ecpt_tagline', true) ) : ?>  <?php echo get_post_meta($post->ID, 'ecpt_tagline', true); ?><?php endif; ?></h4>
	</div>
</div>

<div class="row">
	<div class="small-12 medium-4 columns">
		<?php locate_template('parts/v10n2_lifespan_nav.php', true, false);	?>			
	</div>
	
	<div class="small-12 medium-5 columns">
		<?php the_content(); ?>
	</div>
	
	<div class="small-12 medium-2 columns">
		<?php locate_template('parts/v10n2_lifespan_stats.php', true, false);	?>
	</div>
</div>
</div>
<?php endwhile; endif;
 locate_template('parts/footer_feature.php', true, false);				
 get_footer(); ?>