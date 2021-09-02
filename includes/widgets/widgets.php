<?php
function ss_widgets_init() {
    register_sidebar(
        array(
            'name'          => __( 'Post Left Sidebar', SS_DOMAIN ),
            'id'            => 'sidebar-left',
            'description'   => '',
            'before_widget' => '<aside id="%1$s" class="widget %2$s primary_widgets">',
            'after_widget'  => '</aside>',
            'before_title'  => '<div class="widget_title"><span><h4>',
            'after_title'   => '</h4></span></div>',
        )
    );

    register_sidebar(
        array(
            'name'          => __( 'Post Right Sidebar', SS_DOMAIN ),
            'id'            => 'sidebar-right',
            'description'   => '',
            'before_widget' => '<aside id="%1$s" class="widget %2$s primary_widgets">',
            'after_widget'  => '</aside>',
            'before_title'  => '<div class="widget_title"><span><h4>',
            'after_title'   => '</h4></span></div>',
        )
    );

    register_sidebar(
        array(
            'name'          => __( 'Page Left Sidebar', SS_DOMAIN ),
            'id'            => 'page-sidebar-left',
            'description'   => '',
            'before_widget' => '<aside id="%1$s" class="widget %2$s primary_widgets">',
            'after_widget'  => '</aside>',
            'before_title'  => '<div class="widget_title"><span><h4>',
            'after_title'   => '</h4></span></div>',
        )
    );

    register_sidebar(
        array(
            'name'          => __( 'Page Right Sidebar', SS_DOMAIN ),
            'id'            => 'page-sidebar-right',
            'description'   => '',
            'before_widget' => '<aside id="%1$s" class="widget %2$s primary_widgets">',
            'after_widget'  => '</aside>',
            'before_title'  => '<div class="widget_title"><span><h4>',
            'after_title'   => '</h4></span></div>',
        )
    );

    register_sidebar(
        array(
            'name'          => __( 'Footer 1', SS_DOMAIN ),
            'id'            => 'footer-1',
            'description'   => '',
            'before_widget' => '<aside id="%1$s" class="widget %2$s footer_widgets">',
            'after_widget'  => '</aside>',
            'before_title'  => '<div class="widget_title"><span><h4>',
            'after_title'   => '</h4></span></div>',
        )
    );

    register_sidebar(
        array(
            'name'          => __( 'Footer 2', SS_DOMAIN ),
            'id'            => 'footer-2',
            'description'   => '',
            'before_widget' => '<aside id="%1$s" class="widget %2$s footer_widgets">',
            'after_widget'  => '</aside>',
            'before_title'  => '<div class="widget_title"><span><h4>',
            'after_title'   => '</h4></span></div>',
        )
    );

    register_sidebar(
        array(
            'name'          => __( 'Footer 3', SS_DOMAIN ),
            'id'            => 'footer-3',
            'description'   => '',
            'before_widget' => '<aside id="%1$s" class="widget %2$s footer_widgets">',
            'after_widget'  => '</aside>',
            'before_title'  => '<div class="widget_title"><span><h4>',
            'after_title'   => '</h4></span></div>',
        )
    );    

    register_sidebar(
        array(
            'name'          => __( 'Footer 4', SS_DOMAIN ),
            'id'            => 'footer-4',
            'description'   => '',
            'before_widget' => '<aside id="%1$s" class="widget %2$s footer_widgets">',
            'after_widget'  => '</aside>',
            'before_title'  => '<div class="widget_title"><span><h4>',
            'after_title'   => '</h4></span></div>',
        )
    );    

    register_sidebar(
        array(
            'name'          => __( 'Sidebar Shop', SS_DOMAIN ),
            'id'            => 'sidebar-shop',
            'description'   => '',
            'before_widget' => '<aside id="%1$s" class="widget %2$s sidebar_shop_widgets">',
            'after_widget'  => '</aside>',
            'before_title'  => '<div class="widget_title"><span><h4>',
            'after_title'   => '</h4></span></div>',
        )
    );

}
add_action( 'widgets_init', 'ss_widgets_init' );

function ss_widget_content_wrap($content) {
    $content = '<div class="widget-content">'.$content.'</div>';
    return $content;
}
//add_filter('widget_text', 'ss_widget_content_wrap');