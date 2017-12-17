<?php

/**
 * Plugin Name: WooCommerce ePay.bg Gateway
 * Plugin URI: https://wordpress.org/plugins/woocommerce-epaybg/
 * Description: ePay Gateway provides a fully integration with ePay.bg platform, secure way to collect and transmit credit card data to your payment gateway while keeping you in control of the design of your site.
 * Version: 1.4
 * Author: dimitrov.adrian
 * Author URI: https://www.linkedin.com/in/dimitrovadrian
 * Text Domain: woocommerce-epaybg
 * Domain Path: /languages
 */

if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly.
}

/**
 * Epaybg Checkout main class.
 */
class WC_Epaybg_Checkout {

  /**
   * Plugin version.
   *
   * @var string
   */
  const VERSION = '1.4';

  /**
   * Instance of this class.
   *
   * @var object
   */
  protected static $instance = NULL;

  /**
   * Initialize the plugin public actions.
   */
  private function __construct() {
    // Load plugin text domain
    load_plugin_textdomain('woocommerce-epaybg', FALSE, dirname(plugin_basename(__FILE__)) . '/languages');

    // Checks with WooCommerce is installed.
    if (defined('WC_VERSION') && version_compare(WC_VERSION, '2.2', '>=')) {
      $this->includes();

      add_filter('woocommerce_payment_gateways', array($this, 'add_gateway'));
    }
    else {
      add_action('admin_notices', array($this, 'woocommerce_missing_notice'));
    }
  }

  /**
   * Return an instance of this class.
   *
   * @return object A single instance of this class.
   */
  public static function get_instance() {
    // If the single instance hasn't been set, set it now.
    if (NULL == self::$instance) {
      self::$instance = new self;
    }

    return self::$instance;
  }

  /**
   * Includes.
   *
   * @return void
   */
  private function includes() {
    include_once(__DIR__ . '/includes/class-wc-gateway-epaybg.php');
    include_once(__DIR__ . '/includes/class-wc-gateway-epaybg-directpay.php');
    include_once(__DIR__ . '/includes/class-wc-gateway-epaybg-easypay.php');
  }

  /**
   * Add the ePay.bg gateways.
   *
   * @param  array $methods WooCommerce payment methods.
   *
   * @return array          epaybg Checkout gateway.
   */
  public function add_gateway($methods) {

    $methods[] = 'WC_Gateway_Epaybg';
    $methods[] = 'WC_Gateway_Epaybg_DirectPay';
    $methods[] = 'WC_Gateway_Epaybg_EasyPay';
    return $methods;
  }

  /**
   * WooCommerce fallback notice.
   *
   * @return string
   */
  public function woocommerce_missing_notice() {
    echo '<div class="error"><p>' . sprintf(__('ePay.bg Checkout depends on the %s or later to work!', 'woocommerce-epaybg'), '<a href="http://wordpress.org/extend/plugins/woocommerce/">' . __('WooCommerce 2.2', 'woocommerce-gateway-epaybg-checkout') . '</a>') . '</p></div>';
  }
}

/**
 * hmac implementation used by ePay.bg
 *
 * @param $algo
 * @param $data
 * @param $passwd
 *
 * @return string
 */
function woocommerce_epaybg_hmac($algo, $data, $passwd) {
  /* md5 and sha1 only */
  $algo = strtolower($algo);
  $p = array('md5' => 'H32', 'sha1' => 'H40');
  if (strlen($passwd) > 64) {
    $passwd = pack($p[$algo], $algo($passwd));
  }
  if (strlen($passwd) < 64) {
    $passwd = str_pad($passwd, 64, chr(0));
  }

  $ipad = substr($passwd, 0, 64) ^ str_repeat(chr(0x36), 64);
  $opad = substr($passwd, 0, 64) ^ str_repeat(chr(0x5C), 64);

  return ($algo($opad . pack($p[$algo], $algo($ipad . $data))));
}

add_action('plugins_loaded', array('WC_Epaybg_Checkout', 'get_instance'), 0);
