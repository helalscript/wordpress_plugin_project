<?php
//Menu form 1

add_action('admin_post_save_buyers', 'r_post_buyers');
function r_post_buyers()
{
    global $wpdb;
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $secondary_buyers = $wpdb->prefix . "secondary_buyers";
    $wpdb->insert($secondary_buyers,['name'=>$name,'email'=>$email,'phone'=>$phone,'address'=>$address]);
    wp_redirect(admin_url('admin.php?page=rakib_buyers'));
    exit;
}

add_action('admin_post_update_buyers', 'r_update_buyers');
function r_update_buyers()
{
    global $wpdb;
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $secondary_buyers = $wpdb->prefix . "secondary_buyers";
    $wpdb->update($secondary_buyers,['name'=> $name,'email'=>$email,'phone'=>$phone,'address'=>$address],['id'=>$id]);
    wp_redirect(admin_url('admin.php?page=rakib_buyers'));
    exit;
}
?>