<?php
    /*
     * If the current post is protected by a password and
     * the visitor has not yet entered the password we will
     * return early without loading the comments.
     */
    if ( post_password_required() )
        return;
?>

<?php if ( comments_open() ) : ?>
<section id="comments">
	<header class="sub-section-title">
		<h3>Facebook Comments</h3>
	</header>
    <script src="http://connect.facebook.net/en_US/all.js#xfbml=<?php echo FB_APP_ID; ?>"></script>
    <div id="fbcomments">
    <div id="fb-root"></div>
		<div class="fb-comments" data-href="<?php the_permalink(); ?>" data-num-posts="5" mobile="false"></div>
    </div>
</section>
<?php endif; ?>