<?php
    function graphBar($connection, $canvasID){
        // numero de barras
        $nBars = 5;
        // que rango representa cada una
        $steps = 100 / $nBars;

        $values = array();

        for($i = 0; $i < 100; $i += $steps){
            // limite superior e inferior del rango
            $li = $i;
            $ls = $i + $steps;
            $query = ($i) ?
            "select count(idCliente) from naatik_clientes where abandono > $li and abandono <= $ls" :
            // solo en la primer iteracion, el limite inferior (0), es inclusivo
            "select count(idCliente) from naatik_clientes where abandono >= $li and abandono <= $ls";
            $results = ($connection -> query($query)) -> fetch();
            $value = $results['count(idCliente)'];
            array_push($values, $value);
        }

        // string que contiene el arreglo que se le pasará a la función en JS
        $valuesJS = '[';
        foreach($values as $value){
            $valuesJS = $valuesJS . strval($value) . ', ';
        }
        $valuesJS = $valuesJS . ']';
        // string con arreglo de JS para los labels
        $labelsJS = '[';
        for($i = 0; $i < 100; $i += $steps){
            $li = $i;
            $ls = $i + $steps;
            $labelsJS = $labelsJS . "'$li - $ls', ";
        }
        $labelsJS = $labelsJS . ']';

        // se crean los colores de fondo y de borde de las barras
        // van progresando de verde a rojo
        $backgrC = '[';
        $borderC = '[';
        $opacidad = 0.3;
        $redSteps = 255 / ($nBars - 1);
        $greenSteps = (255 / ($nBars - 1)) * -1;
        for($i = 0, $r = 0, $g = 255; $i < $nBars; $i++, $r += $redSteps, $g += $greenSteps){
            $backgrC = $backgrC . "'rgba($r, $g, 0, $opacidad)', ";
            $borderC = $borderC . "'rgb($r, $g, 0)', ";
        }
        $backgrC = $backgrC . "]";
        $borderC = $borderC . "]";

        echo "<script src='JS/graphBar.js'> </script>";
        echo "<script> graphBar($valuesJS, $labelsJS, $backgrC, $borderC, $canvasID) </script>";
    }
?>