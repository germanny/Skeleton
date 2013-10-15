<?php // IF CMB ONLY NEEDED FOR CERTAIN PAGES, YOU CAN LIMIT WHICH PAGES THIS SHOW ON: // https://gist.github.com/3310364
$page_custom_fields =
array(
	"custom_image" => array(
		"name" => "custom_image",
		"std" => "",
		"title" => "Paste Your Custom Image URL Here ",
		"description" => "This box can be used for an image in a Page Template where you cannot add the image to the content area.",
		"type" => "input"),
);

function page_custom_fields() {
	global $post, $page_custom_fields;
	foreach($page_custom_fields as $meta_box) {
		$meta_box_value = stripslashes(get_post_meta($post->ID, $meta_box['name'].'_value', true));
		if($meta_box_value == "")
			$meta_box_value = $meta_box['std'];

			echo '<p style="margin-bottom:10px;">';
			echo'<input type="hidden" name="'.$meta_box['name'].'" id="'.$meta_box['name'].'" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';

			switch ( $meta_box['type'] ) {
				case "checkbox": 
				if ( esc_attr($meta_box_value) === "true" ){
					$checked = "checked=\"checked\""; 
				} else {
					$checked = "";
				} 
				echo'<label for="'.$meta_box['name'].'"><input type="'.$meta_box['type'].'" name="'.$meta_box['name'].'" id="'.$meta_box['name'].'" class="checkbox" value="true" '.$checked.'> <strong>'.$meta_box['title'].'</strong> <small><em>'.$meta_box['description'].'</em></small></label><br />';
			break;
			echo '</p>'; }
	}
}
function create_meta_box() {
	global $theme_name;
		if ( function_exists('add_meta_box') ) {
			add_meta_box( 'new-meta-boxes', 'Custom Image', 'page_custom_fields', 'page', 'normal', 'high' );
	}
}
function save_pagedata( $post_id ) {
	global $post, $page_custom_fields;
	foreach($page_custom_fields as $meta_box) {
		// Verify
		if(isset($_POST[$meta_box['name']])) {
			if ( !wp_verify_nonce( $_POST[$meta_box['name']], plugin_basename(__FILE__) )) {
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
		if(isset($_POST[$meta_box['name'].'_value'])) {
			$data = $_POST[$meta_box['name'].'_value'];
			if(get_post_meta($post_id, $meta_box['name'].'_value') == "")
				add_post_meta($post_id, $meta_box['name'].'_value', $data, true);
			elseif($data != get_post_meta($post_id, $meta_box['name'].'_value', true))
				update_post_meta($post_id, $meta_box['name'].'_value', $data);
			elseif($data == "")
				delete_post_meta($post_id, $meta_box['name'].'_value', get_post_meta($post_id, $meta_box['name'].'_value', true));
			}
		}
}
add_action('admin_menu', 'create_meta_box');
add_action('save_post', 'save_pagedata');
?>