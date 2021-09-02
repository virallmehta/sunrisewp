<?php
remove_action( 'ss_main_container_start', 'ss_page_heading', 5 );
get_header(); 
?>
<div class="container">

	<?php ss_set_layout('content-single'); ?>
	
</div>
<?php get_footer(); ?>