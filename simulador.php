<?php
    // función que se conecta a la API y regresa lo que esta de para 'abandono'
    function getAbandono($url){
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $resp = curl_exec($ch);

        if($e = curl_error($ch)){
            echo $e;
        } else{
            $decoded =json_decode($resp, true);
            return $decoded['abandono'] / 100;
        }

        curl_close($ch);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/menu.css">
    <link rel="stylesheet" href="styles/global.css">
    <link rel="stylesheet" href="styles/simulador.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&display=swap" rel="stylesheet">
    <title>Simulador</title>
</head>
<body>
    <nav class="menu-nav">
        <div class="menu-nav-main">          
            <div class="menu-nav-header">
                <a href="menu.php">
                    <img src="imgs/naatik-logo.png" alt="Logo Naatik" class="naatik-logo">
                </a>
                <h1 class="menu-nav-h1">Naatik</h1>
            </div>
            <form class="logout" action="menu.php" method="POST">
                <button name="closeSesion" type="submit" class="end-session"><h2>Cerrar sesión</h2></button>
            </form>
            <?php
                if(isset($_POST['closeSesion'])){
                    session_destroy();
                    header("Location: index.php");
                }
            ?>
        </div>
    </nav>

    <div class="simulator-main">
        <form action="simulador.php" method="POST" class="simulator-form">
            <div class="formleft">
            <h4>Género</h4>
            <div class="label">
                <input checked="checked" type="radio" value="0" name="genero" id="femenino">
                <label for="femenino">Fémenino</label> 
            </div>
            <div class="label">
                <input type="radio" value="1" name="genero" id="masculino">
                <label for="masculino">Masculino</label>
            </div>


            <?php
                $siNo = array(
                    array("postName" => "esJubilado", "title" => "Es jubilado"),
                    array("postName" => "tienePareja", "title" => "Tiene pareja"),
                    array("postName" => "tieneDependientes", "title" => "Tiene dependientes"),
                    array("postName" => "facturaElectronica", "title" => "Factura eléctronica"),
                    array("postName" => "tieneServTelefono", "title" => "Tiene servicio de télefono")
                );

                foreach($siNo as $rubro){
                    $h4Title = $rubro['title'];
                    $postName = $rubro['postName'];
                    echo "<h4>$h4Title</h4>";
                    echo "<div class='label'>";
                    echo "<input checked='checked' type='radio' value='0' name='$postName' id='no$postName'>";
                    echo "<label for='no$postName'>No</label> ";
                    echo "</div>";
                    echo "<div class='label'>";
                    echo "<input type='radio' value='1' name='$postName' id='si$postName'>";
                    echo "<label for='si$postName'>Sí</label>";
                    echo "</div>";
                }

                $numbers = array(
                    array("postName" => "mesesComoCliente", "title" => "Meses como cliente"),
                    array("postName" => "cargoMensual", "title" => "Cargo mensual ($)"),
                    array("postName" => "cargosTotales", "title" => "Cargos totales ($)"),
                );

                $servInternet = array(
                    array("postName" => "seguridadEnLinea", "title" => "Seguridad en línea"),
                    array("postName" => "backupEnLinea", "title" => "Backup en línea"),
                    array("postName" => "proteccionDispositivo", "title" => "Protección de dispositivos"),
                    array("postName" => "soporteTecnico", "title" => "Soporte técnico"),
                    array("postName" => "streamingTV", "title" => "Streaming de TV"),
                    array("postName" => "streamingPeliculas", "title" => "Streaming de películas")
                );

                foreach($servInternet as $rubro){
                    $h4Title = $rubro['title'];
                    $postName = $rubro['postName'];
                    echo "<h4>$h4Title</h4>";
                    echo "<div class='label'>";
                    echo "<input checked='checked' type='radio' value='0' name='$postName' id='no$postName'>";
                    echo "<label for='no$postName'>No</label> ";
                    echo "</div>";
                    echo "<div class='label'>";
                    echo "<input type='radio' value='1' name='$postName' id='si$postName'>";
                    echo "<label for='si$postName'>Sí</label> ";
                    echo "</div>";
                    echo "<div class='label'>";
                    echo "<input type='radio' value='3' name='$postName' id='sin$postName'>";
                    echo "<label for='sin$postName'>Sin servicio de internet</label>";
                    echo "</div>";
                }
            ?>

            <h4>Internet</h4>
            <div class='label'>
                <input checked="checked" type="radio" value="0" name="internetID" id="noInter">
                <label for="noInter">Sin servicio</label> 
            </div>
            <div class='label'>
                <input  type="radio" value="1" name="internetID" id="dsl">
                <label for="dsl">DSL</label> 
            </div>
            <div class='label'>
                <input  type="radio" value="2" name="internetID" id="fibra">
                <label for="fibra">Fibra óptica</label> 
            </div>

            <h4>Contrato</h4>
            <div class='label'>
                <input checked="checked" type="radio" value="1" name="contratoID" id="m">
                <label for="m">Mes a mes</label> 
            </div>
            <div class='label'>
                <input  type="radio" value="2" name="contratoID" id="1a">
                <label for="1a">Un año</label> 
            </div>
            <div class='label'>
                <input  type="radio" value="3" name="contratoID" id="2a">
                <label for="2a">Dos años</label> 
            </div>
            
            <h4>Pago</h4>
            <div class='label'>
                <input checked="checked" type="radio" value="1" name="pagoID" id="1a">
                <label for="1a">Tarjeta de crédito</label> 
            </div>
            <div class='label'>
                <input  type="radio" value="2" name="pagoID" id="2a">
                <label for="2a">Transferencia bancaria</label> 
            </div>
            <div class='label'>
                <input  type="radio" value="3" name="contratoID" id="3a">
                <label for="3a">Cheque electrónico</label> 
            </div>
            <div class='label'>
                <input type="radio" value="4" name="contratoID" id="4a">
                <label for="4a">Cheque por correo</label> 
            </div>

            <?php
            foreach($numbers as $rubro){
                $h4Title = $rubro['title'];
                $postName = $rubro['postName'];
                echo "<h4>$h4Title</h4>";
                echo "<div class='label'>";
                echo $postName == "mesesComoCliente" ? "<input value='0' min='0' type='number' name='$postName'>" : "<input name='$postName' value='0' min='0' step='0.01' type='number'>";
                echo "</div class='label'>";
            }
            ?>
            </div>
            <div class="formright">
                <input type="submit" value="Calcular abandono" name="submit" class="sim-subm">
            </div>
        </form>
        <?php
            $url = "https://6d7e-2806-10ae-11-8348-5838-dcf-3487-7c5a.ngrok.io?";
            $columnas = array("genero",
                "esJubilado",
                "tienePareja",
                "tieneDependientes",
                "mesesComoCliente",
                "tieneServTelefono",
                "internetID",
                "seguridadEnLinea",
                "backupEnLinea",
                "proteccionDispositivo",
                "soporteTecnico",
                "streamingTV",
                "streamingPeliculas",
                "contratoID",
                "facturaElectronica",
                "pagoID",
                "cargoMensual",
                "cargosTotales");
            if(isset($_POST['submit'])){
                foreach($columnas as $columna)
                    $url .= $columna . '=' . $_POST[$columna] . '&';
                $abandono = getAbandono($url);
                echo "<div id='container' class='simulator'></div>";
                echo "<script src='https://cdn.rawgit.com/kimmobrunfeldt/progressbar.js/0.9.0/dist/progressbar.js'></script>";
                echo "<script src='JS/semiCircle.js'></script>";
                echo "<script> graphSemiCircle($abandono);</script>";
            }
        ?>
    </div>
</body>
</html>