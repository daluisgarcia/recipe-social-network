<?php   session_start();

//SI LA SESION ESTA INICIADA MANDA AL INDEX
if(isset($_SESSION["usuario"])){
    header("Location: index.php");
    die();
}

//SE COMPRUEBA QUE SE HAYA HECHO UN ENVIO DESDE LA PAGINA Y QUE SEA DE TIPO POST
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    require 'config.php';
    
    $usuario = SANITIZE_STRING(strtolower($_POST['usuario']));
    $pass = $_POST['pass'];

    $answer = '';

    if(empty($usuario)){
        $answer .= '<li>Debe ingresar un usuario</li>';
    }

    if(empty($pass)){
        $answer .= '<li>Debe ingresar su contraseña</li>';
    }else{
        //Encriptacion de pass
        $pass = ENCRYPT($pass);
    }

    //SI NO SE HA AGREGADO NINGUN ERROR
    if($answer == ''){
        try{
            require 'model/UserSQL.php';
            //CONEXION A LA BASE DE DATOS
            $conexion = new UserSQL();
            //VERIFICACION EN BASE DE DATOS
            $login = $conexion->log_user($usuario, $pass);
            if(empty($login)){
                $answer .= '<li>Usuario o contraseña incorrectos</li>';
            }else{
                $_SESSION['id'] = $conexion->get_id_user($usuario);
                $_SESSION['usuario'] = $usuario;
                header('Location: index.php');
                die();
            }
        } catch (PDOException $e) {
            $answer .= "<li>Error al conectar con el servidor, inténtelo mas tarde.</li>";
        }
        
    }

}

require "./view/login.view.php";
require './view/footer.php';

?>