<?php    
//$conn = mysql_connect("localhost","root","");
//mysql_select_db("csti_db1",$conn);
include "conexion.php";
//
if(isset($_GET['buscar'])) {   ?>

<form name="frmUser" method="GET">
 <script language="javascript" src="js/reportes.js" type="text/javascript"></script>      


<?php

$buscar = $_GET["palabra"];

$consulta_mysql=mysqli_query($conn,"SELECT name, cubiculo, email 	FROM maestros 
  WHERE name like '%$buscar%' ORDER BY name ");
while($row = mysqli_fetch_array($consulta_mysql)) {

?> 
<tr>

<td align="center"><b><p><?php echo $row['name'] ?></p></b> </td>
  <td align="center"><b><?php echo $row['email'] ?></b></td>
  <td align="center"><b><p><?php echo $row['cubiculo'] ?></p></b> </td>
  
<?php } 


?>

<?php   
} // fin if
  

?>