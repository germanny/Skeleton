<?php
	//$parent_name = $wpdb->get_var("SELECT post_name FROM $wpdb->posts WHERE ID = '$post->post_parent;'");
	$hometitle = '';
	//$thisPage = "$post->post_title";
	$description = get_bloginfo('description');
	$homedesc = '';
?>
<!doctype html>
<!--[if lt IE 7]> <html <?php language_attributes(); ?> xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml" itemscope itemtype="http://schema.org/WebPage" class="no-js lt-ie10 lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>    <html <?php language_attributes(); ?> xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml" itemscope itemtype="http://schema.org/WebPage" class="no-js lt-ie10 lt-ie9 lt-ie8 ie7" lang="en"> <![endif]-->
<!--[if IE 8]>    <html <?php language_attributes(); ?> xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml" itemscope itemtype="http://schema.org/WebPage" class="no-js lt-ie10 lt-ie9 ie8" lang="en"> <![endif]-->
<!--[if IE 9]>    <html <?php language_attributes(); ?> xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml" itemscope itemtype="http://schema.org/WebPage" class="no-js lt-ie10 ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html <?php language_attributes(); ?> class="no-js" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml"> <!--<![endif]-->

<head>

<!-- META -->
<?php include('header-metadata.php'); ?>

<!-- STYLING -->
<link rel="stylesheet" type="text/css" media="screen, projection" href="<?php bloginfo( 'stylesheet_url' ); ?>">
<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_directory' ); ?>/style-articles.css">

<!-- MISC -->
<!-- fav and touch icons -->
<link rel="shortcut icon" href="<?php echo SITE_URL; ?>/favicon.ico">
<link rel="apple-touch-icon" href="<?php bloginfo( 'stylesheet_directory' ); ?>/assets/images/ico/apple-touch-icon.png">
<link rel="apple-touch-icon" sizes="72x72" href="<?php bloginfo( 'stylesheet_directory' ); ?>/assets/images/ico/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="114x114" href="<?php bloginfo( 'stylesheet_directory' ); ?>/assets/images/ico/apple-touch-icon-114x114.png">

<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<!-- Typkit Code -->
<script type="text/javascript" src="http://use.typekit.com/<?php echo TYPEKIT; ?>.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
<!-- JS -->

<?php wp_head(); ?>

<!-- Scripts -->
<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	
</head>

<body id="<?php
if ( is_404() ) {
	echo "fourOfour";
} elseif (is_page('home') || is_front_page()) {
	echo "page-home";
} elseif (is_home() || is_category() || is_archive() || is_search() || is_single() || is_date() ) {
	echo "blog";
}elseif /* If this is a single page */ ( is_page() ){
	echo $post->post_name;
} ?>" <?php body_class(); ?>>

<p id="accessibility" class="screen-reader-text">Skip to: <a href="#menu">Navigation</a> | <a href="#content">Content</a> | <a href="#side_main">Sidebar</a> | <a href="#siteinfo">Footer</a></p>

<a name="top" id="top"></a>
<div id="page">
<header id="branding">
	<div class="wrap">
<?php $heading_tag = ( is_page('home') || is_front_page() ) ? 'h1' : 'div'; ?>
	<<?php echo $heading_tag; ?> id="logo"><a href="<?php echo SITE_URL; ?>" title="<?php echo SITE_NAME; ?>"><?php echo SITE_NAME; ?></a></<?php echo $heading_tag; ?>>
	<nav id="menu" role="navigation">
		<?php wp_nav_menu( array( 'container_class' => 'main_menu', 'theme_location' => 'main nav' ) ); ?>
	</nav><!-- nav#menu -->
	</div>
</header><!-- /header.body -->

<div id="main">