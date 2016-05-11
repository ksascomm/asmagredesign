<div class="also-in">
	<div class="small-12 columns">
	<br>
    <br>
		<h4>In Prior Issues <span class="spacer"></span></h4>
			<div class="row">
				<ul class="button-group">
					<?php $olddepartments = get_terms('category', array(
				          'orderby'     => 'ID',
				          'post_type' => 'post',
				          'exclude' => array(1, 69, 76, 70, 76, 77, 60,), //get IDs for News, Alumni, Student Digest, Big Ideas, Uncategorized, Faculty Books
				          'order'     => 'ASC',
				          'hide_empty'  => true,
				          //'parent'      => '81',
				          ));
					if ( ! empty( $olddepartments ) && ! is_wp_error( $olddepartments ) ) {
			            $count = count( $olddepartments );
			            $i = 0;
			            $olddepartment_list = '';
			            foreach ( $olddepartments as $olddepartment ) {
			                $i++;
			              $olddepartment_list .= '<li><a href="' . get_term_link( $olddepartment ) . '"class="button tiny ' . $olddepartment->slug . '" title="' . sprintf( __( 'View all post filed under %s', 'my_localization_domain' ), $olddepartment->name ) . '">' . $olddepartment->name . '</a></li>';
			            }
			            echo $olddepartment_list;
			        } ?>
	    		</ul>
	        </div>
	</div>
</div>