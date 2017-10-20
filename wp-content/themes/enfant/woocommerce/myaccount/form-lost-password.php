<?php
/**
 * Lost password form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-lost-password.php.
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
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wc_print_notices(); ?>

<form method="post" class="ztl-password-form woocommerce-ResetPassword lost_reset_password">

	<p class="ztl-center"><?php echo apply_filters( 'woocommerce_lost_password_message', esc_html__( 'Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.', 'enfant' ) ); ?></p>

    <div class="ztl-reset-password">
        <p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
            <input class="ztl-input woocommerce-Input woocommerce-Input--text input-text" placeholder="<?php echo esc_html__( 'Username or email', 'enfant' ); ?>" type="text" name="user_login" id="user_login" />
        </p>
        
        <?php do_action( 'woocommerce_lostpassword_form' ); ?>
        <div class="ztl-password-button">
            <p class="woocommerce-form-row form-row ztl-button-three">
                <input type="hidden" name="wc_reset_password" value="true" />
                <input type="submit" class="woocommerce-Button button" value="<?php esc_attr_e( 'Reset password', 'enfant' ); ?>" />
            </p>
        </div>
    </div>
	<?php wp_nonce_field( 'lost_password' ); ?>

</form>
