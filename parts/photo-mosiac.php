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