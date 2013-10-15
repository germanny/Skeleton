<?php

/* ABSOLUTE ANCESTOR
Returns the absolute ancestor (parent, grandparent, great-grandparent if there is, etc.) of a post. The absolute ancestor is defined as a page that doesnt have further parents, that is, its post parent is '0'
****************************************************************************************************************************************/
function get_absolute_ancestor($post_id){ 
		global $wpdb;		 
		 $parent = $wpdb->get_var("SELECT `post_parent` FROM $wpdb->posts WHERE `ID`= $post_id");		 
		 if($parent == 0) //Return from the recursion with the title of the absolute ancestor post.
			return $wpdb->get_var("SELECT `post_name` FROM $wpdb->posts WHERE `ID`= $post_id");
		 return get_absolute_ancestor($parent);		 	
	}//ends function


/* =BEGIN: Check If Page Is Parent/Child/Ancestor
    Source: http://css-tricks.com/snippets/wordpress/if-page-is-parent-or-child/#comment-172337
    				https://gist.github.com/ericrasch/4723316
   ---------------------------------------------------------------------------------------------------- */
function is_tree( $page_id_or_slug ) { // $page_id_or_slug = The ID of the page we're looking for pages underneath
	global $post; // load details about this page
	
	if ( !is_numeric( $page_id_or_slug ) ) { // Used this code to change a slug to an ID, but had to change is_int to is_numeric for it to work: http://bavotasan.com/2011/is_child-conditional-function-for-wordpress/
		$page = get_page_by_path( $page_id_or_slug );
		$page_id_or_slug = $page->ID;
	}
		
	if ( is_page()&&( $post->post_parent==$page_id_or_slug||is_page( $page_id_or_slug ) ) )
		return true; // we're at the page or at a sub page
	else
		return false; // we're elsewhere
};


/* GET PAGE ID BY PAGE NAME (SLUG)
****************************************************************************************************************************************/
function get_id_by_page_name($page_name)
	{
		global $wpdb;
		$page_name_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '".$page_name."'");
		return $page_name_id;
	}


/* NEAT TRIM: Trim length of excerpt to certain # of words - LIMITS BY CHARACTERS TO THE NEAREST WORD
used in jg_excerpt()
****************************************************************************************************************************************/
	function neat_trim($str, $n, $delim=' &hellip;') {	
	$len = strlen($str);
	if ($len > $n) {
		preg_match('/(.{' . $n . '}.*?)\b/', $str, $matches);
		return rtrim($matches[1]) . $delim;
	}
	else {
		return $str;
	}
}


/* LIMIT # OF WORDS IN EXCERPT.- LIMITS BY WORDS
****************************************************************************************************************************************/
function string_limit_words($string, $word_limit)
{
  $words = explode(' ', $string, ($word_limit + 1));
  if(count($words) > $word_limit)
  array_pop($words);
  return implode(' ', $words);
}
/*
USE:
$excerpt = get_the_excerpt();
echo string_limit_words($excerpt,16);
*/


/* CUSTOM EXCERPT
****************************************************************************************************************************************/
function jg_excerpt($length = 200, $more = 1){
	$orig = get_the_excerpt();
	$a = html_entity_decode($orig);
	$excerpt = strip_tags($a);
	$excerpt = neat_trim($excerpt,$length);

	if ($more == 1) {
?>
	<p><?php echo $excerpt; ?> <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark" class="more-link">View More</a></p>
<?php } if ($more == 2) {
	return $excerpt;
	}
}

?>