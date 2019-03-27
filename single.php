<?php get_header(); ?>
<div class="main" id="container-mid" role="main">
	<div class="row" id="content">
	    <article class="small-12 large-8 columns" id="article">
	    <?php if ( have_posts() ) : while ( have_posts() ) : the_post();  ?>
			<?php /* add per post custom CSS */ if ( get_post_meta($post->ID, 'ecpt_asmag_css', true) ) { echo '<style>' . get_post_meta($post->ID, 'ecpt_asmag_css', true) . '</style>'; } ?> 
			<div class="postmaterial">
				<h2><?php the_title(); ?></h2>
				<p class="author">By&nbsp;<?php the_author(); ?></p>
				<?php if ( get_post_meta($post->ID, 'ecpt_other_credits', true) ) { echo '<p class="othercredits">' . get_post_meta($post->ID, 'ecpt_other_credits', true) . '</p>'; } ?>
					<?php if (!has_tag(array('seen-heard', 'tell-me-about', 'alumni-briefs'))){ 
					//don't show featured image if post has >1 person's image
						 echo '<div class="topimage imageblockleft">'; the_post_thumbnail('full', array('class'=>'floatleft'));
						 echo '<p class="photocredit">' . get_post(get_post_thumbnail_id())->post_excerpt . '</p>';
						 echo '</div>'; 	
					} ; ?>

				<?php the_content(); ?>
			</div><!--End postmaterial -->

		<?php if (is_single('Of Biology and Daylilies')) {
				locate_template('parts/photo-mosiac.php', true, false);
				} ;?>	

		<?php locate_template('parts/related-tags.php', true, false);	?>		

		<?php comments_template( '/comments.php' ); ?> 

		</article> 


	<?php $home_url = home_url() ?>	

	<?php //Get data for sidebar
					$categories = get_the_category();
					$thiscat = $categories[0]->cat_ID;
					if ($thiscat == 31) { $thiscat = ''; $catname = '';} else {
					$catname = $categories[0]->name;
					$catslug = $categories[0]->slug; }
					
					//End and reset query
				$volume = get_the_volume($post); $volume_name = get_the_volume_name($post); endwhile; endif; wp_reset_query();?>
		<aside class="small-12 large-4 columns" id="sidebar">
		
		<div class="small-12 columns">
			<h4 style="margin-bottom: 8px;">Share This Story <span class="spacer"></span></h4>
			<ul class="inline-list">	
				<li><a style="color: #005eb8" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode( get_permalink() ); ?>" target="_blank"><span class="fa fa-facebook-official fa-2x"></span><span class="show-for-sr">Facebook</span></a></li>
				<li><a style="color: #005eb8" href="https://twitter.com/intent/tweet?text=<?php echo urlencode( get_the_title() ) ?>&amp;url=<?php echo urlencode( get_permalink() ); ?>&amp;via=JHUArtsSciences" target="_blank" title="Share this on Twitter"><span class="fa fa-twitter fa-2x"></span><span class="show-for-sr">Twitter</span></a></li>
				<li>
					<a style="color: #005eb8" href="#" data-reveal-id="myModal">
						<span class="fa fa-envelope fa-2x"></span><span class="show-for-sr">Email</span>
					</a>
				</li>
			</ul>
			<?php get_template_part( 'parts/share', 'story-modal' ); ?>
		</div>

			<div class="small-12 columns <?php echo $catslug; ?>">
			<h4>Navigation <span class="spacer"></span></h4>
				<ul class="breadcrumbs">
				  <li>Issue: <a href="<?php echo $home_url; ?>/<?php echo $volume; ?>"><?php echo $volume_name; ?></a></li>
				  <li>Department: <?php if ( ! empty( $categories ) ) {
    echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
}?> </li>
				  <li class="active"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></li>
				</ul>
			</div>	

				<?php $sidebar_query = new WP_Query(array(
					'cat' => $thiscat,
					'volume' => $volume,
					'orderby' => 'date',
					'order' => 'DESC',
					'posts_per_page' => -1
				));
				?>
			<div class="small-12 columns <?php echo $catslug; ?>">	 
				<h4>Also In <?php echo $catname; ?> <span class="spacer"></span></h4>
			</div>
				<?php while ($sidebar_query->have_posts()) : $sidebar_query->the_post();
					$issues = get_the_terms($post->ID, 'volume');
					if($issues && !is_wp_error($issues)) :
					$issue_names = array();
					foreach($issues as $issue) {
						$issue_names[] = $issue->name;
					}
					$issue_name = join(" ", $issue_names); endif; ?>				
		    		<div class="small-12 columns">
		    			<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
			    			<h5><?php the_title(); ?><br>
			    			<span class="<?php echo $catslug; ?>"><?php echo $issue_name; ?></span></h5>
				    			<?php if ( get_post_meta($post->ID, 'ecpt_tagline', true) ) :  echo '<p>' . get_post_meta($post->ID, 'ecpt_tagline', true) . '</p>'; else : echo '<p>' . get_the_excerpt() . '</p>'; endif; ?>
		    			</a>
		    		</div><!-- End subtext -->
	   			<?php endwhile; wp_reset_query() ?>		
				   			 
			<?php locate_template('parts/in-latest-issue.php', true, false);	?>	

		</aside>
	</div> <!--End content -->
</div> <!--End container-mid -->

		<?php if (is_single ( array('5143', '5381'))) // 'Of Biology and Daylilies' & 'Presidents Day of Service'
		 	{locate_template('parts/photo-mosiac-js.php', true, false); } ;?>	

<?php get_footer(); ?>
