<?php
/**
 * Plugin review class.
 * Prompts users to give a review of the plugin on WordPress.org after a period of usage.
 *
 * Heavily based on code by CoBlocks
 * https://github.com/coblocks/coblocks/blob/master/includes/admin/class-coblocks-feedback.php
 *
 * @package   DigitalGoods
 * @author    theDotstore from DigitalGoods
 * @link      https://editorsDigitalGoods.com
 * @license   http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Main Feedback Notice Class
 */

class DigitalGoods_User_Feedback {

	/**
	 * Slug.
	 *
	 * @var string $slug
	 */
	private $slug;

	/**
	 * Name.
	 *
	 * @var string $name
	 */
	private $name;

	/**
	 * Time limit.
	 *
	 * @var string $time_limit
	 */
	private $time_limit;

	/**
	 * No Bug Option.
	 *
	 * @var string $nobug_option
	 */
	public $nobug_option;

	/**
	 * Activation Date Option.
	 *
	 * @var string $date_option
	 */
	public $date_option;

	/**
	 * Class constructor.
	 *
	 * @param string $args Arguments.
	 */
	public function __construct( $args ) {

		$this->slug = $args['slug'];
		$this->name = $args['name'];

		$this->date_option  = $this->slug . '_activation_date';
		$this->nobug_option = $this->slug . '_no_bug';

		if ( isset( $args['time_limit'] ) ) {
			$this->time_limit = $args['time_limit'];
		} else {
			$this->time_limit = WEEK_IN_SECONDS;
		}

		// Add actions.
		add_action( 'admin_init', array( $this, 'check_installation_date' ) );
		add_action( 'admin_init', array( $this, 'set_no_bug' ), 5 );
	}

	/**
	 * Seconds to words.
	 *
	 * @param string $seconds Seconds in time.
	 */
	public function seconds_to_words( $seconds ) {

		// Get the years.
		$years = ( intval( $seconds ) / YEAR_IN_SECONDS ) % 100;
		if ( $years > 1 ) {
			/* translators: Number of years */
			return sprintf( __( '%s years', WCDG_TEXT_DOMAIN ), $years );
		} elseif ( $years > 0 ) {
			return __( 'a year', WCDG_TEXT_DOMAIN );
		}

		// Get the weeks.
		$weeks = ( intval( $seconds ) / WEEK_IN_SECONDS ) % 52;
		if ( $weeks > 1 ) {
			/* translators: Number of weeks */
			return sprintf( __( '%s weeks', WCDG_TEXT_DOMAIN ), $weeks );
		} elseif ( $weeks > 0 ) {
			return __( 'a week', WCDG_TEXT_DOMAIN );
		}

		// Get the days.
		$days = ( intval( $seconds ) / DAY_IN_SECONDS ) % 7;
		if ( $days > 1 ) {
			/* translators: Number of days */
			return sprintf( __( '%s days', WCDG_TEXT_DOMAIN ), $days );
		} elseif ( $days > 0 ) {
			return __( 'a day', WCDG_TEXT_DOMAIN );
		}

		// Get the hours.
		$hours = ( intval( $seconds ) / HOUR_IN_SECONDS ) % 24;
		if ( $hours > 1 ) {
			/* translators: Number of hours */
			return sprintf( __( '%s hours', WCDG_TEXT_DOMAIN ), $hours );
		} elseif ( $hours > 0 ) {
			return __( 'an hour', WCDG_TEXT_DOMAIN );
		}

		// Get the minutes.
		$minutes = ( intval( $seconds ) / MINUTE_IN_SECONDS ) % 60;
		if ( $minutes > 1 ) {
			/* translators: Number of minutes */
			return sprintf( __( '%s minutes', WCDG_TEXT_DOMAIN ), $minutes );
		} elseif ( $minutes > 0 ) {
			return __( 'a minute', WCDG_TEXT_DOMAIN );
		}

		// Get the seconds.
		$seconds = intval( $seconds ) % 60;
		if ( $seconds > 1 ) {
			/* translators: Number of seconds */
			return sprintf( __( '%s seconds', WCDG_TEXT_DOMAIN ), $seconds );
		} elseif ( $seconds > 0 ) {
			return __( 'a second', WCDG_TEXT_DOMAIN );
		}
	}

	/**
	 * Check date on admin initiation and add to admin notice if it was more than the time limit.
	 */
	public function check_installation_date() {

		
		if ( ! get_site_option( $this->nobug_option ) || false === get_site_option( $this->nobug_option ) ) {

			add_site_option( $this->date_option, time() );

			// Retrieve the activation date.
			$install_date = get_site_option( $this->date_option );
			
			// If difference between install date and now is greater than time limit, then display notice.
			if ( ( time() - $install_date ) > $this->time_limit ) {
				add_action( 'admin_notices', array( $this, 'display_admin_notice' ) );
			}
		}
	}

	/**
	 * Display the admin notice.
	 */
	public function display_admin_notice() {

		$screen = get_current_screen();
		if ( isset( $screen->base ) && ( 'plugins' === $screen->base || 'dotstore-plugins_page_wcdg-general-setting' === $screen->base )) {
			$no_bug_url = wp_nonce_url( admin_url( 'plugins.php?' . $this->nobug_option . '=true' ), 'editorsDigitalGoods-feedback-nounce' );
			$time       = $this->seconds_to_words( time() - get_site_option( $this->date_option ) );
			?>

			<style>
			.notice.editorsDigitalGoods-notice {
				border-left-color: #272c51 !important;
				padding: 20px;
			}
			.rtl .notice.editorsDigitalGoods-notice {
				border-right-color: #272c51 !important;
			}
			.notice.notice.editorsDigitalGoods-notice .editorsDigitalGoods-notice-inner {
				display: table;
				width: 100%;
			}
			.notice.editorsDigitalGoods-notice .editorsDigitalGoods-notice-inner .editorsDigitalGoods-notice-icon,
			.notice.editorsDigitalGoods-notice .editorsDigitalGoods-notice-inner .editorsDigitalGoods-notice-content,
			.notice.editorsDigitalGoods-notice .editorsDigitalGoods-notice-inner .editorsDigitalGoods-install-now {
				display: table-cell;
				vertical-align: middle;
			}
			.notice.editorsDigitalGoods-notice .editorsDigitalGoods-notice-icon {
				color: #509ed2;
				font-size: 13px;
				width: 60px;
			}
			.notice.editorsDigitalGoods-notice .editorsDigitalGoods-notice-icon img {
				width: 64px;
			}
			.notice.editorsDigitalGoods-notice .editorsDigitalGoods-notice-content {
				padding: 0 40px 0 20px;
			}
			.notice.editorsDigitalGoods-notice p {
				padding: 0;
				margin: 0;
			}
			.notice.editorsDigitalGoods-notice h3 {
				margin: 0 0 5px;
			}
			.notice.editorsDigitalGoods-notice .editorsDigitalGoods-install-now {
				text-align: center;
			}
			.notice.editorsDigitalGoods-notice .editorsDigitalGoods-install-now .editorsDigitalGoods-install-button {
				padding: 6px 50px;
				height: auto;
				line-height: 20px;
				background: #32396a;
				border-color: #272c51 #0f153e #040823;
				box-shadow: 0 1px 0 #0d1f82;
				text-shadow: 0 -1px 1px #272c51, 1px 0 1px #171b3e, 0 1px 1px #0a1035, -1px 0 1px #040721;
			}
			.notice.editorsDigitalGoods-notice .editorsDigitalGoods-install-now .editorsDigitalGoods-install-button:hover {
				background: #272c51;
			}
			.notice.editorsDigitalGoods-notice a.no-thanks {
				display: block;
				margin-top: 10px;
				color: #72777c;
				text-decoration: none;
			}

			.notice.editorsDigitalGoods-notice a.no-thanks:hover {
				color: #444;
			}

			@media (max-width: 767px) {

				.notice.notice.editorsDigitalGoods-notice .editorsDigitalGoods-notice-inner {
					display: block;
				}
				.notice.editorsDigitalGoods-notice {
					padding: 20px !important;
				}
				.notice.editorsDigitalGoods-noticee .editorsDigitalGoods-notice-inner {
					display: block;
				}
				.notice.editorsDigitalGoods-notice .editorsDigitalGoods-notice-inner .editorsDigitalGoods-notice-content {
					display: block;
					padding: 0;
				}
				.notice.editorsDigitalGoods-notice .editorsDigitalGoods-notice-inner .editorsDigitalGoods-notice-icon {
					display: none;
				}

				.notice.editorsDigitalGoods-notice .editorsDigitalGoods-notice-inner .editorsDigitalGoods-install-now {
					margin-top: 20px;
					display: block;
					text-align: left;
				}

				.notice.editorsDigitalGoods-notice .editorsDigitalGoods-notice-inner .no-thanks {
					display: inline-block;
					margin-left: 15px;
				}
			}
			</style>
			<div class="notice updated editorsDigitalGoods-notice">
				<div class="editorsDigitalGoods-notice-inner">
					<div class="editorsDigitalGoods-notice-icon">
						<?php /* translators: 1. Name */ ?>
						<img src="<?php echo esc_url( plugins_url( 'admin/images/woo-digital-goods-checkout-icon.png', dirname( __FILE__ ))); ?>" alt="<?php printf( esc_attr__( '%s WordPress Plugin', WCDG_TEXT_DOMAIN ), esc_attr( $this->name ) ); ?>" />
					</div>
					<div class="editorsDigitalGoods-notice-content">
						<?php /* translators: 1. Name */ ?>
						<h3><?php printf( esc_html__( 'Are you enjoying %s Plugin?', WCDG_TEXT_DOMAIN ), esc_html( $this->name ) ); ?></h3>
						<p>
							<?php /* translators: 1. Name, 2. Time */ ?>
							<?php printf( esc_html__( 'You have been using %1$s for %2$s now. Mind leaving a review to let us know know what you think? We\'d really appreciate it!', WCDG_TEXT_DOMAIN ), esc_html( $this->name ), esc_html( $time ) ); ?>
						</p>
					</div>
					<div class="editorsDigitalGoods-install-now">
						<?php 
						$review_url = '';
						if ( wcfdg_fs()->is__premium_only() ) {
							if ( wcfdg_fs()->can_use_premium_code() ) {
								$review_url = esc_url( 'https://www.thedotstore.com/woocommerce-checkout-for-digital-goods/#tab-reviews' );
							}
						} else {
							$review_url = esc_url( 'https://wordpress.org/plugins/woo-checkout-for-digital-goods/#reviews' );
						}
						printf( '<a href="%1$s" class="button button-primary editorsDigitalGoods-install-button" target="_blank">%2$s</a>', esc_url( $review_url ), esc_html__( 'Leave a Review', WCDG_TEXT_DOMAIN ) ); 
						?>
						<a href="<?php echo esc_url( $no_bug_url ); ?>" class="no-thanks"><?php echo esc_html__( 'No thanks / I already have', WCDG_TEXT_DOMAIN ); ?></a>
					</div>
				</div>
			</div>
			<?php
		}
	}

	/**
	 * Set the plugin to no longer bug users if user asks not to be.
	 */
	public function set_no_bug() {

		// Bail out if not on correct page.
		// phpcs:ignore
		if ( ! isset( $_GET['_wpnonce'] ) || ( ! wp_verify_nonce( $_GET['_wpnonce'], 'editorsDigitalGoods-feedback-nounce' ) || ! is_admin() || ! isset( $_GET[ $this->nobug_option ] ) || ! current_user_can( 'manage_options' ) ) ) {
			return;
		}

		add_site_option( $this->nobug_option, true );
	}
}

/*
* Instantiate the DigitalGoods_User_Feedback class.
*/
new DigitalGoods_User_Feedback(
	array(
		'slug'       => 'editorsdigital_goods_plugin_feedback',
		'name'       => __( 'Digital Goods for WooCommerce Checkout', WCDG_TEXT_DOMAIN ),
		'time_limit' => WEEK_IN_SECONDS,
	)
);
