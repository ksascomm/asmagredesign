<div class="also-in">
	<div class="small-12 columns">
		<h4>In Latest Issue<span class="spacer"></span></h4>
			<div class="row">
				<ul class="button-group">
					<?php $departments = get_terms('category', array(
				          'orderby'     => 'ID',
				          'post_type' => 'post',
				          'include' => array(1, 69, 76, 70,), //get IDs for News, Alumni, Student Digest, Big Ideas
				          'order'     => 'ASC',
				          'hide_empty'  => true,
				          //'parent'      => '81',
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
			    <li><a href="<?php echo site_url(); ?>/volume/feature" class="button features">Features</a>
	    		</ul>
	        </div>
	</div>
</div>