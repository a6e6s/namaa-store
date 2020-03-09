<?php require APPROOT . '/app/views/inc/header.php'; ?>

<div class="container page">
    <div class="row  mt-5 mb-5 card flex-row">
        <h3 class="text-center py-2 col-12">
            <img src="<?php echo URLROOT; ?>/templates/default/images/namaa-icon.png" alt="namaa-icon" class="ml-1">
            اتصل بنا
        </h3>
        <div class="col-6">
            <h4 class="text-center">
                بيانات الاتصال
            </h4>
            <p class=""><strong>رقم الجوال </strong>:<span>059777777</span></p>
            <p class=""><strong>رقم الهاتف </strong>:<span>059777777</span></p>
            <p class=""><strong>البريد الالكتروني </strong>:<span>059777777</span></p>
        </div>
        <div class="col-6">
            <h4 class="text-center">
                العنوان
            </h4>
        </div>
        <div class="col-12 border-top pt-3 mt-5">
            <div class="">
                <?php flash('msg'); ?>
                <form action="<?php echo URLROOT . '/pages/contact'; ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                    <div class="col-sm-12 col-xs-12">
                        <div class="form-group  <?php echo (empty($data['subject_error'])) ?: 'has-error'; ?>">
                            <label class="control-label" for="pageTitle">الموضوع : </label>
                            <div class="has-feedback">
                                <input type="text" class="form-control" name="subject" placeholder="عنوان الموضوع" value="<?php echo $data['subject']; ?>">
                                <span class="fa fa-edit form-control-feedback" aria-hidden="true"></span>
                                <span class="text-danger"><?php echo $data['subject_error']; ?></span>
                            </div>
                        </div>
                        <div class="form-group  <?php echo (empty($data['full_name_error'])) ?: 'has-error'; ?>">
                            <label class="control-label" for="pageTitle">الاسم بالكامل : </label>
                            <div class="has-feedback">
                                <input type="text" class="form-control" name="full_name" placeholder="الاسم بالكامل" value="<?php echo $data['full_name']; ?>">
                                <span class="fa fa-edit form-control-feedback" aria-hidden="true"></span>
                                <span class="text-danger"><?php echo $data['full_name_error']; ?></span>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label class="control-label">الغرض </label>
                            <div class="has-feedback">
                                <select name="type" class="form-control">
                                    <option value="">اختار الغرض من الرسالة </option>
                                    <?php foreach ($data['types'] as $type) : ?>
                                        <option value="<?php echo $type; ?>" <?php echo ($type == $data['type']) ? " selected " : ''; ?>>
                                            <?php echo $type; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="fa fa-folder form-control-feedback" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label class="control-label" for="pageTitle">الهاتف : </label>
                            <div class="has-feedback">
                                <input type="text" class="form-control" name="phone" placeholder="الهاتف" value="<?php echo $data['phone']; ?>">
                                <span class="fa fa-edit form-control-feedback" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label class="control-label" for="pageTitle">البريد الالكتروني : </label>
                            <div class="has-feedback">
                                <input type="text" class="form-control" name="email" placeholder="البريد الالكتروني" value="<?php echo $data['email']; ?>">
                                <span class="fa fa-edit form-control-feedback" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="form-group  <?php echo (empty($data['message_error'])) ?: 'has-error'; ?>">
                            <label class="control-label">نص الرسالة : </label>
                            <textarea rows="5" name="message" class="form-control"><?php echo ($data['message']); ?></textarea>
                            <span class="text-danger"><?php echo $data['message_error']; ?></span>
                        </div>
                    </div>
                    <div class="col-xs-12 text-center">
                        <button type="submit" name="submit" class="btn btn-primary">ارسال
                            <i class="fa fa-save"> </i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/app/views/inc/footer.php'; ?>