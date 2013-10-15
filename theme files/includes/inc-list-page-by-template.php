<ul>
<?php
global $post;
$args = array( 
	'posts_per_page' => -1,
		'post_type'  => 'page', 
    'meta_query' => array( 
        array(
            'key'   => '_wp_page_template', 
            'value' => 'template-mba-schools.php'
        )
    ));
$myposts = get_posts( $args );
foreach( $myposts as $post ) :	setup_postdata($post); ?>
	<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
<?php endforeach; ?>
</ul>


