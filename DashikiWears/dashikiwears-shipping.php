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
 /**
 Load the settings API
 */
function init()
{
$this->init_form_fields();
$this->init_settings();
add_action('woocommerce_update_options_shipping_' . $this->id, array($this, 'process_admin_options'));
}
function init_form_fields()
{
$this->form_fields = array(
'enabled' => array(
'title' => __('Enable', 'dashikiwears'),
'type' => 'checkbox',
'default' => 'yes'
),
'weight' => array(
'title' => __('Weight (kg)', 'dashikiwears'),
'type' => 'number',
'default' => 50
),
'title' => array(
'title' => __('Title', 'dashikiwears'),
'type' => 'text',
'default' => __('dashikiwears Shipping', 'dashikiwears')
),
);
}
public function dashikiwears_shipping_calculation($package)
 {
 $weight = 0;
 $cost = 0;
 $country = $package["destination"]["country"];
 foreach ($package['contents'] as $item_id => $values) {
 $_product = $values['data'];
 $weight = $weight + $_product->get_weight() * $values['quantity'];
 }
 $weight = wc_get_weight($weight, 'kg');
 if ($weight <= 5) {
 $cost = 0;
 } elseif ($weight <= 25) {
 $cost = 5;
 } elseif ($weight <= 45) {
 $cost = 10;
 } else {
 $cost = 15;
 }
 $countryZones = array(
 'EU' => 2,
 'GB' => 2,
 'US' => 3
 );
 $zonePrices = array(
 2 => 50,
 3 => 70
 );
 $zoneFromCountry = $countryZones[$country];
 $priceFromZone = $zonePrices[$zoneFromCountry];
 $cost += $priceFromZone;
 $rate = array(
 'id' => $this->id,
 'label' => $this->title,
 'cost' => $cost
 );
 $this->add_rate($rate);
 }
 }
 }
 }