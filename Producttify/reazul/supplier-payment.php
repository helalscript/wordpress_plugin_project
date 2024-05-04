<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
<h1>Supplier Payment List</h1>
<?php

global $wpdb;
$table = $wpdb->prefix . "supplier_payment";
$table1 = $wpdb->prefix . "suppliers";
if (isset($_GET['type']) && $_GET['type'] == 'delete') {
    $wpdb->delete($table, ['id' => $_GET['id']]);
?>
    <script>
        window.location.assign('<?php echo esc_url(admin_url('admin.php?page=re_my-secondary-slug
')); ?>')
    </script>
<?php
}
//$table=$wpdb->prefix ."supplier_payment";
// $data=$wpdb->get_results("select * from $table");
// echo "<pre>";
// print_r($data);
// $join=$wpdb->get_results("SELECT wp_supplier_payment. *, wp_secondary_buyers.name as buyer, wp_raw_materials.name as materials from wp_material_wastage_sale join wp_secondary_buyers on wp_secondary_buyers.id=wp_material_wastage_sale.buyer_id join wp_raw_materials on wp_raw_materials.id=wp_material_wastage_sale.material_id;")

$data = $wpdb->get_results("SELECT $table.*,$table1.company_name FROM `$table` JOIN $table1 ON $table.supplier_id=$table1.id")

?>

<a class="btn btn-primary" href="<?php echo esc_url(admin_url('admin.php?page=re_insert')) ?>">Add Supplier Payment</a>

<table class="table table-bordered">
    <tr>
        <th>SL</th>
        <th>Company Name</th>
        <th>amount</th>
        <th>method</th>
        <th>date</th>
        <th>Action</th>
    </tr>
    <?php foreach ($data as $k => $d) { ?>
        <tr>
            <td><?php echo $k + 1 ?></td>
            <td><?php echo $d->company_name ?></td>
            <td><?php echo $d->amount ?></td>
            <td><?php echo $d->method ?></td>
            <td><?php echo $d->date ?></td>
            <td>
                <a href="<?php echo esc_url(admin_url('admin.php?page=re_edit&id=' . $d->id)) ?>" class="btn btn-success btn-md">Update</a>
                <a href="<?php echo esc_url(admin_url('admin.php?page=re_my-secondary-slug&type=delete&id=' . $d->id)) ?>" class="btn btn-danger btn-md" onclick="return confirm('Are You Confirm to Delete')">Delete</a>
            </td>
        </tr>

    <?php } ?>
</table>