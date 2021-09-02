<?php
    //
    //  Header Template - 1
    //
?>
<header id="header" class="clearfix">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
				<div id="mobile_menu_toggler"></div>
                <?php echo ss_logo( 'alignleft' ); ?>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
				
                <div class="hearder-extra-links right">
                    <?php //echo ss_woo_extra_links(); ?>
                    <?php //echo ss_woo_account_links(); ?>
                    <?php //echo ss_woo_cart_links(); ?>
                </div>
				<div class="primary-menu right">
                    <?php
                        $menu_output = '';
                        if ( function_exists( 'wp_nav_menu' ) ) {
                			if ( has_nav_menu( 'primary_menu' ) ) {
                    			$menu_output .= wp_nav_menu( array(
	                                'theme_location'    => 'primary_menu',
	                                'container'         => 'div',
	                                'container_id'      => 'main-menubar',
	                                'container_class'   => 'primary-menubar',
	                                'menu_id'			=> 'main-menu'
                            	));
                			} else {
                    			$menu_output .= '<div class="no-menu">' . __( "Please assign a menu to the Main Menu in Appearance > Menus", SS_DOMAIN ) . '</div>';
                			}
            			}
            			echo $menu_output;
                    ?>
                </div>
                <div id="mobile_menu">  
                    <?php wp_nav_menu( array(
                            'theme_location'=> 'primary_menu',
                            'container'     => '',
                        ));
                    ?>
                </div>
                
			</div>
		</div>
	</div>
</header>