<?php
    session_start();
    if (!isset($_SESSION['email']) or !($_SESSION['isAdmin'])) {
        header('Location: index.php');
    }
    require_once "PHP/credentials.php";
    $connection = new PDO("mysql:host=localhost;dbname=".$credential['DBName'], $credential['DBUser'], $credential['DBPass'],
    array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false)
    );
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change user passwords</title>
</head>
<body>
    <?php
    $email = $_GET['em'];
    ?>
    <form action="newPass.php" method="POST">
        <p>Ingrese una nueva contraseña para <?php echo $email; ?></p>
        <label for="pass">Ingrese la nueva contraseña</label>
        <input type="password" name="pass" id="pass">
        <?php 
            if(isset($_POST['pass']) and $_POST['pass'] == "")
            echo "<p> Ingrese una contraseña </p>";
        ?>
        <label for="passConf">Confirme la nueva contraseña</label>
        <input type="password" name="passConf" id="passConf">
        <?php 
            if(isset($_POST['passConf']) and $_POST['passConf'] == "")
            echo "<p> Ingrese la confirmación de la contraseña </p>";
        ?>
        <input type="submit" value="Cambiar contraseña" name="change">
    <?php
        if(isset($_POST['change']) and $_POST['pass'] != "" and $_POST['passConf'] != ""){
            if($_POST['pass'] != $_POST['passConf']){
                echo "<p> Las contraseñas deben de coincidir </p>";
            } else{
                try{
                    $password = $_POST['pass'];
                    $connection -> beginTransaction();
                    $statement = $connection -> prepare("UPDATE Naatik_User SET password = '$password' where email = '$email';");
                    $statement -> execute();
                    $connection -> commit();
                    echo "<p> La contraseña ha sido cambiada con éxito </p>";
                    header("Location: adminPage.php");
                }
                catch(Exception $e){
                    echo "<p> Hubo un error al actualizar la contraseña: $e";
                    header("Location: adminPage.php");
                }
            }
        }
    ?>
    </form>
</body>
</html>