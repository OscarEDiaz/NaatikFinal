<?php
    session_start();
    if (!isset($_SESSION['email'])) {
        header('Location: index.php');
    }

    require_once "PHP/credentials.php";
    $GLOBALS['connection'] = new PDO("mysql:host=localhost;dbname=".$credentialsRoot['DBName'], $credentialsRoot['DBUser'], $credentialsRoot['DBPass'],
    array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false)
    );

    $tables_array = array();

    $optNames = array(
        "General",
        "Visualización de datos",
        "Métodos de intervención"
    );
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/churn.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&display=swap" rel="stylesheet"> 
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>CHURN RATE</title>
</head>
<body>
    <nav class="menu-nav">
        <div class="menu-nav-main">          
            <div class="menu-nav-header">
                <a href="menu.php">
                    <img src="imgs/naatik-logo.png" alt="Logo Naatik" class="naatik-logo">
                </a>
                <h1 class="menu-nav-h1">Naatik</h1>
            </div>
            <form class="logout" action="menu.php" method="POST">
                <button name="closeSesion" type="submit">Cerrar sesión</button>
            </form>
            <?php
                if(isset($_POST['closeSesion'])){
                    session_destroy();
                    header("Location: index.php");
                }
            ?>
        </div>
    </nav>
    <section class="main-database" id="maindb">
        <div class="main-database-container">
            <div class="database-sidebar">
                <div class="tables-h2-container">
                    <svg class="table-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M448 32C483.3 32 512 60.65 512 96V416C512 451.3 483.3 480 448 480H64C28.65 480 0 451.3 0 416V96C0 60.65 28.65 32 64 32H448zM224 256V160H64V256H224zM64 320V416H224V320H64zM288 416H448V320H288V416zM448 256V160H288V256H448z"/></svg>
                    <h2 class="tables-h2">Tablas</h2>
                </div>      
                <form class="tables-names" method="GET" action="churn.php">    
                    <?php
                        foreach ($optNames as $option){
                            echo "<div class='table-opt'><input type='submit' class='input-opt' value='$option' name ='selectedTable'></div>";
                        }
                    ?>
                </form>
            </div>
            <div class="database-table-container">
                <?php
                    $currentTable = (isset($_GET['selectedTable'])) ? $_GET['selectedTable'] : "General";
                ?>
                <div class="churn-container">
                    <?php 
                        require_once "PHP/viewContent.php";
                        switch($currentTable){
                            case "General":
                                generalView($connection);
                                break;
                            case "Visualización de datos":
                                dataView($connection);
                                break;
                            case "Métodos de intervención":
                                echo "aún no :(";
                                echo "<br>";
                                intervencionView($connection);
                                break;
                        }
                    ?>
                </div>
            </div>
        </div>
    </section>
</body>
</html>