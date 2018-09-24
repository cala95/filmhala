<?php
require_once 'login_register/core/init.php';
if (!isset ($_GET["input"])){
echo "Parametar unos nije prosleđen!";
} else {
$pom=$_GET["input"];
include "conn.php";
$sql="SELECT movie_name FROM movies WHERE movie_name LIKE '$pom%'ORDER BY movie_name";
$result = $mysqli->query($sql);
if ($result->num_rows==0){
echo "U bazi ne postoji film koji počinje sa " . $pom;
} else {
while($row = $result->fetch_object()){
?>
<a href="#" onclick="place(this)"><?php  echo $row->movie_name;?></a>
<br/>
<?php
}
}
$mysqli->close();
}
?>
