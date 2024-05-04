<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
<h1>Stock Return List</h1>
<?php

global $wpdb;
$table = $wpdb->prefix . "stock_return";
$table1 = $wpdb->prefix . "raw_materials";
$table2 = $wpdb->prefix . "suppliers";
if (isset($_GET['type']) && $_GET['type'] == 'delete') {
    $wpdb->delete($table, ['id' => $_GET['id']]);
?>
    <script> 
        window.location.assign('<?php echo esc_url(admin_url('admin.php?page=sazib_my-secondary-slug
')); ?>')
    </script>
<?php
}

$data = $wpdb->get_results("SELECT $table.*,$table1.name,$table2.company_name FROM `$table` JOIN $table1 ON $table.material_id=$table1.id JOIN $table2 ON $table.supplier_id=$table2.id");

// print_r($data);

?>

<a class="btn btn-primary" href="<?php echo esc_url(admin_url('admin.php?page=sazib_insert')) ?>">Add Stock Return</a>

<table class="table table-bordered" border="1">
    <tr>
        <th>SL</th>
        <th>Invoice ID</th>
        <th>Quantity</th>
        <th>date</th>
        <th>Material Name</th>
        <th>Company Name</th>
        <th>action</th>
    </tr>
    <?php foreach ($data as $k => $d) { ?>
        <tr>
            <td><?php echo $k + 1 ?></td>
            <td><?php echo $d->invoice_id ?></td>
            <td><?php echo $d->quantity ?></td>
            <td><?php echo $d->date ?></td>
            <td><?php echo $d->name ?></td>
            <td><?php echo $d->company_name ?></td>
            <td>
                <a href="<?php echo esc_url(admin_url('admin.php?page=sazib_edit&id=' . $d->id)) ?>" class="btn btn-success btn-md">Update</a>
                <a href="<?php echo esc_url(admin_url('admin.php?page=sazib_my-secondary-slug&type=delete&id=' . $d->id)) ?>" class="btn btn-danger btn-md" onclick="return confirm('Are You Confirm to Delete')">Delete</a>
            </td>
        </tr>

    <?php } ?>
</table>