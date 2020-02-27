<nav class="col-12 mt-1 sub-menu collapse" id="navbar-toggler">
    <a class="nav-link" href="<?php echo URLROOT; ?>">الرئيسية</a>
<?php
foreach ($data['pagesLinks'] as $page):
    echo '<a class="nav-link" href="' . URLROOT . '/pages/show/' . $page->page_id . '/' . $page->alias . '">' . $page->title . '</a>';
endforeach;
?>
    <a class="nav-link" href="#">إتصل بنا</a>
</nav>