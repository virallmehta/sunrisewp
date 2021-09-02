<?php
class artooz_recent_post_carousel_widget extends WP_Widget {

    function __construct() {
        $widget_ops  = array(
            'classname'   => 'widget-recent-post-carousel',
            'description' => __('Artooz widget that shows Recent Post Carousel.', AR_DOMAIN)
        );
        parent::__construct( 'recent-post-carousel-widget', 'Artooz Recent Post Carousel Widget', $widget_ops );

        $defaults = apply_filters( 'artooz_posts_carousel_widget_default_args', array(
			'title'			=> '',
			'number'		=> 6,
		) );
		$this->defaults = $defaults;
    }

    function widget( $args, $instance ) {

        $title          = isset( $instance['title']) ? $instance['title'] : '';
        $post_number 	= isset( $instance['number']) ? $instance['number'] : 6;

        $instance = wp_parse_args( (array) $instance, $this->defaults );

        $carousel_args 	= apply_filters( 'artooz_recent_post_carousel_widget_carousel_args', array(
            'items'             => 4,
			'loop'				=> true,
			'margin'		    => 10,
			'nav'    			=> false,
            'margin'            => 15,
            'dots'              => true,
            'touchDrag'         => true,
            'autoplay'          => true,
            'autoplayTimeout'   => 2000,
            'smartSpeed'        => 1200,
            'autoplayHoverPause' => true,
		) );

        wp_reset_query();
        $query = new WP_Query( array(
        	'post_type' => 'post',
			'posts_per_page' => $post_number,
		));

        echo $before_widget; 
        ?>
        <div class="widget_title">
            <h4><?php echo $title ?></h4>
        </div>
        <div class="widget-recent-post-carousel-container">
            <div class="row">
	            <div class="widget-recent-post-carousel flexslider111">
	            	<div class="slides">
	                <?php
	                    if ( $query->have_posts() ) { 
	                        while ( $query->have_posts() ) { 
	                            $query->the_post();
	                			artooz_get_template( 'content-loop-widget-post' );
	                        }
	                    }
	                    wp_reset_query(); 
	                ?>
	                </div>
	            </div>
            </div>
        </div>
       

         <?php         
        echo $after_widget;
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        $instance['title']  = strip_tags( $new_instance['title'] );
        $instance['number'] = strip_tags( $new_instance['number'] );

        return $instance;
    }

    function form( $instance ) {

        $title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : 'Recent Post';
        $number = isset( $instance['number'] ) ? esc_attr( $instance['number'] ) : 6;

        ?>
        <p>
            <label><?php _e( 'Title', AR_DOMAIN ); ?>:</label>
            <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"
                   class="widefat" type="text"/>
        </p>

        <p>
            <label><?php _e( 'Number', AR_DOMAIN ); ?>:</label>
            <input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $instance['number']; ?>"
                   class="widefat" type="text"/>
        </p>
    <?php }

}
add_action( 'widgets_init', 'artooz_load_post_widgets' );

function artooz_load_post_widgets() {
    register_widget( 'artooz_recent_post_carousel_widget' );
}