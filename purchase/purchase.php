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

register_activation_hook(
    __FILE__,
    'create_table_purchase'
);

function create_table_purchase()
{
    global $wpdb;
    $p_table = $wpdb->prefix . "purchase";
    $p_query = "CREATE TABLE IF NOT EXISTS $p_table(id int AUTO_INCREMENT PRIMARY KEY,invoice_id int,price varchar(255),material_id int,supplier_id int,quantity varchar(255),date datetime)";
    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($p_query);
}
function when_my_plugin_deactivate() {
    update_option('plugin_status', 'inactive');
}
register_deactivation_hook(
    __FILE__,
    'when_my_plugin_deactivate'
);

function delete_table_purchase()
{
    global $wpdb;
    $p_table = $wpdb->prefix . "purchase";
    $query = "drop table $p_table";
    $wpdb->query($query);
}

register_uninstall_hook(
    __FILE__,
    'delete_table_purchase'
);



add_shortcode('test_code', 'testCode');
function testCode($atts, $content = '', $tag)
{
    include dirname(__FILE__) . '/purchase_table.php';
}

function add_my_menu()
{
    add_menu_page(
        'Garments', //$page_title,
        'Garments Page', //$menu_title,
        'manage_options', //$capability,
        '#' //$menu_slug,
        //$callback = '',
        //$icon_url = '',
        // $position = null
    );
    add_submenu_page(
        '#', //parent_slug
        'Purchese', //page_title
        'Purchese Page',  //menu_title
        'manage_options', //capability
        'purchase_list', //menu_slug
        function () {
            include dirname(__FILE__) . '/purchase_list.php';
        }
    ); //callback
    add_submenu_page(
        null,
        'My Custom Page',
        'My Custom Page',
        'manage_options',
        'purchase_add',
        function () {
            include dirname(__FILE__) . '/purchase_add.php';
        }
    );
    add_submenu_page(
        null,
        'My Custom Page',
        'My Custom Page',
        'manage_options',
        'purchase_edit',
        function () {
            include dirname(__FILE__) . '/purchase_edit.php';
        }
    );
    add_submenu_page(
        null,
        'My Custom Page',
        'My Custom Page',
        'manage_options',
        'purchase_view',
        function () {
            include dirname(__FILE__) . '/purchase_view.php';
        }
    );
    add_submenu_page(
        null,
        'API',
        'My Custom Page',
        'manage_options',
        'purchase_api',
        function () {
            include dirname(__FILE__) . '/api.php';
        }
    );
}
add_action('admin_menu', 'add_my_menu');





function post_purchase()
{
    global $wpdb;

    $mat = $_POST['material'];
    $sup = $_POST['supplier'];
    $qnt = $_POST['quantity'];
    $pri = $_POST['price'];
    $inv = $_POST['inid'];
    $dte = $_POST['date'];
    $length = strlen($inv);
    $zlen = count($sup);
    $nx = 0;

    if (is_numeric($inv)) {
        foreach ($pri as $k => $d) {

            $m = $mat[$k];
            $s = $sup[$k];
            $q = $qnt[$k];

            $allnumber = is_numeric($m) && is_numeric($s) && is_numeric($q) && is_numeric($d) && $m != "xxx" && $s != "xxx";
            if ($allnumber) {
                $p_table = $wpdb->prefix . "purchase";
                $wpdb->insert($p_table, ['invoice_id' => $inv, 'price' => $d, 'material_id' => $m, 'supplier_id' => $s, 'quantity' => $q, 'date' => "$dte"]);
            }

        }
        wp_redirect(admin_url('admin.php?page=purchase_list'));
        exit;
    }
}

add_action('admin_post_save_purchase', 'post_purchase');

function post_purchase_update()
{
    global $wpdb;

    $mat = $_POST['material'];
    $sup = $_POST['supplier'];
    $qnt = $_POST['quantity'];
    $pri = $_POST['price'];
    $inv = $_POST['inid'];
    $dte = $_POST['date'];
    $length = strlen($inv);
    $zlen = count($sup);
    $nx = 0;

    if (is_numeric($inv)) {
        foreach ($pri as $k => $d) {

            $m = $mat[$k];
            $s = $sup[$k];
            $q = $qnt[$k];

            $allnumber = is_numeric($m) && is_numeric($s) && is_numeric($q) && is_numeric($d) && $m != "xxx" && $s != "xxx";
            if ($allnumber) {
                $p_table = $wpdb->prefix . "purchase";
                $wpdb->insert($p_table, ['invoice_id' => $inv, 'price' => $d, 'material_id' => $m, 'supplier_id' => $s, 'quantity' => $q, 'date' => "$dte"]);
            }

        }
        wp_redirect(admin_url('admin.php?page=purchase_list'));
        exit;
    }
}

add_action('admin_post_update_purchase', 'post_purchase_update');




add_action('rest_api_init', function () {
    register_rest_route('purchase_api', '/purchase/(?P<id>\d+)', array(
        'methods' => 'GET',
        'callback' => 'my_awesome_func',
        'args' => array(
            'id' => array(
                'validate_callback' => function ($param, $request, $key) {
                    return is_numeric($param);
                }
            ),
        ),
    ));
});
function my_awesome_func(WP_REST_Request $request)
{
    // The individual sets of parameters are also available, if needed:
    $parameters = $request->get_url_params();
    $id=$parameters['id'];
    global $wpdb;
    $r_table = $wpdb->prefix . "raw_materials";
    $data = $wpdb->get_row("select * from $r_table where id=$id");
    header('Content-Type: Application/json');
    echo json_encode($data);
}