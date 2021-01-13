<?php
if (isset($_SESSION['store'])) {
    require APPROOT . '/app/views/inc/store-header.php';
} else {
    require APPROOT . '/app/views/inc/header.php';
};
flash('msg'); ?>
<div class="container page">

    <!--- Products Start --->
    <section class="products mb-5 pb-5">
        <div class="row mt-4 justify-content-md-center">
            <div class="col-12">
                <h3 class="text-center">
                    <img src="<?php echo URLROOT; ?>/templates/default/images/namaa-icon.png" alt="namaa-icon" class="ml-1">
                    <?php echo 'سجل التبرعات الشخصية '; ?>
                </h3>
            </div>
            <div class="col-lg-6 col-sm-12 py-5 ">

                <div class="card text-center mb-5">
                    <div class="card-header bg-primary text-light">
                        تسجيل الدخول
                    </div>
                    <div class="card-body h-100">
                        <p>تسجيل الدخول من خلال رقم الجوال</p>
                        <h4 class="card-title">رقم الجوال</h4>
                        <p class="card-text">
                        <form action="<?php root('donors'); ?>/validate" method="post" id="login">
                            <div class="msg"></div>
                            <div class="form-group">
                                <input dir="ltr" class="form-control" name="mobile" type="text" placeholder="Mobile num" id="mobile" data-inputmask="'mask': '9999999999'">
                            </div>
                            <button class="btn btn-primary btn-lg m-2 px-5" name="login" type="submit" data-toggle="modal" data-target="#sendcode">ارسال </button>
                        </form>
                        <div id="" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="sendcode-title" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button class="close m-0 p-0" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h5 class="modal-title mx-auto" id="sendcode-title">كود التفعيل</h5>
                                    </div>
                                    <div class="msg"></div>
                                    <div class="modal-body">
                                        <form method="post" action="<?php root('projects'); ?>" id="active-code">
                                            <input class="form-control" name="code" type="text" placeholder="code" aria-label="code">
                                            <input class="btn btn-success mt-2 float-right" name="verify" type="submit" value="تأكيد">
                                            <input class="btn btn-danger mt-2 float-left" name="verify" type="submit" data-dismiss="modal" value="غلق">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end products -->
</div>
<?php
$footer = ' <script src="' . URLROOT . '/templates/default/js/jquery.inputmask.min.js"></script>' . "\n\t";
$footer .= ' <script>
                $(":input").inputmask();
            </script>' . "\n\t";
require APPROOT . '/app/views/inc/footer.php';
?>
<script>
    // send activation code
    $("#login").submit(function(event) {
        // Stop form from submitting normally
        event.preventDefault();
        // validate mobile num
        if (!$("#mobile").inputmask("isComplete")) {
            $('.msg').html('<div class="alert alert-danger text-danger"> من فضلك ادخل رقم الجوال بطريقة صحيحة </div>');
        } else {
            $('.modal').modal('show');
            $('.msg').html('');
            //prosess with the request
            var $form = $(this),
                term = $form.find("input[name='mobile']").val(),
                url = "<?php root('projects'); ?>" + "/getmobilecode";
            $.post(url, {
                    name: term,
                    time: url
                })
                .done(function(data) {
                    $('.msg').html(data);
                });
        }
    })
    // check activation code
    $("#active-code").submit(function(event) {
        // Stop form from submitting normally
        event.preventDefault();
        // Get some values from elements on the page:
        var $form = $(this),
            term = $form.find("input[name='code']").val(),
            url = "<?php root('projects'); ?>" + "/validateMobile";
        var login = 'login',
            mobile = $("#mobile").val();

        // prosess with the request
        $.post(url, {
                code: term,
                url: url,
                login: login,
                mobile: mobile
            })
            .done(function(data) {
                var data = JSON.parse(data);
                if (data.status == 'success') { // activation success
                    $('.msg').html(data.msg);
                    window.location.replace("<?php root('donors'); ?>");
                } else { // activation failed
                    $('.msg').html(data.msg);
                }
            });
    });
</script>