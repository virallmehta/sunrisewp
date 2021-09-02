<?php

if ( ! function_exists( 'ss_footer_widgets' ) ) {
    function ss_footer_widgets() {
        global $post, $ss_theme_options;

        $enable_footer         = $ss_theme_options['option_footer_widgets'];
        $footer_config         = $ss_theme_options['option_footer_layout'];
        
        if ( $enable_footer == "1" ) {
        ?>
            <footer id="footer">
                <div class="container">
                    <div id="footer-widgets" class="row clearfix">
                        <?php if ( $footer_config == "footer-1" ) { ?>
                                <div class="col-sm-3">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-1' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-3">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-2' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-3">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-3' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-3">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-4' ); ?>
                                    <?php } ?>
                                </div>

                        <?php } else if ( $footer_config == "footer-2" ) { ?>

                                <div class="col-sm-6">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-1' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-3">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-2' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-3">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-3' ); ?>
                                    <?php } ?>
                                </div>

                        <?php } else if ( $footer_config == "footer-3" ) { ?>

                                <div class="col-sm-3">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-1' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-3">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-2' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-6">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-3' ); ?>
                                    <?php } ?>
                                </div>

                        <?php } else if ( $footer_config == "footer-4" ) { ?>

                                <div class="col-sm-6">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-1' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-6">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-2' ); ?>
                                    <?php } ?>
                                </div>

                        <?php } else if ( $footer_config == "footer-5" ) { ?>

                                <div class="col-sm-4">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-1' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-4">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-2' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-4">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-3' ); ?>
                                    <?php } ?>
                                </div>

                        <?php } else if ( $footer_config == "footer-6" ) { ?>

                                <div class="col-sm-8">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-1' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-4">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-2' ); ?>
                                    <?php } ?>
                                </div>

                        <?php } else if ( $footer_config == "footer-7" ) { ?>

                                <div class="col-sm-4">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-1' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-8">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-2' ); ?>
                                    <?php } ?>
                                </div>

                        <?php } else if ( $footer_config == "footer-8" ) { ?>

                                <div class="col-sm-3">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-1' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-6">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-2' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-3">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-3' ); ?>
                                    <?php } ?>
                                </div>

                        <?php } else if ( $footer_config == "footer-9" ) { ?>

                                <div class="col-sm-2">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-1' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-2">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-2' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-2">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-3' ); ?>
                                    <?php } ?>
                                </div>
                                <div class="col-sm-6">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-4' ); ?>
                                    <?php } ?>
                                </div>

                        <?php } else { ?>

                                <div class="col-sm-12">
                                    <?php if ( function_exists( 'dynamic_sidebar' ) ) { ?>
                                        <?php dynamic_sidebar( 'footer-1' ); ?>
                                    <?php } ?>

                                </div>

                        <?php } ?>
                    </div>
                </div>
            </footer>

        <?php }
    }
    add_action( 'ss_footer_content', 'ss_footer_widgets', 10 );
} ?>

<?php 
if ( ! function_exists( 'ss_footer_bottom' ) ) {
    function ss_footer_bottom() {
        global $post, $ss_theme_options;
        ?>
        <div class="copyright-social-bar">
            <div class="container">
        <?php
        if ( $ss_theme_options['option_check_list_social_footer'] == "1"):
        ?>
            <div class="col-xs-12 col-md-7 col-md-push-5">
                 <?php ss_footer_social(); ?>                
            </div>
        <?php
        endif;
        if ( $ss_theme_options['option_check_copyright_footer'] == "1"):
        ?>  
        <div class="col-xs-12 col-md-5 col-md-pull-7">
            
            <?php ss_footer_copyright(); ?>            
        </div>
        <?php
        endif;
        ?>
            </div>
        </div>
        <?php 
    }
    add_action( 'ss_footer_content', 'ss_footer_bottom', 20 );
}
?>
<?php remove_action( 'ss_footer_content', 'ss_footer_bottom', 20 ); ?>

<?php
if ( ! function_exists( 'ss_footer_bottom_custom' ) ) {
    function ss_footer_bottom_custom() {
        global $post, $ss_theme_options;
    ?>
        <div class="copyright-social-bar">
            <div class="container">
                <div class="row no-gutters">
                    <?php ss_footer_copyright(); ?>
                </div>
            </div>
        </div>
    <?php }
    add_action( 'ss_footer_content', 'ss_footer_bottom_custom', 20 );
}
?>

<?php 
if ( ! function_exists( 'ss_footer_copyright' ) ) {
	function ss_footer_copyright() {
        global $post, $ss_theme_options;
        if ( $ss_theme_options['option_check_copyright_footer'] == true):
	?>
        <?php $copyright = $ss_theme_options['option_copyright_footer']; ?>
        <?php echo $copyright; ?>
	<?php 
        endif;
	}
} ?>

<?php 
if ( ! function_exists('ss_footer_social')) {
    function ss_footer_social() {
        global $post, $ss_theme_options;
        if ( $ss_theme_options['option_check_list_social_footer'] == true):
    ?>
        <div class="footer-socials">
            <ul class="social-nav">
                <?php
                    $footer_social =  $ss_theme_options['option_check_social_footer'];
                    foreach ( $footer_social as $key => $val ) {
                        if ( ! empty( $footer_social[$key] ) && $val == 1 ) { ?>
                            <li><a class="social-border-style" target="_blank" href="<?php echo esc_url( $ss_theme_options[$key] ); ?>"><i class="fa fa-<?php echo esc_attr( $key ); ?>"></i></a></li>
                            <?php
                        }
                    }
                ?>
            </ul>
        </div>
    <?php
        endif;
    }
} ?>

<?php 
if ( ! function_exists( 'ss_back_to_top' ) ) {
    function ss_back_to_top() {
    
    ?>
       <div id="back-to-top"><i class="fa fa-arrow-up" aria-hidden="true"></i></div>
    <?php
    }

    //add_action( 'ss_after_page_container', 'ss_back_to_top', 20 );
} ?>