<?php
	
function ss_register_meta_boxes() {
	$prefix = 'ss_';

	global $meta_boxes;
	global $ss_theme_options;

	$meta_boxes = array();


	$default_sidebar_config = $ss_theme_options['default_sidebar_config'];
	$default_left_sidebar = $ss_theme_options['default_left_sidebar'];
	$default_right_sidebar = $ss_theme_options['default_right_sidebar'];

	$default_post_sidebar_config = $ss_theme_options['default_post_sidebar_config'];
	$default_post_left_sidebar = $ss_theme_options['default_post_left_sidebar'];
	$default_post_right_sidebar = $ss_theme_options['default_post_right_sidebar'];

	/* Page Title Meta Box
	================================================== */
	$meta_boxes[] = array(
		'id' => 'page_heading_meta_box',
		'title' => __('Page Title', SS_DOMAIN),
		'pages' => array( 'post','page','product', 'portfolio'),
		'context' => 'normal',
		'fields' => array(

			// SHOW PAGE TITLE
			array(
				'name' => __('Show page title', SS_DOMAIN),    // File type: checkbox
				'id'   => $prefix . 'page_title',
				'type' => 'checkbox',
				'desc' => __('Show the page title at the top of the page.', SS_DOMAIN),
				'std' => '',
			),

			array(
				'name' => __('Default Page Heading Setting', SS_DOMAIN), // Flag for default
				'id'   => $prefix . 'page_default_theme_setting',
				'type' => 'checkbox',
				'desc' => __('Use default theme heading setting for the page.', SS_DOMAIN),
				'std'  => '',
			),

			// PAGE TITLE BACKGROUND COLOR
			array(
				'name' => __('Page Title Background Color', SS_DOMAIN),
				'id' => $prefix . 'page_title_bg_color',
				'desc' => __("Optionally set a background color for the page title.", SS_DOMAIN),
				'type'  => 'color',
				'std' => '',
			),

			// PAGE TITLE TEXT COLOR
			array(
				'name' => __('Page Title Text Color', SS_DOMAIN),
				'id' => $prefix . 'page_title_text_color',
				'desc' => __("Optionally set a text color for the page title.", SS_DOMAIN),
				'type'  => 'color',
				'std' => '',
			),

			// PAGE TITLE STYLE
			array(
				'name' => __('Page Title Style', SS_DOMAIN),
				'id'   => $prefix . "page_title_style",
				'type' => 'select',
				'options' => array(
					'none'      => __('None', SS_DOMAIN),
					'standard'	=> __('Standard', SS_DOMAIN),
					'fancy'		=> __('Image Background', SS_DOMAIN),
				),
				'multiple' => false,
				'std'  => 'none',
				'desc' => __('Choose the heading style.', SS_DOMAIN)
			),

			// PAGE TITLE LINE 1
			array(
				'name' => __('Page Title', SS_DOMAIN),
				'id' => $prefix . 'page_title_one',
				'desc' => __("Enter a custom page title if you'd like.", SS_DOMAIN),
				'type'  => 'text',
				'std' => '',
			),

			// PAGE TITLE LINE 2
			array(
				'name' => __('Page Subtitle', SS_DOMAIN),
				'id' => $prefix . 'page_subtitle',
				'desc' => __("Enter a custom page title if you'd like (Hero Page Title Style Only).", SS_DOMAIN),
				'type'  => 'text',
				'std' => '',
			),

			// HERO HEADING IMAGE UPLOAD
			array(
				'name'  => __('Page Heading Background Image', SS_DOMAIN),
				'desc'  => __('The image that will be used as the background for the fancy header.', SS_DOMAIN),
				'id'    => $prefix . "page_title_image",
				'type'  => 'image_advanced',
				'max_file_uploads' => 1
			),


			// HERO HEADING TEXT ALIGN
			array(
				'name' => __('Page Heading Text Align', SS_DOMAIN),
				'id'   => $prefix . "page_title_text_align",
				'type' => 'select',
				'options' => array(
					'left'		=> __('Left', SS_DOMAIN),
					'center'	=> __('Center', SS_DOMAIN),
					'right'		=> __('Right', SS_DOMAIN)
				),
				'multiple' => false,
				'std'  => 'left',
				'desc' => __('Choose the text alignment for the fancy heading.', SS_DOMAIN)
			),

			// HERO HEADING HEIGHT
			array(
				'name' => __('Fancy Heading Height', SS_DOMAIN),
				'id' => $prefix . "page_title_height",
				'desc' => __("Set the height for the Fancy Heading (no px).", SS_DOMAIN),
				'clone' => false,
				'type'  => 'text',
				'std' => '100',
			),

			// REMOVE BREADCRUMBS
			array(
				'name' => __('Remove breadcrumbs', SS_DOMAIN),
				'id'   => $prefix . "no_breadcrumbs",
				'type' => 'checkbox',
				'desc' => __('Remove the breadcrumbs from under the page title on this page.', SS_DOMAIN),
				'std' => 0,
			),
		)
	);


	/* Page Background Meta Box
	   ================================================== */
	// $meta_boxes[] = array(
	// 	'id' => 'page_background_meta_box',
	// 	'title' => __('Page Background', SS_DOMAIN),
	// 	'pages' => array( 'post', 'portfolio', 'product', 'page' ),
	// 	'context' => 'normal',
	// 	'fields' => array(

	// 		// BACKGROUND IMAGE
	// 		array(
	// 			'name'  => __('Background Image', SS_DOMAIN),
	// 			'desc'  => __('The image that will be used as the OUTER page background image.', SS_DOMAIN),
	// 			'id'    => $prefix . "background_image",
	// 			'type'  => 'image_advanced',
	// 			'max_file_uploads' => 1
	// 		),

	// 		// BACKGROUND SIZE
	// 		array(
	// 			'name' => __('Background Image Size', SS_DOMAIN),
	// 			'desc' => __('For fullscreen images, choose Cover. For repeating patterns, choose Auto.', SS_DOMAIN),
	// 			'id'   => $prefix . "background_image_size",
	// 			'type' => 'select',
	// 			'options' => array(
	// 				'cover'		=> 'Cover',
	// 				'auto'	=> 'Auto'
	// 			),
	// 			'multiple' => false,
	// 			'std'  => 'cover',
	// 		),

	// 		// INNER BACKGROUND IMAGE
	// 		array(
	// 			'name'  => __('Inner Background Image', SS_DOMAIN),
	// 			'desc'  => __('The image that will be used as the INNER page background image.', SS_DOMAIN),
	// 			'id'    => $prefix . "inner_background_image",
	// 			'type'  => 'image_advanced',
	// 			'max_file_uploads' => 1
	// 		),

	// 		// BACKGROUND SIZE
	// 		array(
	// 			'name' => __('Inner Background Image Size', SS_DOMAIN),
	// 			'desc' => __('For fullscreen images, choose Cover. For repeating patterns, choose Auto.', SS_DOMAIN),
	// 			'id'   => $prefix . "inner_background_image_size",
	// 			'type' => 'select',
	// 			'options' => array(
	// 				'cover'		=> 'Cover',
	// 				'auto'	=> 'Auto'
	// 			),
	// 			'multiple' => false,
	// 			'std'  => 'auto',
	// 		),

	// 		// INNER BACKGROUND COLOR
	// 		array(
	// 			'name' => __('Inner Background Color', SS_DOMAIN),
	// 			'id' => $prefix . 'inner_background_color',
	// 			'desc' => __("Optionally set a background color for the inner page background.", SS_DOMAIN),
	// 			'type'  => 'color',
	// 			'std' => '',
	// 		),

	// 	)
	// );

	/* Sidebar Meta Box Page
	================================================== */
	$meta_boxes[] = array(
		'id'    => 'sidebar_meta_box_page',
		'title' => __('Sidebar Options', SS_DOMAIN),
		'pages' => array( 'page' ),
		'priority' => 'low',
		'fields' => array(
	
				// SIDEBAR CONFIG
				array(
					'name' => __('Sidebar configuration', SS_DOMAIN),
					'id'   => $prefix . "sidebar_config",
					'type' => 'select',
					'options' => array(
						'no-sidebars'		=> __('No Sidebars', SS_DOMAIN),
						'left-sidebar'		=> __('Left Sidebar', SS_DOMAIN),
						'right-sidebar'		=> __('Right Sidebar', SS_DOMAIN),
					),
					'multiple' => false,
					'std'  => $default_sidebar_config,
					'desc' => __('Choose the sidebar configuration for the detail page of this page.', SS_DOMAIN),
				),
	
				// LEFT SIDEBAR
				array (
					'name' 	=> __('Left Sidebar', SS_DOMAIN),
				    'id' 	=> $prefix . "left_sidebar",
				    'type' 	=> 'select',
				    'options' 	=> ss_get_all_sidebars(),
				),
	
				// RIGHT SIDEBAR
				array (
					'name' 	=> __('Right Sidebar', SS_DOMAIN),
				    'id' 	=> $prefix . "right_sidebar",
				    'type' 	=> 'select',
				    'options' 	=> ss_get_all_sidebars(),
				),
			)
	);

	/* Sidebar Meta Box Post
	================================================== */
	$meta_boxes[] = array(
		'id'    => 'sidebar_meta_box_post',
		'title' => __('Sidebar Options', SS_DOMAIN),
		'pages' => array( 'post' ),
		'priority' => 'low',
		'fields' => array(
	
				// SIDEBAR CONFIG
				array(
					'name' => __('Sidebar configuration', SS_DOMAIN),
					'id'   => $prefix . "sidebar_config",
					'type' => 'select',
					'options' => array(
						'no-sidebars'		=> __('No Sidebars', SS_DOMAIN),
						'left-sidebar'		=> __('Left Sidebar', SS_DOMAIN),
						'right-sidebar'		=> __('Right Sidebar', SS_DOMAIN),
					),
					'multiple' => false,
					'std'  => $default_sidebar_config,
					'desc' => __('Choose the sidebar configuration for the detail post of this post.', SS_DOMAIN),
				),
	
				// LEFT SIDEBAR
				array (
					'name' 	=> __('Left Sidebar', SS_DOMAIN),
				    'id' 	=> $prefix . "left_sidebar",
				    'type' 	=> 'select',
				    'options' 	=> ss_get_all_sidebars(),
				),
	
				// RIGHT SIDEBAR
				array (
					'name' 	=> __('Right Sidebar', SS_DOMAIN),
				    'id' 	=> $prefix . "right_sidebar",
				    'type' 	=> 'select',
				    'options' 	=> ss_get_all_sidebars(),
				),
			)
	);

	/* Sidebar Meta Box Product
	================================================== */
	$meta_boxes[] = array(
		'id'    => 'sidebar_meta_box_product',
		'title' => __('Sidebar Options', SS_DOMAIN),
		'pages' => array( 'product' ),
		'priority' => 'low',
		'fields' => array(
	
				// SIDEBAR CONFIG
				array(
					'name' => __('Sidebar configuration', SS_DOMAIN),
					'id'   => $prefix . "sidebar_config",
					'type' => 'select',
					'options' => array(
						'no-sidebars'		=> __('No Sidebars', SS_DOMAIN),
						'left-sidebar'		=> __('Left Sidebar', SS_DOMAIN),
						'right-sidebar'		=> __('Right Sidebar', SS_DOMAIN),
					),
					'multiple' => false,
					'std'  => $default_sidebar_config,
					'desc' => __('Choose the sidebar configuration for the detail product of this product.', SS_DOMAIN),
				),
	
				// LEFT SIDEBAR
				array (
					'name' 	=> __('Left Sidebar', SS_DOMAIN),
				    'id' 	=> $prefix . "left_sidebar",
				    'type' 	=> 'select',
				    'options' 	=> ss_get_all_sidebars(),
				),
	
				// RIGHT SIDEBAR
				array (
					'name' 	=> __('Right Sidebar', SS_DOMAIN),
				    'id' 	=> $prefix . "right_sidebar",
				    'type' 	=> 'select',
				    'options' 	=> ss_get_all_sidebars(),
				),
			)
	);

	/* Portfolio Thumbnail Meta Box
	================================================== */
	$meta_boxes[] = array(
		'id' => 'portfolio_thumbnail_meta_box',
		'title' => __('Thumbnail', SS_DOMAIN),
		'pages' => array( 'portfolio' ),
		'context' => 'normal',
		'fields' => array(

			// THUMBNAIL TYPE
			array(
				'name' => __('Thumbnail type', SS_DOMAIN),
				'id'   => $prefix . "thumbnail_type",
				'type' => 'select',
				'options' => array(
					'none'		=> 'None',
					'image'		=> 'Image',
					'video'		=> 'Video',
					'slider'	=> 'Slider'
				),
				'multiple' => false,
				'std'  => 'image',
				'desc' => __('Choose what will be used for the item thumbnail.', SS_DOMAIN)
			),

			// THUMBNAIL IMAGE
			array(
				'name'  => __('Thumbnail image', SS_DOMAIN),
				'desc'  => __('The image that will be used as the thumbnail image.', SS_DOMAIN),
				'id'    => $prefix . "thumbnail_image",
				'type'  => 'image_advanced',
				'max_file_uploads' => 1
			),

			// THUMBNAIL VIDEO
			array(
				'name' => __('Thumbnail video URL', SS_DOMAIN),
				'id' => $prefix . 'thumbnail_video_url',
				'desc' => __('Enter the video url for the thumbnail. Only links from Vimeo & YouTube are supported.', SS_DOMAIN),
				'clone' => false,
				'type'  => 'text',
				'std' => '',
			),

			// THUMBNAIL GALLERY
			array(
				'name'             => __('Thumbnail gallery', SS_DOMAIN),
				'desc'             => __('The images that will be used in the thumbnail gallery.', SS_DOMAIN),
				'id'               => $prefix . "thumbnail_gallery",
				'type'             => 'image_advanced',
				'max_file_uploads' => 50,
			),

			// THUMBNAIL LINK TYPE
			array(
				'name' => __('Thumbnail link type', SS_DOMAIN),
				'id'   => $prefix . "thumbnail_link_type",
				'type' => 'select',
				'options' => array(
					'link_to_post'		=> __('Link to item', SS_DOMAIN),
					'link_to_url'		=> __('Link to URL', SS_DOMAIN),
					'link_to_url_nw'	=> __('Link to URL (New Window)', SS_DOMAIN),
					'lightbox_thumb'	=> __('Lightbox to the thumbnail image', SS_DOMAIN),
					'lightbox_image'	=> __('Lightbox to image (select below)', SS_DOMAIN),
					'lightbox_video'	=> __('Fullscreen Video Overlay (input below)', SS_DOMAIN)
				),
				'multiple' => false,
				'std'  => 'link-to-post',
				'desc' => __('Choose what link will be used for the image(s) and title of the item.', SS_DOMAIN)
			),

			// THUMBNAIL LINK URL
			array(
				'name' => __('Thumbnail link URL', SS_DOMAIN),
				'id' => $prefix . 'thumbnail_link_url',
				'desc' => __('Enter the url for the thumbnail link.', SS_DOMAIN),
				'clone' => false,
				'type'  => 'text',
				'std' => '',
			),

			// THUMBNAIL LINK LIGHTBOX IMAGE
			array(
				'name'  => __('Thumbnail link lightbox image', SS_DOMAIN),
				'desc'  => __('The image that will be used as the lightbox image.', SS_DOMAIN),
				'id'    => $prefix . "thumbnail_link_image",
				'type'  => 'image_advanced',
				'max_file_uploads' => 1
			),

			// THUMBNAIL LINK LIGHTBOX VIDEO
			array(
				'name' => __('Thumbnail link lightbox video URL', SS_DOMAIN),
				'id' => $prefix . 'thumbnail_link_video_url',
				'desc' => __('Enter the video url for the thumbnail lightbox. Only links from Vimeo & YouTube are supported.', SS_DOMAIN),
				'clone' => false,
				'type'  => 'text',
				'std' => '',
			),

			// PAGE TITLE BACKGROUND COLOR
			array(
				'name' => __('Thumbnail Hover Background Color', SS_DOMAIN),
				'id' => $prefix . 'port_hover_bg_color',
				'desc' => __("Optionally set an alternate background colour for the thumbnail hover.", SS_DOMAIN),
				'type'  => 'color',
				'std' => '',
			),

			// PAGE TITLE TEXT COLOR
			array(
				'name' => __('Thumbnail Hover Text Color', SS_DOMAIN),
				'id' => $prefix . 'port_hover_text_color',
				'desc' => __("Optionally set an alternate text colour for the thumbnail hover.", SS_DOMAIN),
				'type'  => 'color',
				'std' => '',
			),

		)
	);


	/* SEO Meta Box Page
	================================================== */
	// $meta_boxes[] = array(
	// 	'id'    => 'seo_meta_box_page',
	// 	'title' => __('SEO Optimization', SS_DOMAIN),
	// 	'pages' => array( 'post', 'portfolio', 'product', 'page' ),
	// 	'priority' => 'low',
	// 	'fields' => array(
	
	// 			// KEYWORD
	// 			array(
	// 				'name' => __('Keyword', SS_DOMAIN),
	// 				'id'   => $prefix . "seo_keyword",
	// 				'type' => 'text',
	// 				'std'  => '',
	// 				'clone' => false,
	// 				'desc' => __('SEO Keywords Enter (comma-separated) your top keywords used in the content', SS_DOMAIN),
	// 			),
	
	// 			array(
	// 				'name' => __('Description', SS_DOMAIN),
	// 				'id'   => $prefix . "seo_description",
	// 				'type' => 'textarea',
	// 				'std'  => '',
	// 				'clone' => false,
	// 				'desc' => __('Describe correctly (and briefly - up to 160 chars) your <strong>post content</strong> and have more chances to rank higher in Search Engines', SS_DOMAIN),
	// 			),
	// 			array(
	// 				'name' => __('Meta Robots Index', SS_DOMAIN),
	// 				'id'   => $prefix . "seo_meta_robots_index",
	// 				'type' => 'radio',
	// 				'std'  => '',
	// 				'clone' => false,
	// 				'desc' => __('Allow search engines to index this page', SS_DOMAIN),
	// 				'options' => array(
	// 					'0'		=> __('None',SS_DOMAIN),
	// 					'1'		=> __('Yes', SS_DOMAIN),
	// 					'2'		=> __('No', SS_DOMAIN),
	// 				),
	// 			),
	// 			array(
	// 				'name' => __('Meta Robots Follow:', SS_DOMAIN),
	// 				'id'   => $prefix . "seo_meta_robots_follow",
	// 				'type' => 'radio',
	// 				'std'  => '',
	// 				'clone' => false,
	// 				'desc' => __('Allow search engines to follow thinks in this page', SS_DOMAIN),
	// 				'options' => array(
	// 					'0'		=> __('None',SS_DOMAIN),
	// 					'1'		=> __('Yes', SS_DOMAIN),
	// 					'2'		=> __('No', SS_DOMAIN),
	// 				),
	// 			),
	// 			array(
	// 				'name' => __('Canocal URL', SS_DOMAIN),
	// 				'id' => $prefix . '_seo_meta_canonical_url',
	// 				'desc' => __('Enter the canocal url.', SS_DOMAIN),
	// 				'clone' => false,
	// 				'type'  => 'text',
	// 				'std' => '',
	// 			),


	// 		)
	// );


	/* Thumbnail Meta Box
	================================================== */
	$meta_boxes[] = array(
		'id' => 'thumbnail_meta_box',
		'title' => __('Thumbnail', SS_DOMAIN),
		'pages' => array( 'post' ),
		'context' => 'normal',
		'fields' => array(

			// THUMBNAIL TYPE
			array(
				'name' => __('Thumbnail type', SS_DOMAIN),
				'id'   => $prefix . "thumbnail_type",
				'type' => 'select',
				'options' => array(
					'none'		=> 'None',
					'image'		=> 'Image',
					'video'		=> 'Video',
					'slider'	=> 'Slider',
					'audio'		=> 'Audio',
					'sh-video'	=> 'Self Hosted Video'
				),
				'multiple' => false,
				'std'  => $default_thumb_media,
				'desc' => __('Choose what will be used for the item thumbnail.', SS_DOMAIN)
			),

			// THUMBNAIL IMAGE
			array(
				'name'  => __('Thumbnail image', SS_DOMAIN),
				'desc'  => __('The image that will be used as the thumbnail image.', SS_DOMAIN),
				'id'    => $prefix . "thumbnail_image",
				'type'  => 'image_advanced',
				'max_file_uploads' => 1
			),

			// THUMBNAIL VIDEO
			array(
				'name' => __('Thumbnail video URL', SS_DOMAIN),
				'id' => $prefix . 'thumbnail_video_url',
				'desc' => __('Enter the video url for the thumbnail. Only links from Vimeo & YouTube are supported.', SS_DOMAIN),
				'clone' => false,
				'type'  => 'text',
				'std' => '',
			),

			// THUMBNAIL AUDIO
			array(
				'name' => __('Thumbnail audio URL', SS_DOMAIN),
				'id' => $prefix . 'thumbnail_audio_url',
				'desc' => __('Enter the audio url for the thumbnail.', SS_DOMAIN),
				'clone' => false,
				'type'  => 'text',
				'std' => '',
			),

			// THUMBNAIL SELF HOSTED VIDEO
			array(
				'name' => __('Thumbnail Self Hosted Video MP4 URL', SS_DOMAIN),
				'id' => $prefix . 'thumbnail_video_mp4',
				'desc' => __('Enter the video mp4 url for the thumbnail.', 'swiftframework'),
				'clone' => false,
				'type'  => 'text',
				'std' => '',
			),
			array(
				'name' => __('Thumbnail Self Hosted Video WEBM URL', SS_DOMAIN),
				'id' => $prefix . 'thumbnail_video_webm',
				'desc' => __('Enter the video webm url for the thumbnail.', SS_DOMAIN),
				'clone' => false,
				'type'  => 'text',
				'std' => '',
			),
			array(
				'name' => __('Thumbnail Self Hosted Video OGG URL', SS_DOMAIN),
				'id' => $prefix . 'thumbnail_video_ogg',
				'desc' => __('Enter the video ogg url for the thumbnail.', SS_DOMAIN),
				'clone' => false,
				'type'  => 'text',
				'std' => '',
			),

			// THUMBNAIL GALLERY
			array(
				'name'             => __('Thumbnail gallery', SS_DOMAIN),
				'desc'             => __('The images that will be used in the thumbnail gallery.', SS_DOMAIN),
				'id'               => "{$prefix}thumbnail_gallery",
				'type'             => 'image_advanced',
				'max_file_uploads' => 50,
			),

			// THUMBNAIL LINK TYPE
			array(
				'name' => __('Thumbnail link type', SS_DOMAIN),
				'id'   => "{$prefix}thumbnail_link_type",
				'type' => 'select',
				'options' => array(
					'link_to_post'		=> __('Link to item', SS_DOMAIN),
					'link_to_url'		=> __('Link to URL', SS_DOMAIN),
					'link_to_url_nw'	=> __('Link to URL (New Window)', SS_DOMAIN),
					'lightbox_thumb'	=> __('Lightbox to the thumbnail image', SS_DOMAIN),
					'lightbox_image'	=> __('Lightbox to image (select below)', SS_DOMAIN),
					'lightbox_video'	=> __('Fullscreen Video Overlay (input below)', SS_DOMAIN)
				),
				'multiple' => false,
				'std'  => 'link-to-post',
				'desc' => __('Choose what link will be used for the image(s) and title of the item.', SS_DOMAIN)
			),

			// THUMBNAIL LINK URL
			array(
				'name' => __('Thumbnail link URL', SS_DOMAIN),
				'id' => $prefix . 'thumbnail_link_url',
				'desc' => __('Enter the url for the thumbnail link.', SS_DOMAIN),
				'clone' => false,
				'type'  => 'text',
				'std' => '',
			),

			// THUMBNAIL LINK LIGHTBOX IMAGE
			array(
				'name'  => __('Thumbnail link lightbox image', SS_DOMAIN),
				'desc'  => __('The image that will be used as the lightbox image.', SS_DOMAIN),
				'id'    => "{$prefix}thumbnail_link_image",
				'type'  => 'image_advanced',
				'max_file_uploads' => 1
			),

			// THUMBNAIL LINK LIGHTBOX VIDEO
			array(
				'name' => __('Thumbnail link lightbox video URL', SS_DOMAIN),
				'id' => $prefix . 'thumbnail_link_video_url',
				'desc' => __('Enter the video url for the thumbnail lightbox. Only links from Vimeo & YouTube are supported.', SS_DOMAIN),
				'clone' => false,
				'type'  => 'text',
				'std' => '',
			)
		)
	);

	/* Detail Media Meta Box
		================================================== */
	$meta_boxes[] = array(
		'id' => 'detail_media_meta_box',
		'title' => __('Detail Media', SS_DOMAIN),
		'pages' => array( 'post', 'portfolio' ),
		'context' => 'normal',
		'fields' => array(

			// USE THUMBNAIL CONTENT FOR THE MAIN DETAIL DISPLAY
			array(
				'name' => __('Use the thumbnail content', SS_DOMAIN),    // File type: checkbox
				'id'   => $prefix ."thumbnail_content_main_detail",
				'type' => 'checkbox',
				'desc' => __('Uncheck this box if you wish to select different media for the main detail display.', SS_DOMAIN),
				'std' => 0,
			),

			// DETAIL TYPE
			array(
				'name' => __('Detail type', SS_DOMAIN),
				'id'   => $prefix . "detail_type",
				'type' => 'select',
				'options' => array(
					'none'		=> __('None', SS_DOMAIN),
					'image'		=> __('Image', SS_DOMAIN),
					'video'		=> __('Video', SS_DOMAIN),
					'slider'	=> __('Standard Slider', SS_DOMAIN),
					'gallery-stacked'	=> __('Stacked Gallery', SS_DOMAIN),
					'layer-slider' => __('Revolution/Layer Slider', SS_DOMAIN),
					'audio' => __('Audio', SS_DOMAIN),
					'sh-video' => __('Self Hosted Video', SS_DOMAIN),
					'custom' => __('Custom', SS_DOMAIN)
				),
				'multiple' => false,
				'std'  => $default_detail_media,
				'desc' => __('Choose what will be used for the item detail media.', SS_DOMAIN)
			),

			// DETAIL IMAGE
			array(
				'name'  => __('Detail image', SS_DOMAIN),
				'desc'  => __('The image that will be used as the detail image.', SS_DOMAIN),
				'id'    => $prefix . "detail_image",
				'type'  => 'image_advanced',
				'max_file_uploads' => 1
			),

			// DETAIL VIDEO
			array(
				'name' => __('Detail video URL', SS_DOMAIN),
				'id' => $prefix . 'detail_video_url',
				'desc' => __('Enter the video url for the detail display. Only links from Vimeo & YouTube are supported.', SS_DOMAIN),
				'clone' => false,
				'type'  => 'text',
				'std' => '',
			),

			// DETAIL AUDIO
			array(
				'name' => __('Detail audio URL', SS_DOMAIN),
				'id' => $prefix . 'detail_audio_url',
				'desc' => __('Enter the audio url for the detail display.', SS_DOMAIN),
				'clone' => false,
				'type'  => 'text',
				'std' => '',
			),

			// DETAIL SELF HOSTED VIDEO
			array(
				'name' => __('Detail Self Hosted Video MP4 URL', SS_DOMAIN),
				'id' => $prefix . 'detail_video_mp4',
				'desc' => __('Enter the video mp4 url for the detail display.', SS_DOMAIN),
				'clone' => false,
				'type'  => 'text',
				'std' => '',
			),
			array(
				'name' => __('Detail Self Hosted Video WEBM URL', SS_DOMAIN),
				'id' => $prefix . 'detail_video_webm',
				'desc' => __('Enter the video webm url for the detail display.', SS_DOMAIN),
				'clone' => false,
				'type'  => 'text',
				'std' => '',
			),
			array(
				'name' => __('Detail Self Hosted Video OGG URL', SS_DOMAIN),
				'id' => $prefix . 'detail_video_ogg',
				'desc' => __('Enter the video ogg url for the detail display.', SS_DOMAIN),
				'clone' => false,
				'type'  => 'text',
				'std' => '',
			),

			// DETAIL GALLERY
			array(
				'name'             => __('Post detail gallery', SS_DOMAIN),
				'desc'             => __('The images that will be used in the detail gallery.', SS_DOMAIN),
				'id'               => "{$prefix}detail_gallery",
				'type'             => 'image_advanced',
				'max_file_uploads' => 50,
			),

			// DETAIL REV SLIDER
			array(
				'name' => __('Revolution slider alias', SS_DOMAIN),
				'id' => $prefix . 'detail_rev_slider_alias',
				'desc' => __("Enter the revolution slider alias for the slider that you want to show.", SS_DOMAIN),
				'clone' => false,
				'type'  => 'text',
				'std' => '',
			),

			// DETAIL LAYER SLIDER
			array(
				'name' => __('Layer Slider alias', SS_DOMAIN),
				'id' => $prefix . 'detail_layer_slider_alias',
				'desc' => __("Enter the Layer Slider ID for the slider that you want to show.", SS_DOMAIN),
				'clone' => false,
				'type'  => 'text',
				'std' => '',
			),

			// DETAIL CUSTOM
			array(
				'name' => __('Custom detail display', SS_DOMAIN),
				'desc' => __("If you'd like to provide your own detail media, please add it here", SS_DOMAIN),
				'id'   => $prefix . "custom_media",
				'type' => 'textarea',
				'std'  => "",
				'cols' => '40',
				'rows' => '8',
			),
		)
	);

	$meta_boxes[] = array(
		'id' => 'portfolio_meta_box',
		'title' => __('Portfolio Meta', SS_DOMAIN),
		'pages' => array( 'portfolio' ),
		'context' => 'normal',
		'fields' => array(

			// Client Text
			array(
				'name' => __('Client', SS_DOMAIN),
				'id' => $prefix . 'portfolio_client',
				'desc' => __("Enter a client for use within the portfolio item index (optional).", SS_DOMAIN),
				'clone' => false,
				'type'  => 'text',
				'std' => '',
			),

			// Sub Text
			array(
				'name' => __('Subtitle', SS_DOMAIN),
				'id' => $prefix . 'portfolio_subtitle',
				'desc' => __("Enter a subtitle for use within the portfolio item index (optional).", SS_DOMAIN),
				'clone' => false,
				'type'  => 'text',
				'std' => '',
			),

			// External Link
			array(
				'name' => __('External Link', SS_DOMAIN),
				'id' => $prefix . 'portfolio_external_link',
				'desc' => __("Enter an external link for the item  (optional) (NOTE: INCLUDE HTTP://).", SS_DOMAIN),
				'clone' => false,
				'type'  => 'text',
				'std' => '',
			),

			// CUSTOM EXCERPT
			array(
				'name' => __('Custom excerpt', SS_DOMAIN),
				'desc' => __("You can optionally write a custom excerpt here to display instead of the excerpt that is automatically generated. If you use the page builder, then you'll want to add content to this box.", SS_DOMAIN),
				'id'   => $prefix . "custom_excerpt",
				'type' => 'textarea',
				'std'  => "",
				'cols' => '40',
				'rows' => '8',
			),
		)
	);
	
	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'ss_register_meta_boxes' );