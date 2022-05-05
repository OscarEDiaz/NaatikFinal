<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactanos</title>
</head>
<body>
    <form action="contact.php" method="POST">
        <input type="text" name="asunto" id="" placeholder="Asunto">
        <?php
            if(isset($_POST['asunto']) and empty($_POST['asunto']))
                echo "<p> Porfavor ingrese un asunto </p>";
        ?>
        <br>
        <textarea name="msg" id="" cols="30" rows="10" placeholder="Mensaje"></textarea>
        <?php
            if(isset($_POST['msg']) and empty($_POST['msg']))
                echo "<p> Porfavor ingrese un mensaje </p>";
        ?>
        <br>
        <input type="submit" value="Envíar mensaje" name="submitted">
    </form>
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