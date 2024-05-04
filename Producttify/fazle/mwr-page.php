<?php
global $wpdb;
$mw = $wpdb->prefix . "material_wastage";
$rm = $wpdb->prefix . "raw_materials";
$data1 = $wpdb->get_results("SELECT mw.material_id as id, mw.quantity, mw.date, rm.name as mname, rm.price FROM $mw mw JOIN $rm rm ON mw.material_id=rm.id GROUP BY rm.id;");
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-4">
        <h1>Material Wastage Report</h1>
        <table class="table mt-5">
            <thead class="table-info">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Material</th>
                    <th scope="col">Total Wastage</th>
                    <th scope="col">Sold</th>
                    <th scope="col">Dump</th>
                    <th scope="col">Remaining</th>
                    <th scope="col">Unit Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($data1)) {
                    foreach ($data1 as $k => $v) {
                ?>
                        <tr>
                            <th scope="row"><?php echo ++$k ?></th>
                            <td><?php echo $v->mname ?></td>
                            <td>
                                <?php
                                $mid = $v->id;
                                $twaste = $wpdb->get_row("SELECT SUM(quantity) as tw FROM $mw where material_id=$mid");
                                echo $totalw =  $twaste->tw;
                                ?>
                            </td>
                            <td>
                                <?php

                                $mws = $wpdb->prefix . "material_wastage_sale";
                                $qsumr = $wpdb->get_row("SELECT SUM(quantity) as ssum FROM $mws where material_id=$mid");
                                echo $sold =  $qsumr->ssum;
                                ?>
                            </td>
                            <td>
                                <?php
                                $mwd = $wpdb->prefix . "material_wastage_dump";
                                $dsumr = $wpdb->get_row("SELECT SUM(quantity) as dsum FROM $mwd where material_id=$mid");
                                echo $dump = $dsumr->dsum;
                                ?>
                            </td>
                            <td><?php echo ($totalw-($sold+$dump)) ?></td>
                            <td><?php echo $v->price ?></td>
                        </tr>
                <?php }
                } ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>