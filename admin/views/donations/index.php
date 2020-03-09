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
$data['header'] = '';

require ADMINROOT . '/views/inc/header.php';
?>

<!-- page content -->

<div class="right_col" role="main">
    <div class="clearfix"></div>
    <?php flash('donation_msg');?>
    <div class="page-title">
        <div class="title_right">
            <h3><?php echo $data['title']; ?> <small>عرض كافة <?php echo $data['title']; ?> </small></h3>
        </div>
        <div class="title_left">
            <!-- <a href="<?php echo ADMINURL; ?>/donations/add" class="btn btn-success pull-left">انشاء جديد <i class="fa fa-plus"></i></a> -->
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">

            <form action="" method="post">
                <div class="table-responsive">
                    <table class="table table-striped jambo_table bulk_action">
                        <thead>
                            <tr class=" form-group-sm">
                                <th width="70px"><input type="submit" name="search[submit]" value="بحث" class="btn btn-sm btn-primary search-query" /></th>
                                <th><input type="search" class="form-control" placeholder="بحث بالمعرف" name="search[donation_identifier]" value=""></th>
                                <th><input type="search" class="form-control" placeholder="بحث بالقيمة" name="search[amount]" value=""></th>
                                <!-- <th><input type="search" class="form-control" placeholder="بحث بالمتبرع" name="search[donor_id]" value=""></th>
                                <th><input type="search" class="form-control" placeholder="بحث بالمشروع" name="search[project_id]" value=""></th>
                                <th><input type="search" class="form-control" placeholder="بحث بوسيلة التبرع" name="search[payment_method_id]" value=""></th> -->
                                <th colspan="7"></th>
                                <th width="175px">
                                    <select class="form-control" name="search[status]">
                                        <option value=""></option>
                                        <option value="1">مؤكد </option>
                                        <option value="0"> غير مؤكد </option>
                                    </select>
                                </th>
                            </tr>
                            <tr class="headings">
                                <th>
                                    <input type="checkbox" id="check-all" class="flat">
                                </th>
                                <th class="column-title">معرف التبرع </th>
                                <th class="column-title">القيمة </th>
                                <th class="column-title">اسم المتبرع </th>
                                <th class="column-title">المشروع </th>
                                <th class="column-title">وسيلة التبرع </th>
                                <th class="column-title">تأكيد التحويل </th>
                                <th class="column-title">تفاصيل Payfort </th>
                                <th class="column-title">تاريخ التبرع </th>
                                <th class="column-title">آخر تحديث </th>
                                <th class="column-title no-link last"><span class="nobr">اجراءات</span></th>
                                <th class="bulk-actions" colspan="10">
                                    <span> تنفيذ علي الكل :</span>
                                    <input type="submit" name="publish" value="Publish" class="btn btn-success btn-xs" />
                                    <input type="submit" name="unpublish" value="Unpublish" class="btn btn-warning btn-xs" />
                                    <input type="submit" name="delete" value="حذف" onclick="return confirm('Are you sure?') ? true : false" class="btn btn-danger btn-xs" />
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data['donations'] as $donation): ?>
                                <tr class="even pointer">
                                    <td class="a-center ">
                                        <input type="checkbox" class="records flat" name="record[]" value="<?php echo $donation->donation_id; ?>">
                                    </td>
                                    <td><?php echo $donation->donation_identifier; ?></td>
                                    <td><?php echo $donation->amount; ?></td>
                                    <td><?php echo $donation->donor; ?></td>
                                    <td><?php echo $donation->project; ?></td>
                                    <td><?php echo $donation->payment_method; ?></td>
                                    <td><?php if(!empty($donation->banktransferproof)): ?>
                                        <a class="btn btn-success btn-sm" href="<?php echo URLROOT ."/media/files/banktransfer/". $donation->banktransferproof; ?>" target="blank">تحميل</a>
                                    <?php endif; ?>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#meta<?php echo $donation->donation_id; ?>">تفاصيل</button>
                                        <div class="modal fade" id="meta<?php echo $donation->donation_id; ?>" role="dialog">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-body text-right" dir="ltr">
                                                        <ul class="text-capitalize">
                                                            <?php
                                                            ($donation->meta) ? $metas = json_decode($donation->meta) : $metas = [];
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
                                    </td>
                                    <td class="ltr"><?php echo date('Y/ m/ d | H:i a', $donation->create_date); ?></td>
                                    <td class="ltr"><?php echo date('Y/ m/ d | H:i a', $donation->modified_date); ?></td>
                                    <td class="form-group">
                                        <?php
                                        if (!$donation->status) {
                                            echo '<a href="' . ADMINURL . '/donations/publish/' . $donation->donation_id . '" class="btn btn-xs btn-warning" type="button" data-toggle="tooltip" data-original-title="غير مؤكد"><i class="fa fa-ban"></i></a>';
                                        } elseif ($donation->status == 1) {
                                            echo '<a href="' . ADMINURL . '/donations/unpublish/' . $donation->donation_id . '" class="btn btn-xs btn-success" type="button" data-toggle="tooltip" data-original-title="مؤكد"><i class="fa fa-check"></i></a>';
                                        }
                                        ?>
                                        <a href="<?php echo ADMINURL . '/donations/show/' . $donation->donation_id; ?>" class="btn btn-xs btn-success" data-placement="top" data-toggle="tooltip" data-original-title="عرض"><i class="fa fa-eye"></i></a>
                                        <a href="<?php echo ADMINURL . '/donations/edit/' . $donation->donation_id; ?>" class="btn btn-xs btn-primary" data-placement="top" data-toggle="tooltip" data-original-title="تعديل"><i class="fa fa-edit"></i></a>
                                        <a href="<?php echo ADMINURL . '/donations/delete/' . $donation->donation_id; ?>" class="btn btn-xs btn-danger" data-placement="top" data-toggle="tooltip" data-original-title="حذف" onclick="return confirm('Are you sure?') ? true : false"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach;?>

                            <tr class="tab-selected">
                                <th></th>
                                <th class="column-title"> </th>
                                <th class="column-title"> العدد الكلي : <?php echo $data['recordsCount']; ?> </th>
                                <th class="column-title" colspan="6"> عرض
                                    <select name="perpage" onchange="if (this.value)
                                                window.location.href = '<?php echo ADMINURL . '/donations/index/' . $data['current']; ?>' + '/' + this.value">
                                        <option value="10" <?php echo ($data['perpage'] == 10) ? 'selected' : null; ?>>10 </option>
                                        <option value="50" <?php echo ($data['perpage'] == 50) ? 'selected' : null; ?>>50 </option>
                                        <option value="100" <?php echo ($data['perpage'] == 100) ? 'selected' : null; ?>>100 </option>
                                        <option value="200" <?php echo ($data['perpage'] == 200) ? 'selected' : null; ?>>200 </option>
                                        <option value="500" <?php echo ($data['perpage'] == 500) ? 'selected' : null; ?>>500 </option>
                                        <option value="1000" <?php echo ($data['perpage'] == 1000) ? 'selected' : null; ?>>1000 </option>
                                    </select>
                                </th>
                                <th class="column-title"> </th>
                                <th class="column-title no-link last"></th>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <ul class="pagination text-center">
                    <?php
                    pagination($data['recordsCount'], $data['current'], $data['perpage'], 4, ADMINURL . '/donations');
                    ?>
                </ul>


            </form>

        </div>
    </div>
</div>
<?php
// loading  plugin
$data['footer'] = '';

require ADMINROOT . '/views/inc/footer.php';
