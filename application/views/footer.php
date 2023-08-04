<?php
$get_setting=$this->Crud_model->get_single('setting');
if(!empty($_SESSION['afrebay']['userId'])) {
    $userid=$_SESSION['afrebay']['userId'];
    $get_video=$this->Crud_model->GetData('friends_video','',"subscription_id='".$userid."' and status='0'",'','(video_id)desc','','1');
}
?>
    <footer>
        <div class="footertop py-4">
            <div class="container">
                <div class="footerlogo text-center mb-3">
                    <a href="<?=base_url(); ?>"><img src="<?=base_url(); ?>uploads/logo/<?= $get_setting->flogo?>" alt="" /></a>
                </div>
                <ul class="footernav">
                    <li><a href="<?= base_url()?>page/agents">Agents</a></li>
                    <li><a href="<?= base_url()?>page/attorneys">Attorneys</a></li>
                    <li><a href="<?= base_url()?>page/representatives">Representatives</li>
                    <li><a href="<?= base_url()?>page/blogs">Blogs</a></li>
                    <li><a href="<?= base_url()?>page/faq">FAQ</a></li>
                    <li><a href="<?= base_url()?>page/feedback">Feedback</a></li>
                    <li><a href="<?= base_url()?>page/about-us">About</a></li>
                    <li><a href="<?= base_url()?>page/contact-us">Contact</a></li>
                </ul>
                <ul class="socialicons">
                    <li><a href="<?php echo $get_setting->fb_link; ?>" target = "_blank"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="<?php echo $get_setting->tw_link; ?>" target = "_blank"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="<?php echo $get_setting->insta_link; ?>" target = "_blank"><i class="fab fa-instagram"></i></a></li>
                    <li><a href="<?php echo $get_setting->yt_link; ?>" target = "_blank"><i class="fab fa-youtube"></i></a></li>
                    <li><a href="<?php echo $get_setting->lnkd_link; ?>" target = "_blank"><i class="fab fa-linkedin-in"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="footerbottom pt-3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 text-lg-end order-lg-2">
                        <ul class="termnav">
                            <li><a href="<?= base_url()?>page/terms-condition">Terms & Conditions </a></li>
                            <li><a href="<?= base_url()?>page/privacy-policy">Privacy Policy</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-6 order-lg-1">
                        <p>©2023 Digital Sports Resume All Rights Reserved</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

	<script src="<?=base_url(); ?>assets/js/jquery-3.6.3.min.js"></script>
	<script src="<?=base_url(); ?>assets/js/bootstrap.bundle.min.js"></script>    
	<script src="<?=base_url(); ?>assets/js/owl.carousel.min.js"></script>       
	<script src="<?=base_url(); ?>assets/js/custom.js"></script>
    <input type="hidden" name="base_url" id="base_url" value="<?= base_url()?>">     
</body>
</html>