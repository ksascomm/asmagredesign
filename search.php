<?php
/*
Template Name: Search Results
*/
?>
<?php get_header(); ?>
<div id="container-mid">
    <div class="row" id="content">
        <h1 class="page-title">Search Results: <?php echo esc_attr(get_search_query()); ?></h1>
        <gcse:search></gcse:search>
    </div> <!--End content -->
</div> <!--End container-mid -->
 <?php get_footer(); ?>