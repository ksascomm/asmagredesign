<?php wp_reset_query();
  $volume = get_the_volume($post); 

  $departments = get_terms('category', array(
              'orderby'     => 'ID',
              'post_type' => 'post',
              'category__not_in' => array(2, 9),
              'order'     => 'ASC',
              'hide_empty'  => true,
              'parent'      => '81',
              ));
{ ?> 

<nav class="top-bar" data-topbar role="navigation">
  <ul class="title-area">
    <li class="name">
      <h1><a href="<?php echo site_url(); ?>"><?php $volume_name = get_the_volume_name($post); echo $volume_name; ?> Issue</a></h1>
    </li>
     <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
    <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
  </ul>

  <section class="top-bar-section">
   <div class="navbar-brand-centered">
            <a href="<?php echo site_url(); ?>"><img src="<?php echo get_template_directory_uri() ?>/assets/images/EZineMasthead.png"></a>
    </div>
    <!-- Right Nav Section -->
    <ul class="right">
      <li class="has-dropdown">
        <a href="#">Departments</a>
        <ul class="dropdown">
        <li><a href="<?php echo site_url(); ?>/volume/feature/">Features</a></li>
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
      <li><a href="/archive/">Archives <i class="fa fa-archive"></i></a></li>
    </ul>
  </section>
</nav>
<?php } ?>
