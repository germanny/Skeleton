<?php 
/*
Plugin Name: JG Degrees
Plugin URI: 
Description: Post Type for Degrees
Version: 1.0
Author: Jen Germann 
Author URI: http://jengermann.com
*/

// Enable post thumbnails
// include "includes/functions.php";
class jg_degrees {
	
	//var $meta_fields = array("logo_image","acc_agency","address","city","state","zip","area_code","phone","ext","website","tuition_fees","percent_fin_aid");
	var $meta_fields = array("most_popular");
	
	
	function jg_degrees()
	{
		// Register custom post types
		register_post_type('jg_degrees', array(
			'label' => __('Degrees'),
			'singular_label' => __('Degree'),
			'public' => true,
			'show_ui' => true, // UI in admin panel
			'_builtin' => false, // It's a custom post type, not built in
			'_edit_link' => 'post.php?post=%d',
			'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite' => array("slug" => "degree"), // Permalinks
			'query_var' => "jg_degrees", // This goes to the WP_Query schema
			'supports' => array('title', 'editor', 'excerpt', 'thumbnail'/*, 'comments' ,'custom-fields'*/), // Let's use custom fields for debugging purposes only
			//'taxonomies' => array('category', 'post_tag')
		));
		
		add_filter("manage_edit-jg_degrees_columns", array(&$this, "edit_columns"));
		add_action("manage_posts_custom_column", array(&$this, "custom_columns"));
		
		// Register custom taxonomy
		register_taxonomy( 'degree_types', 'jg_degrees', array( 'hierarchical' => true, 'label' => __('Degree Type') ) );  
	
		// Admin interface init
		add_action("admin_init", array(&$this, "admin_init"));
		add_action("template_redirect", array(&$this, 'template_redirect'));
		
		// Insert post hook
		add_action("wp_insert_post", array(&$this, "wp_insert_post"), 10, 2);
	}
	
	function edit_columns($columns)
	{
		$columns = array(
			"cb" => "<input type=\"checkbox\" />",
			"title" => "Title",
			"degree_types" => "Degree Type",
			"most_popular" => "Most Popular?",
		);
		
		return $columns;
	}
	
	function custom_columns($column)
	{
		global $post;
		//echo $post->ID;
		$custom = get_post_custom();
		switch ($column)
		{
			case "degree_types":
				$degree_types = get_the_term_list($post->ID, 'degree_types', '', ', ','');  
				echo $degree_types;
				break;
			case "most_popular":
				$most_popular = get_post_custom();
				echo $custom["most_popular"][0];
			break;
		}
	}
	
	// Template selection
	function template_redirect()
	{
		global $wp;
		if ($wp->query_vars["post_type"] == "jg_degrees")
		{
			include(TEMPLATEPATH . "/jg-degrees.php");
			die();
		}
	}
	
	// When a post is inserted or updated
	function wp_insert_post($post_id, $post = null)
	{
		if ($post->post_type == "jg_degrees")
		{
			// Loop through the POST data
			foreach ($this->meta_fields as $key)
			{
				$value = @$_POST[$key];
				//if($key == 'logo_image')
				//{
				//	$filename = $post_id . "-".$_FILES["logo_image"]["name"];
				//	$tempfile = $_FILES["logo_image"]["tmp_name"];
					
				//	if($_FILES["logo_image"]["name"] != "" && $filename != "")
				//	{
				//		if(strpos(strtoupper($filename), ".JPG") || strpos(strtoupper($filename), ".GIF") || strpos(strtoupper($filename), ".PNG"))
				//		{
				//			upload_file($tempfile, $filename,$resizewidth);
				//			if (!update_post_meta($post_id, "logo_image", $filename))
				//			{
								// Or add the meta data
				//				add_post_meta($post_id, "logo_image", $filename);
				//			}
				//		}
				//	}
				//	continue;
				//}
				
				// If value is a string it should be unique
				if (!is_array($value))
				{
					if($value != "")
					{
						// Update meta
						if (!update_post_meta($post_id, $key, $value))
						{
							// Or add the meta data
							add_post_meta($post_id, $key, $value);
						}
					}
				}
				else
				{
					// If passed along is an array, we should remove all previous data
					delete_post_meta($post_id, $key);
					
					// Loop through the array adding new values to the post meta as different entries with the same name
					foreach ($value as $entry)
					{
						if($entry != "")
							add_post_meta($post_id, $key, $entry);
					}
				}
			}
		}
	}
	
	function admin_init() 
	{
		// Custom meta boxes for the edit jg_degrees screen
	add_meta_box("degree-meta", "Degree Options", array(&$this, "meta_options"), "jg_degrees", "normal", "low");
	}
	
	// Admin post meta contents
	function meta_options()
	{ //"acc_agency","address","city","state","zip"
		global $post;
		$custom = get_post_custom($post->ID);
		$most_popular = $custom["most_popular"][0];
?>
	<script type="text/javascript">
		document.getElementById("post").setAttribute("enctype","multipart/form-data");
		document.getElementById('post').setAttribute('encoding','multipart/form-data');
	</script>

<?php if ( attribute_escape($most_popular) === "true" ){
				$checked = "checked=\"checked\""; 
			} else {
				$checked = "";
			} 
?>
<table>
<tr>
	<td><label><strong>Most Popular Degree</strong>:</label></td>
	<td colspan="2">
		<input name="most_popular" id="most_popular" type="checkbox" class="checkbox" value="true" <?php echo $checked; ?> />
	</td>
</tr>

</table>
<?php
	}
}

// Initiate the plugin
add_action("init", "jg_degreesInit");
function jg_degreesInit() { global $jgs; $jgs = new jg_degrees(); }
?>