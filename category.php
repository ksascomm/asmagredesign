<?php get_header(); ?>
<?php $categories = get_the_category();
					$thiscat = $categories[0]->cat_ID;
					if ($thiscat == 31) { $thiscat = ''; $catname = '';} else {
					$catname = $categories[0]->name;
					$catslug = $categories[0]->slug; }
					?>
<div id="container-mid">
	<div class="row" id="content">
	    <article class="small-12 medium-8 columns" id="article">
	    <div class="postmaterial">
	    <h3>Department: <?php single_cat_title(); ?> Archive</h3>
	    <hr class="style15w">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?> <!--Start the loop -->
				
	    			<div class="small-12 columns listing <?php echo $catslug; ?>">
	    			<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
	    			    <?php if ( has_post_thumbnail()) { the_post_thumbnail('homethumb', array('class'=>'floatleft')); }?> 
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
	    			</div>
	
	<?php $volume = get_the_volume($post); $volume_name = get_the_volume_name($post); endwhile; endif; wp_reset_query() ?>

		</div>
		<?php wpex_pagination(); ?>

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
		<section class="also-in row">
		<div class="small-12 columns">
			<h4>In Latest Issue<span class="spacer"></span></h4>
				<div class="row">
					<ul class="button-group">

			<?php $departments = get_terms('category', array(
              'orderby'     => 'ID',
              'post_type' => 'post',
              'category__not_in' => array(2, 9),
              'order'     => 'ASC',
              'hide_empty'  => true,
              'parent'      => '81',
              ));

			if ( ! empty( $departments ) && ! is_wp_error( $departments ) ) {
                $count = count( $departments );
                $i = 0;
                $department_list = '';
                foreach ( $departments as $department ) {
                    $i++;
                  $department_list .= '<li><a href="' . get_term_link( $department ) . '"class="button ' . $department->slug . '" title="' . sprintf( __( 'View all post filed under %s', 'my_localization_domain' ), $department->name ) . '">' . $department->name . '</a></li>';
                }
                echo $department_list;
            } ?>
		       
		        </div>
		</div>
	</section>
	</div> <!--End content -->
</div> <!--End container-mid -->
<?php get_footer(); ?>
