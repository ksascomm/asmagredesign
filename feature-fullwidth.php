<?php
/*
Template Name: Feature - Full Width (Use with Redesign)
*/
?>
<?php $image = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'fullbleed'  );
$img_size_lg = 'large-hero'; 
$img_size_md = 'medium-hero';
$img_size_sm = 'mobile-hero';
 
$feat_img_id = get_post_thumbnail_id();
 
/* Use ID to get the attachment object */
$xlg_hero_array = wp_get_attachment_image_src( $feat_img_id, 'xtra-large-hero', true ); //X-Large Hero
$lg_hero_array = wp_get_attachment_image_src( $feat_img_id, 'large-hero', true ); //Large Hero
$md_hero_array = wp_get_attachment_image_src( $feat_img_id, 'medium-hero', true ); // Medium Hero
$sm_hero_array = wp_get_attachment_image_src( $feat_img_id, 'mobile-hero', true ); // Mobile Hero
 
/* Grab the url from the attachment object */
$hero_xlg = $xlg_hero_array[0]; //X-Large Hero
$hero_lg = $lg_hero_array[0]; //Large Hero
$hero_md = $md_hero_array[0]; // Medium Hero
$hero_sm = $sm_hero_array[0]; // Mobile Hero

 ?>
<?php get_header(); ?>
	<?php if ( have_posts() ) : 
		$page = get_queried_object();
		$page_name = $page->post_name; 
		 ?>	

		 <!-- Hook up Interchange as a background image -->

<?php /* add per post custom CSS */ if ( get_post_meta($post->ID, 'ecpt_asmag_css', true) ) { echo '<style>' . get_post_meta($post->ID, 'ecpt_asmag_css', true) . '</style>'; } ?> 

<main> 
<?php while ( have_posts() ) : the_post(); ?>
	<div class="intro-header">
	 	<div class="intro-hero" data-interchange="[<?php echo $hero_xlg; ?>, (default)], [<?php echo $hero_sm; ?>, (small)], [<?php echo $hero_md; ?>, (medium)], [<?php echo $hero_lg; ?>, (large)] [<?php echo $hero_xlg; ?>, (xlarge)]">
	 	 		<div class="row">
	                <div class="small-7 small-offset-5 medium-6 medium-offset-6 large-7 large-offset-6 columns">
	                    <div class="post-heading">
	                        <h2><?php the_title(); ?></h2>
								<?php if (!is_handheld()) : ?>
								<div class="show-for-large-up">
			                        <?php if ( get_post_meta($post->ID, 'ecpt_tagline', true) ) : ?> 
			                        	<div id="tagline">
			                        		<h4>
			                        			<?php echo get_post_meta($post->ID, 'ecpt_tagline', true); ?>
			                        		</h4>
			                        	</div>
			                        <?php endif; ?>
			                    </div>   
			                    <?php endif ;?>
	                    </div>
	                </div>
	        </div>
	    </div>
	 </div>

	<div class="headerbreak hide-for-small"></div>

	<div class="cd-scrolling-bg">
		<div id="container-mid">
			<div id="feature story">
			<?php if (is_handheld()) : ?>	
			  	<div class="row">
					<div class="small-12 medium-10 medium-offset-1 columns">
						<?php if ( get_post_meta($post->ID, 'ecpt_tagline', true) ) : ?> 
			  				<h5 class="feature-tag"><?php echo get_post_meta($post->ID, 'ecpt_tagline', true); ?></h5>
			  			<?php endif; ?>
						<p class="othercredits"><?php if ( get_post_meta($post->ID, 'ecpt_other_credits', true) ) : ?> <?php echo get_post_meta($post->ID, 'ecpt_other_credits', true); ?><?php endif; ?></p>
					</div>
				</div>
				<div class="row">	
					<div class="small-12 medium-10 medium-offset-1 columns feature-intro">
						<?php the_content(); ?>
					</div>
				</div>
			<?php else: ?>
				<div class="row">
					<div class="small-12 columns hide-for-large-up">
						<?php if ( get_post_meta($post->ID, 'ecpt_tagline', true) ) : ?> 
			  				<h5 class="feature-tag"><?php echo get_post_meta($post->ID, 'ecpt_tagline', true); ?></h5>
			  			<?php endif; ?>
						<p class="othercredits"><?php if ( get_post_meta($post->ID, 'ecpt_other_credits', true) ) : ?> <?php echo get_post_meta($post->ID, 'ecpt_other_credits', true); ?><?php endif; ?></p>
			    	</div>
			    	<div class="small-12 large-8 large-offset-2 columns feature-intro">
						<?php the_content(); ?>
					</div>
			    	<div class="small-12 large-2 columns show-for-large-up">
						<p class="othercredits"><?php if ( get_post_meta($post->ID, 'ecpt_other_credits', true) ) : ?> <?php echo get_post_meta($post->ID, 'ecpt_other_credits', true); ?><?php endif; ?></p>
			    	</div>
				</div>
			<?php endif;?>	
		<!--End first section -->		
			<?php if (!is_handheld()) : ?>
				<?php if ( get_post_meta($post->ID, 'ecpt_fullimage', true) ) : ?> 
					<div class="full-width-fixed-bg" style="background-image: url('<?php echo get_post_meta($post->ID, 'ecpt_fullimage', true); ?>')">
				 		<?php if ( get_post_meta($post->ID, 'ecpt_pull_quote', true) ) : ?>  
				 			<div class="show-for-large-up caption">
				 				<p><?php echo get_post_meta($post->ID, 'ecpt_pull_quote', true); ?></p>
				 			</div>
				 		<?php endif; ?>	
				 	</div>
				 	<div class="row hide-for-large-up">
				 			<div class="small-12 medium-8 medium-offset-2 columns">
				 				<?php if ( get_post_meta($post->ID, 'ecpt_pull_quote', true) ) : ?> <p><blockquote> <?php echo get_post_meta($post->ID, 'ecpt_pull_quote', true); ?></blockquote></p><?php endif; ?>
				 			</div>
				 	</div>
				 <?php endif; ?>

			<?php else: ?>
				<div class="row">
					<img src="<?php echo get_post_meta($post->ID, 'ecpt_fullimage', true); ?>">
				 		<div class="small-12 medium-8 medium-offset-2 columns">
				 			<?php if ( get_post_meta($post->ID, 'ecpt_pull_quote', true) ) : ?> <p><blockquote> <?php echo get_post_meta($post->ID, 'ecpt_pull_quote', true); ?></blockquote></p><?php endif; ?>
						</div>
				</div>
			<?php endif; ?>	


				<div class="row">	
					<div class="small-12 medium-10 medium-offset-1 large-8 large-offset-2 columns story">
						<p><?php if ( get_post_meta($post->ID, 'ecpt_second_section', true) ) : ?>  <?php echo get_post_meta($post->ID, 'ecpt_second_section', true); ?><?php endif; ?></p>
					</div>
				</div>

		<!--End second section -->		
			</div>
		</div>
	</div>
<?php endwhile; endif; wp_reset_query(); ?>
	
<?php locate_template('parts/footer_feature.php', true, false);	get_footer(); ?>
</main>