<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
  <style>
    #chartdiv {
      width: 100%;
      height: 500px;
    }
    
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
    
    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end
    
    var chart = am4core.create("chartdiv", am4charts.XYChart);
    const obj = JSON.parse('<?php echo $json_str?>');

    var data = [];
    for (const [group, Dataset] of Object.entries(obj)) {
      Dataset.forEach(addArrayElementsToData);
    }

    function addArrayElementsToData(Data){
        var date = new Date(Data.date);
        data.push({date:date, value: Data.value});
    }

    chart.data = data;
    
    // Create axes
    var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
    dateAxis.renderer.minGridDistance = 60;
    
    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
    
    // Create series
    var series = chart.series.push(new am4charts.LineSeries());
    series.dataFields.valueY = "value";
    series.dataFields.dateX = "date";
    series.tooltipText = "{value}"
    
    series.tooltip.pointerOrientation = "vertical";
    
    chart.cursor = new am4charts.XYCursor();
    chart.cursor.snapToSeries = series;
    chart.cursor.xAxis = dateAxis;
    
    //chart.scrollbarY = new am4core.Scrollbar();
    chart.scrollbarX = new am4core.Scrollbar();
    
    }); // end am4core.ready()
  </script>
<body>
    <!-- HTML -->
    <h1>Test Chart</h1>
    <div id="chartdiv"></div>
    <h2 id="demo">Test Text</h2>
</body>
</html>