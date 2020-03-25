<?php require APPROOT . '/app/views/inc/header.php'; ?>
<?php flash('msg'); ?>
</div>
<?php if ($data['site_settings']->show_banner) : ?>
    <div id="slider" class="carousel slide wow zoomIn" data-ride="carousel">
        <ol class="carousel-indicators">
            <?php for ($i = 0; $i < count($data['slides']); $i++) : ?>
                <li data-target="#slider" data-slide-to="<?php echo $i; ?>" class="<?php echo ($i == 0) ? 'active' : ''; ?>"></li>
            <?php endfor; ?>
        </ol>
        <div class="carousel-inner">
            <?php foreach ($data['slides'] as $key => $slider) : ?>
                <div class="carousel-item <?php echo ($key == 0) ? 'active' : ''; ?>">
                    <a href="<?php echo empty($slider->url) ? '' : $slider->url; ?>">
                        <img class="d-block w-100" src="<?php echo MEDIAURL . '/' . $slider->image; ?>" alt="<?php echo $slider->name; ?>">
                        <div class="carousel-content">
                            <?php echo empty($slider->name) ? '' : '<h1 class ="carousel-title">' . $slider->name . "</h1>\n"; ?>
                            <?php echo empty($slider->description) ? '' : '<p class ="carousel-description">' . $slider->description . "</p>\n"; ?>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
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

    <div class="row m-0" style="background:<?php echo "#" . $data['theme_settings']->background_color . " url(" . MEDIAURL . "/" . $data['theme_settings']->background_image; ?>" )>
        <div class="container">
            <div class="col-12 text-center my-2">
                <?php
                if (!empty($data['theme_settings']->banner_image)) {
                    $img = '<img class="img-fluid" src="' . MEDIAURL . "/" . $data['theme_settings']->banner_image . '" >';
                    if (!empty($data['theme_settings']->banner_image_url)) $img = '<a href="' . $data['theme_settings']->banner_image_url . ' ">' . $img . '</a>';
                    echo $img;
                }
                ?></div>
            <!--- carousel  end --->
        <?php endif;
    if ($data['site_settings']->show_projects) : ?>
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
                    <?php foreach ($data['projects'] as $project) : ?>
                        <div class="product col-12 col-xl-4 col-md-6 mt-3 wow zoomIn">
                            <form class="card" method="post" action="<?php echo URLROOT . '/carts/add/' ; ?>">
                                <a href="<?php echo URLROOT . '/projects/show/' . $project->project_id . '-' . $project->alias; ?>" class="">
                                    <img class="card-img-top" src="<?php echo (empty($project->img)) ? MEDIAURL . '/default.jpg' : MEDIAURL . '/' . $project->img; ?>" alt="<?php echo $project->name; ?>">
                                </a>
                                <div class="body-card m-2">
                                    <p class="card-text"><?php echo mb_substr(strip_tags($project->description), 0, 100); ?></p>
                                </div>
                                <div class="p-2">
                                    <?php
                                    empty($project->fake_target) ? $target = $project->collected_traget : $target = $project->fake_target;
                                    ($project->target_price) ?: $project->target_price = 1;
                                    if ($project->enable_cart) : 
                                    $donation_type = json_decode($project->donation_type);
                                    ?>
                                    <div class="my-2 btn-group-toggle" data-toggle="buttons">
                                        <?php
                                        switch ($donation_type->type) {
                                            case 'share':
                                                foreach ($donation_type->value as $value) {
                                                    echo '<label class="btn btn-secondary btn-sm m-1">
                                                            <input type="radio" value ="' . $value->name . '" name="donation_type" required class="d-value" id="' . $value->value . '"> ' . $value->name . '
                                                        </label>';
                                                }
                                                break;
                                            case 'open':
                                                echo 'قم بكتابة المبلغ المراد التبرع به 
                                                    <input type="hidden" name="donation_type" value="مفتوح">';
                                                break;
                                            case 'unit':
                                                foreach ($donation_type->value as $value) {
                                                    echo '<label class="btn btn-secondary btn-sm m-1">
                                                            <input type="radio" value ="' . $value->name . '" name="donation_type" class="d-value" id="' . $value->value . '"> ' . $value->name . '
                                                        </label>';
                                                }
                                                break;
                                            case 'fixed':
                                                echo '<label class="btn btn-secondary btn-sm m-1">
                                                        <input type="radio" value ="قيمة ثابته" name="donation_type" class="d-value" id="' . $donation_type->value . '"> ' . $donation_type->value . ' ريال
                                                    </label>';
                                                break;
                                            }
                                        ?>
                                    <input placeholder="القيمة" min="1" type="number" class="amt col-4 rounded-lg" <?php echo ($donation_type->type == 'fixed' || $donation_type->type == 'share') ? 'readonly' : ''; ?> required name="amount">
                                    <input type="hidden" name="project_id" value="<?php echo $project->project_id ;?>">
                                    </div>
                                        <?php endif;?>
                                    <p class="m-0 p-0 text-left"><span>المستهدف : </span><i class="icofont-riyal"></i> <span><?php echo $project->target_price; ?></span></p>
                                    <div class="progress">
                                        <h6 class="p-1 progress-bar progress-bar-striped bg-success" role="progressbar" style="width:<?php echo ceil($target * 100 / $project->target_price) . "%"; ?>" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">
                                            <?php echo ceil($target * 100 / $project->target_price); ?> %
                                        </h6>
                                    </div>
                                </div>
                                <div class="card-footer bg-primary mt-1">
                                    <div class="<?php echo $project->enable_cart ?: 'text-center'; ?> ">
                                        <a href="<?php echo URLROOT . '/projects/show/' . $project->project_id . '-' . $project->alias; ?>" class="card-text"><i class="icofont-files-stack"></i> التفاصيل</a>
                                        <?php if ($project->enable_cart) : ?>
                                            <button class="card-text float-left btn btn-sm " type="submit"><i class="icofont-cart-alt"></i> اضف الي السلة</button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </form>
                        </div> <!-- end product -->
                    <?php endforeach; ?>
                </div>
            </section>
            <div class="col-12 text-center my-2">
                <?php
                if (!empty($data['theme_settings']->projects_image)) {
                    $img = '<img class="img-fluid" src="' . MEDIAURL . "/" . $data['theme_settings']->projects_image . '" >';
                    if (!empty($data['theme_settings']->projects_image_url)) $img = '<a href="' . $data['theme_settings']->projects_image_url . ' ">' . $img . '</a>';
                    echo $img;
                }
                ?></div>
            <!-- end products -->
        <?php endif;
    if ($data['site_settings']->show_categories) : ?>
            <!-- Categories -->
            <section id="categories">
                <div class="row m-3 justify-content-center ">
                    <div class="col">
                        <h2 class="text-center"> <img src="<?php echo URLROOT; ?>/templates/default/images/namaa-icon.png" alt="namaa-icon" class="ml-2">الأقسام</h2>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12 wow zoomIn owl-carousel">
                        <?php foreach ($data['project_categories'] as $category) : ?>
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
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
            <div class="col-12 text-center my-2">
                <?php
                if (!empty($data['theme_settings']->categories_image)) {
                    $img = '<img class="img-fluid" src="' . MEDIAURL . "/" . $data['theme_settings']->categories_image . '" >';
                    if (!empty($data['theme_settings']->categories_image_url)) $img = '<a href="' . $data['theme_settings']->categories_image_url . ' ">' . $img . '</a>';
                    echo $img;
                }
                ?></div>
            <div class="col-12 text-center my-2">
                <?php
                if (!empty($data['theme_settings']->categories_image2)) {
                    $img = '<img class="img-fluid" src="' . MEDIAURL . "/" . $data['theme_settings']->categories_image2 . '" >';
                    if (!empty($data['theme_settings']->categories_image2_url)) $img = '<a href="' . $data['theme_settings']->categories_image2_url . ' ">' . $img . '</a>';
                    echo $img;
                }
                ?></div>
            <div class="col-12 text-center my-2">
                <?php
                if (!empty($data['theme_settings']->categories_image3)) {
                    $img = '<img class="img-fluid" src="' . MEDIAURL . "/" . $data['theme_settings']->categories_image3 . '" >';
                    if (!empty($data['theme_settings']->categories_image3_url)) $img = '<a href="' . $data['theme_settings']->categories_image3_url . ' ">' . $img . '</a>';
                    echo $img;
                }
                ?></div>
        <?php endif; ?>
        <!-- end Categories -->
        </div>
        <?php require APPROOT . '/app/views/inc/footer.php'; ?>
        <script>
            //submitting amount value 
            // if user select from units or fixed or share donation
            $('.d-value').change(function() {
                var amount = $(this).attr('id');
                // alert(amount);
                // $(this).parent().next().chiled().val(this.value)
                $(this).parent().parent().children('.amt').val(amount);
            });
        </script>