<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 *
 * Edited by Joost de Valk to provide a better user experience, read more here:
 * http://yoast.com/wordpress-404-error-pages/
 */

/**
 * Because of using post_type=any we have to manually weed out the attachments from the query_posts results.
 *
 * @return WHERE statement that strips out attachment
 * @author Joost De Valk
 **/
function yst_strip_attachments($where) {
	$where .= ' AND post_type != "attachment"';
	return $where;
}
add_filter('posts_where','yst_strip_attachments');

get_header();
?>

		<div id="content" role="main">
			<section id="page-content">

				<header class="page-header">
					<?php  if ( is_404() ) { // ******* Don't display certain content if you are on this page ?>
          <h1 class="page-title">Error 404: Page Not Found</h1>

          <?php } else { // ******* Display the alternate content ?>

          <h1 class="page-title">Sorry, No Content Found</h1>
          <?php } ?>
				</header>

			<article id="post-0" class="post error404 not-found">
				<div class="entry-content">

		<p>You
                    <?php // Borrowed this section from http://codex.wordpress.org/Creating_an_Error_404_Page#Helpful_404_pages
                    #some variables for the script to use
                    #if you have some reason to change these, do.  but wordpress can handle it
                    $adminemail = get_bloginfo('admin_email'); #the administrator email address, according to wordpress
                    $website = home_url(); #gets your blog's url from wordpress
                    $websitename = get_bloginfo('name'); #sets the blog's name, according to wordpress

                      if (!isset($_SERVER['HTTP_REFERER'])) {
                        #politely blames the user for all the problems they caused
                            echo "tried going to "; #starts assembling an output paragraph
                    	$casemessage = "<strong>Don't panic!</strong>";
                      } elseif (isset($_SERVER['HTTP_REFERER'])) {
                        #this will help the user find what they want, and email me of a bad link
                    	echo "clicked a link to"; #now the message says You clicked a link to...
                            #setup a message to be sent to me
                    	$failuremess = "A user tried to go to $website"
                            .$_SERVER['REQUEST_URI']." and received a 404 (page not found) error. ";
                    	$failuremess .= "It wasn't their fault, so try fixing it.
                            They came from ".$_SERVER['HTTP_REFERER'];

                    	//mail($adminemail, "Bad Link To ".$_SERVER['REQUEST_URI'], $failuremess, "From: $websitename <noreply@$website>"); #email you about problem

                    	$casemessage = "An administrator has been emailed
                            about this problem, too.";#set a friendly message
                      }
                      echo " <strong>".$website.$_SERVER['REQUEST_URI']."</strong>"; ?>
                    and it doesn't exist. <?php echo $casemessage; ?>  Let us help you find what you came here for:
                      <?php //include(TEMPLATEPATH . "/searchform.php"); ?>
                    </p>
		<?php 
			$s = $wp_query->query_vars['name'];
			$s = preg_replace("/(.*)-(html|htm|php|asp|aspx)$/","$1",$s);
			$posts = query_posts( array( 'post_type' => 'any', 'name' => $s) );
			$s = str_replace("-"," ",$s);
			if (count($posts) == 0) {
			  $posts = query_posts(array( array('post_type' => 'any', 'name' => $s) ) );
			}
			if (count($posts) > 0) {
				echo "<ol><li>";
				echo "<p>Were you looking for one of the following posts or pages?</p>";
				echo "<ul>";
				foreach ($posts as $post) {
					echo '<li><a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a></li>';
				}
				echo "</ul>";
				echo "<p>If not, don't worry, I've got a few more tips for you to find it:</p></li>";
			} else {
				echo "<p><strong>Don't worry though!</strong> I've got a few tips for you to find it:</p>";
				echo "<ol>";
			}
		?>
			<li>
				<?php get_search_form(); ?>
			</li>
			<li>
				<strong>If you typed in a URL...</strong> make sure the spelling, cApitALiZaTiOn, and punctuation are correct. Then try reloading the page.
				
			</li>
			<li>
				Look for it in the <a href="<?php bloginfo('siteurl');?>/sitemap/">sitemap</a>.
				
			</li>
			<li>
				Start over again at the <a href="<?php bloginfo('siteurl');?>">homepage</a>.
			</li>
		</ol>								

				</div><!-- .entry-content -->
			</article><!-- #post-0 -->

			</section><!-- #page-content -->
		</div><!-- #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>

