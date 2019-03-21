<?php
/*
Template Name: No Sidebar
*/
?>	
<?php get_header(); 
	$issue = $_GET['volume'];
?>
<div id="container-mid">
	<div class="row" id="content">
	    <article class="small-12 columns" id="article">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?> <!--Start the loop -->
				<div class="postmaterial">
					<h2><?php the_title(); ?></h2>
					<?php the_content(); ?>
				</div><!--End postmaterial -->
			<?php endwhile; endif; ?>
		</article> <!--article -->

	</div> <!--End content -->
</div> <!--End container-mid -->
<?php get_footer(); ?>
