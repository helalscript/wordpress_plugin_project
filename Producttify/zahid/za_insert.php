<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<?php 
global $wpdb;
$table=$wpdb->prefix ."raw_materials";
$data = $wpdb->get_results("select * from $table");
?>
<form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
    <input type="hidden" name="action" value="save_wastage">
    <select name="material_id" id="">
        <option value="">select material name</option>
<?php foreach($data as $k=>$v) {?>
    <option value="<?php echo $v->id ?>"><?php echo $v->name ?></option>
    <?php } ?>
    </select><br><br>
    <input type="text" name="quantity" placeholder="quantity"><br><br>
    <input type="date" name="date" placeholder="date"><br><br>
    <input type="submit" value="Save" class="btn btn-success">
</form>