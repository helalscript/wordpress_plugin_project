<?php
/* 
Plugin Name: Purchase
plugin URI: new/red-helal.blogspot.com/ 
Description: Elevate.
Author:  🅷🅴🅻🅰🅻.
Author URI: red-helal.blogspot.com/ 
Text Domain: helal-purchase
Domain Path: helal/purchase
*/

// register_activation_hook(
//     __FILE__,
//     'create_table_purchase'
// );

// function create_table_purchase()
// {
//     global $wpdb;
//     $p_table = $wpdb->prefix . "purchase";
//     $p_query = "CREATE TABLE IF NOT EXISTS $p_table(id int AUTO_INCREMENT PRIMARY KEY,invoice_id int,price varchar(255),material_id int,supplier_id int,quantity varchar(255),date datetime)";
//     require_once ABSPATH . 'wp-admin/includes/upgrade.php';
//     dbDelta($p_query);
// }
// function when_my_plugin_deactivate() {
//     update_option('plugin_status', 'inactive');
// }
// register_deactivation_hook(
//     __FILE__,
//     'when_my_plugin_deactivate'
// );

// function delete_table_purchase()
// {
//     global $wpdb;
//     $p_table = $wpdb->prefix . "purchase";
//     $query = "drop table $p_table";
//     $wpdb->query($query);
// }

// register_uninstall_hook(
//     __FILE__,
//     'delete_table_purchase'
// );



// add_shortcode('test_code', 'testCode');
// function testCode($atts, $content = '', $tag)
// {
//     include dirname(__FILE__) . '/purchase_table.php';
// }

// function add_my_menu()
// {
//     add_menu_page(
//         'Garments', //$page_title,
//         'Garments Page', //$menu_title,
//         'manage_options', //$capability,
//         '#' //$menu_slug,
//         //$callback = '',
//         //$icon_url = '',
//         // $position = null
//     );
    add_submenu_page(
        'Dashboard', //parent_slug
        'Purchase Report', //page_title
        'Purchase Report',  //menu_title
        'manage_options', //capability
        'purchase_report', //menu_slug
        function () {
            include dirname(__FILE__) . '/helal_purchase_list.php';
        }
    ); //callback
    add_submenu_page(
        "purchase_report",
        'My Custom Page',
        'My Custom Page',
        'manage_options',
        'helal_purchase_add',
        function () {
            include dirname(__FILE__) . '/helal_purchase_add.php';
        }
    );
    add_submenu_page(
        "purchase_report",
        'My Custom Page',
        'My Custom Page',
        'manage_options',
        'purchase_edit',
        function () {
            include dirname(__FILE__) . '/purchase_edit.php';
        }
    );
    add_submenu_page(
        "purchase_report",
        'My Custom Page',
        'My Custom Page',
        'manage_options',
        'purchase_view',
        function () {
            include dirname(__FILE__) . '/purchase_view.php';
        }
    );
    add_submenu_page(
        "purchase_report",
        'API',
        'My Custom Page',
        'manage_options',
        'purchase_api',
        function () {
            include dirname(__FILE__) . '/api.php';
        }
    );
// }
// add_action('admin_menu', 'add_my_menu');




