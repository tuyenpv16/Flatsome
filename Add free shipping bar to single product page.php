<?php

/**
 * Add free shipping bar to single product page.
 */
add_action( 'woocommerce_before_add_to_cart_button', function () {
	if ( WC()->cart->get_cart_contents_count() > 0 ) {
		echo '<div class="mb">';
		Flatsome\WooCommerce\Shipping::instance()->free_shipping();
		echo '</div>';
	}
} );
