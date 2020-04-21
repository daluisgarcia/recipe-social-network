
    <div class="container mt-5">
        <h1 class=" display-1 text-primary text-center">
            <strong>Añadir una receta</strong>
        </h1>

        <form id="add-recipe-form" class="container w-50 " method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
            <div class="form-group">
                <label for="image">Selecciona la imagen<span class="text-danger">*</span></label>
                <input type="file" class="form-control-file" id="recipe_image" name="recipe_image">
            </div>
            <div class="form-group">
                <label for="title">Nombre<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Nombre de tu receta" value="<?php echo (isset($title)) ? $title : '' ; ?>">
            </div>
            <div class="form-group">
                <label for="ingredients">Ingredientes<span class="text-danger">*</span></label>
                <div class="container">
                    <div class="row">
                        <input type="text" class="form-control col-11" id="ingredients" name="ingredients" placeholder="Añade un ingrediente">
                        <div class=" btn btn-light col-1 p-1 text-center" id="add-ingred" onclick="addItem('ingredients-list','ingredients')">
                            <img src="./img/add-icon.svg" class=" form-img">
                        </div>
                    </div>
                </div>    
                <ul id="ingredients-list" class="mt-2 w-90"><?php echo (isset($ingredients)) ? $ingredients : '' ; ?></ul>
            </div>
            <div class="form-group">
                <label for="steps">Pasos/Instrucciones<span class="text-danger">*</span></label>
                <div class="container">
                    <div class="row">
                        <input type="text" class="form-control col-11" id="steps" name="steps" placeholder="Añade un nuevo paso">
                        <div class=" btn btn-light col-1 p-1 text-center" id="add-step" onclick="addItem('steps-list','steps')">
                            <img src="./img/add-icon.svg" class=" form-img">
                        </div>
                    </div>
                </div>
                <ol id="steps-list" class="mt-2 w-90"><?php echo (isset($steps)) ? $steps : '' ; ?></ol>
            </div>
            <div class="form-group">
                <label for="descrip">Comentarios/Decripcion</label>
                <textarea class="form-control" id="comments" name="comments" placeholder="Breve descripcion o comentarios de tu receta"><?php echo (isset($comment)) ? $comment : '' ; ?></textarea>
            </div>
            <ul class=" text-light bg-error" id="error-zone">
                <?php
                    echo (isset($answer)) ? $answer : '' ;
                ?>
            </ul>
            <a href="profile.php" class="btn btn-danger ml-2">Volver</a>
            <button type="submit" class="btn btn-success float-right mr-2" id="btn-add-recipe">Subir imagen</button>
        </form>
        
    </div>

<script src="js/add-recipe.min.js"></script>
