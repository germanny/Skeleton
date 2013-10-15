<?php
$frontpage_id = get_option('page_on_front');
$blogpage_id = get_option('page_for_posts');
$postID = $post->ID;

if( is_front_page() ) {
	$id = $frontpage_id;
} else {
	$id = $postID;
}

	$_yoast_wpseo_metadesc = get_post_meta($id, '_yoast_wpseo_metadesc', true);
	$_yoast_wpseo_title = get_post_meta($id, '_yoast_wpseo_title', true);
	
	// if using SEO plugin, probably should use this: wp_title( '', true, 'right' )
	// else:
	$thistitle = trim(wp_title('-', false));

	// meta titles
	if($_yoast_wpseo_title) {
		$thistitle = $_yoast_wpseo_title;
	} 
	else { 
		$thistitle = $thistitle; 
	} 
	
	// meta descriptions
	if($_yoast_wpseo_metadesc) {
		$thisdesc = $_yoast_wpseo_metadesc;
	}
	else {
		if (have_posts() && is_single() OR is_page()) { 
			while( have_posts() ) : the_post();
				$thisdesc = jg_excerpt(900,2);
			endwhile;
		} 
		elseif( is_category() OR is_tag() ) {
				if(is_category()) {
					$thisdesc = "Posts related to Category: ".ucfirst(single_cat_title("", FALSE));
				} elseif(is_tag()) {
					$thisdesc = "Posts related to Tag: ".ucfirst(single_tag_title("", FALSE));
				} 
		} 
		else {
				$thisdesc = $description;
		}
	}
	// thumbnail
	if(is_single()) {
		$thisimage = jg_post_thumbnail_src();
	} else {
		$thisimage = DEFAULT_PHOTO;
	}
	// og:type
	if (is_page('home') || is_front_page()) { 
		$ogtype = "website";
	} elseif(is_home() || is_category() || is_tag()) { 
		$ogtype = "blog"; 
	} elseif (have_posts() && is_single() OR is_page()) { 
		while( have_posts()):the_post(); $ogtype = "article"; endwhile; 
	} else { 
		$ogtype = "website";
	}

	$charcodes = array('&#8217;', '&#039;');
	$doublequotescodes = array('&#8220;', '&#8243;', '&#8221;');
	$extraspaces = array('&#xa0;', '&#160;', '&nbsp;');
	$thistitle = str_replace($charcodes, "'", $thistitle);
	$thisdesc = str_replace($charcodes, "'", $thisdesc);
	$thisdesc = str_replace($extraspaces, "'", $thisdesc);
	$thisdesc = str_replace($doublequotescodes, '', $thisdesc);
	$thisdesc = str_replace(' [...]', ' ...', $thisdesc);
?>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>" charset="<?php bloginfo('charset'); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width" /> 
<meta name="title" content="<?php echo $thistitle; ?>">
<meta name="description" content="<?php echo $thisdesc; ?>">
<meta name="author" content="<?php echo AUTHOR; ?>"> 
<meta name="copyright" content="<?php echo date("Y"); echo " - ". SITE_NAME; ?>">

<title><?php echo $thistitle; ?></title>

<?php if (defined('FB_PAGE_ID')) { ?><meta property="fb:page_id" content="<?php echo FB_PAGE_ID; ?>"><?php } ?>
<?php if (defined('FB_ADMINS')) { ?><meta property="fb:admins" content="<?php echo FB_ADMINS; ?>"><?php } ?>
<?php if (defined('FB_APP_ID') && FB_APP_ID != 'YOUR APP ID HERE') { ?><meta property="fb:app_id" content="<?php echo FB_APP_ID; ?>"><?php } ?>

<meta property="og:url" content="<?php if (have_posts() && is_single() OR is_page()):while(have_posts()):the_post();the_permalink();endwhile; else: echo get_option('home'); endif;  ?>">
<meta property="og:type" content="<?php echo $ogtype; ?>">
<meta property="og:title" content="<?php echo $thistitle; ?>">
<meta property="og:locale" content="en_US">
<meta property="og:image" content="<?php echo $thisimage; ?>">
<meta property="og:description" content="<?php echo $thisdesc; ?>">
<meta property="og:site_name" content="<?php echo SITE_NAME; ?>">

<meta itemprop="name" content="<?php echo $thistitle; ?>">
<meta itemprop="description" content="<?php echo $thisdesc; ?>">
<meta itemprop="image" content="<?php echo $thisimage; ?>">
