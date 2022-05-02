<?php
    function graphBar($connection, $canvasID, $title, $column, $maxval, $nBars = 10){
        if(null == $maxval){
            $maxQuery = ($connection -> query("select max($column) from naatik_clientes")) -> fetch();
            $maxval = $maxQuery["max($column)"];
        }
        // que rango representa cada una
        $steps = $maxval / $nBars;

        $values = array();


        for($i = 0; $i < $maxval; $i += $steps){
            // limite superior e inferior del rango
            $li = $i;
            $ls = $i + $steps;
            $query = ($i) ?
            "select count($column) from naatik_clientes where $column > $li and $column <= $ls" :
            // solo en la primer iteracion, el limite inferior (0), es inclusivo
            "select count($column) from naatik_clientes where $column >= $li and $column <= $ls";
            $results = ($connection -> query($query)) -> fetch();
            $value = $results["count($column)"];
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
        for($i = 0; $i < $maxval; $i += $steps){
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
        echo "<script> graphBar($valuesJS, $labelsJS, $backgrC, $borderC, '$canvasID', '$title') </script>";
    }
?>