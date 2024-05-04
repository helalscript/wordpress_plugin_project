<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<?php 
global $wpdb;
$table=$wpdb->prefix."teachers";
if(isset($_GET['type'])&& $_GET['type']=='delete'){
    $wpdb->delete($table,['id'=>$_GET['id']]);
}
$data=$wpdb->get_results("select * from $table");
// echo "<pre>";
// print_r($data);
?>
<h1 style="color: white; background:blue;padding-bottom:10px;margin-top:10px;text-align:center">Material Stock Report</h1>
<table border="1" class="table table-success table-bordered ">
<tr class="table-primary">
    <th>SL</th>
    <th>Product Name</th>
    <th>Purchase Quantity</th>
    <th>Wastage</th>
    <th>Return</th>
    <th>Available</th>
    <th>Unit Price</th>
    <th>Total Price</th>
    <th>Details</th>
    
</tr>
<?php
$material = $wpdb->prefix . "raw_materials";
$purchase = $wpdb->prefix . "purchase";
$wastage = $wpdb->prefix . "material_wastage";
$return = $wpdb->prefix . "stock_return";
// echo $return;
$results1 = $wpdb->get_results( "SELECT * FROM $material");

$price = 0;
$quantity = 0;
$total = 0;
if(!empty($results1)){
 foreach($results1 as $k=>$d){ ?>
<tr>
    <td><?php echo ++$k ?></td>
    <td><?php echo $d->name ?></td>
    <td><?php $results2 = $wpdb->get_results( "SELECT sum(quantity) as s from $purchase WHERE material_id=".$d->id);foreach($results2 as $pur){ echo round($pur->s) ;} ; ?></td>
    <td><?php $results3 = $wpdb->get_results( "SELECT sum(quantity) as s from $wastage WHERE material_id=".$d->id);foreach($results3 as $was){ echo round($was->s) ;} ; ?></td>
    <td><?php $results4 = $wpdb->get_results( "SELECT sum(quantity) as s from $return WHERE material_id=".$d->id);foreach($results4 as $ret){ echo round($ret->s) ;} ; ?></td>
    <td><?php $quantity=round($pur->s)-round($was->s)-round($ret->s); echo $quantity ?></td>
    <td><?php $price=round($d->price); echo $price ?></td>
    <td>
        <?php echo $price * $quantity  ?>
        <?php $total += $price * $quantity  ?>
    </td>
    <td><a class="btn btn-primary" href="<?php echo esc_url(admin_url('admin.php?page=Show_report&id=' . $d->id)); ?>">Details</a></td>
</tr>
<?php }} ?>
<tr class="table-danger">
 <td colspan="7" style="text-align:right"><b>Total Price</b></td>
 <td><b><?php echo $total    ?></b></td>
 <td></td>
</tr>
    
</table>
