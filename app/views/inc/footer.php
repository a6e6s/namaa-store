<?php if ($data['site_settings']->show_categories): ?>

<div class="container">
    <section class="footer px-2">
        <div class="footer-top">
            <div class="row my-3">
                <div class="col-4"><img src="<?php echo URLROOT; ?>/templates/default/images/namaa-logo.png" alt="" class="img-fluid"></div>
                <div class="col-5"><img src="<?php echo URLROOT; ?>/templates/default/images/Banner 661.jpg" alt="" class="img-fluid"></div>
                <div class="col-3"><img src="<?php echo URLROOT; ?>/templates/default/images/Banner 662.jpg" alt="" class="img-fluid"></div>
            </div>
        </div>
        <div class="footer-bottom text-white text-center py-1 small">
            <p class="pt-3 m-0"> الإدارة العامة : جدة - حي الروضة - شارع الأمير محمد بن العبدالعزيز </p>
            <p class="p-0 m-0">ص.ب 14888 - جــدة 21434 - هاتف : 6617222 - تحويلة:303 </p>
            <p class=" m-0"><a class=" text-white" href="http://#">namaa@namma.sa</a></p>
        </div>
    </section>
</div>
<?php endif;?>

<!-- javascript -->
<script src="<?php echo URLROOT; ?>/templates/default/vendors/jquery.min.js"></script>
<script src="<?php echo URLROOT; ?>/templates/default/js/bootstrap.min.js"></script>
<script src="<?php echo URLROOT; ?>/templates/default/vendors/owlcarousel/owl.carousel.js"></script>
<script src="<?php echo URLROOT; ?>/templates/default/js/wow.min.js"></script>
<?php echo isset($footer) ? $footer : ''; ?>
<script src="<?php echo URLROOT; ?>/templates/default/js/main.js"></script>
<?php echo isset($data['site_settings']->footer_code) ? $data['site_settings']->footer_code : ''; ?>

</body>

</html>