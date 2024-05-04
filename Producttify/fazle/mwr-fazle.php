<?php
/*
Plugin Name: Material Wastage Report by Fazle Rabby
Plugin URI: https://www.facebook.com/thefazlerabby
Description: Checks the health of your WordPress install
Version: 0.0.1
Author: Muhammad Fazle Rabby
Author URI: http://www.github.com/coderfazle
Text Domain: materialwastagereport
Domain Path: /mwreport
*/

// function add_my_menu()
// {
//     add_menu_page(
//         'Garments',
//         'Garments',
//         'manage_options',
//         'garments_fazle',
//         function () {
            
//         }
//     );

    add_submenu_page(
        // 'garments_fazle',
        'Dashboard',
        'Material Wastage Report',
        'Wastage Report',
        'manage_options',
        'garments_fazle_submenu',
        function () {
            include dirname(__FILE__) . '/mwr-page.php';
        }
    );

// }

// add_action('admin_menu', 'add_my_menu');

