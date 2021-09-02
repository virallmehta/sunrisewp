<?php

class SS_Widget_Pages extends WP_Widget {

	public function __construct() {
		$widget_ops = array('classname' => 'widget_pages', 'description' => __( 'A list of your site&#8217;s Pages.', SS_DOMAIN) );
		parent::__construct('ss_pages', __('SS Pages', SS_DOMAIN), $widget_ops);
	}

	public function widget( $args, $instance ) {

		/**
		 * Filter the widget title.
		 *
		 * @since 2.6.0
		 *
		 * @param string $title    The widget title. Default 'Pages'.
		 * @param array  $instance An array of the widget's settings.
		 * @param mixed  $id_base  The widget ID.
		 */
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Pages', SS_DOMAIN ) : $instance['title'], $instance, $this->id_base );

		$sortby = empty( $instance['sortby'] ) ? 'menu_order' : $instance['sortby'];
		$include = empty( $instance['include'] ) ? '' : $instance['include'];

		if ( $sortby == 'menu_order' )
			$sortby = 'menu_order, post_title';

		/**
		 * Filter the arguments for the Pages widget.
		 *
		 * @since 2.8.0
		 *
		 * @see wp_list_pages()
		 *
		 * @param array $args An array of arguments to retrieve the pages list.
		 */
		$out = wp_list_pages( apply_filters( 'stm_widget_pages_args', array(
			'title_li'    => '',
			'echo'        => 0,
			'sort_column' => $sortby,
			'depth' => -1,
			'include'     => $include
		) ) );

		if ( ! empty( $out ) ) {
			echo $args['before_widget'];
			if ( $title ) {
				echo $args['before_title'] . esc_html( $title ) . $args['after_title'];
			}
			?>
			<ul>
				<?php echo $out; ?>
			</ul>
			<?php
			echo $args['after_widget'];
		}
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		if ( in_array( $new_instance['sortby'], array( 'post_title', 'menu_order', 'ID' ) ) ) {
			$instance['sortby'] = $new_instance['sortby'];
		} else {
			$instance['sortby'] = 'menu_order';
		}

		$instance['include'] = strip_tags( $new_instance['include'] );

		return $instance;
	}

	public function form( $instance ) {
		//Defaults
		$instance = wp_parse_args( (array) $instance, array( 'sortby' => 'post_title', 'title' => '', 'include' => '') );
		$title = esc_attr( $instance['title'] );
		$include = esc_attr( $instance['include'] );
		?>
		<p><label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php _e('Title:', SS_DOMAIN); ?></label> <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('sortby') ); ?>"><?php _e( 'Sort by:', SS_DOMAIN ); ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name('sortby') ); ?>" id="<?php echo esc_attr( $this->get_field_id('sortby') ); ?>" class="widefat">
				<option value="post_title"<?php selected( $instance['sortby'], 'post_title' ); ?>><?php _e('Page title', SS_DOMAIN); ?></option>
				<option value="menu_order"<?php selected( $instance['sortby'], 'menu_order' ); ?>><?php _e('Page order', SS_DOMAIN); ?></option>
				<option value="ID"<?php selected( $instance['sortby'], 'ID' ); ?>><?php _e( 'Page ID', SS_DOMAIN ); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('include') ); ?>"><?php _e( 'Include:', SS_DOMAIN ); ?></label> <input type="text" value="<?php echo esc_attr( $include ); ?>" name="<?php echo esc_attr( $this->get_field_name('include') ); ?>" id="<?php echo esc_attr( $this->get_field_id('include') ); ?>" class="widefat" />
			<br />
			<small><?php _e( 'Page IDs, separated by commas.', SS_DOMAIN ); ?></small>
		</p>
	<?php
	}

}

function register_pages_widget() {
	register_widget( 'SS_Widget_Pages' );
}
add_action( 'widgets_init', 'register_pages_widget' );