<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
<?php 
global $wpdb;
$table = $wpdb->prefix . "raw_materials";
$data = $wpdb->get_results("select * from $table")
?>
<div class="container">
    <div class="row">
        <div class="col-6">
            <h3 class="ca">Add Wastage Raw Material</h3>
        <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">

<input type="hidden" name="action" value="save_supplie" class="form-control">
<!-- <input type="text" name="supplier_id" id=""><br><br> -->
<select name="material_id" id="" >
    <option value="">select raw_material name</option>
    <?php foreach($data as $v) {?>
    <option value="<?php echo $v->id ?>"><?php echo $v->name ?></option>
    <?php } ?>
</select><br><br>
<input type="text" name="quantity" placeholder="quantity" class="form-control"><br><br>
<input type="date" name="date" class="form-control"><br><br>
<input type="submit" value="submit" class="btn btn-info">
</form>
        </div>
    </div>
</div>