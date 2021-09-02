<?php

if ( !class_exists( 'Penci_Social_Share' ) ):
	class Penci_Social_Share {
		/**
		 * @param $list_social array( 'total_share','facebook','twitter','google_plus','pinterest','linkedin','tumblr','reddit' ,'stumbleupon','email'  )
		 * @param bool $echo
		 *
		 * @return string
		 */
		public static function get_social_share( $list_social, $echo = true, $show_count = true ) {
			$output      = '';
			$total_share = 0;

			$post_id = get_the_ID();
			$expired = get_post_meta( $post_id, 'penci_social_share_interval', true );
			$time_current = time();
			$results = array();
			$update_cache = false;
			if ( $expired < $time_current ) {
				$update_cache = true;
			}

			foreach ( ( array ) $list_social as $social ) {

				$link     = get_permalink();
				$text     = get_the_title();
				$img_link = penci_get_featured_image_size( $post_id, 'post-thumbnail' );

				if( 'total_share' == $social ){
					continue;
				}elseif ( 'email' == $social ) {
					$output .= sprintf(
						'<a class="penci-social-item email" target="_blank" href="%s"><i class="fa fa-envelope"></i></a>',
						self::get_link_share_post( 'email', $link, $text, $img_link = '' )
					);

					continue;
				}elseif ( 'whatsapp' == $social ) {
					$output .= sprintf(
						'<a class="penci-social-item whatsapp" data-text="%s" data-link="%s" href="#"><i class="fa fa-whatsapp"></i></a>',
						get_the_title( $post_id ),
						$link
					);

					add_action( 'wp_footer', array( __CLASS__, 'whatsapp_script' ) );
					continue;
				}

				$link_share  = self::get_link_share_post( $social, $link, $text, $img_link );

				$count_share = 0;
				if( $show_count ){

					if ( ! $update_cache ) {
						$count_shares = get_post_meta( $post_id, 'penci_social_count_shares', true );
						$count_share = isset( $count_shares[ $social ] ) ? intval( $count_shares[ $social ] ) : '';

						if ( empty( $count_share ) && 0 !== $count_share ) {
							$count_share = self::get_social_share_count( $social, $link );
							$results[$social] = $count_share;
						}
					} else {
						$count_share = self::get_social_share_count( $social, $link );
						$results[$social] = $count_share;
					}
				}

				if ( $update_cache && $results ) {
					$cache_time = apply_filters( 'penci_social_share_cachetime', MINUTE_IN_SECONDS * 240, $post_id );
					update_post_meta( $post_id, 'penci_social_share_interval', time() + $cache_time );
					update_post_meta( $post_id, 'penci_social_count_shares', $results );
				}

				$total_share += intval( $count_share );

				$output .= sprintf(
					'<a class="penci-social-item %s" target="_blank" title="%s" href="%s"><i class="fa fa-%s"></i>%s</a>',
					esc_attr( $social ),
					penci_get_setting( 'penci_socail_title_' . $social ),
					esc_url( $link_share ),
					'google_plus' == $social ? 'google-plus' : esc_attr( $social ),
					$show_count && $count_share ? '<span class="penci-share-number">' . esc_html( $count_share ) . '</span>' : ''

				);
			}

			if ( in_array( 'total_share', $list_social ) ) {
				$total_share = sprintf( '<span class="share-handler penci-social-item"><i class="fa fa-share-alt"></i><span class="penci-share-number">%s</span></span>', esc_html( $total_share ) );
				$output      = $total_share . $output;
			}

			if ( ! $echo ) {
				return $output;
			}

			echo ( $output );
		}

		public static function get_link_share_post( $social_key, $link, $text = '', $img_link = '' ) {
			switch ( $social_key ) {
				case 'facebook':
					$link = htmlentities( add_query_arg( array( 'u' => rawurlencode( $link ), ), 'https://www.facebook.com/sharer/sharer.php' ) );;
					break;
				case 'twitter':
					$link = htmlentities( add_query_arg( array(
						'url'  => rawurlencode( $link ),
						'text' => rawurlencode( $text ),
					), 'https://twitter.com/intent/tweet' ) );
					break;
				case 'pinterest':
					$link = htmlentities( add_query_arg( array(
						'url'         => rawurlencode( $link ),
						'media'       => rawurlencode( $img_link ),
						'description' => rawurlencode( $text ),
					), esc_url( 'http://pinterest.com/pin/create/button' ) ) );
					break;

				case 'google_plus':
					$link = htmlentities( add_query_arg( array( 'url' => rawurlencode( $link ), ), 'https://plus.google.com/share' ) );
					break;

				case 'linkedin':
					$link = htmlentities( add_query_arg( array(
						'url'   => rawurlencode( $link ),
						'title' => rawurlencode( $text ),
					), 'https://www.linkedin.com/shareArticle?mini=true' ) );
					break;

				case 'tumblr':
					$link = htmlentities( add_query_arg( array(
						'url'  => rawurlencode( $link ),
						'name' => rawurlencode( $text ),
					), 'https://www.tumblr.com/share/link' ) );
					break;
				case 'reddit':
					$link = htmlentities( add_query_arg( array(
						'url'   => rawurlencode( $link ),
						'title' => rawurlencode( $text ),
					), 'https://reddit.com/submit' ) );
					break;
				case 'stumbleupon':
					$link = htmlentities( add_query_arg( array(
						'url'   => rawurlencode( $link ),
						'title' => rawurlencode( $text ),
					), 'https://www.stumbleupon.com/submit' ) );
					break;
				case 'email':
					$link = esc_url ( 'mailto:?subject=' . $text . '&BODY=' . $link );
					break;
				case 'telegram':
					$link = htmlentities( add_query_arg( array(
						'url'  => rawurlencode( $link ),
						'text' => rawurlencode( $text ),
					), 'https://telegram.me/share/url' ) );
					break;

				case 'whatsapp':
					$link = htmlentities( add_query_arg( array(
						'text' => rawurlencode( $text ) . ' %0A%0A ' . rawurlencode( $link ),
					), 'whatsapp://send' ) );
					break;

				case 'digg':
					$link = htmlentities( add_query_arg( array(
						'url' => rawurlencode( $link ),
					), 'https://www.digg.com/submit' ) );
					break;
				case 'vk':
					$link = htmlentities( add_query_arg( array(
						'url' => rawurlencode( $link ),
					), 'https://vkontakte.ru/share.php' ) );
					break;

				case 'line':
					$link = htmlentities( add_query_arg( array(
						'text' => rawurlencode( $text ) . ' %0A%0A ' . rawurlencode( $link ),
					), 'https://line.me/R/msg/text/' ) );
					break;

				case 'bbm':
					$link = htmlentities( add_query_arg( array(
						'userCustomMessage' => rawurlencode( $text ) . '%0D%0A' . rawurlencode( $link ),
					), 'bbmi://api/share?message=Hello' ) );
					break;

				case 'viber':
					$link = htmlentities( add_query_arg( array(
						'text' => rawurlencode( $text ) . ' ' . rawurlencode( $link ),
					), 'viber://forward' ) );
					break;
				default:
					return '';
			}

			return $link;
		}

		/**
		 * Create a new function based on jonathanmoore core - source: https://gist.github.com/jonathanmoore/2640302
		 *
		 * @param $social_key
		 * @param $url
		 *
		 * @return int
		 */
		public static function  get_social_share_count( $social_key, $url ) {
			$count        = 0;

			$is_localhost = self::is_localhost();

			if ( $is_localhost ) {
				return 0;
			}

			$remote_args = array(
				'timeout'   => 18,
				'sslverify' => false,
			);

			switch ( $social_key ) {
				case 'facebook':
					$remote = wp_remote_get( "http://graph.facebook.com/?id=" . urlencode( $url ), $remote_args );
					if ( ! is_wp_error( $remote ) ) {
						$response = json_decode( wp_remote_retrieve_body( $remote ), true );
						$count    = isset( $response['share']['share_count'] ) ? $response['share']['share_count'] : 0;
					}
					break;
				case 'twitter':
					// Create a new function based on newsharecounts core - source: http://newsharecounts.com/done/
					$remote = wp_remote_get( 'http://public.newsharecounts.com/count.json?url=' . urlencode( $url ), $remote_args );
					if ( ! is_wp_error( $remote ) ) {
						$response = json_decode( wp_remote_retrieve_body( $remote ), true );
						$count    = isset( $response['count'] ) ? $response['count'] : 0;
					}

					break;
				case 'pinterest':

					$remote = wp_remote_get( 'http://api.pinterest.com/v1/urls/count.json?callback=callback&url=' . urlencode( $url ), $remote_args );

					if ( ! is_wp_error( $remote ) ) {

						$pattern = '/^\s*callback\s*\((.+)\)\s*$/';
						$subject = wp_remote_retrieve_body( $remote );

						if ( preg_match( $pattern, $subject, $match ) ) {
							$response = json_decode( $match[1], true );

							if ( isset( $response['count'] ) ) {
								$count = $response['count'];
							}
						}
					}
					break;
				case 'google_plus':

					$remote_args['headers'] = 'Content-type: application/json';
					$remote_args['body']    = '[{"method":"pos.plusones.get","id":"p","params":{"nolog":true,"id":"' . rawurldecode( $url ) . '","source":"widget","userId":"@viewer","groupId":"@self"},"jsonrpc":"2.0","key":"p","apiVersion":"v1"}]';

					$remote = wp_remote_post( 'https://clients6.google.com/rpc', $remote_args );

					if ( ! is_wp_error( $remote ) ) {
						$response = json_decode( wp_remote_retrieve_body( $remote ), true );
						$count    = isset( $response[0]['result']['metadata']['globalCounts']['count'] ) ? $response[0]['result']['metadata']['globalCounts']['count'] : 0;
					}
					break;
				case 'linkedin':
					$remote = wp_remote_get( 'https://www.linkedin.com/countserv/count/share?format=json&url=' . rawurldecode( $url ), $remote_args );

					if ( ! is_wp_error( $remote ) ) {
						$response = json_decode( wp_remote_retrieve_body( $remote ), true );
						$count    = isset( $response['count'] ) ? $response['count'] : 0;
					}

					break;
				case 'tumblr':
					$remote = wp_remote_get( 'http://api.tumblr.com/v2/share/stats?url=' . rawurldecode( $url ), $remote_args );

					if ( ! is_wp_error( $remote ) ) {
						$response = json_decode( wp_remote_retrieve_body( $remote ), true );
						$count    = isset( $response['response']['note_count'] ) ? $response['response']['note_count'] : 0;
					}

					break;
				case 'reddit':
					$remote = wp_remote_get( 'http://www.reddit.com/api/info.json?url=' . $url, $remote_args );

					if ( ! is_wp_error( $remote ) ) {
						$response = json_decode( $remote['body'], true );
						$count    = isset( $response['data']['children']['0']['data']['score'] ) ? $response['data']['children']['0']['data']['score'] : 0;
					}

					break;
				case 'stumbleupon':
					$remote = wp_remote_get( 'http://www.stumbleupon.com/services/1.01/badge.getinfo?url=' . $url, $remote_args );

					if ( ! is_wp_error( $remote ) ) {
						$response = json_decode( $remote['body'], true );
						$count    = isset( $response['result']['views'] ) ? $response['result']['views'] : 0;
					}

					break;
			}

			return $count;
		}

		public static function whatsapp_script()  {
			?>
			<script type="text/javascript">
				jQuery(document).ready(function() {
					jQuery('.penci-social-item.whatsapp').on("click", function(e) {
						if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
							var article = jQuery(this).attr("data-text");
							var weburl = jQuery(this).attr("data-link");
							var whats_app_message = encodeURIComponent(article)+" - "+encodeURIComponent(weburl);
							var whatsapp_url = "whatsapp://send?text="+whats_app_message;
							window.location.href= whatsapp_url;
						}else{
							alert('<?php echo penci_get_tran_setting('penci_mess_whatsapp'); ?>');
						}
					});
				});
			</script>
			<?php
		}

		public static function is_localhost() {
			$whitelist = array( '127.0.0.1', '::1' );

			if ( ! function_exists( 'penci_get_server_value' ) ) {
				return false;
			}
			$REMOTE_ADDR = penci_get_server_value( 'REMOTE_ADDR' );
			if ( in_array( $REMOTE_ADDR, $whitelist ) ) {
				return true;
			}
		}

	}
endif;