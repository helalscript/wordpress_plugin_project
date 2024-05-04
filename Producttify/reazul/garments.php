<?php
/*
Plugin Name: garments
Plugin URI: https://garments.com/
Description: The perfect all-in-one responsive slider solution for WordPress.
Version: 1.0.0
Requires PHP: 7.0
Requires at least: 5.0
Author:Rubon
Author URI: https://garments.com
License: GPLv3 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html
Update URI: http://github.com/shovoalways
Text Domain:sstt
 */
// register_activation_hook(
//     __FILE__,
//     'create_table'
// );

// function create_table()
// {
//     global $wpdb;
//     $supplier_payment = $wpdb->prefix . "supplier_payment";
//     $query = "CREATE TABLE $supplier_payment(id int AUTO_INCREMENT PRIMARY KEY,supplier_id int not null,amount decimal(10,2) not null,method varchar(255) not null,date date)";
//     require_once ABSPATH . 'wp-admin/includes/upgrade.php';
//     dbDelta($query);
    // $add = "insert into $table(supplier_id,amount,method,date)values('1','100','cash','2024-06-03')";
    // $wpdb->query($add);
// }

// register_deactivation_hook(
//     __FILE__,
//     'delete_table'
// );

// function delete_table()
// {
//     global $wpdb;
//     $table = $wpdb->prefix . "supplier_payment";
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
        'supplier-payment',
        'Supplier Payment',
        'manage_options',
        're_my-secondary-slug',
        function () {
            include dirname(__FILE__) . '/supplier-payment.php';
        }
    );
    add_submenu_page(
        're_my-secondary-slug',
        're_supplier-payment_insert',
        're_supplier-payment_insert',
        'manage_options',
        're_insert',
        function () {
            include dirname(__FILE__) . '/re_insert.php';
        }
    );
    add_submenu_page(
        're_my-secondary-slug',
        're_supplier-payment_edit',
        're_supplier-payment_edit',
        'manage_options',
        're_edit',
        function () {
            include dirname(__FILE__) . '/re_edit.php';
        }
    );
// }
// function contact_fn()
// {
//     echo  "Welcome";
// }
// add_action('admin_menu', 'add_my_menu');


