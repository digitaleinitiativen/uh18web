<?php
/**
 * Template Name: Home
 */

get_header(); ?>

    <?php
    while ( have_posts() ) : the_post();

        get_template_part( 'template-parts/content', 'home' );

        // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif;

    endwhile; // End of the loop.
    ?>

<script id="wallsio-widget-script" src="https://walls.io/js/wallsio-widget-1.2.js" data-wallurl="https://walls.io/uh18?nobackground=1&amp;hide_header=1" data-width="100%" data-autoheight="1" data-height="800"></script>

<?php
get_sidebar();
get_footer();
