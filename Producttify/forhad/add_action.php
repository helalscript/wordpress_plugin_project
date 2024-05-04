<?php
add_action('admin_post_save_suppliers', 'post_suppliers');
function post_suppliers()
{
    global $wpdb;
    $name = $_POST['company_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $contact_person = $_POST['contact_person'];
    $bank_info = $_POST['bank_info'];
    $table = $wpdb->prefix . "suppliers";
    // $wpdb->insert($table, ['company_name' => $name, 'email' => $email, 'phone' => $phone, 'address'=>$address, 'contact_person' => $contact_person, 'bank_info' => $bank_info]);

     $add = "insert into $table(company_name,email,phone,address,contact_person,bank_info)values('$name','$email','$phone','$address','$contact_person','$bank_info')";
     $wpdb->query($add);
    wp_redirect(admin_url('admin.php?page=fo_suppliers'));
    // exit;
}

add_action('admin_post_update_supplier', 'fo_update_suppliers');
function fo_update_suppliers()
{
    global $wpdb;
    $name = $_POST['company_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $contact_person = $_POST['contact_person'];
    $bank_info = $_POST['bank_info'];
    
    $id = $_POST['id'];
    $table = $wpdb->prefix . "suppliers";
    $wpdb->update($table, ['company_name' => $name, 'email' => $email, 'phone' => $phone, 'address' => $address, 'contact_person' => $contact_person, 'bank_info' => $bank_info], ['id' => $id]);
    wp_redirect(admin_url('admin.php?page=fo_suppliers'));
    // exit;
}
?>