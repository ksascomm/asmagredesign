<?php
/*
Template Name: Feature - Full Width (Use with Redesign)
*/
?>

<?php get_header(); ?>
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 
		$page = get_queried_object();
		$page_name = $page->post_name; 
		 ?>
	
	<?php $image = wp_get_attachment_url( get_post_thumbnail_id() ); ?>
 <section class="intro-header" style="background-image: url('<?php echo $image; ?>')">
 		<div class="row">
                <div class="small-12 medium-10 medium-offset-1 large-8 large-offset-2 columns">
                    <div class="post-heading">
                        <h2><?php the_title(); ?></h2>
                        <?php if ( get_post_meta($post->ID, 'ecpt_tagline', true) ) : ?>  <h4 class="small-12 columns"><?php echo get_post_meta($post->ID, 'ecpt_tagline', true); ?></h4><?php endif; ?>
                    </div>
                </div>
        </div>
  </section>
	<div class="headerbreak"></div>
	<div id="container-mid">
	<div id="feature story">
	    <div class="row">
	    	<div class="small-12 medium-3 medium-push-10 columns">
				<p class="othercredits"><?php if ( get_post_meta($post->ID, 'ecpt_other_credits', true) ) : ?>  <?php echo get_post_meta($post->ID, 'ecpt_other_credits', true); ?><?php endif; ?></p>
	    	</div>
			<div class="small-12 medium-8 medium-pull-2 columns">
				<?php the_content(); ?>
			</div>
		</div><!--End postmaterial -->
		<div class="full-width">
		 	<img src="<?php echo get_post_meta($post->ID, 'ecpt_fullimage', true); ?>">
		 		<div class="caption"><?php if ( get_post_meta($post->ID, 'ecpt_pull_quote', true) ) : ?>  <?php echo get_post_meta($post->ID, 'ecpt_pull_quote', true); ?><?php endif; ?></div>
		</div>
<div class="row">
		<div class="small-12 medium-8 medium-offset-2 columns story">
			<p><?php if ( get_post_meta($post->ID, 'ecpt_second_section', true) ) : ?>  <?php echo get_post_meta($post->ID, 'ecpt_second_section', true); ?><?php endif; ?></p>
		</div>
		</div>
	
	<?php endwhile; endif; wp_reset_query(); ?>
	</div>
<?php locate_template('parts/footer_feature.php', true, false);	get_footer(); ?>