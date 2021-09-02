<?php
if (!function_exists('ss_header_wrap')) {
	function ss_header_wrap() {
		global $post, $ss_theme_options;
		$header_type = 'header-1';

		$default_social_header = $ss_theme_options['option_check_list_social_header'];
		$default_info_header = $ss_theme_options['option_info_header'];
		?>
		<div class="header-wrap">
			<div id="header-section">
				<?php if ( $default_social_header == '1' || $default_info_header == '1' ) { ?>
					<?php ss_top_bar(); ?>
				<?php } ?>
				<?php get_template_part( 'template-parts/header/' . $header_type ); ?>
			</div>
		</div>
	<?php }
	add_action('ss_container_start', 'ss_header_wrap', 20);
} ?>
<?php 

if ( !function_exists( 'ss_top_bar' ) ) {
	function ss_top_bar() {
		global $post, $ss_theme_options;
		$default_check_list_social_config = $ss_theme_options['option_check_list_social_header'];
		$default_social_header = $ss_theme_options['option_check_social_header'];
		$default_header_info_config = $ss_theme_options['option_info_header'];

		?>
		<div id="top-header-bar">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-md-6">
						<div class="top-contact-info">
							<?php if ( $default_header_info_config == '1'): ?>
	                                <ul class="top-contact-list">
		                                <li>
		                                    <i class="fa fa-mobile">&nbsp;</i>
		                                    <?php _e( nl2br( wp_kses_data( $ss_theme_options['option_phone_content_header'] ) ) ); ?>
		                                </li>
		                                <li>
		                                    <i class="fa fa-envelope">&nbsp;</i>
		                                    <?php _e( nl2br( wp_kses_data( $ss_theme_options['option_email_content_header'] ))); ?>
		                                </li>
	                                </ul>
	                    	<?php endif; ?>
	                    </div>
					</div>
					<div class="col-xs-12 col-md-6">
						<div class="header-socials">
	                        <ul class="social-nav">
	                            <?php 
	                            if( $default_check_list_social_config ) {
	                            	$header_social = $default_social_header;
	                                foreach ( $header_social as $key => $val ) {
	                                    if ( ! empty( $header_social[$key] ) && $val == 1 ) { ?>
	                                        <li><a class="social-border-style" target="_blank" href="<?php echo esc_url( $ss_theme_options[$key] ); ?>"><i class="fa fa-<?php echo esc_attr( $key ); ?>"></i></a></li>
	                                        <?php
	                                    }
	                                }
	                            }
	                            ?>
	                        </ul>
	                     </div>
					</div>
				</div>
			</div>
		</div>
	<?php
	}
}
?>