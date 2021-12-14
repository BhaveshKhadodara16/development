<?php

/**
 * Plugin Name: Digital Goods for WooCommerce Checkout Pro
 * Plugin URI:        https://www.thedotstore.com/
 * Description:       This plugin will remove billing address fields for downloadable and virtual products.
 * Version:           3.6.1
 * Author:            theDotstore
 * Author URI:        https://www.thedotstore.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       woo-checkout-for-digital-goods
 * Domain Path:       /languages
 * WC tested up to: 5.7.1
 */
// If this file is called directly, abort.
if ( !defined( 'ABSPATH' ) ) {
    die;
}

if ( function_exists( 'wcfdg_fs' ) ) {
    wcfdg_fs()->set_basename( true, __FILE__ );
    return;
}

add_action( 'plugins_loaded', 'wcdg_initialize_plugin' );
$wc_active = in_array( 'woocommerce/woocommerce.php', get_option( 'active_plugins' ), true );

if ( true === $wc_active ) {
    
    if ( !function_exists( 'wcfdg_fs' ) ) {
        // Create a helper function for easy SDK access.
        function wcfdg_fs()
        {
            global  $wcfdg_fs ;
            
            if ( !isset( $wcfdg_fs ) ) {
                // Include Freemius SDK.
                require_once dirname( __FILE__ ) . '/freemius/start.php';
                $wcfdg_fs = fs_dynamic_init( array(
                    'id'             => '4703',
                    'slug'           => 'woo-checkout-for-digital-goods',
                    'type'           => 'plugin',
                    'public_key'     => 'pk_2eb1a2c306bc0ab838b9439f8fa73',
                    'is_premium'     => true,
                    'premium_suffix' => 'Pro',
                    'has_addons'     => false,
                    'has_paid_plans' => true,
                    'trial'          => array(
                    'days'               => 14,
                    'is_require_payment' => true,
                ),
                    'menu'           => array(
                    'slug'       => 'wcdg-general-setting',
                    'first-path' => 'admin.php?page=wcdg-general-setting',
                    'support'    => false,
                    'contact'    => false,
                ),
                    'is_live'        => true,
                ) );
            }
            
            return $wcfdg_fs;
        }
        
        // Init Freemius.
        wcfdg_fs();
        // Signal that SDK was initiated.
        do_action( 'wcfdg_fs_loaded' );
        wcfdg_fs()->get_upgrade_url();
        wcfdg_fs()->add_action( 'after_uninstall', 'wcfdg_fs_uninstall_cleanup' );
    }
    
    if ( !defined( 'WCDG_TEXT_DOMAIN' ) ) {
        define( 'WCDG_TEXT_DOMAIN', 'woo-checkout-for-digital-goods' );
    }
    if ( !defined( 'WCDG_PLUGIN_URL' ) ) {
        define( 'WCDG_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
    }
    if ( !defined( 'WCDG_PLUGIN_BASENAME' ) ) {
        define( 'WCDG_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
    }
    if ( !defined( 'WCDG_PLUGIN_VERSION' ) ) {
        define( 'WCDG_PLUGIN_VERSION', '3.6.1' );
    }
    if ( !defined( 'WCDG__TEXT_DOMAIN' ) ) {
        define( 'WCDG__TEXT_DOMAIN', 'woo-checkout-for-digital-goods' );
    }
    if ( !function_exists( 'wp_get_current_user' ) ) {
        include ABSPATH . "wp-includes/pluggable.php";
    }
    
    if ( wcfdg_fs()->is__premium_only() ) {
        
        if ( wcfdg_fs()->can_use_premium_code() ) {
            if ( !defined( 'WCDG_PLUGIN_NAME' ) ) {
                define( 'WCDG_PLUGIN_NAME', 'Digital Goods for WooCommerce Checkout Pro' );
            }
            if ( !defined( 'WCDG_TEXT_DOMAIN' ) ) {
                define( 'WCDG_TEXT_DOMAIN', 'woo-checkout-for-digital-goods-pro' );
            }
            if ( !defined( 'WCDG_VERSION_TEXT' ) ) {
                define( 'WCDG_VERSION_TEXT', __( 'Pro Version' ) );
            }
        } else {
            if ( !defined( 'WCDG_PLUGIN_NAME' ) ) {
                define( 'WCDG_PLUGIN_NAME', 'Digital Goods for WooCommerce Checkout' );
            }
            if ( !defined( 'WCDG_TEXT_DOMAIN' ) ) {
                define( 'WCDG_TEXT_DOMAIN', 'woo-checkout-for-digital-goods' );
            }
            if ( !defined( 'WCDG_VERSION_TEXT' ) ) {
                define( 'WCDG_VERSION_TEXT', __( 'Free Version' ) );
            }
        }
    
    } else {
        if ( !defined( 'WCDG_PLUGIN_NAME' ) ) {
            define( 'WCDG_PLUGIN_NAME', 'Digital Goods for WooCommerce Checkout' );
        }
        if ( !defined( 'WCDG_TEXT_DOMAIN' ) ) {
            define( 'WCDG_TEXT_DOMAIN', 'woo-checkout-for-digital-goods' );
        }
        if ( !defined( 'WCDG_VERSION_TEXT' ) ) {
            define( 'WCDG_VERSION_TEXT', __( 'Free Version' ) );
        }
    }
    
    /**
     * The code that runs during plugin activation.
     * This action is documented in includes/class-woo-checkout-for-digital-goods-activator.php
     */
    if ( !function_exists( 'activate_woo_checkout_for_digital_goods' ) ) {
        function activate_woo_checkout_for_digital_goods()
        {
            require_once plugin_dir_path( __FILE__ ) . 'includes/class-woo-checkout-for-digital-goods-activator.php';
            Woo_Checkout_For_Digital_Goods_Activator::activate();
        }
    
    }
    /**
     * The code that runs during plugin deactivation.
     * This action is documented in includes/class-woo-checkout-for-digital-goods-deactivator.php
     */
    if ( !function_exists( 'deactivate_woo_checkout_for_digital_goods' ) ) {
        function deactivate_woo_checkout_for_digital_goods()
        {
            require_once plugin_dir_path( __FILE__ ) . 'includes/class-woo-checkout-for-digital-goods-deactivator.php';
            Woo_Checkout_For_Digital_Goods_Deactivator::deactivate();
        }
    
    }
    register_activation_hook( __FILE__, 'activate_woo_checkout_for_digital_goods' );
    register_deactivation_hook( __FILE__, 'deactivate_woo_checkout_for_digital_goods' );
    /**
     * The core plugin class that is used to define internationalization,
     * admin-specific hooks, and public-facing site hooks.
     */
    require plugin_dir_path( __FILE__ ) . 'includes/class-woo-checkout-for-digital-goods.php';
    /**
     * Begins execution of the plugin.
     *
     * Since everything within the plugin is registered via hooks,
     * then kicking off the plugin from this point in the file does
     * not affect the page life cycle.
     *
     * @since    1.0.0
     */
    if ( !function_exists( 'run_woo_checkout_for_digital_goods' ) ) {
        function run_woo_checkout_for_digital_goods()
        {
            $plugin = new Woo_Checkout_For_Digital_Goods();
            $plugin->run();
        }
    
    }
}

/**
 * Check Initialize plugin in case of WooCommerce plugin is missing.
 *
 * @since    1.0.0
 */
if ( !function_exists( 'wcdg_initialize_plugin' ) ) {
    function wcdg_initialize_plugin()
    {
        $wc_active = in_array( 'woocommerce/woocommerce.php', get_option( 'active_plugins' ), true );
        
        if ( current_user_can( 'activate_plugins' ) && $wc_active !== true || $wc_active !== true ) {
            add_action( 'admin_notices', 'wcdg_plugin_admin_notice' );
        } else {
            run_woo_checkout_for_digital_goods();
        }
        
        load_plugin_textdomain( 'woo-checkout-for-digital-goods', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
    }

}
/**
 * Order Thank you page form
 *
 * @since    1.0.0
 */
add_action( 'woocommerce_thankyou', 'wcdg_thankyou_page_form', 12 );
if ( !function_exists( 'wcdg_thankyou_page_form' ) ) {
    function wcdg_thankyou_page_form( $order_id )
    {
        if ( wcfdg_fs()->is__premium_only() ) {
            
            if ( wcfdg_fs()->can_use_premium_code() ) {
                $woo_checkout_unserlize_array = maybe_unserialize( get_option( 'wcdg_checkout_setting' ) );
                $wcdg_ty_address_1_field_display = ( isset( $woo_checkout_unserlize_array['wcdg_allow_additional_field_update_flag'] ) ? $woo_checkout_unserlize_array['wcdg_allow_additional_field_update_flag'] : '' );
                $endpoint = apply_filters( 'endpoing_edit_address', 'edit-address/billing/' );
                $edit_profile = wc_get_account_endpoint_url( $endpoint );
                $billing_msg_title = apply_filters( 'default_billing_msg_title', __( 'Want to update the billing information?', 'woo-checkout-for-digital-goods' ) );
                
                if ( !empty($wcdg_ty_address_1_field_display) ) {
                    ?>
                    <div class="quick_edit_container">
                        <h2><?php 
                    esc_html_e( $billing_msg_title, 'woo-checkout-for-digital-goods' );
                    ?></h2>
                        <?php 
                    echo  '<a href="' . esc_url( $edit_profile ) . '" class="button wcdg_delay_account">' . esc_html( "Update now", "woo-checkout-for-digital-goods" ) . '</a>' ;
                    ?>
                    </div>
                <?php 
                }
            
            }
        
        }
    }

}
/**
 * Show admin notice in case of WooCommerce plugin is missing.
 *
 * @since    1.0.0
 */
if ( !function_exists( 'wcdg_plugin_admin_notice' ) ) {
    function wcdg_plugin_admin_notice()
    {
        $vpe_plugin = esc_html__( 'Digital Goods for WooCommerce Checkout', 'woo-checkout-for-digital-goods' );
        $wc_plugin = esc_html__( 'WooCommerce', 'woo-checkout-for-digital-goods' );
        ?>
        <div class="error">
            <p>
                <?php 
        echo  sprintf( esc_html__( '%1$s requires %2$s to be installed & activated!', 'woo-checkout-for-digital-goods' ), '<strong>' . esc_html( $vpe_plugin ) . '</strong>', '<a href="' . esc_url( 'https://wordpress.org/plugins/woocommerce/' ) . '" target="_blank"><strong>' . esc_html( $wc_plugin ) . '</strong></a>' ) ;
        ?>
            </p>
        </div>
        <?php 
    }

}