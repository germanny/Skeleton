<?php $heading_tag = ( is_page('home') || is_front_page() ) ? 'h2' : 'h3'; ?>
<section id="twitter-feed" class="social-box">
	<header class="section-title">
		<<?php echo $heading_tag; ?> class="cap">Follow Us on <span>Twitter</span></<?php echo $heading_tag; ?>>
	</header>
	<article class="tweet"></article>
	<p class="twitter-follow-btn-ctnr">
		<a href="https://twitter.com/<?php echo TWITTER_USERNAME; ?>" class="twitter-follow-button" data-show-count="false" data-size="large">Follow @<?php echo TWITTER_USERNAME; ?></a>
	</p>
</section><!-- END #twitter -->