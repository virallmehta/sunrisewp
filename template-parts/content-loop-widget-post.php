<li id="post-<?php the_ID(); ?>" <?php post_class('col-sm-3'); ?>>
	<?php if( has_post_thumbnail() ){ ?>
		<div class="post_thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php //echo ss_post_thumb('352', '297'); ?>
			</a>
		</div>
	<?php } ?>
	<div class="post_info">
		<div class="inner">
		<?php if( get_the_title() ){ ?>
			<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<?php } ?>
		
		<p><?php echo get_the_excerpt(); ?></p>
		
		
		</div>
	</div>
</li>