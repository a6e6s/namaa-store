<?php require APPROOT . '/app/views/inc/header.php'; ?>
</div>
<div class="container">
    <div class="msg"><?php flash('msg'); ?></div>
    <!-- Categories -->
    <section id="categories">
        <div class="row m-3 justify-content-center ">
            <div class="col">
                <h2 class="text-center"> <img src="<?php echo URLROOT; ?>/templates/default/images/namaa-icon.png" alt="Smiley face" class="ml-2">الأقسام</h2>
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
                                    <a href="<?php echo URLROOT . '/ProjectCategories/show/' . $category->category_id . '-' . $category->name; ?>" class="btn btn-section mb-4"> <i class="icofont-paper"></i> التفاصيل</a>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    </section>
    <!-- end Categories -->
    <?php require APPROOT . '/app/views/inc/footer.php'; ?>