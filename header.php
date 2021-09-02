<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
    <!--<![endif]-->
    <head>
        <title><?php wp_title('|', true, 'right'); ?></title>

        <?php wp_head(); ?>

    </head>

    <body <?php body_class(); ?>>

    	<?php
			do_action('ss_before_page_container');
		?>

		<!--// OPEN #container //-->
		<div id="container">

			<?php
				/**
				 * @hooked - artooz-_header_wrapp - 5
				**/
				do_action('ss_container_start');
			?>

			<!--// OPEN #main-container //-->
			<div id="main-container" class="clearfix">

				<?php
					/**
					 * @hooked - ss_page_heading - 5
					 * @hooked - ss_slider - 10
					**/
					do_action('ss_main_container_start');
				?>
    	
				