<?php
$template_directory = get_template_directory_uri();
$args = array();

$theme = wp_get_theme(); // For use with some settings. Not necessary.

// For use with a tab example below
$tabs = array();

$args['dev_mode'] = false;
$args['opt_name'] = 'ss_theme_options';
$args['display_name'] = __('Sunrise Theme Options', SS_DOMAIN);
$args['display_version'] = false;
$args['menu_type'] = 'menu';
$args['allow_sub_menu'] = true;
$args['menu_title'] = __('Sunrise Theme Options', SS_DOMAIN);
$args['page_title'] = __('Sunrise Theme Options', SS_DOMAIN);
// If you want to use Google Webfonts, you MUST define the api key.
//$args['google_api_key'] = 'AIzaSyANTG_0ZzMEVSNOTw5VfrDk4RfOgaL9L3s';
$args['google_api_key'] = 'AIzaSyANTG_0ZzMEVSNOTw5VfrDk4RfOgaL9L3s';
$args['google_update_weekly'] = false;
$args['dev_mode'] = false;
$args['customizer'] = false;
$args['page_priority'] = '';
$args['page_permissions'] = 'manage_options';
$args['last_tab'] = '0';
$args['admin_stylesheet'] = 'standard';

$args['show_import_export'] = true;
// $args['import_icon'] = 'refresh';
// $args['import_icon_class'] = 'el-icon-large';

$args['save_defaults'] = true;
$args['page_slug'] = '_ss_options';
$args['default_show'] = false;
$args['default_mark'] = '';
$args['page_parent'] = 'themes.php';
$args['transient_time'] = 60 * MINUTE_IN_SECONDS;
$args['output'] = true;
$args['output_tag'] = true;
$args['database'] = '';

$args['page_icon'] = 'icon-themes';

$args['footer_text'] = "";
$args['footer_credit'] = "";
$args['system_info'] = false; // REMOVE
$args['help_tabs'] = array();
$args['help_sidebar'] = ''; // __( '', $this->args['domain'] );

// Declare sections array
$sections = array();

// Main Setting -------------------------------------------------------------------------- >
$sections[] = array(
    'title'      => __('General Setting', SS_DOMAIN),
    'header'     => __('Welcome to Sunrise Theme Options.', SS_DOMAIN),
    'desc'       => __('Welcome to Sunrise Theme Options.', SS_DOMAIN),
    'icon_class' => 'el-icon-large',
    'icon'       => 'el-icon-cog',
    'submenu'    => true,
    'fields'     => array(
        array(
            'id' => 'site_width_format',
            'type' => 'button_set',
            'title' => __('Site Max-Width px/%', SS_DOMAIN),
            'subtitle' => __('Set the max-width format.', SS_DOMAIN),
            'desc' => '',
            'options' => array('px' => 'px','percent' => '%'),
            'default' => 'px'
        ),
        array(
            'id' => 'site_maxwidth',
            'type' => 'slider',
            'title' => __('Site Max-Width', SS_DOMAIN),
            'subtitle' => __("Set the maximum width for the site, at it's largest. By default this is 1170px.", SS_DOMAIN),
            "default" => "1170",
            "min" => "940",
            "step" => "10",
            "max" => "2000",
        ),
        array(
            'id' => 'page_layout',
            'type' => 'image_select',
            'title' => __('Page Layout', SS_DOMAIN),
            'subtitle' => __('Select the page layout type', SS_DOMAIN),
            'desc' => '',
            'options' => array(
                'boxed' => array('title' => 'Boxed', 'img' => $template_directory.'/images/page-bordered.png'),
                'fullwidth' => array('title' => 'Full Width', 'img' => $template_directory.'/images/page-fullwidth.png')
                    ),
            'default' => 'fullwidth'
        ),
        array(
            'id'       => 'breadcrumb_in_heading',
            'type'     => 'button_set',
            'title'    => __( 'Show Breadcrumbs in Page Heading', SS_DOMAIN),
            'subtitle' => __( 'If you enable this option, then breadcrumbs will show in the page heading, rather than on their own bar.', SS_DOMAIN),
            'desc'     => '',
            'options'  => array( '1' => 'On', '0' => 'Off' ),
            'default'  => '1'
        ),
        // array(
        //     'id' => 'google_analytics',
        //     'type' => 'textarea',
        //     'title' => __('Tracking code', 'uplift'),
        //     'subtitle' => __('Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme. NOTE: Please include the script tag.', SS_DOMAIN),
        //     'desc' => '',
        //     'default' => ''
        // ),
        array(
            'id'        => 'option_scroll_to_top',
            'type'      => 'switch',
            'title'     => __('Back to Top Button', SS_DOMAIN),
            'subtitle'  => __('Enable this option to make on/off Back to Top Button.', SS_DOMAIN),
            "default"   => '1',
            'on'        => __('On', SS_DOMAIN ),
            'off'       => __('Off', SS_DOMAIN ),
        ),
        array(
            'id'        => 'custom_css',
            'type'      => 'ace_editor',
            'title'     => __('CSS Code', SS_DOMAIN),
            'subtitle'  => __('Paste your CSS code here.<br>( If you are not a developer, please skip this option! )', SS_DOMAIN),
            'mode'      => 'css',
            'theme'     => 'monokai',
            'desc'      => '',
            'default'   => '',
            'options'   => array('minLines'=> 20, 'maxLines' => 60),

        ),
        array(
            'id' => 'custom_js',
            'type' => 'ace_editor',
            'mode' => 'javascript',
            'theme' => 'chrome',
            'title' => __('Custom JS', SS_DOMAIN),
            'subtitle' => __('Add some custom JavaScript to your theme by adding it to this textarea. Please do not include any script tags.', SS_DOMAIN),
            'desc' => '',
            'default' => '',
            'options'  => array('minLines'=> 20, 'maxLines' => 60)
        ),
    ),
);

$sections[] = array(
    'title' => __('Meta Options', SS_DOMAIN),
    'desc' => '',
    'subsection' => true,
    'icon' => 'el-icon-puzzle',
    // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
    'fields' => array(
        array(
            'id' => 'disable_social_meta',
            'type' => 'button_set',
            'title' => __('Disable Social Meta Tags', SS_DOMAIN),
            'subtitle' => __('Disable the social meta head tag output.', SS_DOMAIN),
            'desc' => '',
            'options' => array('1' => 'On','0' => 'Off'),
            'default' => '0'
            ),
        array(
            'id' => 'twitter_author_username',
            'type' => 'text',
            'title' => __('Twitter Publisher Username', SS_DOMAIN),
            'subtitle' => "Enter your twitter username here, to be used for the Twitter Card date. Ensure that you do not include the @ symbol.",
            'desc' => '',
            'default' => ""
            ),
        array(
            'id' => 'googleplus_author',
            'type' => 'text',
            'title' => __('Google+ Username', SS_DOMAIN),
            'subtitle' => "Enter your Google+ username here, to be used for the authorship meta.",
            'desc' => '',
            'default' => ""
            ),
    ),
);

// Logo -------------------------------------------------------------------------- >
$sections[] = array(
    'icon'          => 'el-icon-star-alt',
    'icon_class'    => 'el-icon-large',
    'title'         => __('Logo & Favicon Setting', SS_DOMAIN),
    'submenu'       => true,
    'fields'        => array(
        array(
            'id'        => 'option_favicon',
            'url'       => true,
            'type'      => 'media',
            'title'     => __('Your Favicon', SS_DOMAIN),
            'default'   => array( 'url' => get_template_directory_uri() .'/images/favicon.png' ),
            'subtitle'  => __('Upload a 16 x 16 pixel .png/.gif/.ico image that will represent your favicon.', SS_DOMAIN),
        ),
        array(
            'id'        => 'option_custom_logo',
            'url'       => true,
            'type'      => 'media',
            'title'     => __('Logo', SS_DOMAIN),
            'default'   => array( 'url' => get_template_directory_uri() .'/images/logo.png' ),
            'subtitle'  => __('Upload your custom site logo.', SS_DOMAIN),
        ),
        array(
            'id'             => 'logo_margin',
            'type'           => 'spacing',
            'output'         => array('.logo'),
            'mode'           => 'margin',
            'units'          => array('px'),
            'units_extended' => 'false',
            'title'          => __('Logo Margin', SS_DOMAIN),
            'subtitle'       => '',
            'desc'           => __('Set your logo margin in px. Just use the number', SS_DOMAIN),
            'default'        => array(
                'units'          => 'px',
            )
        ),
        array(
            'id'      => 'logo_dimensions',
            'type'    => 'dimensions',
            'title'   => __( 'Logo Dimensions (px)', SS_DOMAIN),
            'output'  => array( '.logo img' ),
            'units'   => 'px',
            'default'  => array(
                'width'   => '340',
                'height'  => '116'
            ),
        ),
    )
);

// Background -------------------------------------------------------------------------- >
$sections[] = array(
    'title' => __('Background Options', SS_DOMAIN),
    'desc' => '',
    'icon' => 'el-icon-picture',
    // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
    'fields' => array(
        array(
            'id' => 'use_bg_image',
            'type' => 'button_set',
            'title' => __('Use Background Image', SS_DOMAIN),
            'subtitle' => __('Check this to use an image for the body background (boxed layout only).', SS_DOMAIN),
            'desc' => '',
            'options' => array('1' => 'On','0' => 'Off'),
            'default' => '0'
            ),
        array(
            'id' => 'custom_bg_image',
            'type' => 'media',
            'url'=> true,
            'required'  => array('use_bg_image', '=', '1'),
            'title' => __('Upload Background Image', SS_DOMAIN),
            'subtitle' => __('Either upload or provide a link to your own background here, or choose from the presets below.', SS_DOMAIN),
            'desc' => ''
            ),
        array(
            'id' => 'bg_size',
            'type' => 'button_set',
            'required'  => array('use_bg_image', '=', '1'),
            'title' => __('Background Size', SS_DOMAIN),
            'subtitle' => __('If you are using an image rather than a pattern, select cover to make the image cover the background.', SS_DOMAIN),
            'desc' => '',
            'options' => array('cover' => 'Cover','auto' => 'Auto'),
            'default' => 'auto'
            ),
        )
    );

// Typography -------------------------------------------------------------------------- >
$sections[] = array(
    'title'         => __('Typography Setting', SS_DOMAIN),
    'header'        => '',
    'desc'          => '',
    'icon_class'    => 'el-icon-large',
    'icon'          => 'el-icon-font',
    'submenu'       => true,
    'fields'        => array(

        array(
            'id'            => 'option_body_font',
            'type'          => 'typography',
            'title'         => __('Body Font', SS_DOMAIN),
            'compiler'      => false,
            'fonts'         => array ( 
                'ralewayregular'                                       => 'ralewayregular',
                "Arial, Helvetica, sans-serif"                         => "Arial, Helvetica, sans-serif",
                "'Arial Black', Gadget, sans-serif"                    => "'Arial Black', Gadget, sans-serif",
                "'Bookman Old Style', serif"                           => "'Bookman Old Style', serif",
                "'Comic Sans MS', cursive"                             => "'Comic Sans MS', cursive",
                "Courier, monospace"                                   => "Courier, monospace",
                "Garamond, serif"                                      => "Garamond, serif",
                "Georgia, serif"                                       => "Georgia, serif",
                "Impact, Charcoal, sans-serif"                         => "Impact, Charcoal, sans-serif",
                "'Lucida Console', Monaco, monospace"                  => "'Lucida Console', Monaco, monospace",
                "'Lucida Sans Unicode', 'Lucida Grande', sans-serif"   => "'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
                "'MS Sans Serif', Geneva, sans-serif"                  => "'MS Sans Serif', Geneva, sans-serif",
                "'MS Serif', 'New York', sans-serif"                   => "'MS Serif', 'New York', sans-serif",
                "'Palatino Linotype', 'Book Antiqua', Palatino, serif" => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
                "Tahoma,Geneva, sans-serif"                            => "Tahoma, Geneva, sans-serif",
                "'Times New Roman', Times,serif"                       => "'Times New Roman', Times, serif",
                "'Trebuchet MS', Helvetica, sans-serif"                => "'Trebuchet MS', Helvetica, sans-serif",
                "Verdana, Geneva, sans-serif"                          => "Verdana, Geneva, sans-serif",
            ),
            'google'        => true,
            'font-backup'   => true,
            'font-style'    => true,
            'subsets'       => true,
            'font-size'     => true,
            'line-height'   => true,
            'word-spacing'  => false,
            'letter-spacing'=> true,
            'text-align'    => false,
            'text-transform'  => true,
            'all_styles'    => true, // Enable all Google Font style/weight variations to be added to the page
            'color'         => false,
            'preview'       => true,
            'output'        => array('body'),
            'units'         => 'px',
            'subtitle'      => __('Select your custom font options for your main body font.', SS_DOMAIN),
            'default'       => array(
                // 'color'         => '#4d4d4d',
                'font-family'   => 'ralewayregular',
                'font-size'     => '14px',
                'font-weight'   => '400',
                'line-height'   => '22px',
            )
        ),
        array(
            'id'            => 'option_form_font',
            'type'          => 'typography',
            'title'         => __('Form Font', SS_DOMAIN),
            'compiler'      => false,
            'fonts'         => array ( 
                'ralewayregular'                                       => 'ralewayregular',
                "Arial, Helvetica, sans-serif"                         => "Arial, Helvetica, sans-serif",
                "'Arial Black', Gadget, sans-serif"                    => "'Arial Black', Gadget, sans-serif",
                "'Bookman Old Style', serif"                           => "'Bookman Old Style', serif",
                "'Comic Sans MS', cursive"                             => "'Comic Sans MS', cursive",
                "Courier, monospace"                                   => "Courier, monospace",
                "Garamond, serif"                                      => "Garamond, serif",
                "Georgia, serif"                                       => "Georgia, serif",
                "Impact, Charcoal, sans-serif"                         => "Impact, Charcoal, sans-serif",
                "'Lucida Console', Monaco, monospace"                  => "'Lucida Console', Monaco, monospace",
                "'Lucida Sans Unicode', 'Lucida Grande', sans-serif"   => "'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
                "'MS Sans Serif', Geneva, sans-serif"                  => "'MS Sans Serif', Geneva, sans-serif",
                "'MS Serif', 'New York', sans-serif"                   => "'MS Serif', 'New York', sans-serif",
                "'Palatino Linotype', 'Book Antiqua', Palatino, serif" => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
                "Tahoma,Geneva, sans-serif"                            => "Tahoma, Geneva, sans-serif",
                "'Times New Roman', Times,serif"                       => "'Times New Roman', Times, serif",
                "'Trebuchet MS', Helvetica, sans-serif"                => "'Trebuchet MS', Helvetica, sans-serif",
                "Verdana, Geneva, sans-serif"                          => "Verdana, Geneva, sans-serif",
            ),
            'google'        => true,
            'font-backup'   => true,
            'font-style'    => true,
            'subsets'       => true,
            'font-size'     => true,
            'line-height'   => true,
            'word-spacing'  => false,
            'letter-spacing'=> true,
            'text-align'    => false,
            'color'         => false,
            'preview'       => true,
            'output'        => array('input[type="text"], input[type="email"], input[type="url"], input[type="password"], input[type="search"], textarea'),
            'units'         => 'px',
            'subtitle'      => __('Select your custom font options for your form ( textform, password form, textarea...).', SS_DOMAIN),
            'default'       => array(
                //'color'         => '#797979',
                'font-family'   => 'ralewayregular',
                'font-size'     => '14px',
                'font-weight'   => '400',
            )
        ),
        array(
            'id'            => 'option_menu_font',
            'type'          => 'typography',
            'title'         => __('Menu Font', SS_DOMAIN),
            'compiler'      => false,
            'fonts'         => array ( 
                'ralewayregular'                                       => 'ralewayregular',
                "Arial, Helvetica, sans-serif"                         => "Arial, Helvetica, sans-serif",
                "'Arial Black', Gadget, sans-serif"                    => "'Arial Black', Gadget, sans-serif",
                "'Bookman Old Style', serif"                           => "'Bookman Old Style', serif",
                "'Comic Sans MS', cursive"                             => "'Comic Sans MS', cursive",
                "Courier, monospace"                                   => "Courier, monospace",
                "Garamond, serif"                                      => "Garamond, serif",
                "Georgia, serif"                                       => "Georgia, serif",
                "Impact, Charcoal, sans-serif"                         => "Impact, Charcoal, sans-serif",
                "'Lucida Console', Monaco, monospace"                  => "'Lucida Console', Monaco, monospace",
                "'Lucida Sans Unicode', 'Lucida Grande', sans-serif"   => "'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
                "'MS Sans Serif', Geneva, sans-serif"                  => "'MS Sans Serif', Geneva, sans-serif",
                "'MS Serif', 'New York', sans-serif"                   => "'MS Serif', 'New York', sans-serif",
                "'Palatino Linotype', 'Book Antiqua', Palatino, serif" => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
                "Tahoma,Geneva, sans-serif"                            => "Tahoma, Geneva, sans-serif",
                "'Times New Roman', Times,serif"                       => "'Times New Roman', Times, serif",
                "'Trebuchet MS', Helvetica, sans-serif"                => "'Trebuchet MS', Helvetica, sans-serif",
                "Verdana, Geneva, sans-serif"                          => "Verdana, Geneva, sans-serif",
            ),
            'google'        => true,
            'font-backup'   => true,
            'font-style'    => true,
            'subsets'       => true,
            'font-size'     => true,
            'line-height'   => true,
            'word-spacing'  => true,
            'text-align'    => false,
            'letter-spacing'=> true,
            'color'         => false,
            'preview'       => true,
            'output'        => array('#main-menubar ul li a'),
            'units'         => 'px',
            'subtitle'      => __('Select your custom font options for your main navigation menu.', SS_DOMAIN),
            'default'       => array(
                //'color'         => '#2c3e50',
                'font-family'   => 'ralewayregular',
                'font-size'     => '14px',
                'font-weight'   => '700',
            )
        ),

        array(
            'id'             => 'h1_params',
            'type'           => 'typography',
            'title'          => __( 'H1', SS_DOMAIN ),
            'compiler'       => true,
            'google'         => true,
             'fonts'         => array ( 
                'ralewayregular'                                       => 'ralewayregular',
                "Arial, Helvetica, sans-serif"                         => "Arial, Helvetica, sans-serif",
                "'Arial Black', Gadget, sans-serif"                    => "'Arial Black', Gadget, sans-serif",
                "'Bookman Old Style', serif"                           => "'Bookman Old Style', serif",
                "'Comic Sans MS', cursive"                             => "'Comic Sans MS', cursive",
                "Courier, monospace"                                   => "Courier, monospace",
                "Garamond, serif"                                      => "Garamond, serif",
                "Georgia, serif"                                       => "Georgia, serif",
                "Impact, Charcoal, sans-serif"                         => "Impact, Charcoal, sans-serif",
                "'Lucida Console', Monaco, monospace"                  => "'Lucida Console', Monaco, monospace",
                "'Lucida Sans Unicode', 'Lucida Grande', sans-serif"   => "'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
                "'MS Sans Serif', Geneva, sans-serif"                  => "'MS Sans Serif', Geneva, sans-serif",
                "'MS Serif', 'New York', sans-serif"                   => "'MS Serif', 'New York', sans-serif",
                "'Palatino Linotype', 'Book Antiqua', Palatino, serif" => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
                "Tahoma,Geneva, sans-serif"                            => "Tahoma, Geneva, sans-serif",
                "'Times New Roman', Times,serif"                       => "'Times New Roman', Times, serif",
                "'Trebuchet MS', Helvetica, sans-serif"                => "'Trebuchet MS', Helvetica, sans-serif",
                "Verdana, Geneva, sans-serif"                          => "Verdana, Geneva, sans-serif",
            ),
            'font-backup'    => false,
            'all_styles'     => true,
            'font-weight'    => true,
            'font-family'    => true,
            'text-align'     => false,
            'font-style'     => true,
            'subsets'        => false,
            'font-size'      => true,
            'line-height'    => true,
            'word-spacing'   => false,
            'letter-spacing' => true,
            'color'          => false,
            'preview'        => true,
            'output'         => array( 'h1' ),
            'units'          => 'px',
            'default'        => array(
                'font-size'     => '36px',
                'font-weight'   => '400',
            )
        ),
        array(
            'id'             => 'h2_params',
            'type'           => 'typography',
            'title'          => __( 'H2', SS_DOMAIN ),
            'compiler'       => true,
            'google'         => true,
             'fonts'         => array ( 
                'ralewayregular'                                       => 'ralewayregular',
                "Arial, Helvetica, sans-serif"                         => "Arial, Helvetica, sans-serif",
                "'Arial Black', Gadget, sans-serif"                    => "'Arial Black', Gadget, sans-serif",
                "'Bookman Old Style', serif"                           => "'Bookman Old Style', serif",
                "'Comic Sans MS', cursive"                             => "'Comic Sans MS', cursive",
                "Courier, monospace"                                   => "Courier, monospace",
                "Garamond, serif"                                      => "Garamond, serif",
                "Georgia, serif"                                       => "Georgia, serif",
                "Impact, Charcoal, sans-serif"                         => "Impact, Charcoal, sans-serif",
                "'Lucida Console', Monaco, monospace"                  => "'Lucida Console', Monaco, monospace",
                "'Lucida Sans Unicode', 'Lucida Grande', sans-serif"   => "'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
                "'MS Sans Serif', Geneva, sans-serif"                  => "'MS Sans Serif', Geneva, sans-serif",
                "'MS Serif', 'New York', sans-serif"                   => "'MS Serif', 'New York', sans-serif",
                "'Palatino Linotype', 'Book Antiqua', Palatino, serif" => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
                "Tahoma,Geneva, sans-serif"                            => "Tahoma, Geneva, sans-serif",
                "'Times New Roman', Times,serif"                       => "'Times New Roman', Times, serif",
                "'Trebuchet MS', Helvetica, sans-serif"                => "'Trebuchet MS', Helvetica, sans-serif",
                "Verdana, Geneva, sans-serif"                          => "Verdana, Geneva, sans-serif",
            ),
            'font-backup'    => false,
            'all_styles'     => true,
            'font-weight'    => true,
            'font-family'    => true,
            'text-align'     => false,
            'font-style'     => true,
            'subsets'        => true,
            'font-size'      => true,
            'line-height'    => false,
            'word-spacing'   => false,
            'letter-spacing' => false,
            'color'          => true,
            'preview'        => true,
            'output'         => array( 'h2' ),
            'units'          => 'px',
            'default'        => array(
                'font-size' => '30px',
                'font-weight' => '400',
            )
        ),
        array(
            'id'             => 'h3_params',
            'type'           => 'typography',
            'title'          => __( 'H3', SS_DOMAIN ),
            'compiler'       => true,
            'google'         => true,
             'fonts'         => array ( 
                'ralewayregular'                                       => 'ralewayregular',
                "Arial, Helvetica, sans-serif"                         => "Arial, Helvetica, sans-serif",
                "'Arial Black', Gadget, sans-serif"                    => "'Arial Black', Gadget, sans-serif",
                "'Bookman Old Style', serif"                           => "'Bookman Old Style', serif",
                "'Comic Sans MS', cursive"                             => "'Comic Sans MS', cursive",
                "Courier, monospace"                                   => "Courier, monospace",
                "Garamond, serif"                                      => "Garamond, serif",
                "Georgia, serif"                                       => "Georgia, serif",
                "Impact, Charcoal, sans-serif"                         => "Impact, Charcoal, sans-serif",
                "'Lucida Console', Monaco, monospace"                  => "'Lucida Console', Monaco, monospace",
                "'Lucida Sans Unicode', 'Lucida Grande', sans-serif"   => "'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
                "'MS Sans Serif', Geneva, sans-serif"                  => "'MS Sans Serif', Geneva, sans-serif",
                "'MS Serif', 'New York', sans-serif"                   => "'MS Serif', 'New York', sans-serif",
                "'Palatino Linotype', 'Book Antiqua', Palatino, serif" => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
                "Tahoma,Geneva, sans-serif"                            => "Tahoma, Geneva, sans-serif",
                "'Times New Roman', Times,serif"                       => "'Times New Roman', Times, serif",
                "'Trebuchet MS', Helvetica, sans-serif"                => "'Trebuchet MS', Helvetica, sans-serif",
                "Verdana, Geneva, sans-serif"                          => "Verdana, Geneva, sans-serif",
            ),
            'font-backup'    => false,
            'all_styles'     => true,
            'font-weight'    => true,
            'font-family'    => true,
            'text-align'     => false,
            'font-style'     => true,
            'subsets'        => true,
            'font-size'      => true,
            'line-height'    => false,
            'word-spacing'   => false,
            'letter-spacing' => false,
            'color'          => true,
            'preview'        => true,
            'output'         => array( 'h3' ),
            'units'          => 'px',
            'default'        => array(
                'font-size' => '24px',
                'font-weight' => '400',
            )
        ),
        array(
            'id'             => 'h4_params',
            'type'           => 'typography',
            'title'          => __( 'H4', SS_DOMAIN ),
            'compiler'       => true,
            'google'         => true,
             'fonts'         => array ( 
                'ralewayregular'                                       => 'ralewayregular',
                "Arial, Helvetica, sans-serif"                         => "Arial, Helvetica, sans-serif",
                "'Arial Black', Gadget, sans-serif"                    => "'Arial Black', Gadget, sans-serif",
                "'Bookman Old Style', serif"                           => "'Bookman Old Style', serif",
                "'Comic Sans MS', cursive"                             => "'Comic Sans MS', cursive",
                "Courier, monospace"                                   => "Courier, monospace",
                "Garamond, serif"                                      => "Garamond, serif",
                "Georgia, serif"                                       => "Georgia, serif",
                "Impact, Charcoal, sans-serif"                         => "Impact, Charcoal, sans-serif",
                "'Lucida Console', Monaco, monospace"                  => "'Lucida Console', Monaco, monospace",
                "'Lucida Sans Unicode', 'Lucida Grande', sans-serif"   => "'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
                "'MS Sans Serif', Geneva, sans-serif"                  => "'MS Sans Serif', Geneva, sans-serif",
                "'MS Serif', 'New York', sans-serif"                   => "'MS Serif', 'New York', sans-serif",
                "'Palatino Linotype', 'Book Antiqua', Palatino, serif" => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
                "Tahoma,Geneva, sans-serif"                            => "Tahoma, Geneva, sans-serif",
                "'Times New Roman', Times,serif"                       => "'Times New Roman', Times, serif",
                "'Trebuchet MS', Helvetica, sans-serif"                => "'Trebuchet MS', Helvetica, sans-serif",
                "Verdana, Geneva, sans-serif"                          => "Verdana, Geneva, sans-serif",
            ),
            'font-backup'    => false,
            'all_styles'     => true,
            'font-weight'    => true,
            'font-family'    => true,
            'text-align'     => false,
            'font-style'     => true,
            'subsets'        => true,
            'font-size'      => true,
            'line-height'    => true,
            'word-spacing'   => false,
            'letter-spacing' => false,
            'color'          => true,
            'preview'        => true,
            'output'         => array( 'h4' ),
            'units'          => 'px',
            'default'        => array(
                'font-size' => '18px',
                'font-weight' => '700',
            )
        ),
        array(
            'id'             => 'h5_params',
            'type'           => 'typography',
            'title'          => __( 'H5', SS_DOMAIN ),
            'compiler'       => true,
            'google'         => true,
             'fonts'         => array ( 
                'ralewayregular'                                       => 'ralewayregular',
                "Arial, Helvetica, sans-serif"                         => "Arial, Helvetica, sans-serif",
                "'Arial Black', Gadget, sans-serif"                    => "'Arial Black', Gadget, sans-serif",
                "'Bookman Old Style', serif"                           => "'Bookman Old Style', serif",
                "'Comic Sans MS', cursive"                             => "'Comic Sans MS', cursive",
                "Courier, monospace"                                   => "Courier, monospace",
                "Garamond, serif"                                      => "Garamond, serif",
                "Georgia, serif"                                       => "Georgia, serif",
                "Impact, Charcoal, sans-serif"                         => "Impact, Charcoal, sans-serif",
                "'Lucida Console', Monaco, monospace"                  => "'Lucida Console', Monaco, monospace",
                "'Lucida Sans Unicode', 'Lucida Grande', sans-serif"   => "'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
                "'MS Sans Serif', Geneva, sans-serif"                  => "'MS Sans Serif', Geneva, sans-serif",
                "'MS Serif', 'New York', sans-serif"                   => "'MS Serif', 'New York', sans-serif",
                "'Palatino Linotype', 'Book Antiqua', Palatino, serif" => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
                "Tahoma,Geneva, sans-serif"                            => "Tahoma, Geneva, sans-serif",
                "'Times New Roman', Times,serif"                       => "'Times New Roman', Times, serif",
                "'Trebuchet MS', Helvetica, sans-serif"                => "'Trebuchet MS', Helvetica, sans-serif",
                "Verdana, Geneva, sans-serif"                          => "Verdana, Geneva, sans-serif",
            ),
            'font-backup'    => false,
            'all_styles'     => true,
            'font-weight'    => true,
            'font-family'    => true,
            'text-align'     => false,
            'font-style'     => true,
            'subsets'        => true,
            'font-size'      => true,
            'line-height'    => true,
            'word-spacing'   => false,
            'letter-spacing' => false,
            'color'          => true,
            'preview'        => true,
            'output'         => array( 'h5' ),
            'units'          => 'px',
            'default'        => array(
                'font-size' => '15px',
                'font-weight' => '700',
            )
        ),
        array(
            'id'             => 'h6_params',
            'type'           => 'typography',
            'title'          => __( 'H6', SS_DOMAIN ),
            'compiler'       => true,
            'google'         => true,
             'fonts'         => array ( 
                'ralewayregular'                                       => 'ralewayregular',
                "Arial, Helvetica, sans-serif"                         => "Arial, Helvetica, sans-serif",
                "'Arial Black', Gadget, sans-serif"                    => "'Arial Black', Gadget, sans-serif",
                "'Bookman Old Style', serif"                           => "'Bookman Old Style', serif",
                "'Comic Sans MS', cursive"                             => "'Comic Sans MS', cursive",
                "Courier, monospace"                                   => "Courier, monospace",
                "Garamond, serif"                                      => "Garamond, serif",
                "Georgia, serif"                                       => "Georgia, serif",
                "Impact, Charcoal, sans-serif"                         => "Impact, Charcoal, sans-serif",
                "'Lucida Console', Monaco, monospace"                  => "'Lucida Console', Monaco, monospace",
                "'Lucida Sans Unicode', 'Lucida Grande', sans-serif"   => "'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
                "'MS Sans Serif', Geneva, sans-serif"                  => "'MS Sans Serif', Geneva, sans-serif",
                "'MS Serif', 'New York', sans-serif"                   => "'MS Serif', 'New York', sans-serif",
                "'Palatino Linotype', 'Book Antiqua', Palatino, serif" => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
                "Tahoma,Geneva, sans-serif"                            => "Tahoma, Geneva, sans-serif",
                "'Times New Roman', Times,serif"                       => "'Times New Roman', Times, serif",
                "'Trebuchet MS', Helvetica, sans-serif"                => "'Trebuchet MS', Helvetica, sans-serif",
                "Verdana, Geneva, sans-serif"                          => "Verdana, Geneva, sans-serif",
            ),
            'font-backup'    => false,
            'all_styles'     => true,
            'font-weight'    => true,
            'font-family'    => true,
            'text-align'     => false,
            'font-style'     => true,
            'subsets'        => true,
            'font-size'      => true,
            'line-height'    => true,
            'word-spacing'   => false,
            'letter-spacing' => false,
            'color'          => true,
            'preview'        => true,
            'output'         => array( 'h6' ),
            'units'          => 'px',
            'default'        => array(
                'font-size' => '13px',
                'font-weight' => '700',
            )
        ),
    ),
);

// Header -------------------------------------------------------------------------- >
$sections[] = array(
    'icon'       => 'el-icon-tasks',
    'icon_class' => 'el-icon-large',
    'title'      => __('Header Setting', SS_DOMAIN),
    'submenu'    => true,
    'fields'     => array(
            array(
                'id'       => 'option_check_list_social_header',
                'type'     => 'switch',
                'title'    => __( 'Show / Hide List Social', SS_DOMAIN ),
                'subtitle' => __( 'Enable this option to make on/off List Social.', SS_DOMAIN ),
                'default'  => '1',
            ),
            array(
                'id'       => 'option_check_social_header',
                'type'     => 'checkbox',
                'title'    => __( 'Select Social Media Icons to display', SS_DOMAIN ),
                'subtitle' => __( 'The urls for your social media icons will be taken from Social Media settings tab.', SS_DOMAIN ),
                'required' => array( 'option_check_list_social_header', "=", 1 ),
                'default'  => array(
                    'facebook' => '1',
                    'twitter' => '1',
                    'instagram' => '1'
                ),
                'options'  => array(
                    'facebook'   => 'Facebook',
                    'twitter'    => 'Twitter',
                    'instagram'  => 'Instagram',
                    'behance'    => 'Behance',
                    'dribbble'   => 'Dribbble',
                    'flickr'     => 'Flickr',
                    'linkedin'   => 'Linkedin',
                    'pinterest'  => 'Pinterest',
                    'delicious'  => 'Delicious',
                    'google'     => 'Google',
                    'skype'      => 'Skype',
                    'youtube'    => 'Youtube',
                    'tumblr'     => 'Tumblr',
                )
                
            ),
            array(
                'id'       => 'option_info_header',
                'type'     => 'switch',
                'title'    => __( 'Show / Hide Contact Information', SS_DOMAIN ),
                'subtitle' => __( 'Enable this option to make on/off Contact Information', SS_DOMAIN ),
                'default'  => '1',
            ),
            array(
                'id'             =>'option_email_content_header',
                'type'           => 'text',
                'title'          => __('Email Address', SS_DOMAIN),
                'subtitle'       => __('Enter your email address', SS_DOMAIN),
                'default'        => 'info@sunrisesoftlab.com',
                'required'       => array( 'option_info_header', "=", 1 ),
            ),
            array(
                'id'             =>'option_phone_content_header',
                'type'           => 'text',
                'title'          => __('Contact Number', SS_DOMAIN),
                'subtitle'       => __('Enter your contact number', SS_DOMAIN),
                'default'        => '+91 9819823407',
                'required'       => array( 'option_info_header', "=", 1 ),
            ),
            array(
                'id' => 'header_layout',
                'type' => 'image_select',
                'title' => __('Header Layout', SS_DOMAIN),
                'subtitle' => __('Select a header layout option from the examples.', SS_DOMAIN),
                'desc' => '',
                'options' => array(
                    'header-1' => array('title' => '', 'img' => $template_directory.'/images/ss-header-1.png'),
                    'header-2' => array('title' => '', 'img' => $template_directory.'/images/ss-header-2.png'),
                    'header-3' => array('title' => '', 'img' => $template_directory.'/images/ss-header-3.png'),
                    'header-4' => array('title' => '', 'img' => $template_directory.'/images/ss-header-4.png'),
                    'header-5' => array('title' => '', 'img' => $template_directory.'/images/ss-header-5.png'),
                    'header-6' => array('title' => '', 'img' => $template_directory.'/images/ss-header-6.png'),
                    'header-7' => array('title' => '', 'img' => $template_directory.'/images/ss-header-7.png'),
                    'header-8' => array('title' => '', 'img' => $template_directory.'/images/ss-header-8.png'),
                ),
                'default' => 'header-1'
            ),
            array(
                'id'       => 'option_check_header_background',
                'type'     => 'switch',
                'title'    => __( 'Header Background Image', SS_DOMAIN ),
                'subtitle' => __( 'Enable this option to make on/off header background image.', SS_DOMAIN ),
                'default'  => '2',
            ),
            array(
                'id'        => 'option_header_background_image',
                'url'       => true,
                'type'      => 'media',
                'title'     => __('Upload Background Image', SS_DOMAIN),
                'default'   => array( 'url' => get_template_directory_uri() .'/images/header-background-2.png' ),
                'subtitle'  => __('Upload your background image.', SS_DOMAIN),
                'required' => array( 'option_check_header_background', "=", 1 ),
            ),

    ),
);

$sections[] = array(
    'icon' => 'el-icon-th-list',
    'title' => __('Default Meta Options', SS_DOMAIN),
    'fields' => array(
        array(
            'id' => 'default_show_page_heading',
            'type' => 'button_set',
            'title' => __('Default Show Page Heading', SS_DOMAIN),
            'subtitle' => __('Choose the default state for the page heading, shown/hidden.', SS_DOMAIN),
            'desc' => '',
            'options' => array('1' => 'On','0' => 'Off'),
            'default' => '1'
            ),
        array(
            'id' => 'default_page_heading_background_color',
            'type' => 'color',
            'title' => __('Default Page Heading Background Color', SS_DOMAIN),
            'subtitle' => "Choose the default page heading background color for meta options, plus 404 + other non-custom pages.",
            'desc' => ''
            ),
        array(
            'id' => 'default_page_heading_text_align',
            'type' => 'select',
            'title' => __('Default Page Heading Text Align', SS_DOMAIN),
            'subtitle' => "Choose the page heading align for meta options, plus 404 + other non-custom pages (Standard/Hero only).",
            'options' => array(
                'left'      => 'Left',
                'center'    => 'Center',
                'right'     => 'Right'
                ),
            'desc' => '',
            'default' => 'left'
            ),
        array(
            'id' => 'default_page_heading_style',
            'type' => 'select',
            'url'=> true,
            'title' => __('Default Heading Background Style', SS_DOMAIN),
            'subtitle' => __('Upload heading background style for meta options, plus 404 + other non-custom pages (Heading Only).', SS_DOMAIN),
            'options' => array(
                'none'      => __('None', SS_DOMAIN),
                'standard'  => __('Standard', SS_DOMAIN),
                'fancy'     => __('Image Background', SS_DOMAIN),
            ),
            'desc' => '',
            'default' => 'fancy',
            ),
        array(
            'id' => 'default_page_heading_image',
            'type' => 'media',
            'url'=> true,
            'title' => __('Default Heading Background Image', SS_DOMAIN),
            'subtitle' => __('Upload heading background image for meta options, plus 404 + other non-custom pages (Heading Only).', SS_DOMAIN),
            'desc' => '',
            'required' => array( 'default_page_heading_style', "=", "fancy" ),
            ),
        array(
            'id' => 'default_page_heading_text_color',
            'type' => 'color',
            'title' => __('Default Page Heading Title Color', SS_DOMAIN),
            'subtitle' => "Choose the default page heading title color for meta options.",
            'desc' => ''
        ),
        array(
            'id' => 'default_sidebar_config',
            'type' => 'select',
            'title' => __('Default Page Sidebar Config', SS_DOMAIN),
            'subtitle' => "Choose the default sidebar config for pages",
            'options' => array(
                'no-sidebars'       => 'No Sidebars',
                'left-sidebar'      => 'Left Sidebar',
                'right-sidebar'     => 'Right Sidebar',
                'both-sidebars'     => 'Both Sidebars'
            ),
            'desc' => '',
            'default' => 'no-sidebars'
            ),
        array(
            'id' => 'default_left_sidebar',
            'type' => 'select',
            'title' => __('Default Page Left Sidebar', SS_DOMAIN),
            'subtitle' => "Choose the default left sidebar for pages",
            'data'      => 'sidebars',
            'desc' => '',
            'default' => 'sidebar-1'
            ),
        array(
            'id' => 'default_right_sidebar',
            'type' => 'select',
            'title' => __('Default Page Right Sidebar', SS_DOMAIN),
            'subtitle' => "Choose the default right sidebar for pages",
            'data'      => 'sidebars',
            'desc' => '',
            'default' => 'sidebar-1'
            ),
        array(
            'id' => 'dm_divide_1',
            'type' => 'divide'
            ),
        array(
            'id' => 'default_post_sidebar_config',
            'type' => 'select',
            'title' => __('Default Post Sidebar Config', SS_DOMAIN),
            'subtitle' => "Choose the default sidebar config for posts",
            'options' => array(
                'no-sidebars'       => 'No Sidebars',
                'left-sidebar'      => 'Left Sidebar',
                'right-sidebar'     => 'Right Sidebar',
            ),
            'desc' => '',
            'default' => 'no-sidebars'
            ),
        array(
            'id' => 'default_post_left_sidebar',
            'type' => 'select',
            'title' => __('Default Post Left Sidebar', SS_DOMAIN),
            'subtitle' => "Choose the default left sidebar for posts",
            'data'      => 'sidebars',
            'desc' => '',
            'default' => 'sidebar-1'
            ),
        array(
            'id' => 'default_post_right_sidebar',
            'type' => 'select',
            'title' => __('Default Post Right Sidebar', SS_DOMAIN),
            'subtitle' => "Choose the default right sidebar for posts",
            'data'      => 'sidebars',
            'desc' => '',
            'default' => 'sidebar-1'
            ),
        array(
            'id' => 'default_include_author',
            'type' => 'button_set',
            'title' => __('Default Include Author', SS_DOMAIN),
            'subtitle' => __('Choose the default state for the post author box, shown/hidden.', SS_DOMAIN),
            'desc' => '',
            'options' => array('1' => 'On','0' => 'Off'),
            'default' => '1'
            ),
        array(
            'id' => 'default_include_date',
            'type' => 'button_set',
            'title' => __('Default Include Date', SS_DOMAIN),
            'subtitle' => __('Choose the default state for the post date, shown/hidden.', SS_DOMAIN),
            'desc' => '',
            'options' => array('1' => 'On','0' => 'Off'),
            'default' => '1'
            ),
        array(
            'id' => 'default_include_category',
            'type' => 'button_set',
            'title' => __('Default Include Category', SS_DOMAIN),
            'subtitle' => __('Choose the default state for the post category, shown/hidden.', SS_DOMAIN),
            'desc' => '',
            'options' => array('1' => 'On','0' => 'Off'),
            'default' => '1'
            ),
        array(
            'id' => 'default_include_tags',
            'type' => 'button_set',
            'title' => __('Default Include Tags', SS_DOMAIN),
            'subtitle' => __('Choose the default state for the post tags, shown/hidden.', SS_DOMAIN),
            'desc' => '',
            'options' => array('1' => 'On','0' => 'Off'),
            'default' => '1'
            ),
        array(
            'id' => 'default_include_social',
            'type' => 'button_set',
            'title' => __('Default Include Social Sharing', SS_DOMAIN),
            'subtitle' => __('Choose the default state for the post social sharing, shown/hidden.', SS_DOMAIN),
            'desc' => '',
            'options' => array('1' => 'On','0' => 'Off'),
            'default' => '1'
            ),
        array(
            'id' => 'default_include_related',
            'type' => 'button_set',
            'title' => __('Default Include Related Articles', SS_DOMAIN),
            'subtitle' => __('Choose the default state for the post related articles, shown/hidden.', SS_DOMAIN),
            'desc' => '',
            'options' => array('1' => 'On','0' => 'Off'),
            'default' => '1'
            ),
        
    ),
);

$sections[] = array(
    'icon' => 'el-icon-th',
    'title' => __('Archive / Category Options', SS_DOMAIN),
    'fields' => array(
        array(
            'id' => 'archive_sidebar_config',
            'type' => 'select',
            'title' => __('Sidebar Config', SS_DOMAIN),
            'subtitle' => "Choose the sidebar configuration for the archive/category pages.",
            'options' => array(
                'no-sidebars'       => 'No Sidebars',
                'left-sidebar'      => 'Left Sidebar',
                'right-sidebar'     => 'Right Sidebar',
                //'both-sidebars'     => 'Both Sidebars'
                ),
            'desc' => '',
            'default' => 'right-sidebar'
            ),
        array(
            'id' => 'archive_sidebar_left',
            'type' => 'select',
            'title' => __('Left Sidebar', SS_DOMAIN),
            'subtitle' => "Choose the left sidebar for Left/Both sidebar configs.",
            'data'      => 'sidebars',
            'desc' => '',
            'default' => 'sidebar-1'
            ),
        array(
            'id' => 'archive_sidebar_right',
            'type' => 'select',
            'title' => __('Right Sidebar', SS_DOMAIN),
            'subtitle' => "Choose the left sidebar for Right/Both sidebar configs.",
            'data'      => 'sidebars',
            'desc' => '',
            'default' => 'sidebar-1'
            ),
        array(
            'id' => 'archive_display_type',
            'type' => 'select',
            'title' => __('Display Type', SS_DOMAIN),
            'subtitle' => "Select the display type.",
            'options' => array(
                'standard'      => 'Standard',
                'masonry'       => 'Masonry',
                ),
            'desc' => '',
            'default' => 'masonry'
            ),
        array(
            'id' => 'archive_display_columns',
            'type' => 'select',
            'title' => __('Masonry Archive Columns', SS_DOMAIN),
            'subtitle' => "Select the number of columns for the archive.",
            'options' => array(
                '1'     => '1',
                '2'     => '2',
                '3'     => '3',
                '4'     => '4'
                ),
            'desc' => '',
            'default' => '2',
            'required'  => array('archive_display_type', '=', 'masonry'),
            ),
        array(
            'id' => 'archive_display_pagination',
            'type' => 'select',
            'title' => __('Archive Pagination', SS_DOMAIN),
            'subtitle' => "Select the pagination type for the archive.",
            'options' => array(
                'infinite-scroll'       => 'Infinite Scroll',
                'load-more'     => 'Load More (AJAX)',
                'standard'      => 'Standard',
                'none'      => 'None'
                ),
            'desc' => '',
            'default' => 'standard',
            ),
        array(
            'id' => 'archive_content_output',
            'type' => 'select',
            'title' => __('Archive Content Output', SS_DOMAIN),
            'subtitle' => "Select if you'd like to output the content or excerpt on archive pages.",
            'options' => array(
                'excerpt'       => 'Excerpt',
                'content'       => 'Content',
                ),
            'desc' => '',
            'default' => 'excerpt'
            ),
        array(
            'id' => 'archive_include_date',
            'type' => 'button_set',
            'title' => __('Archive Show Date', SS_DOMAIN),
            'subtitle' => __('Show post date for archive/category.', SS_DOMAIN),
            'desc' => '',
            'options' => array('1' => 'On','0' => 'Off'),
            'default' => '1'
            ),
         array(
            'id' => 'archive_include_author',
            'type' => 'button_set',
            'title' => __('Archive Show Author', SS_DOMAIN),
            'subtitle' => __('Show post author for archive/category.', SS_DOMAIN),
            'desc' => '',
            'options' => array('1' => 'On','0' => 'Off'),
            'default' => '1'
            ),
         array(
            'id' => 'archive_include_category',
            'type' => 'button_set',
            'title' => __('Archive Show Category', SS_DOMAIN),
            'subtitle' => __('Show post category for archive/category.', SS_DOMAIN),
            'desc' => '',
            'options' => array('1' => 'On','0' => 'Off'),
            'default' => '1'
            ),
          array(
            'id' => 'archive_include_comment',
            'type' => 'button_set',
            'title' => __('Archive Show Comment Count', SS_DOMAIN),
            'subtitle' => __('Show post comment count for archive/category.', SS_DOMAIN),
            'desc' => '',
            'options' => array('1' => 'On','0' => 'Off'),
            'default' => '1'
            ),
           array(
            'id' => 'archive_include_view_count',
            'type' => 'button_set',
            'title' => __('Archive Show View Count', SS_DOMAIN),
            'subtitle' => __('Show post view count for archive/category.', SS_DOMAIN),
            'desc' => '',
            'options' => array('1' => 'On','0' => 'Off'),
            'default' => '1'
            ),
        array(
            'id' => 'archive_divide_a',
            'type' => 'divide'
            ),
        array(
            'id' => 'portfolio_archive_display_type',
            'type' => 'select',
            'title' => __('Portfolio Archive Display Type', SS_DOMAIN),
            'subtitle' => "Select the display type.",
            'options' => array(
                'standard'              => 'Standard',
                'gallery'               => 'Gallery',
                'masonry'               => 'Masonry',
                'masonry-gallery'       => 'Masonry Gallery',
                ),
            'desc' => '',
            'default' => 'standard'
            ),
        array(
            'id' => 'portfolio_archive_columns',
            'type' => 'select',
            'title' => __('Portfolio Archive Columns', SS_DOMAIN),
            'subtitle' => "Select the number of columns for the portfolio archive.",
            'options' => array(
                '1'     => '1',
                '2'     => '2',
                '3'     => '3',
                '4'     => '4'
                ),
            'desc' => '',
            'default' => '4'
            )
    ),
);


// Woocommerce -------------------------------------------------------------------------- >
$sections[] = array(
    'icon'         => 'el-icon-shopping-cart',
    'icon_class'   => 'el-icon-large',
    'title'        => __('Woocommerce Setting', SS_DOMAIN),
    'desc'         => __('*NOTE: This is option support for Woocommerce default of theme.', SS_DOMAIN),
    'submenu'      => true,
    'fields'       => array(
        array(
            'id' => 'enable_catalog_mode',
            'type' => 'button_set',
            'title' => __('Catalog Mode', SS_DOMAIN),
            'subtitle' => __('Enable this setting to set the products into catalog mode, with no cart or checkout process.', SS_DOMAIN),
            'desc' => '',
            'options' => array('1' => 'On','0' => 'Off'),
            'default' => '0'
        ),
        array(
            'id'             => 'products_per_page',
            'type'           => 'text',
            'title'          => __( 'Products Per Page', SS_DOMAIN ),
            'desc'           => __('The amount of products you would like to show per page on shop/category pages.', SS_DOMAIN),
            'subtitle'       => __('Number value.', SS_DOMAIN),
            'default'        => '24',
        ),
        array(
            'id'        => 'new_badge',
            'type'      => 'text',
            'title'     => __('New Badge', SS_DOMAIN),
            'subtitle'  => __('Number value.', SS_DOMAIN),
            'desc'      => __('The amount of time in days that the "New" badge will display on products. Set this to 0 to disable the badge.', SS_DOMAIN),
            'validate'  => 'numeric',
            'default'   => '7',
        ),
        array(
            'id'             => 'product_display_pagination',
            'type'           => 'select',
            'title'          => __( 'Shop Pagination', SS_DOMAIN ),
            'desc'           => "",
            'subtitle'       => __( 'Select the pagination type for the shop page.', SS_DOMAIN ),
            'options'        => array(
                                    'infinite-scroll' => 'Infinite Scroll',
                                    'load-more'       => 'Load More (AJAX)',
                                    'standard'        => 'Standard',
                                    'none'            => 'None'
                            ),
            'default'        => 'standard',
        ),
        array(
            'id'            => 'product_display_layout',
            'type'          => 'select',
            'title'         => __('Product Display Layout', SS_DOMAIN),
            'subtitle'      => __( 'Choose the default product display layout for WooCommerce shop/category pages.', SS_DOMAIN),
            'options'       => array(
                    'standard'      => 'Standard',
                    'grid'          => 'Grid',
                    'list'          => 'List',
            ),
            'desc' => '',
            'default' => 'grid'
        ),
        array(
            'id'            => 'woo_product_divide_0',
            'type'          => 'divide'
        ),
        array(
            'id'            => 'product_display_columns',
            'type'          => 'select',
            'title'         => __('Product Display Columns', SS_DOMAIN),
            'subtitle'      => "Choose the number of columns to display on shop/category pages.",
            'options'   => array(
                '1'     => '1',
                '2'     => '2',
                '3'     => '3',
                '4'     => '4',
            ),
            'desc' => '',
            'default' => '4'
        ),
        array(
            'id'            => 'woo_sidebar_config',
            'type'          => 'select',
            'title'         => __('WooCommerce Sidebar Config', SS_DOMAIN),
            'subtitle'      => "Choose the sidebar config for WooCommerce shop/category pages.",
            'options'       => array(
                'no-sidebars'       => 'No Sidebars',
                'left-sidebar'      => 'Left Sidebar',
                'right-sidebar'     => 'Right Sidebar',
            ),
            'desc'          => '',
            'default'       => 'no-sidebars'
        ),
        array(
            'id'            => 'woo_left_sidebar',
            'type'          => 'select',
            'title'         => __('WooCommerce Left Sidebar', SS_DOMAIN),
            'subtitle'      => "Choose the left sidebar for WooCommerce shop/category pages.",
            'data'          => 'sidebars',
            'desc'          => '',
            'default'       => 'woocommerce-sidebar'
        ),
        array(
            'id'            => 'woo_right_sidebar',
            'type'          => 'select',
            'title'         => __('WooCommerce Right Sidebar', SS_DOMAIN),
            'subtitle'      => "Choose the right sidebar for WooCommerce shop/category pages.",
            'data'          => 'sidebars',
            'desc'          => '',
            'default'       => 'woocommerce-sidebar'
        ),
        array(
            'id'            => 'woo_product_divide_1',
            'type'          => 'divide'
        ),
        array(
            'id'            => 'default_product_sidebar_config',
            'type'          => 'select',
            'title'         => __('Default Product Sidebar Config', SS_DOMAIN),
            'subtitle'      => "Choose the sidebar config for WooCommerce shop/category pages.",
            'options'       => array(
                'no-sidebars'       => 'No Sidebars',
                'left-sidebar'      => 'Left Sidebar',
                'right-sidebar'     => 'Right Sidebar',
            ),
            'desc'          => '',
            'default'       => 'no-sidebars'
        ),
        array(
            'id' => 'default_product_left_sidebar',
            'type' => 'select',
            'title' => __('Default Product Left Sidebar', SS_DOMAIN),
            'subtitle' => "Choose the default left sidebar for WooCommerce product pages.",
            'data'      => 'sidebars',
            'desc' => '',
            'default' => 'woocommerce-sidebar'
        ),
        array(
            'id' => 'default_product_right_sidebar',
            'type' => 'select',
            'title' => __('Default Product Right Sidebar', SS_DOMAIN),
            'subtitle' => "Choose the default right sidebar for WooCommerce product pages.",
            'data'      => 'sidebars',
            'desc' => '',
            'default' => 'woocommerce-sidebar'
        ),
        array(
            'id'            => 'woo_product_divide_1',
            'type'          => 'divide'
        ),

        array(
            'id' => 'woo_show_page_heading',
            'type' => 'button_set',
            'title' => __('Shop Category / Page Heading', SS_DOMAIN),
            'subtitle' => __('Show page title on shop/category WooCommerce page.', SS_DOMAIN),
            'desc' => '',
            'options' => array('1' => 'On', '0' => 'Off'),
            'default' => '1'
        ),
        array(
            'id' => 'woo_page_heading_text_align',
            'type' => 'select',
            'title' => __('WooCommerce Page Heading Text Align', SS_DOMAIN),
            'subtitle' => "Choose the page heading align for the shop/category WooCommerce pages (Standard/Fancy only).",
            'options' => array(
                'left'      => 'Left',
                'center'    => 'Center',
                'right'     => 'Right'
                ),
            'desc' => '',
            'default' => 'left'
        ),
        array(
            'id' => 'woo_page_heading_style',
            'type' => 'select',
            'url'=> true,
            'title' => __('Default Heading Background Style', SS_DOMAIN),
            'subtitle' => __('Upload the heading background style for woocommerce.', SS_DOMAIN),
            'options' => array(
                'none'      => __('None', SS_DOMAIN),
                'standard'  => __('Standard', SS_DOMAIN),
                'fancy'     => __('Image Background', SS_DOMAIN),
            ),
            'desc' => '',
            'default' => 'fancy',
            ),
        array(
            'id' => 'woo_page_heading_image',
            'type' => 'media',
            'url'=> true,
            'title' => __('WooCommerce Heading Background Image', SS_DOMAIN),
            'subtitle' => __('Upload the heading background image for WooCommerce page heading.', SS_DOMAIN),
            'desc' => '',
            'required' => array( 'woo_page_heading_style', "=", "fancy" ),
        ),
        array(
            'id' => 'woo_page_heading_background_color',
            'type' => 'color',
            'title' => __('Default Woocommerce Page Heading Background Color', SS_DOMAIN),
            'subtitle' => "Choose the default page heading background color for meta options.",
            'desc' => ''
        ),
        array(
            'id' => 'woo_page_heading_text_color',
            'type' => 'color',
            'title' => __('Default Woocommerce Page Heading Title Color', SS_DOMAIN),
            'subtitle' => "Choose the default page heading title color for meta options.",
            'desc' => ''
        ),

    )
);

// Footer -------------------------------------------------------------------------- >
$sections[] = array(
    'icon'       => 'el-icon-bookmark',
    'icon_class' => 'el-icon-large',
    'title'      => __('Footer Setting', SS_DOMAIN),
    'submenu'    => true,
    'fields'     => array(
        array(
            'id'      => 'option_footer_widgets',
            'type'    => 'switch',
            'title'   => __( 'Enable footer widgets area.', SS_DOMAIN ),
            'default' => '1',
        ),

        array(
            'id'       => 'option_footer_layout',
            'type'     => 'image_select',
            'title'    => __( 'Footer Layout', SS_DOMAIN ),
            'subtitle' => __( 'Select the footer layout columns to display in the footer.', SS_DOMAIN ),
            'required' => array( 'option_footer_widgets', '=', true, ),
            'options'  => array(
                            'footer-1' => array('title' => '', 'img' => $template_directory.'/images/ss-footer-1.png'),
                            'footer-2' => array('title' => '', 'img' => $template_directory.'/images/ss-footer-2.png'),
                            'footer-3' => array('title' => '', 'img' => $template_directory.'/images/ss-footer-3.png'),
                            'footer-4' => array('title' => '', 'img' => $template_directory.'/images/ss-footer-4.png'),
                            'footer-5' => array('title' => '', 'img' => $template_directory.'/images/ss-footer-5.png'),
                            'footer-6' => array('title' => '', 'img' => $template_directory.'/images/ss-footer-6.png'),
                            'footer-7' => array('title' => '', 'img' => $template_directory.'/images/ss-footer-7.png'),
                            'footer-8' => array('title' => '', 'img' => $template_directory.'/images/ss-footer-8.png'),
                            'footer-9' => array('title' => '', 'img' => $template_directory.'/images/ss-footer-9.png'),
                            'footer-10' => array('title' => '', 'img' => $template_directory.'/images/ss-footer-10.png'),
                        ),
            'default' => 'footer-1'
        ),
        
        array(
            'id'       => 'option_check_list_social_footer',
            'type'     => 'switch',
            'title'    => __( 'Show / Hide List Social On Footer', SS_DOMAIN ),
            'subtitle' => __( 'Enable this option to make on/off list Social.', SS_DOMAIN ),
            'default'  => '1',
        ),
        array(
            'id'       => 'option_check_social_footer',
            'type'     => 'checkbox',
            'title'    => __( 'Select Social Media Icons to display', SS_DOMAIN ),
            'subtitle' => __( 'The urls for your social media icons will be taken from Social Media settings tab.', SS_DOMAIN ),
            'required' => array( 'option_check_list_social_footer', "=", 1 ),
            'default'  => array(
                'facebook'  => '1',
                'twitter'   => '1',
                'instagram' => '1'
            ),
            'options'  => array(
                'facebook'   => 'Facebook',
                'twitter'    => 'Twitter',
                'instagram'  => 'Instagram',
                'behance'    => 'Behance',
                'dribbble'   => 'Dribbble',
                'flickr'     => 'Flickr',
                'linkedin'   => 'Linkedin',
                'pinterest'  => 'Pinterest',
                'delicious'  => 'Delicious',
                'google'     => 'Google',
                'skype'      => 'Skype',
                'youtube'    => 'Youtube',
                'tumblr'     => 'Tumblr',
            )       
        ), 

        array(
            'id'       => 'option_check_copyright_footer',
            'type'     => 'switch',
            'title'    => __( 'Show / Hide Copyright message', SS_DOMAIN ),
            'subtitle' => __( 'Enable this option to make on/off copyright message.', SS_DOMAIN ),
            'default'  => '1',
        ),

        array(
            'id'             => 'option_copyright_footer',
            'type'           => 'textarea',
            'title'          => __('Copyright', SS_DOMAIN),
            'subtitle'       => __('Enter your custom copyright text.', SS_DOMAIN),
            'required'       => array( 'option_check_copyright_footer', "=", 1 ),
            'default'        => __( 'Copyright &copy; 2018 Sunrise Softlab by <a target="_blank" href="http://www.sunrisesoftlab.in/">Sunrise Softlab</a>', SS_DOMAIN ),

        ),
    )
);
// Social -------------------------------------------------------------------------- >
$sections[] = array(
    'icon' => 'el-icon-twitter',
    'icon_class' => 'el-icon-large',
    'title' => __('Social Setting', SS_DOMAIN),
    'submenu' => true,
    'fields' => array(

        array(
            'id'=>'twitter',
            'type' => 'text',
            'title' => __('Twitter', SS_DOMAIN),
            'subtitle' => __('Enter a url for your Twitter.', SS_DOMAIN),
            'default' => '#',
        ),
        array(
            'id'=>'facebook',
            'type' => 'text',
            'title' => __('Facebook', SS_DOMAIN),
            'subtitle' => __('Enter a url for your Facebook.', SS_DOMAIN),
            'default' => '#',
        ),
        array(
            'id'=>'google',
            'type' => 'text',
            'title' => __('Google', SS_DOMAIN),
            'subtitle' => __('Enter a url for your Google Plus.', SS_DOMAIN),
            'default' => '#',
        ),
        array(
            'id'=>'instagram',
            'type' => 'text',
            'title' => __('Instagram', SS_DOMAIN),
            'subtitle' => __('Enter a url for your Instagram.', SS_DOMAIN),
            'default' => '#',
        ),
        array(
            'id'=>'behance',
            'type' => 'text',
            'title' => __('Behance', SS_DOMAIN),
            'subtitle' => __('Enter a url for your Behance.', SS_DOMAIN),
            'default' => '#',
        ),
        array(
            'id'=>'dribbble',
            'type' => 'text',
            'title' => __('Dribbble', SS_DOMAIN),
            'subtitle' => __('Enter a url for your Dribbble.', SS_DOMAIN),
            'default' => '#',
        ),
        array(
            'id'=>'pinterest',
            'type' => 'text',
            'title' => __('Pinterest', SS_DOMAIN),
            'subtitle' => __('Enter a url for your Pinterest.', SS_DOMAIN),
            'default' => '#',
        ),
        array(
            'id'=>'linkedin',
            'type' => 'text',
            'title' => __('Linkedin', SS_DOMAIN),
            'subtitle' => __('Enter a url for your Linkedin.', SS_DOMAIN),
            'default' => '#',
        ),
        array(
            'id'=>'skype',
            'type' => 'text',
            'title' => __('Skype', SS_DOMAIN),
            'subtitle' => __('Enter a url for your Skype.', SS_DOMAIN),
            'default' => '#',
        ),
        array(
            'id'=>'youtube',
            'type' => 'text',
            'title' => __('Youtube', SS_DOMAIN),
            'subtitle' => __('Enter a url for your Youtube.', SS_DOMAIN),
            'default' => '#',
        ),
        array(
            'id'=>'tumblr',
            'type' => 'text',
            'title' => __('Tumblr', SS_DOMAIN),
            'subtitle' => __('Enter a url for your Tumblr.', SS_DOMAIN),
            'default' => '#',
        ),
    )
);

global $ReduxFramework;
$ReduxFramework = new ReduxFramework($sections, $args, $tabs);

// ss_theme_options
if ( ! function_exists('ss_option') ) {
    function ss_option($id, $fallback = false, $param = false ) {
        global $ss_theme_options;
        if ( $fallback == false ) $fallback = '';
        $output = ( isset($ss_theme_options[$id]) && $ss_theme_options[$id] !== '' ) ? $ss_theme_options[$id] : $fallback;
        if ( !empty($ss_option[$id]) && $param ) {
            $output = $ss_theme_options[$id][$param];
        }
        return $output;
    }
}

if (!function_exists('ss_get_theme_opts')) {
    function ss_get_theme_opts() {
        global $ss_theme_options;
        return $ss_theme_options;
    }
}