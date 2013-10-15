<?php
/**
 * The template for displaying Tag pages.
 */

get_header(); ?>

	<section id="intro">
		<article id="welcome">
			<header class="section-title">
				<h1><span>Car Owner Blog</span></h1>
  		</header>
  	</article>
	</section><!-- END #intro -->

	<div id="content" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="archive-header">
				<h2 class="archive-title"><?php printf('Tag Archives: %s', '<span>' . single_tag_title( '', false ) . '</span>' ); ?></h2>

			<?php if ( tag_description() ) : // Show an optional tag description ?>
				<div class="archive-meta"><?php echo tag_description(); ?></div>
			<?php endif; ?>
			</header><!-- .archive-header -->

  		<?php 
  			/* Start the Loop */
  			while ( have_posts() ) : the_post();
  			get_template_part( 'article-content', get_post_format() );
  			endwhile;
  			jg_content_nav( 'nav-below' );
  			else :
  			jg_no_posts();
  			endif; 
  		?>

  </div><!-- #content -->

<?php get_sidebar('blog'); ?>
<hr class="clearer">
<?php get_footer(); ?>