<?php
/*
Template Name: Letters to the Editor
*/
?>	
<?php get_header(); ?>
<div id="container-mid">
	<div class="row" id="content">
	    <article class="small-12 medium-8 columns" id="article">
	    		<div class="postmaterial">
					<h3 class="letters">Letters to the Editor</h3>
				<?php $letters_query = new WP_Query(array(
						'post_type' => 'post',
						'cat' => '56',
						'order' => 'DESC',
						'posts_per_page' => '-1')); ?>
		
						<?php while ($letters_query->have_posts()) : $letters_query->the_post(); ?>
						<div class="row">
						    <div class="small-12 columns">
						    	<h4 class="letters"><?php the_title(); ?></h4>
						    		<?php the_content(); ?>
						    </div>
						</div>
						<?php $volume = get_the_volume($post); $volume_name = get_the_volume_name($post); endwhile; wp_reset_query() ?>

				</div>
		</article> <!--article -->
	
	
	<?php if ( false === ( $features_query = get_transient( 'features' . $volume . '_query' ) ) ) { 

				$features_query = new WP_Query(array(
						'post_type' => 'page',
						'tax_query' => array ( 
						'relation' => 'AND',
						array (
							'taxonomy' => 'volume',
							'terms' => array( $volume ),
							'field' => 'slug',
							'include_children' => false,
							'operator' => 'IN'),
						array (
							'taxonomy' => 'volume',
							'terms' => array( 'feature' ),
							'field' => 'slug',
							'include_children' => false,
							'operator' => 'IN'),	
							),
						'order' => 'ASC',
						'posts_per_page' => '-1')); 
				set_transient( 'features' . $volume . '_query', $features_query, 86400 ); } ?>
				
	<div class="small-12 medium-4 columns" id="sidebar">
		<div class="row">
			<div class="small-12 columns table">
				<a href="#" data-reveal-id="modal_toc" onclick="ga('send', 'event', 'Table of Contents', '<?php echo $volume_name ?>');">	
					<h4>View <?php echo $volume_name; ?> Contents<span class="spacer"></span></h4>
				</a>
			</div>		
			<div class="small-12 columns features">
				<h4>Current Feature Stories<span class="spacer"></span></h4>
			</div>
			
			<?php while ($features_query->have_posts()) : $features_query->the_post(); ?>
	    		<div class="small-12 columns">
	    			<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
		    			<h5><?php the_title(); ?></h5>
								<?php if ( get_post_meta($post->ID, 'ecpt_tagline', true) ) :  echo '<p>' . get_post_meta($post->ID, 'ecpt_tagline', true) . '</p>'; else : echo '<p>' . get_the_excerpt() . '</p>'; endif; ?>
	    			</a>
	    		</div><!-- End subtext -->
   			<?php endwhile; wp_reset_query() ?>
	</div> 
	
	</div> <!--End content -->
</div> <!--End container-mid -->
<?php get_footer(); ?>
