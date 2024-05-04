<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
<h1>Wastage Material</h1>
<?php

global $wpdb;
$material_wastage = $wpdb->prefix . "material_wastage";
$raw_materials = $wpdb->prefix . "raw_materials";
if (isset($_GET['type']) && $_GET['type'] == 'delete') {
    $wpdb->delete($material_wastage, ['id' => $_GET['id']]);
?>
    <script>
        window.location.assign('<?php echo esc_url(admin_url('admin.php?page=ru_my-secondary-slug
')); ?>')
    </script>
<?php
}
$data = $wpdb->get_results("SELECT $material_wastage.*,$raw_materials.name FROM `$material_wastage` JOIN $raw_materials ON $material_wastage.material_id=$raw_materials.id")

?>



<div class="container">
    <div class="row">
        <div class="col-12">
        <a href="<?php echo esc_url(admin_url('admin.php?page=material_insert')) ?>" class="btn btn-primary">Add Wastage Materials</a> <br><br>
        <table class="table table-bordered">
    <tr>
        <th>SL</th>
        <th>Raw Material Name</th>
        <th>Quantity</th>
        <th>date</th>
        <th>Action</th>
    </tr>
    <?php foreach ($data as $k => $d) { ?>
        <tr>
            <td><?php echo $k + 1 ?></td>
            <td><?php echo $d->name ?></td>
            <td><?php echo $d->quantity ?></td>
            <td><?php echo $d->date ?></td>
            <td>
                <a href="<?php echo esc_url(admin_url('admin.php?page=material_edit&id=' . $d->id)) ?>" class="btn btn-success btn-md">Update</a>
                <a href="<?php echo esc_url(admin_url('admin.php?page=ru_my-secondary-slug&type=delete&id=' . $d->id)) ?>" class="btn btn-danger btn-md" onclick="return confirm('Are You Confirm to Delete')">Delete</a>
            </td>
        </tr>

    <?php } ?>
</table>
        </div>
    </div>
</div>