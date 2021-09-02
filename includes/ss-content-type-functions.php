<?php
if ( ! defined( 'ABSPATH' ) ) :
    exit; // Exit if accessed directly
endif;

/*
 *  ss_video_post()
 *  ss_video_embed()
 *  ss_video_youtube()
 *  ss_video_vimeo()
 *  ss_get_embed_src()
 *  ss_get_vimeoid()
 *  ss_get_post_format_image_src()
 *  ss_get_attachment_meta()
 *  ss_get_image_meta()
 *  ss_get_post_media()
 *  ss_image_post()
 *  ss_audio_post()
 *  ss_sh_video_post()
 *  ss_gallery_post()
 *  ss_gallery_stacked_post()
 *  ss_link_post()
 *  ss_chat_post()
 *  ss_get_post_meta_details()
 *  ss_post_thumbnail()
 *  ss_post_item_link()
 *  ss_post_detail_media()
 *  ss_post_pagination()
 *  ss_post_info()
 *  ss_post_top_author()
 *  ss_get_post_item()
 *  ss_get_standard_post()
 *  ss_get_masonry_post()
 *  ss_portfolio_filter()
 *  ss_portfolio_thumbnail()
 *  ss_portfolio_items()
 *  ss_portfolio_item_link()
 *  ss_portfolio_detail_media()
 *  ss_portfolio_item_details()
 */
    
    if ( ! function_exists( 'ss_video_post' ) ) {
        function ss_video_post( $postID, $media_width, $video_height, $use_thumb_content ) {

            $video = $media_video = "";

            if ( $use_thumb_content ) {
                $media_video = ss_get_post_meta( $postID, 'ss_thumbnail_video_url', true );
            } else {
                $media_video = ss_get_post_meta( $postID, 'ss_detail_video_url', true );
            }

            $video = ss_video_embed( $media_video, $media_width, $video_height );

            return $video;
        }
    }


    if ( ! function_exists( 'ss_video_embed' ) ) {
        function ss_video_embed( $url, $width = 640, $height = 480 ) {
            if ( strpos( $url, 'youtube' ) ) {
                return ss_video_youtube( $url, $width, $height );
            } else {
                return ss_video_vimeo( $url, $width, $height );
            }
        }
    }
    

    if ( ! function_exists( 'ss_video_youtube' ) ) {
        function ss_video_youtube( $url, $width = 640, $height = 480 ) {
            preg_match( '/[\\?\\&]v=([^\\?\\&]+)/', $url, $video_id );
            $youtube_params = apply_filters( 'ss_youtube_embed_params', '?showinfo=0&controls=1&modestbranding=1' );

            $video_padding = ( intval( $height, 10 ) / intval( $width, 10 ) ) * 100;
            $inline_style  = 'padding-bottom: ' . $video_padding . '%;';
            $ssl_override = apply_filters( 'ss_video_youtube_ssl', false );

            if ( is_ssl() || $ssl_override ) {
                return '<div class="video-wrap" style="' . $inline_style . '"><iframe itemprop="video" class="video-embed" src="https://www.youtube.com/embed/' . $video_id[1] . $youtube_params . '" width="' . $width . '" height="' . $height . '" allowfullscreen></iframe></div>';
            } else {
                return '<div class="video-wrap" style="' . $inline_style . '"><iframe itemprop="video" class="video-embed" src="http://www.youtube.com/embed/' . $video_id[1] . $youtube_params . '" width="' . $width . '" height="' . $height . '" allowfullscreen></iframe></div>';
            }
        }
    }

    if ( ! function_exists( 'ss_video_vimeo' ) ) {
        function ss_video_vimeo( $url, $width = 640, $height = 480 ) {
            $url          = str_replace( 'https://', 'http://', $url );
            $video_id     = sf_get_vimeoid( $url );
            $vimeo_params = apply_filters( 'ss_vimeo_embed_params', '?title=0&amp;byline=0&amp;portrait=0' );

            $video_padding = ( intval( $height, 10 ) / intval( $width, 10 ) ) * 100;
            $inline_style  = 'padding-bottom: ' . $video_padding . '%;';
            $ssl_override = apply_filters( 'ss_video_vimeo_ssl', false );
            
            if ( $video_id == "" ) {
                return '<div class="video-wrap">' . __( "Video not found", SS_DOMAIN ) . '</div>';
            }

            if ( is_ssl() || $ssl_override ) {
                return '<div class="video-wrap" style="' . $inline_style . '"><iframe itemprop="video" class="video-embed" src="https://player.vimeo.com/video/' . $video_id . $vimeo_params . '" width="' . $width . '" height="' . $height . '"></iframe></div>';
            } else {
                return '<div class="video-wrap" style="' . $inline_style . '"><iframe itemprop="video" class="video-embed" src="http://player.vimeo.com/video/' . $video_id . $vimeo_params . '" width="' . $width . '" height="' . $height . '"></iframe></div>';
            }
        }
    }

    if ( ! function_exists( 'ss_get_embed_src' ) ) {
        function ss_get_embed_src( $url ) {
            if ( strpos( $url, 'youtube' ) ) {
                preg_match( '/[\\?\\&]v=([^\\?\\&]+)/', $url, $video_id );
                $youtube_params = apply_filters( 'ss_youtube_embed_src_params', '?autoplay=1' );
                if ( is_ssl() ) {
                    if ( isset( $video_id[1] ) ) {
                        return 'https://www.youtube.com/embed/' . $video_id[1] . $youtube_params;
                    }
                } else {
                    if ( isset( $video_id[1] ) ) {
                        return 'http://www.youtube.com/embed/' . $video_id[1] . $youtube_params;
                    }
                }
            } else {
                $url          = str_replace( 'https://', 'http://', $url );
                $video_id     = ss_get_vimeoid( $url );
                $time_stamp = explode('#',$url);
                $video_id  = (!empty($time_stamp[1]))?$video_id.'#'.$time_stamp[1]:$video_id;
                $vimeo_params = apply_filters( 'ss_vimeo_embed_src_params', '?title=0&byline=0&portrait=0&autoplay=1' );
                if ( is_ssl() ) {
                    if ( $video_id != "" ) {
                        return 'https://player.vimeo.com/video/' . $video_id . $vimeo_params;
                    }
                } else {
                    if ( $video_id != "" ) {
                        return 'http://player.vimeo.com/video/' . $video_id . $vimeo_params;
                    }
                }
            }
        }
    }
    
    if ( ! function_exists( 'ss_get_vimeoid' ) ) {
        function ss_get_vimeoid( $url ) {
            $regex = '~
                        # Match Vimeo link and embed code
                        (?:<iframe [^>]*src=")?     # If iframe match up to first quote of src
                        (?:                         # Group vimeo url
                            https?:\/\/             # Either http or https
                            (?:[\w]+\.)*            # Optional subdomains
                            vimeo\.com              # Match vimeo.com
                            (?:[\/\w]*\/videos?)?   # Optional video sub directory this handles groups links also
                            \/                      # Slash before Id
                            ([0-9]+)                # $1: VIDEO_ID is numeric
                            [^\s]*                  # Not a space
                        )                           # End group
                        "?                          # Match end quote if part of src
                        (?:[^>]*></iframe>)?        # Match the end of the iframe
                        (?:<p>.*</p>)?              # Match any title information stuff
                        ~ix';

            preg_match( $regex, $url, $matches );

            $vimeo_ID_fallback = substr( $url, strrpos( $url, '/' ) + 1 );

            if ( isset( $matches[1] ) ) {
                return $matches[1];
            } else {
                return $vimeo_ID_fallback;
            }
        }
    }

    if ( ! function_exists( 'ss_get_post_format_image_src' ) ) {
        function ss_get_post_format_image_src( $post_id ) {
            $format_meta = get_post_format_meta( $post_id );
            $match       = array();
            if ( $format_meta['image'] != "" ) {
                preg_match( '/<img.*?src="([^"]+)"/s', $format_meta['image'], $match );

                return $match[1];
            }
        }
    }

    if ( ! function_exists( 'ss_get_attachment_meta' ) ) {
        function ss_get_attachment_meta( $attachment_id ) {
    
            $attachment = get_post( $attachment_id );
    
            if ( isset( $attachment ) ) {

                //$image_alt    = ss_get_post_meta( $image_id, '_wp_attachment_image_alt', true );
                return array(
                    'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
                    'caption' => get_post_meta( $attachment->ID, '_wp_attachment_image_caption', true ),
                    'description' => get_post_meta( $attachment->ID, '_wp_attachment_image_description', true ),
                    'href' => get_permalink( $attachment->ID ),
                    'src' => $attachment->guid,
                    'title' => get_post_meta( $attachment->ID, '_wp_attachment_image_title', true )
                );
            }
        }
    }

    if ( ! function_exists( 'ss_get_image_meta' ) ) {
        function ss_get_image_meta( $file, $args = array() ) {
            $path = get_attached_file( $file );
            if ( ! $path ) {
                return false;
            }

            $args       = wp_parse_args( $args, array(
                'size' => 'full',
            ) );
            $image      = wp_get_attachment_image_src( $file, $args['size'] );
            $attachment = get_post( $file );
            $info       = array(
                'ID'          => $file,
                'name'        => basename( $path ),
                'path'        => $path,
                'url'         => $image[0],
                'full_url'    => wp_get_attachment_url( $file ),
                'title'       => $attachment->post_title,
                'caption'     => $attachment->post_excerpt,
                'description' => $attachment->post_content,
                'alt'         => get_post_meta( $file, '_wp_attachment_image_alt', true ),
            );
            if ( function_exists( 'wp_get_attachment_image_srcset' ) ) {
                $info['srcset'] = wp_get_attachment_image_srcset( $file );
            }

            $info = wp_parse_args( $info, wp_get_attachment_metadata( $file ) );

            // Do not overwrite width and height by returned value of image meta.
            $info['width']  = $image[1];
            $info['height'] = $image[2];

            return $info;
        }
    }

    if ( ! function_exists( 'ss_get_post_media' ) ) {
        function ss_get_post_media( $postID, $media_width, $media_height, $video_height, $use_thumb_content  ) {

            $format     = get_post_format( $postID );
            $post_media = "";

            if ( $format == "image" ) {
                $post_media = ss_image_post( $postID, $media_width, $media_height, $use_thumb_content  );
            } else if ( $format == "video" ) {
                $post_media = ss_video_post( $postID, $media_width, $video_height, $use_thumb_content  );
            } else if ( $format == "gallery" ) {
                $post_media = ss_gallery_post( $postID, $use_thumb_content  );
            } else if ( $format == "audio" ) {
                $post_media = ss_audio_post( $postID );
            } else if ( $format == "link" ) {
                $post_media = ss_link_post( $postID );
            } else if ( $format == "chat" ) {
                $post_media = ss_chat_post( $postID );
            }

            return $post_media;

        }
    }

    
    if ( ! function_exists( 'ss_image_post' ) ) {
        function ss_image_post( $postID, $media_width, $media_height, $use_thumb_content ) {

            $image = $media_image_url = $image_id = "";

            if ( $use_thumb_content ) {
                $media_image = rwmb_meta( 'ss_thumbnail_image', 'type=image&size=full', $postID );
            } else {
                $media_image = rwmb_meta( 'ss_detail_image', 'type=image&size=full', $postID );
            }

            foreach ( $media_image as $detail_image ) {
                $image_id        = $detail_image['ID'];
                $media_image_url = $detail_image['url'];
                break;
            }

             if ( ! $media_image ) {
                $media_image     = get_post_thumbnail_id();
                $image_id        = $media_image;
                $media_image_url = wp_get_attachment_url( $media_image, 'full' );
            }

            $detail_image   = aq_resize( $media_image_url, $media_width, $media_height, null, true, false );
            $image_meta     = ss_get_attachment_meta( $image_id );
            $image_alt = $image_title = "";

            if ( isset($image_meta) ) {
                $image_title        = esc_attr( $image_meta['title'] );
                $image_alt          = esc_attr( $image_meta['alt'] );
            }
            
            $image = '<img src="' . $detail_image . '" width="' . $media_width . '" height="' . $media_height . '" alt="' . $image_alt . '" title="' . $image_title . '" />';

            return $image;
        }
    }

    if ( ! function_exists( 'ss_audio_post' ) ) {
        function ss_audio_post( $postID, $use_thumb_content ) {
            $media_audio = "";
            if ( $use_thumb_content ) {
                $media_audio = ss_get_post_meta( $postID, 'ss_thumbnail_audio_url', true );
            } else {
                $media_audio = ss_get_post_meta( $postID, 'ss_detail_audio_url', true );
            }

            $audio = do_shortcode( '[audio src="' . $media_audio . '"]' );

            return $audio;
        }
    }

    if ( ! function_exists( 'ss_sh_video_post' ) ) {
        function ss_sh_video_post( $postID, $video_width = null, $video_height = null, $use_thumb_content = false ) {
            $media_mp4 = $media_ogg = $media_webm = "";
            $poster    = wp_get_attachment_image_src( get_post_thumbnail_id( $postID ), 'large', true );
            if ( isset( $poster ) & $poster != "" ) {
                $poster = 'poster="' . $poster[0] . '"';
            }

            if ( $use_thumb_content ) {
                $media_mp4  = ss_get_post_meta( $postID, 'ss_thumbnail_video_mp4', true );
                $media_ogg  = ss_get_post_meta( $postID, 'ss_thumbnail_video_ogg', true );
                $media_webm = ss_get_post_meta( $postID, 'ss_thumbnail_video_webm', true );
            } else {
                $media_mp4  = ss_get_post_meta( $postID, 'ss_detail_video_mp4', true );
                $media_ogg  = ss_get_post_meta( $postID, 'ss_detail_video_ogg', true );
                $media_webm = ss_get_post_meta( $postID, 'ss_detail_video_webm', true );
            }

            $video = '<div class="video-thumb">';
            $video .= '<video preload="auto" width="' . $video_width . '" height="' . $video_height . '" ' . $poster . ' controls>';
            if ( $media_webm != "" ) {
                $video .= '<source src="' . $media_webm . '" type="video/webm">';
            }
            if ( $media_mp4 != "" ) {
                $video .= '<source src="' . $media_mp4 . '" type="video/mp4">';
            }
            if ( $media_ogg != "" ) {
                $video .= '<source src="' . $media_ogg . '" type="video/ogv">';
            }
            $video .= '</video>';
            $video .= '</div>';

            return $video;
        }
    }

    if ( ! function_exists( 'ss_gallery_post' ) ) {
        function ss_gallery_post( $postID, $use_thumb_content ) {
        
            // ENQUEUE SCRIPT
            wp_enqueue_script( 'flexslider' );

            $gallery = '<div class="flexslider item-slider">' . "\n";
            $gallery .= '<ul class="slides">' . "\n";

            if ( $use_thumb_content ) {
                $media_gallery = rwmb_meta( 'ss_thumbnail_gallery', 'type=image&size=full-width-image-gallery', $postID );
            } else {
                $media_gallery = rwmb_meta( 'ss_detail_gallery', 'type=image&size=full-width-image-gallery', $postID );
            }
            // Caption to be added with figure tag
            foreach ( $media_gallery as $image ) {
                $gallery .= "<li><img src='{$image['url']}' width='{$image['width']}' height='{$image['height']}' alt='{$image['alt']}' /></li>";
            }

            $gallery .= '</ul>' . "\n";
            $gallery .= '</div>' . "\n";

            return $gallery;
        }
    }

    if ( ! function_exists( 'ss_gallery_stacked_post' ) ) {
        function ss_gallery_stacked_post( $postID, $use_thumb_content ) {

            $media_gallery = rwmb_meta( 'ss_detail_gallery', 'type=image&size=full-width-image-gallery', $postID );

            $gallery_stacked = '' . "\n";

            foreach ( $media_gallery as $image ) {
                $gallery_stacked .= "<figure>";
                $gallery_stacked .= "<img src='{$image['url']}' width='{$image['width']}' height='{$image['height']}' alt='{$image['alt']}' />";
                $gallery_stacked .= "<figcaption></figcaption>";
                $gallery_stacked .= "</figure>";
            }

            return $gallery_stacked;
        }
    }

    if ( ! function_exists( 'ss_link_post' ) ) {
        function ss_link_post( $postID ) {

            $link = "";
            $link_icon = apply_filters( 'ss_link_icon', '<i class="fa fa-link"></i>' );

            if ( function_exists( 'get_the_post_format_url' ) ) {
                $link = get_the_post_format_url();
                $link = '<a href="' . esc_url( $link ) . '" target="_blank" class="link-post-link">'. $link_icon . $link . '</a>';
            }

            return $link;
        }
    }

    if ( ! function_exists( 'ss_chat_post' ) ) {
        function ss_chat_post( $postID ) {

            $chat = "";

            if ( function_exists( 'get_the_post_format_chat' ) ) {

                $chat    = '<dl class="chat">';
                $stanzas = get_the_post_format_chat();

                foreach ( $stanzas as $stanza ) {
                    foreach ( $stanza as $row ) {
                        $time = '';
                        if ( ! empty( $row['time'] ) ) {
                            $time = sprintf( '<time class="chat-timestamp">%s</time>', esc_html( $row['time'] ) );
                        }

                        $chat .= sprintf(
                            '<dt class="chat-author chat-author-%1$s vcard">%2$s <cite class="fn">%3$s</cite>: </dt>
                                <dd class="chat-text">%4$s</dd>
                            ',
                            esc_attr( sanitize_title_with_dashes( $row['author'] ) ), // Slug.
                            $time,
                            esc_html( $row['author'] ),
                            $row['message']
                        );
                    }
                }

                $chat .= '</dl><!-- .chat -->';

            }

            return $chat;
        }
    }

    if ( ! function_exists( 'ss_get_post_meta_details' ) ) {
        function ss_get_post_meta_details( $postID ) {

            global $ss_theme_options;

            $show_author     = $ss_theme_options['default_include_author'];
            $show_date       = $ss_theme_options['default_include_date'];
            $show_category   = $ss_theme_options['default_include_category'];

            $post_author     = get_the_author_link();
            $post_author     = get_the_author();
            $post_date       = get_the_date();
            $post_date_str   = get_the_date('Y-m-d');
            $post_categories = get_the_category_list( ', ' );

            $post_details = "";

            $post_details .= '<div class="meta-detail">';
            if ( $show_author == 1 && $show_date == 1 ) { 
                $post_details .= '<div class="blog-item-details">' . sprintf( __( '<span class="author"> By <a href="%2$s" rel="author" itemprop="author">%1$s</a></span> Updated on: <time datetime="%3$s">%4$s</time>', SS_DOMAIN ), $post_author, get_author_posts_url( get_the_author_meta( 'ID' ) ), $post_date_str, $post_date ) . '</div>';
            } elseif ( $show_date == 1 ) {
                $post_details .= '<div class="blog-item-details">' . sprintf( __( 'Updated on: <time datetime="%1$s">%2$s</time>', SS_DOMAIN ), $post_date_str, $post_date ) . '</div>';
            } elseif ( $show_author == 1 ) {
                $post_details .= '<div class="blog-item-details">' . sprintf( __( '<span class="author"> By <a href="%2$s" rel="author" itemprop="author">%1$s</a></span>', SS_DOMAIN ), $post_author, get_author_posts_url( get_the_author_meta( 'ID' ) )) . '</div>';
            } elseif ( $show_category == 1 && $show_date == 1 ) {
                $post_details .= '<div class="blog-item-details"><span class="in-category">' . $post_categories . '</span> ' . sprintf( __( ' Updated on: <time datetime="%1$s">%2$s</time>', SS_DOMAIN ), $post_date_str, $post_date ) . '</div>';
            }
            $post_details .= '</div>';

            echo $post_details;
        }
    }

    if ( ! function_exists( 'ss_post_thumbnail' )) {
        function ss_post_thumbnail( $width = 970, $height = null, $gallery_size = 'blog-image'  ) {
            global $post;

            $thumb_width = $thumb_height = $thumb_meta = $video_height = $gallery_size = $item_figure = '';

            $thumb_width = $width;
            $thumb_height = $video_height = $height;

            $thumb_type               = ss_get_post_meta( $post->ID, 'ss_thumbnail_type', true );
            $thumb_image              = rwmb_meta( 'ss_thumbnail_image', 'type=image&size=full' );
            $thumb_video              = ss_get_post_meta( $post->ID, 'ss_thumbnail_video_url', true );
            $thumb_gallery            = rwmb_meta( 'ss_thumbnail_gallery', 'type=image&size=' . $gallery_size );
            $thumb_link_type          = ss_get_post_meta( $post->ID, 'ss_thumbnail_link_type', true );
            $thumb_link_url           = ss_get_post_meta( $post->ID, 'ss_thumbnail_link_url', true );
            $thumb_lightbox_thumb     = rwmb_meta( 'ss_thumbnail_image', 'type=image&size=large' );
            $thumb_lightbox_image     = rwmb_meta( 'ss_thumbnail_link_image', 'type=image&size=large' );
            $thumb_lightbox_video_url = ss_get_post_meta( $post->ID, 'ss_thumbnail_link_video_url', true );
            $thumb_lightbox_video_url = ss_get_embed_src( $thumb_lightbox_video_url );
            $image_id                 = 0;
            $item_link                = ss_post_item_link();

            foreach ( $thumb_image as $detail_image ) {
                $image_id      = $detail_image['ID'];
                $thumb_img_url = $detail_image['url'];
                break;
            }

            if ( !$thumb_image ) {
                $thumb_image   = get_post_thumbnail_id();
                $image_id      = $thumb_image;
                $thumb_img_url = wp_get_attachment_url( $thumb_image, 'full' );
            }

            $thumb_meta   = ss_get_image_meta( $image_id );

            if ( $thumb_type == "" ) {
                $thumb_type = "none";
            }

            if ( $thumb_type == "video" ) {

                $video = ss_video_embed( $thumb_video, $thumb_width, $video_height );

                $item_figure .= $video;

            } else if ( $thumb_type == "audio" ) {
                $image = aq_resize( $thumb_img_url, $thumb_width, $thumb_height, null, true, false );

                if ( $image ) {
                    $item_figure .= '<img src="' . $image . '" width="' . $thumb_width . '" height="' . $thumb_height . '" alt="' . $thumb_meta['alt'] . '" />';
                }

                $item_figure .= ss_audio_post( $post->ID, true );

            } else if ( $thumb_type == "sh-video" ) {

                $item_figure .= ss_sh_video_post( $post->ID, $thumb_width, $video_height, true );

            } else if ( $thumb_type == "slider" ) {

                // ENQUEUE SCRIPT
                wp_enqueue_script( 'flexslider' );
                
                $item_figure .= '<div class="flexslider thumb-slider"><ul class="slides">';

                foreach ( $thumb_gallery as $image ) {
                    $item_figure .= "<li><a " . $item_link['config'] . "><img src='{$image['url']}' width='{$image['width']}' height='{$image['height']}' alt='{$image['alt']}' /></a></li>";
                }

                $item_figure .= '</ul></div>';

            } else {

                $image = aq_resize( $thumb_img_url, $thumb_width, $thumb_height, true, true, true );

                if ( $thumb_img_url != "" ) {
                    if ( $image ) {
                        //$item_figure .= '<div class="img-wrap"><img src="' . esc_url( $image ) . '" width="' . $thumb_width . '" height="' . $thumb_height . '" alt="' . $thumb_meta['alt'] . '" /></div>';
                        $item_figure .= '<a ' . $item_link['config'] . '>';  
                        $item_figure .= '<img src="' . esc_url( $image ) . '" width="' . $thumb_width . '" height="' . $thumb_height . '" alt="' . $thumb_meta['alt'] . '" />';
                        $item_figure .= '</a>';
                        // $item_figure .= '<div class="figcaption-wrap">';
                        // $item_figure .= '<figcaption><div class="thumb-info">';
                        // $item_figure .= $thumb_meta['caption'];
                        // $item_figure .= '</div></figcaption>';
                    }
                }
            }

            return $item_figure;
        }
    }


    if ( ! function_exists( 'ss_post_item_link' ) ) {
        function ss_post_item_link() {

            $link_config = $item_icon = $item_svg_icon = $thumb_img_url = "";

            global $post;

            $thumb_image              = rwmb_meta( 'ss_thumbnail_image', 'type=image&size=full' );
            $thumb_link_type          = ss_get_post_meta( $post->ID, 'ss_thumbnail_link_type', true );
            $thumb_link_url           = ss_get_post_meta( $post->ID, 'ss_thumbnail_link_url', true );
            $thumb_lightbox_image     = rwmb_meta( 'ss_thumbnail_link_image', 'type=image&size=large' );
            $thumb_lightbox_video_url = ss_get_post_meta( $post->ID, 'ss_thumbnail_link_video_url', true );
            $thumb_lightbox_video_url = ss_get_embed_src( $thumb_lightbox_video_url );

            $permalink = get_permalink();

            foreach ( $thumb_image as $detail_image ) {
                $thumb_img_url = $detail_image['url'];
                break;
            }

            if ( ! $thumb_image ) {
                $thumb_image   = get_post_thumbnail_id();
                $thumb_img_url = wp_get_attachment_url( $thumb_image, 'full' );
            }


            if ( $thumb_link_type == "link_to_url" ) {
                $link_config = 'href="' . $thumb_link_url . '" class="link-to-url"';
                $item_icon   = apply_filters( 'ss_post_link_icon', "ss-link" );
                $item_svg_icon   = apply_filters( 'ss_post_link_svg_icon', "" );
            } else if ( $thumb_link_type == "link_to_url_nw" ) {
                $link_config = 'href="' . $thumb_link_url . '" class="link-to-url" target="_blank"';
                $item_icon   = apply_filters( 'ss_post_link_icon', "ss-link" );
                $item_svg_icon   = apply_filters( 'ss_post_link_svg_icon', "" );
            } else if ( $thumb_link_type == "lightbox_thumb" ) {
                $lightbox_id = rand();
                if ( $thumb_img_url != "" ) {
                    $link_config = 'href="' . $thumb_img_url . '" class="lightbox" data-rel="ilightbox['.$lightbox_id.']"';
                }
                $item_icon   = apply_filters( 'ss_post_lightbox_icon', "ss-view" );
                $item_svg_icon   = apply_filters( 'ss_post_lightbox_svg_icon', "" );
            } else if ( $thumb_link_type == "lightbox_image" ) {
                $lightbox_image_url = '';
                foreach ( $thumb_lightbox_image as $image ) {
                    $lightbox_image_url = $image['full_url'];
                }
                $lightbox_id = rand();
                if ( $lightbox_image_url != "" ) {
                    $link_config = 'href="' . $lightbox_image_url . '" class="lightbox" data-rel="ilightbox['.$lightbox_id.']"';
                }
                $item_icon   = apply_filters( 'ss_post_lightbox_icon', "ss-view" );
                $item_svg_icon   = apply_filters( 'ss_post_lightbox_svg_icon', "" );
            } else if ( $thumb_link_type == "lightbox_video" ) {
                $link_config = 'data-video="' . $thumb_lightbox_video_url . '" href="#" class="fw-video-link"';
                $item_icon   = apply_filters( 'ss_post_video_icon', "ss-video" );
                $item_svg_icon   = apply_filters( 'ss_post_video_svg_icon', "" );
            } else {
                $link_config = 'href="' . $permalink . '" class="link-to-post"';
                $item_icon   = apply_filters( 'ss_post_standard_icon', "ss-navigateright" );
                $item_svg_icon   = apply_filters( 'ss_post_standard_svg_icon', "" );
            }

            $item_link = array(
                "icon"   => $item_icon,
                "svg_icon"   => $item_svg_icon,
                "config" => $link_config
            );

            return $item_link;
        }
    }

    if ( ! function_exists('ss_post_detail_media' )) {
        function ss_post_detail_media() {
            global $post, $ss_theme_options;
            
            $media_type = $media_image = $media_video = $media_gallery = '';

            $media_type           = ss_get_post_meta( $post->ID, 'ss_media_type', true );
            $default_detail_media = 'image';
            $use_thumb_content    = ss_get_post_meta( $post->ID, 'ss_thumbnail_content_main_detail', true );

            if ( $use_thumb_content ) {
                $media_type = ss_get_post_meta( $post->ID, 'ss_thumbnail_type', true );
            } else {
                $media_type = ss_get_post_meta( $post->ID, 'ss_detail_type', true );
            }
            if ( $media_type == "" ) {
                $media_type = $default_detail_media;
            }

            $post_format = get_post_format( $post->ID );
            if ( $post_format == "" ) {
                $post_format = 'standard';
            }
            $media_slider      = ss_get_post_meta( $post->ID, 'ss_detail_rev_slider_alias', true );
            $media_layerslider = ss_get_post_meta( $post->ID, 'ss_detail_layer_slider_alias', true );
            $custom_media      = ss_get_post_meta( $post->ID, 'ss_custom_media', true );
            $media_width  = 1170;
            $media_height = null;
            $video_height = 658;

            ?>

            <?php 
                $figure_output = '<figure class="media-wrap media-type-' . $media_type . '" itemscope>';
                
                if ( $post_format == "standard" ) {

                    if ( $media_type == "video" ) {

                        $figure_output .= ss_video_post( $post->ID, $media_width, $video_height, $use_thumb_content ) . "\n";

                    } else if ( $media_type == "slider" ) {

                        $figure_output .= ss_gallery_post( $post->ID, $use_thumb_content ) . "\n";

                    } else if ( $media_type == "gallery-stacked" ) {

                        $figure_output .= ss_gallery_stacked_post( $post->ID, $use_thumb_content ) . "\n";

                    } else if ( $media_type == "layer-slider" ) {

                        $figure_output .= '<div class="layerslider">' . "\n";

                        if ( $media_slider != "" ) {

                            $figure_output .= do_shortcode( '[rev_slider ' . $media_slider . ']' ) . "\n";

                        } else {

                            $figure_output .= do_shortcode( '[layerslider id="' . $media_layerslider . '"]' ) . "\n";

                        }

                        $figure_output .= '</div>' . "\n";

                    } else if ( $media_type == "audio" ) {

                        $figure_output .= '<div class="audio-detail">' . ss_audio_post( $post->ID, $use_thumb_content ) . '</div>' . "\n";

                    } else if ( $media_type == "ar-video" ) {

                        $figure_output .= '<div class="sh-video-wrap">' . ss_sh_video_post( $post->ID, $use_thumb_content ) . '</div>' . "\n";

                    } else if ( $media_type == "custom" ) {

                        $figure_output .= do_shortcode( $custom_media ) . "\n";

                    } else if ( $media_type == "image" ) {

                        $figure_output .= ss_image_post( $post->ID, $media_width, $media_height, $use_thumb_content ) . "\n";

                    }

                } else {
                    $figure_output .= ss_get_post_media( $post->ID, $media_width, $media_height, $video_height, $use_thumb_content );
                }

                $figure_output .= '</figure>' . "\n";

                echo $figure_output;
            ?>
        <?php }
        add_action( 'ss_post_article_start', 'ss_post_detail_media', 20 );
    }

    if ( ! function_exists( 'ss_post_pagination' ) ) {
        function ss_post_pagination() {
            global $ss_theme_options;

            $pagination_style = "standard";
            if ( isset( $ss_theme_options['pagination_style'] ) ) {
                $pagination_style = $ss_theme_options['pagination_style'];
            }
            $enable_category_navigation = $ss_theme_options['enable_category_navigation'];

            $taxonomy = "category";
            
            if ( is_singular('portfolio') ) {
                $taxonomy = "portfolio-category";
            } else if ( is_singular('product') ) {
                $taxonomy = "product_cat";
            }

            $prev_post = get_next_post($enable_category_navigation, '', $taxonomy);
            $next_post = get_previous_post($enable_category_navigation, '', $taxonomy);
           
            $has_both  = false;

            if ( ! empty( $next_post ) && ! empty( $prev_post ) ) {
                $has_both = true;
            }
            ?>

            <?php if ( ! empty( $next_post ) || ! empty( $prev_post )) { ?>
            <?php if ($has_both) { ?>
            <div class="post-pagination prev-next clearfix">
            <?php } else { ?>
            <div class="post-pagination clearfix">
                <?php } ?>

                    <?php if ( ! empty( $next_post ) ) {
                        $author_id       = $next_post->post_author;
                        $author_name     = get_the_author_meta( 'display_name', $author_id );
                        $author_url      = get_author_posts_url( $author_id );
                        $post_date       = get_the_date();
                        $post_date_str   = get_the_date('Y-m-d');
                        $post_categories = get_the_category_list( ', ', '', $next_post->ID );
                        ?>
                        <a class="next-article col-sm-4" href="<?php echo get_permalink( $next_post->ID ); ?>">
                            <h6><?php _e( "Next Article", SS_DOMAIN ); ?></h6>
                            <h3><?php echo esc_attr($next_post->post_title); ?></h3>
                        </a>
                    <?php } ?>

                    <?php if ( ! empty( $prev_post ) ) {
                        $author_id       = $prev_post->post_author;
                        $author_name     = get_the_author_meta( 'display_name', $author_id );
                        $author_url      = get_author_posts_url( $author_id );
                        $post_date       = get_the_date();
                        $post_date_str   = get_the_date('Y-m-d');
                        $post_categories = get_the_category_list( ', ', '', $prev_post->ID );
                        ?>
                        <a class="prev-article col-sm-4" href="<?php echo get_permalink( $prev_post->ID ); ?>">
                            <h4><?php _e( "Previous Article", SS_DOMAIN ); ?></h4>
                            <h3><?php echo esc_attr($prev_post->post_title); ?></h3>
                        </a>
                    <?php } else { ?>
                        <div class="pagination-spacer col-sm-4"></div>
                    <?php } ?>

            </div>
            <?php } ?>

        <?php
        }
        add_action( 'ss_post_article_end', 'ss_post_pagination', 30 );
    }


    if ( ! function_exists( 'ss_post_info' ) ) {
        function ss_post_info() {
            global $post, $ss_theme_options;

            $show_author     = $ss_theme_options['default_include_author'];
            $show_share      = $ss_theme_options['default_include_social'];
            $post_date       = get_the_date();
            $remove_dates    = $ss_theme_options['remove_dates'];
            $author_id       = $post->post_author;
            $author_name     = get_the_author_meta( 'display_name', $author_id );
            $author_url      = get_author_posts_url( $author_id );
            $post_permalink  = get_permalink();
            $post_comments   = get_comments_number();

            $post_categories = get_the_category_list( ', ' );
            ?>

            <div class="post-info clearfix">

                <?php if ( $show_author == 1 ) { ?>
                 
                        <div class="author-info-wrap clearfix">
                            <div class="author-avatar col-sm-3">
                                <?php if ( function_exists( 'get_avatar' ) ) {
                                    echo get_avatar( get_the_author_meta( 'ID' ), '140' );
                                } ?>
                            </div>
                            <div class="author-bio col-sm-9">
                                <div class="author-name" itemprop="author" itemscope itemtype="http://schema.org/Person">
                                    <h3 class="vcard author"><span itemprop="name" class="fn"><?php echo esc_attr($author_name); ?></span>
                                    </h3>
                                </div>
                                <div class="author-bio-text">
                                    <?php the_author_meta( 'description' ); ?>
                                    <?php echo sprintf( __( '<a href="%2$s" class="author-more-link">More by %1$s <i class="fa fa-long-arrow-right"></i></a>', SS_DOMAIN ), $author_name, $author_url ); ?>
                                </div>
                            </div>
                        </div>
                        
                <?php } ?>
                <div class="post-details-wrap">
                    <?php if ( has_tag() ) { ?>
                        <div class="tags-wrap">
                            <span class="tags-title"><?php _e( "Tags", SS_DOMAIN ); ?></span>
                            <ul class="wp-tag-cloud"><?php the_tags( '<li>', '</li><li>', '</li>' ); ?></ul>
                        </div>
                    <?php } ?>
                    <?php if ( $show_share == 1 ) { ?>
                        <div class="post-share">
                            share buttons
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php
        }
        add_action( 'ss_post_article_end', 'ss_post_info', 20 );
    }

    if ( ! function_exists( 'ss_post_top_author' ) ) {
        function ss_post_top_author() {
            global $post, $ss_theme_options;
            $post_date       = get_the_date();
            $single_author   = $ss_theme_options['single_author'];
            $remove_dates    = $ss_theme_options['remove_dates'];
            $author_id       = $post->post_author;
            $author_name     = get_the_author_meta( 'display_name', $author_id );
            $author_url      = get_author_posts_url( $author_id );
            $post_date       = get_the_date();
            $post_date_str   = get_the_date('Y-m-d');

            $post_categories = get_the_category_list( ', ' );
            ?>

            <?php if ( $author_info && $fw_media_display != "fw-media-title" ) { ?>
                <div class="top-author-info container clearfix">
                    <div class="author-avatar"><?php if ( function_exists( 'get_avatar' ) ) {
                            echo get_avatar( get_the_author_meta( 'ID' ), '140' );
                        } ?></div>
                    <div class="post-details">
                        <div class="author-name" itemprop="author" itemscope itemtype="http://schema.org/Person">
                            <h5 class="vcard author"><?php echo sprintf( __( 'By <a href="%2$s" rel="author" itemprop="name" class="fn">%1$s</a>', SS_DOMAIN ), $author_name, $author_url ); ?></h5>
                        </div>
                        <?php if ( !$remove_dates ) { ?>
                            <?php echo sprintf( __( '<time datetime="%1$s">%2$s</time>', SS_DOMAIN ), $post_date_str, $post_date ); ?>
                        <?php } ?>
                        <span class="categories"><?php echo sprintf( __( 'In %1$s', SS_DOMAIN ), $post_categories ); ?></span>
                    </div>
                </div>
            <?php } ?>

        <?php
        }
        add_action( 'ss_post_article_start', 'ss_post_top_author', 5 );
    }
    
    if ( ! function_exists( 'ss_get_post_item' ) ) {
        function ss_get_post_item( $postID, $blog_type, $show_title = "yes", $show_excerpt = "yes", $show_details = "yes", $excerpt_length = "40", $content_output = "excerpt", $show_read_more = "yes", $fullwidth = "no" ) {
            global $post, $ss_theme_options;
            $post_item = $image_id = "";

            $post_format = get_post_format( $postID );
            if ( $post_format == "" ) {
                $post_format = 'standard';
            }

            if ( $blog_type == "masonry" ) {
                $content_output = "excerpt";
            }

            if ( $blog_type == "masonry" ) {
                $post_item = ss_get_masonry_post( $postID, $thumb_type, $fullwidth, $show_title, $show_excerpt, $show_details, $show_read_more, $content_output, $excerpt_length );

            } else {
                $post_item = ss_get_standard_post( $postID, $thumb_type, $fullwidth, $show_title, $show_excerpt, $show_details, $show_read_more, $content_output, $excerpt_length );
                include(locate_template('/template-parts/loop-layout-standard.php'));
                
            }

            return $post_item;
        }
    }

    if ( ! function_exists( 'ss_get_standard_post' ) ) {
        function ss_get_standard_post( $postID, $thumb_type, $fullwidth, $show_title, $show_excerpt, $show_details, $show_read_more, $content_output, $excerpt_length ) {
            global $post, $ss_theme_options;

            $fullwidth = $fullwidth;
            $single_author   = $ss_theme_options['single_author'];
            $remove_dates    = $ss_theme_options['remove_dates'];
            $content_output  = "excerpt";
            $excerpt_length  = $excerpt_length;
            $comments_icon   = apply_filters( 'ss_comments_icon', '<i class="fa fa-comments-o" aria-hidden="true"></i>' );
            $link_icon       = apply_filters( 'ss_link_icon', '<i class="fa fa-link" aria-hidden="true"></i>' );
            // Show/Hide
            $show_title     = "yes";
            $show_details   = "yes";
            $show_excerpt   = "yes";
            $show_read_more = "yes";
            
            // Post Meta
            $post_id         = $post->ID;
            $post_format     = get_post_format();
            $post_title      = get_the_title();
            $post_author     = get_the_author();
            $post_date       = get_the_date();
            $post_date_str   = get_the_date('Y-m-d');
            $post_date_month = get_the_date('M');
            $post_date_day   = get_the_date('d');
            $post_date_year  = get_the_date('Y');
            $post_categories = get_the_category_list( ', ' );
            $post_comments   = get_comments_number();
            $post_permalink  = get_permalink();
            $post_excerpt    = '';

            if ( $content_output == "excerpt" ) {
                if ( $post_format == "quote" ) {
                    $post_excerpt = ss_get_the_content_with_formatting();
                } else {
                    $excerpt = wp_trim_words( get_the_excerpt(),  $excerpt_length );
                    $excerpt = preg_replace( '`\[[^\]]*\]`', '', $excerpt );
                    $post_excerpt = '<p>' . $excerpt . '</p>';
                }
            } else {
                $post_excerpt = ss_get_the_content_with_formatting();
            }
            if ( $post_format == "chat" ) {
                $post_excerpt = ss_content( 40 );
            } else if ( $post_format == "audio" ) {
                $post_excerpt = do_shortcode( get_the_content() );
            } else if ( $post_format == "video" ) {
                $content      = get_the_content();
                $content      = apply_filters( 'the_content', $content );
                $post_excerpt = $content;
            } else if ( $post_format == "link" ) {
                $content      = get_the_content();
                $content      = apply_filters( 'the_content', $content );
                $post_excerpt = $content;
            }
            $post_permalink_config = 'href="' . $post_permalink . '" class="link-to-post"';
                        
            // Media
            $item_figure = "";
            if ( $thumb_type != "none" ) {
                $item_figure = ss_post_thumbnail( 970, null );
            }

            // DETAILS SETUP
            $item_details = "";
            if ( $single_author && ! $remove_dates ) {
                $item_details .= '<div class="blog-item-details">' . sprintf( __( 'In %1$s on <time datetime="%2$s">%3$s</time>', SS_DOMAIN ), $post_categories, $date_str, $post_date ) . '</div>';
            } else if ( ! $remove_dates ) {
                $item_details .= '<div class="blog-item-details">' . sprintf( __( '<span class="author">By <a href="%2$s" rel="author" itemprop="author">%1$s</a></span> in %3$s on <time datetime="%4$s">%5$s</time>', SS_DOMAIN ), $post_author, get_author_posts_url( get_the_author_meta( 'ID' ) ), $post_categories, $post_date_str, $post_date ) . '</div>';
            } else if ( ! $single_author ) {
                $item_details .= '<div class="blog-item-details">' . sprintf( __( '<span class="author">By <a href="%2$s" rel="author" itemprop="author">%1$s</a></span> in %3$s', SS_DOMAIN ), $post_author, get_author_posts_url( get_the_author_meta( 'ID' ) ), $post_categories ) . '</div>';
            }

            if ( $show_details == "yes" ) {
                $post_item .= '<div class="side-details">';
                if ( !$remove_dates ) {
                    $post_date_month = get_the_date('M');
                    $post_date_day = get_the_date('d');
                    $post_date_year = get_the_date('Y');
                    $post_item .= '<div class="side-post-date narrow-date-block" itemprop="datePublished"><span class="month">'.$post_date_month.'</span><span class="day">'.$post_date_day.'</span><span class="year">'.$post_date_year.'</span></div>';
                }
                if ( comments_open() ) {
                    $post_item .= '<div class="comments-wrapper narrow-date-block"><a href="' . $post_permalink . '#comment-area">' . $comments_icon . $post_comments . '</span></a></div>';
                }
    
    
                $post_item .= '</div>';
    
                $post_item .= '<div class="post-content-wrap">';
            }

            $post_item .= $item_figure;
    
            if ( $item_figure == "" ) {
                $post_item .= '<div class="standard-post-content no-thumb clearfix">'; // open standard-post-content
            } else {
                $post_item .= '<div class="standard-post-content clearfix">'; // open standard-post-content
            }

            if ( $show_title == "yes" && $post_format != "link" && $post_format != "quote" ) {
                $post_item .= '<h1 itemprop="name headline"><a href="' . $post_permalink . '">' . $post_title . '</a></h1>';
            }

            if ($show_details == "yes" && $post_format != "quote" && $post_format != "link" ) {
                $post_item .= $item_details;
            }

            if ( $show_excerpt == "yes" ) {
                $post_item .= '<div class="excerpt" itemprop="description">' . $post_excerpt . '</div>';
            } else if ( $post_format == "quote" ) {
                $post_item .= '<div class="quote-excerpt heading-font" itemprop="description">' . $post_excerpt . '</div>';
            } else if ( $post_format == "link" ) {
                $post_item .= '<div class="link-excerpt heading-font" itemprop="description">' . $link_icon . $post_object['excerpt'] . '</div>';
            }

            $post_item .= '<a class="read-more-button" href="' . $post_permalink . '">' . __( "Read more", SS_DOMAIN ) . '</a>';

            if ( $show_details == "yes" ) {
    
                $post_item .= '<div class="comments-likes">';
    
                if ( $post_format == "quote" || $post_format == "link" ) {
                    $post_item .= $item_details;
                }
    
                if ( comments_open() ) {
                    $post_item .= '<div class="comments-wrapper"><a href="' . $post_permalink . '#comment-area">'.$comments_icon.'<span>' . $post_comments . '</span></a></div>';
                }
    
    
                $post_item .= '</div>';
            }

            $post_item .= '</div>'; // close standard-post-content

            if ( $show_details == "yes" ) {
                $post_item .= '</div>'; // close post-content-wrap
            }

            return $post_item;
        }
    }

    if ( ! function_exists( 'ss_get_masonry_post' ) ) {
        function ss_get_masonry_post( $postID, $thumb_type, $fullwidth, $show_title, $show_excerpt, $show_details, $show_read_more, $content_output, $excerpt_length ) {
            
            global $post, $ss_theme_options;

            $fullwidth = $fullwidth;
            $single_author   = $ss_theme_options['single_author'];
            $remove_dates    = $ss_theme_options['remove_dates'];
            $content_output  = "excerpt";
            $excerpt_length  = $excerpt_length;
            $comments_icon   = apply_filters( 'ss_comments_icon', '<i class="fa fa-comments-o" aria-hidden="true"></i>' );
            $link_icon       = apply_filters( 'ss_link_icon', '<i class="fa fa-link" aria-hidden="true"></i>' );
            
             // Show/Hide
            $show_title = "yes";
            $show_details = "yes";
            $show_excerpt = "yes";
            $show_read_more = "yes";
            
            // Post Meta
            $post_id         = $post->ID;
            $post_format     = get_post_format( $postID );
            $post_type       = get_post_type( $postID );
            $post_title      = get_the_title();
            $post_author     = get_the_author();
            $post_date       = get_the_date();
            $post_date_str   = get_the_date('Y-m-d');
            $post_date_month = get_the_date('M');
            $post_date_day   = get_the_date('d');
            $post_date_year  = get_the_date('Y');
            $post_categories = get_the_category_list( ', ' );
            $post_comments   = get_comments_number();
            $post_permalink  = get_permalink();
            $post_excerpt    = '';

            if ( $content_output == "excerpt" ) {
                if ( $post_format == "quote" ) {
                    $post_excerpt = ss_get_the_content_with_formatting();
                } else {
                    $excerpt = wp_trim_words( get_the_excerpt(),  $excerpt_length );
                    $excerpt = preg_replace( '`\[[^\]]*\]`', '', $excerpt );
                    $post_excerpt = '<p>' . $excerpt . '</p>';
                }
            } else {
                $post_excerpt = ss_get_the_content_with_formatting();
            }
            if ( $post_format == "chat" ) {
                $post_excerpt = ss_content( 40 );
            } else if ( $post_format == "audio" ) {
                $post_excerpt = do_shortcode( get_the_content() );
            } else if ( $post_format == "video" ) {
                $content      = get_the_content();
                $content      = apply_filters( 'the_content', $content );
                $post_excerpt = $content;
            } else if ( $post_format == "link" ) {
                $content      = get_the_content();
                $content      = apply_filters( 'the_content', $content );
                $post_excerpt = $content;
            }
            $post_permalink_config = 'href="' . $post_permalink . '" class="link-to-post"';
            
            // Variable setup
            $post_item = "";
                                  
            $item_figure = "";
            if ( $thumb_type != "none" ) {
                $item_figure .= ss_post_thumbnail( "masonry" );
            }
            if ( $item_figure != "" ) {
                $post_item .= $item_figure;
            }

            // Open output
            $post_item .= '<div class="details-wrap">';
            $post_item .= '<a ' . $post_permalink_config . '></a>';
            
            if ( $show_title == "yes" && $post_format != "quote" && $post_format != "link" ) {
                $post_item .= '<h2 itemprop="name headline">' . $post_title . '</h2>';
            } else if ( $post_format == "quote" ) {
                $post_item .= '<div class="quote-excerpt" itemprop="name headline">' . $post_excerpt . '</div>';
            } else if ( $post_format == "link" ) {
                $post_item .= '<h3 itemprop="name headline">' . $post_title . '</h3>';
            }
            
            // Excerpt
            if ( $show_excerpt == "yes" && $post_format != "quote" ) {
                $post_item .= '<div class="excerpt" itemprop="description">' . $post_excerpt . '</div>';
            }
            
            // Details
            if ( $show_details == "yes" ) {
                $post_item .= ss_get_post_meta_details($postID);
                $post_item .= '<div class="comments-likes">';
                if ( comments_open() ) {
                    $post_item .= '<div class="comments-wrapper"><a href="' . $post_permalink . '#comment-area">'.$comments_icon.'<span>' . $post_comments . '</span></a></div>';
                }

                $post_item .= '</div>';

            }

            // Close output
            $post_item .= '</div>';
                           
            // Return 
            return $post_item;
        }
    }

    if ( ! function_exists( 'ss_portfolio_filter' ) ) {
        function ss_portfolio_filter( $post_type = "portfolio", $parent_category = "" ) {
            $filter_output = $tax_terms = "";

            $taxonomy_name = 'category';

            if ( $post_type != "post") {
                $taxonomy_name = $post_type . '-category';
            }

            if ($parent_category == "" || $parent_category == "All") {
                $tax_terms = ss_get_category_list($taxonomy_name, 1, '', true);
            } else {
                $tax_terms = ss_get_category_list($taxonomy_name, 1, $parent_category, true);
            }

            $filter_output = '<div class="filter-wrap clearfix">'. "\n";
            $filter_output .= '<ul class="post-filter-tabs filtering clearfix">'. "\n";
            $filter_output .= '<li class="all selected"><a data-filter="*" href="#"><span class="item-name">'. apply_filters( 'ss_portfolio_filter_show_all_text', __("Show all", SS_DOMAIN) ).'</span></a></li>'. "\n";


            foreach ($tax_terms as $tax_term) {
                $term = get_term_by('name', $tax_term, $taxonomy_name);
                $term_meta = $term_icon = "";
                if (isset($term->term_id)) {
                $term_meta = get_option( "portfolio-category_$term->term_id" );
                }
                if (isset($term_meta['icon'])) {
                    $term_icon = $term_meta['icon'];
                }
                if ($term) {
                    $term_slug = strtolower( $term->slug );
                    $filter_output .= '<li><a href="#" title="View all ' . $term->name . ' items" class="' . $term_slug . '" data-filter=".' . $term_slug . '">';
                    if ($term_icon != "") {
                        $filter_output .= '<i class="'.$term_icon.'"></i>';
                    }
                    $filter_output .= '<span class="item-name">' . $term->name . '</span></a></li>'. "\n";
                } else {
                    $tax_slug = strtolower( $tax_term );
                    $tax_slug = str_replace(' ', '-', $tax_slug);
                    $filter_output .= '<li><a href="#" title="View all ' . $tax_term . ' items" class="' . $tax_slug . '" data-filter=".' . $tax_slug . '"><span class="item-name">' . $tax_term . '</span></a></li>'. "\n";
                }
            }

            $filter_output .= '</ul></div>'. "\n";
            return $filter_output;
        }
    }

    if ( ! function_exists( 'ss_portfolio_thumbnail' )) {
        function ss_portfolio_thumbnail( $display_type = "gallery", $columns = "2", $hover_show_excerpt = "no", $excerpt_length = 20, $gutters = "yes", $fullwidth = "no" ) {

            global $post;

            $thumb_width = $thumb_height = $video_height = $gallery_size = $item_figure = '';
            $portfolio_thumb = $thumb_image_id = $thumb_image = $thumb_gallery = $video = $item_class = $link_config;

            $thumb_width     = 400;
            $thumb_height    = 300;
            $video_height    = 300;

            if ( $columns == "1" ) {
                $thumb_width  = 1200;
                $thumb_height = 900;
                $video_height = 900;
            } else if ( $columns == "2" ) {
                $thumb_width  = 800;
                $thumb_height = 600;
                $video_height = 600;
            } else if ( $columns == "3" || $columns == "4" ) {
                if ( $fullwidth == "yes" ) {
                    $thumb_width  = 500;
                    $thumb_height = 375;
                    $video_height = 375;
                } else {
                    $thumb_width  = 400;
                    $thumb_height = 300;
                    $video_height = 300;
                }
            }

            if ( $display_type == "masonry" || $display_type == "masonry-gallery" ) {
                $thumb_height = null;
            }


            $thumb_type               = ss_get_post_meta( $post->ID, 'ss_thumbnail_type', true );
            $thumb_image              = rwmb_meta( 'ss_thumbnail_image', 'type=image&size=full' );
            $thumb_video              = ss_get_post_meta( $post->ID, 'ss_thumbnail_video_url', true );
            $thumb_gallery            = rwmb_meta( 'ss_thumbnail_gallery', 'type=image&size=thumb-image' );
            
            $thumb_link_type          = ss_get_post_meta( $post->ID, 'ss_thumbnail_link_type', true );
            $thumb_link_url           = ss_get_post_meta( $post->ID, 'ss_thumbnail_link_url', true );
            $thumb_lightbox_thumb     = rwmb_meta( 'ss_thumbnail_image', 'type=image&size=large' );
            $thumb_lightbox_image     = rwmb_meta( 'ss_thumbnail_link_image', 'type=image&size=large' );
            $thumb_lightbox_video_url = ss_get_post_meta( $post->ID, 'ss_thumbnail_link_video_url', true );
            $thumb_lightbox_video_url = ss_get_embed_src( $thumb_lightbox_video_url );
            $port_hover_bg_color      = ss_get_post_meta( $post->ID, 'ss_port_hover_bg_color', true );
            $port_hover_text_color    = ss_get_post_meta( $post->ID, 'ss_port_hover_text_color', true );
            $image_id                 = 0;
            $item_link                = ss_post_item_link();

            if ( $port_hover_bg_color != "" ) {
                $port_hover_style  = 'style="background-color: ' . $port_hover_bg_color . ';"';
            }

            if ( $port_hover_text_color != "" ) {
                $port_hover_text_style = 'style="color: ' . $port_hover_text_color . ';"';
            }

            foreach ( $thumb_image as $detail_image ) {
                $image_id      = $detail_image['ID'];
                $thumb_img_url = $detail_image['url'];
                break;
            }

            if ( ! $thumb_image ) {

                $thumb_image   = get_post_thumbnail_id();
                $image_id      = $thumb_image;
                $thumb_img_url = wp_get_attachment_url( $thumb_image, 'full' );
            }

            $thumb_lightbox_img_url = wp_get_attachment_url( $thumb_lightbox_image, 'full' );
            $image_alt              = esc_attr( ss_get_post_meta( $thumb_image_id, '_wp_attachment_image_alt', true ) );

            $item_title     = get_the_title();
            $item_subtitle  = ss_get_post_meta( $post->ID, 'ss_portfolio_subtitle', true );
            $permalink      = get_permalink();
            $item_link      = ss_portfolio_item_link();
            $custom_excerpt = ss_get_post_meta( $post->ID, 'ss_custom_excerpt', true );
            $post_excerpt   = '';

            if ( $custom_excerpt != '' ) {
                $post_excerpt = ss_custom_excerpt( $custom_excerpt, $excerpt_length );
            } else {
                $post_excerpt = wp_trim_words( get_the_excerpt(), $excerpt_length );
            }

            if ( $display_type == "gallery" || $display_type == "masonry-gallery" ) {
                $item_count .= '<figure class="animated-overlay overlay-style">' . "\n";
            } else {
                $item_figure .= '<figure class="animated-overlay overlay-alt">' . "\n";
            }

            if ( $thumb_type == "video" ) {

                $video = ss_video_embed( $thumb_video, $thumb_width, $video_height );

                $item_figure .= '<div class="video-thumb">' . $video . '</div>';

            } else if ( $thumb_type == "slider" ) {
                wp_enqueue_script( 'flexslider' );

                $item_figure .= '<div class="flexslider thumb-slider"><ul class="slides">' . "\n";

                foreach ( $thumb_gallery as $image ) {
                    $item_figure .= "<li><a " . $item_link['config'] . "><img src='{$image['url']}' width='{$image['width']}' height='{$image['height']}' alt='{$image['alt']}' /></a></li>" . "\n";
                }

                $item_figure .= '</ul></div>' . "\n";

            } else {

                $image = aq_resize( $thumb_img_url, $thumb_width, $thumb_height, null, true, false );
                $thumbnail_id = get_post_thumbnail_id( $post->ID );
                $image_alt    = ss_get_post_meta( $image_id, '_wp_attachment_image_alt', true );

                if ( $thumb_img_url != "" ) {
                    if ( $image ) {
                        $item_figure .= '<div class="img-wrap"><img itemprop="image" src="' . $image . '" width="' . $thumb_width . '" height="' . $thumb_height . '" /></div>';
                    }
                    $item_figure .= '<a ' . $item_link['config'] . '></a>';
                }

                $item_figure .= '<div class="figcaption-wrap"></div>';

                if ( $item_subtitle != "" && $hover_show_excerpt == "no" && ( $display_type == "gallery" || $display_type == "masonry-gallery" ) ) {
                    $item_figure .= '<figcaption ' . $port_hover_style . '><div class="thumb-info">';
                } else if ( $display_type == "standard" || $display_type == "masonry" ) {
                    $item_figure .= '<figcaption ' . $port_hover_style . '><div class="thumb-info thumb-info-alt">';
                } else if ( $hover_show_excerpt == "yes" && ( $display_type == "gallery" || $display_type == "masonry-gallery" ) ) {
                    $item_figure .= '<figcaption ' . $port_hover_style . '><div class="thumb-info thumb-info-excerpt">';
                } else {
                    $item_figure .= '<figcaption ' . $port_hover_style . '><div class="thumb-info">';
                }
                if ( $display_type == "gallery" || $display_type == "masonry-gallery" ) {
                    if ( $hover_show_excerpt == "yes" ) {
                        $item_figure .= '<h4 itemprop="name headline" ' . $port_hover_text_style . '>' . $item_title . '</h4>';
                        if ( $post_excerpt != "" ) {
                            
                            $item_figure .= '<div itemprop="description" ' . $port_hover_text_style . '>' . $post_excerpt . '</div>';
                        }
                    } else {
                        $item_figure .= '<h4 itemprop="name headline" ' . $port_hover_text_style . '>' . $item_title . '</h4>';
                        if ( $item_subtitle != "" ) {
                            
                            $item_figure .= '<h5 itemprop="name alternativeHeadline" ' . $port_hover_text_style . '>' . $item_subtitle . '</h5>';
                        }
                    }
                } 

                $item_figure .= '</div></figcaption>';
            }

            $item_figure .= '</figure>';

            return $item_figure;
        }
    }

    if ( ! function_exists( 'ss_portfolio_items' )) {
        function ss_portfolio_items( $display_type = 'gallery', $post_type = "portfolio", $category = "portfolio", $columns = '2', $show_title = "", $show_subtitle = "", $hover_show_excerpt = "", $show_excerpt = "", $excerpt_length = "20", $gutters = 'no', $fullwidth = 'no') {

            global $post, $wp_query, $ss_theme_options;
            
            if ( $category == "All" ) {
                $category = "all";
            }
            if ( $category == "all" ) {
                $category = '';
            }
            $category_slug = str_replace( '_', '-', $category );

            $categories = explode(",", $category_slug);
            $translated_categories = '';
            foreach ($categories as $key => $category_slug) {
                $category_id_by_slug = get_term_by('slug', $category_slug, 'portfolio-category');
                if ( isset( $category_id_by_slug->term_id ) ) {
                    $translated_slug_id = apply_filters('wpml_object_id', $category_id_by_slug->term_id, 'custom taxonomy', true);
                    $translated_slug = get_term_by('id', $translated_slug_id, 'portfolio-category');
                    $translated_categories = $translated_categories.($key < count($categories)-1 ? $translated_slug->slug.',': $translated_slug->slug );
                }
            }


            if ( get_query_var( 'paged' ) ) {
                $paged = get_query_var( 'paged' );
            } elseif ( get_query_var( 'page' ) ) {
                $paged = get_query_var( 'page' );
            } else {
                $paged = 1;
            }

            $item_count = -1;

            $portfolio_args = array(
                'post_type' => $post_type,
                'post_status' => 'publish',
                'paged' => $paged,
                'portfolio-category' => $translated_categories,
                'posts_per_page' => $item_count,
            );

            $portfolio_items = new WP_Query( $portfolio_args );

            $list_class = '';
            if ( $display_type == "masonry" || $display_type == "masonry-gallery" ) {
                $list_class .= 'masonry-items filterable-items col-' . $columns . ' row clearfix';
            } else if ( $display_type == "gallery" ) {
                $list_class .= 'gallery-portfolio filterable-items col-' . $columns . ' row clearfix';
            } else {
                $list_class .= 'standard-portfolio filterable-items col-' . $columns . ' row clearfix';
            }

            // Full width
            if ( $fullwidth == "yes" ) {
                $list_class .= ' portfolio-full-width';
            }

            // Gutters
            if ( $gutters == "no" ) {
                $list_class .= ' no-gutters';
            } else {
                $list_class .= ' gutters';
            }
            //$grid_size = 'col-sm-4';

            $portfolio_items_output .= '<ul class="portfolio-items ' . $list_class . '">' . "\n";

            while ( $portfolio_items->have_posts() ) : $portfolio_items->the_post();

                $thumb_type     = ss_get_post_meta( $post->ID, 'ss_thumbnail_type', true );
                $item_title     = get_the_title();
                $item_subtitle  = ss_get_post_meta( $post->ID, 'ss_portfolio_subtitle', true );
                $permalink      = get_permalink();
                $custom_excerpt = ss_get_post_meta( $post->ID, 'ss_custom_excerpt', true );

                $post_excerpt   = '';
                if ( $custom_excerpt != '' ) {
                    $post_excerpt = ss_custom_excerpt( $custom_excerpt, $excerpt_length );
                } else {
                    $post_excerpt = wp_trim_words( get_the_excerpt(), $excerpt_length );
                }


                $taxonomy_name = 'category';
                if ( $post_type != "post") {
                    $taxonomy_name = $post_type . '-category';
                }
                if ( $taxonomy_name == "product-category" ) {
                    $taxonomy_name = "product_cat";
                }
                $post_terms = get_the_terms( $post->ID, $taxonomy_name );
                $term_slug  = " ";

                if ( ! empty( $post_terms ) ) {
                    foreach ( $post_terms as $post_term ) {
                        $term_slug = $term_slug . strtolower($post_term->slug) . ' ';
                    }
                }

                $item_class = "";

                if ( $columns == "1" ) {
                    $item_class = "col-sm-12 ";
                } else if ( $columns == "2" ) {
                    $item_class = "col-sm-6 ";
                } else if ( $columns == "3" ) {
                    $item_class = "col-sm-4 ";
                } else if ( $columns == "4" ) {
                    $item_class = "col-sm-3 ";
                } 

                $masonry_thumb_size = ss_get_post_meta( get_the_ID(), 'ss_masonry_thumb_size', true );

                if ( $display_type == "masonry") {
                    $item_class .= "masonry-item masonry-gallery-item";
                } else if ( $display_type == "masonry-gallery" ) {
                    $item_class .= "masonry-item masonry-gallery-item gallery-item";
                } else if ( $display_type == "gallery" ) {
                    $item_class .= "gallery-item ";
                } else {
                    $item_class .= "standard ";
                }
                $item_class = apply_filters( 'ss_portfolio_item_class', $item_class );

                $item_link = ss_portfolio_item_link();

                $portfolio_items_output .= '<li itemscope itemtype="http://schema.org/CreativeWork" data-id="id-' . $count . '" class="clearfix portfolio-item ' . $item_class . ' ' . $term_slug . '">' . "\n";

                $portfolio_items_output .= '<div class="portfolio-item-wrap">' . "\n";

                $portfolio_items_output .= ss_portfolio_thumbnail( $display_type, $columns, $hover_show_excerpt, $excerpt_length, $gutters, $fullwidth );

                $port_title_tag = apply_filters( 'ss_portfolio_item_title_tag' , 'h3');
                $port_subtitle_tag = apply_filters( 'ss_portfolio_item_subtitle_tag' , 'h5');
                
                if ( $display_type != "gallery" && $display_type != "masonry-gallery" ) {

                    $portfolio_items_output .= '<div class="portfolio-item-details">' . "\n";

                    if ( $show_title == "yes" ) {

                        $portfolio_items_output .= '<'.$port_title_tag.' class="portfolio-item-title" itemprop="name headline"><a ' . $item_link['title_config'] . '>' . $item_title . '</a></'.$port_title_tag.'>' . "\n";
                    }
                    if ( $show_subtitle == "yes" && $item_subtitle ) {
                        $portfolio_items_output .= '<'.$port_subtitle_tag.' class="portfolio-subtitle" itemprop="name alternativeHeadline">' . $item_subtitle . '</'.$port_subtitle_tag.'>' . "\n";
                    }
                    if ( $show_excerpt == "yes" ) {
                        $portfolio_items_output .= '<div class="portfolio-item-excerpt" itemprop="description">' . $post_excerpt . '</div>' . "\n";
                    }

                    $portfolio_items_output .= '</div>' . "\n";

                }

                $portfolio_items_output .= '</div>' . "\n";
                
                $portfolio_items_output .= '</li>' . "\n";

                $count ++;

            endwhile;

            wp_reset_query();
            wp_reset_postdata();

            $portfolio_items_output .= '</ul>' . "\n";

            return $portfolio_items_output;
       }
    }

    if ( ! function_exists( 'ss_portfolio_item_link' ) ) {
        function ss_portfolio_item_link() {

            $link_config = $thumb_img_url = "";

            global $post, $ss_theme_options;

            $thumb_image              = rwmb_meta( 'ss_thumbnail_image', 'type=image&size=full' );
            $thumb_link_type          = ss_get_post_meta( $post->ID, 'ss_thumbnail_link_type', true );
            $thumb_link_url           = ss_get_post_meta( $post->ID, 'ss_thumbnail_link_url', true );
            $thumb_lightbox_thumb     = rwmb_meta( 'ss_thumbnail_image', 'type=image&size=large' );
            $thumb_lightbox_image     = rwmb_meta( 'ss_thumbnail_link_image', 'type=image&size=large' );
            $thumb_lightbox_video_url = ss_get_post_meta( $post->ID, 'ss_thumbnail_link_video_url', true );
            $thumb_lightbox_video_url = ss_get_embed_src( $thumb_lightbox_video_url );
            $permalink                = get_permalink();
            $thumb_img_id = 0;

            foreach ( $thumb_image as $detail_image ) {
                $thumb_img_id = $detail_image['ID'];
                $thumb_img_url = $detail_image['url'];
                break;
            }

            if ( ! $thumb_image ) {
                $thumb_image   = get_post_thumbnail_id();
                $thumb_img_id  = $thumb_image;
                $thumb_img_url = wp_get_attachment_url( $thumb_image, 'full' );
            }
            
            $image_meta = ss_get_attachment_meta( $thumb_img_id );
            
            if ( isset($image_meta) ) {
                $image_caption      = esc_attr( $image_meta['caption'] );
                $image_title        = esc_attr( $image_meta['title'] );
                $image_alt          = esc_attr( $image_meta['alt'] );
            }


            if ( $thumb_link_type == "link_to_url" ) {
                $link_config = 'href="' . $thumb_link_url . '" class="link-to-url"';
                $title_config = $link_config;
            } else if ( $thumb_link_type == "link_to_url_nw" ) {
                $link_config = 'href="' . $thumb_link_url . '" class="link-to-url" target="_blank"';
                $title_config = $link_config;
            } else if ( $thumb_link_type == "lightbox_thumb" ) {
                if ( $thumb_img_url != "" ) {
                    $link_config = 'href="' . $thumb_img_url . '" class="lightbox" data-rel="ilightbox[portfolio]" data-caption="'.$image_caption.'"';                    
                }
                $title_config = 'href="' . $permalink . '" class="link-to-post"';
            } else if ( $thumb_link_type == "lightbox_image" ) {
                $lightbox_image_url = '';
                foreach ( $thumb_lightbox_image as $image ) {
                    $thumb_img_id = $image['ID'];
                    $lightbox_image_url = $image['full_url'];
                }
                $image_meta = sf_get_attachment_meta( $thumb_img_id );
                
                if ( isset($image_meta) ) {
                    $image_caption      = esc_attr( $image_meta['caption'] );
                    $image_title        = esc_attr( $image_meta['title'] );
                    $image_alt          = esc_attr( $image_meta['alt'] );
                }
                if ( $lightbox_image_url != "" ) {
                    $link_config = 'href="' . $lightbox_image_url . '" class="lightbox" data-rel="ilightbox[portfolio]" data-caption="'.$image_caption.'"';
                }
                $title_config = 'href="' . $permalink . '" class="link-to-post"';
            } else if ( $thumb_link_type == "lightbox_video" ) {
                $link_config = 'data-video="' . $thumb_lightbox_video_url . '" href="#" class="fw-video-link"';
                $title_config = $link_config;
            } else {
                $link_config = 'href="' . $permalink . '" class="link-to-post"';
                $title_config = $link_config;
            }

            $item_link = array(
                "config"    => $link_config,
                "title_config"  => $title_config
            );

            return $item_link;
        }
    }

    if ( ! function_exists( 'ss_portfolio_detail_media' ) ) {
        function ss_portfolio_detail_media() {
            global $post, $ss_theme_options;
            $media_type = $media_image = $media_video = $media_audio = $media_mp4 = $media_ogg = $media_webm = $media_gallery = $image_alt = '';

            $use_thumb_content    = ss_get_post_meta( $post->ID, 'ss_thumbnail_content_main_detail', true );
            $item_categories      = get_the_term_list( $post->ID, 'portfolio-category', '<li>', '</li><li>', '</li>' );
            $item_link            = ss_get_post_meta( $post->ID, 'ss_portfolio_external_link', true );

            if ( $use_thumb_content ) {
                $media_type    = ss_get_post_meta( $post->ID, 'ss_thumbnail_type', true );
                $media_image   = rwmb_meta( 'sf_thumbnail_image', 'type=image&size=full' );
                $media_video   = ss_get_post_meta( $post->ID, 'ss_thumbnail_video_url', true );
                $media_gallery = rwmb_meta( 'sf_thumbnail_gallery', 'type=image&size=thumb-image-onecol' );
                $media_mp4     = ss_get_post_meta( $post->ID, 'ss_thumbnail_video_mp4', true );
                $media_ogg     = ss_get_post_meta( $post->ID, 'ss_thumbnail_video_ogg', true );
                $media_webm    = ss_get_post_meta( $post->ID, 'ss_thumbnail_video_webm', true );
            } else {
                $media_type        = ss_get_post_meta( $post->ID, 'ss_detail_type', true );
                $media_image       = rwmb_meta( 'ss_detail_image', 'type=image&size=full' );
                $media_video       = ss_get_post_meta( $post->ID, 'ss_detail_video_url', true );
                $media_gallery     = rwmb_meta( 'ss_detail_gallery', 'type=image&size=thumb-image-onecol' );
                $media_slider      = ss_get_post_meta( $post->ID, 'ss_detail_rev_slider_alias', true );
                $media_layerslider = ss_get_post_meta( $post->ID, 'ss_detail_layer_slider_alias', true );
                $custom_media      = ss_get_post_meta( $post->ID, 'ss_custom_media', true );
                $media_audio       = ss_get_post_meta( $post->ID, 'ss_detail_audio_url', true );
                $media_mp4         = ss_get_post_meta( $post->ID, 'ss_detail_video_mp4', true );
                $media_ogg         = ss_get_post_meta( $post->ID, 'ss_detail_video_ogg', true );
                $media_webm        = ss_get_post_meta( $post->ID, 'ss_detail_video_webm', true );
            }

            foreach ( $media_image as $detail_image ) {
                $media_image_url = $detail_image['url'];
                $share_image_url = $media_image_url;
                $image_alt       = esc_attr( ss_get_post_meta( $detail_image['ID'], '_wp_attachment_image_alt', true ) );
                break;
            }

            if ( ! $media_image ) {
                $media_image     = get_post_thumbnail_id();
                $media_image_url = wp_get_attachment_url( $media_image, 'full' );
                $share_image_url = $media_image_url;
                $image_alt       = esc_attr( ss_get_post_meta( $media_image, '_wp_attachment_image_alt', true ) );
            }

          
            // META VARIABLES
            $media_width  = 850;
            $video_height = 638;
            $media_height = null;
            
            ?>
            <figure class="media-wrap container media-type-<?php echo esc_attr($media_type); ?>">
                <?php if ( $media_type == "video" ) { ?>

                    <?php echo sf_video_embed( $media_video, $media_width, $video_height ); ?>

                <?php } else if ( $media_type == "slider" ) { ?>
                    <?php wp_enqueue_script( 'flexslider' ); ?>
                    <div class="flexslider item-slider">
                        <ul class="slides">
                            <?php foreach ( $media_gallery as $image ) {
                            echo "<li>";
                            if ( ! empty( $image['caption'] ) ) {
                                echo "<p class='flex-caption'>{$image['caption']}</p>";
                            }
                            echo "<img src='{$image['url']}' width='{$image['width']}' height='{$image['height']}' alt='{$image['alt']}' />";
                            echo "</li>";
                        } ?>
                        </ul>
                    </div>
                <?php } else if ( $media_type == "gallery-stacked" ) { ?>

                    <?php foreach ( $media_gallery as $image ) {
                        echo "<img src='{$image['url']}' width='{$image['width']}' height='{$image['height']}' alt='{$image['alt']}' />";
                    } ?>
                <?php } else if ( $media_type == "layer-slider" ) { ?>
                    <div class="layerslider">
                        <?php if ( $media_slider != "" ) {
                            echo do_shortcode( '[rev_slider ' . $media_slider . ']' );
                        } else {
                            echo do_shortcode( '[layerslider id="' . $media_layerslider . '"]' );
                        } ?>
                    </div>
                <?php } else if ( $media_type == "sh-video" ) {
                    $media_mp4  = 'mp4="' . $media_mp4 . '"';
                    $media_ogg  = 'ogg="' . $media_ogg . '"';
                    $media_webm = 'webm="' . $media_webm . '"';
                    $poster     = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large', true );
                    if ( isset( $poster ) & $poster != "" ) {
                        $poster = 'poster="' . $poster[0] . '"';
                    }
                    ?>
                    <div class="sh-video-wrap">
                        <?php echo do_shortcode( '[video ' . $media_mp4 . ' ' . $media_ogg . ' ' . $media_webm . ' ' . $poster . ']' ); ?>
                    </div>
                <?php } else if ( $media_type == "audio" ) {

                        echo do_shortcode( '[audio src="' . $media_audio . '"]' );

                    } else if ( $media_type == "custom" ) {

                        echo do_shortcode( $custom_media );

                    } else {
                    ?>
                        <?php $detail_image = aq_resize( $media_image_url, $media_width, $media_height, null, true, false ); 
                        ?>
                        <img itemprop="image" src="<?php echo $detail_image; ?>" width="<?php echo $media_width; ?>" height="<?php echo $media_height; ?>" />
                    <?php } ?>
            
            </figure>
        <?php
        }
        add_action( 'ss_portfolio_article_start', 'ss_portfolio_detail_media', 10 );
    }

    if ( ! function_exists( 'ss_portfolio_item_details' ) ) {
        function ss_portfolio_item_details() {
            global $post;
            $client               = ss_get_post_meta( $post->ID, 'ss_portfolio_client', true );
            $item_link            = ss_get_post_meta( $post->ID, 'ss_portfolio_external_link', true );
            $item_categories      = get_the_term_list( $post->ID, 'portfolio-category', '<li>', '</li><li>', '</li>' );
            $link_icon           = apply_filters( 'ss_link_icon', '<i class="fa fa-link" aria-hidden="true"></i>
' );
            ?>
            <section class="item-details">
                    <?php if ( $client != "" ) { ?>
                        <div class="client"><span><?php _e( "Client:", SS_DOMAIN ); ?></span><?php echo esc_attr($client); ?></div>
                    <?php } ?>
                    
                    <?php if ( $item_link != "" ) { ?>
                        <a class="item-link" href="<?php echo esc_url($item_link); ?>" target="_blank"><?php echo $link_icon; ?><?php _e( "View Project", SS_DOMAIN ); ?></a>
                    <?php } ?>
                    <?php if ( $item_categories != "" ) { ?>
                        <ul class="portfolio-categories">
                            <?php echo $item_categories; ?>
                        </ul>
                    <?php } ?>
            </section>
        
        <?php
        }
        add_action( 'ss_after_portfolio_content', 'ss_portfolio_item_details', 0 );
    }
?>