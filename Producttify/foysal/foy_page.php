<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
<h1>Raw Material</h1>

<?php
global $wpdb;
$raw_material=$wpdb->prefix."raw_materials";
if(isset($_GET['type']) && $_GET['type'] == 'delete'){
    $wpdb->delete($raw_material,['id'=>$_GET['id']]);
    ?>
    <script>
        window.location.assign('<?php echo esc_url(admin_url('admin.php?page=foy_my-top-level-slug'));?>')
    </script>
<?php
}
$data=$wpdb->get_results("select * from $raw_material");

?>
<a class="btn btn-primary" href="<?php echo esc_url(admin_url('admin.php?page=foy_garements')); ?>">Add new Material</a>
<table border="1" class="table table-bordered">
    <tr>
        <th>SL</th>
        <th>Name</th>
        <th>Price</th>
        <th>Action</th>
    </tr>
    <?php foreach ($data as $k => $d) { ?>
        <tr>
            <td><?php echo $k + 1 ?></td>
            <td><?php echo $d->name ?></td>
            <td><?php echo $d->price ?></td>
            <td>
                <a class="btn btn-success" href="<?php echo esc_url(admin_url('admin.php?page=foy_edit&id='.$d->id)); ?>">update</a>
                <a class="btn btn-danger" href="<?php echo esc_url(admin_url('admin.php?page=foy_my-top-level-slug&type=delete&id='.$d->id)); ?>">Delete</a>
                
            </td>
        </tr>
    <?php } ?>
</table>