<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>

	<?php
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

		

		<?php
			/**
			 * woocommerce_archive_description hook.
			 *
			 * @hooked woocommerce_taxonomy_archive_description - 10
			 * @hooked woocommerce_product_archive_description - 10
			 */
			do_action( 'woocommerce_archive_description' );
		?>

		<?php if ( have_posts() ) : ?>

			<?php if (!is_front_page()) { ?>

			<div class="page-description">
	<p></p>
	<div class="row vc_row-fluid no_parallax ">
		<div>
			<div class="large-2 columns column_container">
				<div class="wpb_wrapper">
					<div class="wpb_content_element ">
						<div class="wpb_wrapper">
							<p></p>
						</div>
					</div>
				</div>
			</div>
			<div class="large-8 columns column_container vc_custom_1461138499814">
				<div class="wpb_wrapper">
					<div class="wpb_content_element ">
						<div class="wpb_wrapper">
							<div id="rev_slider_1_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container" style="margin: 0px auto; padding: 0px; max-height: 350px; height: 210px; overflow: hidden; background-color: white;">
						</div>
								
						</div>
					</div>
				</div>
			</div>
			<div class="large-2 columns column_container">
				<div class="wpb_wrapper">
					<div class="wpb_content_element ">
						<div class="wpb_wrapper">
							<p></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row vc_row-fluid no_parallax normal_height">
		<div>
			<div class="large-2 columns column_container vc_custom_1459498876937">
				<div class="wpb_wrapper">
					<div class="wpb_content_element ">
						<div class="wpb_wrapper">
							<p></p>
						</div>
					</div>
				</div>
			</div>
			<div class="large-8 columns column_container vc_custom_1459498882444">
				<div class="wpb_wrapper">
					<div class="vc_custom_heading">
						<h3 style="text-align: center !important;font-family:Montserrat !important;font-weight:700 !important;font-style:normal !important;"></h3>
					</div>
					<div class="woocommerce columns-4">
						<div class="row">
							<?php //do_action( 'woocommerce_before_shop_loop' ); ?>	
							<div class="large-12 columns">
								<ul id="products-grid" class="products products-grid small-block-grid-2 medium-block-grid-4 large-block-grid-4 xlarge-block-grid-4 xxlarge-block-grid-4 columns-4">
									
									<?php woocommerce_product_subcategories(); ?>
									<?php while ( have_posts() ) : the_post(); ?>
										<?php wc_get_template_part( 'content', 'product' ); ?>
									<?php endwhile;?>

								</ul>
							</div>
							<!-- .columns -->
						</div>
						<!-- .row -->
					</div>
				</div>
			</div>
			<div class="large-2 columns column_container">
				<div class="wpb_wrapper">
					<div class="wpb_content_element ">
						<div class="wpb_wrapper">
							<p></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<p></p>
</div>






				


			<?php } ?>

			<?php
				/**
				 * woocommerce_after_shop_loop hook.
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			?>

		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

			<?php wc_get_template( 'loop/no-products-found.php' ); ?>

		<?php endif; ?>

	<?php
		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

	<?php
		/**
		 * woocommerce_sidebar hook.
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		do_action( 'woocommerce_sidebar' );
	?>

<?php get_footer( 'shop' ); ?>
