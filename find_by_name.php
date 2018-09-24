<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php
require_once 'login_register/core/init.php';

if (!isset ($_GET["movie_name"])){
echo "Parametar naziv nije prosleđen!";
} else {
$pom=$_GET["movie_name"];
include "conn.php";

$sql="SELECT * FROM movies WHERE movie_name='".$pom."'";
$result = $mysqli->query($sql);

echo "<table border='1'>
<tr>
<th>Naziv filma</th>
<th>Režiser</th>
<th>Godina izdanja</th>
<th>Žanr</th>
<th>Zemlja porekla</th>
<th>IMDB ocena</th>
</tr>";

while($row = $result->fetch_object()){
 echo "<tr>";
 echo "<td>" . $row->movie_name . "</td>";
 echo "<td>" . $row->director . "</td>";
 echo "<td>" . $row->year . "</td>";
 echo "<td>" . $row->genre . "</td>";
 echo "<td>" . $row->country . "</td>";
 echo "<td>" . $row->imdb_rate . "</td>";
 echo "</tr>";
 }
echo "</table>";

$mysqli->close();

}
?>

</body>
</html>

