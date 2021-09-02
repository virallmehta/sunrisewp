<?php
/** 
 * The template used for displaying 404 content
 * 
 */
 ?>
 <div class="inner-page-wrap clearfix">
    <?php do_action( 'ss_page_content_before' ); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> >
        
        <?php do_action( 'ss_page_content_start' ); ?>

        <header class="entry-header">
            <h1 class="entry-title"><?php _e( 'Oops! That page can&rsquo;t be found.', SS_DOMAIN ); ?></h1>
        </header>

        <div class="entry-content">
            
            <p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', SS_DOMAIN ); ?></p>

        </div>

    </article>

    <?php do_action( 'ss_page_content_before' ); ?>
  </div>          