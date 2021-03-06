<?php require APPROOT . '/app/views/inc/store-header.php'; ?>
<?php flash('msg'); ?>
</div>
<div class="row m-0" style="background-color:<?php echo "" . $data['store']->background_color . ";background-image: url(" . MEDIAURL . "/" . $data['store']->background_image; ?>">
    <div class="container page">
        <?php require APPROOT . '/app/views/inc/employee-card.php'; ?>
        <!--- Products Start --->
        <section id="products">
            <div class="row mt-4 ">
                <div class="col">
                    <h3 class="text-center">
                        <img src="<?php echo URLROOT; ?>/templates/default/images/namaa-icon.png" alt="namaa-icon" class="ml-1">
                        <?php echo $data['site_settings']->project_text; ?></h3>
                </div>
            </div>
            <div class="row">
                <?php if ($data['site_settings']->enableTages) { ?>
                    <div class="col-12 ">

                        <div class="scrollmenu">
                            <?php
                            foreach ($data['tags'] as $tag) {
                                echo '<a class="" href="' . URLROOT . '/store/tags/' . $tag->tag_id . '/' . $data['store']->alias . '">' . $tag->name . '</a>';
                            }
                            ?>
                        </div>
                    </div>
                <?php }
                echo (count($data['projects']) < 1) ? '<p class="text-center col-12 pb-5 my-5">لا يوجد منتجات تابعة لهذا المتجر </p>' : '';
                foreach ($data['projects'] as $project) :
                ?>
                    <div class="product col-12 col-xl-4 col-md-6 mt-3 wow zoomIn">
                        <form class="card" method="post" action="<?php echo URLROOT . '/carts/add/'; ?>">
                            <a href="<?php echo URLROOT . '/store/project/' . $project->project_id . '/' . $data['store']->store_id . '-' . $project->alias; ?>" class="">
                                <img class="card-img-top" src="<?php echo (empty($project->secondary_image)) ? MEDIAURL . '/default.jpg' : MEDIAURL . '/' . $project->secondary_image; ?>" alt="<?php echo $project->name; ?>">
                            </a>
                            <div class="body-card m-2">
                                <p class="card-text"><?php echo mb_substr(strip_tags($project->description), 0, 85); ?></p>
                            </div>
                            <div class="p-2 amount-select">
                                <?php
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
                                                            <input type="radio" value ="' . $value->name . '" name="donation_type" required class="d-value" id="' . $value->value . '"> ' . $value->value . '
                                                        </label>';
                                                }
                                                break;
                                            case 'open':
                                                echo '<label class="active">قم بكتابة المبلغ المراد التبرع به
                                                        <input type="hidden" name="donation_type" value="مفتوح"></label>';
                                                break;
                                            case 'unit':
                                                foreach ($donation_type->value as $value) {
                                                    echo '<label class="btn btn-secondary btn-sm m-1">
                                                            <input type="radio" value ="' . $value->name . '" name="donation_type" required class="d-value" id="' . $value->value . '"> ' . $value->value . '
                                                        </label>';
                                                }
                                                break;
                                            case 'fixed':
                                                echo '<label class="btn btn-secondary btn-sm m-1">
                                                            <input type="radio" value ="قيمة ثابته" name="donation_type" required class="d-value" id="' . $donation_type->value . '"> ' . $donation_type->value . ' ريال
                                                        </label>';
                                                break;
                                        }
                                        ?>
                                        <input placeholder="القيمة" min="1" type="number" class="amt col-4 rounded-lg" <?php echo ($donation_type->type == 'fixed' || $donation_type->type == 'share') ? 'readonly' : ''; ?> required name="amount">
                                        <input type="hidden" name="project_id" value="<?php echo $project->project_id; ?>">
                                        <input type="hidden" name="store_id" value="<?php echo $data['store']->store_id; ?>">
                                    </div>
                                <?php endif; ?>
                                <div class="p-2">
                                    <small class="m-0 pb-2">
                                        تم جمع
                                        <span class=" mx-1">
                                            <?php
                                            if (!empty($project->target_unit) && !empty($project->unit_price)) { // check if user set unit and unit price
                                                echo $target = ceil(($project->total / $project->unit_price) + $project->fake_target);
                                                echo " $project->target_unit ";
                                            } else {
                                                echo $target = (int) $project->total + $project->fake_target;
                                                echo ' <i class="icofont-riyal"></i> ';
                                            }
                                            ($project->target_price) ?: $project->target_price = 1;
                                            ?>
                                        </span>
                                    </small>
                                    <small class=" pt-1 float-left"><span>المستهدف : </span>
                                        <span><?php echo $project->target_price; ?></span>
                                        <?php if (empty($project->target_unit)) {
                                            echo '<i class="icofont-riyal"></i>';
                                        } else {
                                            echo $project->target_unit;
                                        } ?>
                                    </small>
                                    <div class="progress my-1">
                                        <h6 class="p-1 progress-bar progress-bar-striped bg-success" role="progressbar" style="width:<?php echo ceil($target * 100 / $project->target_price) . "%"; ?>" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">
                                            <?php echo ceil($target * 100 / $project->target_price); ?> %
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer cart-footer bg-primary mt-1">
                                <div class="<?php echo $project->enable_cart ?: 'text-center'; ?> ">
                                    <a href="<?php echo URLROOT . '/store/project/' . $project->project_id . '/' . $data['store']->store_id . '-' . $project->alias; ?>" class="card-text">
                                        <i class="icofont-files-stack"></i> التفاصيل
                                    </a>
                                    <?php if ($project->enable_cart) : ?>
                                        <button class="cart-add" name="projectCategories" value="<?php echo $project->category_id; ?>" type="submit"><i class="icofont-cart-alt"></i> اضف الي السلة</button>
                                        <input type="number" name="quantity" min="1" value="1" required id="quantity" class="col-2 py-0 px-0 float-left">
                                        <input type="hidden" name="url" value="<?php echo URLROOT . '/carts/ajaxAdd'; ?>">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </form>
                    </div> <!-- end product -->
                <?php endforeach; ?>
            </div>
            <div class="row ">
                <nav class="col-md-6 col-12 offset-md-3 mt-5">
                    <ul class="pagination nav nav-bar ">
                        <?php echo $data['pagination']; ?>
                    </ul>
                </nav>
            </div>
        </section>
        <!-- end products -->
        <?php
        if ($data['site_settings']->show_categories) : ?>
            <!-- Categories -->
            <section id="categories">
                <div class="row m-3 justify-content-center ">
                    <div class="col">
                        <h2 class="text-center"> <img src="<?php echo URLROOT; ?>/templates/default/images/namaa-icon.png" alt="namaa-icon" class="ml-2"><?php echo $data['site_settings']->category_text; ?></h2>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12 wow zoomIn owl-carousel">
                        <?php foreach ($data['project_categories'] as $category) : ?>
                            <div class="category">
                                <img class="card-img-top rounded" src="<?php echo (empty($category->image)) ? MEDIAURL . '/default.jpg' : MEDIAURL . '/' . $category->image; ?>" alt="<?php echo $category->name; ?>">
                                <div class="content p-1">
                                    <h3 class="category-title"><?php echo $category->name; ?></h3>
                                    <p class="card-text"><?php echo mb_substr(strip_tags($category->description), 0, 120); ?></p>
                                    <div class="text-center mt-2">
                                        <a href="<?php echo URLROOT . '/store/category/' . $category->category_id . '/' . $data['store']->alias; ?>" class="btn btn-section mb-4"> <i class="icofont-paper"></i> التفاصيل</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
        <?php endif ?>
        <!-- alertModal -->
        <div class="modal fade" id="alertModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <img src="<?php echo MEDIAURL . '/' . $data['site_settings']->logo; ?>" width="100px" class="" alt="التبرع">
                    <div class="modal-body pt-0">
                    </div>
                    <div class="p-2 border-top">
                        <a href="<?php root('carts') ?>" class="btn btn-primary">عرض السلة</a>
                        <button type="button" class="btn btn-danger float-left" data-dismiss="modal">اغلاق</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 text-center my-2 p-0">
            <?php
            if (!empty($data['theme_settings']->categories_image)) {
                $img = '<img class="img-fluid" src="' . MEDIAURL . "/" . $data['theme_settings']->categories_image . '" >';
                if (!empty($data['theme_settings']->categories_image_url)) $img = '<a href="' . $data['theme_settings']->categories_image_url . ' ">' . $img . '</a>';
                echo $img;
            }
            ?>
        </div>
        <div class="col-12 text-center my-2 p-0">
            <?php
            if (!empty($data['theme_settings']->categories_image2)) {
                $img = '<img class="img-fluid" src="' . MEDIAURL . "/" . $data['theme_settings']->categories_image2 . '" >';
                if (!empty($data['theme_settings']->categories_image2_url)) $img = '<a href="' . $data['theme_settings']->categories_image2_url . ' ">' . $img . '</a>';
                echo $img;
            }
            ?>
        </div>
        <div class="col-12 text-center my-2 p-0">
            <?php
            if (!empty($data['theme_settings']->categories_image3)) {
                $img = '<img class="img-fluid" src="' . MEDIAURL . "/" . $data['theme_settings']->categories_image3 . '" >';
                if (!empty($data['theme_settings']->categories_image3_url)) $img = '<a href="' . $data['theme_settings']->categories_image3_url . ' ">' . $img . '</a>';
                echo $img;
            }
            ?>
        </div>
    </div>
</div>
<?php require APPROOT . '/app/views/inc/store-footer.php'; ?>
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