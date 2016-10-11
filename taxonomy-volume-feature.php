<?php get_header(); ?>
<div id="container-mid">
	<div class="row" id="content">
	    <article class="small-12 large-7 columns" id="article">
	    		<h2>Department: Feature Archive</h2>
					<hr class="style15w">
						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?> <!--Start the loop -->
							<div class="postmaterial features">
								<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
								  <div class="row">
								  	<?php if ( has_post_thumbnail()) { the_post_thumbnail('full', array('class'=>'fullbleed')); }?> 
								  </div>
									<h4><?php the_title(); ?> <span class="spacer"></span></h4>
								</a>
											<?php
										$issues = get_the_terms( $post->ID, 'volume' );
															
										if ( $issues && ! is_wp_error( $issues ) ) : 

										$issue_list = array();

										foreach ( $issues as $issue ) {
											$issue_list[] = $issue->name;
										}
															
										$issue_name = join( ", ", $issue_list );
										?>
				    			<h5>Issue: <?php echo $issue_name; ?></h5>
						<?php endif; ?>
				    	<?php if ( get_post_meta($post->ID, 'ecpt_tagline', true) ) :  echo '<p>' . get_post_meta($post->ID, 'ecpt_tagline', true) . '</p>'; else : echo '<p>' . get_the_excerpt() . '</p>'; endif; ?>
							 <hr class="style15w">   	
						</div><!--End postmaterial -->
		<?php $volume = get_the_volume($post); $volume_name = get_the_volume_name($post); endwhile; endif; wp_reset_query();?>
						<div class="pagination">
							<?php wpex_pagination(); ?>
						</div>
		</article> <!--article -->

<!--start sidebar -->
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
				
	<div class="small-12 large-4 columns" id="sidebar">
		<div class="row">
			<div class="small-12 columns table">
				<a href="#" data-reveal-id="modal_toc" onclick="ga('send', 'event', 'Table of Contents', '<?php echo $volume_name ?>');">	
					<h4>View <?php echo $volume_name; ?> Contents<span class="spacer"></span></h4>
				</a>
			</div>		
	<?php locate_template('parts/in-latest-issue.php', true, false);	?>
	<?php locate_template('parts/in-prior-issues.php', true, false);	?>		
	</div> 
	
	
	</div> <!--End content -->
</div> <!--End container-mid -->
<?php get_footer(); ?>
