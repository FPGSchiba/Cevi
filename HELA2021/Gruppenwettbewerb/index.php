<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gruppenwettbewerb</title>
    <link rel="Stylesheet" href="style.css">
</head>
  <style>

    
  </style>
    
    <!-- Resources -->
  <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
  <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
  <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
  <!-- Chart code -->
  
  <?php
      $myfile = fopen("./values.json", "r") or die("Unable to open file!");
      $json_str = fread($myfile, filesize("values.json"));
      fclose($myfile);
      $json_str = preg_replace('/(\r|\n|\s)+/m', ' ', $json_str);
  ?>

  <script>
    am4core.ready(function() {

    am4core.useTheme(am4themes_animated);
    
    const obj = JSON.parse('<?php echo $json_str?>');

    for (const [group, Dataset] of Object.entries(obj)) {
      var data = [];
      Dataset.forEach(addArrayElementsToData);
      var chart = am4core.create("chartdiv-" + group, am4charts.XYChart);

      chart.data = data;
    
      // Create axes
      var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
      dateAxis.renderer.minGridDistance = 60;
      
      var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
      
      var series = chart.series.push(new am4charts.LineSeries());
      series.dataFields.valueY = "value";
      series.dataFields.dateX = "date";
      series.strokeWidth = 3;

      var circleBullet = series.bullets.push(new am4charts.CircleBullet());
      circleBullet.circle.stroke = am4core.color("#fff");
      circleBullet.circle.strokeWidth = 2;

      var labelBullet = series.bullets.push(new am4charts.LabelBullet());
      labelBullet.label.text = "{value}";
      labelBullet.label.dy = -20;
      
      series.tooltip.pointerOrientation = "vertical";
      
      chart.cursor = new am4charts.XYCursor();
      chart.cursor.snapToSeries = series;
      chart.cursor.xAxis = dateAxis;
      
      //chart.scrollbarY = new am4core.Scrollbar();
      chart.scrollbarX = new am4core.Scrollbar();
    }

    function addArrayElementsToData(Data){
        var date = new Date(Data.date);
        data.push({date:date, value: Data.value});
    }

    });
  </script>
<body>
  <div id="Header">
    <nav>
      <ul>
        <li>
          <a class="Current" href="#">Home</a>
        </li>
        <li>
          <a href="admin.php">Admin</a>
        </li>
      </ul>
    </nav>
  </div>
  <div id="managediv">
  <?php
    $manage = json_decode($json_str, true);
    foreach($manage as $key => $value) 
    {
      echo '<h1>'.$key.'</h1>';
      // TODO: Loop through all grou names
      echo '<div id="chartdiv-'.$key.'"></div>';
    }
  ?>
  </div>
</body>
</html>