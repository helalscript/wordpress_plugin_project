<?php
/*
Plugin Name: Materials_One IMAM
Plugin URI: https://garments.com/
Description: The perfect all-in-one responsive slider solution for WordPress.
Version: 1.0.0
Requires PHP: 7.0
Requires at least: 5.0
Author:Ruhul Amin
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
//     $table = $wpdb->prefix . "material_wastage";
//     $query = "CREATE TABLE $table(id int AUTO_INCREMENT PRIMARY KEY,material_id int not null,quantity varchar(255) not null,date date)";
//     require_once ABSPATH . 'wp-admin/includes/upgrade.php';
//     dbDelta($query);
// }

// register_deactivation_hook(
//     __FILE__,
//     'delete_table'
// );

// function delete_table()
// {
//     global $wpdb;
//     $table = $wpdb->prefix . "material_wastage";
//     $query = "drop table $table";
//     $wpdb->query($query);
// }

// function add_my_menu()
// {
//     add_menu_page(
//         'Materials',
//         'Materials Menu',
//         'manage_options',
//         'my-top-level-slug',
      
//     );
    add_submenu_page(
        'Dashboard',
        'My Custom Page',
        'Materials_wastage',
        'manage_options',
        'ru_my-secondary-slug',
        function () {
            include dirname(__FILE__) . '/Materials_wastage.php';
        }
    );
    add_submenu_page(
        'ru_my-secondary-slug',
        'My Custom Page',
        'Materials_wastage',
        'manage_options',
        'material_insert',
        function () {
            include dirname(__FILE__) . '/material_insert.php';
        }
    );
    add_submenu_page(
        'ru_my-secondary-slug',
        'My Custom Page',
        'Materials_wastage',
        'manage_options',
        'material_edit',
        function () {
            include dirname(__FILE__) . '/material_edit.php';
        }
    );
// }
// function contact_fn()
// {
//     echo  "Welcome";
// }
// add_action('admin_menu', 'add_my_menu');


