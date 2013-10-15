<section id="recent-articles">
	<h2>Recent Articles</h2>
	<a href="#" title="" rel="bookmark" class="url">View All Articles</a>
	<ul>
	<?php 
		$args = array( 'numberposts' => 2, 'category' => 9 ); // Renters category
		$recent_two = get_posts( $args ); foreach($recent_two as $post) : setup_postdata($post); ?>
		<li>
			<small><?php the_time('F j, Y');?></small>
			<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<?php jg_excerpt(220,2); ?>
		</li>
	<?php endforeach; ?>

	<?php 
		$args = array( 'numberposts' => 4, 'offset' => 2, 'category' => 9 ); // Renters category
		$recent_four = get_posts( $args ); foreach($recent_four as $post) : setup_postdata($post); ?>
		<li>
			<small><?php the_time('F j, Y');?></small>
			<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		</li>
	<?php endforeach; ?>
	</ul>

</section><!-- #latest-posts -->
