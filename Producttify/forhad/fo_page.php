<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
<h1>Suppliers List</h1>
<?php
global $wpdb;
$table = $wpdb->prefix . "suppliers";
if (isset($_GET['type']) && $_GET['type'] == 'delete') {
    $wpdb->delete($table, ['id' => $_GET['id']]);
?>
    <script>
        window.location.assign('<?php echo esc_url(admin_url('admin.php?page=fo_suppliers')); ?>')
    </script>
<?php
}
$data = $wpdb->get_results("select * from $table");

?>


<a class="btn btn-primary" href="<?php echo esc_url(admin_url('admin.php?page=fo_insert')); ?>">Add new Suppliers</a>
<table border="1" class="table table-bordered">
<tr>
    <th>SL</th>
    <th>Company Name</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Address</th>
    <th>Contact Person</th>
    <th>Bank Info</th>
    <th>Action</th>
</tr>
<?php foreach($data as $k=>$d){ ?>
<tr>
    <td><?php echo $k+1 ?></td>
    <td><?php echo $d->company_name ?></td>
    <td><?php echo $d->email ?></td>
    <td><?php echo $d->phone ?></td>
    <td><?php echo $d->address ?></td>
    <td><?php echo $d->contact_person ?></td>
    <td><?php echo $d->bank_info ?></td>
    <td>
        <a class="btn  btn-success" href="<?php echo esc_url(admin_url('admin.php?page=fo_edit&type=update&id=' . $d->id)); ?>">Edit</a>
        <a class="btn btn-danger" href="<?php echo esc_url(admin_url('admin.php?page=fo_suppliers&type=delete&id=' . $d->id)); ?>">Delete</a>
        
    </td>
</tr>
<?php } ?>
</table>