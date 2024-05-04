<?php
/*
Plugin Name: Producttify
Plugin URI: new/red-helal.blogspot.com/ 
Description: Checks the health of your WordPress install
Version: 0.1.0
Author: 🅷🅴🅻🅰🅻.
Author URI: red-helal.blogspot.com/
Text Domain: Garments
Domain Path: /languages
*/

// when activate the Plugin-------------
register_activation_hook(
    __FILE__,
    'create_table'
);

function create_table(){
    global $wpdb;
    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    //require_once ABSPATH . 'wp-admin/includes/upgrade.php';
	//dbDelta( $query );
    //or--below any one use-------
    //$wpdb->query($query);

    //Rakib----------------------------------
    $startup_buyers = $wpdb->prefix . "secondary_buyers";
    $rakib_query = "CREATE TABLE IF NOT EXISTS $startup_buyers(id int AUTO_INCREMENT PRIMARY KEY,name varchar(100),email varchar(50),phone varchar(50),address text)";
    $wpdb->query($rakib_query);

    //Badsha--------------------------------
    $purchase_table=$wpdb->prefix ."purchase";
    $bquery="CREATE TABLE IF NOT EXISTS $purchase_table(id int AUTO_INCREMENT PRIMARY KEY,invoice_id int not null, price decimal(10,2) not null, material_id int not null, supplier_id int not null, quantity int not null, date date not null)";
	dbDelta( $bquery );

    //sazib --------------------------------
    $stock_return = $wpdb->prefix . "stock_return";
    $sazib_query = "CREATE TABLE IF NOT EXISTS $stock_return(id int AUTO_INCREMENT PRIMARY KEY,invoice_id int not null,quantity int not null,date date not null,material_id int not null,supplier_id int not null)";
    dbDelta($sazib_query);

    //zahid--------------------------------
    $material_wastage_dump=$wpdb->prefix ."material_wastage_dump";
    $zquery="CREATE TABLE IF NOT EXISTS $material_wastage_dump(id int AUTO_INCREMENT PRIMARY KEY,material_id int not null,quantity int not null,date date not null)";
    dbDelta( $zquery );

    //ruhul--------------------------------
    $material_wastage = $wpdb->prefix . "material_wastage";
    $ruquery = "CREATE TABLE IF NOT EXISTS $material_wastage(id int AUTO_INCREMENT PRIMARY KEY,material_id int not null,quantity varchar(255) not null,date date)";
    dbDelta($ruquery);

    // Minhaj --------------------------------
    $material_wastage_sale=$wpdb->prefix . 'material_wastage_sale';
    $wastage_sale="CREATE TABLE if Not EXISTS $material_wastage_sale(id int PRIMARY KEY AUTO_INCREMENT, invoice_id int(11),material_id varchar(50),buyer_id varchar(100),quantity varchar(10), date date)";
    dbDelta($wastage_sale);

    //reazul-------------------------------
    $supplier_payment = $wpdb->prefix . "supplier_payment";
    $rquery = "CREATE TABLE IF NOT EXISTS $supplier_payment(id int AUTO_INCREMENT PRIMARY KEY,supplier_id int not null,amount decimal(10,2) not null,method varchar(255) not null,date date)";
    dbDelta($rquery);

    // Forhad---------------------------
    $suppliers = $wpdb->prefix . "suppliers";
    $fquery = "CREATE TABLE IF NOT EXISTS $suppliers(id int AUTO_INCREMENT PRIMARY KEY,company_name varchar(255),email varchar(50),phone varchar(15),address text,contact_person varchar(50),bank_info varchar(50))";
    dbDelta($fquery);

    // Foysal--------------------------
    $raw_material = $wpdb->prefix . "raw_materials";
    $foquery = "CREATE TABLE IF NOT EXISTS $raw_material(id int AUTO_INCREMENT PRIMARY KEY,name varchar(255), price decimal(10,2))";
    dbDelta($foquery);
}



// When Deactivate the plugin-----------------
register_deactivation_hook(
    __FILE__,
    'Success'
);
function Success(){
    echo "Successfully Deactivated";
}

add_shortcode('test_code', 'testCode');
function testCode($atts, $content = '', $tag){
    include dirname(__FILE__) . '/page.php';
}
function add_my_menu()
{
    add_menu_page(
        'Stock Report',
        'Garments',
        'manage_options',
        'Dashboard',
        function () {
            include dirname(__FILE__) . '/nazad/dashboard.php';
        }
    );

    // material purchase by badsha--------------
    require_once ("badsha/garment.php");
    // raw-materials by foysal--------------
    require_once ("foysal/foy_raw-material.php");

    //Buyers by Rakib----------------
    require_once ("rakib/buyers.php");

    // suppliers by forhad--------------
    require_once ("forhad/suppliers.php");

    // Stock Return by Sazib------------------
    require_once ("sazib/garments.php");

    // Material Wastage by ruhul--------------
    require_once ("ruhul/material_wastage_one.php");

    // wastage Dump by Zahid--------------
    require_once ("zahid/garment.php");

    // wastage sell by Minhaj--------------
    require_once ("minhaj/wastage_sale.php");

    // supplier_payment by Reazul--------------
    require_once ("reazul/garments.php");

    // Material stock report by Nazad--------------
    require_once ("nazad/sub_menu.php");

    // Material wastage report by Fazle------------
    require_once ("fazle/mwr-fazle.php");

    // Purchase Report by by Fazle------------
    require_once ("helal/purchase.php");
    
}
add_action('admin_menu', 'add_my_menu');


//badsha add action-------------------
require_once("badsha/add_action.php");

//foysal add action-------------------
require_once("foysal/add_action.php");

//forhad add action-------------------
require_once("forhad/add_action.php");

//Sazib add action-------------------
require_once("sazib/add_action.php");

//Ruhul add action-------------------
require_once("ruhul/add_action.php");

//Rakib add action-------------------
require_once("rakib/add_action.php");

//zahid add action-------------------
require_once("zahid/add_action.php");

//minhaj add action-------------------
require_once("minhaj/add_action.php");

//reazul add action-------------------
require_once("reazul/add_action.php");

//reazul add action-------------------
require_once("helal/add_action.php");

?>