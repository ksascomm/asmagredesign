<footer>
  	<div class="row">

  	    <div class="small-12 medium-4 columns">
			<a href="http://www.krieger.jhu.edu">
				<img src="<?php echo get_template_directory_uri() ?>/assets/images/ksas-logo-horizontal.png" alt="Johns Hopkins University logo" />
			</a>
		</div>
		
		<div class="small-12 medium-3 medium-offset-1 columns">
			<div class="row"> 
				<h5><a href="<?php echo get_site_url(); ?>/contact/">Contact Us</a></h5>
   			</div>
			<div class="row" id="search-bar">
				<form method="GET" action="<?php echo home_url( '/' ); ?>" role="search" aria-label="Utility Bar Search">
		            <div class="row">
		                <div class="large-7 columns">
		                    <div class="row collapse">
		                        <div class="small-10 columns">
		                            <input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="Search this site" aria-label="Search This Website"/>
		                        </div>
		                        <div class="small-2 columns">
		                            <button class="button postfix">
		                            <span class="fa fa-search" aria-hidden="true"></span>
		                            </button>
		                        </div>
		                    </div>
		                </div>
		            </div>
		        </form>
			</div>
		</div>
		<div class="small-12 medium-4 columns">
			<ul class="inline-list">
				<li><a href="http://facebook.com/JHUArtsSciences"><span class="fa fa-facebook-official fa-2x"></span><span class="show-for-sr">Facebook</span></a></li>
				<li><a href="https://www.instagram.com/JHUArtsSciences/"><span class="fa fa-instagram fa-2x"></span><span class="show-for-sr">Instagram</span></a></li>
				<li><a href="https://twitter.com/JHUArtsSciences"><span class="fa fa-twitter fa-2x"></span><span class="show-for-sr">Twitter</span></a></li>
				<li><a href="https://www.youtube.com/user/jhuksas"><span class="fa fa-youtube-square fa-2x"></span><span class="show-for-sr">YouTube</span></a></li>
				<li><a href="<?php echo home_url(); ?>/feed"><span class="fa fa-rss-square fa-2x"></span><span class="show-for-sr">RSS</span></a></li>
			</ul>
         </div>
	</div>
  	<div class="row" id="copyright">
  		<p>&copy; <?php print date('Y'); ?> Johns Hopkins University, Zanvyl Krieger School of Arts & Sciences, 3400 N. Charles St, Baltimore, MD 21218</p>
  	</div>
  	
  </footer>
 <?php if(is_page_template('feature-utl.php')) {locate_template('/parts/utl-modals.php', true, false); } ?>
 <?php locate_template('/parts/scripts-initiators.php', true, false); wp_footer();?>
</body>
</html>		