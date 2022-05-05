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
            return $decoded['abandono'];
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
    <title>Simulador</title>
</head>
<body>
    <div id="container"></div>
    <script src="https://cdn.rawgit.com/kimmobrunfeldt/progressbar.js/0.9.0/dist/progressbar.js"></script>
    <script src="JS/semiCircle.js"></script>
    <?php
        $url = "https://6d7e-2806-10ae-11-8348-5838-dcf-3487-7c5a.ngrok.io?genero=1";
        $abandono = getAbandono($url) / 100;
        echo "<script> graphSemiCircle($abandono)</script>"
    ?>
</body>
</html>