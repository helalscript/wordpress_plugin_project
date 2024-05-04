<?php
add_action('admin_post_save_wastage','post_wastage');
function post_wastage(){
    global $wpdb;
    $material_id=$_POST['material_id'];
    $quantity=$_POST['quantity'];
    $date=$_POST['date'];
    $material_wastage_dump=$wpdb->prefix ."material_wastage_dump";
    $add="insert into $material_wastage_dump(`material_id`, `quantity`, `date`)values('$material_id','$quantity','$date')";
    // echo $add;exit;
    $wpdb->query($add);
    wp_redirect( admin_url('admin.php?page=zahid_my-secondary-slug') );
}

add_action('admin_post_update_wastage', 'update_wastage');
function update_wastage()
{
    global $wpdb;
    $material_id=$_POST['material_id'];
    $quantity=$_POST['quantity'];
    $date=$_POST['date'];
    $material_wastage_dump=$wpdb->prefix ."material_wastage_dump";
    $id = $_POST['id'];
    $wpdb->update($material_wastage_dump,['material_id'=>$material_id,'quantity'=>$quantity,'date'=>$date],['id'=>$id]);
    wp_redirect(admin_url('admin.php?page=zahid_my-secondary-slug'));
    
}
?>