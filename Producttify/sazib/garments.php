<?php
/*
Plugin Name: garments
Plugin URI: https://garments.com/
Description: The perfect all-in-one responsive slider solution for WordPress.
Version: 1.2.0
Requires PHP: 7.0
Requires at least: 5.0
Author: Kamrul Sazib
Author URI: https://kamrulsazib.wordpress.com/plugins/garments
License: GPLv3 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html
Update URI: http://github.com/shovoalways
Text Domain:sstt
 */

//  register_activation_hook(
//     __FILE__,
//     'create_table'
// );

// //table create
// function create_table()
// {
//     global $wpdb;
//     $table = $wpdb->prefix . "stock_return";
//     $query = "CREATE TABLE $table(id int AUTO_INCREMENT PRIMARY KEY,invoice_id int not null,quantity int not null,date date not null,material_id int not null,supplier_id int not null)";
//     require_once ABSPATH . 'wp-admin/includes/upgrade.php';
//     dbDelta($query);
// }

// //table delete
// register_deactivation_hook(
//     __FILE__,
//     'delete_table'
// );

// function delete_table()
// {
//     global $wpdb;
//     $table = $wpdb->prefix . "stock_return";
//     $query = "drop table $table";
//     $wpdb->query($query);
// }

// function add_my_menu()
// {
//     add_menu_page(
//         'Garments',
//         'Garments Menu',
//         'manage_options',
//         'my-top-level-slug',
      
//     );
    add_submenu_page(
        'Dashboard',
        'My Custom Page',
        'stock_return',
        'manage_options',
        'sazib_my-secondary-slug',
        function () {
            include dirname(__FILE__) . '/stock_return.php';
        }
    );
    add_submenu_page(
        'sazib_my-secondary-slug',
        'sazib_My Custom Page',
        'stock_return',
        'manage_options',
        'sazib_insert',
        function () {
            include dirname(__FILE__) . '/sazib_insert.php';
        }
    );
    add_submenu_page(
        'sazib_my-secondary-slug',
        'sazib_My Custom Page',
        'stock_return',
        'manage_options',
        'sazib_edit',
        function () {
            include dirname(__FILE__) . '/sazib_edit.php';
        }
    );
// } 

// function contact_fn()
// {
//     echo  "Welcome";
// }
// add_action('admin_menu', 'add_my_menu');

