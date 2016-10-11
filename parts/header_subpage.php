<?php wp_reset_query();
  $volume = get_the_volume($post); 

  $departments = get_terms('category', array(
                  'orderby'     => 'ID',
                  'post_type' => 'post',
                  'include' => array(1, 69, 76, 70), //get IDs for News, Alumni, Student Digest, Big Ideas
                   'order'     => 'ASC',
                  'hide_empty'  => true,
                  //'parent'      => '81',
                  ));
{ ?> 

<nav class="top-bar" data-topbar role="navigation">
  <div class="row">
       <div class="show-for-small-only">
            <a href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri() ?>/assets/images/EZineMasthead.png" alt="arts & sciences magazine logo"></a>
        </div>
  </div>
  <ul class="title-area">
    <li class="name">
      <h1><a href="<?php echo home_url(); ?>"><?php $volume_name = get_the_volume_name($post); echo $volume_name; ?> Issue</a></h1>
    </li>
     <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
    <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
  </ul>

  <div class="top-bar-section">
   <div class="navbar-brand-centered hide-for-small">
            <a href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri() ?>/assets/images/EZineMasthead.png" alt="arts & sciences magazine"></a>
   </div>
    <!-- Right Nav Section -->
    <ul class="right">
      <li class="has-dropdown">
        <a href="#">Departments</a>
        <ul class="dropdown">
        <li><a href="<?php echo home_url(); ?>/volume/feature/">Features</a></li>
            <?php if ( ! empty( $departments ) && ! is_wp_error( $departments ) ) {
                $count = count( $departments );
                $i = 0;
                $department_list = '';
                foreach ( $departments as $department ) {
                    $i++;
                  $department_list .= '<li><a href="' . get_term_link( $department ) . '" title="' . sprintf( __( 'View all post filed under %s', 'my_localization_domain' ), $department->name ) . '">' . $department->name . '</a></li>';
                }
                echo $department_list;
            } ?>
        </ul>
      </li>
      <li class="divider"></li>
      <li><a style="font-size: 1.0625rem;" href="<?php echo get_site_url(); ?>/archive/">Archives <i class="fa fa-archive"></i></a></li>
    </ul>
  </div>
</nav>
<?php } ?>
