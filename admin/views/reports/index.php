<?php
/*
 * Copyright (C) 2018 Easy CMS Framework Ahmed Elmahdy
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License
 * @license    https://opensource.org/licenses/GPL-3.0
 *
 * @package    Easy CMS MVC framework
 * @author     Ahmed Elmahdy
 * @link       https://ahmedx.com
 *
 * For more information about the author , see <http://www.ahmedx.com/>.
 */

// loading  plugin style
$data['header'] = '<link rel="stylesheet" href="' . ADMINURL . '/template/default/vendors/select2/dist/css/select2.min.css">';

require ADMINROOT . '/views/inc/header.php';
?>

<!-- page content -->

<div class="right_col" role="main">
    <div class="clearfix"></div>
    <?php flash('donation_msg');?>
    <div class="page-title">
        <div class="title_right">
            <h3><?php echo $data['title']; ?> <small> استخراج <?php echo $data['title']; ?> </small></h3>
        </div>
        <div class="title_left">
            <!-- <a href="<?php echo ADMINURL; ?>/donations/add" class="btn btn-success pull-left">انشاء جديد <i class="fa fa-plus"></i></a> -->
        </div>
    </div>

    <div class="clearfix"></div>


            <form action="<?php echo ADMINURL ?>/reports/show" method="post" class="row">
                <div class="form-group col-md-12">
                    <label class="control-label">المشروعات</label>
                    <select class="form-control select2" name="projects[]"  multiple="multiple" data-placeholder="اختار الوسوم المناسبة" style="width: 100%;">
                        <?php foreach ($data['projects'] as $project) {echo '<option value="'. $project->project_id .'" >'. $project->name .'</option>';}?>
                    </select>
                </div>
                <div class="form-group col-md-12">
                    <label class="control-label">الوسوم</label>
                    <select class="form-control select2" name="tags[]"  multiple="multiple" data-placeholder="اختار الوسوم المناسبة" style="width: 100%;">
                        <?php foreach ($data['tags'] as $tag) {echo '<option value="'. $tag->tag_id .'" >'. $tag->name .'</option>';}?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="payment_methods">وسيلة الدفع</label>
                    <select id="payment_methods" class="form-control" name="payment_methods">
                    <option>اختار وسيلة الدفع</option>
                    <?php foreach ($data['paymentMethods'] as $method) {echo '<option value="'. $method->payment_id .'" >'. $method->title .'</option>';}?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="status">حالة التبرع</label>
                    <select id="status" class="form-control " name="status">
                        <option>اختار حالة التبرع</option>
                        <option value="1">مؤكد</option>
                        <option value="0">غير مؤكد</option>
                        <option value="2">محذوف</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="my-input">Text</label>
                </div>

            </form>

</div>
<?php
// loading  plugin
$data['footer'] = '<script src="' . ADMINURL . '/template/default/vendors/select2/dist/js/select2.full.min.js"></script>
<script src="' . ADMINURL . '/template/default/vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
<script> $(".select2").select2({dir: "rtl"});</script>';

require ADMINROOT . '/views/inc/footer.php';
