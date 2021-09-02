<?php
    global $post, $ss_theme_options;
 	$blog_type      = $ss_theme_options['archive_display_type'];

 	$list_class = $item_class = "";

 	if ($blog_type == "masonry") {
 		$list_class = 'masonry-items';
 	} else {
 		$list_class = 'standard-items';
 	}

    $columns   		= 2;
    $pagination 	= "standard";
    $pagination_output = "";

    if ( isset($ss_theme_options['archive_display_columns']) && $blog_type == "masonry" ) {
    	$columns   = $ss_theme_options['archive_display_columns'];
    }
    if ( isset($ss_theme_options['archive_display_pagination']) ) {
    	$pagination   = $ss_theme_options['archive_display_pagination'];
    }
    
    $content_output = $ss_theme_options['archive_content_output'];
	$item_class 	= ''; //$blog_classes['item'];
	
	if ( $blog_type == "masonry" ) {
		if ( $columns == "5" ) {
		    $item_class = "col-sm-5";
		} else if ( $columns == "4" ) {
		    $item_class = "col-sm-3";
		} else if ( $columns == "3" ) {
		    $item_class = "col-sm-4";
		} else if ( $columns == "2" ) {
		    $item_class = "col-sm-6";	
		} else if ( $columns == "1" ) {
		    $item_class = "col-sm-12";
		}
    }	
?>

<div class="post-wrap post-<?php echo esc_attr($blog_type); ?>">

	<?php if ( have_posts() ) : ?>

			<ul class="blog-items row <?php echo $list_class; ?> <?php echo esc_attr($blog_type); ?> clearfix">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php
	                	$post_format = get_post_format( $post->ID );
	                	if ( $post_format == "" ) {
	                    	$post_format = 'standard';
	                	}
	                ?>
				 	<li <?php post_class( 'blog-item ' . $item_class . ' format-' . $post_format ); ?> itemscope itemtype="http://schema.org/BlogPosting">
	                    <?php ss_get_template( 'loop-layout-' . $blog_type ); ?>
	                </li>
	            <?php endwhile; ?>
	        </ul>

	       	<?php
			    $pagination_output .= '<div class="pagination-wrap">';
			    //$pagination_output .= ss_page_nav();
			    //$pagination_output .= ss_pagination( 'ppp' );
			    $pagination_output .= ss_pagination2();
			    $pagination_output .= '</div>';

			    echo $pagination_output;
			?>

	<?php else: ?>
	
		<?php ss_get_template( 'content-none' ); ?>
		
	<?php endif; ?>

</div>