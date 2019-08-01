<?php
/**
 * Plugin Name: DashikiWears
 * Description: DashikiWears is  a woocommerce custom shipping method plugin
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
 