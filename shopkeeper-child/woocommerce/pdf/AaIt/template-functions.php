<?php
/**
 * Use this file for all your template filters and actions.
 * Requires WooCommerce PDF Invoices & Packing Slips 1.4.13 or higher
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_action( 'wpo_wcpdf_after_item_meta', 'wpo_wcpdf_show_product_categories', 10, 3 );
function wpo_wcpdf_show_product_categories ( $template_type, $item, $order ) {
    // get a comma separated list of categories (category links stripped)
    $categories = strip_tags( $item['product']->get_categories() );
    echo '<div class="product-categories">Kategorier: '.$categories.'</div>';
}