<?php
function theme_enqueue_styles()
{
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}

function loop_columns()
{
    return 4;
}

function wc_default_variation_stock_quantity()
{
    global $pagenow, $woocommerce;

    $screen = get_current_screen();

    if ($pagenow == 'post-new.php' && $screen->post_type == 'product')
    {
        ob_start();
        ?>
        <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
        <script>
        $( document ).ready(function()
        {
            document.getElementById("_manage_stock").checked = true;
            document.getElementById("_stock").value = "1";
            document.getElementById("_sold_individually").checked = true;
        });
        </script>
        <?php
        $javascript = ob_get_clean();
        echo $javascript;
    }
}

function wpa_120062_new_product($new_status, $old_status, $post)
{
    if ( $new_status == "auto-draft" && isset( $post->post_type ) && $post->post_type == 'product' )
    {
        if( function_exists( 'wc_get_attribute_taxonomies' ) && ( $attribute_taxonomies = wc_get_attribute_taxonomies() ) )
        {
            $defaults = array();

            foreach ( $attribute_taxonomies as $tax )
            {
                $name = wc_attribute_taxonomy_name( $tax->attribute_name );

                // do stuff here
                $defaults[ $name ] = array (
                    'name' => $name,
                    'value' => '',
                    'position' => 1,
                    'is_visible' => 1,
                    'is_variation' => 1,
                    'is_taxonomy' => 1,
                );

                update_post_meta( $post->ID , '_product_attributes', $defaults );
            }
        }
    }
}


function wc_make_processing_orders_editable( $is_editable, $order )
{
    if ( $order->get_status() == 'processing' )
    {
        $is_editable = true;
    }

    return $is_editable;
}

function my_custom_fonts()
{
	global $current_user;

    $user_roles = $current_user->roles;
    $user_role = array_shift($user_roles);

    if ($user_role == "shop_manager")
    {
		echo '
		<style>
			div#postdivrich
			{
				display:none!important;
			}
		</style>';
	}

	echo '
	<style>
	
	</style>';
}


add_action('wp_enqueue_scripts',        'theme_enqueue_styles');
add_filter('loop_shop_columns',         'loop_columns', 999);
add_action('admin_enqueue_scripts',     'wc_default_variation_stock_quantity');
add_action('transition_post_status',    'wpa_120062_new_product', 10, 3);
add_action('admin_head',                'my_custom_fonts');
add_filter('wc_order_is_editable',      'wc_make_processing_orders_editable', 10, 2);
add_filter( 'widget_display_callback',  'filter_product_cat_widget_if_no_children_categories', 10, 3 );
add_filter( 'auto_core_update_send_email', 'wpb_stop_auto_update_emails', 10, 4 );
 



add_action("admin_menu", "register_my_custom_submenu_page",99);

function register_my_custom_submenu_page()
{

    add_submenu_page( "edit.php?post_type=product",
    __("Private Produkter", "woocommerce" ),
    __("Private Produkter", "woocommerce" ),
    "manage_product_terms", "edit.php?post_status=private&post_type=product" );
}

function filter_product_cat_widget_if_no_children_categories( $settings, $widget, $args ) {
 
  /* Filter the WooCommerce Product Categories Widget */
  if ( get_class( $widget ) == 'WC_Widget_Product_Categories' ) {

    /* Abort if not a category page */
    if ( is_tax( 'product_cat' ) ) {
    	
    	/* Check if category has children */
    	global $wp_query;
    	$current_cat = $wp_query->queried_object;
    	$direct_children = get_terms(
				'product_cat',
				array(
					'fields'       => 'ids',
					'parent'       => $current_cat->term_id,
					'hierarchical' => true,
					'hide_empty'   => false
				)
			);
    	/* Only do something if category has no children */
    	if (count($direct_children) < 1) {
    		/* Override 'show_children_only' setting */
    		$settings['show_children_only'] = 0;
    		/* Add custom filter to the category widget */
    		add_filter('woocommerce_product_categories_widget_args', 'add_siblings_to_wc_product_cat_widget');
    	}
    }
  }
  return $settings;
}

function add_siblings_to_wc_product_cat_widget($args) {
	
	/* Find parent category */
	$ancestors = $args["current_category_ancestors"];
	
    /* Find sibling categories */
    $siblings  = array();
	foreach ( $ancestors as $ancestor ) {
		$ancestor_siblings = get_terms(
			'product_cat',
			array(
				'fields'       => 'ids',
				'parent'       => $ancestor,
				'hierarchical' => false,
				'hide_empty'   => false
			)
		);
		$siblings = array_merge( $siblings, $ancestor_siblings );
	}

	/* Add sibling categories to the widget */
	$args["include"] = implode(",",$siblings);
	
	return $args;
}

/**
 * Register new sidebar area for moving submenus to main navigation when responsive.
 *
 */
function subcategories_in_menu_widgets_init() {

	register_sidebar( array(
		'name'          => 'Main navigation (responsive)',
		'id'            => 'responsive_main_menu',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h3 style="padding-left:35px">',
		'after_title'   => '</h3>',
	) );

}
add_action( 'widgets_init', 'subcategories_in_menu_widgets_init' );

function wpb_stop_update_emails( $send, $type, $core_update, $result ) {
if ( ! empty( $type ) && $type == 'success' ) {
return false;
}
return true;
}

// eid: edited for adding size to cat archives
function action_woocommerce_after_shop_loop_item_title( $woocommerce_template_loop_price, $int ){
	global $product;
	echo 'hest';
	
/* 	if (!empty($product->get_attribute('stoerrelse')))
	{
		$s = explode(",", $product->get_attribute( 'stoerrelse' ))[0];
		echo "<div class='stoerrelse_attribute'  title='" . $s . "'>Størrelse: " . $s . "</div>";
	}
	else
	{
		echo "<div class='stoerrelse_attribute'><br></div>";	
	}
 */};
//add_action( 'woocommerce_after_shop_loop_item_title', 'action_woocommerce_after_shop_loop_item_title', 3, 2);

?>