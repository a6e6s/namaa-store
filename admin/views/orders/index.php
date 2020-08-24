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
    <?php flash('order_msg'); ?>
    <div class="page-title">
        <div class="title_right">
            <h3><?php echo $data['title']; ?> <small>عرض كافة <?php echo $data['title']; ?> </small></h3>
        </div>
        <div class="title_left">
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <form action="" method="post">
                <div class="clearfix">
                </div>
                <div class="table-responsive">
                    <table class="table table-striped jambo_table bulk_action">
                        <thead>
                            <tr class="headings orders">
                                <th>
                                    <input type="checkbox" id="check-all" class="flat">
                                </th>
                                <th class="column-title">معرف التبرع <input type="search" placeholder="بحث بالمعرف" name="search[order_identifier]" value="<?php printIsset(cleanSearchVar('order_identifier')); ?>" class="w100"></th>
                                <th class="column-title">القيمة <br>
                                    <input type="search" placeholder="من" name="search[total_from]" value="<?php printIsset(cleanSearchVar('total_from')); ?>" class="w50">
                                    <input type="search" placeholder="الي" name="search[total_to]" value="<?php printIsset(cleanSearchVar('total_to')); ?>" class="w50">
                                </th>
                                <th class="column-title">اسم المتبرع <input type="search" placeholder="بحث بالمتبرع" name="search[full_name]" value="<?php printIsset(cleanSearchVar('full_name')); ?>" class="w100"></th>
                                <th class="column-title">الجوال <input type="search" placeholder="بحث بالجوال" name="search[mobile]" value="<?php printIsset(cleanSearchVar('mobile')); ?>" class="w100"></th>
                                <th class="column-title">المشروع
                                    <div class="dropdown check-list">
                                        <a href="#" data-toggle="dropdown" class="dropdown-toggle btn-default"> المشروع <b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <?php foreach ($data['projects'] as $key => $project) {
                                                echo '<li><label class="btn-default"><input class="flat" name="search[projects][]"';
                                                if (isset($_SESSION['search']['bind'])) echo in_array("($project->project_id)", $_SESSION['search']['bind']) ? 'checked' : null;
                                                echo ' type="checkbox" value="' . $project->project_id . '" > ' . $project->name . ' </label></li>';
                                            } ?>
                                        </ul>
                                    </div>
                                </th>
                                <th class="column-title">وسيلة التبرع <br>
                                    <div class="dropdown check-list">
                                        <a href="#" data-toggle="dropdown" class="dropdown-toggle btn-default"> وسيلة التبرع <b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <?php foreach ($data['paymentMethodsList'] as $pm) {
                                                echo '<li><label class="btn-default"><input class="flat" name="search[payment_method][]"';
                                                if (isset($_SESSION['search']['payment_method'])) echo in_array($pm->payment_id, $_SESSION['search']['payment_method']) ? 'checked' : null;
                                                echo ' type="checkbox" value="' . $pm->payment_id . '" > ' . $pm->title . ' </label></li>';
                                            } ?>
                                        </ul>
                                    </div>
                                </th>
                                <th class="column-title">المعرض <br>
                                    <div class="dropdown check-list">
                                        <a href="#" data-toggle="dropdown" class="dropdown-toggle btn-default"> المعرض <b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <?php foreach ($data['stores'] as $store) {
                                                echo '<li><label class="btn-default"><input class="flat" name="search[store_id][]"';
                                                if (isset($_SESSION['search']['store_id'])) echo in_array($store->store_id, $_SESSION['search']['store_id']) ? 'checked' : null;
                                                echo ' type="checkbox" value="' . $store->store_id . '" > ' . $store->name . ' </label></li>';
                                            } ?>
                                        </ul>
                                    </div>
                                </th>
                                <th class="column-title">بيانات الإهداء </th>
                                <th class="column-title">تأكيد التحويل </th>
                                <th class="column-title">تفاصيل Payfort </th>
                                <th class="column-title">تاريخ التبرع <br>
                                    <input type="date" placeholder=" من" name="search[date_from]" value="<?php if(returnIsset(cleanSearchVar('date_from'))) echo date('Y-m-d', returnIsset(cleanSearchVar('date_from'))); ?>" class="">
                                    <input type="date" placeholder=" الي" name="search[date_to]" value="<?php if(returnIsset(cleanSearchVar('date_to'))) echo date('Y-m-d', returnIsset(cleanSearchVar('date_to'))); ?>" class="">
                                </th>
                                <th class="column-title">الحالة
                                    <div class="dropdown check-list">
                                        <a href="#" data-toggle="dropdown" class="dropdown-toggle  btn-default"> الحالة <b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <?php foreach ($data['statuses'] as $status) {
                                                echo '<li><label class="btn-default"><input class="flat" name="search[status_id][]" type="checkbox"';
                                                if (isset($_SESSION['search']['status_id'])) echo in_array($status->status_id, $_SESSION['search']['status_id']) ? 'checked' : null;
                                                echo ' value="' . $status->status_id . '"> ' . $status->name . ' </label></li>';
                                            } ?>
                                        </ul>
                                    </div>
                                </th>
                                <th class="column-title no-link last"><span class="nobr">اجراءات</span><br>
                                    <select name="search[status]">
                                        <option value=""></option>
                                        <option value="1">مؤكد </option>
                                        <option value="5"> غير مؤكد </option>
                                        <option value="3"> في الانتظار </option>
                                        <option value="4">ملغاه </option>
                                    </select>
                                </th>
                                <th class="column-title w50">
                                    <input type="submit" name="search[submit]" value="بحـث" class="btn btn-sm btn-primary search-query" />
                                    <input type="submit" name="search[clearSearch]" value="مسح" class="btn btn-sm btn-warning search-query" />
                                </th>
                                <th class="bulk-actions" colspan="14">
                                    <span> تنفيذ علي الكل :</span>
                                    <input type="submit" name="publish" value="تأكيد" class="btn btn-success btn-xs" />
                                    <input type="submit" name="unpublish" value="تعليق" class="btn btn-warning btn-xs" />
                                    <input type="submit" name="canceled" value="الغاء" class="btn btn-default  btn-xs" />
                                    <input type="submit" name="waiting" value="في الانتظار" class="btn btn-info btn-xs" />
                                    <input type="submit" name="delete" value="حذف" onclick="return confirm('Are you sure?') ? true : false" class="btn btn-danger btn-xs" />
                                    <span class="control-label">ارسال :</span>
                                    <input type="submit" name="send" value="SMS" class="btn btn-success btn-sm" />
                                    <input type="submit" name="send" value="Email" class="btn btn-success btn-sm" />
                                    <span class="control-label">الوسوم :</span>
                                    <?php
                                    foreach ($data['statuses'] as $status) {
                                        echo ' <button type="submit" name="status_id"  value="' . $status->status_id . '" class="btn btn-primary btn-xs">' . $status->name . '</button> ';
                                    }
                                    ?>
                                    <span class="control-label"> حذف الوسوم :</span>
                                    <input type="submit" name="clear" value="Clear" onclick="return confirm('Are you sure?') ? true : false" class="btn btn-warning btn-xs" />

                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data['orders'] as $order) : ?>
                                <tr class="even pointer">
                                    <td class="a-center ">
                                        <input type="checkbox" class="records flat" name="record[]" value="<?php echo $order->order_id; ?>">
                                    </td>
                                    <td><?php echo $order->order_identifier; ?></td>
                                    <td><?php echo $order->total; ?></td>
                                    <td><?php echo '<a class="text-warning" href="' . ADMINURL . '/donors/show/' . $order->donor_id . '">' . $order->donor . '</a>'; ?></td>
                                    <td class="ltr"><?php echo $order->mobile; ?></td>
                                    <td><?php echo $order->projects; ?></td>
                                    <td><?php echo $order->payment_method; ?></td>
                                    <td><?php echo $order->store; ?></td>
                                    <td>
                                        <?php if ($order->gift) { ?>
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#gift<?php echo $order->order_id; ?>">تفاصيل</button>
                                            <div class="modal fade" id="gift<?php echo $order->order_id; ?>" role="dialog">
                                                <div class="modal-dialog">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-body text-right" dir="ltr">
                                                            <ul class="text-capitalize">
                                                                <?php
                                                                ($order->gift) ? $gifts = json_decode($order->gift_data) : $gifts = [];
                                                                foreach ($gifts as $key => $value) {
                                                                    if ($key == 'enable') continue;
                                                                    if ($key == 'card') {
                                                                        echo '<li class="h5">' . $key . " : <img width='200' src= '" . MEDIAURL . '/' . $value . "'></li>\n";
                                                                    } else {
                                                                        echo '<li class="h5">' . $key . " : " . $value . "</li>\n";
                                                                    }
                                                                }
                                                                ?>
                                                            </ul>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </td>
                                    <td><?php if (!empty($order->banktransferproof)) : ?>
                                            <a class="btn btn-success btn-sm" href="<?php echo URLROOT . "/media/files/banktransfer/" . $order->banktransferproof; ?>" target="blank">تحميل</a>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($order->meta) { ?>
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#meta<?php echo $order->order_id; ?>">تفاصيل</button>
                                            <div class="modal fade" id="meta<?php echo $order->order_id; ?>" role="dialog">
                                                <div class="modal-dialog">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-body text-right" dir="ltr">
                                                            <ul class="text-capitalize">
                                                                <?php
                                                                ($order->meta) ? $metas = json_decode($order->meta) : $metas = [];
                                                                foreach ($metas as $key => $value) {
                                                                    echo '<li class="h5">' . $key . " : " . $value . "</li>\n";
                                                                }
                                                                ?>
                                                            </ul>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </td>
                                    <td class="ltr"><?php echo date('Y/ m/ d | H:i a', $order->create_date); ?></td>
                                    <td><?php echo $order->status_name; ?></td>
                                    <td class="form-group w200" colspan="3">
                                        <?php
                                        if (!$order->status) {
                                            echo '<a class="btn btn-xs btn-warning" type="button" data-toggle="tooltip" data-original-title="غير مؤكد"><i class="fa fa-ban"></i></a>';
                                        } elseif ($order->status == 1) {
                                            echo '<a class="btn btn-xs btn-success" type="button" data-toggle="tooltip" data-original-title="مؤكد"><i class="fa fa-check"></i></a>';
                                        } elseif ($order->status == 3) {
                                            echo '<a class="btn btn-xs btn-info" type="button" data-toggle="tooltip" data-original-title="في الانتظار"><i class="fa fa-clock-o"></i></a>';
                                        } elseif ($order->status == 4) {
                                            echo '<a class="btn btn-xs btn-default" type="button" data-toggle="tooltip" data-original-title="ملغاه"><i class="fa fa-close"></i></a>';
                                        }
                                        ?>
                                        <a href="<?php echo ADMINURL . '/orders/show/' . $order->order_id; ?>" class="btn btn-xs btn-success" data-placement="top" data-toggle="tooltip" data-original-title="عرض"><i class="fa fa-eye"></i></a>
                                        <a href="<?php echo ADMINURL . '/orders/edit/' . $order->order_id; ?>" class="btn btn-xs btn-primary" data-placement="top" data-toggle="tooltip" data-original-title="تعديل"><i class="fa fa-edit"></i></a>
                                        <a href="<?php echo ADMINURL . '/orders/delete/' . $order->order_id; ?>" class="btn btn-xs btn-danger" data-placement="top" data-toggle="tooltip" data-original-title="حذف" onclick="return confirm('Are you sure?') ? true : false"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <tr class="tab-selected">
                                <th></th>
                                <th class="column-title" colspan="4"> العدد الكلي : <?php echo $data['recordsCount']; ?> </th>
                                <th class="column-title" colspan="6"> عرض
                                    <select name="perpage" onchange="if (this.value)
                                                window.location.href = '<?php echo ADMINURL . '/orders/index/' . $data['current']; ?>' + '/' + this.value">
                                        <option value="10" <?php echo ($data['perpage'] == 10) ? 'selected' : null; ?>>10 </option>
                                        <option value="50" <?php echo ($data['perpage'] == 50) ? 'selected' : null; ?>>50 </option>
                                        <option value="100" <?php echo ($data['perpage'] == 100) ? 'selected' : null; ?>>100 </option>
                                        <option value="200" <?php echo ($data['perpage'] == 200) ? 'selected' : null; ?>>200 </option>
                                        <option value="500" <?php echo ($data['perpage'] == 500) ? 'selected' : null; ?>>500 </option>
                                        <option value="1000" <?php echo ($data['perpage'] == 1000) ? 'selected' : null; ?>>1000 </option>
                                    </select>
                                </th>
                                <th class="column-title" colspan="3"> </th>
                                <th class="column-title no-link last"></th>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <ul class="pagination text-center">
                    <?php
                    pagination($data['recordsCount'], $data['current'], $data['perpage'], 4, ADMINURL . '/orders');
                    ?>
                </ul>
            </form>
        </div>
    </div>
</div>
<?php
// loading  plugin

$data['footer'] = '<script src="' . ADMINURL . '/template/default/vendors/select2/dist/js/select2.full.min.js"></script>
<script src="' . ADMINURL . '/template/default/vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
<script> $(".select2").select2({dir: "rtl"});</script>';

require ADMINROOT . '/views/inc/footer.php';
?>