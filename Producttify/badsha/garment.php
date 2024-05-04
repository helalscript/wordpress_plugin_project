<?php
/*
Plugin Name: Garment Plugin
Plugin URI: https://wordpress.org/plugins/health-check/
Description: Checks the health of your WordPress install
Version: 0.1.0
Author: The Test Plugin Team
Author URI: http://health-check-team.example.com
Text Domain: ghgfjgh
Domain Path: /languages
*/

// register_activation_hook(
// 	__FILE__,
// 	'create_table'
// );
// function create_table() {
//     global $wpdb;
//     $purchase_table=$wpdb->prefix ."badsha_purchase";
//     $query="CREATE TABLE if not exists $purchase_table(id int AUTO_INCREMENT PRIMARY KEY,invoice_id int not null, price decimal(10,2) not null, material_id int not null, supplier_id int not null, quantity int not null, date date not null)";
//     require_once ABSPATH . 'wp-admin/includes/upgrade.php';
// 	dbDelta( $query );
//     // $add="insert into $table(name,email,phone,address)values('Habib','habib@email.com','017','Mohammadpur')";
//     // $wpdb->query($add);
// }

// register_deactivation_hook(
// 	__FILE__,
// 	'delete_table'
// );

// function delete_table(){
//     global $wpdb;
//     $purchase_table=$wpdb->prefix ."badsha_purchase";
//     $query="drop table $purchase_table";
//     $wpdb->query($query);
// }

// add_shortcode('test_code', 'testCode');
// function testCode($atts, $content = '', $tag){
//     include dirname(__FILE__) . '/contact.php';
// }

// function add_my_menu()
// {
    // add_menu_page(
    //     'Garments',
    //     'Garments Menu',
    //     'manage_options',
    //     'garment',
        // function () {
        //     include dirname(__FILE__) . '/purchase.php';
        // }
    // );
    add_submenu_page(
        'Dashboard',
        'My Custom Page',
        'Purchase',
        'manage_options',
        'badsha_garment_purchase',
        function () {
            include dirname(__FILE__) . '/badsha_purchase.php';
        }
    );
    add_submenu_page(
        'badsha_garment_purchase',
        'My Custom Page',
        'My Custom Page',
        'manage_options',
        'badsha_insert',
        function(){
            include dirname(__FILE__). '/badsha_insert.php';
        }
    );
    add_submenu_page(
        'badsha_garment_purchase',
        'My Custom Page',
        'My Custom Page',
        'manage_options',
        'badsha_edit',
        function(){
            include dirname(__FILE__). '/badsha_edit.php';
        }
    );
// }
// function contact_fn()
// {
//     echo  "Welcome";
// }
// add_action('admin_menu', 'add_my_menu');




