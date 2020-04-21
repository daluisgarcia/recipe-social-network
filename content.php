<?php   session_start();

    if(!isset($_SESSION["usuario"])){
        header("Location: index.php");
        die();
    }
    
    require './view/header.php';
    include 'config.php';

    include_once 'model/RecipeSQL.php';
    include_once 'model/UserSQL.php';
    try {
        $connect = new RecipeSQL();

        $images = $connect->get_all_recipes();
        if (empty($images)) {
            $not = 'No se han encontrado recetas, intentelo de nuevo.';
        }
    }catch (PDOException $e){
        $not = 'No se han encontrado recetas, error al conectar con servidor.';
    }

    require "./view/content.view.php";
    
    require './view/footer.php';
?>