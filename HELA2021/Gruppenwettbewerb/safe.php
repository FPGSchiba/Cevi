<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Safe - Wettbewerb</title>
    <link rel="Stylesheet" href="style.css">
</head>
<body>
<?php
  // The global $_POST variable allows you to access the data sent with the POST method by name
  // To access the data sent with the GET method, you can use $_GET
  $group = $_POST["gruppenwahl"];
  $date  = $_POST["date"];
  $points = $_POST["points"];

  $myfile = fopen("./values.json", "r") or die("Unable to open file!");
  $json_str = fread($myfile, filesize("values.json"));
  fclose($myfile);
  $json = json_decode(preg_replace('/(\r|\n|\s)+/m', ' ', $json_str));
  $new_object = array("date" => $date, "value" => $points);
  array_push($json->$group->values, $new_object);
  echo(json_encode($json->$group->values));
  $myfile = fopen("./values.json", "w") or die("Unable to open file!");
  $txt = json_encode($json);
  fwrite($myfile, $txt);
  fclose($myfile);
  header("location:https://cevi.sekaiju.ch/admin.php");
?>
</body>
</html>