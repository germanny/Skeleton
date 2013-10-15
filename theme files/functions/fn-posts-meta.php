<?php
/* Prints HTML with meta information for the current post-date/time and author.
***************************************************************************************************************************************/
function jg_posted_on() {
	printf( '%2$s <span class="meta-sep">Posted</span> ', //%2$s <span class="meta-sep">Posted by</span> %3$s
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( 'View all posts by %s', get_the_author() ),
			get_the_author()
		)
	);
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = ' in %1$s';
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = ' in %1$s';
	} else {
		$posted_in = 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.';
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);

}

/* Prints HTML with meta information for the current post (category, tags and permalink).
***************************************************************************************************************************************/
function jg_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.';
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.';
	} else {
		$posted_in = 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.';
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}

/* Display navigation to next/previous pages when applicable
***************************************************************************************************************************************/
function jg_content_nav( $nav_id = 'nav-below' ) {
	global $wp_query;
$prev = get_previous_post();
$next = get_next_post();
$paged = $wp_query->get( 'paged' );

	if ( $wp_query->max_num_pages > 1 ) { ?>
		<nav id="<?php echo $nav_id; ?>" class="navigation">
			<h3 class="screen-reader-text">Post navigation</h3>
			<?php if($prev != '') { ?><span class="nav-previous"><?php next_posts_link( 'Older posts'); ?></span><?php } ?>
			<?php if($paged != 0) { ?><span class="nav-next"><?php previous_posts_link( 'Newer posts'); ?></span><?php } ?>
		</nav><!-- #<?php echo $nav_id; ?> -->
	<?php } else {
		if(is_single()){ ?>
		<nav id="nav-single" class="navigation">
			<h3 class="screen-reader-text">Post navigation</h3>
			<?php if($prev != '') { ?><span class="nav-previous"><?php previous_post_link( '%link', 'Older posts'); ?></span><?php } ?>
			<?php if($next != '') { ?><span class="nav-next"><?php next_post_link( '%link', 'Newer posts'); ?></span><?php } ?>
		</nav><!-- #nav-single -->
	<?php }
	}
}
function jg_no_posts(){ ?>
				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h2 class="entry-title">Nothing Found</h2>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p>No results were found for the requested archive. Perhaps searching will help find a related post.</p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

<?php }

?>