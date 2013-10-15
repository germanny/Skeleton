<?php
// THIS IS PAGE BY PAGE NAV LIKE THIS: http://www.homeinsurance.org/home-insurance-guide/chapter-1-what-is-home-insurance/

 //jg_content_nav( 'nav-below' );
$somemoreargs = array('post_type' => 'askexpert', 'orderby' => 'date', 'order' => 'DESC');
$pagelist = get_posts($somemoreargs);
$pages = array();
foreach ($pagelist as $page) {
   $pages[] += $page->ID;
}

$current = array_search($post->ID, $pages);
if(isset($pages[$current-1])) {
	$prevID = $pages[$current-1];
}
if(isset($pages[$current+1])) {
	$nextID = $pages[$current+1];
}
?>

<div class="navigation">
<?php if (!empty($prevID) ) { ?>
<div class="alignleft">
<a href="<?php echo get_permalink($prevID); ?>" title="<?php echo get_the_title($prevID); ?>"><?php $prevtitle = get_the_title($prevID); echo '<em>' . str_replace(': ', '</em><span>', $prevtitle) . '</span>'; ?></a>
</div>
<?php }
if (!empty($nextID) ) { ?>
<div class="alignright">
<a href="<?php echo get_permalink($nextID); ?>" title="<?php echo get_the_title($nextID); ?>"><?php $nexttitle = get_the_title($nextID); echo '<em>' . str_replace(': ', '</em><span>', $nexttitle) . '</span>'; ?></a>
</div>
<?php } ?>
<hr class="clearer">
</div><!-- .navigation -->
<?php  // end PAGE NAV ?>


<?php // THIS IS POST NAV, LIKE THIS: http://www.homeinsurance.org/blog/
				//jg_content_nav( 'nav-below' );
				if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else { 
				
				/* Display navigation to next/previous pages when applicable */  
				$prev = get_previous_post();
				$next = get_next_post(); ?>

		<nav id="<?php echo $nav_id; ?>" class="post-nav">
			<h3 class="screen-reader-text">Post navigation</h3>
			<?php if($paged != 1) { ?><?php previous_posts_link( '<span class="nav-next btn">Newer posts</span>'); ?><?php } ?>
			<?php if($prev != '') { ?><?php next_posts_link( '<span class="nav-previous btn">Older posts</span>'); ?><?php } ?>
		</nav><!-- #<?php echo $nav_id; ?> -->
<?php } ?>
