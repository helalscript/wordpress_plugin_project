<?php
/*
Plugin Name: Suppliers
Plugin URI: https://wordpress.org/plugins/health-check/
Description: Checks the health of your WordPress install
Version: 0.5.0
Author: Suppliers Plugin Team
Author URI: http://health-check-team.example.com
Text Domain: Group work
Domain Path: /languages
*/

// register_activation_hook(
//     __FILE__,
//     'create_table'
// );

// function create_table()
// {
//     global $wpdb;
//     $suppliers = $wpdb->prefix . "suppliers";
//     $query = "CREATE TABLE $suppliers(id int AUTO_INCREMENT PRIMARY KEY,company_name varchar(255),email varchar(50),phone varchar(15),address text,contact_person varchar(50),bank_info varchar(50))";
//     require_once ABSPATH . 'wp-admin/includes/upgrade.php';
//     dbDelta($query);
//     $add = "insert into $table(company_name,email,phone,address,contact_person,bank_info)values('Forhad & Brothers','forhad@email.com','01854240225','1/5 Tali office road','Megha','Sonali Bank')";
//     $wpdb->query($add);
// }

// register_deactivation_hook(
//     __FILE__,
//     'delete_table'
// );

// function delete_table()
// {
//     global $wpdb;
//     $table = $wpdb->prefix . "suppliers";
//     $query = "drop table $table";
//     $wpdb->query($query);
// }

// add_shortcode('test_code', 'testCode');
// function testCode($atts, $content = '', $tag)
// {
//     include dirname(__FILE__) . '/page.php';
// }

// function add_my_menu()
// {
    add_submenu_page(
        'Dashboard',
        'fo_My Custom Page',
        'Suppliers ',
        'manage_options',
        'fo_suppliers',
        function () {
            include dirname(__FILE__) . '/fo_page.php';
        }
    );

    // add_menu_page(
    //     'Supplier',
    //     'Supplier Menu',
    //     'manage_options',
    //     'supplier',
    //     function () {
    //         include dirname(__FILE__) . '/add_supplier.php';
    //     },
    //     '',
    //     45
    // );

    add_submenu_page(
        'fo_suppliers',
        'fo_add_suppliers',
        'fo_add_supplier',
        'manage_options',
        'fo_insert',
        function () {
            include dirname(__FILE__) . '/fo_insert.php';
        }
    );
    add_submenu_page(
        'fo_suppliers',
        'fo_update_suppliers',
        'fo_update_supplier',
        'manage_options',
        'fo_edit',
        function () {
            include dirname(__FILE__) . '/fo_update.php';
        }
    );
// }

// function contact_fn()
// {
//     echo  "Welcome";
// }
// add_action('admin_menu', 'add_my_menu');

