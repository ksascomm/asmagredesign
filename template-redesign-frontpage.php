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

			$asmag_bluejays_query = new WP_Query(array(
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
	<ul class="slider" data-orbit data-options="animation: fade; animation_speed:1000; timer:false; timer_speed:10000; navigation_arrows:true; bullets:false; slide_number:false;">
	<?php if ( $asmag_features_query->have_posts() ) : while ($asmag_features_query->have_posts()) : $asmag_features_query->the_post(); ?>
	  <li>
	  	<a href="<?php the_permalink();?>" title="<?php the_title(); ?>" class="field">
	  	<div class="slide">
		    <?php echo the_post_thumbnail('fullbleed', array('class'=>'no-margin')); ?>
		    <div class="slide-caption">
				<h1><?php the_title(); ?></h1>
				<hr class="hide-for-small-only">
				<p><?php if ( get_post_meta($post->ID, 'ecpt_tagline', true) ) { echo get_post_meta($post->ID, 'ecpt_tagline', true); } else { the_excerpt(); } ?></p>			
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
		<h2>News
		<span class="spacer"></div></h2>
	</div>
</div>
<div class="row">
<?php if ( $asmag_news_query->have_posts() ) :	while ($asmag_news_query->have_posts()) : $asmag_news_query->the_post(); ?>
	<article class="small-12 medium-4 large-3 columns end news item">
		<a href="<?php the_permalink();?>" title="<?php the_title(); ?>" class="field"><?php echo the_post_thumbnail('filterthumbbig', array('class'=>'no-margin home-img img-responsive')); ?>
		<h5><?php the_title(); ?></h5>
		<?php the_excerpt(); ?>
		</a>
	</article>

	<?php endwhile; wp_reset_postdata(); ?>	
	<?php endif; ?>
</div>
</section>

<section class="bigideas home">
<div class="row">
	<div class="small-12 columns">
		<h2>Big Ideas
		<span class="spacer"></div></h2>
	</div>
</div>
<div class="row">
<?php if ( $asmag_bigideas_query->have_posts() ) :	while ($asmag_bigideas_query->have_posts()) : $asmag_bigideas_query->the_post(); ?>
	<article class="small-12 medium-4 large-3 columns end bigideas item">
		<a href="<?php the_permalink();?>" title="<?php the_title(); ?>" class="field"><?php echo the_post_thumbnail('filterthumbbig', array('class'=>'no-margin home-img img-responsive')); ?>
		<h5><?php the_title(); ?></h5>
		<p><?php the_excerpt(); ?></p>
		</a>
	</article>
	<?php endwhile; wp_reset_postdata(); ?>	
	<?php endif; ?>
</div>
</section>

<section class="bluejays home">
<div class="row">
	<div class="small-12 columns">
		<h2>#BlueJays
		<span class="spacer"></div></h2>
	</div>
</div>
<div class="row">
<?php if ( $asmag_bluejays_query->have_posts() ) :	while ($asmag_bluejays_query->have_posts()) : $asmag_bluejays_query->the_post(); ?>
	<article class="small-12 medium-4 large-3 columns end bluejays item">
		<a href="<?php the_permalink();?>" title="<?php the_title(); ?>" class="field"><?php echo the_post_thumbnail('filterthumbbig', array('class'=>'no-margin home-img img-responsive')); ?>
		<h5><?php the_title(); ?></h5>
		<p><?php the_excerpt(); ?></p>
		</a>
	</article>
	<?php endwhile; wp_reset_postdata(); ?>	
	<?php endif; ?>
</div>
</section>

<section class="alumni home">
<div class="row">
	<div class="small-12 columns">
		<h2>Alumni
		<span class="spacer"></div></h2>
	</div>
</div>
<div class="row">
<?php if ( $asmag_alumni_query->have_posts() ) :	while ($asmag_alumni_query->have_posts()) : $asmag_alumni_query->the_post(); ?>
	<article class="small-12 medium-4 large-3 columns end alumni item">
		<a href="<?php the_permalink();?>" title="<?php the_title(); ?>" class="field"><?php echo the_post_thumbnail('filterthumbbig', array('class'=>'no-margin home-img img-responsive')); ?>
		<h5><?php the_title(); ?></h5>
		<p><?php the_excerpt(); ?></p>
		</a>
	</article>
	<?php endwhile; wp_reset_postdata(); ?>	
	<?php endif; ?>
</div>
</section>


<?php get_footer(); ?>