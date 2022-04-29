<?php
    $DBName = "Naatik";
    $DBUser = "Oscar";
    $DBPass = 'oscar123';
    $connection = new PDO("mysql:host=localhost;dbname=$DBName", $DBUser, $DBPass,
    
    array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false)
    );

    if(isset($_POST['password']) && isset($_POST['email'])){
        $emailInp = $_POST['email'];
        $passwordInp = $_POST['password'];

        $sql = $connection -> prepare('select * from Naatik_User where email = ?');
        $sql -> execute(array($emailInp));
        $usuarioQuery = $sql -> fetch();

        $correoRegistrado = ($usuarioQuery) ? true : false;

        if($correoRegistrado){
            $sql = $connection -> prepare('select * from Naatik_User where email = ?');
            $sql -> execute(array($emailInp));
            $usuarioQuery = $sql -> fetch();
            $contrasena = $usuarioQuery['password'];
            $userID = $usuarioQuery['userID'];
            
            if($contrasena == $passwordInp){
                header("Location: menu.php");
            } else{
                $contrasenaIncorrecta = true;
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="styles/index.css">
    <title>Naatik</title>
</head>
<body>
    <section class="login-page">
        <div class="login-main-container">
            <div class="login-header">
                <div class="circle c1"></div>
                <div class="circle c2"></div>
                <div class="circle c3"></div>
                <div class="circle c4"></div>
                <div class="circle c5"></div>
                <div class="circle c6"></div>
                <div class="circle c7"></div>
                <div class="circle c8"></div>
                <div class="login-title">
                    <div class="login-headers">
                        <h1 class="login-h1 login-h">Churn Rate</h1>
                        <h2 class="login-h2 login-h">Naatik</h2>
                        <ul class="login-subs">
                            <li>Databases</li>
                            <li>Client</li>
                            <li>Simulator</li>
                        </ul>
                    </div>
                </div>
                <div class="login-footer">
                    <div class="login-footer-title">
                        <img src="imgs/naatik-logo.png" alt="" class="naatik-logo">
                        <p>Naatik</p>
                    </div>
                </div>
            </div>
            <div class="login-form-section">
                <div class="login-form-main-container">
                    <div class="login-form-headers">
                        <h1 class="login-form-h1">Bienvenidos a <span class="naatik-h1">Naatik</span></h1>
                        <h2 class="login-form-h2">La solución perfecta para mantenerte <br> al tanto de tus clientes</h2>
                        <div class="blue-line"></div>
                    </div>
                    <form class="login-form" action="index.php" method="post">
                        <div class="email">
                            <h1 class="email-h1">Email</h1>
                            <input type="email" name="email" placeholder="Email" class="input-login email-inp">
                            <?php
                                if(isset($_POST['email'])){
                                    if($_POST['email'] == ""){
                                        echo "<span class='?'> Ingrese un correo </span>";
                                    }
                                    elseif(isset($correoRegistrado)){
                                        if(!$correoRegistrado && $emailInp != ""){
                                            echo "<span class='?'> Correo no registrado </span>";
                                        }
                                    }
                                }
                            ?>
                        </div>
                        <input type="password" name="password" placeholder="Contraseña" class="input-login">
                        <?php
                            if(isset($_POST['password'])){
                                if($_POST['password'] == ""){
                                    echo "<span class='?'> Ingrese una contraseña </span>";
                                }
                                elseif(isset($contrasenaIncorrecta)){
                                    echo "<span class='?'> Contraseña incorrecta </span>";
                                }
                            }
                        ?>
                        <input type="submit" value="Login" class="login-submit">
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
