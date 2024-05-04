<?php 
global $wpdb;
$table = $wpdb->prefix . "material_wastage";
$data=$wpdb->get_row("select * from $table where id=".$_GET['id']);
$table1 = $wpdb->prefix . "raw_materials";
$data1 = $wpdb->get_results("select * from $table1")
?>
<form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">

    <input type="hidden" name="id" value="<?php echo $data->id ?>">
    <input type="hidden" name="action" value="update_supplie">
    <!-- <input type="text" name="supplier_id" id=""><br><br> -->
    <select name="material_id" id="">
        <option value="">select raw material Name</option>
        <?php foreach($data1 as $v) {?>
        <option value="<?php echo $v->id ?>" <?php if($v->id==$data->material_id){echo "selected";} ?>><?php echo $v->name ?></option>
        <?php } ?>
    </select><br><br>
    <input type="text" name="quantity" value="<?php echo $data->quantity ?>"><br><br>
    <input type="date" name="date"><br><br>
    <input type="submit" value="submit">
</form>