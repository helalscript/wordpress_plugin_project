<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
<?php 
global $wpdb;
$suppliers = $wpdb->prefix . "suppliers";
$data = $wpdb->get_results("select * from $suppliers");
$raw_materials = $wpdb->prefix . "raw_materials";
$dataf = $wpdb->get_results("select * from $raw_materials");
?> 
<form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">

    <input type="hidden" name="action" value="save_stock">
    <input type="text" name="invoice_id" placeholder="invoice_id"><br><br>
    <input type="text" name="quantity" placeholder="quantity"><br><br>
    <input type="date" name="date"><br><br>
    <!-- <input type="text" name="material_id" placeholder="material_id"> -->
    <select name="material_id">
        <option value="">Select Material Name</option>
        <?php foreach($dataf as $d){ ?>
            <option value="<?php echo $d->id ?>"><?php echo $d->name ?></option>
            <?php } ?>
    </select><br><br>
    <!-- <input type="text" name="supplier_id" placeholder="supplier_id"> -->
    <select name="supplier_id">
        <option value="">Select Supplier Name</option>
        <?php foreach($data as $d){ ?>
            <option value="<?php echo $d->id ?>"><?php echo $d->company_name ?></option>
            <?php } ?>
    </select><br><br>
    <input class="btn btn-primary" type="submit" value="submit">
</form>