<?php
// SHORTCODE - Featured School

	function jg_featured_school( $atts ) {
		
		extract(shortcode_atts(array(

        "school" => 'Kaplan University',
        "link" => 'http://jengermann.com',

    ), $atts));

    return
'<div id="featured-school">
	<h3>Featured School</h3>
 	<a class="url" href="'.$link.'"><img src="http://schools.bestcollegesonline.com/images/logos/'.strtolower(str_replace(' ', '-', $school)).'.178px.png?p=COLOR&amp;o=VERTICAL" alt="'.$school.'"></a>
 	<a class="btn" href="'.$link.'">Request Info</a>
</div>';

	}
	
	add_shortcode( 'featured-school', 'jg_featured_school' );
?>