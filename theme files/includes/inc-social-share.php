<!-- Social Sharing Widgets -->
<aside class="social-share<?php if(get_post_meta($post->ID, 'infographic_value', TRUE)) { echo ' wide'; } if($location == 'lower') { echo ' lower'; } ?>">
	<ul class="social-buttons">
  	<li class="fb">
			<h6>Facebook</h6>
			<div class="bubble"><div class="fb-like" data-href="<?php the_permalink(); ?>" data-send="false" data-layout="box_count" data-width="60" data-show-faces="false"></div></div>
  	</li>
  	<li class="tw">
			<h6>Twitter</h6>
			<div class="bubble"><a href="http://twitter.com/share" class="twitter-share-button" data-text="<?php the_title(); ?>" data-url="<?php the_permalink(); ?>" data-related="<?php echo TWITTER_USERNAME; ?>" data-count="vertical" data-via="<?php echo TWITTER_USERNAME; ?>" rel="nofollow" target="_blank">Tweet</a></div>
  	</li>
  	<li class="gp">
			<h6>Google+</h6>
			<div class="bubble"><div class="g-plusone" data-size="tall" data-href="<?php the_permalink(); ?>" rel="nofollow" target="_blank"></div></div>
  	</li>
<?php if(!get_post_type() == 'videos' || !is_post_type_archive('videos')) { ?>

<?php if(get_post_meta($post->ID, 'infographic_value', TRUE) ) { ?>
		<li class="pi">
			<h6>Pin It!</h6>
			<div class="bubble"><a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo jg_post_thumbnail_src(2) ?>&description=<?php the_title(); ?>" class="pin-it-button" count-layout="vertical" rel="nofollow" target="_blank"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a></div>
		</li>
<?php } ?>
		<li class="em">
			<h6><a href="mailto:?subject=<?php the_title(); ?>&amp;body=<?php the_permalink(); ?>" class=" email">Email</a></h6>
		</li>
<?php } ?>
  </ul>
</aside>