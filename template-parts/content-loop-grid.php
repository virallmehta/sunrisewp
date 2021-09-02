<li id="post-<?php the_ID(); ?>" <?php post_class( 'col-sm-6' ); ?>>
	<?php if( has_post_thumbnail() ){ ?>
		<div class="post_thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php echo ss_post_thumb('352', '297'); ?>
			</a>
		</div>
	<?php } ?>
	<div class="post_info">
		<?php if( get_the_title() ){ ?>
			<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<?php } ?>
		
		<p><?php echo get_the_excerpt(); ?></p>
		
		<div class="post_details">
			<div class="post_author">
				<?php $post_author = get_the_author_link(); ?>
				<span class="author">By <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo $post_author ?></a></span>
			</div>
			<div class="comment-info"><span><i class="fa fa-comment-o" aria-hidden="true"></i></span> <a href="<?php comments_link(); ?>"><?php comments_number( 0 ); ?> </a></div>
			
		</div>
	</div>
</li>