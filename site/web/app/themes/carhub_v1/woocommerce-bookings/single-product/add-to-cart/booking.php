<?php
/**
 * Booking product add to cart
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if ( ! $product->is_purchasable() ) {
	return;
}

do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<noscript><?php _e( 'Your browser must support JavaScript in order to make a booking.', 'woocommerce-bookings' ); ?></noscript>
<div class="row">
<div class="col-12 text-center">
<span class="underline_arrow"> Your Booking </span>
</div>
</div>
<form class="cart" method="post" enctype='multipart/form-data'>

 <div id="wc-bookings-booking-form" class="wc-bookings-booking-form">





	 <?php do_action( 'woocommerce_before_booking_form' ); ?>

	 <?php $booking_form->output(); ?>

 	<div class="wc-bookings-booking-cost" style=""></div>

	 <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
 	<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( is_callable( array( $product, 'get_id' ) ) ? $product->get_id() : $product->id ); ?>" class="wc-booking-product-id" />


 	<button type="submit" class="wc-bookings-booking-form-button single_add_to_cart_button button alt disabled" ><?php echo $product->single_add_to_cart_text(); ?></button>

 <input type="hidden" name="add-to-cart" value="<?php echo esc_attr( is_callable( array( $product, 'get_id' ) ) ? $product->get_id() : $product->id ); ?>" class="wc-booking-product-id" />

 </div>


 </div>


</form>

<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
