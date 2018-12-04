<?php
/*
Template Name: Search Results
*/
?>
<?php get_header(); ?>
<div id="container-mid">
    <div class="row" id="content">
        <h1 class="page-title">Search Results: <?php echo esc_attr(get_search_query()); ?></h1>
        <form method="GET" action="<?php echo home_url( '/' ); ?>" role="search" aria-label="Utility Bar Search">
            <div class="row">
                <div class="large-7 columns">
                    <div class="row collapse">
                        <div class="small-10 columns">
                            <input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="Search this site" aria-label="Search This Website"/>
                        </div>
                        <div class="small-2 columns">
                            <button class="button postfix square">
                                <span class="fa fa-search" aria-hidden="true"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <?php if (have_posts() ) : while (have_posts() ) : the_post(); ?>
        <article <?php post_class(''); ?> itemscope itemtype="http://schema.org/BlogPosting" aria-labelledby="post-<?php the_ID(); ?>"> 
            <h3>
                Article: <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
            </h3>
            <h4>Issue: <?php $volume_name = get_the_volume_name($post); echo $volume_name;?></h4>
            <div class="entry-content" itemprop="articleBody">
                <?php $content = get_the_content();
                $trimmed_content = wp_trim_words( $content, 60, '[...]' ); ?>
                <p><?php echo $trimmed_content; ?></p>
            </div> <!-- end entry-content -->  
        </article> <!-- end article -->
        <hr>
        <?php endwhile; ?>
        <div class="paging-search-results">
         <?php
            global $wp_query;
            $big = 999999999; // need an unlikely integer
            echo paginate_links( array(
            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format' => '?paged=%#%',
            'current' => max( 1, get_query_var('paged') ),
            'total' => $wp_query->max_num_pages
            ) );
        ?>
        </div>
       
        
        <?php else : ?>
            <h3><?php _e('Sorry, No Results.', 'jointswp');?></h3>
            <p><?php _e('Try your search again.', 'jointswp');?></p>
        <?php endif; ?>     
         
    </div> <!--End content -->
</div> <!--End container-mid -->
 <?php get_footer(); ?>