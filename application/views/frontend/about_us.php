<?php
if(!empty($get_banner->image) && file_exists('uploads/banner/'.$get_banner->image)){
    $banner_img=base_url("uploads/banner/".$get_banner->image);
} else {
    $banner_img=base_url("<?= base_url()?>/images/resource/mslider1.jpg");
} ?>
<style>
	h2{text-align: unset !important;}
</style>
<section class="breadcrumbpnl" style="background-image:url(./<?= base_url()?>/images/f-2.jpg);">  
	<div class="container">
		<div class="">
			<h3 class="fw-semibold"><?= $get_cms->title?></h3>
			<div >
				<ol class="breadcrumb mb-2">
					<li class="breadcrumb-item"><a href="<?= base_url()?>">Home</a></li>
					<li class="breadcrumb-item active" aria-current="page">About Us</li>
				</ol>
			</div>
		</div>
	</div>
</section>
<section class="innercontent py-5">
	<div class="container">
		<img src="<?= base_url()?>assets/images/f-1.jpg" class="float-end col-lg-4 ps-lg-4 mb-3">
		<div><?= $get_cms->description?></div>
	</div>
</section>
