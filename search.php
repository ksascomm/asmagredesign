<?php
/*
Template Name: Search Results
*/
?>
<?php get_header(); ?>
<div id="container-mid">
    <div class="row" id="content">
        <h1 class="page-title">Search Results: <?php echo esc_attr(get_search_query()); ?></h1>
        <script>
          (function() {
            var cx = '004861732276671665766:uifchc-d8lo';
            var gcse = document.createElement('script');
            gcse.type = 'text/javascript';
            gcse.async = true;
            gcse.src = 'https://cse.google.com/cse.js?cx=' + cx;
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(gcse, s);
          })();
        </script>
        <gcse:search></gcse:search>
    </div> <!--End content -->
</div> <!--End container-mid -->
 <?php get_footer(); ?>