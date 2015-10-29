<?php
/*
Template Name: Redesign Front Page
*/
?>
	
<?php get_header(); ?>

		<?php 
			$volume = get_the_volume($post);
			$parent = get_queried_object_id();
		
			$asmag_news_query = new WP_Query(array(
				'post_type' => 'post',
				'volume' => $volume,
				'category__in' => array(4),
				'orderby' => 'modified',
				'order' => 'DESC',
				'posts_per_page' => '-1'));

			$asmag_bigideas_query = new WP_Query(array(
				'post_type' => 'post',
				'volume' => $volume,
				'category__in' => array(80),
				'orderby' => 'modified',
				'order' => 'DESC',
				'posts_per_page' => '-1'));

			$asmag_students_query = new WP_Query(array(
				'post_type' => 'post',
				'volume' => $volume,
				'category__in' => array(85),
				'orderby' => 'modified',
				'order' => 'DESC',
				'posts_per_page' => '-1'));

			$asmag_alumni_query = new WP_Query(array(
				'post_type' => 'post',
				'volume' => $volume,
				'category__in' => array(28),
				'orderby' => 'modified',
				'order' => 'DESC',
				'posts_per_page' => '-1'));

			$asmag_features_query = new WP_Query(array(
				'post_type' => 'page',
				'volume' => $volume,
				'post_parent' => $parent,
				'orderby' => 'menu_order',
				'order' => 'ASC',
				'posts_per_page' => '10'));			

	?>


<section class="features">
<div class="slideshow-wrapper">
  <div class="preloader"></div>
	<ul class="slider" data-orbit data-options="animation: fade; animation_speed:1000; timer:false; timer_speed:10000; navigation_arrows:true; bullets:true; slide_number:false;">
	<?php if ( $asmag_features_query->have_posts() ) : while ($asmag_features_query->have_posts()) : $asmag_features_query->the_post(); ?>
	  <li>
	  	<a href="<?php the_permalink();?>" title="<?php the_title(); ?>" class="field">
	  	<div class="slide">
		    <?php echo the_post_thumbnail('fullbleed', array('class'=>'no-margin')); ?>
		    <div class="slide-caption">
				<h1><?php the_title(); ?></h1>
				<hr class="hide-for-small-only">
				<p><?php if ( get_post_meta($post->ID, 'ecpt_tagline', true) ) { echo get_post_meta($post->ID, 'ecpt_tagline', true); } else { the_excerpt(); } ?></p>
				<p>By <?php $author = get_the_author(); echo $author ;?> </p>		
		    </div>
		 </div>
	    </a>
	  </li>
	  <?php endwhile; wp_reset_postdata(); ?>	
	</ul>
	</div>
</section>
<?php endif; ?>

								
<section class="news home">
	<div class="row">
		<div class="small-12 columns">
			<div class="small-5 medium-3 columns">
				<h2>News</h2>
			</div>
			<div class="small-7 medium-9 columns">
				<h2><span class="spacer"></span></h2>
			</div>
		</div>
	</div>
	<div class="row">
		<?php if ( $asmag_news_query->have_posts() ) : ?>	
			<ul class="small-block-grid-1 medium-block-grid-3 large-block-grid-4">
				<?php while ($asmag_news_query->have_posts()) : $asmag_news_query->the_post(); ?>
				<li class="news item">
					<a href="<?php the_permalink();?>" title="<?php the_title(); ?>" class="field"><?php echo the_post_thumbnail('filterthumb', array('class'=>'no-margin home-img img-responsive')); ?>
					<h5><?php the_title(); ?></h5>
					<?php the_excerpt(); ?>
					</a>
				</li>
				<?php endwhile; wp_reset_postdata(); ?>	
			</ul>
			<?php endif; ?>
	</div>
</section>

<section class="bigideas home">
	<div class="row">
		<div class="small-12 columns">
			<div class="small-5 medium-3 columns">
				<h2>Big Ideas</h2>
			</div>
			<div class="small-7 medium-9 columns">
				<h2><span class="spacer"></span></h2>
			</div>
		</div>
	</div>
	<div class="row">
		<?php if ($asmag_bigideas_query->have_posts() ) : ?>	
			<ul class="small-block-grid-1 medium-block-grid-3 large-block-grid-4">
				<?php while ($asmag_bigideas_query->have_posts()) : $asmag_bigideas_query->the_post(); ?>
					<li class=" bigideas item">
						<a href="<?php the_permalink();?>" title="<?php the_title(); ?>" class="field"><?php echo the_post_thumbnail('filterthumb', array('class'=>'no-margin home-img img-responsive')); ?>
						<h5><?php the_title(); ?></h5>
						<p><?php the_excerpt(); ?></p>
						</a>
					</li>
				<?php endwhile; wp_reset_postdata(); ?>	
			</ul>
		<?php endif; ?>
	</div>
</section>

<section class="students home">
	<div class="row">
		<div class="small-12 columns">
			<div class="small-7 medium-4 columns">
				<h2>Student Digest</h2>
			</div>
			<div class="small-5 medium-8 columns">
				<h2><span class="spacer"></span></h2>
			</div>
		</div>
	</div>
	<div class="row">
		<?php if ( $asmag_students_query->have_posts() ) : ?>
			<ul class="small-block-grid-1 medium-block-grid-3 large-block-grid-4">
				<?php while ($asmag_students_query->have_posts()) : $asmag_students_query->the_post(); ?>
					<li class="students item">
						<a href="<?php the_permalink();?>" title="<?php the_title(); ?>" class="field"><?php echo the_post_thumbnail('filterthumb', array('class'=>'no-margin home-img img-responsive')); ?>
						<h5><?php the_title(); ?></h5>
						<p><?php the_excerpt(); ?></p>
						</a>
					</li>
				<?php endwhile; wp_reset_postdata(); ?>	
			</ul>
		<?php endif; ?>
	</div>
</section>

<section class="alumni home">
	<div class="row">
		<div class="small-12 columns">
			<div class="small-5 medium-3 columns">
				<h2>Alumni</h2>
			</div>
			<div class="small-7 medium-9 columns">
				<h2><span class="spacer"></span></h2>
			</div>
		</div>
	</div>
	<div class="row">
		<?php if ( $asmag_alumni_query->have_posts() ) : ?>	
			<ul class="small-block-grid-1 medium-block-grid-3 large-block-grid-4">
				<?php while ($asmag_alumni_query->have_posts()) : $asmag_alumni_query->the_post(); ?>
					<li class="alumni item">
						<a href="<?php the_permalink();?>" title="<?php the_title(); ?>" class="field"><?php echo the_post_thumbnail('filterthumb', array('class'=>'no-margin home-img img-responsive')); ?>
						<h5><?php the_title(); ?></h5>
						<p><?php the_excerpt(); ?></p>
						</a>
					</li>
				<?php endwhile; wp_reset_postdata(); ?>
			</ul>
		<?php endif; ?>
	</div>
</section>


<?php get_footer(); ?>