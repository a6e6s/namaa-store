<div class="card">
    <div class="row no-gutters bg-primary">
        <div class="col-sm-2 pr-3" style="margin:-10px 0 -30px 0">
            <img src="<?php echo (empty($data['store']->employee_image)) ? MEDIAURL . '/default.jpg' : MEDIAURL . '/' . $data['store']->employee_image; ?>" class="img-thumbnail rounded-circle " alt="...">
        </div>
        <div class="col-sm-10 text-light text-center pt-5">
            <h1 class="card-title "><?php echo $data['store']->name; ?></h1>
            <h5><label class=""><?php echo $data['store']->employee_name . ' : ' . $data['store']->job; ?></label></h5>
        </div>
    </div>
    <div class="row pt-5">
        <div class="col-md-8">
            <div class="card-body">
                <?php
                if (!empty($data['store']->details)) {
                    echo '<p class="card-text">' . nl2br($data['store']->details) . '</p>';
                }
                if (!empty($data['store']->location)) {
                    echo '<p><i class="icofont-location-pin icofont-lg"></i><a class="text-dark" href="' . ($data['store']->location) . '" target="_blank"> <span class=""> موقع الفرع </span> </a></p>';
                }
                ?>
            </div>
        </div>
        <div class="col-md-4">
            <?php
            if (!empty($data['store']->mobile)) {
                echo '<p> <i class="icofont-phone icofont-lg text-primary float-right"></i> <a class="mr-2" href="tel:' . ($data['store']->mobile) . '">' . ($data['store']->mobile) . '</a></p>';
            }
            if (!empty($data['store']->whatsapp)) {
                echo '<p><i class="icofont-whatsapp icofont-lg text-success float-right"> </i> <a class="mr-2" href="https://wa.me/' . $data['store']->whatsapp . '">' . ($data['store']->whatsapp) . '</a></p>';
            }
            ?>
        </div>
    </div>
</div>