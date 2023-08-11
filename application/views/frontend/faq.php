<?php if(!empty($get_banner->image) && file_exists('uploads/banner/'.$get_banner->image)) {
    $banner_img=base_url("uploads/banner/".$get_banner->image);
} else {
    $banner_img=base_url("assets/images/resource/mslider1.jpg");
} ?>
<style>
	h2{text-align: unset !important;}
</style>
<section class="breadcrumbpnl" style="background-image:url(./assets/images/f-2.jpg);">
    <div class="container">
        <div class="">
            <h3 class="fw-semibold">FAQ's</h3>
            <div >
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item"><a href="<?= base_url()?>">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">FAQ's</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="innercontent py-5">
    <div class="container">
        <div><?= $get_cms->description?></div>
    </div>
</section>