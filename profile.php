<?php   session_start();

    if(!isset($_SESSION["usuario"])){
        header("Location: index.php");
        die();
    }
    
    require './view/header.php';
    include 'config.php';

    include_once 'model/RecipeSQL.php';

    $connect = new RecipeSQL();

    $images = $connect->get_recipe_by_user_id($_SESSION["id"]);

    require "./view/profile.view.php";
    
    require './view/footer.php';
?>