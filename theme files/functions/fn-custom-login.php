<?php 
/**********************************************************************************************************************************************
Custom Login
***********************************************************************************************************************************************/
function custom_login() { 
echo '<link rel="stylesheet" type="text/css" href="' . get_template_directory_uri() . '/assets/styles/login-style.css" />'."\n"; 
}
function custom_headerurl() { 
return home_url();//return the current wp blog url 
}
function custom_headertitle() { 
return 'Powered by '. get_bloginfo('name');//return the current wp blog name; 
}
add_action('login_head', 'custom_login');
add_filter('login_headerurl', 'custom_headerurl');
add_filter('login_headertitle', 'custom_headertitle');
?>