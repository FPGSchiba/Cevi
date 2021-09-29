<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gruppenwettbewerb</title>
    <link rel="Stylesheet" href="style.css">
</head>
    
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

  <script type="text/javascript">
  am4core.ready(function() {
    am4core.useTheme(am4themes_animated);
    var chart = am4core.create("chartdiv", am4charts.XYChart);
    chart.colors.step = 2;

    var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
    dateAxis.renderer.minGridDistance = 50;

    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

    // Create series
    function createAxisAndSeries(name, field, color) {
      console.log(name);
      var series = chart.series.push(new am4charts.LineSeries());
      series.dataFields.valueY = field;
      series.dataFields.dateX = "date";
      series.strokeWidth = 2;
      series.stroke = am4core.color(color);
      series.yAxis = valueAxis;
      series.name = name;
      series.tooltipText = "{name}: [bold]{valueY}[/]";
      series.tooltip.getFillFromObject = false;
      series.tooltip.background.fill = am4core.color(color);
      series.tensionX = 0.8;
      series.showOnInit = true;
      
      var interfaceColors = new am4core.InterfaceColorSet();
      
      var bullet = series.bullets.push(new am4charts.Bullet());
      bullet.width = 12;
      bullet.height = 12;
      bullet.horizontalCenter = "middle";
      bullet.verticalCenter = "middle";
          
      var triangle = bullet.createChild(am4core.Triangle);
      triangle.fill = am4core.color(color);
      triangle.stroke = interfaceColors.getFor("background");
      triangle.strokeWidth = 2;
      triangle.direction = "top";
      triangle.width = 12;
      triangle.height = 12;
    }

    const obj = JSON.parse('<?php echo $json_str?>');

    //Add dates
    for (const [group, Dataset] of Object.entries(obj)) {
      Dataset.values.forEach(element => {
        chart.data.push({date: new Date(element.date)});
      });

      break;
    }

    //Add values
    for (const [group, Dataset] of Object.entries(obj)) {
      var field = group + "-values"
      for (let [index, element] of Dataset.values.entries()) {
        chart.data[index][field] = element.value;
      }
    }

    console.log(chart.data);

    for (const [group, Dataset] of Object.entries(obj)) {
      var field = group + "-values"
      createAxisAndSeries(group, field, Dataset.color);
    }

    // Add legend
    chart.legend = new am4charts.Legend();
    chart.cursor = new am4charts.XYCursor();
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
          <a href="admin.php" style="width: 80%; height: 100%; margin: auto;">Admin</a>
        </li>
      </ul>
    </nav>
  </div>
  <div id="chartdiv" style="height: 500px;"></div>
</body>
</html>