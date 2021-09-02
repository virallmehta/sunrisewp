<?php
    if ( !function_exists( 'ss_page_comments' ) ) {
        function ss_page_comments() {

            global $ss_theme_options;
            $disable_pagecomments = $ss_theme_options['disable_pagecomments'];

            $comments_class = apply_filters( 'ss_post_comments_wrap_class', 'col-sm-8 col-sm-offset-2' );

            if ( comments_open() && ! $disable_pagecomments ) {
                ?>
                <div class="comments-wrap container">
                    <div id="comment-area" class="<?php echo esc_attr($comments_class); ?>">
                        <?php comments_template( '', true ); ?>
                    </div>
                </div>
            <?php
            }
        }

        add_action( 'ss_page_content_end', 'ss_page_comments', 10 );
    }
?>
<?php while ( have_posts() ) : the_post(); ?>

    <?php do_action( 'ss_page_content_before' ); ?>

    <article <?php post_class( 'clearfix' ); ?> id="<?php the_ID(); ?>">

        <?php do_action( 'ss_page_content_start' ); ?>

        <div class="entry-content">

        	<?php the_content(); ?>

        	<div class="link-pages"><?php wp_link_pages(); ?></div>
    	</div>

        <footer class="entry-footer">
            <?php edit_post_link( __( ' Edit', AR_DOMAIN ), '<div class="entry-footer "><i class="fa fa-edit"></i>', '</div>' ); ?>
        </footer><!-- .entry-footer -->

        <?php
            /**
             * @hooked - ss_page_comments - 10
             **/
            do_action( 'ss_page_content_end' );
        ?>

    </article>

    <?php do_action( 'ss_page_content_after' ); ?>

<?php endwhile; ?>