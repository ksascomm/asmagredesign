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
				<form method="GET" action="<?php echo site_url('/search'); ?>">
					<input type="text" name="q" placeholder="Search this site" aria-label="search"/>
					<input type="submit" class="icon-search" value="&#48;" />
					<input type="hidden" name="site" value="ksas_magazine" />
				</form>
			</div>
		</div>
		<div class="small-12 medium-3 columns">
			<ul class="inline-list">
				<li><a href="http://facebook.com/JHUArtsSciences"><span class="fa fa-facebook-official fa-2x"></span><span class="show-for-sr">Facebook</span></a></li>
				<li><a href="https://www.instagram.com/JHUArtsSciences/"><span class="fa fa-instagram fa-2x"></span><span class="show-for-sr">Instagram</span></a></li>
				<li><a href="https://twitter.com/JHUArtsSciences"><span class="fa fa-twitter fa-2x"></span><span class="show-for-sr">Twitter</span></a></li>
				<li><a href="https://www.youtube.com/user/jhuksas"><span class="fa fa-youtube-square fa-2x"></span><span class="show-for-sr">YouTube</span></a></li>
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