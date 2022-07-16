<?php
ob_start();
?>

<?php
    include_once "model/conexion.php";
    $sentencia = $bd -> query("select * from persona");
    $persona = $sentencia->fetchAll(PDO::FETCH_OBJ);
    //print_r($persona);
?>


<!doctype html>
<html lang="es">
  <head>
    <title>Control de combustible</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- cdn icnonos-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  </head>
  <body>
  <div class="card col-8">
                <div class="card-header">
                    Control de Combustible
                </div>

                <div class="p-4">
                  <br>

                    <table class="table table-striped table-bordered" id="tabla">
                        <thead>
                            <tr>
                                <th scope="col">Fecha</th>
                                <th scope="col">Placa</th>
                                <th scope="col">Valor</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                foreach($persona as $dato){ 
                            ?>

                            <tr>
                                <td><?php echo $dato->nombre; ?></td>
                                <td><?php echo $dato->edad; ?></td>
                                <td><?php echo $dato->signo; ?></td>
                               
                            </tr>

                            <?php 
                                }
                            ?>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        
  </body>
</html>
<?php 
$html=ob_get_clean();

require_once './libreria/dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$dompdf= new Dompdf();

$options= $dompdf->getOptions();
$options->set(array('isRemoteEnabled'=>true));
$dompdf->setOptions($options);

$dompdf->loadHtml($html);
// // $dompdf->setPaper('letter');
$dompdf->setPaper("A4", "landscape");
$dompdf->render();
$dompdf->stream("Reporte_Combustible.pdf", array("Attachment" =>false));
 

?>

