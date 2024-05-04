<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<div class="container">
<?php
    global $wpdb;
    $table = $wpdb->prefix . "material_wastage_dump";
    $table1 = $wpdb->prefix . "raw_materials";
    if (isset($_GET['type']) && $_GET['type'] == 'delete') {
        $wpdb->delete($table, ['id' => $_GET['id']]);
    ?>

        <script>
            window.location.assign('<?php echo esc_url(admin_url('admin.php?page=zahid_my-secondary-slug')); ?>')
        </script>
    <?php
    }
    $data = $wpdb->get_results("select $table. *, $table1.name  from $table join $table1 on $table.material_id=$table1.id ");
    // echo "<pre>";
    // print_r($data);
    ?>
    <a href="<?php echo esc_url(admin_url('admin.php?page=za_insert')); ?>" class=" btn btn-primary">Add Material Wastage Dump</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>SL</th>
                <th>Material Name</th>
                <th>Quantity</th>
                <th>Date</th>
                <th style="width:160px;">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($data as $k => $d) { ?>
            <tr>
                <td><?php echo $k + 1 ?></td>
                <td><?php echo $d->name ?></td>
                <td><?php echo $d->quantity ?></td>
                <td><?php echo $d->date ?></td>
                <td>
                    <a href="<?php echo esc_url(admin_url('admin.php?page=za_edit&id=' . $d->id)); ?>" class=" btn btn-success">Edit</a>
                    <a href="<?php echo esc_url(admin_url('admin.php?page=zahid_my-secondary-slug&type=delete&id=' . $d->id)); ?>" class=" btn btn-danger">Delete</a>
                </td>
               
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>