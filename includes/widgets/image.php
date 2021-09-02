<?php

class AS_Widget_Image extends WP_Widget {
	/**
	 * Setup widget options.
	 *
	 * Allows child classes to override the defaults.
	 *
	 * @see WP_Widget::construct()
	 */
	function __construct( $id_base = false, $name = false, $widget_options = array(), $control_options = array() ) {
		$id_base = ( $id_base ) ? $id_base : 'blazersix-widget-image';
		$name = ( $name ) ? $name : __( 'SS Image', 'blazersix-widget-image-i18n' );
		
		$widget_options = wp_parse_args( $widget_options, array(
			'classname'   => 'widget_image',
			'description' => __( 'An image from the media library', 'blazersix-widget-image-i18n' )
		) );
		
		$control_options = wp_parse_args( $control_options, array( 'width' => 278 ) );

		//load js for admin
		add_action( 'sidebar_admin_setup', array( $this, 'admin_setup' ) );
		

		parent::__construct( $id_base, $name, $widget_options, $control_options );


	}
	
	// Function to upload
	function admin_setup(){

		wp_enqueue_media();
		wp_register_script('tpw-admin-js', TEMPLATEURL .'/js/upload-img/tpw_admin.js', array( 'jquery', 'media-upload', 'media-views' ) );
		wp_enqueue_script('tpw-admin-js');

	}
	/**
	 * Default widget front end display method.
	 * 
	 */

	public function widget( $args, $instance ) {
		// Return cached widget if it exists.
		// Filter and sanitize instance data

		extract($args);

		$title = apply_filters( 'widget_title', $instance['title'] );
	    // before and after widget arguments are defined by themes
	    echo $args['before_widget'];
	    if ( ! empty( $title ) )
	    echo $args['before_title'] . $title . $args['after_title'];


		$image = $instance['img_url'];
		$link_to_web = $instance['link_to_web'];
		$img_title = $instance['img_title'];

		if($link_to_web != '')
		{
			?>
				<a href="<?php echo esc_url( $link_to_web );?>" target="_blank">
					<img src='<?php echo esc_url($image); ?>' title="<?php echo esc_attr( $img_title ); ?>" alt="<?php echo esc_attr( $img_title ); ?>" />
				</a>
			<?php
		}
		else{
			?>			
			<img src='<?php echo esc_url($image); ?>' title="<?php echo esc_attr( $img_title );?>" alt="<?php echo esc_attr( $img_title ); ?>" />
			<?php
		}
		

	    echo $args['after_widget'];
	}
	
	/**
	* 3. Show widget in admin dashboard
	*/
	public function form( $instance ) {

		$title = isset( $instance['title'] ) ? $instance['title'] : 'Default Title';
	    $img_url = isset( $instance['img_url'] ) ? $instance['img_url'] : '';
	    $img_title = isset( $instance['img_title'] ) ? $instance['img_title'] : '';
	    $link_to_web = isset( $instance['link_to_web'] ) ? $instance['link_to_web'] : '';


	    // widget admin form
	    ?>
	    <p class="widget-upload-wrap">

	      <div class="widget_input">
				<button id="title_image_button" class="button" onclick="image_button_click('Choose Title Image','Select Image','image','title_image_preview_new','<?php echo esc_attr( $this->get_field_id( 'img_url' ) );  ?>',this,event);">Select Image</button>			
			</div>

				<div class="title_image_preview_new" id="title_image_preview_new" name="title_image_preview" >
					<?php 
						if($img_url != ''){
							echo '<img src="'. esc_url( $img_url ) .'" style="width:100%;margin-top:15px">';
						}
					?>
				</div>

	    </p>
	    <p>
	      <label for="<?php echo esc_attr( $this->get_field_id( 'img_url' ) ); ?>"><?php _e( 'Image url:', AS_DOMAIN ) ?></label>
	      <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'img_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'img_url' ) ); ?>" value="<?php echo esc_attr( $img_url ); ?>">
	    </p>
	    <p>
	      <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', AS_DOMAIN ) ?></label>
	      <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>">
	    </p>
	    
	    
	    <p>
	      <label for="<?php echo esc_attr( $this->get_field_id( 'img_title' ) ); ?>"><?php _e( 'Image title:', AS_DOMAIN ) ?></label>
	      <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'img_title' ) ?>" name="<?php echo esc_attr( $this->get_field_name( 'img_title' ) ); ?>" value="<?php echo esc_attr( $img_title ); ?>">
	    </p>
	    <p>
	      <label for="<?php echo esc_attr( $this->get_field_id( 'link_to_web' ) ); ?>"><?php _e( 'Link to website:', AS_DOMAIN ) ?></label>
	      <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_to_web' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_to_web' ) ); ?>" value="<?php echo esc_attr( $link_to_web ); ?>">
	    </p>
	    <?php

	}
  	/**
	* 4. Save All Infomation
	*/
	public function update( $new_instance, $old_instance ) {
		$instance = array();
	    $instance['title'] = strip_tags($new_instance['title']);
	    $instance['img_url'] = strip_tags($new_instance['img_url']);
	    $instance['img_title'] = strip_tags($new_instance['img_title']);
	    $instance['link_to_web'] = strip_tags($new_instance['link_to_web']);
	    return $instance;
	}

}
function register_image_widget() {
	register_widget( 'AS_Widget_Image' );
}
add_action( 'widgets_init', 'register_image_widget' );