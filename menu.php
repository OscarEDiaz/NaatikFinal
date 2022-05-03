<?php
    session_start();
    if (!isset($_SESSION['email'])) {
        header('Location: index.php');
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&display=swap" rel="stylesheet"> 
    <title>Menu</title>
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
    <section class="main-menu">
        <div class="header-container">
            <h1 class="main-menu-header">Menú principal</h1>
            <p>Escoge la herramienta que se acople a tus necesidades.</p>
        </div>
        <div class="cards-container">
            <?php 
                $titles = array('Churn Rate', 'Simulador', '#');
                $paragraphs = array('Un análisis estadístico de los perfiles de tus clientes, prevee y toma las mejores decisiones.', 'Crea perfiles específicos de tus clientes e identifica el momento oportuno para recuperar su lealtad.', '3');
                $classes = array('c1', 'c2', 'c3');
                $direcciones = array('churn.php','#','#');

                for ($i = 0; $i < 3; $i++) {
                    echo 
                    "<div class='card $classes[$i]'>
                        <div class='card-content'>
                            <h2 class='card-title'>$titles[$i]</h2>
                            <p class='card-body'>$paragraphs[$i]</p>
                            <a href='$direcciones[$i]' class='card-btn'>Iniciar</a>
                        </div>
                    </div>";
                }
            ?>
        </div>
    </section>
</body>
</html>