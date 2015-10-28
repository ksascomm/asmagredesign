<div class="row" id="related-tags">
	<?php $tags = wp_get_post_tags($post->ID);
					if ($tags) {
						$first_tag = $tags[0]->term_id;
						$tagname = $tags[0]->name;
						$args=array(
						'tag__in' => array($first_tag),
						'post__not_in' => array($post->ID),
						'category__not_in' => array(55, 30), //exclude From the Dean & Editors Note
						'posts_per_page'=>3,
						);
					$related_tags_query = new WP_Query($args);

				
					if( $related_tags_query->have_posts() ) { ?>

	<div class="small-12 columns table"> 
		<h4>Related <?php echo $tagname; ?> Articles<span class="spacer"></span></h4>
	</div>	

		<?php while ($related_tags_query->have_posts()) : $related_tags_query->the_post(); 

			$issues = get_the_terms($post->ID, 'volume');
			if($issues && !is_wp_error($issues)) :
			$issue_names = array();
			foreach($issues as $issue) {
				$issue_names[] = $issue->name;
			}
			$issue_name = join(" ", $issue_names); endif; ?>

			<div class="small-12 medium-4 columns end">
    			<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
    			   <?php the_post_thumbnail('filterthumb'); ?>
    			   <h5><?php the_title(); ?><br>
				    	<span class="<?php echo $catname; ?>"><?php echo $issue_name; ?></span>
				   </h5>
				 </a>
				<?php if ( get_post_meta($post->ID, 'ecpt_tagline', true) ) :  echo '<p>' . get_post_meta($post->ID, 'ecpt_tagline', true) . '</p>'; else : echo '<p>' . get_the_excerpt() . '</p>'; endif; ?>
			</div><!--End snippet -->

		<?php endwhile; } wp_reset_query(); } ?>
</div>	