<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ss_facebook_page_widget extends WP_Widget {
	
	/**
	 * Register widget with WordPress.
	 *
	 * @since 3.2.0
	 */
	public function __construct() {
		parent::__construct(
			'ss_facebook_page_widget', esc_html__( 'Artooz Facebook Page', AR_DOMAIN )
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 * @since 3.2.0
	 *
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {

		// Set vars for widget usage
		$title        = isset( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'] ) : '';
		$facebook_url = isset( $instance['facebook_url'] ) ? $instance['facebook_url'] : '';
		$language     = ! empty( $instance['language'] ) ? $instance['language'] : 'en_US';

		// Before widget WP hook
		echo $args['before_widget'];

		// Display title if defined
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		} ?>

		<?php
		// Show nothing in customizer to keep it fast
		if ( function_exists( 'is_customize_preview' ) && is_customize_preview() ) :

			esc_html_e( 'Facebook widget does not display in the Customizer because it can slow things down.', AR_DOMAIN );

		elseif ( $facebook_url ) : ?>

			<div class="fb-page" data-href="<?php echo esc_url( $facebook_url ); ?>" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"></div>

			<div id="fb-root"></div>
			<script>(function(d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) return;
				js = d.createElement(s); js.id = id;
				js.async=true; js.src = "//connect.facebook.net/<?php echo esc_html( $language ); ?>/sdk.js#xfbml=1&version=v2.5&appId=944726105603358";
				fjs.parentNode.insertBefore(js, fjs);
			} ( document, 'script', 'facebook-jssdk' ) );</script>

		<?php endif; ?>

		<?php
		// After widget WP hook
		echo $args['after_widget']; ?>
		
	<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 * @since 3.2.0
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance                 = $old_instance;
		$instance['title']        = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['facebook_url'] = ( ! empty( $new_instance['facebook_url'] ) ) ? esc_url( $new_instance['facebook_url'] ) : '';
		$instance['language']     = ( ! empty( $new_instance['language'] ) ) ? strip_tags( $new_instance['language'] ) : 'en_US';
		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 * @since 3.2.0
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {

		extract( wp_parse_args( ( array ) $instance, array(
			'title'        => esc_html__( 'Find Us On Facebook', AR_DOMAIN ),
			'facebook_url' => '',
			'language'     => 'en_US',
		) ) ); ?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', AR_DOMAIN ); ?></label>
			<input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'facebook_url' ) ); ?>"><?php esc_html_e( 'Facebook Page URL', AR_DOMAIN ); ?></label>
			<input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'facebook_url' ) ); ?>" type="text" value="<?php echo esc_attr( $facebook_url ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'language' ) ); ?>"><?php esc_html_e( 'Language Locale', AR_DOMAIN ); ?></label>
			<input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'language' ) ); ?>" type="text" value="<?php echo esc_attr( $language ); ?>" />
		</p>
		
	<?php
	}
}
register_widget( 'ss_facebook_page_widget' );