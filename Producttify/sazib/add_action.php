<?php 
add_action('admin_post_save_stock', 'insert_stock');
function insert_stock()
{
    global $wpdb;
    $stock_return=$wpdb->prefix . "stock_return";

    $invoice_id=$_POST['invoice_id'];
    $quantity=$_POST['quantity'];
    $date=$_POST['date'];
    $material_id=$_POST['material_id'];
    $supplier_id=$_POST['supplier_id'];
    $wpdb->insert($stock_return,['invoice_id'=>$invoice_id, 'quantity'=>$quantity, 'date'=>$date,'material_id'=>$material_id,'supplier_id'=> $supplier_id]);
    wp_redirect(admin_url('admin.php?page=sazib_my-secondary-slug'));
}
//update from form data
add_action('admin_post_update_stock', 'update_stock');
function update_stock()
{
    global $wpdb;
    $stock_return=$wpdb->prefix . "stock_return";
    $id=$_POST['id'];
    $invoice_id=$_POST['invoice_id'];
    $quantity=$_POST['quantity'];
    $date=$_POST['date'];
    $material_id=$_POST['material_id'];
    $supplier_id=$_POST['supplier_id'];
    $wpdb->update($stock_return,['invoice_id'=>$invoice_id, 'quantity'=>$quantity, 'date'=>$date,'material_id'=>$material_id,'supplier_id'=> $supplier_id],['id'=>$id]);
    
    wp_redirect(admin_url('admin.php?page=sazib_my-secondary-slug'));
}
?>