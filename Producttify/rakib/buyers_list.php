<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
<h1 class="text-center text-primary">Secondary Buyers List</h1>
<?php

global $wpdb;
$table = $wpdb->prefix . "secondary_buyers";
if (isset($_GET['type']) && $_GET['type'] == 'delete') {
    $wpdb->delete($table, ['id' => $_GET['id']]);
?>
    <script>
        window.location.assign('<?php echo esc_url(admin_url('admin.php?page=rakib_buyers')); ?>')
    </script>
<?php
}
$data = $wpdb->get_results("select * from $table");
if (isset($_POST['sub'])) {
    $rkphone = $_POST['search'];
    $data = $wpdb->get_results("select * from $table where phone=$rkphone");
}

?>
<div class="container">

    <form action="#" method="post" class="form-inline float-sm-right">
        <a href="<?php echo esc_url('admin.php?page=buyers_form') ?>" class="btn btn-success btn-md">Add New Secondary Buyers</a><br><br>
        <div class="container-fluid">
            <div class="col-4">
                <div class="row">
                    <div class="col-8">
                    <input type="text" name="search" class="form-control" placeholder="Enter phone number">
                    </div>
                    
                    <div class="col-4" style="margin-left: -20px">
                    <button type="submit" name="sub" class="btn btn-info">Search</button>
                    </div>
                    
                </div>
            </div><br>


        </div>
    </form>
    <br>
    <table border="1" class="table table-bordered table-striped">
        <thead class="bg-info">
            <tr>
                <th>SL</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
        </thead>
        <?php foreach ($data as $k => $d) { ?>
            <tr>
                <td><?php echo ++$k ?></td>
                <td><?php echo $d->name ?></td>
                <td><?php echo $d->email ?></td>
                <td><?php echo $d->phone ?></td>
                <td><?php echo $d->address ?></td>
                <td><a href="<?php echo esc_url(admin_url('admin.php?page=rakib_edit&id=' . $d->id)) ?>" class="btn btn-success btn-sm">Update</a>
                    <a href="<?php echo esc_url(admin_url('admin.php?page=rakib_buyers&type=delete&id=' . $d->id)) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are You Confirm to Delete')">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>