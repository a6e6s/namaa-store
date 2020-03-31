<?php require APPROOT . '/app/views/inc/header.php';?>
</div>

<div class="container">
<!-- Categories -->
    <section id="categories">
        <div class="row m-3 justify-content-center ">
            <div class="col">
                <h2 class="text-center"> <img src="<?php echo URLROOT; ?>/templates/default/images/namaa-icon.png" alt="Smiley face"
                        class="ml-2">الأقسام</h2>
            </div>
        </div>
        <div class="row">
            <?php
                echo (count($data['categories']) < 1) ? '<p class="text-center col-12 pb-5 my-5">لا يوجد منتجات تابعة لهذا القسم</p>' : '';
                foreach ($data['categories'] as $category):
            ?>
            <div class="product col-12 col-xl-4 col-md-6 mt-3 wow zoomIn">
                <div class="card">
                    <img class="card-img-top" src="<?php echo (empty($category->image)) ? MEDIAURL . '/default.jpg' : MEDIAURL . '/' . $category->image; ?>" alt="<?php echo $category->alias; ?>">
                    <div class="body-card m-2">
                        <p class="card-text"><?php echo mb_substr(strip_tags($category->description), 0, 100); ?></p>
                    </div>
                    <div class="card-footer bg-primary mt-1">
                        <div class=" text-center ">
                            <a href="<?php echo URLROOT . '/projectCategories/show/' . $category->category_id . '-' . $category->alias; ?>" class="card-text"><i class="icofont-files-stack"></i> التفاصيل</a>
                            </a>
                        </div>
                    </div>
                </div>
            </div> <!-- end product -->
            <?php endforeach;?>
        </div>
        <div class="row ">
            <nav class="col-md-6 col-12 offset-md-3 mt-5">
                <ul class="pagination nav nav-bar ">
                    <?php echo $data['pagination']; ?>
                </ul>
            </nav>
        </div>

    </section>
    <!-- end Categories -->
<?php require APPROOT . '/app/views/inc/footer.php';?>
