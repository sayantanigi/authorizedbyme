<?php if(!empty($get_banner->image) && file_exists('uploads/banner/'.$get_banner->image)) {
    $banner_img=base_url("uploads/banner/".$get_banner->image);
} else {
    $banner_img=base_url("assets/images/resource/mslider1.jpg");
} ?>
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
        <div class="mb-4">
            <h5 class="fw-semibold mb-2 h6">How does this work?</h5>
            <p>When a player is assigned their QR code, this will enable them to set up their entire profile, including videos, pictures, and links to social media accounts.  Within 30 minutes, the student athlete should be able to share their QR code with anyone and have a complete sport resume ready for viewing.</p>
        </div>
        <div class="mb-4">
            <h5 class="fw-semibold mb-2 h6">Who can see the profile?</h5>
            <p>The student athlete can showcase their profile to anyone directed to their page with the QR code.  This will be a “view only” status as other friends without profiles will not be able to navigate the site without creating a paid account. </p>
        </div>
        <div class="mb-4">
            <h5 class="fw-semibold mb-2 h6">How will we know that only coaches can view my child’s profile? </h5>
            <p>All coaches that register will complete a 2-step authentication prior to navigating the site.  If coaches do not use an “.edu” email address, a 3rd step is required by our administrator for college or university verification. </p>
        </div>
        <div class="mb-4">
            <h5 class="fw-semibold mb-2 h6">Can other registered players view my child’s profile?</h5>
            <p>Yes, they can view other players registered on the site.  You can only view other profiles and endorse another player if they have experience with each other.  There’s no comments, like buttons, etc.  This is a digital resume.</p>
        </div>
    </div>
</section>