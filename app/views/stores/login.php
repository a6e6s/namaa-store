<?php require APPROOT . '/app/views/inc/header.php'; ?>
<?php flash('msg'); ?>
<div class="container page">

    <!--- Products Start --->
    <section class="products mb-5 pb-5">
        <div class="row mt-4 justify-content-md-center">
            <div class="col-12">
                <h3 class="text-center">
                    <img src="<?php echo URLROOT; ?>/templates/default/images/namaa-icon.png" alt="namaa-icon" class="ml-1">
                    تسجيل دخول مدير المتجر
                </h3>
            </div>
            <div class="col-lg-6 col-sm-12 py-5 ">

                <div class="card text-center mb-5">
                    <div class="card-header bg-primary text-light">
                        تسجيل الدخول
                    </div>
                    <div class="card-body h-100">
                        <p class="card-text">
                            <form action="<?php root('store'); ?>/login" method="post" id="login">
                                <div class="msg">
                                    <ol class="text-danger text-right"><?php echo  $data['username_error'] . "<br/>" . $data['password_error'] ; ?></ol>
                                </div>
                                <div class="form-group">
                                    <h4 class="card-title">اسم المستخدم</h4>
                                    <input dir="ltr" class="form-control" name="username" type="text" placeholder="username" value="<?php echo $data['username']; ?>" id="username">
                                </div>
                                <div class="form-group">
                                    <h4 class="card-title">كلمة المرور</h4>
                                    <input dir="ltr" class="form-control" name="password" type="password" placeholder="password" value="<?php echo $data['password']; ?>" id="password">
                                </div>
                                <button class="btn btn-primary btn-lg m-2 px-5" name="login" type="submit" data-toggle="modal" data-target="#sendcode">ارسال </button>
                            </form>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end products -->
</div>
<?php
require APPROOT . '/app/views/inc/footer.php';
?>