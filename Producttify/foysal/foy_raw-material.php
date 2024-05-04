<?php
/*
Plugin Name: Raw Materila
Plugin URI: https://wordpress.org/plugins/health-check/
Description: Checks the health of your WordPress install
Version: 0.3.0
Author: The project Plugin Team
Author URI: http://health-check-team.example.com
Text Domain: midProject
Domain Path: /languages
*/

// register_activation_hook(
//     __FILE__,
//     'create_table'
// );
// function create_table()
// {
//     global $wpdb;
//     $raw_material = $wpdb->prefix . "raw_material";
//     $query = "CREATE TABLE $raw_material(id int AUTO_INCREMENT PRIMARY KEY,name varchar(255), price decimal(10,2))";
//     require_once ABSPATH . 'wp-admin/includes/upgrade.php';
//     dbDelta($query);
//     $add = "insert into $table(name,price)values('rice','1000')";
//     $wpdb->query($add);
// }

// register_deactivation_hook(
//     __FILE__,
//     'delete_table'
// );

// function delete_table()
// {
//     global $wpdb;
//     $table = $wpdb->prefix . "raw_material";
//     $query = "drop table $table";
//     $wpdb->query($query);
// }

// function add_my_menu()
// {
    add_submenu_page(
        'Dashboard',
        'foy_raw_material',
        'Raw Material',
        'manage_options',
        'foy_my-top-level-slug',
        function () {
            include dirname(__FILE__) . '/foy_page.php';
        }
    );
    add_submenu_page(
        'foy_my-top-level-slug',
        'Raw Material',
        'Add material',
        'manage_options',
        'foy_garements',
        function () {
            include dirname(__FILE__) . '/foy_add_material.php';
        }
    );
    add_submenu_page(
        'foy_my-top-level-slug',
        'update',
        'update Material',
        'manage_options',
        'foy_edit',
        function () {
            include dirname(__FILE__) . '/foy_update.php';
        }
    );
   

// }
// function contact_fn()
// {
//     echo  "Welcome";
// }
// add_action('admin_menu', 'add_my_menu');

