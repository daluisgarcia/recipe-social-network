<?php   session_start();

if(isset($_SESSION["usuario"])){
    header("Location: index.php");
    die();
}

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $answer = '';

    try{
        require 'config.php';
        require_once 'model/UserSQL.php';
        $conexion = new UserSQL();
        $usuario = SANITIZE_STRING(strtolower($_POST['usuario']));
        $mail = SANITIZE_EMAIL(strtolower($_POST['email']));
        $pass = $_POST['pass'];
        $pass2 = $_POST['pass2'];

        if(empty($usuario)){
            $answer .= '<li>Debe ingresar un usuario</li>';
        }else{
            //CONSULTAMOS SI EL USUARIO EXISTE
            $user_existe = $conexion->consult_user($usuario);
            
            if ($user_existe){
                $answer .= '<li>Usuario existente</li>';
            }
        }

        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)){
            $answer .= '<li>Por favor ingrese un correo válido</li>';
        }else{
            //CONSULTAMOS SI EL EMAIL EXISTE
            $mail_existe = $conexion->consult_email($mail);
            
            if ($mail_existe){
                $answer .= '<li>Correo electrónico ya usado</li>';
            }
        }

        if(empty($pass)){
            $answer .= '<li>Debe ingresar una contraseña</li>';
        }else{
            //Encriptacion de pass
            $pass = ENCRYPT($pass);
        }

        if(empty($pass2)){
            $answer .= '<li>Debe rellenar el campo de segunda contraseña</li>';
        }else{
            //Encriptacion de pass2
            $pass2 = ENCRYPT($pass2);
            if($pass != $pass2){
                $answer .= '<li>Las contraseñas deben ser iguales</li>';
            }
        }
    } catch (PDOException $e) {
        $answer .= "<li>Error al conectar con el servidor, inténtelo más tarde.</li>";
    }
    

    if($answer == ''){
        //AÑADIMOS EL USUARIO EN LA BASE DE DATOS
        $added = $conexion->add_user($usuario, $pass, $mail);
        if(!$added){
            $answer .= '<li>Error al guardar en el servidor, intentelo más tarde</li>';
        }else{
            header('Location: login.php');
            die();
        }
    }

}

require "./view/register.view.php";

require './view/footer.php';

?>