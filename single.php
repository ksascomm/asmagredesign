<?php get_header(); ?>
<div id="container-mid">
	<div class="row" id="content">
	    <article class="small-12 medium-8 columns" id="article">
	    <?php if ( have_posts() ) : while ( have_posts() ) : the_post();  ?>
			<?php /* add per post custom CSS */ if ( get_post_meta($post->ID, 'ecpt_asmag_css', true) ) { echo '<style>' . get_post_meta($post->ID, 'ecpt_asmag_css', true) . '</style>'; } ?> 
	
			<div class="postmaterial">
				<h3><?php the_title(); ?></h3>
				<p class="author">By&nbsp;<?php the_author(); ?></p>
				<?php if ( get_post_meta($post->ID, 'ecpt_other_credits', true) ) { echo '<p class="othercredits">' . get_post_meta($post->ID, 'ecpt_other_credits', true) . '</p>'; } ?>
		<?php if (!has_tag(array('seen-heard', 'tell-me-about'))) {
				 echo '<div class="topimage">'; the_post_thumbnail('full', array('class'=>'floatleft')); echo '</div>'; } ; ?>

				<?php the_content(); ?>
				<?php //Get data for sidebar
					$categories = get_the_category();
					$thiscat = $categories[0]->cat_ID;
					if ($thiscat == 31) { $thiscat = ''; $catname = '';} else {
					$catname = $categories[0]->name;
					$catslug = $categories[0]->slug; }
					
					//End and reset query
				$volume = get_the_volume($post); $volume_name = get_the_volume_name($post); endwhile; endif; wp_reset_query();?>
			</div><!--End postmaterial -->
		<?php if (is_single('Of Biology and Daylilies')) { ?>
			<ul id="mosaic" class="clearfix">	
		<!-- Set argument to pull image attachments -->
			<?php $mosaic_args = array(
					'post_type' => 'attachment',
					'numberposts' => -1,
					'post_status' => null,
					'post_parent' => $post->ID
					); 
				$mosaic_attachments = get_posts($mosaic_args);
					if ($mosaic_attachments) {
						foreach ($mosaic_attachments as $mosaic_attachment) {
							$mosaic_link = wp_get_attachment_image_src($mosaic_attachment->ID, 'full', false);
							$mosaic_caption = $mosaic_attachment->post_excerpt;
							$mosaic_description = $mosaic_attachment->post_excerpt;
							$mosaic_dimensions = $mosaic_attachment->menu_order;
							echo $mosaic_description;
							echo '<li class="item size-' . $mosaic_dimensions;
							echo '">
									<a href="' . $mosaic_link[0];
							echo '" class="lightbox">
										<img src="' . $mosaic_link[0];
							echo '" title="' . $mosaic_caption;
							echo '" /></a></li>';		
		                    }
		                } ?>

		</ul><!--End #mosaic -->
		<?php } ?>	
		<?php comments_template( '/comments.php' ); ?> 
		</article> 
	
	
<!-- /**************SIDEBAR***********************/	 -->

<?php $home_url = home_url(); $categories = get_the_category(); ?>	
	<div class="small-12 medium-4 columns" id="sidebar">
		<div class="row">
			<div class="small-12 columns">
				<ul class="breadcrumbs">
				  <li><a href="<?php echo $home_url; ?>/<?php echo $volume; ?>"><?php echo $volume_name; ?> Issue</a></li>
				  <li><a href="<?php echo $home_url; ?>"><?php echo the_category(' '); ?></a></li>
				  <li><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></li>
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
			<h4>Other <?php echo $catname; ?> articles<span class="spacer"></span></h4>
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
		    			<span class="<?php echo $catname; ?>"><?php echo $issue_name; ?></h5>
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

	
 </div> <!--End sidebar-right -->
	    	</div> <!--End content -->
		</div> <!--End container-mid -->

		<?php if (is_single ( array('5143', '5381'))) { ?>

<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/assets/js/jquery.photomosaic.js"></script>
			<script>
    var $q = jQuery.noConflict();
			$q(function(){

      var $mosaic = $q('#mosaic');
     $q(document).ready(function(){
        $mosaic.photoMosaic({
        	input : 'html',
        	columns : 6,
        	modal_name : 'lightbox',
        	external_links : true,
        	random : true
        });
    });
	$q("a.popup").fancybox({
		openEffect	: 'fade',
		closeEffect	: 'fade',
		helpers : {
        overlay : {
            css : {
                'background' : 'rgba(43, 42, 46, 0.7)'
            }
        }
    }
	});
    });
			</script>
<?php } ?>	

<?php get_footer(); ?>
