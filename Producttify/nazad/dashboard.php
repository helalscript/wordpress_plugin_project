<div class="row">
  <div class="col-md-6">
    <h1 style="text-align: center;background:red;color:white;padding-bottom:10px">Material Stock Report</h1><!-- Styles -->
    <?php
    global $wpdb;
    $purchase = $wpdb->prefix . "purchase";
    $results2 = $wpdb->get_results("SELECT sum(quantity) as s from $purchase");
    //foreach($results2 as $pur){ echo round($pur->s);} ; 
    $wastage = $wpdb->prefix . "material_wastage";
    $results1 = $wpdb->get_results("SELECT sum(quantity) as s from $wastage");
    //foreach($results1 as $pur){ echo round($pur->s);} ; 
    $return = $wpdb->prefix . "stock_return";
    $results3 = $wpdb->get_results("SELECT sum(quantity) as s from $return");
    //foreach($results3 as $ret){ echo round($ret->s);} ; 
    $dump = $wpdb->prefix . "material_wastage_dump";
    $results4 = $wpdb->get_results("SELECT sum(quantity) as s from $dump");
    //foreach($results4 as $ret){ echo round($ret->s);} ; 
    $sale = $wpdb->prefix . "material_wastage_sale";
    $results5 = $wpdb->get_results("SELECT sum(quantity) as s from $sale");
    //foreach($results5 as $ret){ echo round($ret->s);} ;

    ?>
    <style>
      #chartdiv {
        width: 100%;
        height: 500px;

      }
    </style>

    <!-- Resources -->
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

    <!-- Chart code -->
    <script>
      am5.ready(function() {

        // Create root element
        // https://www.amcharts.com/docs/v5/getting-started/#Root_element
        var root = am5.Root.new("chartdiv");

        // Set themes
        // https://www.amcharts.com/docs/v5/concepts/themes/
        root.setThemes([
          am5themes_Animated.new(root)
        ]);

        // Create chart
        // https://www.amcharts.com/docs/v5/charts/xy-chart/
        var chart = root.container.children.push(am5xy.XYChart.new(root, {
          panX: true,
          panY: true,
          wheelX: "panX",
          wheelY: "zoomX",
          pinchZoomX: true,
          paddingLeft: 0,
          paddingRight: 1
        }));

        // Add cursor
        // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
        var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
        cursor.lineY.set("visible", false);


        // Create axes
        // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
        var xRenderer = am5xy.AxisRendererX.new(root, {
          minGridDistance: 30,
          minorGridEnabled: true
        });

        xRenderer.labels.template.setAll({
          rotation: -90,
          centerY: am5.p50,
          centerX: am5.p100,
          paddingRight: 15
        });

        xRenderer.grid.template.setAll({
          location: 1
        })

        var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
          maxDeviation: 0.3,
          categoryField: "Material",
          renderer: xRenderer,
          tooltip: am5.Tooltip.new(root, {})
        }));

        var yRenderer = am5xy.AxisRendererY.new(root, {
          strokeOpacity: 0.1
        })

        var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
          maxDeviation: 0.3,
          renderer: yRenderer
        }));

        // Create series
        // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
        var series = chart.series.push(am5xy.ColumnSeries.new(root, {
          name: "Series 1",
          xAxis: xAxis,
          yAxis: yAxis,
          valueYField: "value",
          sequencedInterpolation: true,
          categoryXField: "Material",
          tooltip: am5.Tooltip.new(root, {
            labelText: "{valueY}"
          })
        }));

        series.columns.template.setAll({
          cornerRadiusTL: 5,
          cornerRadiusTR: 5,
          strokeOpacity: 0
        });
        series.columns.template.adapters.add("fill", function(fill, target) {
          return chart.get("colors").getIndex(series.columns.indexOf(target));
        });

        series.columns.template.adapters.add("stroke", function(stroke, target) {
          return chart.get("colors").getIndex(series.columns.indexOf(target));
        });
        // Table data fetch and sho code generation----------------

        // Set data
        var data = [{
          Material: "Purchase",
          value: <?php foreach ($results2 as $pur) {
                    echo round($pur->s);
                  }; ?>
        }, {
          Material: "Wastage",
          value: <?php foreach ($results1 as $was) {
                    echo round($was->s);
                  }; ?>
        }, {
          Material: "return",
          value: <?php foreach ($results3 as $ret) {
                    echo round($ret->s);
                  };  ?>
        }, {
          Material: "Wastage Sell",
          value: <?php foreach ($results5 as $ret) {
                    echo round($ret->s);
                  } ?>
        }, {
          Material: "Dump",
          value: <?php foreach ($results4 as $ret) {
                    echo round($ret->s);
                  } ?>
        }, ];

        xAxis.data.setAll(data);
        series.data.setAll(data);


        // Make stuff animate on load
        // https://www.amcharts.com/docs/v5/concepts/animations/
        series.appear(1000);
        chart.appear(1000, 100);

      }); // end am5.ready()
    </script>

    <!-- HTML -->
    <div id="chartdiv"></div>
  </div>
  <div class="col-md-6">
    <h1 style="text-align:center;background:blue;color:white;padding-bottom:10px">Material Wastage Report</h1>
    <?php
    global $wpdb;
    $mw = $wpdb->prefix . "material_wastage";
    $rm = $wpdb->prefix . "raw_materials";
    $data1 = $wpdb->get_results("SELECT mw.material_id as id, mw.quantity, mw.date, rm.name as mname, rm.price FROM $mw mw JOIN $rm rm ON mw.material_id=rm.id GROUP BY rm.id ORDER BY mw.date DESC LIMIT 5;");
    ?>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {
        'packages': ['bar']
      });
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Material', 'Total', 'Sold', 'Dump', 'Reamining'],
          <?php
          if (!empty($data1)) {
            foreach ($data1 as $k => $v) {
              //material name
              $matname = $v->mname;


              //total
              $mid = $v->id;
              $twaste = $wpdb->get_row("SELECT SUM(quantity) as tw FROM $mw where material_id=$mid");
              $totalw =  $twaste->tw;

              //sold
              $mws = $wpdb->prefix . "material_wastage_sale";
              $qsumr = $wpdb->get_row("SELECT SUM(quantity) as ssum FROM $mws where material_id=$mid");
              $sold =  $qsumr->ssum;
              //dump
              $mwd = $wpdb->prefix . "material_wastage_dump";
              $dsumr = $wpdb->get_row("SELECT SUM(quantity) as dsum FROM $mwd where material_id=$mid");
              $dump = $dsumr->dsum;
              //Remaining
              $remains = ($totalw - ($sold + $dump));
          ?>['<?php echo $matname ?>', <?php echo $totalw ?>, <?php echo $sold ?>, <?php echo $dump ?>, <?php echo $remains ?>],
          <?php }
          } ?>
        ]);

        var options = {
          chart: {
            subtitle: 'Total, Sold, Dump, Remaining: 2024',
          },
          bars: 'horizontal' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('barchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
    <div id="barchart_material" style="width: 800px; height: 500px;"></div>
  </div>
</div>
<div class="container-fluid" style="margin-top: 50px; ">
  <div class="row">
    <div class="col-md-6">

      <h1 style="text-align: center;background:green;color:white;padding-bottom:10px">Material Dump Calculate</h1>
      <?php
      global $wpdb;
      $mw = $wpdb->prefix . "material_wastage";
      $rm = $wpdb->prefix . "raw_materials";
      $data1 = $wpdb->get_results("SELECT mw.material_id as id, mw.quantity, mw.date, rm.name as mname, rm.price FROM $mw mw JOIN $rm rm ON mw.material_id=rm.id GROUP BY rm.id ORDER BY mw.date DESC LIMIT 5;");
      $ttotal = $tsold = $tdump = $tremains = 0;
      ?>

      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">



      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

      <script type="text/javascript">
        google.charts.load('current', {
          'packages': ['bar']
        });
        google.charts.setOnLoadCallback(drawChart1);

        function drawChart1() {
          var data = google.visualization.arrayToDataTable([
            ['Material', 'Total', 'Sold', 'Dump', 'Reamining'],
            <?php
            if (!empty($data1)) {
              foreach ($data1 as $k => $v) {
                //material name
                $matname = $v->mname;


                //total
                $mid = $v->id;
                $twaste = $wpdb->get_row("SELECT SUM(quantity) as tw FROM $mw where material_id=$mid");
                $totalw =  $twaste->tw;
                //sold
                $mws = $wpdb->prefix . "material_wastage_sale";
                $qsumr = $wpdb->get_row("SELECT SUM(quantity) as ssum FROM $mws where material_id=$mid");
                $sold =  $qsumr->ssum;
                $tsold = +$sold;
                //dump
                $mwd = $wpdb->prefix . "material_wastage_dump";
                $dsumr = $wpdb->get_row("SELECT SUM(quantity) as dsum FROM $mwd where material_id=$mid");
                $dump = $dsumr->dsum;
                $tdump = +$dump;
                //Remaining
                $remains = ($totalw - ($sold + $dump));
                $tremains = +$remains;
            ?>['<?php echo $matname ?>', <?php echo $totalw ?>, <?php echo $sold ?>, <?php echo $dump ?>, <?php echo $remains ?>],
            <?php }
            } ?>
          ]);

          var options = {
            chart: {
              subtitle: 'Total, Sold, Dump, Remaining: 2024',
            },
            bars: 'horizontal' // Required for Material Bar Charts.
          };

          var chart = new google.charts.Bar(document.getElementById('barchart_material'));

          chart.draw(data, google.charts.Bar.convertOptions(options));
        }
      </script>

      <script type="text/javascript">
        google.charts.load("current", {
          packages: ["corechart"]
        });
        google.charts.setOnLoadCallback(drawChart2);

        function drawChart2() {
          var data = google.visualization.arrayToDataTable([
            ['Name', 'Number'],
            ['Sold', <?php echo $tsold ?>],
            ['Dump', <?php echo $tdump ?>],
            ['Remaining', <?php echo $tremains ?>],
          ]);

          var options = {
            title: '',
            is3D: true,
          };

          var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
          chart.draw(data, options);
        }
      </script>
      <div class="container-fluid">
        <div id="piechart_3d" style="height: 500px;" ></div>
      </div>
      <!-- </div> -->


      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </div>
    <div class="col-md-6">
      <h1 style="text-align:center;background:#b23ce1;color:white;padding-bottom:10px">Material Purchase</h1>
      <div><?php require_once("graph/chart.php") ?></div>
    </div>
  </div>
</div>