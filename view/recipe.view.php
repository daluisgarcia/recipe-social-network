    <div class="container mt-5">
        <div class="row pt-3 mb-2 border">
            <div class="col-7">
                <img src="<?php echo RECIPE_IMG_FOLDER . $recipe['image_path'] ?>" class="w-100" title="<?php echo $recipe['title'] ?>" alt="Imagen de <?php echo $recipe['title'] ?>">
            </div>
            <div class="col-5 my-auto">
                <div class="m-auto">
                    <h2 class="border-bottom text-center pb-1"><?php echo $recipe['title'] ?></h2>
                    <a href="" class="float-left"><?php echo $recipe['username']?></a>
                    <small class=" float-right"><?php echo $recipe['date'] ?>"</small>
                </div>
            </div>
        </div>
        <div class="row mb-1 border">
            <div class="col-12">
                <h3>Ingredientes:</h3>
                <ul>
                    <?php echo $recipe['ingredients'] ?>
                </ul>
            </div>
        </div>
        <div class="row mb-1">
            <div class="col-12 border">
                <h3>Pasos a seguir:</h3>
                <ol>
                    <?php echo $recipe['steps'] ?>
                </ol>
            </div>
        </div>
        <div class="row">
            <?php if($recipe['comments'] != ''): ?>
                <div class="col-12 border">
                    <h3>Comentarios del autor:</h3>
                    <ol>
                        <?php echo $recipe['comments'] ?>
                    </ol>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <h1 class="m-auto" id="no-content">
        <?php echo (isset($not))? $not : '';?>
    </h1>
    