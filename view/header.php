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

    <title>CookIT</title>

    <!--IMPORTACION DE FUENTE-->
    

    <!--DECLARACION ARCHIVOS DE BOOTSTRAP-->
    <link type="text/css" rel="stylesheet" href="./css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="./css/style.css">
    
</head>
<body>
    <header class=" container-fluid">
        <nav class="navbar navbar-expand navbar-light bg-light fixed-top">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <span class="h3">
                        <strong>Cook</strong><span>IT</span>
                    </span>
                </a>
                
                <div class="align-content-center">
                    <ul class="navbar-nav ">
                        <li class="nav-item mt-md-2">
                            Bienvenido
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['usuario'] ?></a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="profile.php">Perfil</a>
                                <a class="dropdown-item" href="add-recipe.php">Añadir imagen</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php">Cerrar Sesion</a>
                            </div>
                        </li>
                    </ul>
                </div>
                
            </div>
        </nav>
    </header>
    <br>
