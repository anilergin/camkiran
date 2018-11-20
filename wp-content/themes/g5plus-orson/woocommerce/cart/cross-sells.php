<?php
/**
 * Cross-sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cross-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$columns = G5Plus_Global::get_option('cross_sells_product_display_columns','4');
$g5plus_woocommerce_loop = &G5Plus_Woocommerce::get_woocommerce_loop();
$g5plus_woocommerce_loop['columns'] = $columns;
$g5plus_woocommerce_loop['layout'] = 'slider';
$g5plus_woocommerce_loop['size'] = 'small';

if ( $cross_sells ) : ?>

	<div class="cross-sells mg-top-50">

		<h4 class="widget-title"><span><?php esc_html_e( 'You may be interested in&hellip;', 'g5plus-orson' ) ?></span></h4>

		<?php woocommerce_product_loop_start(); ?>

		<?php foreach ( $cross_sells as $cross_sell ) : ?>

			<?php
			$post_object = get_post( $cross_sell->get_id() );

			setup_postdata( $GLOBALS['post'] =& $post_object );

			wc_get_template_part( 'content', 'product' ); ?>

		<?php endforeach; ?>

		<?php woocommerce_product_loop_end(); ?>

	</div>

<?php endif;

wp_reset_postdata();
