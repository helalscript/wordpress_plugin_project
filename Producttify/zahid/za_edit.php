<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
<?php
global $wpdb;
$table = $wpdb->prefix . "material_wastage_dump";
$data = $wpdb->get_row("select * from $table where id=" . $_GET['id']);
$table1=$wpdb->prefix ."raw_materials";
$edit = $wpdb->get_results("select * from $table1");
?>
 

<form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
    <input type="hidden" name="id" value="<?php echo $data->id  ?>">
    <input type="hidden" name="action" value="update_wastage">

    <select name="material_id" id="">
        <option value="">select material name</option>
<?php foreach($edit as $k=>$d) {?>
    <option value="<?php echo $d->id ?>"<?php if($d->id==$data->material_id) { echo "selected";}?>><?php echo $d->name ?></option>
    <?php } ?>
    </select><br><br>
    <input type="text" name="quantity" value="<?php echo $data->quantity ?>"><br><br>
    <input type="date" name="date"><br><br>
    <input class="btn btn-primary" type="submit" value="Update">
</form>