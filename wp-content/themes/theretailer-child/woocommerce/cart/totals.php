<?php
/**
 * Cart totals
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

$available_methods = $woocommerce->shipping->get_available_shipping_methods();
?>
<div class="cart_totals <?php if ( $woocommerce->customer->has_calculated_shipping() ) echo 'calculated_shipping'; ?>">

	<?php do_action( 'woocommerce_before_cart_totals' ); ?>

	<?php if ( ! $woocommerce->shipping->enabled || $available_methods || ! $woocommerce->customer->get_shipping_country() || ! $woocommerce->customer->has_calculated_shipping() ) : ?>

		<h3><?php _e('Shopping Bag Totals', 'theretailer'); ?></h3>

		<table cellspacing="0">
			<tbody>

				<tr class="cart-subtotal">
					<th><strong><?php _e( 'Subtotal', 'theretailer' ); ?></strong></th>
					<td><strong><?php echo $woocommerce->cart->get_cart_subtotal(); ?></strong></td>
				</tr>

				<?php if ( $woocommerce->cart->get_discounts_before_tax() ) : ?>

					<tr class="discount">
						<th><?php _e( 'Cart Discount', 'theretailer' ); ?> <a href="<?php echo add_query_arg( 'remove_discounts', '1', $woocommerce->cart->get_cart_url() ) ?>"><?php _e( '[Remove]', 'theretailer' ); ?></a></th>
						<td>-<?php echo $woocommerce->cart->get_discounts_before_tax(); ?></td>
					</tr>

				<?php endif; ?>

				<?php if ( $woocommerce->cart->needs_shipping() && $woocommerce->cart->show_shipping() && ( $available_methods || get_option( 'woocommerce_enable_shipping_calc' ) == 'yes' ) ) : ?>

					<?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?>

					<tr class="shipping">
						<th><?php _e( 'Shipping', 'theretailer' ); ?></th>
						<td><?php woocommerce_get_template( 'cart/shipping-methods.php', array( 'available_methods' => $available_methods ) ); ?></td>
					</tr>

					<?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?>

				<?php endif ?>

				<?php foreach ( $woocommerce->cart->get_fees() as $fee ) : ?>

					<tr class="fee fee-<?php echo $fee->id ?>">
						<th><?php echo $fee->name ?></th>
						<td><?php
							if ( $woocommerce->cart->tax_display_cart == 'excl' )
								echo woocommerce_price( $fee->amount );
							else
								echo woocommerce_price( $fee->amount + $fee->tax );
						?></td>
					</tr>

				<?php endforeach; ?>

				<?php
					// Show the tax row if showing prices exclusive of tax only
					if ( $woocommerce->cart->tax_display_cart == 'excl' ) {
						$taxes = $woocommerce->cart->get_formatted_taxes();

						if ( sizeof( $taxes ) > 0 ) {

							$has_compound_tax = false;

							foreach ( $taxes as $key => $tax ) {
								if ( $woocommerce->cart->tax->is_compound( $key ) ) {
									$has_compound_tax = true;
									continue;
								}

								echo '<tr class="tax-rate tax-rate-' . $key . '">
									<th>' . $woocommerce->cart->tax->get_rate_label( $key ) . '</th>
									<td>' . $tax . '</td>
								</tr>';
							}

							if ( $has_compound_tax ) {

								echo '<tr class="order-subtotal">
									<th><strong>' . __( 'Subtotal', 'theretailer' ) . '</strong></th>
									<td><strong>' . $woocommerce->cart->get_cart_subtotal( true ) . '</strong></td>
								</tr>';
							}

							foreach ( $taxes as $key => $tax ) {
								if ( ! $woocommerce->cart->tax->is_compound( $key ) )
									continue;

								echo '<tr class="tax-rate tax-rate-' . $key . '">
									<th>' . $woocommerce->cart->tax->get_rate_label( $key ) . '</th>
									<td>' . $tax . '</td>
								</tr>';
							}

						} elseif ( $woocommerce->cart->get_cart_tax() > 0 ) {

							echo '<tr class="tax">
								<th>' . __( 'Tax', 'theretailer' ) . '</th>
								<td>' . $woocommerce->cart->get_cart_tax() . '</td>
							</tr>';
						}
					}
				?>

				<?php if ( $woocommerce->cart->get_discounts_after_tax() ) : ?>

					<tr class="discount">
						<th><?php _e( 'Order Discount', 'theretailer' ); ?> <a href="<?php echo add_query_arg( 'remove_discounts', '2', $woocommerce->cart->get_cart_url() ) ?>"><?php _e( '[Remove]', 'theretailer' ); ?></a></th>
						<td>-<?php echo $woocommerce->cart->get_discounts_after_tax(); ?></td>
					</tr>

				<?php endif; ?>

				<?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>

				<tr class="total">
					<th><strong><?php _e( 'Total', 'theretailer' ); ?></strong></th>
					<td>
						<strong><?php echo $woocommerce->cart->get_total(); ?></strong>
						<?php
							// If prices are tax inclusive, show taxes here
							if (  $woocommerce->cart->tax_display_cart == 'incl' ) {
								$tax_string_array = array();
								$taxes = $woocommerce->cart->get_formatted_taxes();

								if ( sizeof( $taxes ) > 0 )
									foreach ( $taxes as $key => $tax )
										$tax_string_array[] = sprintf( '%s %s', $tax, $woocommerce->cart->tax->get_rate_label( $key ) );
								elseif ( $woocommerce->cart->get_cart_tax() )
									$tax_string_array[] = sprintf( '%s tax', $tax );

								if ( ! empty( $tax_string_array ) ) {
									echo '<small class="includes_tax">' . sprintf( __( '(Includes %s)', 'theretailer' ), implode( ', ', $tax_string_array ) ) . '</small>';
								}
							}
						?>
					</td>
				</tr>

				<?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>

			</tbody>
		</table>

		<?php if ( $woocommerce->cart->get_cart_tax() ) : ?>

			<p><small><?php

				$estimated_text = ( $woocommerce->customer->is_customer_outside_base() && ! $woocommerce->customer->has_calculated_shipping() ) ? sprintf( ' ' . __( ' (taxes estimated for %s)', 'theretailer' ), $woocommerce->countries->estimated_for_prefix() . __( $woocommerce->countries->countries[ $woocommerce->countries->get_base_country() ], 'theretailer' ) ) : '';

				printf( __( 'Note: Shipping and taxes are estimated%s and will be updated during checkout based on your billing and shipping information.', 'theretailer' ), $estimated_text );

			?></small></p>

		<?php endif; ?>

	<?php elseif( $woocommerce->cart->needs_shipping() ) : ?>

		<?php if ( ! $woocommerce->customer->get_shipping_state() || ! $woocommerce->customer->get_shipping_postcode() ) : ?>

			<div class="woocommerce-info">

				<p><?php _e( 'No shipping methods were found; please recalculate your shipping and enter your state/county and zip/postcode to ensure there are no other available methods for your location.', 'theretailer' ); ?></p>

			</div>

		<?php else : ?>

			<?php

				$customer_location = $woocommerce->countries->countries[ $woocommerce->customer->get_shipping_country() ];

				echo apply_filters( 'woocommerce_cart_no_shipping_available_html',
					'<div class="woocommerce-error"><p>' .
					sprintf( __( 'Sorry, it seems that there are no available shipping methods for your location (%s).', 'theretailer' ) . ' ' . __( 'If you require assistance or wish to make alternate arrangements please contact us.', 'theretailer' ), $customer_location ) .
					'</p></div>'
				);

			?>

		<?php endif; ?>

	<?php endif; ?>

	<?php do_action( 'woocommerce_after_cart_totals' ); ?>

</div>