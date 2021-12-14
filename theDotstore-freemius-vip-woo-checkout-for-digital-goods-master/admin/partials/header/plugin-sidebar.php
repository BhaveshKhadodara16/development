<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}
$review_url = '';
$plugin_at  = '';
$changelog_url = '';

if ( wcfdg_fs()->is__premium_only() ) {
    if ( wcfdg_fs()->can_use_premium_code() ) {
        $review_url = esc_url( 'https://www.thedotstore.com/woocommerce-checkout-for-digital-goods/#tab-reviews' );
        $plugin_at  = 'theDotstore';
        $changelog_url = esc_url( 'https://www.thedotstore.com/woocommerce-checkout-for-digital-goods/#tab-update-log' );
    } else {
        $review_url = esc_url( 'https://wordpress.org/plugins/woo-checkout-for-digital-goods/#reviews' );
        $plugin_at  = 'WP.org';
        $changelog_url = esc_url( 'https://wordpress.org/plugins/woo-checkout-for-digital-goods/#developers' );
    }
} else {
    $review_url = esc_url( 'https://wordpress.org/plugins/woo-checkout-for-digital-goods/#reviews' );
    $plugin_at  = 'WP.org';
    $changelog_url = esc_url( 'https://wordpress.org/plugins/woo-checkout-for-digital-goods/#developers' );
}
?>
<div class="dotstore_plugin_sidebar">
    <?php 
    if ( wcfdg_fs()->is__premium_only() ) {
        if ( wcfdg_fs()->can_use_premium_code() ) {
        } else {
            ?>
            <div class="dotstore-sidebar-section dotstore-upgrade-to-pro">
                <div class="dotstore-important-link-heading">
                    <span class="heading-text"><?php esc_html_e('Upgrade to Digital Goods Pro', WCDG_TEXT_DOMAIN); ?></span>
                </div>
                <div class="dotstore-important-link-content">
                    <ul class="dotstore-pro-list">
                        <li><?php esc_html_e('Quick checkout on : Selected Product/Category/tags only', WCDG_TEXT_DOMAIN); ?></li>
                        <li><?php esc_html_e('Fill additional fields after the payment on thank you page', WCDG_TEXT_DOMAIN); ?></li>
                        <li><?php esc_html_e('Delayed account creation', WCDG_TEXT_DOMAIN); ?></li>
                        <li><?php esc_html_e('Restrict with User Role', WCDG_TEXT_DOMAIN); ?></li>
                    </ul>
                    <div class="dotstore-pro-button">
                        <a class="button" target="_blank" href="<?php echo esc_url( 'https://bit.ly/3qijKjG' ); ?>"><?php esc_html_e('Get Premium Now »', WCDG_TEXT_DOMAIN); ?></a>
                    </div>
                </div>
            </div>
            <div class="dotstore_discount_voucher">
                <span class="dotstore_discount_title"><?php esc_html_e( 'EXCLUSIVE LIFETIME OFFER', WCDG_TEXT_DOMAIN ); ?></span>
                <span class="dotstore-upgrade"><?php esc_html_e( 'Upgrade To Lifetime Pro Plan & Get', WCDG_TEXT_DOMAIN ); ?></span>
                <strong class="dotstore-OFF"><?php esc_html_e( '20% OFF', WCDG_TEXT_DOMAIN ); ?></strong>
                <span class="dotstore-with-code"><?php esc_html_e( 'User Coupon Code:', WCDG_TEXT_DOMAIN ); ?>
                    <b><?php esc_html_e( 'LIFETIMEPRO', WCDG_TEXT_DOMAIN ); ?></b>
                </span>
                <a class="dotstore-upgrade"
                    href="<?php echo esc_url( 'https://bit.ly/3qijKjG' ); ?>"
                    target="_blank"><?php esc_html_e( 'Upgrade To Lifetime Pro Plan', WCDG_TEXT_DOMAIN ); ?></a>
            </div>
            <?php
        }
    } else {
        ?>
        <div class="dotstore-sidebar-section dotstore-upgrade-to-pro">
            <div class="dotstore-important-link-heading">
                <span class="heading-text"><?php esc_html_e('Upgrade to Digital Goods Pro', WCDG_TEXT_DOMAIN); ?></span>
            </div>
            <div class="dotstore-important-link-content">
                <ul class="dotstore-pro-list">
                    <li><?php esc_html_e('Quick checkout on : Selected Product/Category/tags only', WCDG_TEXT_DOMAIN); ?></li>
                    <li><?php esc_html_e('Fill additional fields after the payment on thank you page', WCDG_TEXT_DOMAIN); ?></li>
                    <li><?php esc_html_e('Delayed account creation', WCDG_TEXT_DOMAIN); ?></li>
                    <li><?php esc_html_e('Restrict with User Role', WCDG_TEXT_DOMAIN); ?></li>
                </ul>
                <div class="dotstore-pro-button">
                    <a class="button" target="_blank" href="<?php echo esc_url( 'https://bit.ly/3qijKjG' ); ?>"><?php esc_html_e('Get Premium Now »', WCDG_TEXT_DOMAIN); ?></a>
                </div>
            </div>
        </div>
        <div class="dotstore_discount_voucher">
            <span class="dotstore_discount_title"><?php esc_html_e( 'EXCLUSIVE LIFETIME OFFER', WCDG_TEXT_DOMAIN ); ?></span>
            <span class="dotstore-upgrade"><?php esc_html_e( 'Upgrade To Lifetime Pro Plan & Get', WCDG_TEXT_DOMAIN ); ?></span>
            <strong class="dotstore-OFF"><?php esc_html_e( '20% OFF', WCDG_TEXT_DOMAIN ); ?></strong>
            <span class="dotstore-with-code"><?php esc_html_e( 'User Coupon Code:', WCDG_TEXT_DOMAIN ); ?>
                <b><?php esc_html_e( 'LIFETIMEPRO', WCDG_TEXT_DOMAIN ); ?></b>
            </span>
            <a class="dotstore-upgrade"
                href="<?php echo esc_url( 'https://bit.ly/3qijKjG' ); ?>"
                target="_blank"><?php esc_html_e( 'Upgrade To Lifetime Pro Plan', WCDG_TEXT_DOMAIN ); ?></a>
        </div>
        <?php
    }
    ?>
    <div class="dotstore-important-link">
        <div class="image_box">
            <img src="<?php echo esc_url( plugin_dir_url( dirname( __FILE__, 2 ) ) . 'images/rate-us.png' ); ?>" alt="<?php esc_attr_e( 'Rate us', WCDG_TEXT_DOMAIN ); ?> ">
        </div>
        <div class="content_box">
            <h3><?php esc_html_e('Like This Plugin?', WCDG_TEXT_DOMAIN); ?></h3>
            <p class="star-container">
                <a href="<?php echo esc_url($review_url);?>" target="_blank">
                    <span class="dashicons dashicons-star-filled"></span>
                    <span class="dashicons dashicons-star-filled"></span>
                    <span class="dashicons dashicons-star-filled"></span>
                    <span class="dashicons dashicons-star-filled"></span>
                    <span class="dashicons dashicons-star-filled"></span>
                </a>
            </p>
            <p><?php esc_html_e('Your Review is very important to us as it helps us to grow more.', WCDG_TEXT_DOMAIN); ?></p>
            <a class="btn_style" href="<?php echo esc_url($review_url);?>" target="_blank"><?php esc_html_e('Review Us on ', WCDG_TEXT_DOMAIN); ?> <?php esc_html_e($plugin_at, WCDG_TEXT_DOMAIN); ?></a>
        </div>
    </div>
    <div class="dotstore-sidebar-section">
        <div class="dotstore-important-link-heading">
            <span class="dashicons dashicons-image-rotate-right"></span>
            <span class="heading-text"><?php esc_html_e('Free vs Pro Feature', WCDG_TEXT_DOMAIN); ?></span>
        </div>
        <div class="dotstore-important-link-content">
            <p><?php esc_html_e('Here’s an at a glance view of the main differences between Premium and free plugin features.', WCDG_TEXT_DOMAIN); ?></p>
            <a target="_blank" href="<?php echo esc_url('https://www.thedotstore.com/woocommerce-checkout-for-digital-goods/'); ?>"><?php esc_html_e('Click here »', WCDG_TEXT_DOMAIN); ?></a>
        </div>
    </div>
    <div class="dotstore-sidebar-section">
        <div class="dotstore-important-link-heading">
            <span class="dashicons dashicons-star-filled"></span>
            <span class="heading-text"><?php esc_html_e('Suggest A Feature', WCDG_TEXT_DOMAIN); ?></span>
        </div>
        <div class="dotstore-important-link-content">
            <p><?php esc_html_e('Let us know how we can improve the plugin experience.', WCDG_TEXT_DOMAIN); ?></p>
            <p><?php esc_html_e('Do you have any feedback & feature requests?', WCDG_TEXT_DOMAIN); ?></p>
            <a target="_blank" href="<?php echo esc_url('https://www.thedotstore.com/suggest-a-feature'); ?>"><?php esc_html_e('Submit Request »', WCDG_TEXT_DOMAIN); ?></a>
        </div>
    </div>

    <div class="dotstore-sidebar-section">
        <div class="dotstore-important-link-heading">
            <span class="dashicons dashicons-editor-kitchensink"></span>
            <span class="heading-text"><?php esc_html_e('Changelog', WCDG_TEXT_DOMAIN); ?></span>
        </div>
        <div class="dotstore-important-link-content">
            <p><?php esc_html_e('We improvise our products on a regular basis to deliver the best results to customer satisfaction.', WCDG_TEXT_DOMAIN); ?></p>
            <a target="_blank" href="<?php echo esc_url( $changelog_url ); ?>"><?php esc_html_e('Visit Here »', WCDG_TEXT_DOMAIN); ?></a>
        </div>
    </div>
    
    <!-- html for popular plugin !-->
    <div class="dotstore-important-link dotstore-sidebar-section">
        <div class="dotstore-important-link-heading">
            <span class="dashicons dashicons-plugins-checked"></span>
            <span class="heading-text"><?php esc_html_e('Our Popular Plugins', WCDG_TEXT_DOMAIN); ?></span>
        </div>
        <div class="video-detail important-link">
            <ul>
                <li>
                    <img class="sidebar_plugin_icone" src="<?php echo esc_url( plugin_dir_url( dirname( __FILE__, 2 ) ) . 'images/thedotstore-images/popular-plugins/Advanced-Flat-Rate-Shipping-Method.png' ); ?>" alt="<?php esc_attr_e( 'Flat Rate Shipping For WooCommerce', WCDG_TEXT_DOMAIN ); ?>">
                    <a target="_blank" href="<?php echo esc_url( "https://www.thedotstore.com/flat-rate-shipping-plugin-for-woocommerce/" ); ?>">
                        <?php esc_html_e( 'Flat Rate Shipping For WooCommerce', WCDG_TEXT_DOMAIN ); ?>
                    </a>
                </li>
                <li>
                    <img class="sidebar_plugin_icone" src="<?php echo esc_url( plugin_dir_url( dirname( __FILE__, 2 ) ) . 'images/thedotstore-images/popular-plugins/Conditional-Product-Fees-For-WooCommerce-Checkout.png' ); ?>" alt="<?php esc_attr_e( 'Conditional Product Fees For WooCommerce Checkout', WCDG_TEXT_DOMAIN ); ?>">
                    <a target="_blank" href="<?php echo esc_url( "https://www.thedotstore.com/product/woocommerce-extra-fees-plugin/" ); ?>">
                        <?php esc_html_e( 'Extra Fees Plugin for WooCommerce', WCDG_TEXT_DOMAIN ); ?>
                    </a>
                </li>
                <li>
                    <img class="sidebar_plugin_icone" src="<?php echo esc_url( plugin_dir_url( dirname( __FILE__, 2 ) ) . 'images/thedotstore-images/popular-plugins/hide-shipping.png' ); ?>" alt="<?php esc_attr_e( 'Hide Shipping Method For WooCommerce', WCDG_TEXT_DOMAIN ); ?>">
                    <a target="_blank" href="<?php echo esc_url( "https://www.thedotstore.com/hide-shipping-method-for-woocommerce/" ); ?>">
                        <?php esc_html_e( 'Hide Shipping Method For WooCommerce', WCDG_TEXT_DOMAIN ); ?>
                    </a>
                </li>
                <li>
                    <img class="sidebar_plugin_icone" src="<?php echo esc_url( plugin_dir_url( dirname( __FILE__, 2 ) ) . 'images/thedotstore-images/popular-plugins/WooCommerce-Conditional-Discount-Rules-For-Checkout.png' ); ?>" alt="<?php esc_attr_e( 'Conditional Discount Rules For WooCommerce Checkout', WCDG_TEXT_DOMAIN ); ?>">
                    <a target="_blank" href="<?php echo esc_url( "https://www.thedotstore.com/woocommerce-conditional-discount-rules-for-checkout/" ); ?>">
                        <?php esc_html_e( 'Conditional Discount Rules For WooCommerce Checkout', WCDG_TEXT_DOMAIN ); ?>
                    </a>
                </li>
                <li>
                    <img class="sidebar_plugin_icone" src="<?php echo esc_url( plugin_dir_url( dirname( __FILE__, 2 ) ) . 'images/thedotstore-images/popular-plugins/WooCommerce-Blocker-Prevent-Fake-Orders.png' ); ?>" alt="<?php esc_attr_e( 'WooCommerce Blocker – Prevent Fake Orders', WCDG_TEXT_DOMAIN ); ?>">
                    <a target="_blank" href="<?php echo esc_url( "https://www.thedotstore.com/woocommerce-anti-fraud" ); ?>">
                        <?php esc_html_e( 'WooCommerce Anti-Fraud', WCDG_TEXT_DOMAIN ); ?>
                    </a>
                </li>
                <li>
                    <img class="sidebar_plugin_icone" src="<?php echo esc_url( plugin_dir_url( dirname( __FILE__, 2 ) ) . 'images/thedotstore-images/popular-plugins/Advanced-Product-Size-Charts-for-WooCommerce.png' ); ?>" alt="<?php esc_attr_e( 'Product Size Charts Plugin For WooCommerce', WCDG_TEXT_DOMAIN ); ?>">
                    <a target="_blank" href="<?php echo esc_url( "https://www.thedotstore.com/woocommerce-advanced-product-size-charts/" ); ?>">
                        <?php esc_html_e( 'Product Size Charts Plugin For WooCommerce', WCDG_TEXT_DOMAIN ); ?>
                    </a>
                </li>
                <li>
                    <img class="sidebar_plugin_icone" src="<?php echo esc_url( plugin_dir_url( dirname( __FILE__, 2 ) ) . 'images/thedotstore-images/popular-plugins/wcbm-logo.png' ); ?>" alt="<?php esc_attr_e( 'WooCommerce Category Banner Management', WCDG_TEXT_DOMAIN ); ?>">
                    <a target="_blank" href="<?php echo esc_url( "https://www.thedotstore.com/product/woocommerce-category-banner-management/" ); ?>">
                        <?php esc_html_e( 'WooCommerce Category Banner Management', WCDG_TEXT_DOMAIN ); ?>
                    </a>
                </li>
                </br>
            </ul>
        </div>
        <div class="view-button">
            <a class="button button-primary button-large" target="_blank" href="<?php echo esc_url('https://www.thedotstore.com/plugins'); ?>"><?php esc_html_e('VIEW ALL', WCDG_TEXT_DOMAIN); ?></a>
        </div>
    </div>

    <div class="dotstore-sidebar-section">
        <div class="dotstore-important-link-heading">
            <span class="dashicons dashicons-sos"></span>
            <span class="heading-text"><?php esc_html_e('Five Star Support', WCDG_TEXT_DOMAIN); ?></span>
        </div>
        <div class="dotstore-important-link-content">
            <p><?php esc_html_e('Got a question? Get in touch with theDotstore developers. We are happy to help! ', WCDG_TEXT_DOMAIN); ?></p>
            <a target="_blank" href="<?php echo esc_url('https://www.thedotstore.com/support/'); ?>"><?php esc_html_e('Submit a Ticket »', WCDG_TEXT_DOMAIN); ?></a>
        </div>
    </div>
</div>