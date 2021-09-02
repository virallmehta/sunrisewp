<?php
global $post, $wp_query, $ss_theme_options;

$show_author   	= $ss_theme_options['archive_include_author'];
$show_date    	= $ss_theme_options['archive_include_date'];
$show_category	= $ss_theme_options['archive_include_category'];
$show_comment   = $ss_theme_options['archive_include_comment'];
$show_view		= $ss_theme_options['archive_include_view_count'];
$content_output  = $ss_theme_options['archive_content_output'];
$excerpt_length  = 120;
$comments_icon   = apply_filters( 'ss_comments_icon', '<i class="fa fa-comments-o" aria-hidden="true"></i>' );
$link_icon       = apply_filters( 'ss_link_icon', '<i class="fa fa-link" aria-hidden="true"></i>' );

// Show/Hide
$show_title     = "yes";
$show_details   = "yes";
$show_excerpt   = "yes";
$show_read_more = "yes";

// Post Meta
$post_id         = $post->ID;
$post_format     = get_post_format();
$post_title      = get_the_title();
$post_author     = get_the_author();
$post_date       = get_the_date();
$post_date_str   = get_the_date('Y-m-d');
$post_date_month = get_the_date('M');
$post_date_day   = get_the_date('d');
$post_date_year  = get_the_date('Y');
$post_categories = get_the_category_list( ', ' );
$post_comments   = get_comments_number();
$post_permalink  = get_permalink();
$post_excerpt    = '';
$thumb_type      = ss_get_post_meta( $post_id, 'ss_thumbnail_type', true );

if ( $content_output == "excerpt" ) {
    if ( $post_format == "quote" ) {
        $post_excerpt = ss_get_the_content_with_formatting();
    } else {
        $excerpt = wp_trim_words( get_the_excerpt(),  $excerpt_length );
        $excerpt = preg_replace( '`\[[^\]]*\]`', '', $excerpt );
        $post_excerpt = '<p>' . $excerpt . '</p>';
        $post_excerpt =  ss_excerpt( $excerpt_length );
    }
} else {
    $post_excerpt = ss_get_the_content_with_formatting();
}
if ( $post_format == "chat" ) {
    $post_excerpt = ss_content( 40 );
} else if ( $post_format == "audio" ) {
    $post_excerpt = do_shortcode( get_the_content() );
} else if ( $post_format == "video" ) {
    $content      = get_the_content();
    $content      = apply_filters( 'the_content', $content );
    $post_excerpt = $content;
} else if ( $post_format == "link" ) {
    $content      = get_the_content();
    $content      = apply_filters( 'the_content', $content );
    $post_excerpt = $content;
}
$post_permalink_config = 'href="' . $post_permalink . '" class="link-to-post"';
?>
<div class="post-content-wrap">
    <?php if ( $show_category == 1 ) { ?>
        <div class="blog-item-category"><span><?php echo $post_categories; ?></span></div>
    <?php } ?>
	<figure class="animate-overlay thumb-media-<?php echo $thumb_type; ?>">
		<?php 
			$item_figure = ss_post_thumbnail( 960, 350 );
			echo $item_figure;
		?>
	</figure>
	<h3 itemprop="name headline" class="post_title"><a href="<?php echo $post_permalink; ?>"><?php echo $post_title; ?></a></h3>
	<?php 
		// DETAILS SETUP
        $item_details = "";
        if ( $show_author == 1 && $show_date == 1 ) {
            $item_details .= '<div class="blog-item-details">' . sprintf( __( '<span class="author">By <a href="%2$s" rel="author" itemprop="author">%1$s</a></span> on <time datetime="%3$s">%4$s</time>', SS_DOMAIN ), $post_author, get_author_posts_url( get_the_author_meta( 'ID' ) ), $post_date_str, $post_date ) . '</div>';
        } else if ( $show_date == 1 ) {
            $item_details .= '<div class="blog-item-details">' . sprintf( __( 'Posted on <time datetime="%1$s">%2$s</time>', SS_DOMAIN ), $post_date_str, $post_date ) . '</div>';
        } else if ( $show_author == 1 && $show_date == 0 ) {
            $item_details .= '<div class="blog-item-details">' . sprintf( __( '<span class="author">By <a href="%2$s" rel="author" itemprop="author">%1$s</a></span>', SS_DOMAIN ), $post_author, get_author_posts_url( get_the_author_meta( 'ID' ) )) . '</div>';
        }
	?>
	<div class="blog-meta"><?php echo $item_details; ?></div>
	<div class="blog-excerpt" itemprop="description"><?php echo $post_excerpt; ?></div>
	
</div>
<?php 

?>