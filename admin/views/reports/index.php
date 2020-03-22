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
    <?php flash('report_msg');?>
    <div class="page-title">
        <div class="title_right">
            <h3><?php echo $data['title']; ?> <small> استخراج <?php echo $data['title']; ?> </small></h3>
        </div>
        <div class="title_left">
            <!-- <a href="<?php echo ADMINURL; ?>/donations/add" class="btn btn-success pull-left">انشاء جديد <i class="fa fa-plus"></i></a> -->
        </div>
    </div>
    <div class="clearfix"></div>
        <div class="options">
            <div class="accordion">
                <div class="card">
                    <div class="card-header" data-toggle="collapse" data-target="#collapseZero" aria-expanded="true" aria-controls="collapseZero" >
                        <span> تقارير التبرعات   </span>
                    </div>
                    <div id="collapseZero" class="collapse in card-body" aria-labelledby="headingZero" >
                        <form action="<?php echo ADMINURL ?>/reports/show/donations" method="post" class="row">
                            <div class="form-group col-xs-12 ">
                                <label for="donor" class="">اسم المتبرع  </label>
                                <input class="form-control" type="text" name="donor" placeholder="المتبرع" >
                            </div>
                            <div class="form-group col-xs-12">
                                <label class="control-label">المشروعات</label>
                                <select class="form-control select2" name="projects[]"  multiple="multiple" data-placeholder="اختار الوسوم المناسبة" style="width: 100%;">
                                    <?php foreach ($data['projects'] as $project) {echo '<option value="' . $project->project_id . '" >' . $project->name . '</option>';}?>
                                </select>
                            </div>
                            <div class="form-group col-xs-12">
                                <label class="control-label">الوسوم</label>
                                <select class="form-control select2" name="tags[]"  multiple="multiple" data-placeholder="اختار الوسوم المناسبة" style="width: 100%;">
                                    <?php foreach ($data['tags'] as $tag) {echo '<option value="' . $tag->tag_id . '" >' . $tag->name . '</option>';}?>
                                </select>
                            </div>
                            <div class="form-group col-lg-4 col-xs-12">
                                <label for="payment_methods">وسيلة الدفع</label>
                                <select id="payment_methods" class="form-control" name="payment_methods">
                                <option value="">اختار وسيلة الدفع</option>
                                <?php foreach ($data['paymentMethods'] as $method) {echo '<option value="' . $method->payment_id . '" >' . $method->title . '</option>';}?>
                                </select>
                            </div>
                            <div class="form-group col-lg-4 col-xs-12">
                                <label for="status">حالة التبرع</label>
                                <select id="status" class="form-control " name="status">
                                    <option value="">اختار حالة التبرع</option>
                                    <option value="1">مؤكد</option>
                                    <option value="0">غير مؤكد</option>
                                    <option value="2">محذوف</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-4 col-xs-12">
                                <label for="gift">مهدي خيريا</label>
                                <select id="gift" class="form-control " name="gift">
                                    <option value="">اختار حالة الاهداء</option>
                                    <option value="1">نعم</option>
                                    <option value="0"> لا</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-6 col-xs-12 ">
                                <label for="amount" class="">قيمة التبرع  </label>
                                <div class="form-inline row">
                                    <input class="form-control" type="text" name="amount_from" placeholder="من" >
                                    <input class="form-control" type="text" name="amount_to" placeholder="الي" >
                                </div>
                            </div>
                            <div class="form-group col-lg-6 col-xs-12 ">
                                <label for="amount" class="">تاريخ التبرع  </label>
                                <div class="form-inline">
                                    من : <input class="form-control " type="date" name="date_from" placeholder="من" >
                                    الي: <input class="form-control " type="date" name="date_to" placeholder="الي" >
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <button type="submit" name="donations" class="btn btn-success">عرض <i class="fa fa-eye"> </i></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" >
                            <span> تقارير المتبرعين   </span>
                    </div>
                    <div id="collapseOne" class="collapse card-body" aria-labelledby="headingOne" >

                    </div>
                </div>
                <div class="card">
                    <div class="card-header" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo" >
                            <span>   تقارير بيانات التواصل  </span>
                    </div>
                    <div id="collapseTwo" class="collapse card-body" aria-labelledby="headingTwo" >

                    </div>
                </div>
            </div>
            <br><br>
        </div>
    </div>
<?php
// loading  plugin
$data['footer'] = '<script src="' . ADMINURL . '/template/default/vendors/select2/dist/js/select2.full.min.js"></script>
<script src="' . ADMINURL . '/template/default/vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
<script> $(".select2").select2({dir: "rtl"});</script>';

require ADMINROOT . '/views/inc/footer.php';
