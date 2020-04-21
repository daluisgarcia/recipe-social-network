    <div class="container mt-5">
        <div class="row pt-4 ">
            <div class="col-12 text-center">
                <form class="form-inline" action="" method="">
                    <select id="feature" class="form-control mr-3" name="feature">
                        <option selected value="default">Destacados del dia</option>
                        <option value="otra">...</option>
                    </select>
                    <select id="category" class="form-control mr-3" name="category">
                        <option selected value="default">Categorias</option>
                        <option value="otra">...</option>
                    </select>
                    <input class="form-control mr-sm-1" type="search" placeholder="Busca un titulo" aria-label="Search" id="search" name="search">
                    <button class="btn btn-outline-success" type="submit" id="search-btn">Buscar</button>
                </form>
            </div>
        </div>
        <div class="row pt-3" id="content">
            <?php foreach($images as $img): ?>
                <div class="card shadow-sm mb-3 col-12" id="card">
                    <div class="row no-gutters border-bottom" id="row1">

                        <div class="col-md-4" id="col1">
                            <a href="recipe.php?id=<?php echo $img['id'] ?>">
                                <img class="card-img-left form-img" src="<?php echo RECIPE_IMG_FOLDER . $img['image_path'] ?>" alt="Imagen de receta">
                            </a>
                        </div>

                        <div class="col-md-8" id="col2">
                            <div class="card-body">

                                <div class="border-bottom">
                                    <a href="recipe.php?id=<?php echo $img['id'] ?>">
                                        <h2 class="card-title font-weight-bold text-dark"><?php echo $img['title'] ?></h2>
                                    </a>
                                </div>

                                <div class="row card-text mt-2">
                                    <div class="col-5">
                                        <h4 class="ml-2">Ingredientes:</h4>
                                        <ul>
                                            <?php echo $img['ingredients'] ?>
                                        </ul>
                                    </div>
                                    <div class="col-7">
                                        <h4 class="ml-2">Pasos a seguir:</h4>
                                        <ol>
                                            <?php echo $img['steps'] ?>
                                        </ol>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                    </div>

                    <div class="card-body" id="row2">
                        <div class="m-2">
                            <?php echo $img['comments'] ?>
                        </div>
                    </div>

                    <div class="card-footer text-muted" id="row3">
                        <div class="row">
                            <a href="#" class="col-6"><?php echo $img['username'] ?></a>
                            <div class="col-6 text-right">
                                <small><?php echo $img['date'] ?></small>
                            </div>
                        </div>
                    </div>

                </div>
            
            <?php endforeach; ?>
        </div>
        <div class="row">
            <h1 class="m-auto" id="no-content">
                <?php echo (isset($not))? $not : '';?>
            </h1>
        </div>
    </div>
    <script type="module" src="./js/contentSearch.min.js"></script>