<?php
/*Custom Comments Template
***************************************************************************************************************************************/
function jg_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
	<hr class="divider" />
		<article id="comment-<?php comment_ID(); ?>" class="comment">
		<span class="avatar"><?php echo get_avatar( $comment, 64 ); ?></span>
		<header class="comment-author vcard">
			<span class="author-name">
				<?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?>
				<span class="commentdate"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">	<?php printf( __( '%1$s' ), get_comment_date(),  get_comment_time() ); ?></a></span>

				<?php edit_comment_link( '(Edit)', ' | ' ); ?>
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<?php edit_comment_link('(Edit)','','') ?>
			<em class="comment-awaiting-moderation"><?php _e( ' | Your comment is awaiting moderation.'); ?></em>
		<?php endif; ?>

			</span>
		</header><!-- .comment-author .vcard -->

		<div class="comment-body">

			<?php comment_text(); ?>
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'reply_text' => 'Reply &#187;', 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- /.comment-body -->
	</article><!-- #comment-##  -->
<?php // </li> This trailing div is not needed. WP adds it automatically. ?>

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'ou' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'ou' ), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}


/* Removes the default styles that are packaged with the Recent Comments widget.
 *
 * To override this in a child theme, remove the filter and optionally add your own
 * function tied to the widgets_init action hook.
 *
 * This function uses a filter (show_recent_comments_widget_style) new in WordPress 3.1
 * to remove the default style. Using Twenty Ten 1.2 in WordPress 3.0 will show the styles,
 * but they won't have any effect on the widget in default Twenty Ten styling.
***************************************************************************************************************************************/
function jg_remove_recent_comments_style() {
	add_filter( 'show_recent_comments_widget_style', '__return_false' );
}
add_action( 'widgets_init', 'jg_remove_recent_comments_style' );

/* RECENT COMMENTS
***************************************************************************************************************************************/
function jg_recent_comments(){
$comments = get_comments('status=approve&number=5');

if ($comments) {
    foreach ($comments as $comment) {
//        echo '<li><a href="'. get_permalink($comment->comment_post_ID).'#comment-'.$comment->comment_ID .'" title="'.$comment->comment_author .' | '.get_the_title($comment->comment_post_ID).'">' . get_avatar( $comment->comment_author_email, $img_w);
//        echo '<span class="recent_comment_name">' . $comment->comment_author . ': </span>';
//		$comment_string = $comment->comment_content;
//		$comment_excerpt = substr($comment_string,0,100);

        echo '<li><a href="'. get_permalink($comment->comment_post_ID).'#comment-'.$comment->comment_ID .'" title="'.$comment->comment_author .' | '.get_the_title($comment->comment_post_ID).'"><span class="recent_comment_name">' . $comment->comment_author . ': </span>';
		$comment_string = $comment->comment_content;
		$comment_excerpt = substr($comment_string,0,100);

		echo $comment_excerpt;

		if (strlen($comment_excerpt) > 99){
			echo ' ...';
		}
        echo '</a></li>';
    }
}
else{
	echo '<li>No Comments Yet</li>';
}
}

?>