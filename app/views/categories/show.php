<?php require APPROOT . '/app/views/inc/header.php';?>

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
                foreach ($data['projects'] as $project):
            ?>
            <div class="product col-12 col-xl-4 col-md-6 mt-3 wow zoomIn">
                <div class="card">
                    <img class="card-img-top" src="<?php echo (empty($project->img)) ? MEDIAURL . '/default.jpg' : MEDIAURL . '/' . $project->img; ?>" alt="<?php echo $project->alias; ?>">
                    <div class="body-card m-2">
                        <p class="card-text"><?php echo mb_substr(strip_tags($project->description), 0, 100); ?></p>
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
                            <a href="<?php echo URLROOT . '/projects/show/' . $project->project_id . '/' . $project->alias; ?>" class="card-text"><i class="icofont-files-stack"></i> التفاصيل</a>
                            <a href="<?php echo URLROOT . '/cart/' . $project->project_id; ?>" class="card-text float-left"><i class="icofont-cart-alt"></i> اضف الي السلة
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
    <!-- end products -->
</div>
<?php require APPROOT . '/app/views/inc/footer.php';?>
