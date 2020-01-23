<?php require APPROOT . '/app/views/inc/header.php';?>
<?php flash('msg');?>
</div>
    <div id="slider" class="carousel slide wow zoomIn" data-ride="carousel">
        <ol class="carousel-indicators">
        <?php for ($i = 0; $i < count($data['slides']); $i++): ?>
            <li data-target="#slider" data-slide-to="<?php echo $i; ?>" class="<?php echo ($i == 0) ? 'active' : ''; ?>"></li>
        <?php endfor;?>
        </ol>
        <div class="carousel-inner">
        <?php foreach ($data['slides'] as $key => $slider): ?>
            <div class="carousel-item <?php echo ($key == 0) ? 'active' : ''; ?>">
                <a href="<?php echo empty($slider->url) ? '' : $slider->url; ?>">
                    <img class="d-block w-100" src="<?php echo MEDIAURL . '/' . $slider->image; ?>" alt="<?php echo $slider->name; ?>">
                    <div class="carousel-content">
                        <?php echo empty($slider->name) ? '' : '<h1 class ="carousel-title">' . $slider->name . "</h1>\n"; ?>
                        <?php echo empty($slider->description) ? '' : '<p class ="carousel-description">' . $slider->description . "</p>\n"; ?>
                    </div>
                </a>
            </div>
        <?php endforeach;?>
        </div>
        <a class="carousel-control-prev" href="#slider" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#slider" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div class="container">
    <!--- carousel  end --->
    <!--- Products Start --->
    <section id="products">
        <div class="row mt-4 ">
            <div class="col">
                <h3 class="text-center">
                    <img src="<?php echo URLROOT; ?>/templates/default/images/namaa-icon.png" alt="namaa-icon" class="ml-1">
                    المنتجات</h3>
            </div>
        </div>
        <div class="row">
            <?php foreach ($data['projects'] as $project): ?>
            <div class="product col-12 col-xl-4 col-md-6 mt-3 wow zoomIn">
                <div class="card">
                    <img class="card-img-top" src="<?php echo (empty($project->img)) ? MEDIAURL . '/default.jpg' : MEDIAURL . '/' . $project->img; ?>" alt="<?php echo $project->name; ?>">
                    <div class="body-card m-2">
                        <p class="card-text"><?php echo mb_substr(strip_tags($project->description), 0, 100); ?>. </p>
                    </div>
                    <?php if (!empty($project->target_price)): ?>
                    <div class=" px-2">
                        <div class="small text-left">
                            المستهدف <?php echo $project->target_price ?> ريال
                        </div>
                        <div class="progress ">
                            <div class="progress-bar  progress-bar-striped" role="progressbar" style="width: 50%;"
                                aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
                        </div>
                    </div>
                    <?php endif;?>
                    <div class="card-footer bg-primary mt-1">
                        <div class="  ">
                            <a href="<?php echo URLROOT . '/projects/show/' . $project->project_id . '-' . $project->name; ?>" class="card-text"><i class="icofont-files-stack"></i> التفاصيل</a>
                            <a href="<?php echo URLROOT . '/cart/' . $project->project_id; ?>" class="card-text float-left"><i class="icofont-cart-alt"></i> اضف الي السلة
                            </a>
                        </div>
                    </div>
                </div>
            </div> <!-- end product -->
            <?php endforeach;?>


        </div>


    </section>
    <!-- end products -->

    <!-- Categories -->
    <section id="categories">
        <div class="row m-3 justify-content-center ">
            <div class="col">
                <h2 class="text-center"> <img src="<?php echo URLROOT; ?>/templates/default/images/namaa-icon.png" alt="namaa-icon"
                        class="ml-2">الأقسام</h2>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-12 wow zoomIn owl-carousel">
                <?php foreach ($data['project_categories'] as $category): ?>
                <div class="category">
                    <a class="">
                        <img class="card-img-top rounded" src="<?php echo (empty($category->image)) ? MEDIAURL . '/default.jpg' : MEDIAURL . '/' . $category->image; ?>" alt="<?php echo $category->name; ?>">
                        <div class="content p-1">
                            <h3 class="category-title"><?php echo $category->name; ?></h3>
                            <p class="card-text"><?php echo mb_substr(strip_tags($category->description), 0, 120); ?></p>
                            <div class="text-center mt-2">
                                <a href="<?php echo URLROOT . '/projectCategories/show/' . $category->category_id . '-' . $category->name; ?>" class="btn btn-section mb-4"> <i class="icofont-paper"></i> التفاصيل</a>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endforeach;?>
            </div>
        </div>

    </section>
    <!-- end Categories -->
<?php require APPROOT . '/app/views/inc/footer.php';?>
