<!DOCTYPE html>
<html>
<head>
    <title>Resultado Obtenido</title>
    <style>
        body{background-color: #FF1493; text-align: center; font-family: Italic; font-size: large; color:white}
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
</head>
<body class="p-3 m-0 border-0 bd-example bd-example-row" style="background-color: #FF1493; color:white">
    <div>
    <?php
    $correo=$_POST["correo"];
    $nombre=$_POST["nombre"];
    
     # Cargar la biblioteca PHPMailer
     use PHPMailer\PHPMailer\PHPMailer;
     use PHPMailer\PHPMailer\Exception;

     require 'PHPMailer/PHPMailer.php';
     require 'PHPMailer/SMTP.php';
     require 'PHPMailer/Exception.php';

     # Crear una instancia de PHPMailer
     $mail = new PHPMailer(true);
        $tabla = $_POST["tabla"];
        $limiteI=$_POST["limiteI"];
        $limiteF=$_POST["limiteF"];
        $cantidad=0;
        $puntos=0;
        if ($limiteI <= $limiteF) {
            $cantidad = ($limiteF - $limiteI) + 1;
            for ($i=$limiteI; $i <= $limiteF; $i++) { 
                $respuestaU = $_POST["resultado".$i];
                $respuesta = ($tabla * $i);
                $color = "danger";
                $op=75;
                if ($i % 2 == 0) {
                    $op=50;
                }
                if ($respuestaU == $respuesta) {
                $color = "success";
                $puntos++;
                }
                    echo '
                    <div class="container">
                        <div class="row justify-content-md-center">
                            <div class="col-6 bg-primary bg-opacity-'.$op.' border-0 rounded-start-3">'.$tabla.' x '.$i.'</div>
                            <div class="col-2 bg-'.$color.' border-0 rounded-end-3">Su respuesta: '.$respuestaU.'</div>
                        </div>
                    </div>';
            }
        }
        else{
            $cantidad = ($limiteI - $limiteF) + 1;
            for ($i=$limiteI; $i >= $limiteF; $i--) { 
                $respuestaU = $_POST["resultado".$i];
                $respuesta = ($tabla * $i);
                $color = "danger";
                $op=75;
                if ($i % 2 == 0) {
                    $op=50;
                }
                if ($respuestaU == $respuesta) {
                    $color = "success";
                    $puntos++;
                }
                echo '
                <div class="container">
                    <div class="row justify-content-md-center">
                        <div class="col-6 bg-primary bg-opacity-'.$op.' border-0 rounded-start-3">'.$tabla.' x '.$i.'</div>
                        <div class="col-2 bg-'.$color.' border-0 rounded-end-3">Su respuesta: '.$respuestaU.'</div>
                    </div>
                </div>';
            }
        }
        $puntiacion = round(($puntos / $cantidad)*100 );
        echo '<h3 class="text-center">LA PUNTUACION QUE OBTUVO ES: '.$puntiacion.' / 100</h3>';
        try {
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.office365.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'zearjaazul435@outlook.es';
            $mail->Password = 'SonicElEsquizo';
            $mail->SMTPSecure = 'STARTTLS';
            $mail->Port = 587;
            $mail->setFrom('zearjaazul435@outlook.es', 'Tablas de Multiplicar');
            $mail->addAddress($correo, $nombre);
            $mail->isHTML(true);
            $mail->Subject = 'Puntaje logrado';
            $mail->Body    = 'La puntuacion conseguida por practicar la tabla del <b>' . $tabla . '</b> entre el rango <b>' . $limiteI . '</b> al <b>' . $limiteF . '</b> es de: <b>'.$puntiacion.'</b>';
            
            if($mail->send()) {
                echo 'El correo se ha enviado correctamente.';
            } else {
                echo 'Ha ocurrido un error al enviar el correo: ' . $mail->ErrorInfo;
            }
        } catch (Exception $e) {
            echo 'Mensaje ' . $mail->ErrorInfo;
        }

        $enlace=mysqli_connect("localhost","root","","tablademultiplicacion");
        $query="INSERT INTO usser(Nombre,Tabla,Inicio,Fin,Puntuacion,Correo) VALUES (?,?,?,?,?,?)";
        $sentencia=mysqli_prepare($enlace,$query);
        mysqli_stmt_bind_param($sentencia,"siiiis", $nombre,$tabla,$limiteI,$limiteF,$puntiacion,$correo);
        mysqli_stmt_execute($sentencia);
        mysqli_stmt_close($sentencia);
        mysqli_close($enlace);
    ?>
    <form action="pract1.html" method="post">
        
        <div class="d-grid gap-2 col-6 mx-auto">
            <input class="btn btn-outline-light" type="submit" value="INICIO" style="font-size:xx-large;">
        </div>
    </form>
    </div>
</body>
</html>