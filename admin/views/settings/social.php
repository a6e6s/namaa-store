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
    <?php flash('setting_msg');?>
    <div class="setting-title">
        <div class="title_right">
            <h3><small>التعديل علي  </small><?php echo $data['title']; ?> </h3>
        </div>
        <div class="title_left">
            <a href="<?php echo ADMINURL; ?>/settings" class="btn btn-success pull-left">عودة <i class="fa fa-reply"></i></a>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <form action="<?php echo ADMINURL . '/settings/edit/' . $data['setting_id']; ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8" >
                <div class="form-group">
                    <label class="control-label" for="settingTitle">عنوان الاعداد : </label>
                    <div class="has-feedback">
                        <input type="text" id="settingTitle" class="form-control" name="title" placeholder="عنوان الاعداد" value="<?php echo $data['title']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="settingTitle">facebook : </label>
                    <div class="has-feedback">
                        <input type="text" id="settingTitle" class="form-control" name="value[facebook]" placeholder="رابط  facebook" value="<?php echo $data['value']->facebook; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="settingTitle">twitter : </label>
                    <div class="has-feedback">
                        <input type="text" id="settingTitle" class="form-control" name="value[twitter]" placeholder="رابط  twitter" value="<?php echo $data['value']->twitter; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="settingTitle">instagram : </label>
                    <div class="has-feedback">
                        <input type="text" id="settingTitle" class="form-control" name="value[instagram]" placeholder="رابط  instagram" value="<?php echo $data['value']->instagram; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="settingTitle">linkedin : </label>
                    <div class="has-feedback">
                        <input type="text" id="settingTitle" class="form-control" name="value[linkedin]" placeholder="رابط  linkedin" value="<?php echo $data['value']->linkedin; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="settingTitle">youtube : </label>
                    <div class="has-feedback">
                        <input type="text" id="settingTitle" class="form-control" name="value[youtube]" placeholder="رابط  youtube" value="<?php echo $data['value']->youtube; ?>">
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
$data['footer'] = '<script src="' . ADMINURL . '/template/default/vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>'."\n";

require ADMINROOT . '/views/inc/footer.php';
