<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
<h1>Update Suppliers</h1>
<?php
global $wpdb;
$table = $wpdb->prefix . "suppliers";
$data = $wpdb->get_row("select * from $table where id=" . $_GET['id']);
?>
<form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
 <div class="col-md-6">
 <input type="hidden" name="id" value="<?php echo $data->id ?>">
    <input type="hidden" name="action" value="update_supplier">
    <input type="text" name="company_name" placeholder="Company Name" value="<?php echo $data->company_name ?>">
    <input type="text" name="email" placeholder="Email" value="<?php echo $data->email ?>">
    <input type="text" name="phone" placeholder="Phone" value="<?php echo $data->phone ?>">
 </div>
 <div class="col-md-6">
 <input type="text" name="address" placeholder="Address" value="<?php echo $data->address ?>">
    <input type="text" name="contact_person" placeholder="Contact Person" value="<?php echo $data->contact_person ?>">
    <input type="text" name="bank_info" placeholder="Bank Info" value="<?php echo $data->bank_info ?>">
    <input class="btn btn-primary" type="submit" value="Update">
 </div>
    
    
</form>