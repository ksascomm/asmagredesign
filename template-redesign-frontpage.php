<?php
/*
Template Name: Redesign Front Page
*/
?>
	
<?php get_header(); ?>
<div class="main" role="main">
	<?php 
		$volume = get_the_volume($post);
		$parent = get_queried_object_id();
	
		$asmag_news_query = new WP_Query(array(
			'post_type' => 'post',
			'volume' => $volume,
			'category__in' => array(1),
			'orderby' => 'modified',
			'order' => 'DESC',
			'posts_per_page' => '-1'));

		$asmag_bigideas_query = new WP_Query(array(
			'post_type' => 'post',
			'volume' => $volume,
			'category__in' => array(70),
			'orderby' => 'modified',
			'order' => 'DESC',
			'posts_per_page' => '-1'));

		$asmag_students_query = new WP_Query(array(
			'post_type' => 'post',
			'volume' => $volume,
			'category__in' => array(76),
			'orderby' => 'modified',
			'order' => 'DESC',
			'posts_per_page' => '-1'));

		$asmag_alumni_query = new WP_Query(array(
			'post_type' => 'post',
			'volume' => $volume,
			'category__in' => array(69),
			'orderby' => 'modified',
			'order' => 'DESC',
			'posts_per_page' => '-1'));

		$asmag_cover_story_query = new WP_Query(array(
			'post_type' => 'page',
			'volume' => $volume,
			'post_parent' => $parent,
			'page_id' => 7015,			
			));

		$exclude_ids = array( 7015 );
		$asmag_features_query = new WP_Query(array(
			'post_type' => 'page',
			'volume' => $volume,
			'post_parent' => $parent,
			'post__not_in' => $exclude_ids,
			'orderby' => 'menu_order',
			'order' => 'ASC',
			'posts_per_page' => '5'));				

	?>

	<?php if ( $asmag_cover_story_query->have_posts() ) : ?>

	<div class="cover-story home">

	 <?php while ($asmag_cover_story_query->have_posts()) : $asmag_cover_story_query->the_post(); ?>
	 <?php $image = wp_get_attachment_url( get_post_thumbnail_id($post->ID));
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
		<div class="intro-hero" data-interchange="[<?php echo $hero_xlg; ?>, (default)], [<?php echo $hero_sm; ?>, (small)], [<?php echo $hero_md; ?>, (medium)], [<?php echo $hero_lg; ?>, (large)] [<?php echo $hero_xlg; ?>, (xlarge)]" style="margin-top: -20px;" alt="cover-story">
	 	 		<div class="row">
	                <div class="small-7 small-offset-5 medium-6 medium-offset-6 large-7 large-offset-6 columns">
	                    <div class="post-heading">
	                    	<a href="<?php the_permalink();?>" title="<?php the_title(); ?>" class="field">
	                        <h2><?php the_title(); ?></h2>
								<div class="show-for-large-up">
			                        <?php if ( get_post_meta($post->ID, 'ecpt_tagline', true) ) : ?> 
			                        	<div id="tagline">
			                        		<h4>
			                        			<?php echo get_post_meta($post->ID, 'ecpt_tagline', true); ?>
			                        		</h4>
			                        	</div>
			                        <?php endif; ?>
			                    </div>
	                    	</a>
	                    </div>
	                </div>
	        	</div> 	
		</div>
		<div class="hide-for-large-up">
			<div class="row">
				<div class="small-12 columns">
	            <?php if ( get_post_meta($post->ID, 'ecpt_tagline', true) ) : ?> 
	            	<div id="tagline">
	            		<h5>
	            			<?php echo get_post_meta($post->ID, 'ecpt_tagline', true); ?>
	            		</h5>
	            	</div>
	            <?php endif; ?>
	            </div>
            </div>
	    </div>  
	<?php endwhile; ?>
	</div>
	<?php endif; ?>
	<div class="features home">
		<div class="row section-header">
			<h2 class="white">Features</h2>
		</div>
		<div class="row">
			<?php if ( $asmag_features_query->have_posts() ) : ?>	
				<ul class="small-block-grid-1 medium-block-grid-3">
					<?php while ($asmag_features_query->have_posts()) : $asmag_features_query->the_post(); ?>
					<li class="features item">
						<?php echo the_post_thumbnail('filterthumbbig', array('class'=>'no-margin home-img img-responsive')); ?>
						<h5>
							<a href="<?php the_permalink();?>" title="<?php the_title(); ?>" class="field"><?php the_title(); ?></a>
						</h5>
						<p><?php echo get_post_meta($post->ID, 'ecpt_tagline', true); ?></p>
						
					</li>
					<?php endwhile; wp_reset_postdata(); ?>	
				</ul>
				<?php endif; ?>
		</div>
	</div>

									
	<div class="news home">
		<div class="row section-header">
			<h2 class="white">News</h2>
		</div>
		<div class="row">
			<?php if ( $asmag_news_query->have_posts() ) : ?>	
				<ul class="small-block-grid-1 medium-block-grid-3 large-block-grid-4">
					<?php while ($asmag_news_query->have_posts()) : $asmag_news_query->the_post(); ?>
					<li class="news item">
						<?php echo the_post_thumbnail('filterthumb', array('class'=>'no-margin home-img img-responsive')); ?>
						<h5>
							<a href="<?php the_permalink();?>" title="<?php the_title(); ?>" class="field"><?php the_title(); ?></a>
						</h5>
						<?php the_excerpt(); ?>
						</a>
					</li>
					<?php endwhile; wp_reset_postdata(); ?>	
				</ul>
				<?php endif; ?>
		</div>
	</div>

	<div class="bigideas home">
		<div class="row section-header">
			<h2 class="white">Big Ideas</h2>
		</div>
		<div class="row">
			<?php if ($asmag_bigideas_query->have_posts() ) : ?>	
				<ul class="small-block-grid-1 medium-block-grid-3 large-block-grid-4">
					<?php while ($asmag_bigideas_query->have_posts()) : $asmag_bigideas_query->the_post(); ?>
						<li class=" bigideas item">
							<?php echo the_post_thumbnail('filterthumb', array('class'=>'no-margin home-img img-responsive')); ?>
						<h5>
							<a href="<?php the_permalink();?>" title="<?php the_title(); ?>" class="field"><?php the_title(); ?></a>
						</h5>
							<p><?php the_excerpt(); ?></p>
						</li>
					<?php endwhile; wp_reset_postdata(); ?>	
				</ul>
			<?php endif; ?>
		</div>
	</div>

	<div class="students home">
		<div class="row section-header">
			<h2 class="white">Student Digest</h2>
		</div>
		<div class="row">
			<?php if ( $asmag_students_query->have_posts() ) : ?>
				<ul class="small-block-grid-1 medium-block-grid-3 large-block-grid-4">
					<?php while ($asmag_students_query->have_posts()) : $asmag_students_query->the_post(); ?>
						<li class="students item">
							<?php echo the_post_thumbnail('filterthumb', array('class'=>'no-margin home-img img-responsive')); ?>
						<h5>
							<a href="<?php the_permalink();?>" title="<?php the_title(); ?>" class="field"><?php the_title(); ?></a>
						</h5>
							<p><?php the_excerpt(); ?></p>
						</li>
					<?php endwhile; wp_reset_postdata(); ?>	
				</ul>
			<?php endif; ?>
		</div>
	</div>

	<div class="alumni home">
		<div class="row section-header">
			<h2 class="white">Alumni</h2>
		</div>
		<div class="row">
			<?php if ( $asmag_alumni_query->have_posts() ) : ?>	
				<ul class="small-block-grid-1 medium-block-grid-3 large-block-grid-4">
					<?php while ($asmag_alumni_query->have_posts()) : $asmag_alumni_query->the_post(); ?>
						<li class="alumni item">
							<?php echo the_post_thumbnail('filterthumb', array('class'=>'no-margin home-img img-responsive')); ?>
						<h5>
							<a href="<?php the_permalink();?>" title="<?php the_title(); ?>" class="field"><?php the_title(); ?></a>
						</h5>
							<p><?php the_excerpt(); ?></p>
						</li>
					<?php endwhile; wp_reset_postdata(); ?>
				</ul>
			<?php endif; ?>
		</div>
	</div>

</div>
<?php get_footer(); ?>