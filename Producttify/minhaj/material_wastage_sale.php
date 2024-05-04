<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
<h1>Material Wastage Sale List</h1>
<?php 

global $wpdb;
$table = $wpdb->prefix . "material_wastage_sale";
if (isset($_GET['type']) && $_GET['type'] == 'delete') {
    $wpdb->delete($table, ['id' => $_GET['id']]);
?>
    <script>
        window.location.assign('<?php echo esc_url(admin_url('admin.php?page=minhaj_wastage_sale')); ?>')
    </script>
<?php
}
global $wpdb;
$material_wastage_sale=$wpdb->prefix ."material_wastage_sale";
$secondary_buyers=$wpdb->prefix ."secondary_buyers";
$raw_materials=$wpdb->prefix ."raw_materials";
// $data=$wpdb->get_results("select * from $table");
// echo "<pre>";
// print_r($data);
$join=$wpdb->get_results("SELECT $material_wastage_sale. *, $secondary_buyers.name as buyer, $raw_materials.name as materials from $material_wastage_sale join $secondary_buyers on $secondary_buyers.id=$material_wastage_sale.buyer_id join $raw_materials on $raw_materials.id=$material_wastage_sale.material_id;")
?>
<a href="<?php echo esc_url('admin.php?page=mi_insert') ?>" class="btn btn-primary btn-md">Add New Wastage material</a> <br> <br>
<table border="1" class="table table-bordered">
<tr>
    <th>SL</th>
    <th>Invoice No.</th>
    <th>Material's Name</th>
    <th>Buyer's Name</th>
    <th>Quantity</th>
    <th>Date</th>
    <th>Action</th>
</tr>
<?php foreach($join as $k=>$d){ ?>
<tr>
    <td><?php echo ++$k ?></td>
    <td><?php echo $d->invoice_id ?></td>
    <td><?php echo $d->materials ?></td>
    <td><?php echo $d->buyer ?></td>
    <td><?php echo $d->quantity ?></td>
    <td><?php echo $d->date ?></td>
    <td><a href="<?php echo esc_url(admin_url('admin.php?page=mi_edit&id='. $d->id))?>" class="btn btn-success btn-md">Edit<br>
    <a href="<?php echo esc_url(admin_url('admin.php?page=minhaj_wastage_sale&type=delete&id='. $d->id))?>" class="btn btn-danger btn-md" onclick="return confirm('Are You Confirm to Delete')">Delete</a></td>
</tr>
    <?php } ?>
</table>