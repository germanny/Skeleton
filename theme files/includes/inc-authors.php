<?php $blogusers = get_users( 'include=4,6' );
foreach ($blogusers as $user) {
$author_posts_url = get_author_posts_url($user->ID);
$owns = get_user_meta( $user->ID, 'owns', true );
$wants = get_user_meta( $user->ID, 'wants', true );
$dreams = get_user_meta( $user->ID, 'dreams', true );
?>
<div class="author <?php echo $classes; ?>">
	<a href="<?php echo $author_posts_url;?>" class="author-photo"><?php echo userphoto_thumbnail($user->ID);?></a>

	<div>
		<h3><a href="<?php echo $author_posts_url;?>"><?php echo $user->display_name; ?></a></h3>
		<p>
			<?php if ( $owns ) { ?><strong>Owns:</strong> <?php echo $owns; ?><br /><?php } ?>
			<?php if ( $wants ) { ?><strong>Wants:</strong> <?php echo $wants; ?><br /><?php } ?>
			<?php if ( $dreams ) { ?><strong>Dreams:</strong> <?php echo $dreams; ?><?php } ?>
		</p>
	</div>
</div><!-- END .author -->

<?php } ?>