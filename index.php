<?php get_header(); ?>
<?php 
	global $ss_theme_options;
	$blog_type = $ss_theme_options['archive_display_type'];
	
	global $sf_has_blog;
	$sf_has_blog = true;
?>

<?php if ($blog_type != "masonry-fw") { ?>
<div class="container">
	<div class="row">
<?php } ?>

	<?php ss_set_layout('archive'); ?>
	
<?php if ($blog_type != "masonry-fw") { ?>
	</div>
</div>
<?php } ?>
<?php get_footer(); ?>