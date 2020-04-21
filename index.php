<?php   session_start();

    if (isset($_SESSION["usuario"])){
        //PAGINA PRINCIPAL DE USUARIO
        header("Location: content.php");
        die();
    }

    require "./view/index.view.php";
    require './view/footer.php';

?>