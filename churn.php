<?php
    $DBName = "Naatik";
    $DBUser = "Oscar";
    $DBPass = 'oscar123';
    $connection = new PDO("mysql:host=localhost;dbname=$DBName", $DBUser, $DBPass,
    
    array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false)
    );

    $sql_tables = $connection -> prepare("SHOW TABLES FROM Naatik");
    $sql_tables -> execute();
    $tablesNames = $sql_tables -> fetchAll(PDO::FETCH_ASSOC);

    $tables_array = array();

    foreach ($tablesNames as $index => $array) {
        foreach ($array as $column_name => $table){
            array_push($tables_array, $table);
        }
    }

    $default = 'naatik_clientes';

    foreach ($tables_array as $table) {
        if(isset($_POST[$table])){
            $default = $table;  
        }  
    }
    

    $sql_headers = $connection -> prepare("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'Naatik' AND TABLE_NAME = ?");
    $sql_headers -> execute(array($default));

    $headers = $sql_headers -> fetchAll(PDO::FETCH_ASSOC);



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
    <title>ChURN RATE</title>
</head>
<body>
    <nav class="menu-nav">
        <div class="menu-nav-main">          
            <div class="menu-nav-header">
                <img src="imgs/naatik-logo.png" alt="Logo Naatik" class="naatik-logo">
                <h1 class="menu-nav-h1">Naatik</h1>
            </div>
            <a href="" class="logout">Cerrar sesión</a>
        </div>
    </nav>
    <section class="main-database" id="maindb">
        <div class="main-database-container">
            <div class="database-sidebar">
                <div class="tables-h2-container">
                    <svg class="table-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M448 32C483.3 32 512 60.65 512 96V416C512 451.3 483.3 480 448 480H64C28.65 480 0 451.3 0 416V96C0 60.65 28.65 32 64 32H448zM224 256V160H64V256H224zM64 320V416H224V320H64zM288 416H448V320H288V416zM448 256V160H288V256H448z"/></svg>
                    <h2 class="tables-h2">Tablas</h2>
                </div>
                <form class="tables-names" method="POST" action="churn.php">    
                    <?php
                        foreach ($tables_array as $table){
                            echo "<div class='table-opt'><p class='table-name'>".$table."</p><input type='submit' class='input-opt' value='' name='".$table."'></div>";
                        }
                    ?>
                </form>
            </div>
            <div class="database-table-container">
                <div class="churn-container">
                    <table class="churn">
                        <tr>
                            <?php
                                $columnNames = array();
                                foreach ($headers as $index => $array) {
                                    foreach ($array as $column_name => $header){
                                        echo "<th class='churn-header'>".$header."</th>";
                                        array_push($columnNames, $header);
                                    }
                                }
                            ?>
                        </tr>
                        <?php
        
                            $query =  "SELECT * FROM $default";
                            foreach ($connection -> query($query) as $row) {
                                echo "<tr>";
                                    foreach ($columnNames as $name) {
                                        echo "<td class='churn-data'>".$row[$name]."</td>";
                                    }
                                echo "</tr>";
                            }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </section>
</body>
</html>