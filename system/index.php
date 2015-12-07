<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Govir</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/agency.css" rel="stylesheet">
    <link href="css/mystyles.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top" class="index">

     <h2>SISTEMA DEL DEPARTAMENTO DE INGENIERÍA INDUSTRIAL</h2>
    <section class="container login-form">
        <form method="post" action="" role="login">
            <section>
                <h4 class="text-center">Usuarios</h4>
                
                <div>
                <input type="button">
                </div>

                   <div>
                        <form method="GET" action="" onSubmit="return validarForm(this);" >
                            <center>
                        <div class="form-group pull-right">
                        <div class="col-md-10"> 
                        <input type="text" placeholder="" name="palabra" class="form-control input">
                   </div>
                 <div class="col-md-2">
                 <input type="submit" value="Buscar" name="buscar" class="btn btn-primary btn-md">
                  </div>
                </div>
                
                <br><br>
                <?php include('buscador.php'); ?>
                        </center>
                        </form>
                   </div> 
                    <div>

                    </div>
        
             
            </section>
        </form>

        
    </section>
   
   <div>
       <?php 
        $registros=28;
        @$pagina = $_GET ['pagina'];

        if (!isset($pagina))
        {
          $pagina = 1;
          $inicio = 0;
        }
        else
        {
          $inicio = ($pagina-1) * $registros;
        } 
        $result = "SELECT * FROM maestros ORDER BY name asc limit ".$inicio." , ".$registros." ";
        $cad = mysqli_query($conn,$result) or die ( 'error al listar, $pegar' .mysqli_error($conn)); 
  //calculamos las paginas a mostrar

        $contar = "SELECT * FROM maestros";
        $contarok = mysqli_query($conn, $contar);
        $total_registros = mysqli_num_rows($contarok);
//$total_paginas = ($total_registros / $registros);
        $total_paginas = ceil($total_registros / $registros); 


        while ($row = mysqli_fetch_array($cad)) {
          ?>
          <tr> 
           <td align="center"><b><p><?php echo $row['name'] ?></p></b> </td>
           <td align="center"><b><?php echo $row['email'] ?></b></td>
           <td align="center"><b><p><?php echo $row['cubiculo'] ?></p></b> </td>
         </tr>    
         
         <?php   
       }
       
       echo "<center><p>";

       if($total_registros>$registros){
        if(($pagina - 1) > 0) {
          echo "<span class='pactiva' ><a href='?pagina=".($pagina-1)."' style='color:blue'>&laquo; Anterior</a></span> ";
        }
// Numero de paginas a mostrar
        $num_paginas=10;
//limitando las paginas mostradas
        $pagina_intervalo=ceil($num_paginas/2)-1;

// Calculamos desde que numero de pagina se mostrara
        $pagina_desde=$pagina-$pagina_intervalo;
        $pagina_hasta=$pagina+$pagina_intervalo;

// Verificar que pagina_desde sea negativo
if($pagina_desde<1){ // le sumamos la cantidad sobrante para mantener el numero de enlaces mostrados $pagina_hasta-=($pagina_desde-1); $pagina_desde=1; } // Verificar que pagina_hasta no sea mayor que paginas_totales if($pagina_hasta>$total_paginas){
  $pagina_desde-=($pagina_hasta-$total_paginas);
  $pagina_hasta=$total_paginas;
  if($pagina_desde<1){
    $pagina_desde=1;
  }
}

for ($i=$pagina_desde; $i<=$pagina_hasta; $i++){
  if ($pagina == $i){
    echo "<span class='pnumero' style='color:black' >".$pagina."</span> ";
  }else{
    echo "<span class='active' ><a style='color:blue' href='?pagina=$i'>$i</a></span> ";
  }
}

if(($pagina + 1)<=$total_paginas) {
  echo " <span class='pactiva'><a style='color:blue' href='?pagina=".($pagina+1)."'>Siguiente &raquo;</a></span>";
}
}

echo "</p></center>";
?>

   </div>
  
</body>

</html>
