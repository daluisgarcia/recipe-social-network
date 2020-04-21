<?php

include_once 'Conection.php';

class UserSQL extends Conection{

    private $table = 'users';
    
    function __construct(){
        parent::__construct();
    }

    
    /*
    *   Metodo que agrega un usuario y su contraseña a la base de datos
    */
    public function add_user($user, $pass, $email){
        if(gettype($user) != 'string'){
            return false;
        }
        //PREPARACION DEL QUERY
        $statement = $this->con->prepare("INSERT INTO $this->table VALUES (null, :user, :pass, :email)");
        //EJECUCION DEL QUERY PASANDO PARÁMETROS
        $statement->execute(array(
                ':user' => $user,
                ':pass' => $pass,
                ':email' => $email
            ));
        
        //Se devuelven el numero de filas afectadas con el query
        return $statement->rowCount();
    }



    /*
    *   Metodo que verifica existencia de un usuario y contraseña del mismo
    */
    public function log_user($user, $pass){
        if(gettype($user) != 'string' || gettype($pass) != 'string'){
            return false;
        }
        //PREPARACION DEL QUERY
        $statement = $this->con->prepare("SELECT * FROM $this->table WHERE username = :usuario AND pass = :password");
        //EJECUCION DEL QUERY PASANDO PARÁMETROS
        $statement->execute(array(
                ':usuario' => $user,
                ':password' => $pass
            ));
        //FETCH EN ESTE CASO DEVUELVE EL DATO BUSCADO
        return $statement->fetch();
    }



    /*
    *   Metodo que consulta en la base de datos si un nombre de usuario ya existe
    */
    public function consult_user($user){
        if(gettype($user) != 'string'){
            return false;
        }
        //PREPARACION DEL QUERY
        $statement = $this->con->prepare("SELECT * FROM $this->table WHERE username = :usuario");
        //EJECUCION DEL QUERY PASANDO PARÁMETROS
	$statement->execute(array(':usuario' => $user));
	// El metodo fetch nos va a devolver el resultado o false en caso de que no haya resultado.
        return $statement->fetch();
    }
    
    
    
    /*
    *   Metodo que devuelve a un usuario dado su id
    */
    public function consult_user_by_id($id){
        if(gettype($id) != 'string'){
            return false;
        }
        //PREPARACION DEL QUERY
        $statement = $this->con->prepare("SELECT * FROM $this->table WHERE id = :id");
        //EJECUCION DEL QUERY PASANDO PARÁMETROS
	$statement->execute(array(':id' => $id));
	// El metodo fetch nos va a devolver el resultado o false en caso de que no haya resultado.
        return $statement->fetch();
    }


    
    /*
    *   Metodo que verifica existencia de un usuario y contraseña del mismo
    */
    public function delete_user($user){
        if(gettype($user) != 'string'){
            return false;
        }
        //PREPARACION DEL QUERY
        $statement = $this->con->prepare("DELETE FROM $this->table WHERE username = :usuario");
        //EJECUCION DEL QUERY PASANDO PARÁMETROS
	$statement->execute(array(':usuario' => $user));
	//FETCH EN ESTE CASO NO DEBE DEVOLVER NADA SI LA OPERACION FUE EXITOSA
        return $statement->rowCount();
    }



    /*
    *   Devuelve el id del usuario dando su nombre
    */
    public function get_id_user($user){
        $statement = $this->con->prepare("SELECT id FROM $this->table WHERE username = :usuario");
        //EJECUCION DEL QUERY PASANDO PARÁMETROS
	$statement->execute(array(':usuario' => $user));
	// El metodo fetch nos va a devolver el resultado o false en caso de que no haya resultado.
        return $statement->fetch()['id'];
    }



    /*
    *   Busca y devuelve a un usuario segun un correo dado
    */
    public function consult_email($mail){
        if(gettype($mail) != 'string'){
            return false;
        }
        //PREPARACION DEL QUERY
        $statement = $this->con->prepare("SELECT * FROM $this->table WHERE email = :mail");
        //EJECUCION DEL QUERY PASANDO PARÁMETROS
	$statement->execute(array(':mail' => $mail));
	// El metodo fetch nos va a devolver el resultado o false en caso de que no haya resultado.
        return $statement->fetch();
    }
    
    
}

?>