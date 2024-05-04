
    <?php
    $purchase1 = $wpdb->prefix . "purchase";
    $material = $wpdb->prefix . "raw_materials";
    $result = $wpdb->get_results( "SELECT * FROM $material");
    ?>
    <script src="https://cdn.anychart.com/releases/8.11.1/js/anychart-core.min.js"></script>
    <script src="https://cdn.anychart.com/releases/8.11.1/js/anychart-pie.min.js"></script>
    <style type="text/css">      
      html, body, #container { 
        width: 100%; height: 100%; margin: 0; padding: 0; 
      } 
    </style>  
    <div id="container"style="height:450px"></div>
    <script>
      anychart.onDocumentReady(function () {  
        // add the data
        var data = anychart.data.set([
         <?php if(!empty($results1)){
 foreach($result as $k=>$d){ ?>
          
          ["<?php echo $d->name ?> ", <?php $results2 = $wpdb->get_results( "SELECT sum(quantity) as s from $purchase1 WHERE material_id=".$d->id);foreach($results2 as $pur){ echo round($pur->s) ;} ; ?> ],
          <?php }} ?>
        ]);
        // create a pie chart instance with the passed data
        var chart = anychart
          .pie(data)
          // set the inner radius to make a donut chart
          .innerRadius("55%");
        // set the chart title
        chart.title("Total sell in 2024");
        // set the container id for the chart
        chart.container("container");
        // draw the resulting chart
        chart.draw();
      });
    </script>