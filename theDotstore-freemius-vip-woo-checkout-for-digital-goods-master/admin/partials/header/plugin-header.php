<?php
// If this file is called directly, abort.
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
global $wcfdg_fs;
$plugin_name = WCDG_PLUGIN_NAME;
$plugin_version = WCDG_PLUGIN_VERSION;
if ( wcfdg_fs()->is__premium_only() ) {
    if ( wcfdg_fs()->can_use_premium_code() ) {
        $version_label = 'Pro Version';
    }else{
        $version_label = 'Free Version';
    }
}else{
    $version_label = 'Free Version';
}
?>
<div id="dotsstoremain">
    <div class="all-pad">
        <header class="dots-header">
        <div class="dots-plugin-details">
            <div class="dots-header-left">
                <div class="dots-logo-main">
                    <div class="logo-image">
                    <img src="<?php echo esc_url(WCDG_PLUGIN_URL . 'admin/images/woo-digital-goods-checkout-icon.png'); ?>">
                    </div>
                    <div class="plugin-version">
                        <span><?php esc_html_e($version_label, WCDG_TEXT_DOMAIN); ?> <?php echo esc_html($plugin_version) ?></span>
                    </div>
                </div>
                <div class="plugin-name">
                    <div class="title"><?php esc_html_e($plugin_name, WCDG_TEXT_DOMAIN); ?></div>
                    <div class="desc"><?php esc_html_e('Helps to remove unnecessary fields from the checkout page and make the process smooth and easy for customers.', WCDG_TEXT_DOMAIN); ?></div>
                </div>
            </div>
            <div class="dots-header-right">
                <div class="button-group">
                    <div class="button-dots">
                        <span class="support_dotstore_image">
                            <a target="_blank" href="<?php echo esc_url('http://www.thedotstore.com/support/'); ?>">
                                <span class="dashicons dashicons-sos"></span>
                                <strong><?php esc_html_e('Quick Support', WCDG_TEXT_DOMAIN) ?></strong>
                            </a>
                        </span>
                    </div>
                    <div class="button-dots">
                        <span class="support_dotstore_image">
                            <a target="_blank" href="<?php echo esc_url('https://docs.thedotstore.com/category/170-premium-plugin-settings'); ?>">
                                <span class="dashicons dashicons-media-text"></span>
                                <strong><?php esc_html_e('Documentation', WCDG_TEXT_DOMAIN) ?></strong>
                            </a>
                        </span>
                    </div>
                    <?php
                    if ( wcfdg_fs()->is__premium_only() ) {
                        if ( wcfdg_fs()->can_use_premium_code() ) { ?>
                            <div class="button-dots">
                                <span class="support_dotstore_image">
                                    <a target="_blank" href="<?php echo esc_url($wcfdg_fs->get_account_url()); ?>">
                                        <span class="dashicons dashicons-admin-users"></span>
                                        <strong><?php esc_html_e('My Account', WCDG_TEXT_DOMAIN) ?></strong>
                                    </a>
                                </span>
                            </div>
                            <?php
                        }else{ ?>
                            <div class="button-dots">
                                <span class="support_dotstore_image">
                                    <a target="_blank" href="<?php echo esc_url($wcfdg_fs->get_upgrade_url()); ?>">
                                        <span class="dashicons dashicons-upload"></span>
                                        <strong><?php esc_html_e('Upgrade To Pro', WCDG_TEXT_DOMAIN) ?></strong>
                                    </a>
                                </span>
                            </div> 
                        <?php 
                        } 
                    }else{ ?>
                        <div class="button-dots">
                            <span class="support_dotstore_image">
                                <a target="_blank" href="<?php echo esc_url($wcfdg_fs->get_upgrade_url()); ?>">
                                    <span class="dashicons dashicons-upload"></span>
                                    <strong><?php esc_html_e('Upgrade To Pro', WCDG_TEXT_DOMAIN) ?></strong>
                                </a>
                            </span>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php
            $current_page = filter_input(INPUT_GET,'page',FILTER_SANITIZE_STRING);
            $general_setting = isset( $current_page ) && 'wcdg-general-setting' === $current_page ? 'active' : '';
            $quick_checkout = isset( $current_page ) && 'wcdg-quick-checkout' === $current_page ? 'active' : '';
            $wcdg_getting_started = isset( $current_page ) && 'wcdg-get-started' === $current_page ? 'active' : '';
            $wcdg_information = isset( $current_page ) && 'wcdg-information' === $current_page ? 'active' : '';
            if (isset($current_page) && 'wcdg-get-started' === $current_page || isset($current_page) && 'wcdg-information' === $current_page) {
                $fee_about = 'active';
            } else {
                $fee_about = '';
            }
        ?>
        <div class="dots-menu-main">
            <nav>
                <ul>
                    <li>
                        <a class="dotstore_plugin <?php echo esc_attr( $general_setting ); ?>" href="<?php echo esc_url(add_query_arg(array('page' => 'wcdg-general-setting'), admin_url('admin.php'))); ?>"><?php esc_html_e('General Setting', WCDG_TEXT_DOMAIN); ?></a>
                    </li>
                    <?php
                    if (wcfdg_fs()->is__premium_only()) {
                        if (wcfdg_fs()->can_use_premium_code()) { ?>
                            <li>
                                <a class="dotstore_plugin <?php echo esc_attr( $quick_checkout ); ?>" href="<?php echo esc_url(add_query_arg(array('page' => 'wcdg-quick-checkout','tab' => 'products'), admin_url('admin.php'))); ?>"><?php esc_html_e('Quick Checkout', WCDG_TEXT_DOMAIN); ?></a>
                            </li>
                        <?php }
                    } ?>
                    <li>
                        <a class="dotstore_plugin <?php echo esc_attr( $fee_about ); ?>" href="<?php echo esc_url(add_query_arg(array('page' => 'wcdg-get-started'), admin_url('admin.php'))); ?>"><?php esc_html_e('About Plugin', WCDG_TEXT_DOMAIN); ?></a>
                        <ul class="sub-menu">
                            <li><a class="dotstore_plugin <?php echo esc_attr( $wcdg_getting_started ); ?>" href="<?php echo esc_url(add_query_arg(array('page' => 'wcdg-get-started'), admin_url('admin.php'))); ?>"><?php esc_html_e('Getting Started', WCDG_TEXT_DOMAIN); ?></a></li>
                            <li><a class="dotstore_plugin <?php echo esc_attr( $wcdg_information ); ?>" href="<?php echo esc_url(add_query_arg(array('page' => 'wcdg-information'), admin_url('admin.php'))); ?>"><?php esc_html_e('Quick info', WCDG_TEXT_DOMAIN); ?></a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="dotstore_plugin"><?php esc_html_e('Dotstore', WCDG_TEXT_DOMAIN); ?></a>
                        <ul class="sub-menu">
                            <li><a target="_blank" href="<?php echo esc_url('https://www.thedotstore.com/woocommerce-plugins/'); ?>"><?php esc_html_e('WooCommerce Plugins',WCDG_TEXT_DOMAIN); ?></a></li>
                            <li><a target="_blank" href="<?php echo esc_url('https://www.thedotstore.com/wordpress-plugins/'); ?>"><?php esc_html_e('Wordpress Plugins', WCDG_TEXT_DOMAIN); ?></a></li><br>
                            <li><a target="_blank" href="<?php echo esc_url('https://www.thedotstore.com/support/'); ?>"><?php esc_html_e('Contact Support', WCDG_TEXT_DOMAIN); ?></a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </header>