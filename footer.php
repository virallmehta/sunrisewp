				<?php
					do_action('ss_main_container_end');

				?>
			</div><!-- /main-container -->
			<div id="footer-wrap">
				
				<?php
					/**
					 * @hooked - ss_footer_widgets - 10
					 * @hooked - ss_footer_bottom - 20
					**/

					do_action('ss_footer_content');
				?>
			</div>
			<?php
			/**
			 * @hooked - ss_back_to_top - 20
			**/
			do_action('ss_after_page_container');
		?>
		<?php wp_footer(); ?>
	</body>
</html>
