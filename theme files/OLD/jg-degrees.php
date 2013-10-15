<?php get_header(); ?>

<?php 
global $post;
// print_r($post);

	//$gender = get_post_meta($post->ID, 'gender', true);
	//$breed = get_post_meta($post->ID, 'breed', true);
	//$age = get_post_meta($post->ID, 'age', true);
	//$sponsor_link = get_post_meta($post->ID, 'sponsor_link', true);
	//$watch_link = get_post_meta($post->ID, 'watch_link', true);

	$degree = get_the_title();
	$permalink = get_permalink($post->ID);
	
	$degree_types = get_the_term_list( $post->ID, 'degree_types', '<strong>Degree Type</strong>: ', ', ', '' );
	
	// Add Programs list if this post was so tagged
	//if ( $college_programs != '' ) { $taxo_text .= "<p>". $college_programs. "</p>\n"; }
	//if ( $college_school_type != '' ) { $taxo_text .= "<p>". $college_school_type. "</p>\n"; }

if ( have_posts() ) while ( have_posts() ) : the_post(); $currentPost = $post->ID; ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="entry-content">

					<header class="page-header">
						<h1 class="page-title"><?php the_title(); ?></h1>
					</header><!-- .entry-header -->
			
					<?php the_content(); ?>
		
					<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>Pages:</span>', 'after' => '</div>' ) ); ?>
					<?php edit_post_link('Edit', '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .entry-content -->
			</article><!-- #post-<?php the_ID(); ?> -->

<?php endwhile; // end of the loop. ?>

			</section><!-- #page-content -->
		</div><!-- #content -->

<?php if(BROWSER_SIZE != 'mobile' ) { get_sidebar(); } ?>
<?php get_footer(); ?>
