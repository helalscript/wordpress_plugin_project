<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
<h1>Update Material</h1>
<?php
global $wpdb;
$raw_materials=$wpdb->prefix."raw_materials";
$data=$wpdb->get_row("select * from $raw_materials where id=".$_GET['id']);
?>
 <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
    <input type="hidden" name="id" value="<?php echo $data->id ;?>">
    <input type="hidden" name="action" value="update_material">
    <input type="text" name="name" placeholder="Name" value="<?php echo $data->name ;?>"><br><br>
    <input type="text" name="price" placeholder="Price" value="<?php echo $data->price ;?>"><br><br>
    <input class="btn btn-primary" type="submit" value="Update">
</form>