<?php
add_action('admin_post_save_material','post_material');
function post_material(){
    global $wpdb;
    $name=$_POST['name'];
    $price=$_POST['price'];
    $raw_material = $wpdb->prefix . "raw_materials";
    // $wpdb->insert($table,['name'=> $name,'price'=>$price]);

    $add="insert into $raw_material(name,price)values('$name',' $price')";
    $wpdb->query($add);
    wp_redirect(admin_url('admin.php?page=foy_my-top-level-slug'));
    exit;
}
add_action ('admin_post_update_material','update_material');
 function update_material()
 {
    global $wpdb;
    $name=$_POST['name'];
    $price=$_POST['price'];
    $id=$_POST['id'];
    $raw_material=$wpdb->prefix ."raw_materials";
    $wpdb->update($raw_material, ['name'=>$name,'price'=>$price], ['id'=> $id]);
        wp_redirect(admin_url('admin.php?page=foy_my-top-level-slug'));
    exit;
 }
 ?>