<footer>
  	<div class="row" role="navigation">

  	    <div class="small-12 medium-4 columns">
			<a href="http://www.krieger.jhu.edu">
				<img src="<?php echo get_template_directory_uri() ?>/assets/images/ksas-logo-horizontal.png" alt="Johns Hopkins University logo" />
			</a>
		</div>
		
		<div class="small-12 medium-3 medium-offset-1 columns">
			<div class="row" role="contact"> 
				<h5><a href="<?php echo get_site_url(); ?>/contact/">Contact Us</a></h5>
   			</div>
			<div class="row" id="search-bar">
				<form method="GET" action="<?php echo site_url('/search'); ?>">
						<input type="text" name="q" placeholder="Search this site" />
						<input type="submit" class="icon-search" value="&#48;" />
						<input type="hidden" name="site" value="ksas_magazine" />
				</form>
			</div>
		</div>
		<div class="small-12 medium-3 columns">
			<div class="row">
				<div class="small-4 columns">
	                <a href="http://www.youtube.com/user/jhuksas" title="YouTube"><i class="fa fa-3x fa-fw fa-youtube-square"></i></a>
	            </div>
	            <div class="small-4 columns">
	                <a href="http://facebook.com/jhuksas" title="Facebook"><i class="fa fa-3x fa-fw fa-facebook-square"></i></a>
	            </div>
	            <div class="small-4 columns">
	            <a href="<?php echo home_url(); ?>/feed"><i class="fa fa-3x fa-fw fa-rss-square"></i></a>
	            </div>
            </div>
         </div>
	</div>
  	<div class="row" id="copyright" role="content-info">
  		<p>&copy; <?php print date('Y'); ?> Johns Hopkins University, Zanvyl Krieger School of Arts & Sciences, 3400 N. Charles St, Baltimore, MD 21218</p>
  	</div>
  	
  </footer>
 <?php if(is_page_template('feature-utl.php')) {locate_template('/parts/utl-modals.php', true, false); } ?>
 <?php locate_template('/parts/scripts-initiators.php', true, false); wp_footer();?>
</body>
</html>		