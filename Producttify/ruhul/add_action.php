<?php
add_action('admin_post_save_supplie', 'insert_supplie');
function insert_supplie()
{
    global $wpdb;
    $table=$wpdb->prefix . "material_wastage";
    $material_id=$_POST['material_id'];
    $quantity=$_POST['quantity'];
    $date=$_POST['date'];
    $wpdb->insert($table,['material_id'=> $material_id,'quantity'=>$quantity,'date'=>$date]);
    wp_redirect(admin_url('admin.php?page=ru_my-secondary-slug'));
}
//for update data from Form
add_action('admin_post_update_supplie', 'update_supplie');
function update_supplie()
{
    global $wpdb;
    $table=$wpdb->prefix . "material_wastage";
    $id=$_POST['id'];
    $material_id=$_POST['material_id'];
    $quantity=$_POST['quantity'];
    $date=$_POST['date'];
    $wpdb->update($table,['material_id'=> $material_id,'quantity'=>$quantity,'date'=>$date],['id'=>$id]);
    
    wp_redirect(admin_url('admin.php?page=ru_my-secondary-slug'));
}
?>