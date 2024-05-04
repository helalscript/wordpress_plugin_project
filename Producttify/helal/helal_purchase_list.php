<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<?php


global $wpdb;
$p_table = $wpdb->prefix . "purchase";
$r_table = $wpdb->prefix . "raw_materials";

$products = $wpdb->get_results("SELECT * from $p_table group by invoice_id ORDER BY date DESC");
$materials = $wpdb->get_results("SELECT * from $r_table ");
// echo "<pre>";
// print_r($products);
if (isset($_GET['type']) && $_GET['type'] == 'delete') {
    $wpdb->delete($p_table, ['invoice_id' => $_GET['id']]);
    ?>
    <script>
        window.location.assign('<?php echo esc_url(admin_url('admin.php?page=purchase_report')); ?>')
    </script>
    <?php
}

if (isset($_POST['submit1'])) {
    $matid = $_POST['material'];
    $products = $wpdb->get_results("SELECT * from $p_table WHERE material_id=$matid group by invoice_id ORDER BY date DESC;");
}

if (isset($_POST['submit2'])) {
    $date1 = $_POST['date1'];
    $date2 = $_POST['date2'];
    $products = $wpdb->get_results("SELECT * from $p_table WHERE (date BETWEEN '$date1' AND '$date2') group by invoice_id ORDER BY date DESC;");
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Purchase List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        
                    </ol>
                </div>
            </div>


 <!-- ====================================Search bar Start =========================================== -->
            <div class="container-fluid">
                <div class="row">
                <div class="col-sm-3">
                    <form action="#" class="form-inline" method="POST">
                        <div class="row">
                          <div class="col-sm-8"><select name="material" id="material" onchange="getprice((this.value),1)"
                                class="form-control">
                                <option value="">Select Material</option>
                                <?php foreach ($materials as $d) { ?>
                                    <option value="<?php echo $d->id ?>">
                                        <?php echo $d->name ?>
                                    </option>
                                <?php } ?>
                            </select></div>  
                          <div class="col-sm-4"><button type="submit" name="submit1" class="btn btn-primary">Submit</button></div>  
                        </div>
                    </form>
                </div>
                <div class="col-sm-2"></div>
                <div class="col-sm-5">

                    <form action="#" class="form-inline float-sm-right" method="POST">
                        <div class="row">
                            <span class="col-sm-5">
                                <label for="">From</label>
                                <input type="date" name="date1" class="form-control" placeholder="Enter title">
                            </span>
                            <span class="col-sm-5 ">
                                <label for="">To</label>
                                <input type="date" name="date2" class="form-control" placeholder="Enter title">
                            </span><span class="col-sm-2">
                                <button type="submit" name="submit2" class="btn btn-primary ">Submit</button></span>
                        </div>
                    </form>
                </div>
                </div>
                
            </div>
 <!-- ====================================Search bar End =========================================== -->
           

 
 <!-- ====================================Table  Start =========================================== -->
           

            <div>
                <div class="">
                    <div class="card-header" style="background-color:#563d7c">
                        <div class="row">
                            <div class="col-md-3">
                                <h3 class="card-title text-light">Purchase List</h3>
                            </div>
                            <div class="col-md-3 offset-6 text-right">
                                <a href="<?php echo esc_url(admin_url('admin.php?page=helal_purchase_add')); ?>"
                                    class="btn btn-warning">Add Purchase</a>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Invoice</th>
                                    <th>Price</th>
                                    <th>Date</th>
                                    <th style="width: 220px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($products as $i => $p) { ?>
                                    <tr>
                                        <td>
                                            <?php echo ++$i ?>
                                        </td>
                                        <td>
                                            <?php echo $p->invoice_id ?>
                                        </td>
                                        <td>
                                            <?php
                                            $inid = $p->invoice_id;
                                            $fprice = 0;
                                            $price = $wpdb->get_results("select price from $p_table where invoice_id=$inid");
                                            foreach ($price as $n) {
                                                $fprice += $n->price;
                                            }
                                            echo $fprice; ?>
                                        </td>
                                        <td>
                                            <?php echo $p->date ?>
                                        </td>
                                        <td>
                                            <a href="<?php echo esc_url(admin_url('admin.php?page=purchase_edit&id=' . $p->invoice_id)); ?>"
                                                class="btn btn-success btn-sm">Update</a>
                                            <a href="<?php echo esc_url(admin_url('admin.php?page=purchase_report&type=delete&id=' . $p->invoice_id)); ?>"
                                                class="btn btn-danger btn-sm">Delete</a>
                                             <a href="<?php echo esc_url(admin_url('admin.php?page=purchase_view&id=' . $p->invoice_id)); ?>"
                                                target="_blank" class="btn btn-success btn-sm">View</a> 

                                        </td>
                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->

                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

</div>
<!-- /.content-wrapper -->

 <!-- ====================================Table  End =========================================== -->
           

