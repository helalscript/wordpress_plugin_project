<?php
/*
Plugin Name: Wastage Sale
Plugin URI: https://wordpress.org/plugins/health-check/
Description: Checks the health of your WordPress install
Version: 0.1.0
Author: Minu
Author URI: http://health-check-team.example.com
Text Domain: Awesome
Domain Path: /languages
*/
//for active the hook
// register_activation_hook(
//     __FILE__,
//     'create_table'
// );
// function create_table()
// {
//     global $wpdb;
//     $material_wastage_sale=$wpdb->prefix . 'material_wastage_sale';
//     $wastage_sale="CREATE TABLE if Not EXISTS $material_wastage_sale(id int PRIMARY KEY AUTO_INCREMENT, invoice_id int(11),material_id varchar(50),buyer_id varchar(100),quantity varchar(10), date date)";
//     require_once ABSPATH . 'wp-admin/includes/upgrade.php';
//     dbDelta($wastage_sale);
// }
// //for deactive the hook
// register_deactivation_hook(
//     __FILE__,
//     'delete_table'
// );
// function delete_table()
// {
//     global $wpdb;
//     $table=$wpdb->prefix . 'material_wastage_sale';
//     $query="drop table $table";
//     $wpdb->query($query);
// }
//for create dashboard menu
// function add_my_menu()
// {
    add_submenu_page(
        'Dashboard',
        'Wastage Sell',
        'Wastage Sell',
        'manage_options',
        'minhaj_wastage_sale',
        function ()
        {
            include dirname(__FILE__) . '/material_wastage_sale.php';
        }
    );

    // add_submenu_page(
    //     'raw_materials',
    //     'Materials_Wastage_2',
    //     'Materials_Wastage',
    //     'manage_options',
    //     'wastage_sale',
    //     function () {
    //         include dirname(__FILE__) . '/material_wastage_sale.php';
    //     }
    // );


    add_submenu_page(
        'minhaj_wastage_sale',
        'Wastage_Sell_edit',
        'Wastage_Sell_edit',
        'manage_options',
        'mi_edit',
        function () {
            include dirname(__FILE__) . '/material_wastage_sale_edit.php';
        }
    );
    add_submenu_page(
        'minhaj_wastage_sale',
        'Wastage_Sell_add',
        'Wastage_Sell_add',
        'manage_options',
        'mi_insert',
        function () {
            include dirname(__FILE__) . '/material_wastage_sale_insert.php';
        }
    );
    // add_submenu_page(
    //     null,
    //     'raw_materials',
    //     'My Custom Page3',
    //     'manage_options',
    //     'delete',
    //     function () {
    //         include dirname(__FILE__) . '/material_wastage_sale.php';
    //     }
    // );

// }
// add_action('admin_menu', 'add_my_menu');
//for insert data from Form


?>