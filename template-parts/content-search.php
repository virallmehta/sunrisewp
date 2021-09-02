<?php
?>
<div class="inner-page-wrap clearfix">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
		<header class="entry-header">
    		<?php the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
			<?php if ( 'post' == get_post_type() ) : ?>
	    		<div class="entry-meta">
	    			<?php ss_posted_on(); ?>
	    		</div>
	    	<?php endif; ?>
    	</header>

    	<div class="entry-summary">
    		<?php the_excerpt(); ?>
    	</div><!-- .entry-summary -->

</article>
</div>