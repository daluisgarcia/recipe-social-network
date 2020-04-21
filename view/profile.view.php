
    <div class="container mt-5">
        <div class="row pt-4 border-bottom p-2 text-center">
            <div class=" col-12">
                <img src="./img/profile-icon.svg" style="width: 100px;">
            </div>
            <div class=" col-12 display-4 text-capitalize">
                <span class="">
                    <?php echo $_SESSION['usuario'] ?>
                </span>
            </div>
            <div class=" col-12">
                <a class="btn btn-primary mt-3" href="add-recipe.php">Añadir Receta</a>
            </div>
        </div>
        <div class="row mt-2">
            <?php foreach($images as $img): ?>
                <div class="col-6 col-md-4 text-center" >
                    <div class="mt-2 border shadow-sm">
                        <a  href="recipe.php?id=<?php echo $img['id'] ?>">
                            <img class=" p-img" src="<?php echo RECIPE_IMG_FOLDER . $img['image_path'] ?>" title="<?php echo $img['title'] ?>" alt="<?php echo $img['title'] ?>">
                            <div class=" text-center h2"><?php echo $img['title'] ?> </div>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>