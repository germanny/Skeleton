<?php wp_redirect(get_permalink($post->post_parent)); ?>
<?php
header ('HTTP/1.1 301 Moved Permanently');
header ('Location: '.get_permalink($post->post_parent));
?>