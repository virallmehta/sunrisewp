(function($){
	
	var $page_title_style = $('#ss_page_title_style');
	var	$page_title_image = $('#ss_page_title_image-description').parent().parent();
	var $page_title_background_color = $('#ss_page_title_bg_color').parent().parent();
	var	$page_title_text_color = $('#ss_page_title_text_color').parent().parent();
	var	$page_title_text_align = $('#ss_page_title_text_align').parent().parent();
	var	$page_title_height = $('#ss_page_title_height').parent().parent();

	if ($page_title_style.val() == 'none') {
		$page_title_image.css('display', 'none');
		$page_title_background_color.css('display', 'none');
		$page_title_text_color.css('display', 'none');
		$page_title_text_align.css('display', 'none');
		$page_title_height.css('display', 'none');
	
	} else if ($page_title_style.val() == "standard") {
		$page_title_image.css('display', 'none');
	}

	$page_title_style.change(function() {
		if ($(this).val() == "none" ) {
			$page_title_image.css('display', 'none');
			$page_title_background_color.css('display', 'none');
			$page_title_text_color.css('display', 'none');
			$page_title_text_align.css('display', 'none');
			$page_title_height.css('display', 'none');
		} else if ($(this).val() == "standard") {
			$page_title_image.css('display', 'none');
			$page_title_background_color.css('display', 'block');
			$page_title_text_color.css('display', 'block');
			$page_title_text_align.css('display', 'none');
			$page_title_height.css('display', 'none');
		} else if ($(this).val() == "image") {
			$page_title_image.css('display', 'block');
			$page_title_background_color.css('display', 'none');
			$page_title_text_color.css('display', 'block');
			$page_title_text_align.css('display', 'block');
			$page_title_height.css('display', 'block');
		} else {
			$page_title_image.css('display', 'none');
			$page_title_background_color.css('display', 'none');
			$page_title_text_color.css('display', 'none');
			$page_title_text_align.css('display', 'none');
			$page_title_height.css('display', 'none');
		}

	});

	var $sidebar_config = $('#ss_sidebar_config');
	var $left_sidebar = $('#ss_left_sidebar').parent().parent();
	var	$right_sidebar = $('#ss_right_sidebar').parent().parent();

	if ($sidebar_config.val() == "no-sidebars") {
		$left_sidebar.css('display', 'none');
		$right_sidebar.css('display', 'none');
	} else if ($sidebar_config.val() == "left-sidebar") {
		$left_sidebar.css('display', 'block');
		$right_sidebar.css('display', 'none');
	} else if ($sidebar_config.val() == "right-sidebar") {
		$right_sidebar.css('display', 'block');
		$left_sidebar.css('display', 'none');
	} else if ($sidebar_config.val() == "both-sidebars") {
		$left_sidebar.css('display', 'block');
		$right_sidebar.css('display', 'block');
	}

	$sidebar_config.change(function() {
		if ($(this).val() == "no-sidebars") {
	  		$left_sidebar.css('display', 'none');
	  		$right_sidebar.css('display', 'none');
	  	} else if ($(this).val() == "left-sidebar") {
	  		$left_sidebar.css('display', 'block');
	  		$right_sidebar.css('display', 'none');
	  	} else if ($(this).val() == "right-sidebar") {
	  		$right_sidebar.css('display', 'block');
	  		$left_sidebar.css('display', 'none');
	  	} else if ($(this).val() == "both-sidebars") {
	  		$left_sidebar.css('display', 'block');
	  		$right_sidebar.css('display', 'block');
	  	}
	});

	var $thumb_type = $('#ss_thumbnail_type');
	var	$thumb_image = $('#ss_thumbnail_image-description').parent().parent();
	var	$thumb_video = $('#ss_thumbnail_video_url').parent().parent();
	var	$thumb_gallery = $('#ss_thumbnail_gallery-description').parent().parent();
	var	$thumb_audio = $('#ss_thumbnail_audio_url').parent().parent();
	var	$thumb_videomp4 = $('#ss_thumbnail_video_mp4').parent().parent();
	var	$thumb_videoogg = $('#ss_thumbnail_video_ogg').parent().parent();
	var	$thumb_videowebm = $('#ss_thumbnail_video_webm').parent().parent();

	if ($thumb_type.val() == "none") {
		$thumb_image.css('display', 'none');
		$thumb_video.css('display', 'none');
		$thumb_gallery.css('display', 'none');
		$thumb_audio.css('display', 'none');
		$thumb_videomp4.css('display', 'none');
		$thumb_videoogg.css('display', 'none');
		$thumb_videowebm.css('display', 'none');
	} else if ($thumb_type.val() == "image") {
		$thumb_image.css('display', 'block');
		$thumb_video.css('display', 'none');
		$thumb_gallery.css('display', 'none');
		$thumb_audio.css('display', 'none');
		$thumb_videomp4.css('display', 'none');
		$thumb_videoogg.css('display', 'none');
		$thumb_videowebm.css('display', 'none');
	} else if ($thumb_type.val() == "video") {
		$thumb_image.css('display', 'none');
		$thumb_video.css('display', 'block');
		$thumb_gallery.css('display', 'none');
		$thumb_audio.css('display', 'none');
		$thumb_videomp4.css('display', 'none');
		$thumb_videoogg.css('display', 'none');
		$thumb_videowebm.css('display', 'none');
	} else if ($thumb_type.val() == "slider") {
		$thumb_image.css('display', 'none');
		$thumb_video.css('display', 'none');
		$thumb_gallery.css('display', 'block');
		$thumb_audio.css('display', 'none');
		$thumb_videomp4.css('display', 'none');
		$thumb_videoogg.css('display', 'none');
		$thumb_videowebm.css('display', 'none');
	} else if ($thumb_type.val() == "audio") {
		$thumb_image.css('display', 'none');
		$thumb_video.css('display', 'none');
		$thumb_gallery.css('display', 'none');
		$thumb_audio.css('display', 'block');
		$thumb_videomp4.css('display', 'none');
		$thumb_videoogg.css('display', 'none');
		$thumb_videowebm.css('display', 'none');
	} else if ($thumb_type.val() == "sh-video") {
		$thumb_image.css('display', 'none');
		$thumb_video.css('display', 'none');
		$thumb_gallery.css('display', 'none');
		$thumb_audio.css('display', 'none');
		$thumb_videomp4.css('display', 'block');
		$thumb_videoogg.css('display', 'block');
		$thumb_videowebm.css('display', 'block');
	}

	$thumb_type.change(function() {
		if ($(this).val() == "none") {
			$thumb_image.css('display', 'none');
			$thumb_video.css('display', 'none');
			$thumb_gallery.css('display', 'none');
			$thumb_audio.css('display', 'none');
			$thumb_videomp4.css('display', 'none');
			$thumb_videoogg.css('display', 'none');
			$thumb_videowebm.css('display', 'none');
		} else if ($(this).val() == "image") {
			$thumb_image.css('display', 'block');
			$thumb_video.css('display', 'none');
			$thumb_gallery.css('display', 'none');
			$thumb_audio.css('display', 'none');
			$thumb_videomp4.css('display', 'none');
			$thumb_videoogg.css('display', 'none');
			$thumb_videowebm.css('display', 'none');
		} else if ($(this).val() == "video") {
			$thumb_image.css('display', 'none');
			$thumb_video.css('display', 'block');
			$thumb_gallery.css('display', 'none');
			$thumb_audio.css('display', 'none');
			$thumb_videomp4.css('display', 'none');
			$thumb_videoogg.css('display', 'none');
			$thumb_videowebm.css('display', 'none');
		} else if ($(this).val() == "slider") {
			$thumb_image.css('display', 'none');
			$thumb_video.css('display', 'none');
			$thumb_gallery.css('display', 'block');
			$thumb_audio.css('display', 'none');
			$thumb_videomp4.css('display', 'none');
			$thumb_videoogg.css('display', 'none');
			$thumb_videowebm.css('display', 'none');
		} else if ($(this).val() == "audio") {
			$thumb_image.css('display', 'none');
			$thumb_video.css('display', 'none');
			$thumb_gallery.css('display', 'none');
			$thumb_audio.css('display', 'block');
			$thumb_videomp4.css('display', 'none');
			$thumb_videoogg.css('display', 'none');
			$thumb_videowebm.css('display', 'none');
		} else if ($(this).val() == "sh-video") {
			$thumb_image.css('display', 'none');
			$thumb_video.css('display', 'none');
			$thumb_gallery.css('display', 'none');
			$thumb_audio.css('display', 'none');
			$thumb_videomp4.css('display', 'block');
			$thumb_videoogg.css('display', 'block');
			$thumb_videowebm.css('display', 'block');
		}
	});

	var $link_type = $('#ss_thumbnail_link_type');
	var	$link_url = $('#ss_thumbnail_link_url').parent().parent();
	var	$link_image = $('#sss_thumbnail_link_image-description').parent().parent();
	var	$link_video = $('#ss_thumbnail_link_video_url').parent().parent();

	if ($link_type.val() == "link_to_post") {
		$link_url.css('display', 'none');
		$link_image.css('display', 'none');
		$link_video.css('display', 'none');
	} else if ($link_type.val() == "link_to_url" || $link_type.val() == "link_to_url_nw" ) {
		$link_url.css('display', 'block');
		$link_image.css('display', 'none');
		$link_video.css('display', 'none');
	} else if ($link_type.val() == "lightbox_thumb") {
		$link_url.css('display', 'none');
		$link_image.css('display', 'none');
		$link_video.css('display', 'none');
	} else if ($link_type.val() == "lightbox_image") {
		$link_url.css('display', 'none');
		$link_image.css('display', 'block');
		$link_video.css('display', 'none');
	} else if ($link_type.val() == "lightbox_video") {
		$link_url.css('display', 'none');
		$link_image.css('display', 'none');
		$link_video.css('display', 'block');
	}

	$link_type.change(function() {	
		if ($(this).val() == "link_to_post") {
			$link_url.css('display', 'none');
			$link_image.css('display', 'none');
			$link_video.css('display', 'none');
		} else if ($(this).val() == "link_to_url" || $link_type.val() == "link_to_url_nw") {
			$link_url.css('display', 'block');
			$link_image.css('display', 'none');
			$link_video.css('display', 'none');
		} else if ($(this).val() == "lightbox_thumb") {
			$link_url.css('display', 'none');
			$link_image.css('display', 'none');
			$link_video.css('display', 'none');
		} else if ($(this).val() == "lightbox_image") {
			$link_url.css('display', 'none');
			$link_image.css('display', 'block');
			$link_video.css('display', 'none');
		} else if ($(this).val() == "lightbox_video") {
			$link_url.css('display', 'none');
			$link_image.css('display', 'none');
			$link_video.css('display', 'block');
		}
	});

	var $use_thumb_content = $('#ss_thumbnail_content_main_detail');
	var	$detail_type = $('#ss_detail_type');
	var	$detail_image = $('#ss_detail_image-description').parent().parent();
	var	$detail_video = $('#ss_detail_video_url').parent().parent();
	var	$detail_gallery = $('#ss_detail_gallery-description').parent().parent();
	var	$detail_slider = $('#ss_detail_rev_slider_alias').parent().parent();
	var	$detail_layerslider = $('#ss_detail_layer_slider_alias').parent().parent();
	var	$detail_custom = $('#ss_custom_media').parent().parent();
	var	$detail_audio = $('#ss_detail_audio_url').parent().parent();
	var	$detail_videomp4 = $('#ss_detail_video_mp4').parent().parent();
	var	$detail_videoogg = $('#ss_detail_video_ogg').parent().parent();
	var	$detail_videowebm = $('#ss_detail_video_webm').parent().parent();

	if ($use_thumb_content.is(':checked')) {
		$detail_type.parent().parent().css('display', 'none');
		$detail_image.css('display', 'none');
		$detail_video.css('display', 'none');
		$detail_gallery.css('display', 'none');
		$detail_slider.css('display', 'none');
		$detail_layerslider.css('display', 'none');
		$detail_custom.css('display', 'none');
		$detail_audio.css('display', 'none');
		$detail_videomp4.css('display', 'none');
		$detail_videoogg.css('display', 'none');
		$detail_videowebm.css('display', 'none');
	} else {
		$detail_type.parent().parent().css('display', 'block');
		if ($detail_type.val() == "none") {
			$detail_image.css('display', 'none');
			$detail_video.css('display', 'none');
			$detail_gallery.css('display', 'none');
			$detail_slider.css('display', 'none');
			$detail_layerslider.css('display', 'none');
			$detail_custom.css('display', 'none');
			$detail_audio.css('display', 'none');
			$detail_videomp4.css('display', 'none');
			$detail_videoogg.css('display', 'none');
			$detail_videowebm.css('display', 'none');
		} else if ($detail_type.val() == "image") {
			$detail_image.css('display', 'block');
			$detail_video.css('display', 'none');
			$detail_gallery.css('display', 'none');
			$detail_slider.css('display', 'none');
			$detail_layerslider.css('display', 'none');
			$detail_custom.css('display', 'none');
			$detail_audio.css('display', 'none');
			$detail_videomp4.css('display', 'none');
			$detail_videoogg.css('display', 'none');
			$detail_videowebm.css('display', 'none');
		} else if ($detail_type.val() == "video") {
			$detail_image.css('display', 'none');
			$detail_video.css('display', 'block');
			$detail_gallery.css('display', 'none');
			$detail_slider.css('display', 'none');
			$detail_layerslider.css('display', 'none');
			$detail_custom.css('display', 'none');
			$detail_audio.css('display', 'none');
			$detail_videomp4.css('display', 'none');
			$detail_videoogg.css('display', 'none');
			$detail_videowebm.css('display', 'none');
		} else if ($detail_type.val() == "slider" || $detail_type.val() == "gallery-stacked") {
			$detail_image.css('display', 'none');
			$detail_video.css('display', 'none');
			$detail_gallery.css('display', 'block');
			$detail_slider.css('display', 'none');
			$detail_layerslider.css('display', 'none');
			$detail_custom.css('display', 'none');
			$detail_audio.css('display', 'none');
			$detail_videomp4.css('display', 'none');
			$detail_videoogg.css('display', 'none');
			$detail_videowebm.css('display', 'none');
		} else if ($detail_type.val() == "layer-slider") {
			$detail_image.css('display', 'none');
			$detail_video.css('display', 'none');
			$detail_gallery.css('display', 'none');
			$detail_slider.css('display', 'block');
			$detail_layerslider.css('display', 'block');
			$detail_custom.css('display', 'none');
			$detail_audio.css('display', 'none');
			$detail_videomp4.css('display', 'none');
			$detail_videoogg.css('display', 'none');
			$detail_videowebm.css('display', 'none');
		} else if ($detail_type.val() == "custom") {
			$detail_image.css('display', 'none');
			$detail_video.css('display', 'none');
			$detail_gallery.css('display', 'none');
			$detail_slider.css('display', 'none');
			$detail_layerslider.css('display', 'none');
			$detail_custom.css('display', 'block');
			$detail_audio.css('display', 'none');
			$detail_videomp4.css('display', 'none');
			$detail_videoogg.css('display', 'none');
			$detail_videowebm.css('display', 'none');
		} else if ($detail_type.val() == "audio") {
			$detail_image.css('display', 'none');
			$detail_video.css('display', 'none');
			$detail_gallery.css('display', 'none');
			$detail_slider.css('display', 'none');
			$detail_layerslider.css('display', 'none');
			$detail_custom.css('display', 'none');
			$detail_audio.css('display', 'block');
			$detail_videomp4.css('display', 'none');
			$detail_videoogg.css('display', 'none');
			$detail_videowebm.css('display', 'none');
		} else if ($detail_type.val() == "sh-video") {
			$detail_image.css('display', 'none');
			$detail_video.css('display', 'none');
			$detail_gallery.css('display', 'none');
			$detail_slider.css('display', 'none');
			$detail_layerslider.css('display', 'none');
			$detail_custom.css('display', 'none');
			$detail_audio.css('display', 'none');
			$detail_videomp4.css('display', 'block');
			$detail_videoogg.css('display', 'block');
			$detail_videowebm.css('display', 'block');
		}
	}

	$use_thumb_content.change(function() {
		if ($use_thumb_content.is(':checked')) {
			$detail_type.parent().parent().css('display', 'none');
			$detail_image.css('display', 'none');
			$detail_video.css('display', 'none');
			$detail_gallery.css('display', 'none');
			$detail_slider.css('display', 'none');
			$detail_layerslider.css('display', 'none');
			$detail_custom.css('display', 'none');
			$detail_audio.css('display', 'none');
			$detail_videomp4.css('display', 'none');
			$detail_videoogg.css('display', 'none');
			$detail_videowebm.css('display', 'none');
		} else {
			$detail_type.parent().parent().css('display', 'block');
			if ($detail_type.val() == "none") {
				$detail_image.css('display', 'none');
				$detail_video.css('display', 'none');
				$detail_gallery.css('display', 'none');
				$detail_slider.css('display', 'none');
				$detail_layerslider.css('display', 'none');
				$detail_custom.css('display', 'none');
				$detail_audio.css('display', 'none');
				$detail_videomp4.css('display', 'none');
				$detail_videoogg.css('display', 'none');
				$detail_videowebm.css('display', 'none');
			} else if ($detail_type.val() == "image") {
				$detail_image.css('display', 'block');
				$detail_video.css('display', 'none');
				$detail_gallery.css('display', 'none');
				$detail_slider.css('display', 'none');
				$detail_layerslider.css('display', 'none');
				$detail_custom.css('display', 'none');
				$detail_audio.css('display', 'none');
				$detail_videomp4.css('display', 'none');
				$detail_videoogg.css('display', 'none');
				$detail_videowebm.css('display', 'none');
			} else if ($detail_type.val() == "video") {
				$detail_image.css('display', 'none');
				$detail_video.css('display', 'block');
				$detail_gallery.css('display', 'none');
				$detail_slider.css('display', 'none');
				$detail_layerslider.css('display', 'none');
				$detail_custom.css('display', 'none');
				$detail_audio.css('display', 'none');
				$detail_videomp4.css('display', 'none');
				$detail_videoogg.css('display', 'none');
				$detail_videowebm.css('display', 'none');
			} else if ($detail_type.val() == "slider" || $detail_type.val() == "gallery-stacked") {
				$detail_image.css('display', 'none');
				$detail_video.css('display', 'none');
				$detail_gallery.css('display', 'block');
				$detail_slider.css('display', 'none');
				$detail_layerslider.css('display', 'none');
				$detail_custom.css('display', 'none');
				$detail_audio.css('display', 'none');
				$detail_videomp4.css('display', 'none');
				$detail_videoogg.css('display', 'none');
				$detail_videowebm.css('display', 'none');
			} else if ($detail_type.val() == "layer-slider") {
				$detail_image.css('display', 'none');
				$detail_video.css('display', 'none');
				$detail_gallery.css('display', 'none');
				$detail_slider.css('display', 'block');
				$detail_layerslider.css('display', 'block');
				$detail_custom.css('display', 'none');
				$detail_audio.css('display', 'none');
				$detail_videomp4.css('display', 'none');
				$detail_videoogg.css('display', 'none');
				$detail_videowebm.css('display', 'none');
			} else if ($detail_type.val() == "custom") {
				$detail_image.css('display', 'none');
				$detail_video.css('display', 'none');
				$detail_gallery.css('display', 'none');
				$detail_slider.css('display', 'none');
				$detail_layerslider.css('display', 'none');
				$detail_custom.css('display', 'block');
				$detail_audio.css('display', 'none');
				$detail_videomp4.css('display', 'none');
				$detail_videoogg.css('display', 'none');
				$detail_videowebm.css('display', 'none');
			} else if ($detail_type.val() == "audio") {
				$detail_image.css('display', 'none');
				$detail_video.css('display', 'none');
				$detail_gallery.css('display', 'none');
				$detail_slider.css('display', 'none');
				$detail_layerslider.css('display', 'none');
				$detail_custom.css('display', 'none');
				$detail_audio.css('display', 'block');
				$detail_videomp4.css('display', 'none');
				$detail_videoogg.css('display', 'none');
				$detail_videowebm.css('display', 'none');
			} else if ($detail_type.val() == "sh-video") {
				$detail_image.css('display', 'none');
				$detail_video.css('display', 'none');
				$detail_gallery.css('display', 'none');
				$detail_slider.css('display', 'none');
				$detail_layerslider.css('display', 'none');
				$detail_custom.css('display', 'none');
				$detail_audio.css('display', 'none');
				$detail_videomp4.css('display', 'block');
				$detail_videoogg.css('display', 'block');
				$detail_videowebm.css('display', 'block');
			}
		}
	});
	
	$detail_type.change(function() {
		if ($use_thumb_content.is(':checked')) {
			$detail_type.parent().parent().css('display', 'none');
			$detail_image.css('display', 'none');
			$detail_video.css('display', 'none');
			$detail_gallery.css('display', 'none');
			$detail_slider.css('display', 'none');
			$detail_layerslider.css('display', 'none');
			$detail_audio.css('display', 'none');
			$detail_videomp4.css('display', 'none');
			$detail_videoogg.css('display', 'none');
			$detail_videowebm.css('display', 'none');
		} else {
			$detail_type.parent().parent().css('display', 'block');
			if ($(this).val() == "none") {
				$detail_image.css('display', 'none');
				$detail_video.css('display', 'none');
				$detail_gallery.css('display', 'none');
				$detail_slider.css('display', 'none');
				$detail_layerslider.css('display', 'none');
				$detail_custom.css('display', 'none');
				$detail_audio.css('display', 'none');
				$detail_videomp4.css('display', 'none');
				$detail_videoogg.css('display', 'none');
				$detail_videowebm.css('display', 'none');
			} else if ($(this).val() == "image") {
				$detail_image.css('display', 'block');
				$detail_video.css('display', 'none');
				$detail_gallery.css('display', 'none');
				$detail_slider.css('display', 'none');
				$detail_layerslider.css('display', 'none');
				$detail_custom.css('display', 'none');
				$detail_audio.css('display', 'none');
				$detail_videomp4.css('display', 'none');
				$detail_videoogg.css('display', 'none');
				$detail_videowebm.css('display', 'none');
			} else if ($(this).val() == "video") {
				$detail_image.css('display', 'none');
				$detail_video.css('display', 'block');
				$detail_gallery.css('display', 'none');
				$detail_slider.css('display', 'none');
				$detail_layerslider.css('display', 'none');
				$detail_custom.css('display', 'none');
				$detail_audio.css('display', 'none');
				$detail_videomp4.css('display', 'none');
				$detail_videoogg.css('display', 'none');
				$detail_videowebm.css('display', 'none');
			} else if ($(this).val() == "slider" || $detail_type.val() == "gallery-stacked") {
				$detail_image.css('display', 'none');
				$detail_video.css('display', 'none');
				$detail_gallery.css('display', 'block');
				$detail_slider.css('display', 'none');
				$detail_layerslider.css('display', 'none');
				$detail_custom.css('display', 'none');
				$detail_audio.css('display', 'none');
				$detail_videomp4.css('display', 'none');
				$detail_videoogg.css('display', 'none');
				$detail_videowebm.css('display', 'none');
			} else if ($(this).val() == "layer-slider") {
				$detail_image.css('display', 'none');
				$detail_video.css('display', 'none');
				$detail_gallery.css('display', 'none');
				$detail_slider.css('display', 'block');
				$detail_layerslider.css('display', 'block');
				$detail_custom.css('display', 'none');
				$detail_audio.css('display', 'none');
				$detail_videomp4.css('display', 'none');
				$detail_videoogg.css('display', 'none');
				$detail_videowebm.css('display', 'none');
			} else if ($detail_type.val() == "custom") {
				$detail_image.css('display', 'none');
				$detail_video.css('display', 'none');
				$detail_gallery.css('display', 'none');
				$detail_slider.css('display', 'none');
				$detail_layerslider.css('display', 'none');
				$detail_custom.css('display', 'block');
				$detail_audio.css('display', 'none');
				$detail_videomp4.css('display', 'none');
				$detail_videoogg.css('display', 'none');
				$detail_videowebm.css('display', 'none');
			} else if ($detail_type.val() == "audio") {
				$detail_image.css('display', 'none');
				$detail_video.css('display', 'none');
				$detail_gallery.css('display', 'none');
				$detail_slider.css('display', 'none');
				$detail_layerslider.css('display', 'none');
				$detail_custom.css('display', 'none');
				$detail_audio.css('display', 'block');
				$detail_videomp4.css('display', 'none');
				$detail_videoogg.css('display', 'none');
				$detail_videowebm.css('display', 'none');
			} else if ($detail_type.val() == "sh-video") {
				$detail_image.css('display', 'none');
				$detail_video.css('display', 'none');
				$detail_gallery.css('display', 'none');
				$detail_slider.css('display', 'none');
				$detail_layerslider.css('display', 'none');
				$detail_custom.css('display', 'none');
				$detail_audio.css('display', 'none');
				$detail_videomp4.css('display', 'block');
				$detail_videoogg.css('display', 'block');
				$detail_videowebm.css('display', 'block');
			}
		}
	});

})(jQuery);	