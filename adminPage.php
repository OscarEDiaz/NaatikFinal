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
    if(isset($_GET['del'])){
        $userToDelete = $_GET['del'];
        $delQuery = "delete from Naatik_User where email = '$userToDelete'";
        $connection -> query($delQuery);
    }
    // seleccionar a todos los usuarios que no tienen permisos de administrador
    $query = "select * from Naatik_User where adminprivs = 0";

    $statement = $connection -> query($query);
    $users = $statement -> fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/adminpage.css">
    <title>Admin Page</title>
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
<table>
    <thead>
        <tr>
            <th>User ID</th>
            <th>email</th>
        </tr>
    </thead>
    <tbody>
    <?php
    foreach($users as $user){
        $idUser = $user['idUser'];
        $email = $user['email'];
        echo "<tr>";
        echo "<td>" . $idUser . "</td>";
        echo "<td>" . $email . "</td>";
        echo "<td> 
                <a href='newPass.php?em=$email'> <button> Cambiar contraseña </button>  </a>
                <a href='adminPage.php?del=$email'> <button> Eliminar usuario </button>  </a>
            </td>";
        echo "</tr>";
    } 
    ?> 
    </tbody>
    </table>
</body>
</html>