<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<?php
global $wpdb;
$p_table = $wpdb->prefix . "purchase";
$r_table = $wpdb->prefix . "raw_materials";
$s_table = $wpdb->prefix . "suppliers";
$invid = $_GET['id'] ;
$d = $wpdb->get_results("SELECT m.price as mprice,p.date,p.id,p.invoice_id as invoice,p.price,p.quantity,m.name as material,s.company_name as supplier FROM $p_table p JOIN $r_table m ON p.material_id=m.id JOIN $s_table s ON p.supplier_id=s.id WHERE p.invoice_id=$invid;");
//echo "<pre>";
//print_r($d);
$gtotal = 0;
?>
<div class="container" >
    <div class="">
        <div class="card-header">
            Invoice
            <strong><?php echo $d[0]->invoice ?></strong>
            <span class="float-right"> <strong><a href="" class="btn btn-success btn-sm" onclick="window.print()">Print</a> Date:</strong> <?php echo $d[0]->date ?></span>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-sm-6">
                    <h6 class="mb-3">From:</h6>
                    <div>
                        <strong>Helal Uddin</strong>
                    </div>
                    <div>Madalinskiego 8</div>
                    <div>71-101 Szczecin, Poland</div>
                    <div>Email: info@webz.com.pl</div>
                    <div>Phone: +48 444 666 3333</div>
                </div>
                <div class="col-sm-6">
                    <h6 class="mb-3">To:</h6>
                    <div>
                        <strong>Baki</strong>
                    </div>
                    <div>Attn: Daniel Marek</div>
                    <div>43-190 Mikolow, Poland</div>
                    <div>Email: marek@daniel.com</div>
                    <div>Phone: +48 123 456 789</div>
                </div>

            </div>
            <div class="table-responsive-sm">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="center">#</th>
                            <th>Materials</th>
                            <th>Supplier</th>
                            <th>Unit Price</th>
                            <th class="center">Qty</th>
                            <th class="right">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach($d as $k=>$v){
                            $gtotal += $v->price;
                            ?>
                        <tr>
                            <td class="center"><?php echo ++$k ?></td>
                            <td class="left strong"><?php echo $v->material ?></td>
                            <td class="left"><?php echo $v->supplier?></td>
                            <td><?php echo $v->mprice?></td>
                            <td class="center"><?php echo $v->quantity?></td>
                            <td class="right"><?php echo $v->price?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-5">
                </div>
                <div class="col-lg-4 col-sm-5 ml-auto">
                    <table class="table table-clear">
                        <tbody>
                            <tr>
                                <td class="left">
                                    <strong>Grand Total</strong>
                                </td>
                                <td class="right"><?php echo $gtotal ?> Taka</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
