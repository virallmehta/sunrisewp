<?php

// "do_shortcode" but without the wrapping <p> of Shortcodes
function do_shortcode_con($content) {

	$array = array(
        '<p>['    => '[',
        ']</p>'   => ']',
        ']<br />' => ']'
    );
    return strtr( $content, $array );
}

// Button Link
add_shortcode('button', 'shortcode_button');
function shortcode_button($atts, $content = null){

	$atts = shortcode_atts(
			array(
				'css_classes' => '',
				'href' 		  => '',
				'target' 	  => '',
			), $atts);	

	$target = ($atts['target'] ? " target='".$atts['target']."'" : '');

    return '<a href="'.$atts["href"].'" role="button" class="btn '.$atts["css_classes"].'" '.$target.'>'. do_shortcode_con($content) .'</a>';
}

// Heading
add_shortcode('heading', 'shortcode_heading');
function shortcode_heading( $atts, $content = null ) {

	$atts = shortcode_atts(
		array(
			'class' => '',
		), $atts);
		
	return '<h2 class="shortcode_title '. $atts['class'] . ' "><span>'.do_shortcode_con($content).'</span></h2>';
}

// Icon
add_shortcode('icon', 'shortcode_icon');
function shortcode_icon($atts, $content = null) {
	
	extract(shortcode_atts(
		array(
			'icon'  => 'fa-heart',
			'color' => '',		
			'size'  => '',
			'style' => 'none',
			'class' => '',
		), $atts));
	
	switch ($atts['style']) {
		case 'none':
			$style = 'none';
			break;
		case 'circle':
			$style = 'circle';
			break;
		case 'square':
			$style = 'square';
			break;
		case 'rounded':
			$style = 'rounded';
			break;
		default:
			$style = 'none';
			break;
	}

	$str='<div class="shortcode_icon"><div class="' . $size . ' ' . $color .  ' ' . $style . ' ' . $atts['class'] . ' "><i class="fa '.$icon.'"></i></div></div>';
	return $str;
}

// Youtube shortcode
add_shortcode('youtube', 'shortcode_youtube');
function shortcode_youtube($atts) {
	$atts = shortcode_atts(
		array(
			'url' 	 => '',
			'width'  => '',
			'height' => ''
		), $atts);
	
		return '<div class="shortcode_video video_max_scale">' . artooz_video_youtube( $url, $atts['width'], $atts['height'] ) . '</div>';
}
	
// Vimeo shortcode
add_shortcode('vimeo', 'shortcode_vimeo');
function shortcode_vimeo($atts) {
	$atts = shortcode_atts(
		array(
			'url' 	 => '',
			'width'  => '',
			'height' => ''
		), $atts);
	
		return '<div class="shortcode_video video_max_scale">' . artooz_video_vimeo( $url, $atts['width'], $atts['height'] ) . '</div>';
}

// Text box
add_shortcode('text_box', 'shortcode_text_box');
function shortcode_text_box( $atts, $content = null ) {
	
	$atts = shortcode_atts(
		array(
			'title' => '',
		), $atts);
		
	$title = $atts['title'];

	$str  = '	<div class="text_box ">
					<h2 class="title">'.$title.'</h2>
					<p>'. do_shortcode_con($content) .'</p>
				</div>';

	return $str;
}

add_shortcode('checklist', 'shortcode_checklist');
function shortcode_checklist( $atts, $content = null ) {
	
	$atts = shortcode_atts(
		array(
			'type'	 => 'checked',
			'icon'	 => '',
			'margin_bottom' => 'no'
		), $atts);
		
	$margin = (($atts["margin_bottom"]=='yes')||($atts["margin_bottom"]=='Yes')) ? "<div class='h20'></div>" : '';
		
	 switch ($atts['type']){
    	case 'checked': $type = 'checked'; break;
    	case 'checked2': $type = 'checked2'; break;
    	case 'arrowed': $type = 'arrowed'; break;
    	case 'dotted': $type = 'dotted'; break;
    	case 'custom_list': $type = 'dotted'; break;
    	default : $type = 'checked'; break;
	 }

	return str_replace('<ul class="checked">', '<ul class="'.$type.'">', do_shortcode_con($content)).$margin;
}

