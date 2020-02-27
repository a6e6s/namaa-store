<?php require APPROOT . '/app/views/inc/header.php';?>

        <!--- Product Start --->
        <section id="products">
            <div class="product mt-3 wow zoomIn">
                <div class="card ">
                    <div id="project-slider" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li class="active" data-target="#project-slider" data-slide-to="0" aria-current="location"></li>
                            <li data-target="#project-slider" data-slide-to="1"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="https://via.placeholder.com/728x390.png?text=111" alt="">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="https://via.placeholder.com/728x390.png?text=222" alt="">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#project-slider" data-slide="prev" role="button">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        </a>
                        <a class="carousel-control-next" href="#project-slider" data-slide="next" role="button">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        </a>
                    </div>
                    <div class="text-white bg-primary text-center">
                        <div class="row m-0">
                            <div class="col-10">
                                <div class="p-2">
                                    <p class="m-0">6546 مساهمة</p>
                                    <div class="progress">
                                        <h6 class="p-1 progress-bar progress-bar-striped bg-success" role="progressbar"
                                            style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">80 %
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2 border-right p-2">
                                <h4> <span>200</span> SAR</h4>
                            </div>
                        </div>
                    </div>
                    <div class="body-card m-2">
                        <h1 class="font-weight-bold text-center"> مشروع زكاتك عطاء ونماء </h1>
                        <p class="card-text">
                            <?php var_dump($data['project']) ?>
                            مشروع زكاتك عطاء ونماء <br>
                            <br> ( وَيُقِيمُونَ الصَّلَاةَ وَيُؤْتُونَ الزَّكَاةَ وَيُطِيعُونَ اللَّهَ وَرَسُولَهُ ۚ
                            أُولَٰئِكَ سَيَرْحَمُهُمُ اللَّهُ ۗ إِنَّ اللَّهَ عَزِيزٌ حَكِيمٌ )
                            <br> زكـاتـك ... عطاء ونماء
                            <br> الزكاة عطاء للمحتاج ونماء للمال وحفظ للأهل والأولاد
                            <br> وهي حق واجب علي من أنعم الله عليه ورحمة بالمحروم
                            <br> يستفيد من زكاتك أكثر من عشرة آلاف أسرة محتاجة و1200 يتيم
                            <br> فضلا ادخل مبلغ الزكاة في خانة الكمية.
                            <br> بارك الله فيكم ونفعنا واياكم وجعله في ميزان حسناتكم.. </p>
                    </div>
                    <div class="card-footer bg-primary mt-1">
                        <div class="text-center  ">
                            <h4 class="text-white">ملئ معلومات الطلب </h4>
                        </div>
                    </div>
                    <div class="pay-form p-5">
                        <div class="msg"></div>
                        <form method="post" action="<?php root('projects');?>/redirect" id="pay">
                            <div class="form-group row">
                                <label for="full-name" class="col-sm-2 col-form-label">الاسم بالكامل</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="full-name" id="full-name" data-inputmask-regex="^[\u0621-\u064Aa-zA-Z\-_\s]+$" placeholder="الاسم بالكامل">
                                    <input type="hidden" name="order_description" value="مشروع زكاتك عطاء ونماء" id="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="mobile" class="col-sm-2 col-form-label">رقم الجوال</label>
                                <div class="input-group col-sm-10 mobile-validate">
                                    <input dir="ltr" class="form-control" name="mobile" type="text" placeholder="Mobile num" id="mobile" data-inputmask="'mask': '+\\966 99 9999999'">
                                    <div class="input-group-append">
                                        <a class="input-group-text activate" data-toggle="modal" data-target="#addcode-x" >ارسال </a>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">دفع</button>
                        </form>
                    </div>
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
                                    <form method="post" action="<?php root('projects');?>" id="active-code">
                                        <div class="msg"></div>
                                        <input class="form-control" name="code" type="text" placeholder="code" aria-label="code">
                                        <input class="btn btn-success mt-2" name="verify" type="submit" value="تفعيل">
                                        <input class="btn btn-danger mt-2 float-left" name="verify" type="submit" data-dismiss="modal" value="غلق">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="divider mx-auto p-1">
                        <!-- Go to www.addthis.com/dashboard to customize your tools -->
                        <div class="addthis_inline_share_toolbox"></div>
                    </div>
                </div>
            </div>

        </section>
        <!-- End product -->
<?php
$footer = ' <script src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-508116077910fef8"></script>' . "\n\t";
$footer .= ' <script src="' . URLROOT . '/templates/default/js/jquery.inputmask.min.js"></script>' . "\n\t";
$footer .= ' <script>
                $("form").submit(false);
                $(":input").inputmask();

                
            </script>' . "\n\t";
require APPROOT . '/app/views/inc/footer.php';?>
