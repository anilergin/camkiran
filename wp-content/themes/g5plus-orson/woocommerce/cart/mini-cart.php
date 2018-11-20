<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.3.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$total_item = sizeof( WC()->cart->get_cart());
if (!isset($args) || !isset($args['list_class'])) {
	$args['list_class'] = '';
}
?>

<?php do_action( 'woocommerce_before_mini_cart' ); ?>
<a href="sepet">
<div class="shopping-cart-icon">
	<div class="subtotal-info-wrapper">
		<span class="total-item"><?php echo esc_html($total_item); ?> <?php esc_html_e('Items', 'g5plus-orson'); ?></span> - <?php echo WC()->cart->get_cart_subtotal(); ?>
	</div>
	<div class="icon">
		<span><?php echo esc_html($total_item); ?></span>
		<i></i>
	</div>
</div>
</a>