<?php

function generalView($connection){
    $headersList = array(
        "Client ID",
        "Género",
        "Es jubilado",
        "Tiene pareja",
        "Tiene dependientes",
        "Meses como cliente",
        "Tiene servicio de telefono",
        "Tiene multiples lineas",
        "Servicio de Internet",
        "Seguridad en linea",
        "Backup en linea",
        "Proteccion dispositivo",
        "Soporte técnico",
        "Streaming de TV",
        "Streaming de Peliculas",
        "Contrato",
        "Factura electronica",
        "Metodo pago",
        "Cargo mensual ($)",
        "Cargos totales ($)",
        "Probabilidad de abandono ($)"
    );
    echo "<div class=\"churn-table-container\">";
    echo "<table class='churn'>";

    echo "<tr>";
        foreach($headersList as $header){
            echo "<th class='churn-header'> $header </th>";
        }
    echo "</tr>";

    $query = 
        "select idCliente, genero, esJubilado, tienePareja, tieneDependientes, mesesComoCliente, tieneServTelefono, tieneMulLineas, internet, seguridadEnLinea, backupEnLinea, proteccionDispositivo, soporteTecnico, streamingTV, streamingPeliculas, contrato, facturaElectronica, pago, cargoMensual, cargosTotales, abandono from naatik_clientes natural join naatik_tipoContrato natural join naatik_tipoInternet natural join naatik_tipoPago;";
    $resultados = $connection -> prepare($query);
    $resultados -> execute();
    $resultados = ($resultados -> fetchAll(PDO::FETCH_ASSOC));
    foreach ($resultados as $resultado) {
        echo "<tr>";
        foreach ($resultado as $key => $value){
            switch ($key) {
                case "genero":
                    $s = (($value) ? "Hombre" : "Mujer");
                    echo "<td class='churn-data'>".$s."</td>";
                    break;

                case "esJubilado":
                case "tienePareja":
                case "tieneDependientes":
                case "tieneServTelefono":
                case "facturaElectronica":
                    $s = (($value) ? "Sí" : "No");
                    echo "<td class='churn-data'>".$s."</td>";
                    break;
                case "tieneMulLineas":
                    if($value == 0)
                        $s = "No";
                    elseif($value == 1)
                        $s = "Sí";
                    else
                        $s = "Sin servicio de teléfono";
                    echo "<td class='churn-data'>".$s."</td>";
                    break;
                case "seguridadEnLinea":
                case "backupEnLinea":
                case "proteccionDispositivo":
                case "soporteTecnico":
                case "streamingTV":
                case "streamingPeliculas":
                    if($value == 0)
                        $s = "No";
                    elseif($value == 1)
                        $s = "Sí";
                    else
                        $s = "Sin servicio de internet";
                        echo "<td class='churn-data'> $s</td>";
                        break;
                default:
                    echo "<td class='churn-data'> $value </td>";
                }
            }
        echo "</tr>";
    }

    echo "</table>";
    echo "</div>";
}

function churnView($connection){
    ?>
    <form action="churn.php?selectedTable=Churn+rate" method="POST">
        <label for="sortby">Ordenar por</label>
        <select id='sortby' onchange='this.form.submit()' name='sorting'>
            <?php 
                $sortingInp = isset($_POST['sorting']) ? $_POST['sorting'] : 1;
            ?>
            <option value="1" <?php if($sortingInp == 1) echo "selected";?>>Client ID - Menor a mayor</option>
            <option value="2" <?php if($sortingInp == 2) echo "selected";?>>Client ID - Mayor a menor</option>
            <option value="3" <?php if($sortingInp == 3) echo "selected";?>>Churn rate - Menor a mayor</option>
            <option value="4" <?php if($sortingInp == 4) echo "selected";?>>Churn rate - Mayor a menor</option>
        </select>
        <noscript><input type="submit" value="Submit"></noscript>
    </form>
    <div class="churn-table-container">
    <table class='churn'>
        <tr>
            <th class='churn-header'> Client ID </th>
            <th class='churn-header'> % de Abandono </th>
        </tr>

    <?php
    $sortingSelected = (isset($_POST['sorting'])) ? $_POST['sorting'] : 1;
    switch($sortingSelected){
        case 1:
            $sqlSort = "order by idCliente";
            break;
        case 2:
            $sqlSort = "order by idCliente desc";
            break;
        case 3:
            $sqlSort = "order by abandono";
            break;
        case 4:
            $sqlSort = "order by abandono desc";
            break;
    }
    $query = "select idCliente, abandono from naatik_clientes $sqlSort";
    $resultados = $connection -> prepare($query);
    $resultados -> execute();
    $resultados = $resultados -> fetchAll(PDO::FETCH_ASSOC);

    foreach($resultados as $resultado){
        echo "<tr>";
        foreach($resultado as $key => $value){
            echo "<td class='churn-data'> $value </td>"; 
        }
        echo "</tr>";
    }
    ?>
    </table>
    </div>
    <?php
}

function dataView($connection){
    $columnsGraphToPie = array();
    // 
    // $query = 
    // "select genero, esJubilado, tienePareja, tieneDependientes, mesesComoCliente, tieneServTelefono, tieneMulLineas, internet, seguridadEnLinea, backupEnLinea, proteccionDispositivo, soporteTecnico, streamingTV, streamingPeliculas, contrato, facturaElectronica, pago from naatik_clientes natural join naatik_tipoContrato natural join naatik_tipoInternet natural join naatik_tipoPago;";
    require_once "barGraph.php";
    require_once "pieGraph.php";
    // genero tinyint not null,
    // esJubilado tinyint not null,
    // tienePareja tinyint not null,
    // tieneDependientes tinyint not null,
    // mesesComoCliente int not null,
    // tieneServTelefono tinyint not null,
    // tieneMulLineas tinyint not null,
    // internet int not null,
    // seguridadEnLinea tinyint not null,
    // backupEnLinea tinyint not null,
    // proteccionDispositivo tinyint not null,
    // soporteTecnico tinyint not null,
    // streamingTV tinyint not null,
    // streamingPeliculas tinyint not null,
    // contrato int not null,
    // facturaElectronica tinyint not null,
    // pago int not null,
    // abandono decimal(5, 2) not null,
    // echo "<canvas id='churnBar'></canvas>";
    echo "<div class ='leftContent'>
            <canvas id='cargosmBar'></canvas>

            <canvas id='generoPie'></canvas>
            <canvas id='jubiladoPie'></canvas>
            <canvas id='parejaPie'></canvas>
            <canvas id='dependientesPie'></canvas>
            <canvas id='telefonoPie'></canvas>
            <canvas id='lineasPie'></canvas>
            <canvas id='internetPie'></canvas>
            <canvas id='seguridadPie'></canvas>

        </div>";
    echo "<div class ='rightContent'>
            <canvas id='cargostBar'></canvas>

            <canvas id='backupPie'></canvas>
            <canvas id='proteccionPie'></canvas>
            <canvas id='soportePie'></canvas>
            <canvas id='tvPie'></canvas>
            <canvas id='peliculasPie'></canvas>
            <canvas id='contratoPie'></canvas>
            <canvas id='facturaPie'></canvas>
            <canvas id='pagoPie'></canvas>
        </div>";
    // graphBar($connection, "churnBar", "Histograma - CHURN rate", 'abandono', 'Rango de % de abandono', 'Cantidad de clientes', 100, 10);
    graphBar($connection, "cargosmBar", "Histograma - Cargos mensuales", 'cargoMensual', 'Rango de cargo mensual ($)', 'Cantidad de clientes', null, 5);
    graphBar($connection, "cargostBar", "Histograma - Cargos totales", 'cargosTotales', 'Rango de cargos todales ($)', 'Cantidad de clientes', null, 5);
    
    graphPie($connection, 'genero', 'generoPie');
    graphPie($connection, 'esJubilado', 'jubiladoPie');
    graphPie($connection, 'tienePareja', 'parejaPie');
    graphPie($connection, 'tieneDependientes', 'dependientesPie');
    graphPie($connection, 'tieneServTelefono', 'telefonoPie');
    graphPie($connection, 'tieneMulLineas', 'lineasPie');
    graphPie($connection, 'internet', 'internetPie');
    graphPie($connection, 'seguridadEnLinea', 'seguridadPie');
    graphPie($connection, 'backupEnLinea', 'backupPie');
    graphPie($connection, 'proteccionDispositivo', 'proteccionPie');
    graphPie($connection, 'soporteTecnico', 'soportePie');
    graphPie($connection, 'streamingTV', 'tvPie');
    graphPie($connection, 'streamingPeliculas', 'peliculasPie');
    graphPie($connection, 'contrato', 'contratoPie');
    graphPie($connection, 'facturaElectronica', 'facturaPie');
    graphPie($connection, 'pago', 'pagoPie');

}

function intervencionView($connection){
    echo "<img src='sl.gif' alt=''>";
}
?>
