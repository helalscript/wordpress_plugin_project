<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<h1>Purchase List</h1>
<a href="<?php echo esc_url(admin_url('admin.php?page=badsha_insert'));?>" class="btn btn-primary">Add New</a>
<?php 
global $wpdb;
$purchase_table=$wpdb->prefix ."purchase";
$tablem=$wpdb->prefix . "raw_materials";
$table1=$wpdb->prefix . "suppliers";
if (isset($_GET['type']) && $_GET['type'] == 'delete'){
    $wpdb->delete($purchase_table, ['id'=>$_GET['id']]);
?>
<script>
    window.location.assign('<?php echo esc_url(admin_url('admin.php?page=badsha_garment_purchase'));?>')
</script>
<?php
}
$data=$wpdb->get_results("SELECT $purchase_table.*,$tablem.name,$table1.company_name FROM `$purchase_table` JOIN $tablem ON $purchase_table.material_id=$tablem.id JOIN $table1 ON $purchase_table.supplier_id=$table1.id");
// echo "<pre>";
// print_r($data);
?>
<table class="table table-bordered border-primary" style="background-color: wheat;">
<tr>
    <th>SL</th>
    <th>Invoice Id</th>
    <th>Price</th>
    <th>Material Name</th>
    <th>Supplier Name</th>
    <th>Quantity</th>
    <th>Date</th>
    <th>Action</th>
</tr>
<?php foreach($data as $k=>$d){ ?>
<tr>
    <td><?php echo $k+1 ?></td>
    <td><?php echo $d->invoice_id ?></td>
    <td><?php echo $d->price ?></td>
    <td><?php echo $d->name ?></td>
    <td><?php echo $d->company_name ?></td>
    <td><?php echo $d->quantity ?></td>
    <td><?php echo $d->date ?></td>
    <td>
        <a href="<?php echo esc_url(admin_url('admin.php?page=badsha_edit&type=update&id='.$d->id)); ?>" class="btn btn-success" >Update</a>
        <a href="<?php echo esc_url(admin_url('admin.php?page=badsha_garment_purchase&type=delete&id='.$d->id)); ?>" class="btn btn-danger">Delete</a>
    </td>
</tr>
    <?php } ?>
</table><br><br>