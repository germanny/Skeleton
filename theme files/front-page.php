<?php
/**
 * Front Page template.
 */
get_header(); ?>

<!-- Main Body -->
<div id="content">

	<?php
		include('includes/inc-carousel.php');
		include('includes/inc-art-maintenance.php');
		include('includes/inc-find-your-state.php');
	?>

</div>

<!-- Sidebar -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>