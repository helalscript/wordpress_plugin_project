<?php
/*
Plugin Name: Startup Form by Rakib ON
Plugin URI: https://www.facebook.com/therakibkhan
Description: This adds form to website
Version: 0.0.1
Author: Rakib Khan
Author URI: http://www.facebook.com/therakibkhan
Text Domain: startup-form-rakibkhan
Domain Path: /sartupfrombyrakib
*/
// register_activation_hook(
//     __FILE__,
//     'ActivationFn'
// );

// function ActivationFn()
// {
//     global $wpdb;
//     $startup_buyers = $wpdb->prefix . "secondary_buyers";
//     $query = "CREATE TABLE IF NOT EXISTS $startup_buyers(id int AUTO_INCREMENT PRIMARY KEY,name varchar(100),email varchar(50),phone varchar(50),address text)";
//     $wpdb->query($query);
// }

// //Deactivation

// register_deactivation_hook(
//     __FILE__,
//     'DeactivationFn'
// );

// function DeactivationFn()
// {
//     global $wpdb;
//     $table = $wpdb->prefix . "startup_buyers";
//     $query = "drop table $table";
//     $wpdb->query($query);
// }

// //Custom Menu

// function form_menu()
// {
    add_submenu_page(
        'Dashboard',
        "rakib_Buyers List",
        "Buyers",
        "manage_options",
        "rakib_buyers",
        function () {
            include dirname(__FILE__) . "/buyers_list.php";
        },
    );
    add_submenu_page(
        'rakib_buyers',
        'Buyers Form 2',
        'Buyers Form 2',
        'manage_options',
        'buyers_form',
        function () {
            include dirname(__FILE__) . '/buyers_add.php';
        }
    );
    add_submenu_page(
        'rakib_buyers',
        'rakib_My Custom Page',
        'rakib_My Custom Page',
        'manage_options',
        'rakib_edit',
        function () {
            include dirname(__FILE__) . '/buyers_edit.php';
        }
    );
// }

// add_action("admin_menu", "form_menu");


