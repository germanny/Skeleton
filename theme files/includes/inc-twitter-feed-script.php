<script type="text/javascript" src="<?php bloginfo( 'stylesheet_directory' ); ?>/js/jquery.tweet.js"></script>
<script type="text/javascript">
            jQuery(function($){
                $(".tweet").tweet({
                    username: "<?php echo TWITTER_USERNAME; ?>",
                    join_text: "auto",
                    avatar_size: 32,
                    count: 3,
                    loading_text: "loading tweets...",
                    template: "{text}{time}"
                });
            });
        </script>
