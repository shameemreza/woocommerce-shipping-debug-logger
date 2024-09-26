<?php
/**
 * Plugin Name: WooCommerce Shipping Debug Logger
 * Author Name: Shameem Reza
 * Author URI: http://shameem.dev
 * Description: Logs shipping calculation attempts and results
 * Version: 1.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class WC_Shipping_Debug_Logger {
    public function __construct() {
        add_action('woocommerce_cart_calculate_fees', array($this, 'log_shipping_calculation'), 10, 1);
        add_action('woocommerce_cart_shipping_packages', array($this, 'log_shipping_packages'), 10, 1);
        add_action('woocommerce_package_rates', array($this, 'log_available_rates'), 10, 2);
    }

    public function log_shipping_calculation($cart) {
        $this->log("Shipping calculation triggered. Cart total: " . $cart->get_cart_contents_total());
    }

    public function log_shipping_packages($packages) {
        $this->log("Shipping packages: " . print_r($packages, true));
        return $packages;
    }

    public function log_available_rates($rates, $package) {
        $this->log("Available shipping rates for package " . print_r($package, true) . ":");
        foreach ($rates as $rate) {
            $this->log("  - " . $rate->get_label() . ": " . wc_price($rate->get_cost()));
        }
        return $rates;
    }

    private function log($message) {
        $log_file = WP_CONTENT_DIR . '/shipping-debug.log';
        $timestamp = date('[Y-m-d H:i:s]');
        file_put_contents($log_file, $timestamp . ' ' . $message . "\n", FILE_APPEND);
    }
}

new WC_Shipping_Debug_Logger();