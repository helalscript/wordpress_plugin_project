<?php
add_action('admin_post_save_purchase','post_purchase');

function post_purchase(){
    global $wpdb;
    $invoice_id=$_POST['invoice_id'];
    $price=$_POST['price'];
    $material_id=$_POST['material_id'];
    $supplier_id=$_POST['supplier_id'];
    $quantity=$_POST['quantity'];
    $date=$_POST['date'];
    $purchase_table=$wpdb->prefix ."purchase";

    $add="insert into $purchase_table(`invoice_id`, `price`, `material_id`, `supplier_id`, `quantity`, `date`)values('$invoice_id','$price','$material_id','$supplier_id','$quantity','$date')";
    // echo $add;exit;
    $wpdb->query($add);
    wp_redirect(admin_url('admin.php?page=badsha_garment_purchase')); exit;
    
}
add_action('admin_post_update_purchase','update_purchase');

function update_purchase(){
    global $wpdb;
    $invoice_id=$_POST['invoice_id'];
    $price=$_POST['price'];
    $material_id=$_POST['material_id'];
    $supplier_id=$_POST['supplier_id'];
    $quantity=$_POST['quantity'];
    $date=$_POST['date'];
    $id=$_POST['id'];
    $purchase_table=$wpdb->prefix ."purchase";

    $wpdb->update($purchase_table,['invoice_id'=> $invoice_id,'price'=>$price,'material_id'=> $material_id,'supplier_id'=>$supplier_id,'quantity'=> $quantity,'date'=> $date],['id'=> $id],);
    // echo $add;exit;
    wp_redirect(admin_url('admin.php?page=badsha_garment_purchase')); exit;
    
}
?>