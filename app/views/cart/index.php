<?php
if (isset($_SESSION['store'])) {
    require APPROOT . '/app/views/inc/store-header.php';
} else {
    require APPROOT . '/app/views/inc/header.php';
}
?>
<?php flash('msg'); ?>
<div class="card cart">
    <div class="card-header text-center">
        <h4 class="">سلة التبرع</h4>
    </div>
    <div class="card-body">
        <div class="card-text">
            <table class="table table-light" id="cart">
                <thead class="thead-light">
                    <tr>
                        <th> المشروع</th>
                        <th>القيمة</th>
                        <th>الكمية</th>
                        <th>النوع </th>
                        <th>حذف</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total = 0;
                    if (isset($_SESSION['cart'])) {
                        foreach ($_SESSION['cart']['items'] as $key => $value) {
                            echo "<tr>
                                    <td><a href='" . URLROOT . "/projects/show/ " . $value['project_id'] . "' >" . $value['name'] . "</a></td>
                                    <td>" . $value['amount'] . "</td>
                                    <td><form class='form-row' action='" . URLROOT . "/carts/setQuantity' method='post'>
                                        <input class='form-control col-2' type='number' value='" . $value['quantity'] . "' name='quantity' >
                                        <button class='btn btn-sm  btn-primary mx-1' name='index' type='submit' value='" . $key . "'>Set</button></form>
                                    </td>
                                    <td>" . $value['donation_type'] . "</td>
                                    <td><a href='" . URLROOT . "/carts/remove/$key'>حذف</a></td>
                                </tr>";
                            $total += ($value['amount'] * $value['quantity']);
                        }
                    } else {
                        echo '<div class="alert alert-primary text-center" role="alert"> لا يوجد منتجات في السلة  </div>';
                    }

                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="2">الاجمالي</th>
                        <th><?php echo $total; ?></th>
                        <th colspan="1"><?php if (isset($_SESSION['cart']['totalQty'])) echo $_SESSION['cart']['totalQty']; ?> </th>
                        <th><a href="<?php echo URLROOT . '/carts/removeAll'; ?>">افراغ </a></th>
                    </tr>
                </tfoot>
            </table>
            <!-- end of card table -->
            <!-- payment methods -->
            <div class="border-top">
                <div class="msg"></div>
                <form method="post" action="<?php root('projects'); ?>/cartRedirect" id="pay">
                    <h5 class="py-3">اختار وسيلة الدفع</h5>
                    <div class="input-group col-sm-8 ">
                        <div class=" btn-group-toggle" data-toggle="buttons">
                            <?php
                            foreach ($data['payment_methods'] as $payment_method) {
                                echo '<label class="btn btn-primary  mt-2  mx-1">
                                <input type="radio" value ="' . $payment_method->payment_id . '" name="payment_method" required class="payment_method"> ' . $payment_method->title . '
                            </label>';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-group row mt-4">
                        <label for="full-name" class="col-sm-2 col-form-label"> البريد الالكتروني </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="email" placeholder="هام لاستقبال رسائل التأكيد">
                        </div>
                    </div>
                    <div class="form-group row mt-4">
                        <label for="full-name" class="col-sm-2 col-form-label">الاسم بالكامل</label>
                        <div class="col-sm-10">
                            <input type="hidden" name="mobile_confirmed" value="no" id="mobile-confirmed">
                            <input type="hidden" name="total" value="<?php echo $total; ?>" id="total">
                            <input type="hidden" name="store_id" value="<?php echo isset($_SESSION['store']) ? $_SESSION['store']['store_id'] : ''; ?>" id="store_id">
                            <input type="text" class="form-control" name="full_name" id="full-name" data-inputmask-regex="^[\u0621-\u064Aa-zA-Z\-_\s]+$" placeholder="الاسم بالكامل">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="mobile" class="col-sm-2 col-form-label">رقم الجوال</label>
                        <div class="input-group col-sm-10 mobile-validate">
                            <input dir="ltr" class="form-control" name="mobile" type="text" placeholder="0500000000" id="mobile" data-inputmask="'mask': '9999999999'">
                            <?php if ($data['site_settings']->mobile_validation) { ?>
                                <div class="">
                                    <a class="input-group-text activate" data-toggle="modal" data-target="#addcode-x">ارسال </a>
                                </div>
                            <?php } ?>

                        </div>
                    </div>
                    <div class="form-group text-center">
                        <button class="btn btn-primary btn-lg m-2 px-5" name="pay" type="submit">دفع <i class="icofont-riyal"></i> </button>
                    </div>
                </form>
                <!-- code activation modal -->
                <div id="addcode" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addcode-title" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button class="close m-0 p-0" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h5 class="modal-title mx-auto" id="addcode-title">كود التفعيل</h5>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="<?php root('projects'); ?>" id="active-code">
                                    <div class="msg"></div>
                                    <input class="form-control" name="code" type="text" placeholder="code" aria-label="code">
                                    <input class="btn btn-success mt-2" name="verify" type="submit" value="تفعيل">
                                    <input class="btn btn-danger mt-2 float-left" name="verify" type="submit" data-dismiss="modal" value="غلق">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end payment methods -->
        </div>
    </div>
    <div class="row ">

        <div class="col-md-6 mx-auto mt-2">
            <a class="w-100 btn btn-lg btn-secondary icofont-home" href="<?php echo isset($_SESSION['store']) ? URLROOT . '/store/' . $_SESSION['store']['alias']: URLROOT ; ?>">
                العودة الي الرئيسية</a>
        </div>
    </div>
</div>
</div>
<?php
$footer = ' <script src="' . URLROOT . '/templates/default/js/jquery.inputmask.min.js"></script>' . "\n\t";
$footer .= ' <script>
                $(":input").inputmask();
            </script>' . "\n\t";
require APPROOT . '/app/views/inc/footer.php'; ?>