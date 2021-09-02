<?php
/**
 * ZOLOcode Framework
 */

// Exit if accessed directly
if( ! defined( 'ABSPATH' ) ) {
	die;
}
add_action( 'wp_nav_menu_item_custom_fields', 'apress_add_megamenu_fields', 10, 4 );
function apress_add_megamenu_fields( $item_id, $item, $depth, $args ) { ?>

	<div class="clear"></div>
    <div class="zolo-mega-menu-options">
        <p class="field-megamenu-status description description-wide">
            <label for="edit-menu-item-megamenu-status-<?php echo $item_id; ?>">
                <input type="checkbox" id="edit-menu-item-megamenu-status-<?php echo $item_id; ?>" class="widefat code edit-menu-item-megamenu-status" name="menu-item-zolo-megamenu-status[<?php echo $item_id; ?>]" value="enabled" <?php checked( $item->zolo_megamenu_status, 'enabled' ); ?> />
                <strong><?php _e( 'Enable Mega Menu', 'apress' ); ?></strong>
            </label>
        </p>
        <p class="field-megamenu-width description description-wide">
            <label for="edit-menu-item-megamenu-width-<?php echo $item_id; ?>">
                <input type="checkbox" id="edit-menu-item-megamenu-width-<?php echo $item_id; ?>" class="widefat code edit-menu-item-megamenu-width" name="menu-item-zolo-megamenu-width[<?php echo $item_id; ?>]" value="fullwidth" <?php checked( $item->zolo_megamenu_width, 'fullwidth' ); ?> />
                <?php _e( 'Full Width Mega Menu', 'apress' ); ?>
            </label>
        </p>
        <p class="field-megamenu-columns description description-wide">
            <label for="edit-menu-item-megamenu-columns-<?php echo $item_id; ?>">
                <?php _e( 'Mega Menu Number of Columns', 'apress' ); ?>
                <select id="edit-menu-item-megamenu-columns-<?php echo $item_id; ?>" class="widefat code edit-menu-item-megamenu-columns" name="menu-item-zolo-megamenu-columns[<?php echo $item_id; ?>]">
                    <option value="auto" <?php selected( $item->zolo_megamenu_columns, 'auto' ); ?>><?php _e( 'Auto', 'apress' ); ?></option>
                    <option value="1" <?php selected( $item->zolo_megamenu_columns, '1' ); ?>>1</option>
                    <option value="2" <?php selected( $item->zolo_megamenu_columns, '2' ); ?>>2</option>
                    <option value="3" <?php selected( $item->zolo_megamenu_columns, '3' ); ?>>3</option>
                    <option value="4" <?php selected( $item->zolo_megamenu_columns, '4' ); ?>>4</option>
                    <option value="5" <?php selected( $item->zolo_megamenu_columns, '5' ); ?>>5</option>
                    <option value="6" <?php selected( $item->zolo_megamenu_columns, '6' ); ?>>6</option>
                </select>
            </label>
        </p>
        <p class="field-megamenu-columnwidth description description-wide" style="display:none!important;">
			<label for="edit-menu-item-megamenu-columnwidth-<?php echo $item_id; ?>">
				<?php _e( 'Mega Menu Column Width (in percentage, ex: 30%)', 'apress' ); ?>
				<input type="text" id="edit-menu-item-megamenu-columnwidth-<?php echo $item_id; ?>" class="widefat code edit-menu-item-megamenu-columnwidth" name="menu-item-zolo-megamenu-columnwidth[<?php echo $item_id; ?>]" value="<?php echo $item->zolo_megamenu_columnwidth; ?>" />
			</label>
		</p>
        <p class="field-megamenu-title description description-wide">
            <label for="edit-menu-item-megamenu-title-<?php echo $item_id; ?>">
                <input type="checkbox" id="edit-menu-item-megamenu-title-<?php echo $item_id; ?>" class="widefat code edit-menu-item-megamenu-title" name="menu-item-zolo-megamenu-title[<?php echo $item_id; ?>]" value="disabled" <?php checked( $item->zolo_megamenu_title, 'disabled' ); ?> />
                <?php _e( 'Disable Mega Menu Column Title', 'apress' ); ?>
            </label>
        </p>
        <p class="field-megamenu-widgetarea description description-wide">
            <label for="edit-menu-item-megamenu-widgetarea-<?php echo $item_id; ?>">
                <?php _e( 'Mega Menu Widget Area', 'apress' ); ?>
                <select id="edit-menu-item-megamenu-widgetarea-<?php echo $item_id; ?>" class="widefat code edit-menu-item-megamenu-widgetarea" name="menu-item-zolo-megamenu-widgetarea[<?php echo $item_id; ?>]">
                    <option value="0"><?php _e( 'Select Widget Area', 'apress' ); ?></option>
                    <?php
					global $wp_registered_sidebars;
                    if( ! empty( $wp_registered_sidebars ) && is_array( $wp_registered_sidebars ) ):
                    foreach( $wp_registered_sidebars as $sidebar ):
                    ?>
                    <option value="<?php echo $sidebar['id']; ?>" <?php selected( $item->zolo_megamenu_widgetarea, $sidebar['id'] ); ?>><?php echo $sidebar['name']; ?></option>
                    <?php endforeach; endif; ?>
                </select>
            </label>
        </p>
        <p class="field-megamenu-icon description description-wide">
            <label for="edit-menu-item-megamenu-icon-<?php echo $item_id; ?>">
                <?php _e( 'Mega Menu Icon (use full font awesome name)', 'apress' ); ?>
                <input type="text" id="edit-menu-item-megamenu-icon-<?php echo $item_id; ?>" class="widefat code edit-menu-item-megamenu-icon" name="menu-item-zolo-megamenu-icon[<?php echo $item_id; ?>]" value="<?php echo $item->zolo_megamenu_icon; ?>" />
            </label>
        </p>
        <a href="#" id="zolo-media-upload-<?php echo $item_id; ?>" class="zolo-open-media button button-primary zolo-megamenu-upload-thumbnail"><?php _e( 'Set Thumbnail', 'apress' ); ?></a>
        <p class="field-megamenu-thumbnail description description-wide">
            <label for="edit-menu-item-megamenu-thumbnail-<?php echo $item_id; ?>">
                <input type="hidden" id="edit-menu-item-megamenu-thumbnail-<?php echo $item_id; ?>" class="zolo-new-media-image widefat code edit-menu-item-megamenu-thumbnail" name="menu-item-zolo-megamenu-thumbnail[<?php echo $item_id; ?>]" value="<?php echo $item->zolo_megamenu_thumbnail; ?>" />
                <img src="<?php echo $item->zolo_megamenu_thumbnail; ?>" id="zolo-media-img-<?php echo $item_id; ?>" class="zolo-megamenu-thumbnail-image" style="<?php echo ( trim( $item->zolo_megamenu_thumbnail ) ) ? 'display: inline;' : '';?>" />
                <a href="#" id="zolo-media-remove-<?php echo $item_id; ?>" class="remove-zolo-megamenu-thumbnail" style="<?php echo ( trim( $item->zolo_megamenu_thumbnail ) ) ? 'display: inline;' : '';?>">Remove Image</a>
            </label>
        </p>
    </div><!-- .zolo-mega-menu-options-->
<?php }

// Dont duplicate me!
if( ! class_exists( 'ZOLOCoreFrontendWalker' ) ) {
	class ZOLOCoreFrontendWalker extends Walker_Nav_Menu {

		/**
		 * @var string $menu_megamenu_status are we currently rendering a mega menu?
		 */
		private $menu_megamenu_status = "";

		/**
		 * @var string $menu_megamenu_width use full width mega menu?
		 */
		private $menu_megamenu_width = "";

		/**
		 * @var int $num_of_columns how many columns should the mega menu have?
		 */
		private $num_of_columns = 0;

		/**
		 * @var int $max_num_of_columns mega menu allow for 6 columns at max
		 */
		private $max_num_of_columns = 6;

		/**
		 * @var int $total_num_of_columns total number of columns for a single megamenu?
		 */
		private $total_num_of_columns = 0;

		/**
		 * @var int $num_of_rows number of rows in the mega menu
		 */
		private $num_of_rows = 1;

		/**
		 * @var array $submenu_matrix holds number of columns per row
		 */
		private $submenu_matrix = array();

		/**
		 * @var float $menu_megamenu_columnwidth how large is the width of a column?
		 */
		private $menu_megamenu_columnwidth = 0;
		
		/**
		 * @var array $menu_megamenu_rowwidth_matrix how large is the width of each row?
		 */
		private $menu_megamenu_rowwidth_matrix = array();	

		/**
		 * @var float $menu_megamenu_maxwidth how large is the overall width of a column?
		 */
		private $menu_megamenu_maxwidth = 0;

		/**
		 * @var string $menu_megamenu_title should a colum title be displayed?
		 */
		private $menu_megamenu_title = '';

		/**
		 * @var string $menu_megamenu_widget_area should one column be a widget area?
		 */
		private $menu_megamenu_widget_area = '';

		/**
		 * @var string $menu_megamenu_icon does the item have an icon?
		 */
		private $menu_megamenu_icon = '';

		/**
		 * @var string $menu_megamenu_thumbnail does the item have a thumbnail?
		 */
		private $menu_megamenu_thumbnail = '';
		
		/**
		 * Middle logo menu breaking point
		 */
		private $middle_menu_break_point = null;
		
		/**
		 * Middle logo menu number of top level items displayed
		 */
		private $no_of_top_level_items_displayed = 0;

		/**
		 * Sets the overall width of the megamenu wrappers
		 *
		 */
		private function set_megamenu_max_width() {
			global $apress_data;
		
			// set overall width of megamenu
			$site_width = (int) str_replace( 'px', '', $apress_data['site_width']['width'] );
			$megamenu_max_width = (int) str_replace( 'px', '', $apress_data['megamenu_max_width']['width'] );
			$megmanu_width = 0;

			if( strpos( $apress_data['site_width']['width'], 'px' ) !== false ) {
				if( $site_width > $megamenu_max_width ) {
					$megamenu_width = $megamenu_max_width;	
				} else {
					$megamenu_width = $site_width;
				}
			} else {
				$megamenu_width = $megamenu_max_width;
			}
			$this->menu_megamenu_maxwidth = $megamenu_width;
		}

		/**
		 * @see Walker::start_lvl()
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param int $depth Depth of page. Used for padding.
		 */
		public function start_lvl( &$output, $depth = 0, $args = array() ) {
			$indent = str_repeat( "\t", $depth );

			if( $depth === 0 && $this->menu_megamenu_status == "enabled" ) {
				// set overall width of megamenu				
				if( ! $this->menu_megamenu_maxwidth ) {
					$this->set_megamenu_max_width();
				}
				
				$output .= '{first_level}';
				$output .= '<div class="zolo-megamenu-holder" {megamenu_final_width}><ul class="zolo-megamenu {megamenu_border}">';
			} elseif( $depth >= 2 && $this->menu_megamenu_status == "enabled" ) {
				$output .= '<ul class="sub-menu deep-level">';
			} else {
				$output .= '<ul class="sub-menu">';
			}
		}

		/**
		 * @see Walker::end_lvl()
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param int $depth Depth of page. Used for padding.
		 */
		public function end_lvl( &$output, $depth = 0, $args = array() ) {
			global $apress_data;
		
			$indent = str_repeat( "\t", $depth );
			$row_width = '';

			if( $depth === 0  && $this->menu_megamenu_status == "enabled" ) {

				$output .= "\n</ul>\n</div><div style='clear:both;'></div>\n</div>\n</div>\n";

				if( $this->total_num_of_columns < $this->max_num_of_columns ) {
					$col_span = " col-span-" . $this->total_num_of_columns * 2;
				} else {
					$col_span = " col-span-" . $this->max_num_of_columns * 2;
				}

				if ( $this->menu_megamenu_width == "fullwidth" ) {
					$col_span = " col-span-12 zolo-megamenu-fullwidth";
					// overall megamenu wrapper width in px is max width for fullwidth megamenu
					$wrapper_width = $this->menu_megamenu_maxwidth;
				} else {
					// calc overall megamenu wrapper width in px
					$wrapper_width = max( $this->menu_megamenu_rowwidth_matrix ) * $this->menu_megamenu_maxwidth;
				}

				$output = str_replace( "{first_level}", "<div class='zolo-megamenu-wrapper {zolo_columns} columns-".$this->total_num_of_columns . $col_span . "' data-maxwidth='" . $this->menu_megamenu_maxwidth . "'><div class='row'>", $output );
				
				$output = str_replace( "{megamenu_final_width}", sprintf( 'style="width:%spx;" data-width="%s"', $wrapper_width, $wrapper_width ), $output );
				
				if ( $this->total_num_of_columns > $this->max_num_of_columns ) {
					$output = str_replace( "{megamenu_border}","zolo-megamenu-border", $output );
				} else {
					$output = str_replace( "{megamenu_border}","", $output );
				}

				foreach($this->submenu_matrix as $row => $columns) {
					$layout_columns = 12 / $columns;
					if( $columns == '5' ) {
						$layout_columns = 2;
					}

					if( $columns < $this->max_num_of_columns ) {
						$row_width = "style=\"width:" . $columns / $this->max_num_of_columns * 100 . "%!important;\"";
					}

					$output = str_replace( "{row_width_".$row."}", $row_width, $output);

					if( ( $row - 1 ) * $this->max_num_of_columns + $columns < $this->total_num_of_columns ) {
						$output = str_replace( "{row_number_".$row."}", "zolo-megamenu-row-columns-" . $columns . " zolo-megamenu-border", $output);
					} else {
						$output = str_replace( "{row_number_".$row."}", "zolo-megamenu-row-columns-" . $columns, $output);
					}
					$output = str_replace( "{current_row_".$row."}", "zolo-megamenu-columns-".$columns." col-lg-" . $layout_columns . " col-md-" . $layout_columns . " col-sm-" . $layout_columns, $output );
					
					$output = str_replace( "{zolo_columns}", sprintf( 'zolo-columns-%s columns-per-row-%s', $columns, $columns ), $output );
				}
			} else {
				$output .= "$indent</ul>\n";
			}
		}

		/**
		 * @see Walker::start_el()
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param object $item Menu item data object.
		 * @param int $depth Depth of menu item. Used for padding.
		 * @param int $current_page Menu item ID.
		 * @param object $args
		 */
		public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			global $apress_data;
			
			$item_output = $class_columns = '';
			
			if ( $apress_data['middle_menu_break_point'] == 1 ) {
				if ( ! isset( $this->middle_menu_break_point ) ) {
					
					$middle_logo_menu_elements = wp_get_nav_menu_items( $args->menu );
		      		$middle_logo_menu_top_level_elements = 0;

					foreach ( $middle_logo_menu_elements as $menu_element ) {
						if ( '0' === $menu_element->menu_item_parent ) {
							$middle_logo_menu_top_level_elements++;
						}
					}

					$top_level_menu_items_count = count( $middle_logo_menu_top_level_elements );

					if ( 0 === $top_level_menu_items_count ) {
						$this->middle_menu_break_point = $middle_logo_menu_top_level_elements / 2;
					}else{
						$this->middle_menu_break_point = ceil( $middle_logo_menu_top_level_elements / 2 );
						}
				}
			}
			
			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

			/* set some vars */
			if( $depth === 0 ) {

				$this->menu_megamenu_status = get_post_meta( $item->ID, '_menu_item_zolo_megamenu_status', true );
				$this->menu_megamenu_width = get_post_meta( $item->ID, '_menu_item_zolo_megamenu_width', true);
				$allowed_columns = get_post_meta( $item->ID, '_menu_item_zolo_megamenu_columns', true );
				if( $allowed_columns != "auto" ) {
					$this->max_num_of_columns = $allowed_columns;
				}
				$this->num_of_columns = $this->total_num_of_columns = 0;
				$this->num_of_rows = 1;
				$this->menu_megamenu_rowwidth_matrix = array();
				$this->menu_megamenu_rowwidth_matrix[$this->num_of_rows] = 0;
			}
			$this->menu_megamenu_navgoto = get_post_meta( $item->ID, '_menu_item_zolo_megamenu_navgoto', true);
			$this->menu_megamenu_title = get_post_meta( $item->ID, '_menu_item_zolo_megamenu_title', true);
			$this->menu_megamenu_widgetarea = get_post_meta( $item->ID, '_menu_item_zolo_megamenu_widgetarea', true);
			$this->menu_megamenu_icon = get_post_meta( $item->ID, '_menu_item_zolo_megamenu_icon', true);
			$this->menu_megamenu_thumbnail = get_post_meta( $item->ID, '_menu_item_zolo_megamenu_thumbnail', true);

			/* we are inside a mega menu */
			if( $depth === 1 && $this->menu_megamenu_status == "enabled" ) {
			
				if( get_post_meta( $item->ID, '_menu_item_zolo_megamenu_columnwidth', true) ) {
					$this->menu_megamenu_columnwidth = get_post_meta( $item->ID, '_menu_item_zolo_megamenu_columnwidth', true);
				} else {
					if ( $this->menu_megamenu_width == "fullwidth" ) {
						$this->menu_megamenu_columnwidth = 100 / $this->max_num_of_columns . '%';
					} else {
						$this->menu_megamenu_columnwidth = '16.6666%';
					}
				}

				$this->num_of_columns++;
				$this->total_num_of_columns++;

				/* check if we need to start a new row */
				if( $this->num_of_columns > $this->max_num_of_columns ) {
					$this->num_of_columns = 1;
					$this->num_of_rows++;
					
					// start new row width calculation
					$this->menu_megamenu_rowwidth_matrix[$this->num_of_rows] =  floatval( $this->menu_megamenu_columnwidth ) / 100;
					
					$output .= "\n</ul>\n<ul class=\"zolo-megamenu zolo-megamenu-row-".$this->num_of_rows." {row_number_".$this->num_of_rows."}\" {row_width_".$this->num_of_rows."}>\n";
				} else {
					$this->menu_megamenu_rowwidth_matrix[$this->num_of_rows] +=  floatval( $this->menu_megamenu_columnwidth ) / 100;
				}

				$this->submenu_matrix[$this->num_of_rows] = $this->num_of_columns;

				if( $this->max_num_of_columns < $this->num_of_columns ) {
					$this->max_num_of_columns = $this->num_of_columns;
				}

				$title = apply_filters( 'the_title', $item->title, $item->ID );

				if( !(
						( empty( $item->url ) || $item->url == "#" || $item->url == 'http://' )  &&
						$this->menu_megamenu_title == 'disabled'
					)
				) {
					$heading = do_shortcode($title);
					$link = '';
					$link_closing = '';

					if( ! empty( $item->url ) &&
						$item->url != "#" &&
						$item->url != 'http://'
					) {
						$link = '<a href="' . $item->url . '"><span class="menu-text">';
						$link_closing = '</span></a>';
					}

					/* check if we need to set an image */
					$title_enhance = '';
					if ( ! empty( $this->menu_megamenu_thumbnail ) ) {
						$title_enhance = '<span class="zolo-megamenu-icon"><img src="' . $this->menu_megamenu_thumbnail . '"></span>';
					} elseif( ! empty( $this->menu_megamenu_icon ) ) {
						$title_enhance = '<span class="zolo-megamenu-icon"><i class="fa glyphicon ' . $this->menu_megamenu_icon . '"></i></span>';
					} elseif($this->menu_megamenu_title == 'disabled') {
						$title_enhance = '<span class="zolo-megamenu-bullet"></span>';
					}

					$heading = sprintf( '%s%s%s%s', $link, $title_enhance, $title, $link_closing );

					if( $this->menu_megamenu_title != 'disabled' ) {
						$item_output .= "<div class='zolo-megamenu-title'>" . $heading . "</div>";
					} else {
						$item_output .= $heading;
					}
				}

				if( $this->menu_megamenu_widgetarea &&
					is_active_sidebar( $this->menu_megamenu_widgetarea )
				) {
					$item_output .= '<div class="zolo-megamenu-widgets-container second-level-widget">';
					ob_start();
						generated_dynamic_sidebar( $this->menu_megamenu_widgetarea );

					$item_output .= ob_get_clean() . '</div>';
				}

				$class_columns  = ' {current_row_'.$this->num_of_rows.'}';

			} else if( $depth === 2 && $this->menu_megamenu_widgetarea && $this->menu_megamenu_status == "enabled" ) {

				if( is_active_sidebar( $this->menu_megamenu_widgetarea ) ) {
					$item_output .= '<div class="zolo-megamenu-widgets-container third-level-widget">';
					ob_start();
						generated_dynamic_sidebar( $this->menu_megamenu_widgetarea );

					$item_output .= ob_get_clean() . '</div>';
				}

			} else {

				$attributes = '';
				if ($this->menu_megamenu_navgoto == 'section') {
					if ( !is_front_page() ) { 
							$frontpage = home_url(); 
						} else { 
							$frontpage = ''; 
						}    
					$attributes .= ' href="'.$frontpage. esc_attr( $item->url ) .'"';
				} else {
					$attributes .= ! empty( $item->url ) ? ' href="'   . esc_attr( $item->url ) .'"' : '';
				}
				
				$attributes .= ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
				$attributes .= ! empty( $item->target ) ? 'target="' . esc_attr( $item->target ) .'"' : '';
				$attributes .= ! empty( $item->xfn ) ? 'rel="'    . esc_attr( $item->xfn ) .'"' : '';

				$item_output .= $args->before;
				/* check if ne need to set an image */
				if ( ! empty( $this->menu_megamenu_thumbnail ) && $this->menu_megamenu_status == "enabled" ) {
					$item_output .= '<a ' . $attributes . '><span class="zolo-megamenu-icon"><img src="' . $this->menu_megamenu_thumbnail . '"></span>';
				} elseif( ! empty( $this->menu_megamenu_icon ) && $this->menu_megamenu_status == "enabled" ) {
					$item_output .= '<a ' . $attributes . '><span class="zolo-megamenu-icon text-menu-icon text-menu-icon menu-text"><i class="fa ' . $this->menu_megamenu_icon . '"></i></span>';
				} elseif ( $depth !== 0 && $this->menu_megamenu_status == "enabled") {
					$item_output .= '<a ' . $attributes . '><span class="zolo-megamenu-bullet"></span>';
				} else {
					$item_output .= '<a '. $attributes .'>';
				}

				if( ! empty( $this->menu_megamenu_icon ) && $this->menu_megamenu_status == "enabled" ) {
					$item_output .=  '<span class="menu-text">';
				}

				$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;

				if( ! empty( $this->menu_megamenu_icon ) && $this->menu_megamenu_status == "enabled" ) {
					$item_output .=  '</span>';
				}

				if( $depth === 0 && $args->has_children && $apress_data['dropdown_indicator'] == 'dropdown_indicator_show' ) {
					
					$item_output .= ' <i class="fa fa-angle-down" aria-hidden="true"></i></a>';
					
				} else {
					$item_output .= '</a>';
				}
				$item_output .= $args->after;

			}

			/* check if we need to apply a divider */
			if ( $this->menu_megamenu_status != "enabled" && ( ( strcasecmp( $item->attr_title, 'divider' ) == 0) ||
				 ( strcasecmp( $item->title, 'divider' ) == 0 ) )
			) {
				$output .= $indent . '<li role="presentation" class="divider">';
			} else {

				$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

				$class_names = '';
				$column_width = '';
				$classes = empty( $item->classes ) ? array() : ( array ) $item->classes;
				$classes[] = 'menu-item-' . $item->ID;

				$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );


				if( $depth === 0 && $args->has_children ) {
					if( $this->menu_megamenu_status == "enabled" ) {
						$class_names .= ' zolo-megamenu-menu';
					} else {
						$class_names .= ' zolo-dropdown-menu';
					}
				}

				if ( $depth === 1 ) {
					if( $this->menu_megamenu_status == "enabled" ) {
						$class_names .= ' zolo-megamenu-submenu';
						
						if ( $this->menu_megamenu_width != "fullwidth" ) {
							$width = $this->menu_megamenu_maxwidth * floatval( $this->menu_megamenu_columnwidth ) / 100;
							$column_width = sprintf( 'style="width:%spx;max-width:%spx;" data-width="%s"', $width, $width, $width );
						}
					} else {
						$class_names .= ' zolo-dropdown-submenu';
					}
				}

				$class_names = $class_names ? ' class="' . esc_attr( $class_names ). $class_columns . '"' : '';

				$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
				$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

				$output .= sprintf( '%s<li %s %s %s >', $indent, $id, $class_names, $column_width );

				$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
			}
		}

		/**
		 * @see Walker::end_el()
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param object $item Page data object. Not used.
		 * @param int $depth Depth of page. Not Used.
		 */
		function end_el( &$output, $item, $depth = 0, $args = array() ) {
			global $apress_data;
			$output .= "</li>";
			
			if ( '0' === $item->menu_item_parent ) {
				$this->no_of_top_level_items_displayed++;
			}

			if ( $apress_data['middle_menu_break_point'] == 1 && $this->middle_menu_break_point == $this->no_of_top_level_items_displayed && '0' === $item->menu_item_parent ) {
				ob_start();
				?>
                <?php
				// Header Logo
				apress_header_logo();               
				$output .= ob_get_clean();
			}
		}

		/**
		 * Traverse elements to create list from elements.
		 *
		 * Display one element if the element doesn't have any children otherwise,
		 * display the element and its children. Will only traverse up to the max
		 * depth and no ignore elements under that depth.
		 *
		 * This method shouldn't be called directly, use the walk() method instead.
		 *
		 * @see Walker::start_el()
		 * @since 2.5.0
		 *
		 * @param object $element Data object
		 * @param array $children_elements List of elements to continue traversing.
		 * @param int $max_depth Max depth to traverse.
		 * @param int $depth Depth of current element.
		 * @param array $args
		 * @param string $output Passed by reference. Used to append additional content.
		 * @return null Null on failure with no changes to parameters.
		 */
		public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
			if ( ! $element )
				return;

			$id_field = $this->db_fields['id'];

			// Display this element.
			if ( is_object( $args[0] ) )
			   $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );

			parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
		}

		/**
		 * Menu Fallback
		 * =============
		 * If this function is assigned to the wp_nav_menu's fallback_cb variable
		 * and a manu has not been assigned to the theme location in the WordPress
		 * menu manager the function with display nothing to a non-logged in user,
		 * and will add a link to the WordPress menu manager if logged in as an admin.
		 *
		 * @param array $args passed from the wp_nav_menu function.
		 *
		 */
		public static function fallback( $args ) {
			if ( current_user_can( 'manage_options' ) ) {

				extract( $args );

				$fb_output = null;
				
				return $fb_output;
			}
		}
	}  // end ZOLOCoreFrontendWalker() class
}

// Don't duplicate me!
if( ! class_exists( 'ZOLOcodeCoreMegaMenus' ) ) {

    class ZOLOcodeCoreMegaMenus extends Walker_Nav_Menu {

		/**
		 * Starts the list before the elements are added.
		 *
		 * @see Walker_Nav_Menu::start_lvl()
		 *
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference.
		 * @param int    $depth  Depth of menu item. Used for padding.
		 * @param array  $args   Not used.
		 */
		function start_lvl( &$output, $depth = 0, $args = array() ) {}

		/**
		 * Ends the list of after the elements are added.
		 *
		 * @see Walker_Nav_Menu::end_lvl()
		 *
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference.
		 * @param int    $depth  Depth of menu item. Used for padding.
		 * @param array  $args   Not used.
		 */
		function end_lvl( &$output, $depth = 0, $args = array() ) {}

		/**
		 * Start the element output.
		 *
		 * @see Walker_Nav_Menu::start_el()
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param object $item   Menu item data object.
		 * @param int    $depth  Depth of menu item. Used for padding.
		 * @param array  $args   Not used.
		 * @param int    $id     Not used.
		 */
		function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			global $_wp_nav_menu_max_depth, $wp_registered_sidebars , $apress_data;
			$_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;

			ob_start();
			$item_id = esc_attr( $item->ID );
			$removed_args = array(
				'action',
				'customlink-tab',
				'edit-menu-item',
				'menu-item',
				'page-tab',
				'_wpnonce',
			);

			$original_title = '';
			if ( 'taxonomy' == $item->type ) {
				$original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
				if ( is_wp_error( $original_title ) )
					$original_title = false;
			} elseif ( 'post_type' == $item->type ) {
				$original_object = get_post( $item->object_id );
				$original_title = get_the_title( $original_object->ID );
			}

			$classes = array(
				'menu-item menu-item-depth-' . $depth,
				'menu-item-' . esc_attr( $item->object ),
				'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),
			);

			$title = $item->title;

			if ( ! empty( $item->_invalid ) ) {
				$classes[] = 'menu-item-invalid';
				/* translators: %s: title of menu item which is invalid */
				$title = sprintf( __( '%s (Invalid)', 'apress'), $item->title );
			} elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
				$classes[] = 'pending';
				/* translators: %s: title of menu item in draft status */
				$title = sprintf( __('%s (Pending)', 'apress'), $item->title );
			}

			$title = ( ! isset( $item->label ) || '' == $item->label ) ? $title : $item->label;

			$submenu_text = '';
			if ( 0 == $depth )
				$submenu_text = 'style="display: none;"';

			?>
			<li id="menu-item-<?php echo $item_id; ?>" class="<?php echo implode(' ', $classes ); ?>">
				<dl class="menu-item-bar">
					<dt class="menu-item-handle">
						<span class="item-title"><span class="menu-item-title"><?php echo esc_html( $title ); ?></span> <span class="is-submenu" <?php echo $submenu_text; ?>><?php _e( 'sub item', 'apress' ); ?></span></span>
						<span class="item-controls">
							<span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
							<span class="item-order hide-if-js">
								<a href="<?php
									echo wp_nonce_url(
										add_query_arg(
											array(
												'action' => 'move-up-menu-item',
												'menu-item' => $item_id,
											),
											remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
										),
										'move-menu_item'
									);
								?>" class="item-move-up"><abbr title="<?php esc_attr_e('Move up', 'apress'); ?>">&#8593;</abbr></a>
								|
								<a href="<?php
									echo wp_nonce_url(
										add_query_arg(
											array(
												'action' => 'move-down-menu-item',
												'menu-item' => $item_id,
											),
											remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
										),
										'move-menu_item'
									);
								?>" class="item-move-down"><abbr title="<?php esc_attr_e('Move down', 'apress'); ?>">&#8595;</abbr></a>
							</span>
							<a class="item-edit" id="edit-<?php echo $item_id; ?>" title="<?php esc_attr_e('Edit Menu Item', 'apress'); ?>" href="<?php
								echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
							?>"><?php _e( 'Edit Menu Item', 'apress' ); ?></a>
						</span>
					</dt>
				</dl>

				<div class="menu-item-settings" id="menu-item-settings-<?php echo $item_id; ?>">
					<?php if( 'custom' == $item->type ) : ?>
						<p class="field-url description description-wide">
							<label for="edit-menu-item-url-<?php echo $item_id; ?>">
								<?php _e( 'URL' , 'apress'); ?><br />
								<input type="text" id="edit-menu-item-url-<?php echo $item_id; ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
							</label>
						</p>
					<?php endif; ?>
					<p class="description description-thin">
						<label for="edit-menu-item-title-<?php echo $item_id; ?>">
							<?php _e( 'Navigation Label' , 'apress'); ?><br />
							<input type="text" id="edit-menu-item-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
						</label>
					</p>
					<p class="description description-thin">
						<label for="edit-menu-item-attr-title-<?php echo $item_id; ?>">
							<?php _e( 'Title Attribute' , 'apress'); ?><br />
							<input type="text" id="edit-menu-item-attr-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
						</label>
					</p>
					<p class="field-link-target description">
						<label for="edit-menu-item-target-<?php echo $item_id; ?>">
							<input type="checkbox" id="edit-menu-item-target-<?php echo $item_id; ?>" value="_blank" name="menu-item-target[<?php echo $item_id; ?>]"<?php checked( $item->target, '_blank' ); ?> />
							<?php _e( 'Open link in a new window/tab' , 'apress'); ?>
						</label>
					</p>
					<p class="field-css-classes description description-thin">
						<label for="edit-menu-item-classes-<?php echo $item_id; ?>">
							<?php _e( 'CSS Classes (optional)' , 'apress'); ?><br />
							<input type="text" id="edit-menu-item-classes-<?php echo $item_id; ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo $item_id; ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
						</label>
					</p>
					<p class="field-xfn description description-thin">
						<label for="edit-menu-item-xfn-<?php echo $item_id; ?>">
							<?php _e( 'Link Relationship (XFN)' , 'apress'); ?><br />
							<input type="text" id="edit-menu-item-xfn-<?php echo $item_id; ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
						</label>
					</p>
					<p class="field-description description description-wide">
						<label for="edit-menu-item-description-<?php echo $item_id; ?>">
							<?php _e( 'Description' , 'apress'); ?><br />
							<textarea id="edit-menu-item-description-<?php echo $item_id; ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo $item_id; ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
							<span class="description"><?php _e('The description will be displayed in the menu if the current theme supports it.', 'apress'); ?></span>
						</label>
					</p>
                    <?php
	            /* Custom Menu field type -NAVGOTO- */
				if($apress_data['enable_onepage'] == 'on'){
	            ?>      
	            <p class="field-custom description description-wide">
	                <label for="edit-menu-item-navgoto-<?php echo $item_id; ?>"><?php _e( 'Go To', 'apress' ); ?>
					<select id="edit-menu-item-navgoto-<?php echo $item_id; ?>" name="menu-item-zolo-megamenu-navgoto[<?php echo $item_id; ?>]">                  	
                  	<option value="page" <?php selected( $item->zolo_megamenu_navgoto, 'page' ); ?>><?php _e( 'Page' , 'apress'); ?></option>
                    <option value="section" <?php selected( $item->zolo_megamenu_navgoto, 'section' ); ?>><?php _e( 'Section' , 'apress'); ?></option>
                  </select>
                  </label>
	            </p>
	            <?php
				}
	            /* Custom Menu field type -NAVGOTO- */
	            ?>
					<?php do_action( 'wp_nav_menu_item_custom_fields', $item_id, $item, $depth, $args ); ?>
					
					<p class="field-move hide-if-no-js description description-wide">
						<label>
							<span><?php _e( 'Move' , 'apress'); ?></span>
							<a href="#" class="menus-move-up"><?php _e( 'Up one', 'apress' ); ?></a>
							<a href="#" class="menus-move-down"><?php _e( 'Down one' , 'apress'); ?></a>
							<a href="#" class="menus-move-left"></a>
							<a href="#" class="menus-move-right"></a>
							<a href="#" class="menus-move-top"><?php _e( 'To the top' , 'apress'); ?></a>
						</label>
					</p>

					<div class="menu-item-actions description-wide submitbox">
						<?php if( 'custom' != $item->type && $original_title !== false ) : ?>
							<p class="link-to-original">
								<?php printf( __('Original: %s', 'apress'), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
							</p>
						<?php endif; ?>
						<a class="item-delete submitdelete deletion" id="delete-<?php echo $item_id; ?>" href="<?php
						echo wp_nonce_url(
							add_query_arg(
								array(
									'action' => 'delete-menu-item',
									'menu-item' => $item_id,
								),
								admin_url( 'nav-menus.php' )
							),
							'delete-menu_item_' . $item_id
						); ?>"><?php _e( 'Remove' , 'apress'); ?></a> <span class="meta-sep hide-if-no-js"> | </span> <a class="item-cancel submitcancel hide-if-no-js" id="cancel-<?php echo $item_id; ?>" href="<?php echo esc_url( add_query_arg( array( 'edit-menu-item' => $item_id, 'cancel' => time() ), admin_url( 'nav-menus.php' ) ) );
							?>#menu-item-settings-<?php echo $item_id; ?>"><?php _e('Cancel', 'apress'); ?></a>
					</div>

					<input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo $item_id; ?>]" value="<?php echo $item_id; ?>" />
					<input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
					<input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
					<input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
					<input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
					<input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
				</div><!-- .menu-item-settings-->
				<ul class="menu-item-transport"></ul>
			<?php
			$output .= ob_get_clean();
		}

    } // end ZOLOcodeCoreMegaMenus() class

}


// Don't duplicate me!
if( ! class_exists( 'ZOLOcodeMegaMenu' ) ) {

    /**
     * Class to manipulate menus
     *
     * @since 3.4
     */
    class ZOLOcodeMegaMenu extends ZOLOcodeMegaMenuFramework {

    	function __construct() {

            add_action( 'wp_update_nav_menu_item', array( $this, 'save_custom_fields' ), 10, 3 );

            add_filter( 'wp_edit_nav_menu_walker', array( $this, 'add_custom_fields' ) );
            add_filter( 'wp_setup_nav_menu_item', array( $this, 'add_data_to_menu' ) );

    	} // end __construct();


        /**
         * Function to replace normal edit nav walker for zolo core mega menus
         *
         * @return string Class name of new navwalker
         */
        function add_custom_fields() {

            return 'ZOLOcodeCoreMegaMenus';

        }

        /**
         * Add the custom fields menu item data to fields in database
         *
         * @return void
         */
        function save_custom_fields( $menu_id, $menu_item_db_id, $args ) {

			
			$field_name_suffix = array('navgoto', 'status', 'width', 'columns', 'title', 'widgetarea', 'icon', 'thumbnail' );
	
			foreach ( $field_name_suffix as $key ) {
				if( !isset( $_REQUEST['menu-item-zolo-megamenu-'.$key][$menu_item_db_id] ) ) {
					$_REQUEST['menu-item-zolo-megamenu-'.$key][$menu_item_db_id] = '';
				}

				$value = $_REQUEST['menu-item-zolo-megamenu-'.$key][$menu_item_db_id];
				update_post_meta( $menu_item_db_id, '_menu_item_zolo_megamenu_'.$key, $value );
			}
        }

        /**
         * Add custom fields data to the menu
         *
         * @return object Add custom fields data to the menu object
         */
        function add_data_to_menu( $menu_item ) {
			global $apress_data; 
			$enable_onepage = isset($apress_data['enable_onepage']) ? $apress_data['enable_onepage'] : '';
        	$menu_item->zolo_megamenu_status = get_post_meta( $menu_item->ID, '_menu_item_zolo_megamenu_status', true );

			$menu_item->zolo_megamenu_width = get_post_meta( $menu_item->ID, '_menu_item_zolo_megamenu_width', true );

			$menu_item->zolo_megamenu_columns = get_post_meta( $menu_item->ID, '_menu_item_zolo_megamenu_columns', true );
			
			$menu_item->zolo_megamenu_columnwidth = get_post_meta( $menu_item->ID, '_menu_item_zolo_megamenu_columnwidth', true );

			$menu_item->zolo_megamenu_title = get_post_meta( $menu_item->ID, '_menu_item_zolo_megamenu_title', true );

			$menu_item->zolo_megamenu_widgetarea = get_post_meta( $menu_item->ID, '_menu_item_zolo_megamenu_widgetarea', true );

			$menu_item->zolo_megamenu_icon = get_post_meta( $menu_item->ID, '_menu_item_zolo_megamenu_icon', true );

			$menu_item->zolo_megamenu_thumbnail = get_post_meta( $menu_item->ID, '_menu_item_zolo_megamenu_thumbnail', true );
			
			if($enable_onepage == 'on'){
			$menu_item->zolo_megamenu_navgoto = get_post_meta( $menu_item->ID, '_menu_item_zolo_megamenu_navgoto', true );
			}
            return $menu_item;

        }

    } // end ZOLOcodeMegaMenu() class

}