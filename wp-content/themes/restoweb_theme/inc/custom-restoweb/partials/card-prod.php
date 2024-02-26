<?php $_product = wc_get_product( $ID ); ?>

<div id="product-<?php echo $ID; ?>" class="product type-product post-196 status-publish first instock product_cat-carnes product_tag-lomo has-post-thumbnail shipping-taxable purchasable product-type-simple">

	<div class="woocommerce-product-gallery woocommerce-product-gallery--with-images woocommerce-product-gallery--columns-4 images" data-columns="4">
        <div>
            <img 
                src="<?php echo wp_get_attachment_url( $_product->get_image_id() ); ?>" 
                class="wp-post-image" alt="<?php echo $_product->name; ?>" 
                loading="lazy"
                title="<?php echo $_product->name; ?>" 
                data-src="<?php echo wp_get_attachment_url( $_product->get_image_id() ); ?>"
                class="modal-preview" 
                data-toggle="modal" 
                data-target="#viewFullImage"
                onclick="previewImage(this)"
            />
        </div>
    </div>

	<div class="summary entry-summary">
        <table>
            <tr>
                <td class="first-row"></td>
                <td><h2><?php echo $_product->name; ?></h2></td>
            </tr>
            <?php if ($_product->get_average_rating()): ?>
                <tr>
                    <td class="first-row">Rating:</td>
                    <td>
                        <?php echo wc_get_rating_html( $_product->get_average_rating() ); ?>
                    </td>
                </tr>
            <?php endif; ?>
            <tr>
                <td class="first-row"></td>
                <td><?php echo $_product->short_description; ?></td>
            </tr>
            <tr>
                <td class="first-row"></td>
                <td><?php echo get_woocommerce_currency_symbol(); ?><?php echo ($_product->get_sale_price()) ? $_product->get_sale_price() : ($_product->get_regular_price()) ? $_product->get_regular_price() : $_product->get_price(); ?></td>
            </tr>
            <form class="cart" method="post">
                <tr>
                    <td class="first-row"></td>
                    <td>
                        <?php if($_product->stock_status == 'outofstock' ) : ?>
                            <p class="stock out-of-stock">Agotado</p>
                        <?php else : ?>
                            <div class="quantity">
                                <input type="button" value="-" class="qty-minus" onclick="qty_minus('<?php echo $ID; ?>')">
                                <input type="number" class="input-text qty text" id="qty_<?php echo $ID; ?>" step="1" min="1" max="" name="quantity" value="1" title="Qty" size="4" pattern="[0-9]*" inputmode="numeric">
                                <input type="button" value="+" class="qty-add" onclick="qty_add('<?php echo $ID; ?>')">
                            </div>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td class="first-row"></td>
                    <td class="full-width row-btns-cart" colspan="2">
                        <?php if($_product->stock_status !== 'outofstock' ) : ?>
                            <a 
                                href="?add-to-cart=<?php echo $ID; ?>" 
                                data-quantity="" 
                                data-product_note="" 
                                id="cta_<?php echo $ID; ?>"
                                class="button product_type_simple add_to_cart_button ajax_add_to_cart"
                                data-product_id="<?php echo $ID; ?>" 
                                data-product_sku="<?php echo $_product->slug; ?>" 
                                aria-label="Agregá “<?php echo $_product->name; ?>” a tu carrito" 
                                rel="nofollow">
                                <i class="fa fa-shopping-cart"></i>
                                Agregar al Pedido
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
            </form>
        </table>
	</div>
</div>