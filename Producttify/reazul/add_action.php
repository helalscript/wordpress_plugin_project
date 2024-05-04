<?php
add_action('admin_post_save_supplier', 'post_supplier');
function post_supplier()
{
    global $wpdb;
    $supplier_payment=$wpdb->prefix . "supplier_payment";
    // $buyer=$wpdb->query("SELECT * FROM wp_secondary_buyers");
    // $material=$wpdb->query("SELECT * FROM wp_raw_materials");


    $supplier_id=$_POST['supplier_id'];
    $amount=$_POST['amount'];
    $method=$_POST['method'];
    $date=$_POST['date'];
    $wpdb->insert( $supplier_payment,['supplier_id'=> $supplier_id,'amount'=>$amount,'method'=>$method,'date'=>$date]);
    wp_redirect(admin_url('admin.php?page=re_my-secondary-slug'));
}
//for update data from Form
add_action('admin_post_update_suppliers', 'suppliers_payment');
function suppliers_payment()
{
    global $wpdb;
    $supplier_payment=$wpdb->prefix . "supplier_payment";
    $id=$_POST['id'];
    $supplier_id=$_POST['supplier_id'];
    $amount=$_POST['amount'];
    $method=$_POST['method'];
    $date=$_POST['date'];
    $wpdb->update($supplier_payment,['supplier_id'=> $supplier_id,'amount'=>$amount,'method'=>$method,'date'=>$date],['id'=>$id]);
    
    wp_redirect(admin_url('admin.php?page=re_my-secondary-slug'));
    exit();
}
?>