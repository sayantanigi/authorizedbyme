<?php
if(!empty($get_banner->image) && file_exists('uploads/banner/'.$get_banner->image)){
    $banner_img=base_url("uploads/banner/".$get_banner->image);
} else {
    $banner_img=base_url("<?= base_url()?>/images/resource/mslider1.jpg");
} ?>
    <section class="breadcrumbpnl" style="background-image:url(./<?= base_url()?>/images/f-2.jpg);">  
		<div class="container">
			<div class="">
				<h3 class="fw-semibold">About Us</h3>
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
			<h2 class="fw-bold h3 text-uppercase mb-3 text-primary">simply dummy text</h2>
			<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>

			<h5 class="fw-bold"> Lorem Ipsum Available</h5>
			<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>
		</div>
	</section>
