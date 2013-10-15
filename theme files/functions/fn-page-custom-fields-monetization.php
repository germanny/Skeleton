<?php // https://gist.github.com/3950382
function toggle_monetization() {
	global $post;
	$custom = get_post_custom($post->ID);
	if(isset($custom["toggle_monetization"][0])) {
		$money = $custom["toggle_monetization"][0];
	}
?>

<p style="margin-bottom:10px;">
	<strong>Monetization (widget)</strong><br>
	<input type="hidden" name="toggle_monetization_box" id="toggle_monetization_box" value="<?php echo wp_create_nonce( plugin_basename(__FILE__) ); ?>">
	<label for="yes">Show <input type="radio" id="yes" name="toggle_monetization" value="true" <?php if ((isset($money) && $money == 'true') || !isset($money) || $money == '') echo 'checked';?>></label>
	<label for="no" style="margin-left: 15px;">Do not show <input type="radio" id="no" name="toggle_monetization" value="false" <?php if ( isset($money) && $money == 'false' ) echo 'checked';?>></label></p>

<?php }

function create_toggle_monetization_meta_box() {
	if ( function_exists('add_meta_box') ) {
		add_meta_box( 'money-meta-boxes', 'Toggle Monetization', 'toggle_monetization', 'page', 'normal', 'high' );
	}
}

function save_toggle_monetization_pagedata( $post_id ) {
	global $post;
		// Verify
		if(isset($_POST['toggle_monetization_box'])) {
			if ( !wp_verify_nonce( $_POST['toggle_monetization_box'], plugin_basename(__FILE__) )) {
				return $post_id;
			}
			if ( 'page' == $_POST['post_type'] ) {
				if ( !current_user_can( 'edit_page', $post_id ))
					return $post_id;
			} else {
				if ( !current_user_can( 'edit_post', $post_id ))
					return $post_id;
			}
		}
		//skip auto save
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}
		if(isset($_POST['toggle_monetization'])) {
			update_post_meta($post->ID, "toggle_monetization", $_POST["toggle_monetization"] );
		} else {
			if(isset($post)) {
				delete_post_meta($post->ID, "toggle_monetization");
			}
		}
}

add_action('admin_menu', 'create_toggle_monetization_meta_box');
add_action('save_post', 'save_toggle_monetization_pagedata');
?>