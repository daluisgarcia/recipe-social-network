<?php   session_start();

    if(!isset($_SESSION["usuario"])){
        header("Location: index.php");
        die();
    }

    include 'config.php';

    error_reporting(0);	//EVITAR MUESTRA DE ERRORES
    header('Content-type: application/json; charset=utf-8');    //ESTABLECE LA PAGINA COMO UN VISOR DE JSON

    define('NO_CONTENT_FOUND', 'No se se han encontrado resultados.');

    $search = $_GET['search'];
    $feature = $_GET['feature'];
    $category = $_GET['category'];
    $answer = '';

    if ($search !== '') {
        $search = SANITIZE_STRING(strtolower($search));
    }else{
        $answer = ['error' => NO_CONTENT_FOUND];
    }

    if ($feature !== '') {
        $feature = SANITIZE_STRING(strtolower($feature));
    }else{
        $answer = ['error' => NO_CONTENT_FOUND];
    }

    if ($category !== '') {
        $category = SANITIZE_STRING(strtolower($category));
    }else{
        $answer = ['error' => NO_CONTENT_FOUND];
    }

    include_once './model/RecipeSQL.php';
    include_once './model/UserSQL.php';

    if ($answer == '') {
        try {
            $con = new RecipeSQL();
            $connect = new UserSQL;

            $recipes = $con->get_recipe_by_title($search);

            if (empty($recipes)) {
                $answer = ['error' => NO_CONTENT_FOUND];
            } else {
                $answer = $recipes;
            }
        } catch (PDOException $e) {
            $answer = ['error' => 'Error al conectar a la base de datos'];
        }
    }

    echo json_encode($answer);

?>
