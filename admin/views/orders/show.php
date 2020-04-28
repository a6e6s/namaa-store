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

// loading plugin style
$data['header'] = '';
header("Content-Type: text/html; charset=utf-8");

require ADMINROOT . '/views/inc/header.php';
?>

<!-- page content -->

<div class="right_col" role="main">
    <div class="clearfix"></div>
    <?php flash('order_msg');?>
    <div class="page-title">
        <div class="title_right">
            <h3><?php echo $data['page_title']; ?> <small>عرض محتوي التبرع </small></h3>
        </div>
        <div class="title_left">
            <a href="<?php echo ADMINURL; ?>/orders" class="btn btn-success pull-left">عودة <i class="fa fa-reply"></i></a>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="form-group">
                <h3 class="prod_title">
                    <?php echo $data['order']->order_identifier; ?>
                </h3>
            </div>
            <div class="form-groupcol-xs-12">
                <label class="control-label">قيمة التبرع : </label>
                <p><?php echo $data['order']->amount; ?></p>
            </div>
            <div class="form-groupcol-xs-12">
                <label class="control-label">وسيلة التبرع : </label>
                <p class="ltr"><?php echo $data['order']->payment_method_id; ?></p>
            </div>
            <div class="form-groupcol-xs-12">
                <label class="control-label">اثبات التحويل : </label>
                <p><?php echo $data['order']->banktransferproof; ?></p>
            </div>
            <div class="form-groupcol-xs-12">
                <label class="control-label">مهدي خيريا :</label>
                <p><?php echo $data['order']->gift ? 'نعم' : 'لا'; ?></p>
                <p class="btn-default">
                <h3 class="control-label">بيانات الاهداء  :</h3>
                <?php if ($data['order']->gift) {
    $gift_data = json_decode($data['order']->gift_data);
    foreach ($gift_data as $key => $value) {
        if ($key == 'enable') {
            continue;
        }

        echo "<label>" . $key . " :</label> " . $value . "<br>\n";
    }

}?></p>
            </div>
            <div class="form-groupcol-xs-12">
                <h3 class="control-label">بيانات الدفع من خلال بايفورت : </h3>
                <p class=" btn-default"><?php
if (!empty($data['order']->meta)) {
    $meta = json_decode($data['order']->meta);
    foreach ($meta as $key => $value) {
        echo "<label>" . $key . " :</label> " . $value . "<br>\n";
    }

}
?></p>
            </div>
            <div class="form-groupcol-xs-12">
                <label class="control-label">اسم المشروع : </label>
                <p><?php echo $data['order']->project_id; ?></p>
            </div>
            <div class="form-groupcol-xs-12">
                <label class="control-label">اسم المتبرع : </label>
                <p><?php echo $data['order']->donor_id; ?></p>
            </div>
            <div class="form-groupcol-xs-12">
                <label class="control-label">حالة التبرع : </label>
                <p><?php echo $data['order']->status ? 'مؤكد' : 'غير مؤكد'; ?></p>
            </div>
            <div class="form-groupcol-xs-12">
                <label class="control-label">اخر تحديث : </label>
                <p><?php echo $data['order']->modified_date ? date('d/ M/ Y', $data['order']->modified_date) : 'لا'; ?></p>
            </div>
            <div class="form-groupcol-xs-12">
                <label class="control-label">وقت الإنشاء : </label>
                <p><?php echo $data['order']->create_date ? date('d/ M/ Y', $data['order']->create_date) : 'لا'; ?></p>
            </div>

            <div class="form-group col-xs-12">
                <a class="btn btn-info" href="<?php echo ADMINURL . '/orders/edit/' . $data['order']->order_id; ?>" >تعديل</a>
            </div>


        </div>
    </div>
</div>

<?php
// loading plugin
$data['footer'] = '';

require ADMINROOT . '/views/inc/footer.php';
