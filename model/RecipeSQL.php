<?php

include_once 'Conection.php';

class RecipeSQL extends Conection {

    private $table = 'recipes';
            
    function __construct(){
        parent::__construct();
    }
    
    /*
    *   Devuelve el array de recetas de un usuario
    */
    public function get_recipe_by_user_id($id){
        if(gettype($id) != 'string'){
            return false;
        }
        //PREPARACION DEL QUERY
        $statement = $this->con->prepare("SELECT * FROM $this->table WHERE users_id = :id");
        //EJECUCION DEL QUERY PASANDO PARÁMETROS
		$statement->execute(array(':id' => $id));
		// El metodo fetch nos va a devolver el resultado o false en caso de que no haya resultado.
        return $statement->fetchAll();
    }


    /*
    *   Añade los datos de la receta en la base de datos, si devuelve true entonces hubo un error
    */
    public function add_recipe($image, $title, $ingredients, $steps, $comments, $user_id){
        if(gettype($user_id) != 'string' || gettype($image) != 'string' || gettype($title) != 'string' || gettype($comments) != 'string' || gettype($ingredients) != 'string' || gettype($steps) != 'string'){
            return false;
        }
        //PREPARACION DEL QUERY
        $statement = $this->con->prepare("INSERT INTO $this->table VALUES (null, :img, :title, :ingredients, :steps, :comments, :user, curdate())");
        //EJECUCION DEL QUERY PASANDO PARÁMETROS
		$statement->execute(array(
                    ':img' => $image,
                    ':title' => $title,
                    ':ingredients' => $ingredients,
                    ':steps' => $steps,
                    ':comments' => $comments,
                    ':user' => $user_id
                ));
	// Devolvemos el numero de filas afectadas
        return $statement->rowCount();
    }
    
    
    
    /*
    *   Devuelve todas ls recetas e la base de datos
    */
    public function get_all_recipes(){
        //PREPARACION DEL QUERY
        $statement = $this->con->prepare("SELECT r.*, u.username FROM $this->table AS r JOIN users AS u ON r.users_id=u.id");
        //EJECUCION DEL QUERY PASANDO PARÁMETROS
	    $statement->execute();
	    // El metodo fetch nos va a devolver el resultado o false en caso de que no haya resultado.
        return $statement->fetchAll();
    }
    
    
    
    /*
    *   Encargada de buscar una receta por su titulo en la base de datos
    */
    public function get_recipe_by_title($title){
        if(gettype($title) != 'string'){
            return false;
        }
        //PREPARACION DEL QUERY
        $statement = $this->con->prepare("SELECT r.*, u.username FROM $this->table AS r JOIN users AS u ON r.users_id=u.id WHERE r.title REGEXP :title");
        //EJECUCION DEL QUERY PASANDO PARÁMETROS
	$statement->execute(array(':title' => $title));
	// El metodo fetch nos va a devolver todos los resultado o false en caso de que no haya resultado.
        return $statement->fetchAll();
    }
    
    
    
    /*
    *   Devuelve una receta segun su id
    */
    public function get_recipe_by_id($id){
        //PREPARACION DEL QUERY
        $statement = $this->con->prepare("SELECT r.*, u.username FROM $this->table AS r JOIN users AS u ON r.users_id=u.id WHERE r.id = :id");
        //EJECUCION DEL QUERY PASANDO PARÁMETROS
	$statement->execute(array(
            ':id' => $id
        ));
	// El metodo fetch nos va a devolver el resultado o false en caso de que no haya resultado.
        return $statement->fetch();
    }
    
}

?>