<?php
/**
 * WooCommerce behavior and settings
 */

/*
 * Change number or products per row to 3
*/
add_filter('loop_shop_columns', 'enfant_loop_columns');
function enfant_loop_columns()
{
    return 3; // 3 products per row
}


/**
 * Change Add to cart text to Nothing
 */
add_filter('woocommerce_product_add_to_cart_text', 'enfant_archive_custom_cart_button_text');    // 2.1 +
function enfant_archive_custom_cart_button_text()
{
    return;
}


/**
 * Change Add to cart with Add to Cart
 */
add_filter('woocommerce_product_single_add_to_cart_text', 'enfant_custom_cart_button_text');    // 2.1 +
function enfant_custom_cart_button_text()
{
    return esc_html__('Add to Cart', 'enfant');
}


/**
 * Set number of products per page
 */

// Display 9 products per page. Goes in functions.php
add_filter('loop_shop_per_page', 'enfant_products_per_page', 20);
function enfant_products_per_page()
{
    $enfant_products_per_page = get_theme_mod('shop_products_per_page');
    if (!empty($enfant_products_per_page)) {
        return (int)$enfant_products_per_page;
    }
    return 9;
}


add_filter('woocommerce_output_related_products_args', 'enfant_related_products_columns');
function enfant_related_products_columns($args)
{
    $args['posts_per_page'] = 3; // 3 related products
    $args['columns'] = 3; // arranged in 3 columns
    return $args;
}

/**
 * Remove product title from single product page
 */
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);


/**
 * Add cart items number in header bar
 */
add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');

function woocommerce_header_add_to_cart_fragment($fragments)
{
    global $woocommerce;
    ob_start(); ?>
    <span class="ztl-cart-quantity"><?php echo esc_html($woocommerce->cart->cart_contents_count); ?></span>
    <?php
    $fragments['span.ztl-cart-quantity'] = ob_get_clean();
    return $fragments;
}

?>