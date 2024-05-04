<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <div class="h2 container" style="color: white; background:blue;padding-bottom:10px;margin-top:10px;text-align:center">Stock Details</div>
        <!-- Default box -->

        <?php
        global $wpdb; 
        $purchase = $wpdb->prefix . "purchase";
        $wastage = $wpdb->prefix . "material_wastage";
        $return = $wpdb->prefix . "stock_return";
        ?>




        <div class="container">
            <div class="row">
                <table class="table table-bordered table-success table-striped">
                    <thead>
                        <tr class="table-primary">
                            <th>date</th>
                            <th>Total purchase</th>
                            <th>Wastage</th>
                            <th>Return to Supplier</th>
                            <th>Stock in </th>
                            <th>Stock out</th>
                            <th>Closing Stock</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        

                        // $today=date("Y-m-d");
                        // $convert = strtotime($today);

                        // $tomorrow=strtotime('+1 day', $convert);
                        // for($i=0;$i<30;$i++) {
                        //     $tomorrow= strtotime('+1 day', $tomorrow);
                        //     $date=date('Y-m-d', $tomorrow);
                        $ostock = 0;
                        $sreturn = 0;
                        $mwastage = 0;
                        $today=date("Y-m-d");
                        $convert = strtotime($today);
                        $startDate=strtotime('-30 day', $convert);
                        for($i=0;$i<30;$i++) {
                            $startDate= strtotime('+1 day', $startDate);
                            $date=date('Y-m-d', $startDate);
                        ?>
                            <tr>
                                <td>
                                    <?php echo $date ?>
                                </td>
                                <td>
                                <?php $results1 = $wpdb->get_results( "SELECT sum(quantity) as s from $purchase WHERE date='$date' and material_id=".$_GET['id']);foreach($results1 as $pur){ echo round($pur->s) ;}$ostock+=round($pur->s) ; ?>
                                
                                </td>
                                <td>
                                    <?php $results2 = $wpdb->get_results( "SELECT sum(quantity) as s from $wastage WHERE date='$date' and material_id=".$_GET['id']);foreach($results2 as $was){ echo round($was->s) ;}$mwastage+=round($was->s) ; ?>
                                </td>
                                <td>
                                    <?php $results3 = $wpdb->get_results( "SELECT sum(quantity) as s from $return WHERE date='$date' and material_id=".$_GET['id']);foreach($results3 as $ret){ echo round($ret->s) ;}$sreturn+=round($ret->s) ; ?>
                                </td>
                                <td>
                                    <?php //echo round($pur->s)-round($was->s)-round($ret->s) ?>
                                    <?php echo $ostock-$mwastage-$sreturn ?>
                                </td>
                                <td>
                                    <?php //if(!(round($pur->s)-round($was->s)-round($ret->s)>0)){echo "Stock Out";}   ?>
                                    <?php if(!(round($ostock-$mwastage-$sreturn)>0)){echo "Stock Out";}else{
                                        echo "Stock In";
                                    }   ?>
                                </td>
                                <td>
                                    <?php //if(!(round($pur->s)-round($was->s)-round($ret->s)>0)){echo "Stock Out";}else{echo round($pur->s)-round($was->s)-round($ret->s);} ?>
                                    <?php if(!(round($ostock-$mwastage-$sreturn)>0)){echo "Stock Out";}else{
                                        echo "Available";} ?>
                                </td>
                            </tr>
                        <?php } ?>


                    </tbody>
                </table>
            </div>
        </div>