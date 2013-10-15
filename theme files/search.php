<?php
/**
 * The search template file.
 */

get_header();

$search_results = $_GET['s']; ?>

		<div id="content" role="main">
			<section id="main-archive" class="archive">
				<header class="page-header">
					<h1 class="page-title">Search Results for: <b><?php echo stripslashes($search_results); ?></b></h1>
				</header>

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>
				
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<?php jg_post_thumbnail('large'); ?>
					<header class="entry-header">
						<div class="entry-meta">
							<?php jg_posted_on(); ?>
						</div><!-- .entry-meta -->
						<h3 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( array('before' => 'Permalink to: ', 'after' => '')); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
					</header><!-- .entry-header -->
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( array('before' => 'Permalink to: ', 'after' => '')); ?>" rel="bookmark" class="btn">Read More</a>
					
					<hr>
					
				</article><!-- #post-<?php the_ID(); ?> -->

			<?php endwhile;
				 //jg_content_nav( 'nav-below' );
				$article_query = new WP_Query();
				$paged = (intval(get_query_var('paged'))) ? intval(get_query_var('paged')) : 1;
				$article_query->query("showposts=2&paged=" . $paged);
				$wp_query = $article_query;
				if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else { 
				
				/* Display navigation to next/previous pages when applicable */  
				$prev = get_previous_post();
				$next = get_next_post();

				if (  $article_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $nav_id; ?>" class="post-nav">
			<h3 class="screen-reader-text">Post navigation</h3>
			<?php if($paged != 1) { ?><span class="nav-next btn"><?php previous_posts_link( 'Newer posts'); ?></span><?php } ?>
			<?php if($prev != '') { ?><span class="nav-previous btn"><?php next_posts_link( 'Older posts'); ?></span><?php } ?>
		</nav><!-- #<?php echo $nav_id; ?> -->
<?php endif; 

				}
				// Reset Post Data
wp_reset_postdata();
					else :
					jg_no_posts();
					endif;
						?>

					<hr class="clearer">
			</section><!-- #category-archive -->
		</div><!-- #content -->

<?php get_sidebar('blog'); ?>
<?php get_footer(); ?>
