<?php
add_action('admin_post_save_wastage_material', 'insert_wastage_material');
function insert_wastage_material()
{
    global $wpdb;
    $table=$wpdb->prefix . "material_wastage_sale";
    // $buyer=$wpdb->query("SELECT * FROM wp_secondary_buyers");
    // $material=$wpdb->query("SELECT * FROM wp_raw_materials");


    $invoice=$_POST['invoice'];
    $material=$_POST['material'];
    $buyer=$_POST['buyer'];
    $quantity=$_POST['quantity'];
    $date=$_POST['date'];
    $wpdb->insert($table,['invoice_id'=> $invoice,'material_id'=>$material,'buyer_id'=>$buyer,'quantity'=>$quantity,'date'=>$date]);
    wp_redirect(admin_url('admin.php?page=minhaj_wastage_sale'));
}
//for update data from Form
add_action('admin_post_update_wastage_material', 'edit_wastage_material');
function edit_wastage_material()
{
    global $wpdb;
    $table=$wpdb->prefix . "material_wastage_sale";
    $id=$_POST['id'];
    $invoice=$_POST['invoice'];
    $material=$_POST['material'];
    $buyer=$_POST['buyer'];
    $quantity=$_POST['quantity'];
    $date=$_POST['date'];
    $wpdb->update($table,['invoice_id'=> $invoice,'material_id'=>$material,'buyer_id'=>$buyer,'quantity'=>$quantity,'date'=>$date],['id'=>$id]);
    wp_redirect(admin_url('admin.php?page=minhaj_wastage_sale'));
}
?>