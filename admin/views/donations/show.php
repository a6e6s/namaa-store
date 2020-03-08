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
    <?php flash('donation_msg');?>
    <div class="page-title">
        <div class="title_right">
            <h3><?php echo $data['page_title']; ?> <small>عرض محتوي الصفحة </small></h3>
        </div>
        <div class="title_left">
            <a href="<?php echo ADMINURL; ?>/donations" class="btn btn-success pull-left">عودة <i class="fa fa-reply"></i></a>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="form-group">
                <h3 class="prod_title">
                    <?php echo $data['donation']->name; ?>
                </h3>
            </div>
            <div class="well img-thumbnail col-md-6 col-sm-6">
            <label class="control-label">الصورة الرئيسية : </label>
            <?php if (!empty($data['donation']->image)):
                $galery = explode(',', $data['donation']->image);
                foreach ($galery as $img) {

                    $img = MEDIAURL . '/' . str_replace( '&#34;' ,'', trim(trim($img, ']'), '['));
                    echo 
                    ' <img src="' . $img . '" class="img-responsive img-rounded"> ';

                }
            endif;?>

                <img  src="<?php echo empty($data['donation']->image) ? MEDIAURL . '/default.jpg' : ''; ?>" />
            </div>
            <div class="well img-thumbnail col-md-6 col-sm-6">
                <label class="control-label">الصورة الخارجية : </label>
                <img class="img-responsive img-rounded" src="<?php echo empty($data['donation']->secondary_image) ? MEDIAURL . '/default.jpg' : MEDIAURL . '/' . $data['donation']->secondary_image; ?>" />
            </div>
            <div class="form-group col-md-6 col-xs-6">
                <label class="control-label">الوصف : </label>
                <p><?php echo $data['donation']->description ?: 'لا يوجد'; ?></p>
            </div>
            <div class="form-group col-md-6 col-xs-6">
                <label class="control-label">الرابط : </label>
                <p class="ltr"><a href="http://<?php echo URLROOT . $data['donation']->alias; ?>" target="_blank" rel="noopener noreferrer"><?php echo URLROOT . $data['donation']->alias; ?></a></p>
            </div>
            <div class="form-group col-md-6 col-xs-6">
                <label class="control-label">الترتيب : </label>
                <p><?php echo $data['donation']->arrangement; ?></p>
            </div>
            <div class="form-group col-md-6 col-xs-6">
                <label class="control-label">يقبل الاضافة في السلة : </label>
                <p><?php echo $data['donation']->enable_cart ? 'نعم' : 'لا'; ?></p>
            </div>
            <div class="form-group col-md-6 col-xs-6">
                <label class="control-label">يجب تأكيد الجوال : </label>
                <p><?php echo $data['donation']->mobile_confirmation ? 'نعم' : 'لا'; ?></p>
            </div>
            <div class="form-group col-md-6 col-xs-6">
                <label class="control-label">نوع التبرع : </label>
                <p><?php
$donation_type = json_decode($data['donation']->donation_type, true);
echo $data['donation_type_list'][$donation_type['type']];
?></p>
            </div>
            <div class="form-group col-md-6 col-xs-6">
                <label class="control-label">وسائل الدفع المدعومة : </label>
                <ul class="list-group">
                <?php
foreach ($data['paymentMethodsList'] as $payMethod) {
    echo '<li class="list-group-item ">' . $payMethod->title . '</li>';
}
?>
                </ul>
            </div>
            <div class="form-group col-md-6 col-xs-6">
                <label class="control-label">المبلغ المستهدف : </label>
                <p><?php echo $data['donation']->target_price ?: 'لا يوجد'; ?></p>
            </div>
            <div class="form-group col-md-6 col-xs-6">
                <label class="control-label"> المبلغ المستهدف المؤقت : </label>
                <p><?php echo $data['donation']->fake_target ?: 'لا يوجد'; ?></p>
            </div>
            <div class="form-group col-md-6 col-xs-6">
                <label class="control-label">العودة للرئيسية : </label>
                <p><?php echo $data['donation']->back_home ? 'نعم' : 'لا'; ?></p>
            </div>
            <div class="form-group col-md-6 col-xs-6">
                <label class="control-label">مميزة : </label>
                <p><?php echo $data['donation']->featured ? 'نعم' : 'لا'; ?></p>
            </div>
            <div class="form-group col-md-6 col-xs-6">
                <label class="control-label">النشر كا مخفي : </label>
                <p><?php echo $data['donation']->hidden ? 'نعم' : 'لا'; ?></p>
            </div>
            <div class="form-group col-md-6 col-xs-6">
                <label class="control-label">حالة النشر : </label>
                <p><?php echo $data['donation']->status ? 'منشور' : 'غير منشور'; ?></p>
            </div>
            <div class="form-group col-md-6 col-xs-6">
                <label class="control-label">تاريخ بداية النشر : </label>
                <p><?php echo $data['donation']->modified_date ? date('d/ M/ Y', $data['donation']->start_date) : 'لا'; ?></p>
            </div>
            <div class="form-group col-md-6 col-xs-6">
                <label class="control-label">تاريخ انتهاء النشر : </label>
                <p><?php echo $data['donation']->create_date ? date('d/ M/ Y', $data['donation']->end_date) : 'لا'; ?></p>
            </div>
            <div class="form-group col-md-6 col-xs-6">
                <label class="control-label">اخر تحديث : </label>
                <p><?php echo $data['donation']->modified_date ? date('d/ M/ Y', $data['donation']->modified_date) : 'لا'; ?></p>
            </div>
            <div class="form-group col-md-6 col-xs-6">
                <label class="control-label">وقت الإنشاء : </label>
                <p><?php echo $data['donation']->create_date ? date('d/ M/ Y', $data['donation']->create_date) : 'لا'; ?></p>
            </div>
            <div class="form-group col-md-6 col-xs-6">
                <label class="control-label"> رسالة الشكر : </label>
                <p><?php echo $data['donation']->thanks_message ?: 'لا يوجد'; ?></p>
            </div>
            <div class="form-group col-md-6 col-xs-6">
                <label class="control-label"> رقم الهاتف : </label>
                <p><?php echo $data['donation']->mobile ?: 'لا يوجد'; ?></p>
            </div>
            <div class="form-group col-md-6 col-xs-6">
                <label class="control-label"> رقم الواتس : </label>
                <p><?php echo $data['donation']->whatsapp ?: 'لا يوجد'; ?></p>
            </div>
            <div class="form-group col-md-6 col-xs-6">
                <label class="control-label"> الزيارات : </label>
                <p><?php echo $data['donation']->hits ?: 'لا يوجد'; ?></p>
            </div>
            <div class="form-group col-md-6 col-xs-6">
                <label class="control-label">وصف مختصر لمحرك البحث : </label>
                <div class="well">
                    <?php echo $data['donation']->meta_description ?: 'لا يوجد'; ?>
                </div>
            </div>
            <div class="form-group col-md-6 col-xs-6">
                <label class="control-label tags">الكلمات الدلالية    :</label>
                <div class=" well">
                    <?php echo $data['donation']->meta_keywords ?: 'لا يوجد'; ?>
                </div>
            </div>
            <div class="form-group col-xs-12">
                <a class="btn btn-info" href="<?php echo ADMINURL . '/donations/edit/' . $data['donation']->category_id; ?>" >تعديل</a>
            </div>


        </div>
    </div>
</div>

<?php
// loading plugin
$data['footer'] = '';

require ADMINROOT . '/views/inc/footer.php';
