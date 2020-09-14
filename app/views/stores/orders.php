<?php require APPROOT . '/app/views/inc/header.php'; ?>
</div>
<div class="container">
    <!-- Categories -->
    <section id="categories" class="mb-5">
        <div class="card text-right">
            <img class="card-img-top" src="holder.js/100px180/" alt="">
            <div class="card-body">
                <h4 class="card-title">
                    <a class="btn-danger btn float-left" href="<?php root('store/logout') ?>">Logout</a>
                    <img src="<?php echo URLROOT; ?>/templates/default/images/namaa-icon.png" alt="Smiley face" class="ml-2">سجل التبرعات</h4>
                <p class="card-text">
                    <table class="table">
                        <thead class="thead-inverse">
                            <tr>
                                <th class="column-title">معرف التبرع </th>
                                <th class="column-title">الاجمالي </th>
                                <th class="column-title">المشروع </th>
                                <th class="column-title">تاريخ التبرع </th>
                                <th class="column-title">حالة التبرع </th>
                            </tr>
                        </thead>
                        <tbody class="">
                            <?php
                            echo (count($data['orders']) > 0) ? '' : '<tr><th colspan ="9">لا يوجد تبرعات سابقة  </th></tr>';
                            foreach ($data['orders'] as $order) {
                                switch ($order->status) {
                                    case '0':
                                        $order->status = '<a class="btn btn-warning" data-toggle="tooltip" title="غير مؤكد"><i class="text-light icofont-not-allowed"></i></a>';
                                        break;
                                    case '1':
                                        $order->status = '<a class="btn btn-success" data-toggle="tooltip" title="مؤكد"><i class="text-light icofont-check-circled"></i></a>';
                                        break;
                                    case '3':
                                        $order->status = '<a class="btn btn-info" data-toggle="tooltip" title="في الانتظار"><i class="text-light icofont-history"></i></a>';
                                        break;
                                    case '4':
                                        $order->status = '<a class="btn btn-danger" data-toggle="tooltip" title="ملغاه"><i class="text-light icofont-close-circled"></i></a>';
                                        break;
                                }
                                echo "<tr>
                                        <td>$order->order_identifier</td>
                                        <td>$order->total</td>
                                        <td>$order->projects</td>
                                        <td>" . date('Y/ m/ d | H:i a', $order->modified_date) . "</td>
                                        <td>$order->status</td>
                                    </tr>";
                            }; ?>

                        </tbody>
                    </table>
                </p>
            </div>
        </div>
    </section>
    <!-- end Categories -->
    <?php require APPROOT . '/app/views/inc/footer.php'; ?>