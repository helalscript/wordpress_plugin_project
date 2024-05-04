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
<h1>Teacher list</h1>
<table border="1" class="table table-primary ">
<tr>
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
<?php //foreach($data as $k=>$d){ ?>
<tr>
    <td>1</td>
    <td>A</td>
    <td>B</td>
    <td>C</td>
    <td>D</td>
    <td>E</td>
    <td>F</td>
    <td>G</td>
    <td><a class="btn btn-primary" href="<?php //echo esc_url(admin_url('admin.php?page=teacher&type=edit&id=' . $d->id)); ?>">Details</a></td>
</tr>
<?php //} ?>
    
</table>
