<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
?>
<!doctype html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>
<body>
<form class="form col-md-4" action="#" method="POST">
    <div class="form-group">
        <label for="exampleInputEmail1">Ville (separator ",")</label>
        <textarea name="input" class="form-control"
                  rows="8"><?php  if (isset($_POST["input"])) echo $_POST["input"];?></textarea>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-defaut"/>
    </div>
</form>
<div class="row">
    <div class="col-md-12">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>Ville</th>
                <th>Long</th>
                <th>Lat</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if (isset($_POST["input"])) {
                //@var $temp String
                foreach (explode(PHP_EOL, $_POST["input"]) as $temp) {
                    if (strlen($temp) > 0) {
                        $result = file_get_contents("https://maps.googleapis.com/maps/api/geocode/xml?address=" . trim(str_replace(" ", ",", $temp)) . "&sensor=false&key=AIzaSyBLiQOYBk_RshSCaS52eRHvhXb9IYpSzbk");
                        $xmlResult = new SimpleXMLElement($result);
                        echo "<tr>";
                        echo "<td>" . trim($temp) . "</td>";
                        echo "<td>" . $xmlResult->result->geometry->location->lat . "</td>";
                        echo "<td>" . $xmlResult->result->geometry->location->lng . "</td>";
                        echo "</tr>";
                    }
                }
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
