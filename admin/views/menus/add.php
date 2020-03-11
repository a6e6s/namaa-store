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
    <?php flash('menu_msg'); ?>
    <div class="page-title">
        <div class="title_right">
            <h3><?php echo $data['page_title']; ?> <small>اضافة رابط جديد </small></h3>
        </div>
        <div class="title_left">
            <a href="<?php echo ADMINURL; ?>/menus" class="btn btn-success pull-left">عودة <i class="fa fa-reply"></i></a>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">

        <form action="<?php echo ADMINURL . '/menus/add'; ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
            <div class="col-lg-8 col-sm-12 col-xs-12">
                <div class="form-group  <?php echo (empty($data['name_error'])) ?: 'has-error'; ?>">
                    <label class="control-label" for="pageTitle">عنوان الرابط : </label>
                    <div class="has-feedback">
                        <input type="text" class="form-control" name="name" placeholder="عنوان الرابط" value="<?php echo $data['name']; ?>">
                        <span class="fa fa-edit form-control-feedback" aria-hidden="true"></span>
                        <span class="help-block"><?php echo $data['name_error']; ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="pageTitle">نوع الرابط : </label>
                    <div class="has-feedback">
                        <select id="menu-type" class="form-control" name="type">
                            <option value="static" <?php echo ($data['type'] == "static") ? 'selected' : ''; ?>> رابط خارجي </option>
                            <option value="dynamic" <?php echo ($data['type'] == "dynamic") ? 'selected' : ''; ?>> رابط داخلي </option>
                        </select>
                    </div>
                </div>
                <div class="form-group  <?php echo (empty($data['url_error'])) ?: 'has-error'; ?>">
                    <label class="control-label" for="pageTitle">الرابط : </label>
                    <div class="has-feedback">
                        <input type="text" class="form-control" name="url" placeholder="الرابط" value="<?php echo $data['url']; ?>">
                        <span class="fa fa-edit form-control-feedback" aria-hidden="true"></span>
                        <span class="help-block"><?php echo $data['url_error']; ?></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-12 col-xs-12 options">
                <h4>الاعدادات</h4>
                <div class="accordion">
                    <div class="card">
                        <div class="card-header" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <span> اعدادات النشر </span>
                        </div>
                        <div id="collapseOne" class="collapse card-body in" aria-labelledby="headingOne">
                            <div class="form-group">
                                <label>الترتيب : </label>
                                <input type="number" class="form-control" name="arrangement" value="<?php echo $data['arrangement']; ?>" placeholder="الترتيب">
                            </div>
                            <div class="form-group col-xs-12 <?php echo (!empty($data['status_error'])) ? 'has-error' : ''; ?>">
                                <label class="control-label">حالة النشر :</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" class="flat" <?php echo ($data['status'] == 1) ? 'checked' : ''; ?> value="1" name="status"> منشور
                                    </label>
                                    <label>
                                        <input type="radio" class="flat" <?php echo ($data['status'] == '0') ? 'checked' : ''; ?> value="0" name="status"> غير منشور
                                    </label>
                                    <span class="help-block"><?php echo $data['status_error']; ?></span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <br><br>
            </div>
            <div class="col-xs-12">
                <button type="submit" name="submit" class="btn btn-success">أضف
                    <i class="fa fa-save"> </i></button>
                <button type="reset" class="btn btn-danger">مسح
                    <i class="fa fa-trash "> </i></button>
            </div>
        </form>
    </div>
</div>

<?php
// loading plugin
$data['footer'] = '<script src="' . ADMINURL . '/template/default/vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>';

require ADMINROOT . '/views/inc/footer.php';
?>
<script>
    //menu 
    $("#menu-type").change(function() {
        var type = $(this).val();
        if (type === "dynamic") {
            alert('aaa')
        }
    })
</script>