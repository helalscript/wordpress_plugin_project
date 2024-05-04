<?php
/*
Plugin Name: Garment Plugin
Plugin URI: https://wordpress.org/plugins/health-check/
Description: Checks the health of your WordPress install
Version: 0.1.0
Author: The Test Plugin Team
Author URI: http://health-check-team.example.com
Text Domain: test-plugin
Domain Path: /languages
*/
// register_activation_hook(
// 	__FILE__,
// 	'create_table'
// );
// function create_table() {
//     global $wpdb;
//     $material_wastage_dump=$wpdb->prefix ."material_wastage_dump";
//     $query="CREATE TABLE $material_wastage_dump(id int AUTO_INCREMENT PRIMARY KEY,material_id int not null,quantity int not null,date date not null)";
//     require_once ABSPATH . 'wp-admin/includes/upgrade.php';
// 	dbDelta( $query );
    // $add="insert into $table(material_id,quantity,date)values('2','12','2024')";
    // $wpdb->query($add);
// }

// register_deactivation_hook(
// 	__FILE__,
// 	'delete_table'
// );

// function delete_table(){
//     global $wpdb;
//     $table=$wpdb->prefix ."material_wastage_dump";
//     $query="drop table $table";
//     $wpdb->query($query);
// }
// function add_my_menu(){
    // add_submenu_page(
    //     'Dashboard',
    //     'Garments',
    //     'Garments Menu',
    //     'manage_options',
    //     'my-top-level-slug',
    //     function(){
    //         include dirname(__FILE__).'/material_wastage_dump.php';
    //     }
    // );
    add_submenu_page(
        'Dashboard',
        'za_My Custom Page',
        'Wastage Dump',
        'manage_options',
        'zahid_my-secondary-slug',
        function () {
            include dirname(__FILE__) . '/material_wastage_dump.php';
        }
    );
    add_submenu_page(
        'zahid_my-secondary-slug',
        'za_My Custom Page',
        'za_My Custom Page',
        'manage_options',
        'za_insert',
        function () {
            include dirname(__FILE__) . '/za_insert.php';
        }
    );
    add_submenu_page(
        'zahid_my-secondary-slug',
        'za_My Custom Page',
        'za_My Custom Page',
        'manage_options',
        'za_edit',
        function () {
            include dirname(__FILE__) . '/za_edit.php';
        }
    );
// }
// function contact_fn(){
//     echo  "Welcome";
// }
// add_action('admin_menu', 'add_my_menu');

