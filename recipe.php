<?php   session_start();

    if(!isset($_SESSION["usuario"])){
        header("Location: index.php");
        die();
    }
    
    require './view/header.php';
    require 'config.php';
    
    if(isset($_GET['id'])){
        $recipe_id = SANITIZE_STRING($_GET['id']);
        require './model/RecipeSQL.php';
        require './model/UserSQL.php';
        try {
            $conn = new RecipeSQL();
            $recipe = $conn->get_recipe_by_id($recipe_id);
            if (empty($recipe)) {
                header('Location: index.php');
                die();
            }
        }catch (PDOException $e){
            $not = 'Error al conectar con servidor.';
        }
    }else{
        header('Location: index.php');
        die();
    }
    
    require './view/recipe.view.php';
    require './view/footer.php';
?>