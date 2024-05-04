<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<?php
global $wpdb;
$purchase_table=$wpdb->prefix ."purchase";
$data=$wpdb->get_row("select * from $purchase_table where id=".$_GET['id']);
$tablem=$wpdb->prefix . "raw_materials";
$datam=$wpdb->get_results("select * from $tablem");
$table1=$wpdb->prefix . "suppliers";
$data1=$wpdb->get_results("select * from $table1");
?>
<?php
$invoice= rand(1000,99999); 
?>

<h1>Purchase Insert Form</h1>
<form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
    <input type="hidden" name="id" value="<?php echo $data->id ?>">
    <input type="hidden" name="action" value="update_purchase">
    <input type="text" value="<?php echo $invoice ?>" name="invoice_id" placeholder="Invoice Id" id="">
    <input type="text" name="price" placeholder="Price" id="" value="<?php echo $data->price ?>">
    <!-- <input type="text" name="material_id" placeholder="Material Id" id=""> -->
    <select name="material_id" id="">
        <option value="">Select material name</option>
        <?php foreach($datam as $k=>$v){ ?>
        <option value="<?php echo $v->id ?>"<?php if($v->id==$data->material_id){
            echo "selected";} ?>><?php echo $v->name ?></option>
        <?php } ?>
    </select>
    <select name="supplier_id" id="">
        <option value="">Select company name</option>
        <?php foreach($data1 as $k=>$v){ ?>
        <option value="<?php echo $v->id ?>"<?php if($v->id==$data->supplier_id){echo "selected";} ?>><?php echo $v->company_name ?></option>
        <?php } ?>
    </select>
    <!-- <input type="text" name="supplier_id" placeholder="Supplier Id" id=""> -->
    <input type="text" name="quantity" placeholder="Quantity" id=""  value="<?php echo $data->quantity ?>">
    <input type="date" name="date" id="" value="<?php echo $data->date ?>">
    <input class="btn btn-primary" type="submit" value="Save" id="">
</form>