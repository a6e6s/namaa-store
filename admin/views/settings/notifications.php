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

<!-- setting content -->

<div class="right_col" role="main">
    <div class="clearfix"></div>
    <?php flash('setting_msg'); ?>
    <div class="setting-title">
        <div class="title_right">
            <h3><small>التعديل علي </small><?php echo $data['title']; ?> </h3>
        </div>
        <div class="title_left">
            <a href="<?php echo ADMINURL; ?>/settings" class="btn btn-success pull-left">عودة <i class="fa fa-reply"></i></a>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <form action="<?php echo ADMINURL . '/settings/edit/' . $data['setting_id']; ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                <div class="form-group">
                    <label class="control-label" for="settingTitle">عنوان الاعداد : </label>
                    <div class="has-feedback">
                        <input type="text" id="settingTitle" class="form-control" name="title" placeholder="عنوان الاعداد" value="<?php echo $data['title']; ?>">
                    </div>
                </div>
                <div class="x_panel tile ">
                    <h4 class="x_title">رسالة بريدية لتأكيد استلام المبلغ</h4>
                    <div class="form-group col-xs-12 ">
                        <label class="control-label">تفعيل الارسال :</label>
                        <div class="radio">
                            <label>
                                <input type="radio" class="flat" <?php echo ($data['value']->confirm_enabled == 1) ? 'checked' : ''; ?> value="1" name="value[confirm_enabled]"> مفعلة
                            </label>
                            <label>
                                <input type="radio" class="flat" <?php echo ($data['value']->confirm_enabled == '0') ? 'checked' : ''; ?> value="0" name="value[confirm_enabled]"> معلقة
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="confirm_subject">عنوان الرسالة : </label>
                        <div class="has-feedback">
                            <input type="text" id="confirm_subject" class="form-control" name="value[confirm_subject]" placeholder="عنوان الرسالة" value="<?php echo $data['value']->confirm_subject; ?>">
                        </div>
                    </div>
                    <div class="form-group col-xs-12 ">
                        <br>
                        <button type="button" class="btn btn-primary" onclick="$('#confirm_msg').val($('#confirm_msg').val() +'[[name]]') ;return false;" value="">ارفاق الاسم </button>
                        <button type="button" class="btn btn-primary" onclick="$('#confirm_msg').val($('#confirm_msg').val() +'[[identifier]]') ;return false;" value="">ارفاق رقم الطلب </button>
                        <button type="button" class="btn btn-primary" onclick="$('#confirm_msg').val($('#confirm_msg').val() +'[[total]]') ;return false;" value="">ارفاق المبلغ </button>
                        <button type="button" class="btn btn-primary" onclick="$('#confirm_msg').val($('#confirm_msg').val() +'[[project]]') ;return false;" value="">ارفاق اسم المشروع </button>
                        <small class="red ">سيتم استبدال المتغير الخاص بالقيمة </small>
                    </div>
                    <div class="form-group col-md-12">

                        <label class="control-label">المحتوي : </label>
                        <div class="row">
                            <textarea id="confirm_msg" name="value[confirm_msg]" rows="6" class="form-control"><?php echo ($data['value']->confirm_msg); ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="x_panel tile ">
                    <h4 class="x_title">رسالة بريديه تنبيه باستلام طلب تبرع</h4>
                    <div class="form-group col-xs-12 ">
                        <label class="control-label">تفعيل الارسال :</label>
                        <div class="radio">
                            <label>
                                <input type="radio" class="flat" <?php echo ($data['value']->inform_enabled == 1) ? 'checked' : ''; ?> value="1" name="value[inform_enabled]"> مفعلة
                            </label>
                            <label>
                                <input type="radio" class="flat" <?php echo ($data['value']->inform_enabled == '0') ? 'checked' : ''; ?> value="0" name="value[inform_enabled]"> معلقة
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="inform_subject">عنوان الرسالة : </label>
                        <div class="has-feedback">
                            <input type="text" id="inform_subject" class="form-control" name="value[inform_subject]" placeholder="عنوان الرسالة" value="<?php echo $data['value']->inform_subject; ?>">
                        </div>
                    </div>
                    <div class="form-group col-xs-12 ">
                        <br>
                        <button type="button" class="btn btn-primary" onclick="$('#inform_msg').val($('#inform_msg').val() +'[[name]]') ;return false;" value="">ارفاق الاسم </button>
                        <button type="button" class="btn btn-primary" onclick="$('#inform_msg').val($('#inform_msg').val() +'[[identifier]]') ;return false;" value="">ارفاق رقم الطلب </button>
                        <button type="button" class="btn btn-primary" onclick="$('#inform_msg').val($('#inform_msg').val() +'[[total]]') ;return false;" value="">ارفاق المبلغ </button>
                        <button type="button" class="btn btn-primary" onclick="$('#inform_msg').val($('#inform_msg').val() +'[[project]]') ;return false;" value="">ارفاق اسم المشروع </button>
                        <small class="red ">سيتم استبدال المتغير الخاص بالقيمة </small>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label">المحتوي : </label>
                        <div class="row">
                            <textarea id="inform_msg" name="value[inform_msg]" rows="6" class="form-control"><?php echo ($data['value']->inform_msg); ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="x_panel tile ">
                    <h4 class="x_title">رسالة SMS لتأكيد التبرع</h4>
                    <div class="form-group col-xs-12 ">
                        <label class="control-label">تفعيل الارسال :</label>
                        <div class="radio">
                            <label>
                                <input type="radio" class="flat" <?php echo ($data['value']->confirm_sms == 1) ? 'checked' : ''; ?> value="1" name="value[confirm_sms]"> مفعلة
                            </label>
                            <label>
                                <input type="radio" class="flat" <?php echo ($data['value']->confirm_sms == '0') ? 'checked' : ''; ?> value="0" name="value[confirm_sms]"> معلقة
                            </label>
                        </div>
                    </div>
                    <div class="form-group col-xs-12 ">
                        <br>
                        <button type="button" class="btn btn-primary" onclick="$('#confirm_sms_msg').val($('#confirm_sms_msg').val() +'[[name]]') ;return false;" value="">ارفاق الاسم </button>
                        <button type="button" class="btn btn-primary" onclick="$('#confirm_sms_msg').val($('#confirm_sms_msg').val() +'[[identifier]]') ;return false;" value="">ارفاق رقم الطلب </button>
                        <button type="button" class="btn btn-primary" onclick="$('#confirm_sms_msg').val($('#confirm_sms_msg').val() +'[[total]]') ;return false;" value="">ارفاق المبلغ </button>
                        <button type="button" class="btn btn-primary" onclick="$('#confirm_sms_msg').val($('#confirm_sms_msg').val() +'[[project]]') ;return false;" value="">ارفاق اسم المشروع </button>
                        <small class="red ">سيتم استبدال المتغير الخاص بالقيمة </small>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label">المحتوي : </label>
                        <div class="row">
                            <textarea id="confirm_sms_msg" name="value[confirm_sms_msg]" rows="6" class="form-control"><?php echo ($data['value']->confirm_sms_msg); ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                    <button type="submit" name="save" class="btn btn-success">تعديل
                        <i class="fa fa-save"> </i></button>
                    <button type="submit" name="submit" class="btn btn-success">تعديل وعودة
                        <i class="fa fa-save"> </i></button>
                    <button type="reset" class="btn btn-danger">مسح
                        <i class="fa fa-trash "> </i></button>
                </div>

            </form>

        </div>
    </div>
</div>

<?php
// loading plugin
$data['footer'] = '<script src="' . ADMINURL . '/template/default/vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>' . "\n";

require ADMINROOT . '/views/inc/footer.php';
