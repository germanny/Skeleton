<?php $heading_tag = ( is_page('home') || is_front_page() ) ? 'h2' : 'h3'; ?>
<?php $data_height = ( is_page('home') || is_front_page() ) ? '325' : '258'; ?>
<?php include('inc-facebook-script.php'); ?>
<section id="fb-likebox" class="social-box">
	<header class="section-title">
		<<?php echo $heading_tag; ?> class="cap">Find us on <span>Facebook</span></<?php echo $heading_tag; ?>>
	</header>
	<article>
	  <div class="fb-like-box" data-href="<?php echo FB_PAGE; ?>" data-width="450" data-height="<?php echo $data_height; ?>" data-show-faces="true" data-stream="false" data-border-color="0000000" data-header="false"></div>
	</article>
</section><!-- #fb -->
