	<footer id="siteinfo" role="contentinfo">
			<div class="wrap">
				<a href="<?php echo $siteurl; ?>" title="<?php echo $sitename; ?>" class="url fn org" rel="home"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/logos/logo_sm.png" alt="<?php echo $sitename; ?>" /></a>
				<nav id="submenu" role="navigation">
					<?php wp_nav_menu( array( 'container_class' => 'footer_menu', 'theme_location' => 'main nav' ) ); ?>
				</nav><!-- nav#submenu -->
				<div class="copy">&#169;<?php echo date("Y"); echo " " . get_option('blogname'); ?> All Rights Reserved.</div>
			</div>
	</footer><!-- #siteinfo -->
</div><!-- /#main -->


<?php wp_footer(); ?>
<?php
	 include('includes/inc-facebook-script.php');
	 include('includes/inc-twitter-script.php');
	 if ( is_single() ) {
	 	include('includes/inc-google-script.php');
	 	include('includes/inc-pinterest-script.php');
	 }
	 include('includes/inc-twitter-feed-script.php');
?>

</body>
</html>