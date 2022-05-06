<!DOCTYPE html>

<?php
    session_start();
    if (!isset($_SESSION['email'])) {
        header('Location: index.php');
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/contact.css">
    <link rel="stylesheet" href="styles/global.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&display=swap" rel="stylesheet"> 
    <title>Contactanos</title>
</head>
<body>

    <nav class="menu-nav">
        <div class="menu-nav-main">          
            <div class="menu-nav-header">
                <img src="imgs/naatik-logo.png" alt="Logo Naatik" class="naatik-logo">
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

    <div class="padre">
        <div class="formulario">
            <h3 class=contacto>Contáctanos</h3>
            <p class="frase">Estamos disponibles para ti todo el tiempo,<br> buscamos ofrecerte una respuesta rápida y<br>  efectiva para brindarte la mejor experiencia<br> posible.</p>
            <form action="contact.php" method="POST" class="form">
                <input type="text" name="asunto" id="" placeholder="Asunto" class="asunto">
                <?php
                    if(isset($_POST['asunto']) and empty($_POST['asunto']))
                        echo "<p class='error1'> Porfavor ingrese un asunto </p>";
                ?>
                <br>
                <textarea class="area_texto" name="msg" id="" cols="30" rows="10" placeholder="Escribe tu mensaje aquí"></textarea>
                <?php
                    if(isset($_POST['msg']) and empty($_POST['msg']))
                        echo "<p class='error2'> Porfavor ingrese un mensaje </p>";
                ?>
                <br>
                <input type="submit" value="Envíar mensaje" name="submitted" class="enviar">
            </form>
        </div>

            <div class="datos">
                <h3 class="contacto_datos">Contactos</h3>

                <div class="correo">
                    <img src="imgs/correo.png" class="cont_img">
                    <h4 class="cont_text">A01735407@tec.mx</h4>
                </div>

                <div class="telefono">
                    <img src="imgs/telefono.png" class="tel_img">
                    <h4 class="tel_text">+52 7971256553</h4>
                </div>

                <div class="horario">
                    <img src="imgs/reloj.png" class="hor_img">
                    <h4 class="hor_text">Lu - Vi / 09:00 - 20:00 hrs.</h4>
                </div>

                <div class="localizacion">
                    <img src="imgs/edificio.png" class="loc_img">
                    <h4 class="loc_text">Heroica Puebla de Zaragoza No. 7</h4>
                </div>
            </div>
    </div>

    <?php
        if(isset($_POST['submitted']) and !(empty($_POST['asunto'])) and !(empty($_POST['mensaje']))){
            session_start();
            // correo al que se desea mandar los mensajes de los clientes
            $to = "email@gmail.com";
            // correo desde donde se manda el correo
            $fromMail = "email@gmail.com";
            // email del usuario que mandó el mensaje
            $sender = $_SESSION['email'];
            $asunto = $_POST['asunto'];
            $mensaje = $_POST['msg'];
            // mensaje del correo a mandar
            $subject = "Nuevo mensaje de $sender: '$asunto'";
            // opcional
            // $headers = "From: $fromMail";

            // si el correo se mandó de forma exitosa
            if(mail($to, $asunto, $mensaje)){
                echo "<p> El mensaje se ha mandado de forma exitosa a Naatik, en breve nos pondremos en contacto";
            }
            // si hubo problemas para mandar el correo
            else{
                echo "<p> Hubo un problema a la hora de mandar el mensaje </p>";
            }
        }
    ?>
</body>
</html>