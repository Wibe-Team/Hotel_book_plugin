<?php
/*
  Plugin Name: hbook2
  Plugin URI: http://leadmarketing.com.ua
  Description: a plugin
  Version: 1.0
  Author: LeadMarceting
  Author URI: http://leadmarketing.com.ua
  License: GPL2
*/

add_option("hbook2", "1.0");

register_activation_hook(__FILE__, 'hbook2_activation');
register_deactivation_hook(__FILE__, 'hbook2_deactivation');



function hbook2_activation(){

  global $wp_version;
  global $wpdb;

  if(version_compare('3.2', $wp_version, '>'))
  {
  	wp_die( 'this plagin cannot activated because you use old version wordpress, update your wordpress please!'.$wp_version );
  }

  if($wpdb->get_var("SHOW TABLES LIKE 'wp_hb2'") != 'wp_hb2') {

    $sql =
    "CREATE TABLE wp_hb2_hotels (
      id bigint(20) NOT NULL AUTO_INCREMENT,
      name varchar(255) NOT NULL,
      country varchar(255) NOT NULL,
      region varchar(255) NOT NULL,
      town varchar(255) NOT NULL,
      adress varchar(255) NOT NULL,
      stars varchar(255) NOT NULL,
      description text NOT NULL,
      PRIMARY KEY  (id)
    )DEFAULT CHARACTER SET utf8mb4;

    CREATE TABLE wp_hb2_accommodations (
      id bigint(20) NOT NULL AUTO_INCREMENT,
      name varchar(255) NOT NULL,
      text text NOT NULL,
      search_text text NOT NULL,
      hotel varchar(255) NOT NULL,
      normal_occupancy int(5) NOT NULL,
      max_occupancy int(5) NOT NULL,
      min_occupancy int(5) NOT NULL,
      starting_price float(8,2) NOT NULL,
      percent_hotel float(8,2) NOT NULL,
      percent_client float(8,2) NOT NULL,
      fees tinyint(1) NOT NULL,
      PRIMARY KEY  (id)
    )DEFAULT CHARACTER SET utf8mb4;

    CREATE TABLE wp_hb2_fees (
      id bigint(20) NOT NULL AUTO_INCREMENT,
      accomm_id varchar(255) NOT NULL,
      type varchar(255) NOT NULL,
      name varchar(255) NOT NULL,
      am_adults float(8,2) NOT NULL,
      am_child varchar(255) NOT NULL,
      PRIMARY KEY  (id)
    )DEFAULT CHARACTER SET utf8mb4;
    ";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);

    $the_name="name";
    $the_text="text";

    $x = $wpdb->insert(
      'wp_hb2_hotels',
      array('name' => 'Mioni Pezzato',
            'country' => 'Италия',
            'region' => 'Тоскана',
            'town' => 'Город',
            'adress' => 'фывфыв',
            'stars' => '4',
            'description' => 'description2',
      )
    );

    $x = $wpdb->insert(
      'wp_hb2_hotels',
      array('name' => 'Mioni Pezzato2',
            'country' => 'Италия',
            'region' => 'Тоскана',
            'town' => 'Город',
            'adress' => 'фывфыв',
            'stars' => '4',
            'description' => 'description2',
      )
    );

    $x = $wpdb->insert(
      'wp_hb2_accommodations',
      array('name' => 'Room in Mioni Pezzato',
            'text' => 'text',
            'search_text' => 'search_text',
            'hotel' => 'Mioni Pezzato',
            'normal_occupancy' => 5,
            'max_occupancy' => 9,
            'min_occupancy' => 1,
            'starting_price' => 65,
            'percent_hotel' => 33,
            'percent_client' => 55,
            'fees' =? 3,
      )
    );



  }
}

function hbook2_deactivation() {
  global $wpdb;
  $wpdb->query( "DROP TABLE IF EXISTS wp_hb2_accommodations, wp_hb2_hotels, wp_hb2_fees" );
}

add_action( 'admin_menu', 'hbook2_create_menu' );
add_action( 'wp_enqueue_scripts', 'true_style_frontend' );

function true_style_frontend() {
  wp_enqueue_style( 'header-main-style', plugin_dir_path(__FILE__ ).'/css/main.css' );
  wp_enqueue_style( 'header-jqdt-style', plugin_dir_path(__FILE__ ).'/css/jquery.dataTables.min.css' );
}

function themeslug_header_style(){

}

function hbook2_create_menu() {

	add_menu_page(
    'Hbook2 Plugin Page',
    'Hbook2 Plugin',
  	'manage_options',
    'hbook2_main_menu',
    'hbook2_main_page_display',
  	plugins_url( '/images/wordpress.png', __FILE__ )
  );

	add_submenu_page(
    'hbook2_main_menu',
    'Hbook2 Accommodation',
	  'Accommodation',
    'manage_options',
    'hbook2_accommodation',
	  'hbook2_accommodation_display'
   );

  add_submenu_page(
   'hbook2_main_menu',
   'Hbook2 Hotel',
   'Hotel',
   'manage_options',
   'hbook2_hotel',
   'hbook2_hotel_display'
  );
}

function hbook2_main_page_display()
{

}

function hbook2_accommodation_display()
{
require_once(plugin_dir_path(__FILE__ ). '/admin-pages/accommodation.php');
}

function hbook2_hotel_display()
{
require_once(plugin_dir_path(__FILE__ ). '/admin-pages/hotels.php');
}

require_once(plugin_dir_path(__FILE__ ). '/front-end/hotels.php');
require_once(plugin_dir_path(__FILE__ ). '/front-end/accommodation.php');

?>
