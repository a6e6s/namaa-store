<?php require APPROOT . '/app/views/inc/header.php'; ?>

<div class="container page">
    <div class="card" style="">
        <div class="row no-gutters">
            <div class="col-md-5" style="background: #868e96;">
                <img src="<?php echo (empty($data['category']->image)) ? MEDIAURL . '/default.jpg' : MEDIAURL . '/' . $data['category']->image; ?>" class="card-img-top h-100" alt="...">
            </div>
            <div class="col-md-7">
                <div class="card-body">
                    <h2 class="card-title text-primary"><?php echo $data['category']->name; ?></h2>
                    <p class="card-text"><?php echo $data['category']->description; ?></p>
                </div>
            </div>
        </div>
    </div>
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
            <?php
            echo (count($data['projects']) < 1) ? '<p class="text-center col-12 pb-5 my-5">لا يوجد منتجات تابعة لهذا القسم</p>' : '';
            foreach ($data['projects'] as $project) :
            ?>
                <div class="product col-12 col-xl-4 col-md-6 mt-3 wow zoomIn">
                    <div class="card">
                        <img class="card-img-top" src="<?php echo (empty($project->img)) ? MEDIAURL . '/default.jpg' : MEDIAURL . '/' . $project->img; ?>" alt="<?php echo $project->alias; ?>">
                        <div class="body-card m-2">
                            <p class="card-text"><?php echo mb_substr(strip_tags($project->description), 0, 100); ?></p>
                        </div>
                        <div class="p-2">
                                    <p class="m-0 pb-2">
                                        <?php
                                        empty($project->fake_target) ? $target = $project->collected_traget : $target = $project->fake_target;
                                        ($project->target_price) ?: $project->target_price = 1;
                                        ?>
                                    </p>
                                    <p class="m-0 p-0 text-left"><span>المستهدف : </span><i class="icofont-riyal"></i> <span><?php echo $project->target_price; ?></span></p>
                                    <div class="progress">
                                        <h6 class="p-1 progress-bar progress-bar-striped bg-success" role="progressbar" style="width:<?php echo ceil($target * 100 / $project->target_price) . "%"; ?>" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">
                                            <?php echo ceil($target * 100 / $project->target_price); ?> %
                                        </h6>
                                    </div>
                                </div>
                        <div class="card-footer bg-primary mt-1">
                            <div class="  ">
                                <a href="<?php echo URLROOT . '/projects/show/' . $project->project_id . '/' . $project->alias; ?>" class="card-text"><i class="icofont-files-stack"></i> التفاصيل</a>
                                <a href="<?php echo URLROOT . '/carts/add/' . $project->project_id; ?>" class="card-text float-left"><i class="icofont-cart-alt"></i> اضف الي السلة
                                </a>
                            </div>
                        </div>
                    </div>
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
        <div class="row ">
            <?php echo ($data['category']->back_home) ? '<div class="col-md-6 mx-auto mt-2"><a class="w-100 btn btn-lg btn-secondary icofont-home" href="' . URLROOT . '"> العودة الي الرئيسية</a></div>' : ''; ?>
        </div>



    </section>
    <!-- end products -->
</div>
<?php require APPROOT . '/app/views/inc/footer.php'; ?>