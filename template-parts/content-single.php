<?php
/** 
 * The template used for displaying post content
 * 
 */
?>
<?php
remove_action( 'ss_post_article_end', 'ss_post_info', 20 );
add_action( 'ss_post_article_start', 'ss_page_heading', 5 );
add_action( 'ss_post_article_start', 'ss_get_post_meta_details', 10); 
//add_action( 'ss_post_before_article', 'penci_breadcrumbs', 5);
?>
<div class="inner-page-wrap clearfix">

<?php while ( have_posts() ) : the_post(); ?>

	<?php do_action( 'ss_post_before_article' ); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> itemscope itemtype="http://schema.org/Article" >	

		<?php
            /**
             * @hooked - ss_post_detail_heading - 5
             * @hooked - ss_get_post_meta_details - 10
             * @hooked - ss_post_detail_media - 20
             **/
            do_action( 'ss_post_article_start' );
        ?>

        <section class="post-content clearfix ">

        	<?php
                do_action( 'ss_before_post_content' );
            ?>


	        <div class="content-wrap clearfix" itemprop="articleBody">

                <?php
                     do_action( 'ss_post_content_start' );
                ?>
				
				<div class="entry-content clearfix">		
					<?php the_content(); ?>		
				</div>	

				<footer class="entry-footer">

                    <?php
                        /**
                         * @hooked - ss_get_post_meta_details - 10
                         * @hooked - ss_post_share - 20 
                         * @hooked - ss_post_review - 30
                         **/
                        do_action( 'ss_post_content_end' );
                    ?>
					
					<?php edit_post_link( __( ' Edit Post', SS_DOMAIN ), '<div class="entry-footer "><i class="fa fa-edit"></i>', '</div>' ); ?>

				</footer>
			</div>

			<?php
                do_action( 'ss_after_post_content' );
            ?>

		</section>

		<?php
            do_action( 'ss_post_article_end' );
        ?>

	</article>

	<section class="article-extras">

        <?php
            /**
             * @hooked - ss_post_pagination - 5
             * @hooked - ss_post_related_articles - 10
             * @hooked - ss_post_comments - 20
             **/
            do_action( 'ss_post_after_article' );
        ?>

    </section>
<?php endwhile; ?>
</div>