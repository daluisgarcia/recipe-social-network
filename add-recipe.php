<?php   session_start();

    if(!isset($_SESSION["usuario"])){
        header("Location: index.php");
        die();
    }
    
    require './view/header.php';
    include 'config.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        $answer = '';
        $title = SANITIZE_STRING($_POST['title']);
        $ingredients = $_POST['ingredients'];
        $steps = $_POST['steps'];
        $comment = SANITIZE_STRING($_POST['comments']);

        if(empty($_FILES)){
            $answer .= '<li>Debe selecionar una imagen</li>';
        }else{
            //Se accede al nombre temporal del archivo para comprobar que sea una imagen
            $check = @getimagesize($_FILES['recipe_image']['tmp_name']);
            if ($check !== false){

                if(empty($title)){
                    $answer .= '<li>Debe ingresar un titulo</li>';
                }
                
                if(empty($ingredients)){
                    $answer .= '<li>Debe ingresar al menos un ingrediente</li>';
                }

                if(empty($steps)){
                    $answer .= '<li>Debe ingresar al menos un paso</li>';
                }

            }else{
                $answer .= '<li>Debe selecionar un archivo de tipo imagen o un archivo más liviano</li>';
            }
        }

        if ($answer == ''){
            
            //Se extrae unicamente el nombre de la imagen
            $name = substr($_FILES['recipe_image']['tmp_name'], strlen($_FILES['recipe_image']['tmp_name'])-9, 8);
            //Se estable el sitio donde se guardara la imagen
            $image = $name . '-' . $_FILES['recipe_image']['name'];

            require 'model/RecipeSQL.php';

            try{
                $connect = new RecipeSQL();
                $recipe_added = $connect->add_recipe($image, $title, $ingredients, $steps, $comment, (string)$_SESSION['id']);
            }catch(Exception $e){
                $recipe_added = false;
            }

            if(!$recipe_added){
                $answer .= '<li>Error al conectar con el servidor, intentelo mas tarde</li>';
            }else{
                //Funcion encargada de mover el archivo de su sitio temporal a una ruta elegida
                if(move_uploaded_file($_FILES['recipe_image']['tmp_name'], RECIPE_IMG_FOLDER . $image)){
                    header('Location: profile.php');
                    die();
                }else{
                    $answer .= '<li>Error al guardar el archivo</li>';
                }
            }
        }

    }

    require_once "./view/add-recipe.view.php";
    
    require './view/footer.php';
?>