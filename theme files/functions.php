<?php
/* Customize the variables here
****************************************************************************************************************************************/
define( "SITE_NAME", get_option('blogname') );
define( "SITE_URL", home_url() );
define( "AUTHOR", SITE_NAME . " - ". SITE_URL );

define('TYPEKIT', 'ths7ytn');
define( 'THEME_DIR', get_template_directory_uri() );
define('DEFAULT_PHOTO', get_template_directory_uri().'/assets/images/photo-featured-default.gif');
define('VIDEO_CAT', 'video');

define('FB_APP_ID', 'FB_APP_ID GOES HERE');
define('PINTERST', 'USERNAME GOES HERE');

// USE THE YOAST SEO PLUGIN TO CREATE THESE CONSTANTS
// http://wordpress.org/plugins/wordpress-seo/
// https://gist.github.com/germanny/6222479
$get_options_wpseo_social = get_option('wpseo_social');
define('TWITTER_USERNAME', $get_options_wpseo_social['twitter_site']);
define('FB_PAGE', $get_options_wpseo_social['facebook_site']);

$plus_author_link = get_user_meta($get_options_wpseo_social['plus-author'], 'googleplus', TRUE);
$plus_author_link = ( substr($plus_author_link, -1) == '/' ) ? $plus_author_link . '?rel=author' : $plus_author_link . '/?rel=author';
define('GOOGLE_PAGE', $plus_author_link);


/* Queue up stylesheets per page
   http://codex.wordpress.org/Function_Reference/wp_enqueue_style
********************************************************************************************************************************/
function add_my_styles() {
    global $post;
    // BASE STYLES FOR EVERY PAGE
    wp_register_style( 'base-styles', THEME_DIR . '/style.css' );
    wp_enqueue_style( 'base-styles' );
}
add_action( 'wp_enqueue_scripts', 'add_my_styles' );


/* Deregister jQuery 1.7.1 (WP default) and register jQuery 1.7.2
http://codex.wordpress.org/Function_Reference/wp_enqueue_script
http://wp.tutsplus.com/tutorials/the-ins-and-outs-of-the-enqueue-script-for-wordpress-themes-and-plugins/
http://digwp.com/2009/06/including-jquery-in-wordpress-the-right-way/
****************************************************************************************************************************************/
function lets_make_some_scripts() {
	wp_enqueue_script('modernizr', THEME_DIR . '/assets/js/libs/modernizr-2.0.6.min.js'); 
	wp_register_script('myscripts', THEME_DIR . '/assets/js/scripts.js', false, '1.0', true );
	wp_enqueue_script('myscripts');
}    
 
add_action('wp_enqueue_scripts', 'lets_make_some_scripts');


/* Custom Post Functions
********************************************************************************************************************************/
include_once('functions/fn-posts-meta.php');

/* CUSTOM LOGIN
***************************************************************************************************************************************/
include_once('functions/fn-custom-login.php');


/*IMAGES
Add Post Thumbnail Images
***************************************************************************************************************************************/
add_theme_support( 'post-thumbnails', array( 'post', 'page' ) );
set_post_thumbnail_size( 200, 155, true );


/* ADD SUPPORT FOR VARIOUS THUMBNAIL SIZES
http://codex.wordpress.org/Function_Reference/add_image_size
**************************************************************************************************************************************
if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'homepage-thumb', 210, 155, true ); //(cropped)
}*/


/* POST THUMBNAIL
***************************************************************************************************************************************/
include_once('functions/fn-post-thumbnail.php');


/* MISC:
NEAT TRIM: Trim length of excerpt to certain # of words
PAGE TITLE: Print the <title> tag based on what is being viewed.
Miscellaneous Theme Support Functions
***************************************************************************************************************************************/
include_once('functions/fn-misc.php');


/* SHORTCODE
***************************************************************************************************************************************/
include('functions/shortcodes/shortcode-include-file.php');


// This theme styles the visual editor with editor-style.css to match the theme style.
add_editor_style();
add_theme_support( 'automatic-feed-links' );

/* =BEGIN: Remove WP generated junk from head
    Source: http://digwp.com/2010/03/wordpress-functions-php-template-custom-functions/
   ---------------------------------------------------------------------------------------------------- */
function removeHeadLinks() {
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wlwmanifest_link');
}
add_action('init', 'removeHeadLinks');


/* POST/PAGE CUSTOM FIELDS UI
********************************************************************************************************************************/
include_once('functions/fn-page-custom-fields-monetization.php');
include_once('functions/fn-post-custom-fields-infographic.php');


/* REGISTER MENUS
********************************************************************************************************************************/
if ( function_exists( 'register_nav_menus' ) ) {
	register_nav_menus(array('main nav' => 'Main Navigation', 'footer nav' => 'Footer Navigation', 'secondary nav' => 'Secondary Navigation'));
}


/* DISABLE PLUGIN STYLESHEETS
***************************************************************************************************************************************/
function kill_styles() {
	wp_deregister_style( 'contact-form-7' ); // contact-form-7 plugin
}
add_action( 'wp_print_styles', 'kill_styles', 100 );


/* CONTENT FILTER: Automatically Link Twitter Handles 
http://wp.tutsplus.com/articles/tips-articles/quick-tip-automatically-link-twitter-handles-with-a-content-filter/
***************************************************************************************************************************************/
function wptuts_twitter_handles($content) {
    $pattern= '/(?<=^|(?<=[^a-zA-Z0-9-_\.]))@([A-Za-z]+[A-Za-z0-9_]+)/i';
    $replace= '@<a href="http://www.twitter.com/$1">$1</a>';
    $content= preg_replace($pattern, $replace, $content);
    return $content;
}
 
add_filter( "the_content", "wptuts_twitter_handles" );


/* CHECK FOR GRAVATAR OR DEFAULT 
http://codex.wordpress.org/Using_Gravatars#Checking_for_the_Existence_of_a_Gravatar
***************************************************************************************************************************************/
function validate_gravatar($email) {
	// Craft a potential url and test its headers
	$hash = md5(strtolower(trim($email)));
	$uri = 'http://www.gravatar.com/avatar/' . $hash . '?d=404';
	$headers = @get_headers($uri);
	if (!preg_match("|200|", $headers[0])) {
		$has_valid_avatar = FALSE;
	} else {
		$has_valid_avatar = TRUE;
	}
	return $has_valid_avatar;
}


/* EXTRA PROFILE FIELDS FOR CAR LOVERS!
***************************************************************************************************************************************/
add_action( 'show_user_profile', 'my_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'my_show_extra_profile_fields' );

function my_show_extra_profile_fields( $user ) { ?>

	<h3>Extra profile information</h3>

	<table class="form-table">

		<tr>
			<th><label for="owns">Owns</label></th>

			<td>
				<input type="text" name="owns" id="owns" value="<?php echo esc_attr( get_the_author_meta( 'owns', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Car you own.</span>
			</td>
		</tr>

		<tr>
			<th><label for="wants">Wants</label></th>

			<td>
				<input type="text" name="wants" id="wants" value="<?php echo esc_attr( get_the_author_meta( 'wants', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Car you want.</span>
			</td>
		</tr>

		<tr>
			<th><label for="dreams">Dreams</label></th>

			<td>
				<input type="text" name="dreams" id="dreams" value="<?php echo esc_attr( get_the_author_meta( 'dreams', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Car you dream.</span>
			</td>
		</tr>

	</table>
<?php }
add_action( 'personal_options_update', 'my_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'my_save_extra_profile_fields' );

function my_save_extra_profile_fields( $user_id ) {

	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;

	/* Copy and paste this line for additional fields. Make sure to change 'twitter' to the field ID. */
	update_usermeta( $user_id, 'owns', $_POST['owns'] );
	update_usermeta( $user_id, 'wants', $_POST['wants'] );
	update_usermeta( $user_id, 'dreams', $_POST['dreams'] );
}


/* ADD BODY CLASS 
http://codex.wordpress.org/Function_Reference/body_class#Add_Classes_By_Filters
***************************************************************************************************************************************/
add_filter('body_class','my_class_names');
function my_class_names($classes) {
	// add 'class-name' to the $classes array
	global $post;
	if(get_post_meta($post->ID, 'infographic_value', TRUE) || in_category('infographic')) {
	$classes[] = 'single-infographic';
	}
	// return the $classes array
	return $classes;
}

/* =BEGIN: [WordPress] Remove Version Query Strings From JavaScript JS and CSS Stylesheet Files
	Source: http://www.sharepointjohn.com/wordpress-remove-version-query-strings-from-javascript-js-and-css-stylesheet-files/
   ---------------------------------------------------------------------------------------------------- */
	function _remove_script_version( $src ){
		$parts = explode( '?', $src );
		return $parts[0];
	}
	add_filter( 'script_loader_src', '_remove_script_version', 15, 1 );
	add_filter( 'style_loader_src', '_remove_script_version', 15, 1 );


/* ADD NAV CLASS
http://codex.wordpress.org/Function_Reference/wp_nav_menu
***************************************************************************************************************************************/

add_filter('nav_menu_css_class' , 'guide_class' , 10 , 2);
function guide_class($classes, $item){
	if ( 'featured-schools' == get_post_type() || 'os_guide' == get_post_type() || 'advice' == get_post_type() || is_post_type_archive( 'advice' ) || is_404() ) {
		//print_r($classes);
		if (in_array( 'nav-blog', $classes )) { $classes = array_diff( $classes, array('current_page_parent') ); }
	}
	if( 'advice' == get_post_type() && $item->title == "Accreditation" ) {
		$classes[] = 'current_page_item';
	}
	if( 'os_guide' == get_post_type() && $item->title == "Online Schools" ) {
		$classes[] = 'current_page_item';
	}
	if( 'featured-schools' == get_post_type() && $item->title == "Open Courses" ) {
		$classes[] = 'current_page_item';
	}
	return $classes;
}


/* =BEGIN: [WordPress] Remove Version Query Strings From JavaScript JS and CSS Stylesheet Files
	Source: http://www.sharepointjohn.com/wordpress-remove-version-query-strings-from-javascript-js-and-css-stylesheet-files/
   ---------------------------------------------------------------------------------------------------- */
	function _remove_script_version( $src ){
		$parts = explode( '?', $src );
		return $parts[0];
	}
	add_filter( 'script_loader_src', '_remove_script_version', 15, 1 );
	add_filter( 'style_loader_src', '_remove_script_version', 15, 1 );


/* =BEGIN: [Wordpress] Removing Full Size Image Option from the Media Uploader
	Source: http://www.youtube.com/watch?v=vCHzMKcjqaU
   ----------------------------------------------------------------------------------------------------
function remove_full_size_option() {

	$sizes = array(
		'thumbnail' => __('Thumbnail'), 
		'medium' => __('Medium'), 
		'large' => __('Large'),
		//'full' => __('Full Size')) // removed so we don't have huge ass images on our site
	);
	return $sizes;
}
add_filter('image_size_names_choose', 'remove_full_size_option'); */


/* TRACK FB SHARES 
http://wpsnipp.com/index.php/functions-php/track-post-views-without-a-plugin-using-post-meta/
***************************************************************************************************************************************/
function get_fb_share_count($fb_api_share_count, $postID){
    $fb_share_key = 'fb_share_count';
    $fb_share_count = get_post_meta($postID, $fb_share_key, true);
    if($fb_share_count==''){
        delete_post_meta($postID, $fb_share_key);
        add_post_meta($postID, $fb_share_key, $fb_api_share_count);
        return "0 View";
    }
    return $fb_share_count.' Views';
}
function set_fb_share_count($fb_api_share_count, $postID) {
    $fb_share_key = 'fb_share_count';
    $fb_share_count = get_post_meta($postID, $fb_share_key, true);
    if($fb_share_count==''){
        $fb_share_count = 0;
        delete_post_meta($postID, $fb_share_key);
        add_post_meta($postID, $fb_share_key, $fb_api_share_count);
    }else{
        update_post_meta($postID, $fb_share_key, $fb_api_share_count);
    }
}


?>
