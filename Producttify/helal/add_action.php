<?php

function helal_post_purchase()
{
    global $wpdb;

    $mat = $_POST['material'];
    $sup = $_POST['supplier'];
    $qnt = $_POST['quantity'];
    $pri = $_POST['price'];
    $inv = $_POST['inid'];
    $dte = $_POST['date'];


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
        wp_redirect(admin_url('admin.php?page=purchase_report'));
        exit;
    }
}
add_action('admin_post_helal_save_purchase', 'helal_post_purchase');



//.................................update function start.................
//.................................update function start.................
function helal_post_purchase_update()
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
    $mat = $_POST['material'];

    if (is_numeric($inv)) {
        if ($inv != " ") {
            $p_table = $wpdb->prefix . "purchase";
            $wpdb->delete($p_table, ['invoice_id' => $inv]);
        }}

    
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
        wp_redirect(admin_url('admin.php?page=purchase_report'));
        exit;
    }
}
add_action('admin_post_helal_update_purchase', 'helal_post_purchase_update');
//.................................update function End.................
//.................................update function End.................





















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
?>