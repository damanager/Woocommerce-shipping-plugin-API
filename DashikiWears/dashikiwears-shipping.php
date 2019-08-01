<?php
/**
 * Plugin Name: DashikiWears
 * Description: DashikiWears is  a woocommerce custom shipping method plugin
 * Tutorials from https://docs.woocommerce.com/document/shipping-method-api/# 
 * Skeleton from https://gist.github.com/woogists/c0cb26faa4f329dc0c01d78f53e797e9#file-wc-skeleton-shipping-method-example-php
 */
if ( ! defined( 'WPINC' ) ){
 die('security by preventing any direct access to your plugin file');
}
if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
 function dashikiwears_shipping_method()
 {
 if (!class_exists('dashikiwears_Shipping_Method')) {
 class dashikiwears_Shipping_Method extends WC_Shipping_Method
 {
 public function __construct()
 {
 $this->id = 'dashikiwears';
 $this->method_title = __('dashikiwears Shipping', 'dashikiwears');
 $this->method_description = __('Custom Shipping Method for dashikiwears', 'dashikiwears');
 // Location availability
 $this->availability = 'including';
 $this->countries = array(
 'EU',
 'GB',
 'US',
 );
 $this->init();
 $this->enabled = isset($this->settings['enabled']) ? $this->settings['enabled'] : 'yes';
 $this->title = isset($this->settings['title']) ? $this->settings['title'] : __('dashikiwears Shipping', 'dashikiwears');
 }
