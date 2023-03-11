<!DOCTYPE html>
<html>
<head>
    <title>Prueba De Multiplicacion</title>
    <style>
        body{background-color: #DC143C; text-align: center; ffont-family: Italic; font-size: large; color:wwhite}
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
</head>
<body class="p-3 m-0 border-0 bd-example bd-example-row" style="background-color: #DC143C; color:white">
   
        <form action="resultado1.php" method="post">
            <div>
            <?php
                  $correo=$_POST["correo"];
                  echo '
                  <input type="hidden" id="correo" name="correo" value="'.$correo.'">';
                  $nombre=$_POST["nombre"];
                  echo '
                  <input type="hidden" id="nombre" name="nombre" value="'.$nombre.'">';
                $tabla=$_POST["tabla"];
                echo '
                <input type="hidden" id="tabla" name="tabla" value="'.$tabla.'">';
                $limiteI=$_POST["limiteI"];
                echo '
                <input type="hidden" id="limiteI" name="limiteI" value="'.$limiteI.'">';
                $limiteF=$_POST["limiteF"];
                echo '
                <input type="hidden" id="limiteF" name="limiteF" value="'.$limiteF.'">';
                if ($limiteI <= $limiteF) {
                    for ($i=$limiteI; $i <= $limiteF; $i++) { 
                        $op=75;
                        if ($i % 2 == 0) {
                            $op=50;
                        }
                        echo '
                        <div class="container">
                            <div class="row justify-content-md-center">
                                <div class="col-6 border-0 rounded-start-3 bg-primary bg-opacity-'.$op.'">'.$tabla.' x '.$i.'= </div>
                                <div class="col-2 border-0 bg-info bg-opacity-'.$op.' rounded-end-3">
                                    <input class="form-control text-light text-center bg-transparent border-0" type="text" placeholder="Your answer" id="resultado'.$i.'" name="resultado'.$i.'">
                                </div>
                            </div>
                        </div>';
                       
                    }
                }
                else {
                    for ($i=$limiteI; $i >= $limiteF; $i--) {
                        $op=75;
                        if ($i % 2 == 0) {
                            $op=50;
                        }
                        echo '
                        <div class="container">
                            <div class="row justify-content-md-center">
                                <div class="col-6 border-0 rounded-start-3 bg-primary bg-opacity-'.$op.'">'.$tabla.' x '.$i.'= </div>
                                <div class="col-2 border-0 bg-info bg-opacity-'.$op.' rounded-end-3">
                                    <input class="form-control text-light text-center bg-transparent border-0" type="text" placeholder="Your answer" id="resultado'.$i.'" name="resultado'.$i.'">
                                </div>
                            </div>
                        </div>';
                       
                    }
                }
            ?><br>
                <div class="d-grid gap-2 col-6 mx-auto">
                    <input class="btn btn-outline-light" type="submit" value="Verificar" style="font-size:xx-large;">
                </div>
            </div>
        </form>
</body>
</html>