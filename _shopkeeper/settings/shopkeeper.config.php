<?php

    if ( ! class_exists( 'Shopkeeper_Theme_Options' ) ) {

        class Shopkeeper_Theme_Options {

            public $args = array();
            public $sections = array();
            public $theme;
            public $ReduxFramework;

            public function __construct() {

                if ( ! class_exists( 'ReduxFramework' ) ) {
                    return;
                }

                // This is needed. Bah WordPress bugs.  ;)
                if ( true == Redux_Helpers::isTheme( __FILE__ ) ) {
                    $this->initSettings();
                } else {
                    add_action( 'plugins_loaded', array( $this, 'initSettings' ), 10 );
                }

            }

            public function initSettings() {

                // Just for demo purposes. Not needed per say.
                $this->theme = wp_get_theme();

                // Set the default arguments
                $this->setArguments();

                // Create the sections and fields
                $this->setSections();

                if ( ! isset( $this->args['opt_name'] ) ) { // No errors please
                    return;
                }

                $this->ReduxFramework = new ReduxFramework( $this->sections, $this->args );
            }

            public function setSections() {

                /**
                 * Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
                 * */
                // Background Patterns Reader
                $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
                $sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
                $sample_patterns      = array();

                if ( is_dir( $sample_patterns_path ) ) :

                    if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) :
                        $sample_patterns = array();

                        while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

                            if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
                                $name              = explode( '.', $sample_patterns_file );
                                $name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
                                $sample_patterns[] = array(
                                    'alt' => $name,
                                    'img' => $sample_patterns_url . $sample_patterns_file
                                );
                            }
                        }
                    endif;
                endif;

                ob_start();

                $ct          = wp_get_theme();
                $this->theme = $ct;
                $item_name   = $this->theme->get( 'Name' );
                $tags        = $this->theme->Tags;
                $screenshot  = $this->theme->get_screenshot();
                $class       = $screenshot ? 'has-screenshot' : '';

                $customize_title = sprintf( __( 'Customize &#8220;%s&#8221;', 'shopkeeper' ), $this->theme->display( 'Name' ) );

                ?>
                <div id="current-theme" class="<?php echo esc_attr( $class ); ?>">
                    <?php if ( $screenshot ) : ?>
                        <?php if ( current_user_can( 'edit_theme_options' ) ) : ?>
                            <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize"
                               title="<?php echo esc_attr( $customize_title ); ?>">
                                <img src="<?php echo esc_url( $screenshot ); ?>"
                                     alt="<?php esc_attr_e( 'Current theme preview', 'shopkeeper' ); ?>"/>
                            </a>
                        <?php endif; ?>
                        <img class="hide-if-customize" src="<?php echo esc_url( $screenshot ); ?>"
                             alt="<?php esc_attr_e( 'Current theme preview', 'shopkeeper' ); ?>"/>
                    <?php endif; ?>

                    <h4><?php echo esc_html($this->theme->display( 'Name' )); ?></h4>

                    <div>
                        <ul class="theme-info">
                            <li><?php printf( __( 'By %s', 'shopkeeper' ), $this->theme->display( 'Author' ) ); ?></li>
                            <li><?php printf( __( 'Version %s', 'shopkeeper' ), $this->theme->display( 'Version' ) ); ?></li>
                            <li><?php echo '<strong>' . __( 'Tags', 'shopkeeper' ) . ':</strong> '; ?><?php printf( $this->theme->display( 'Tags' ) ); ?></li>
                        </ul>
                        <p class="theme-description"><?php echo esc_html($this->theme->display( 'Description' )); ?></p>
                        <?php
                            if ( $this->theme->parent() ) {
                                printf( ' <p class="howto">' . __( 'This <a href="%1$s">child theme</a> requires its parent theme, %2$s.', 'shopkeeper' ) . '</p>', __( 'http://codex.wordpress.org/Child_Themes', 'shopkeeper' ), $this->theme->parent()->display( 'Name' ) );
                            }
                        ?>

                    </div>
                </div>

                <?php
                $item_info = ob_get_contents();

                ob_end_clean();

                $sampleHTML = '';
                if ( file_exists( dirname( __FILE__ ) . '/info-html.html' ) ) {
                    Redux_Functions::initWpFilesystem();

                    global $wp_filesystem;

                    $sampleHTML = $wp_filesystem->get_contents( dirname( __FILE__ ) . '/info-html.html' );
                }

                // ACTUAL DECLARATION OF SECTIONS
				
                $this->sections[] = array(
                    'icon'   => 'fa fa-tachometer',
					'title'  => __( 'General', 'shopkeeper' ),
                    // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                    'fields' => array(

                        array (
							'title' => __('Favicon', 'shopkeeper'),
							'subtitle' => __('<em>Upload your custom Favicon image. <br>.ico or .png file required.</em>', 'shopkeeper'),
							'id' => 'favicon',
							'type' => 'media',
							'default' => array (
								'url' => get_template_directory_uri() . '/favicon.png',
							),
						),
						
                    ),
                );

                $this->sections[] = array(
                    'icon'   => 'fa fa-arrow-circle-up',
                    'title'  => __( 'Header', 'shopkeeper' ),
                    'fields' => array(
						
						array(
                            'id'       => 'main_header_layout',
                            'type'     => 'image_select',
                            'compiler' => true,
                            'title'    => __( 'Header Layout', 'shopkeeper' ),
                            'subtitle' => __( '<em>Select the Layout style for the Header.</em>', 'shopkeeper' ),
                            'options'  => array(
                                '1' => array(
                                    'alt' => 'Layout 1',
                                    'img' => get_template_directory_uri() . '/images/theme_options/icons/header_1.png'
                                ),
                                '2' => array(
                                    'alt' => 'Layout 2',
                                    'img' => get_template_directory_uri() . '/images/theme_options/icons/header_2.png'
                                ),
                                '3' => array(
                                    'alt' => 'Layout 3',
                                    'img' => get_template_directory_uri() . '/images/theme_options/icons/header_3.png'
                                ),
                            ),
                            'default'  => '1'
                        ),
						
						array(
							'id'       => 'main_header_navigation_position_header_1',
							'type'     => 'button_set',
							'title'    => __( 'Navigation Alignment', 'shopkeeper' ),
							'subtitle' => __( '<em>Set up the alignment for the Main Navigation.</em>', 'shopkeeper' ),
							'options'  => array(
								'align_left'	=> '<i class="fa fa-align-left"></i> Left',
								'align_right' 	=> 'Right <i class="fa fa-align-right"></i>'
							),
							'default'  => 'align_left',
							'required' => array( 'main_header_layout', 'equals', array( '1' ) ),
						),
						
						array(
							'id'       => 'main_header_navigation_position_header_2',
							'type'     => 'button_set',
							'title'    => __( 'Navigation Position', 'shopkeeper' ),
							'subtitle' => __( '<em>Specify the Main Header Navigation Position.</em>', 'shopkeeper' ),
							'options'  => array(
								'1' => '&nbsp;&nbsp;&nbsp; <i class="fa fa-align-right"></i> &nbsp;Align to Logo&nbsp; <i class="fa fa-align-left"></i> &nbsp;&nbsp;&nbsp;',
								'2' => '<i class="fa fa-align-left"></i> &nbsp;&nbsp;&nbsp; Align to Edges &nbsp;&nbsp;&nbsp; <i class="fa fa-align-right"></i>',
							),
							'default'  => '1',
							'required' => array( 'main_header_layout', 'equals', array( '2' ) ),
						),
						
						array (
							'id' => 'main_nav_font_options',
							'icon' => true,
							'type' => 'info',
							'raw' => '<h3 style="margin: 0;"><i class="fa fa-font"></i> Font Settings</h3>',
						),
						
						array(
							'title' => __('Main Header Font Size', 'shopkeeper'),
							'subtitle' => __('<em>Drag the slider to set the Main Header Font Size.</em>', 'shopkeeper'),
							'id' => 'main_header_font_size',
							'type' => 'slider',
							"default" => 13,
							"min" => 11,
							"step" => 1,
							"max" => 16,
							'display_value' => 'text'
						),
						
						array (
							'title' => __('Main Header Font Color', 'shopkeeper'),
							'subtitle' => __('<em>The Main Header Font Color.</em>', 'shopkeeper'),
							'id' => 'main_header_font_color',
							'type' => 'color',
							'default' => '#fff',
							'transparent' => false
						),
						
						array (
							'id' => 'header_size_spacing',
							'icon' => true,
							'type' => 'info',
							'raw' => '<h3 style="margin: 0;"><i class="fa fa-sliders"></i> Spacing and Size</h3>',
						),
						
						array(
							'title' => __('Spacing Above the Logo', 'shopkeeper'),
							'subtitle' => __('<em>Drag the slider to set the Spacing Above the Logo.</em>', 'shopkeeper'),
							'id' => 'spacing_above_logo',
							'type' => 'slider',
							"default" => 15,
							"min" => 0,
							"step" => 1,
							"max" => 200,
							'display_value' => 'text'
						),
						
						array(
							'title' => __('Spacing Below the Logo', 'shopkeeper'),
							'subtitle' => __('<em>Drag the slider to set the Spacing Below the Logo.</em>', 'shopkeeper'),
							'id' => 'spacing_below_logo',
							'type' => 'slider',
							"default" => 15,
							"min" => 0,
							"step" => 1,
							"max" => 200,
							'display_value' => 'text'
						),						

						array(
							'id'       => 'header_width',
							'type'     => 'button_set',
							'title'    => __( 'Header Width', 'shopkeeper' ),
							'subtitle' => __( '<em>Set up the width of the Header.</em>', 'shopkeeper' ),
							'options'  => array(
								'full'	=> 'Full',
								'custom' 	=> 'Custom'
							),
							'default'  => 'custom',
						),
						
						array(
							'title' => __('Header Max Width', 'shopkeeper'),
							'subtitle' => __('<em>Drag the slider to set the Header Max Width. (default: 1680)</em>', 'shopkeeper'),
							'id' => 'header_max_width',
							'type' => 'slider',
							"default" => 1680,
							"min" => 960,
							"step" => 1,
							"max" => 1680,
							'display_value' => 'text',
							'required' => array( 'header_width', 'equals', array( 'custom' ) ),
						),	
						
						array (
							'id' => 'header_bg_options',
							'icon' => true,
							'type' => 'info',
							'raw' => '<h3 style="margin: 0;"><i class="fa fa-eyedropper"></i> Header Background</h3>',
						),

						/*array (
							'title' => __('Header Background Color', 'shopkeeper'),
							'subtitle' => __('<em>The Main Header background color.</em>', 'shopkeeper'),
							'id' => 'main_header_background_color',
							'type' => 'color',
							'default' => '#333333',
							'transparent' => false,
						),*/
						
						array(
                            'id'       		=> 'main_header_background',
                            'type'     		=> 'background',
                            'title'    		=> "Header Background Color",
                            'subtitle' 		=> "<em>The Main Header background.</em>",
                            'default'  => array(
								'background-color' => '#333333',
							),
							'transparent' 	=> false,
                        ),						

                    ),
                );

                $this->sections[] = array(
                    'icon'       => 'fa fa-angle-right',
                    'title'      => __( 'Header Elements', 'shopkeeper' ),
                    'subsection' => true,
                    'fields'     => array(
						
						array (
							'id' => 'wishlist_header_info',
							'icon' => true,
							'type' => 'info',
							'raw' => '<h3 style="margin: 0;"><i class="fa fa-heart-o"></i> Wishlist Icon</h3>',
						),
						
						array (
							'title' => __('Main Header Wishlist', 'shopkeeper'),
							'subtitle' => __('<em>Enable / Disable the Wishlist in the Header.</em>', 'shopkeeper'),
							'id' => 'main_header_wishlist',
							'on' => __('Enabled', 'shopkeeper'),
							'off' => __('Disabled', 'shopkeeper'),
							'type' => 'switch',
							'default' => 1,
						),
						
						array (
							'title' => __('Main Header Wishlist Icon', 'shopkeeper'),
							'subtitle' => __('<em>Upload your custom Wishlist Icon image (32x32 px).<br />Ignore if you want to use the default icon.</em>', 'shopkeeper'),
							'id' => 'main_header_wishlist_icon',
							'type' => 'media',
							'required' => array( 'main_header_wishlist', 'equals', array( '1' ) ),
						),
						
						array (
							'id' => 'bag_header_info',
							'icon' => true,
							'type' => 'info',
							'raw' => '<h3 style="margin: 0;"><i class="fa fa-shopping-cart"></i> Shopping Cart Icon</h3>',
						),
						
						array (
							'title' => __('Main Header Shopping Bag', 'shopkeeper'),
							'subtitle' => __('<em>Enable / Disable the Shopping Bag in the Header.</em>', 'shopkeeper'),
							'id' => 'main_header_shopping_bag',
							'on' => __('Enabled', 'shopkeeper'),
							'off' => __('Disabled', 'shopkeeper'),
							'type' => 'switch',
							'default' => 1,
						),
						
						array (
							'title' => __('Main Header Shopping Bag Icon', 'shopkeeper'),
							'subtitle' => __('<em>Upload your custom Shopping Bag Icon image (32x32 px).<br />Ignore if you want to use the default icon.</em>', 'shopkeeper'),
							'id' => 'main_header_shopping_bag_icon',
							'type' => 'media',
							'required' => array( 'main_header_shopping_bag', 'equals', array( '1' ) ),
						),
						
						array (
							'id' => 'search_header_info',
							'icon' => true,
							'type' => 'info',
							'raw' => '<h3 style="margin: 0;"><i class="fa fa-search"></i> Search Icon</h3>',
						),
						
						array (
							'title' => __('Main Header Search bar', 'shopkeeper'),
							'subtitle' => __('<em>Enable / Disable the Search Bar in the Header.</em>', 'shopkeeper'),
							'id' => 'main_header_search_bar',
							'on' => __('Enabled', 'shopkeeper'),
							'off' => __('Disabled', 'shopkeeper'),
							'type' => 'switch',
							'default' => 1,
						),
						
						array (
							'title' => __('Main Header Search bar Icon', 'shopkeeper'),
							'subtitle' => __('<em>Upload your custom Search bar Icon image (32x32 px).<br />Ignore if you want to use the default icon.</em>', 'shopkeeper'),
							'id' => 'main_header_search_bar_icon',
							'type' => 'media',
							'required' => array( 'main_header_search_bar', 'equals', array( '1' ) ),
						),
						
						array (
							'id' => 'offcanvas_header_info',
							'icon' => true,
							'type' => 'info',
							'raw' => '<h3 style="margin: 0;"><i class="fa fa-bars"></i> Off-Canvas Navigation / Hamburger Icon</h3>',
						),
						
						array (
							'title' => __('Main Header Off-Canvas Navigation', 'shopkeeper'),
							'subtitle' => __('<em>Enable / Disable the Off-Canvas Navigation.</em>', 'shopkeeper'),
							'id' => 'main_header_off_canvas',
							'on' => __('Enabled', 'shopkeeper'),
							'off' => __('Disabled', 'shopkeeper'),
							'type' => 'switch',
							'default' => 0,
						),
						
						array (
							'title' => __('Main Header Off-Canvas Icon', 'shopkeeper'),
							'subtitle' => __('<em>Upload your custom Off-Canvas Icon image (32x32 px).<br />Ignore if you want to use the default icon.</em>', 'shopkeeper'),
							'id' => 'main_header_off_canvas_icon',
							'type' => 'media',
							'required' => array( 'main_header_off_canvas', 'equals', array( '1' ) ),
						),
                        
                    )
                );
				
				$this->sections[] = array(
                    'icon'       => 'fa fa-angle-right',
                    'title'      => __( 'Logo', 'shopkeeper' ),
                    'subsection' => true,
                    'fields'     => array(
					
						array (
							'title' => __('Your Logo', 'shopkeeper'),
							'subtitle' => __('<em>Upload your logo image.</em>', 'shopkeeper'),
							'id' => 'site_logo',
							'type' => 'media',
						),
						
						array (
							'title' => __('Alternative Logo', 'shopkeeper'),
							'subtitle' => __('<em>The Alternative Logo is used on the <strong>Sticky Header</strong> and <strong>Mobile Devices</strong>.</em>', 'shopkeeper'),
							'id' => 'sticky_header_logo',
							'type' => 'media'
						),
						
						array(
							'title' => __('Logo Container Min Width', 'shopkeeper'),
							'subtitle' => __('<em>Drag the slider to set the logo container min width.</em>', 'shopkeeper'),
							'id' => 'logo_min_height',
							'type' => 'slider',
							"default" => 300,
							"min" => 0,
							"step" => 1,
							"max" => 600,
							'display_value' => 'text',
							'required' => array( 'main_header_layout', 'equals', array( '2' ) ),
						),
						
						array(
							'title' => __('Logo Height', 'shopkeeper'),
							'subtitle' => __('<em>Drag the slider to set the logo height <br/>(ignored if there\'s no uploaded logo).</em>', 'shopkeeper'),
							'id' => 'logo_height',
							'type' => 'slider',
							"default" => 33,
							"min" => 0,
							"step" => 1,
							"max" => 300,
							'display_value' => 'text',
						),
                        
                    )
                );
				
				$this->sections[] = array(
                    'icon'       => 'fa fa-angle-right',
                    'title'      => __( 'Header Transparency', 'shopkeeper' ),
                    'subsection' => true,
                    'fields'     => array(
					
						array (
							'title' => __('Header Transparency (Global)', 'shopkeeper'),
							'subtitle' => __('<em>When enabled, it sets the header to be transparent on all aplicable pages.</em>', 'shopkeeper'),
							'id' => 'main_header_transparency',
							'on' => __('Enabled', 'shopkeeper'),
							'off' => __('Disabled', 'shopkeeper'),
							'type' => 'switch',
							'default' => 0,
						),
						
						array(
							'id'       => 'main_header_transparency_scheme',
							'type'     => 'button_set',
							'title'    => __( 'Default Color Scheme (Global)', 'shopkeeper' ),
							'subtitle' => __( '<em>Set a default color scheme for the transparent header to be inherited by all the pages. The color scheme refers to the elements in the header (navigation, icons, etc.). </em>', 'shopkeeper' ),
							'options'  => array(
								'transparency_light'	=> '<i class="fa fa-circle-o"></i> Light',
								'transparency_dark' 	=> '<i class="fa fa-circle"></i> Dark',
							),
							'default'  => 'transparency_light',
						),
						
						array (
							'id' => 'light_scheme',
							'icon' => true,
							'type' => 'info',
							'raw' => '<h3 style="margin: 0;"><i class="fa fa-circle-o"></i> Light Color Scheme</h3>',
						),						
						
						array (
							'title' => __('Transparent Header Light Color', 'shopkeeper'),
							'subtitle' => __('<em>The Transparent Header Light Color.</em>', 'shopkeeper'),
							'id' => 'main_header_transparent_light_color',
							'type' => 'color',
							'default' => '#fff',
							'transparent' => false
						),
						
						array (
							'title' => __('Logo for Light Transparent Header', 'shopkeeper'),
							'subtitle' => __('<em>Upload your Logo for Light Transparent Header.</em>', 'shopkeeper'),
							'id' => 'light_transparent_header_logo',
							'type' => 'media'
						),

						array (
							'id' => 'dark_scheme',
							'icon' => true,
							'type' => 'info',
							'raw' => '<h3 style="margin: 0;"><i class="fa fa-circle"></i> Dark Color Scheme</h3>',
						),	
						
						array (
							'title' => __('Transparent Header Dark Color', 'shopkeeper'),
							'subtitle' => __('<em>The Transparent Header Dark Color.</em>', 'shopkeeper'),
							'id' => 'main_header_transparent_dark_color',
							'type' => 'color',
							'default' => '#000',
							'transparent' => false
						),
						
						array (
							'title' => __('Logo for Dark Transparent Header', 'shopkeeper'),
							'subtitle' => __('<em>Upload your Logo for Dark Transparent Header.</em>', 'shopkeeper'),
							'id' => 'dark_transparent_header_logo',
							'type' => 'media'
						),						
                        
                    )
                );
				
				$this->sections[] = array(
                    'icon'       => 'fa fa-angle-right',
                    'title'      => __( 'Top Bar', 'shopkeeper' ),
                    'subsection' => true,
                    'fields'     => array(
					
					array (
						'title' => __('Top Bar', 'shopkeeper'),
						'subtitle' => __('<em>Enable / Disable the Top Bar.</em>', 'shopkeeper'),
						'id' => 'top_bar_switch',
						'on' => __('Enabled', 'shopkeeper'),
						'off' => __('Disabled', 'shopkeeper'),
						'type' => 'switch',
						'default' => 0,
					),
					
					array (
						'title' => __('Top Bar Background Color', 'shopkeeper'),
						'subtitle' => __('<em>The Top Bar background color.</em>', 'shopkeeper'),
						'id' => 'top_bar_background_color',
						'type' => 'color',
						'default' => '#333333',
						'required' => array('top_bar_switch','=','1')
					),
					
					array (
						'title' => __('Top Bar Text Color', 'shopkeeper'),
						'subtitle' => __('<em>Specify the Top Bar Typography.</em>', 'shopkeeper'),
						'id' => 'top_bar_typography',
						'type' => 'color',
						'default' => '#fff',
						'transparent' => false,
						'required' => array('top_bar_switch','=','1')
					),
					
					array (
						'title' => __('Top Bar Text', 'shopkeeper'),
						'subtitle' => __('<em>Type in your Top Bar info here.</em>', 'shopkeeper'),
						'id' => 'top_bar_text',
						'type' => 'text',
						'default' => 'Free Shipping on All Orders Over $75!',
						'required' => array('top_bar_switch','=','1')
					),
					
					array(
						'id'       => 'top_bar_navigation_position',
						'type'     => 'button_set',
						'title'    => __( 'Top Bar Navigation Position', 'shopkeeper' ),
						'subtitle' => __( '<em>Specify the Navigation Position in the Top Bar.</em>', 'shopkeeper' ),
						//Must provide key => value pairs for radio options
						'options'  => array(
							'left' => 'Left',
							'right' => 'Right'
						),
						'default'  => 'right',
						'required' => array('top_bar_switch','=','1')
					),
					
					array (
						'title' => __('Top Bar Social Icons', 'shopkeeper'),
						'subtitle' => __('<em>Enable / Disable the Top Bar Social Icons.</em>', 'shopkeeper'),
						'id' => 'top_bar_social_icons',
						'on' => __('Enabled', 'shopkeeper'),
						'off' => __('Disabled', 'shopkeeper'),
						'type' => 'switch',
						'default' => 1,
						'required' => array('top_bar_switch','=','1')
					),
                        
                    )
                );

				$this->sections[] = array(
                    'icon'       => 'fa fa-angle-right',
                    'title'      => __( 'Sticky Header', 'shopkeeper' ),
                    'subsection' => true,
                    'fields'     => array(
					
						array (
							'title' => __('Sticky Header', 'shopkeeper'),
							'subtitle' => __('<em>Enable / Disable the Sticky Header.</em>', 'shopkeeper'),
							'id' => 'sticky_header',
							'on' => __('Enabled', 'shopkeeper'),
							'off' => __('Disabled', 'shopkeeper'),
							'type' => 'switch',
							'default' => 1,
						),
						
						array (
							'title' => __('Sticky Header Background Color', 'shopkeeper'),
							'subtitle' => __('<em>The Sticky Header background Color.</em>', 'shopkeeper'),
							'id' => 'sticky_header_background_color',
							'type' => 'color',
							'default' => '#333333',
							'transparent' => false,
							'required' => array('sticky_header','=','1')
						),
						
						array (
							'title' => __('Sticky Header Color', 'shopkeeper'),
							'subtitle' => __('<em>The Sticky Header Color.</em>', 'shopkeeper'),
							'id' => 'sticky_header_color',
							'type' => 'color',
							'default' => '#fff',
							'transparent' => false,
							'required' => array('sticky_header','=','1')
						),
                        
                    )
                );

                $this->sections[] = array(
                    'icon'    => 'fa fa-arrow-circle-down',
                    'title'   => __( 'Footer', 'shopkeeper' ),
                    'fields'  => array(
                        
						array (
							'title' => __('Footer Background Color', 'shopkeeper'),
							'subtitle' => __('<em>The Top Bar background color.</em>', 'shopkeeper'),
							'id' => 'footer_background_color',
							'type' => 'color',
							'default' => '#F4F4F4',
						),
						
						array (
							'title' => __('Footer Text', 'shopkeeper'),
							'subtitle' => __('<em>Specify the Footer Text Color.</em>', 'shopkeeper'),
							'id' => 'footer_texts_color',
							'type' => 'color',
							'transparent' => false,
							'default' => '#868686',
						),
						
						array (
							'title' => __('Footer Links', 'shopkeeper'),
							'subtitle' => __('<em>Specify the Footer Links Color.</em>', 'shopkeeper'),
							'id' => 'footer_links_color',
							'type' => 'color',
							'transparent' => false,
							'default' => '#333333',
						),
						
						array (
							'title' => __('Social Icons', 'shopkeeper'),
							'subtitle' => __('<em>Enable / Disable the Social Icons.</em>', 'shopkeeper'),
							'id' => 'footer_social_icons',
							'on' => __('Enabled', 'shopkeeper'),
							'off' => __('Disabled', 'shopkeeper'),
							'type' => 'switch',
							'default' => 1,
						),
						
						array (
							'title' => __('Footer Copyright Text', 'shopkeeper'),
							'subtitle' => __('<em>Enter your copyright information here.</em>', 'shopkeeper'),
							'id' => 'footer_copyright_text',
							'type' => 'text',
							'default' => '&copy; <a href=\'http://www.getbowtied.com/\'>Get Bowtied</a> - Elite ThemeForest Author.',
						),
						
                    )
                );
				
				$this->sections[] = array(
                    'icon'   => 'fa fa-list-alt',
                    'title'  => __( 'Blog', 'shopkeeper' ),
                    'fields' => array(
                        
						array (
							'title' => __('Blog with Sidebar', 'shopkeeper'),
							'subtitle' => __('<em>Enable / Disable the Sidebar on Blog.<em>', 'shopkeeper'),
							'id' => 'sidebar_blog_listing',
							'on' => __('Enabled', 'shopkeeper'),
							'off' => __('Disabled', 'shopkeeper'),
							'type' => 'switch',
							'default' => 0,
						),
						
						/*array (
							'title' => __('Featured image on Blog Post', 'shopkeeper'),
							'subtitle' => __('<em>Enable / Disable Featured image on Blog Post.<em>', 'shopkeeper'),
							'id' => 'blog_post_featured_image',
							'on' => __('Enabled', 'shopkeeper'),
							'off' => __('Disabled', 'shopkeeper'),
							'type' => 'switch',
							'default' => 1,
						),*/
						
                    )
                );

                $this->sections[] = array(
                    'icon'   => 'fa fa-shopping-cart',
                    'title'  => __( 'Shop', 'shopkeeper' ),
                    'fields' => array(
                        
						array (
							'title' => __('Catalog Mode', 'shopkeeper'),
							'subtitle' => __('<em>Enable / Disable the Catalog Mode.</em>', 'shopkeeper'),
							'desc' => __('<em>When enabled, the feature Turns Off the shopping functionality of WooCommerce.</em>', 'shopkeeper'),
							'id' => 'catalog_mode',
							'on' => __('Enabled', 'shopkeeper'),
							'off' => __('Disabled', 'shopkeeper'),
							'type' => 'switch',
						),
						
						array (
							'title' => __('Breadcrumbs', 'shopkeeper'),
							'subtitle' => __('<em>Enable / Disable the Breadcrumbs.</em>', 'shopkeeper'),
							'id' => 'breadcrumbs',
							'on' => __('Enabled', 'shopkeeper'),
							'off' => __('Disabled', 'shopkeeper'),
							'type' => 'switch',
							'default' => 1,
						),
						
						array (
							'title' => __('Number of Products per Column', 'shopkeeper'),
							'subtitle' => __('<em>Drag the slider to set the number of products per column <br />to be listed on the shop page and catalog pages.</em>', 'shopkeeper'),
							'id' => 'products_per_column',
							'min' => '2',
							'step' => '1',
							'max' => '6',
							'type' => 'slider',
							'default' => '6',
						),
						
						array (
							'title' => __('Number of Products per Page', 'shopkeeper'),
							'subtitle' => __('<em>Drag the slider to set the number of products per page <br />to be listed on the shop page and catalog pages.</em>', 'shopkeeper'),
							'id' => 'products_per_page',
							'min' => '1',
							'step' => '1',
							'max' => '48',
							'type' => 'slider',
							'edit' => '1',
							'default' => '18',
						),
						
						array (
							'title' => __('Sidebar Style', 'shopkeeper'),
							'subtitle' => __('<em>Choose the Shop Sidebar Style.<em>', 'shopkeeper'),
							'id' => 'sidebar_style',
							'on' => __('On Page', 'shopkeeper'),
							'off' => __('Off-Canvas', 'shopkeeper'),
							'type' => 'switch',
							'default' => 1,
						),
						
						array (
							'title' => __('Second Image on Catalog Page (Hover)', 'shopkeeper'),
							'subtitle' => __('<em>Enable / Disable the Second Image on Product Listing.</em>', 'shopkeeper'),
							'id' => 'second_image_product_listing',
							'on' => __('Enabled', 'shopkeeper'),
							'off' => __('Disabled', 'shopkeeper'),
							'type' => 'switch',
							'default' => 1,
						),
						
						array (
							'title' => __('Ratings on Catalog Page', 'shopkeeper'),
							'subtitle' => __('<em>Enable / Disable Ratings on Catalog Page.</em>', 'shopkeeper'),
							'id' => 'ratings_catalog_page',
							'on' => __('Enabled', 'shopkeeper'),
							'off' => __('Disabled', 'shopkeeper'),
							'type' => 'switch',
							'default' => 1,
						),
						
                    )
                );

                $this->sections[] = array(
                    'icon'   => 'fa fa-archive',
                    'title'  => __( 'Product Page', 'shopkeeper' ),
                    'fields' => array(
                        
						array (
							'title' => __('Product Gallery Zoom', 'shopkeeper'),
							'subtitle' => __('<em>Enable / Disable Product Gallery Zoom.<em>', 'shopkeeper'),
							'id' => 'product_gallery_zoom',
							'on' => __('Enabled', 'shopkeeper'),
							'off' => __('Disabled', 'shopkeeper'),
							'type' => 'switch',
							'default' => 1,
						),
						
						array (
							'title' => __('Related Products', 'shopkeeper'),
							'subtitle' => __('<em>Enable / Disable Related Products.<em>', 'shopkeeper'),
							'id' => 'related_products',
							'on' => __('Enabled', 'shopkeeper'),
							'off' => __('Disabled', 'shopkeeper'),
							'type' => 'switch',
							'default' => 1,
						),
						
						array (
							'title' => __('Sharing Options', 'shopkeeper'),
							'subtitle' => __('<em>Enable / Disable Sharing Options.<em>', 'shopkeeper'),
							'id' => 'sharing_options',
							'on' => __('Enabled', 'shopkeeper'),
							'off' => __('Disabled', 'shopkeeper'),
							'type' => 'switch',
							'default' => 1,
						),
						
						array (
							'title' => __('Review Tab', 'shopkeeper'),
							'subtitle' => __('<em>Enable / Disable Review Tab.<em>', 'shopkeeper'),
							'id' => 'review_tab',
							'on' => __('Enabled', 'shopkeeper'),
							'off' => __('Disabled', 'shopkeeper'),
							'type' => 'switch',
							'default' => 1,
						),
						
                    )
                );
				
				$this->sections[] = array(
                    'icon'   => 'fa fa-paint-brush',
                    'title'  => __( 'Styling', 'shopkeeper' ),
                    'fields' => array(
                        
						array (
							'title' => __('Body Texts Color', 'shopkeeper'),
							'subtitle' => __('<em>Body Texts Color of the site.</em>', 'shopkeeper'),
							'id' => 'body_color',
							'type' => 'color',
							'transparent' => false,
							'default' => '#222222',
						),
						
						array (
							'title' => __('Headings Color', 'shopkeeper'),
							'subtitle' => __('<em>Headings Color of the site.</em>', 'shopkeeper'),
							'id' => 'headings_color',
							'type' => 'color',
							'transparent' => false,
							'default' => '#000000',
						),
						
						array (
							'title' => __('Main Theme Color', 'shopkeeper'),
							'subtitle' => __('<em>The main color of the site.</em>', 'shopkeeper'),
							'id' => 'main_color',
							'type' => 'color',
							'transparent' => false,
							'default' => '#EC7A5C',
						),
						
						array(
                            'id'       		=> 'main_background',
                            'type'     		=> 'background',
                            'title'    		=> "Body Background",
                            'subtitle' 		=> "<em>Body background with image, color, etc.</em>",
                            'default'  => array(
								'background-color' => '#fff',
							),
							'transparent' 	=> false,
                        ),
						
                    )
                );
				
				$this->sections[] = array(
                    'icon'   => 'fa fa-font',
                    'title'  => __( 'Typography', 'shopkeeper' ),
                    'fields' => array(
                        
						array (
							'id' => 'source_fonts_info',
							'icon' => true,
							'type' => 'info',
							'raw' => __('<h3 style="margin: 0;"><i class="fa fa-font"></i> Font Sources</h3>', 'shopkeeper'),
						),
						
						array(
							'title'    => __('Font Source', 'shopkeeper'),
							'subtitle' => __('<em>Choose the Font Source</em>', 'shopkeeper'),
							'id'       => 'font_source',
							'type'     => 'radio',
							'options'  => array(
								'1' => 'Standard + Google Webfonts',
								'2' => 'Google Custom',
								'3' => 'Adobe Typekit'
							),
							'default' => '1'
						),
						
						// Google Code
						array(
							'id'=>'font_google_code',
							'type' => 'text',
							'title' => __('Google Code', 'shopkeeper'), 
							'subtitle' => __('<em>Paste the provided Google Code</em>', 'shopkeeper'),
							'default' => '',
							'required' => array('font_source','=','2')
						),
						
						// Typekit ID
						array(
							'id'=>'font_typekit_kit_id',
							'type' => 'text',
							'title' => __('Typekit Kit ID', 'shopkeeper'), 
							'subtitle' => __('<em>Paste the provided Typekit Kit ID.</em>', 'shopkeeper'),
							'default' => '',
							'required' => array('font_source','=','3')
						),
						
						array (
							'id' => 'main_font_info',
							'icon' => true,
							'type' => 'info',
							'raw' => __('<h3 style="margin: 0;"><i class="fa fa-font"></i> Main Font</h3>', 'shopkeeper'),
						),
						
						// Standard + Google Webfonts
						array (
							'title' => __('Font Face', 'shopkeeper'),
							'subtitle' => __('<em>Pick the Main Font for your site.</em>', 'shopkeeper'),
							'id' => 'main_font',
							'type' => 'typography',
							'line-height' => false,
							'text-align' => false,
							'font-style' => false,
							'font-weight' => false,
							'all_styles'=> true,
							'font-size' => false,
							'color' => false,
							'default' => array (
								'font-family' => 'Montserrat',
								'subsets' => '',
							),
							'required' => array('font_source','=','1')
						),
						
						// Google Custom						
						array (
							'title' => __('Google Font Face', 'shopkeeper'),
							'subtitle' => __('<em>Enter your Google Font Name for the theme\'s Main Typography</em>', 'shopkeeper'),
							'desc' => __('e.g.: open sans', 'shopkeeper'),
							'id' => 'main_google_font_face',
							'type' => 'text',
							'default' => '',
							'required' => array('font_source','=','2')
						),
						
						// Adobe Typekit						
						array (
							'title' => __('Typekit Font Face', 'shopkeeper'),
							'subtitle' => __('<em>Enter your Typekit Font Name for the theme\'s Main Typography</em>', 'shopkeeper'),
							'desc' => __('e.g.: futura-pt', 'shopkeeper'),
							'id' => 'main_typekit_font_face',
							'type' => 'text',
							'default' => '',
							'required' => array('font_source','=','3')
						),				
						
						
						array (
							'id' => 'secondary_font_info',
							'icon' => true,
							'type' => 'info',
							'raw' => __('<h3 style="margin: 0;"><i class="fa fa-font"></i> Secondary Font</h3>', 'shopkeeper'),
						),
						
						// Standard + Google Webfonts
						array (
							'title' => __('Font Face', 'shopkeeper'),
							'subtitle' => __('<em>Pick the Secondary Font for your site.</em>', 'shopkeeper'),
							'id' => 'secondary_font',
							'type' => 'typography',
							'line-height' => false,
							'text-align' => false,
							'font-style' => false,
							'font-weight' => false,
							'all_styles'=> true,
							'font-size' => false,
							'color' => false,
							'default' => array (
								'font-family' => 'Pontano Sans',
								'subsets' => '',
							),
							'required' => array('font_source','=','1')
							
						),
						
						// Google Custom						
						array (
							'title' => __('Google Font Face', 'shopkeeper'),
							'subtitle' => __('<em>Enter your Google Font Name for the theme\'s Secondary Typography</em>', 'shopkeeper'),
							'desc' => __('e.g.: open sans', 'shopkeeper'),
							'id' => 'secondary_google_font_face',
							'type' => 'text',
							'default' => '',
							'required' => array('font_source','=','2')
						),
						
						// Adobe Typekit						
						array (
							'title' => __('Typekit Font Face', 'shopkeeper'),
							'subtitle' => __('<em>Enter your Typekit Font Name for the theme\'s Secondary Typography</em>', 'shopkeeper'),
							'desc' => __('e.g.: futura-pt', 'shopkeeper'),
							'id' => 'secondary_typekit_font_face',
							'type' => 'text',
							'default' => '',
							'required' => array('font_source','=','3')
						),
						
						
                    )
                );
				
				$this->sections[] = array(
                    'icon'   => 'fa fa-share-alt-square',
                    'title'  => __( 'Social Media', 'shopkeeper' ),
                    'fields' => array(
                        
						array (
							'title' => __('<i class="fa fa-facebook"></i> Facebook', 'shopkeeper'),
							'subtitle' => __('<em>Type your Facebook profile URL here.</em>', 'shopkeeper'),
							'id' => 'facebook_link',
							'type' => 'text',
							'default' => 'https://www.facebook.com/GetBowtied',
						),
						
						array (
							'title' => __('<i class="fa fa-twitter"></i> Twitter', 'shopkeeper'),
							'subtitle' => __('<em>Type your Twitter profile URL here.</em>', 'shopkeeper'),
							'id' => 'twitter_link',
							'type' => 'text',
							'default' => 'http://twitter.com/GetBowtied',
						),
						
						array (
							'title' => __('<i class="fa fa-pinterest"></i> Pinterest', 'shopkeeper'),
							'subtitle' => __('<em>Type your Pinterest profile URL here.</em>', 'shopkeeper'),
							'id' => 'pinterest_link',
							'type' => 'text',
							'default' => 'http://www.pinterest.com/',
						),
						
						array (
							'title' => __('<i class="fa fa-linkedin"></i> LinkedIn', 'shopkeeper'),
							'subtitle' => __('<em>Type your LinkedIn profile URL here.</em>', 'shopkeeper'),
							'id' => 'linkedin_link',
							'type' => 'text',
						),
						
						array (
							'title' => __('<i class="fa fa-google-plus"></i> Google+', 'shopkeeper'),
							'subtitle' => __('<em>Type your Google+ profile URL here.</em>', 'shopkeeper'),
							'id' => 'googleplus_link',
							'type' => 'text',
						),
						
						array (
							'title' => __('<i class="fa fa-rss"></i> RSS', 'shopkeeper'),
							'subtitle' => __('<em>Type your RSS Feed URL here.</em>', 'shopkeeper'),
							'id' => 'rss_link',
							'type' => 'text',
						),
						
						array (
							'title' => __('<i class="fa fa-tumblr"></i> Tumblr', 'shopkeeper'),
							'subtitle' => __('<em>Type your Tumblr URL here.</em>', 'shopkeeper'),
							'id' => 'tumblr_link',
							'type' => 'text',
						),
						
						array (
							'title' => __('<i class="fa fa-instagram"></i> Instagram', 'shopkeeper'),
							'subtitle' => __('<em>Type your Instagram profile URL here.</em>', 'shopkeeper'),
							'id' => 'instagram_link',
							'type' => 'text',
							'default' => 'http://instagram.com/getbowtied',
						),
						
						array (
							'title' => __('<i class="fa fa-youtube-play"></i> Youtube', 'shopkeeper'),
							'subtitle' => __('<em>Type your Youtube profile URL here.</em>', 'shopkeeper'),
							'id' => 'youtube_link',
							'type' => 'text',
							'default' => 'https://www.youtube.com/channel/UC88KP4HSF-TnVhPCJLe9P-g',
						),
						
						array (
							'title' => __('<i class="fa fa-vimeo-square"></i> Vimeo', 'shopkeeper'),
							'subtitle' => __('<em>Type your Vimeo profile URL here.</em>', 'shopkeeper'),
							'id' => 'vimeo_link',
							'type' => 'text',
						),
						
						array (
							'title' => __('<i class="fa fa-behance"></i> Behance', 'shopkeeper'),
							'subtitle' => __('<em>Type your Behance profile URL here.</em>', 'shopkeeper'),
							'id' => 'behance_link',
							'type' => 'text',
						),
						
						array (
							'title' => __('<i class="fa fa-dribbble"></i> Dribble', 'shopkeeper'),
							'subtitle' => __('<em>Type your Dribble profile URL here.</em>', 'shopkeeper'),
							'id' => 'dribble_link',
							'type' => 'text',
						),
						
						array (
							'title' => __('<i class="fa fa-flickr"></i> Flickr', 'shopkeeper'),
							'subtitle' => __('<em>Type your Flickr profile URL here.</em>', 'shopkeeper'),
							'id' => 'flickr_link',
							'type' => 'text',
						),
						
						array (
							'title' => __('<i class="fa fa-git"></i> Git', 'shopkeeper'),
							'subtitle' => __('<em>Type your Git profile URL here.</em>', 'shopkeeper'),
							'id' => 'git_link',
							'type' => 'text',
						),
						
						array (
							'title' => __('<i class="fa fa-skype"></i> Skype', 'shopkeeper'),
							'subtitle' => __('<em>Type your Skype profile URL here.</em>', 'shopkeeper'),
							'id' => 'skype_link',
							'type' => 'text',
						),
						
						array (
							'title' => __('<i class="fa fa-weibo"></i> Weibo', 'shopkeeper'),
							'subtitle' => __('<em>Type your Weibo profile URL here.</em>', 'shopkeeper'),
							'id' => 'weibo_link',
							'type' => 'text',
						),
						
						array (
							'title' => __('<i class="fa fa-foursquare"></i> Foursquare', 'shopkeeper'),
							'subtitle' => __('<em>Type your Foursquare profile URL here.</em>', 'shopkeeper'),
							'id' => 'foursquare_link',
							'type' => 'text',
						),
						
						array (
							'title' => __('<i class="fa fa-soundcloud"></i> Soundcloud', 'shopkeeper'),
							'subtitle' => __('<em>Type your Soundcloud profile URL here.</em>', 'shopkeeper'),
							'id' => 'soundcloud_link',
							'type' => 'text',
						),
						
                    )
                );
				
				$this->sections[] = array(
                    'icon'   => 'fa fa-code',
                    'title'  => __( 'Custom Code', 'shopkeeper' ),
                    'fields' => array(
                        
						array (
							'title' => __('Custom CSS', 'shopkeeper'),
							'subtitle' => __('<em>Paste your custom CSS code here.</em>', 'shopkeeper'),
							'id' => 'custom_css',
							'type' => 'ace_editor',
							'mode' => 'css',
						),
						
						array (
							'title' => __('Header JavaScript Code', 'shopkeeper'),
							'subtitle' => __('<em>Paste your custom JS code here. The code will be added to the header of your site.</em>', 'shopkeeper'),
							'id' => 'header_js',
							'type' => 'ace_editor',
							'mode' => 'javascript',
						),
						
						array (
							'title' => __('Footer JavaScript Code', 'shopkeeper'),
							'subtitle' => __('<em>Here is the place to paste your Google Analytics code or any other JS code you might want to add to be loaded in the footer of your website.</em>', 'shopkeeper'),
							'id' => 'footer_js',
							'type' => 'ace_editor',
							'mode' => 'javascript',
						),
						
                    )
                );
				
				/*$this->sections[] = array(
                    'icon'   => 'fa fa-code',
                    'title'  => __( 'Theme Presets', 'shopkeeper' ),
                    'fields' => array(
                        
						array (
							'id'       => 'theme_presets',
							'type'     => 'image_select', 
							'presets'  => true,
							'title'    => "Theme Presets",
							'subtitle' => "<em>Presets.</em>",
							'default'  => 0,
							'options'  => array(
								'1'      => array(
									'alt'   => 'Light', 
									'img'   => ReduxFramework::$_url . '../sample/presets/preset1.png', 
									'presets'   => array(
										'main_color'  => '#ff0000',
										'main_header_layout'  => 1,	
									)
								),
								'2'      => array(
									'alt'   => 'Dark', 
									'img'   => ReduxFramework::$_url . '../sample/presets/preset2.png', 
									'presets'   => array(
										'main_color'  => '#81d742',
										'main_header_layout'  => 2,
									)
								),
							),
						),
						
                    )
                );*/

                $this->sections[] = array(
                    'title'  => __( 'Import / Export', 'shopkeeper' ),
                    'desc'   => __( 'Import and Export your Redux Framework settings from file, text or URL.', 'shopkeeper' ),
                    'icon'   => 'fa fa-refresh',
                    'fields' => array(
                        array(
                            'id'         => 'opt-import-export',
                            'type'       => 'import_export',
                            'title'      => 'Import Export',
                            'subtitle'   => 'Save and restore your Redux options',
                            'full_width' => false,
                        ),
                    ),
                );

                /*$this->sections[] = array(
                    'type' => 'divide',
                );*/
				
				$theme_info = '<div class="redux-framework-section-desc">';
                $theme_info .= '<p class="redux-framework-theme-data description theme-uri">' . __( '<strong>Theme URL:</strong> ', 'shopkeeper' ) . '<a href="' . $this->theme->get( 'ThemeURI' ) . '" target="_blank">' . $this->theme->get( 'ThemeURI' ) . '</a></p>';
                $theme_info .= '<p class="redux-framework-theme-data description theme-author">' . __( '<strong>Author:</strong> ', 'shopkeeper' ) . $this->theme->get( 'Author' ) . '</p>';
                $theme_info .= '<p class="redux-framework-theme-data description theme-version">' . __( '<strong>Version:</strong> ', 'shopkeeper' ) . $this->theme->get( 'Version' ) . '</p>';
                $theme_info .= '<p class="redux-framework-theme-data description theme-description">' . $this->theme->get( 'Description' ) . '</p>';
                $tabs = $this->theme->get( 'Tags' );
                if ( ! empty( $tabs ) ) {
                    $theme_info .= '<p class="redux-framework-theme-data description theme-tags">' . __( '<strong>Tags:</strong> ', 'shopkeeper' ) . implode( ', ', $tabs ) . '</p>';
                }
                $theme_info .= '</div>';

                /*$this->sections[] = array(
                    'icon'   => 'fa fa-info-circle',
                    'title'  => __( 'Theme Information', 'shopkeeper' ),
                    'desc'   => __( '<p class="description">This is the Description. Again HTML is allowed</p>', 'shopkeeper' ),
                    'fields' => array(
                        array(
                            'id'      => 'opt-raw-info',
                            'type'    => 'raw',
                            'content' => $item_info,
                        )
                    ),
                );*/
				
				/*if ( file_exists( dirname( __FILE__ ) . '/readme.html' ) ) {
                    $this->sections['theme_docs'] = array(
                        'icon'   => 'el-icon-list-alt',
                        'title'  => __( 'Documentation', 'shopkeeper' ),
                        'fields' => array(
                            array(
                                'id'       => 'theme_documentaion',
                                'type'     => 'raw',
                                'markdown' => true,
                                'content'  => file_get_contents( dirname( __FILE__ ) . '/readme.html' )
                            ),
                        ),
                    );
                }*/
            }

            /**
             * All the possible arguments for Redux.
             * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
             * */
            public function setArguments() {

                $theme = wp_get_theme(); // For use with some settings. Not necessary.

                $this->args = array(
                    // TYPICAL -> Change these values as you need/desire
                    'opt_name'             => 'shopkeeper_theme_options',
                    // This is where your data is stored in the database and also becomes your global variable name.
                    'display_name'         => $theme->get( 'Name' ),
                    // Name that appears at the top of your panel
                    'display_version'      => $theme->get( 'Version' ),
                    // Version that appears at the top of your panel
                    'menu_type'            => 'menu',
                    //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                    'allow_sub_menu'       => true,
                    // Show the sections below the admin menu item or not
                    'menu_title'           => __( 'Theme Options', 'shopkeeper' ),
                    'page_title'           => __( 'Theme Options', 'shopkeeper' ),
                    // You will need to generate a Google API key to use this feature.
                    // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                    'google_api_key'       => 'AIzaSyDGJehqeZnxz4hABrNgi9KrBTG7ev6rIgY',
                    // Set it you want google fonts to update weekly. A google_api_key value is required.
                    'google_update_weekly' => false,
                    // Must be defined to add google fonts to the typography module
                    'async_typography'     => true,
                    // Use a asynchronous font on the front end or font string
                    //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
                    'admin_bar'            => true,
                    // Show the panel pages on the admin bar
                    'admin_bar_icon'     => 'dashicons-portfolio',
                    // Choose an icon for the admin bar menu
                    'admin_bar_priority' => 50,
                    // Choose an priority for the admin bar menu
                    'global_variable'      => '',
                    // Set a different name for your global variable other than the opt_name
                    'dev_mode'             => false,
                    // Show the time the page took to load, etc
                    'update_notice'        => true,
                    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
                    'customizer'           => false,
                    // Enable basic customizer support
                    //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
                    //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

                    // OPTIONAL -> Give you extra features
                    'page_priority'        => 3,
                    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                    'page_parent'          => 'themes.php',
                    // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                    'page_permissions'     => 'manage_options',
                    // Permissions needed to access the options panel.
                    'menu_icon'            => '',
                    // Specify a custom URL to an icon
                    'last_tab'             => '',
                    // Force your panel to always open to a specific tab (by id)
                    'page_icon'            => 'icon-themes',
                    // Icon displayed in the admin panel next to your menu_title
                    'page_slug'            => 'theme_options',
                    // Page slug used to denote the panel
                    'save_defaults'        => true,
                    // On load save the defaults to DB before user clicks save or not
                    'default_show'         => false,
                    // If true, shows the default value next to each field that is not the default value.
                    'default_mark'         => '',
                    // What to print by the field's title if the value shown is default. Suggested: *
                    'show_import_export'   => true,
                    // Shows the Import/Export panel when not used as a field.

                    // CAREFUL -> These options are for advanced use only
                    'transient_time'       => 60 * MINUTE_IN_SECONDS,
                    'output'               => true,
                    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                    'output_tag'           => true,
                    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                    'footer_credit'     => '&nbsp;',                   // Disable the footer credit of Redux. Please leave if you can help it.

                    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                    'database'             => '',
                    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                    'system_info'          => false,
                    // REMOVE

                    // HINTS
                    'hints'                => array(
                        'icon'          => 'icon-question-sign',
                        'icon_position' => 'right',
                        'icon_color'    => 'lightgray',
                        'icon_size'     => 'normal',
                        'tip_style'     => array(
                            'color'   => 'light',
                            'shadow'  => true,
                            'rounded' => false,
                            'style'   => '',
                        ),
                        'tip_position'  => array(
                            'my' => 'top left',
                            'at' => 'bottom right',
                        ),
                        'tip_effect'    => array(
                            'show' => array(
                                'effect'   => 'slide',
                                'duration' => '500',
                                'event'    => 'mouseover',
                            ),
                            'hide' => array(
                                'effect'   => 'slide',
                                'duration' => '500',
                                'event'    => 'click mouseleave',
                            ),
                        ),
                    )
                );

                // ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
                $this->args['admin_bar_links'][] = array(
                    'id'    => 'shopkeeper-docs',
                    'href'   => 'http://support.getbowtied.com/hc/en-us/categories/200308912-Shopkeeper',
                    'title' => __( 'Documentation', 'shopkeeper' ),
                );

                $this->args['admin_bar_links'][] = array(
                    'id'    => 'shopkeeper-support',
                    'href'   => 'http://support.getbowtied.com/hc/en-us/requests/new',
                    'title' => __( 'Support', 'shopkeeper' ),
                );

                // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
                $this->args['share_icons'][] = array(
                    'url'   => 'https://www.facebook.com/GetBowtied',
                    'title' => 'Like us on Facebook',
                    'icon'  => 'el-icon-facebook'
                );
                $this->args['share_icons'][] = array(
                    'url'   => 'https://twitter.com/GetBowtied',
                    'title' => 'Follow us on Twitter',
                    'icon'  => 'el-icon-twitter'
                );
                $this->args['share_icons'][] = array(
                    'url'   => 'https://plus.google.com/+Getbowtied/posts',
                    'title' => 'Find us on Google+',
                    'icon'  => 'el-icon-googleplus'
                );

                // Panel Intro text -> before the form
                if ( ! isset( $this->args['global_variable'] ) || $this->args['global_variable'] !== false ) {
                    if ( ! empty( $this->args['global_variable'] ) ) {
                        $v = $this->args['global_variable'];
                    } else {
                        $v = str_replace( '-', '_', $this->args['opt_name'] );
                    }
                    $this->args['intro_text'] = "";
                } else {
                    $this->args['intro_text'] = "";
                }

                // Add content after the form.
                $this->args['footer_text'] = "";
            }

            public function validate_callback_function( $field, $value, $existing_value ) {
                $error = true;
                $value = 'just testing';

                /*
              do your validation

              if(something) {
                $value = $value;
              } elseif(something else) {
                $error = true;
                $value = $existing_value;
                
              }
             */

                $return['value'] = $value;
                $field['msg']    = 'your custom error message';
                if ( $error == true ) {
                    $return['error'] = $field;
                }

                return $return;
            }

            public function class_field_callback( $field, $value ) {
                print_r( $field );
                echo '<br/>CLASS CALLBACK';
                print_r( $value );
            }

        }

        global $reduxConfig;
        $reduxConfig = new Shopkeeper_Theme_Options();
    } else {
        echo "The class named Shopkeeper_Theme_Options has already been called. <strong>Developers, you need to prefix this class with your company name or you'll run into problems!</strong>";
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ):
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    endif;

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ):
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error = true;
            $value = 'just testing';

            /*
          do your validation

          if(something) {
            $value = $value;
          } elseif(something else) {
            $error = true;
            $value = $existing_value;
            
          }
         */

            $return['value'] = $value;
            $field['msg']    = 'your custom error message';
            if ( $error == true ) {
                $return['error'] = $field;
            }

            return $return;
        }
    endif;
