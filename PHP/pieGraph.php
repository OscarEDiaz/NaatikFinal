<?php


    function randomColors($n){
        $colors = array(
            "'rgb(8, 7, 92)'",
            "'rgb(7, 63, 136)'",
            "'rgb(0, 181, 214)'",
            "'rgb(0, 152, 142 )'",
            "'rgb(76, 182, 155)'",
            "'rgb(67, 99, 188)'"
        );

        $selected = array();

        for($i = 0; $i < $n; $i++){
            $rIndex = random_int(0, $n - 1);
            while(in_array($colors[$rIndex], $selected))
                $rIndex = random_int(0, $n - 1);
            array_push($selected, $colors[$rIndex]);
        }

        $colorsJS = '[';
        foreach($selected as $color){
            $colorsJS = $colorsJS . $color . ', ';
        }
        $colorsJS = $colorsJS . ']';
        return $colorsJS;
    }
    function graphPie($connection, $column, $canvasID){

        $query = 
        "select distinct $column from naatik_clientes natural join naatik_tipoContrato natural join naatik_tipoInternet natural join naatik_tipoPago;";
        $valuesQuery = ($connection -> query($query)) -> fetchAll(PDO::FETCH_ASSOC);
        $values = array();

        foreach($valuesQuery as $key => $value)
            array_push($values, $value["$column"]);

        sort($values);

        $counts = array();
        foreach($values as $value){
            $query =
            "select count($column) from naatik_clientes natural join naatik_tipoContrato natural join naatik_tipoInternet natural join naatik_tipoPago where $column = '$value';";
            $countStatement = ($connection -> query($query)) -> fetch();
            $count = $countStatement["count($column)"];
            array_push($counts, $count);
        }

        if($values == array(0, 1))
        $labels = ($column == "genero") ? array('Mujer', 'Hombre') : array('No', 'Sí');
        elseif($values == array(0, 1, 2))
        $labels = array('No', 'Sí', 'Sin servicio');
        else{
            $labels = array();
            foreach($values as $value){
                $splitCammel = preg_split('/(?=[A-Z])/', strval($value));
                $label = join(" ", $splitCammel);
                array_push($labels, $label);
            }
        }

        $colorsJS = randomColors(count($values));
        $dataJS = '[';
        foreach($counts as $count)
            $dataJS = $dataJS . strval($count) . ', ';
        $dataJS = substr($dataJS, 0, -2);
        $dataJS = $dataJS . ']';
        $labelsJS = '[';
        foreach($labels as $label)
        $labelsJS = $labelsJS . "'" . strval($label) . "'" . ', ';
        $labelsJS = substr($labelsJS, 0, -2);
        $labelsJS = $labelsJS . ']';

        $splitCammel = preg_split('/(?=[A-Z])/', strval($column));
        $title = join(" ", $splitCammel);
        echo "<script src='JS/graphPie.js'> </script>";
        echo "<script> graphPie('$canvasID', $dataJS, $labelsJS, $colorsJS, '$title') </script>";
    }
?>