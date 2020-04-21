<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Tu red social para compartir y conseguir recetas de cocina">
    <meta name="keywords" content="cookit, recipes social net, red social de recetas">
    <meta name="author" content="Daniel Luis">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--IMPORTACION DE FAVICON-->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">

    <title>CookIT Inicio de Sesion</title>

    <!--IMPORTACION DE FUENTE-->
    

    <!--DECLARACION ARCHIVOS DE BOOTSTRAP-->
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="css/style.css">
    
</head>
<body>
    <header class=" container-fluid">
        <nav class="navbar navbar-expand navbar-light bg-light fixed-top">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <span class="h3 ">
                        <strong>Cook</strong><span>IT</span>
                    </span>
                </a>
                <div id="my-nav" class="align-content-center">
                    <ul class="navbar-nav ">
                        <li class="nav-item  mt-1">
                            No tienes una cuenta aun?
                        </li>
                        <li class="nav-item mx-1">
                            <a class="btn btn-primary text-light" href="register.php">Registrate</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="container mt-5 mb-4">
        <h1 class=" display-1 text-primary text-center">Inicio de Sesion</h1>

        <form class="container w-50 " method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class="form-group">
                <label for="usuario">Ingrese un nombre de usuario</label>
                <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario" value="<?php echo (isset($usuario)) ? $usuario : '' ; ?>">
            </div>
            <div class="form-group">
                <label for="pass">Ingrese su contraseña</label>
                <input type="password" class="form-control" id="pass" name="pass" placeholder="Contraseña">
            </div>
            <ul class=" text-light bg-error">
                <?php
                    echo (isset($answer)) ? $answer : '' ;
                ?>
            </ul>
            <div class="text-center">
                <button type="submit" class="btn btn-success">Iniciar Sesion</button>
            </div>
        </form>
        
    </div>
