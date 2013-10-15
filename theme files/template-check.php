<?php
/*
Template Name: xyz
*/

get_header();
?>

<?php
	$pages = get_pages(array(
		'meta_key' => '_wp_page_template',
		'meta_value' => 'template_scholarship.php'
	));

	print_r($pages);
?>

<?php get_footer(); ?>
