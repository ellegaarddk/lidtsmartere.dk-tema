<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
}

// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
	return;
}

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
//if ( 0 === ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 === $woocommerce_loop['columns'] ) {
//	$classes[] = 'first';
//}
if ( 0 === $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) {
	$classes[] = 'last';
}
?>
<li <?php post_class( $classes ); ?>>

	<?php
	global $product;
	/**
	 * woocommerce_before_shop_loop_item hook.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	do_action( 'woocommerce_before_shop_loop_item' );

	/**
	 * woocommerce_before_shop_loop_item_title hook.
	 *
	 * @hooked woocommerce_show_product_loop_sale_flash - 10
	 * @hooked woocommerce_template_loop_product_thumbnail - 10
	 */
	do_action( 'woocommerce_before_shop_loop_item_title' );

	/**
	 * woocommerce_shop_loop_item_title hook.
	 *
	 * @hooked woocommerce_template_loop_product_title - 10
	 */

	if ((current_time('U') - get_the_date('U', $product->get_id())) < 1209600 && get_the_date('U', $product->get_id()) > 1468108800)
	{
		echo "<p class='product-nyhed'>Nyhed</p>";
	}
	
	do_action( 'woocommerce_shop_loop_item_title' );
	if (!empty($product->get_attribute('teaser-tekst')))
	{
		echo "<p class='shop-loop-teaser-tekst' title='" . $product->get_attribute( 'teaser-tekst' ) . "'>" . $product->get_attribute( 'teaser-tekst' ) . "</p>";
	}

	/**
	 * woocommerce_after_shop_loop_item_title hook.
	 *
	 * @hooked woocommerce_template_loop_rating - 5
	 * @hooked woocommerce_template_loop_price - 10
	 */

	if (!empty($product->get_attribute('stoerrelse')))
	{
		$s = explode(",", $product->get_attribute( 'stoerrelse' ))[0];
		echo "<div class='stoerrelse_attribute'  title='" . $s . "'>Størrelse: " . $s . "</div>";
	}
	else
	{
		echo "<div class='stoerrelse_attribute'><br></div>";	
	}

	$price = get_post_meta( get_the_ID(), '_regular_price', true);
	$sale = get_post_meta( get_the_ID(), '_sale_price', true);

	echo "<span class='price'>";
	if (empty($sale))
	{
		echo "<span class='amount'>DKK " . $price . ",00</span>";
	}
	else
	{
		echo "<ins><span class='amount'>DKK " . $sale . ",00</span></ins>";
		echo "<del><span class='amount'>DKK " . $price . ",00</span></del>";
	}
	echo "</span>";


	//do_action( 'woocommerce_after_shop_loop_item_title' );

	/**
	 * woocommerce_after_shop_loop_item hook.
	 *
	 * @hooked woocommerce_template_loop_product_link_close - 5
	 * @hooked woocommerce_template_loop_add_to_cart - 10
	 */
	do_action( 'woocommerce_after_shop_loop_item' );
	?>

</li>
