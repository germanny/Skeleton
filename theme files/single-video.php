<?php
/**
 * The Template for displaying video posts.
 */

get_header(); ?>

<div id="col-right" class="clearfix">

<div id="breadcrumb" class="clearfix"></div>

<div id="content" class="full clearfix"> 
<div class="top"></div> 
<div class="left video-posts-single"> 
<div class="article"> 

	<header class="page-header">
		<h1 class="page-title">OEDb's College Hacker Series</h1>
	</header><!-- .page-header -->

		<div class="post">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<div class="entry-content">
			<?php
				if( get_post_meta($post->ID, 'vimeo_value', TRUE) ) {
					$vimeo_meta = get_post_meta($post->ID, 'vimeo_value', TRUE);
					vimeo_vid($vimeo_meta);
					// echo '<p class="video-link">view on: <a href="'.$vimeo_meta.'" title="Link to original video on Vimeo">'.$vimeo_meta.'</a></p>';
				}

			?>
				<br class="clearer">
						<?php include('includes/inc-sharebox.php'); ?>
						<h2 class="entry-title"><?php the_title(); ?></h2>
						<?php the_content(); ?>
					</div><!-- .entry-content -->

				</article><!-- #post-<?php the_ID(); ?> -->

		<?php endwhile; // end of the loop. ?>

   <?php endif; ?>

		<?php getVideos(4); ?>

			</div><!-- .post -->

</div><!-- END .article --> 
</div> 
 
<div class="bottom"></div> 
</div><!-- END #content --> 
 
</div><!-- END #col-right --> 

<?php get_sidebar(); ?>	
<?php get_footer(); ?>