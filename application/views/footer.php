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
                    <li><a href="<?= base_url()?>page/agent_list">Agents</a></li>
                    <li><a href="<?= base_url()?>page/attorney_lists">Attorneys</a></li>
                    <li><a href="<?= base_url()?>page/representative_lists">Representatives</li>
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
                        <p>Copyright © <?php echo date('Y')?> Authorized By Me, All Rights Reserved</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog loginmodal">
            <div class="modal-content banner-form">
                <div class="modal-header border-0">
                    <h2 class="text-uppercase text-primary fw-bold h2 mb-0">Login Here</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <form action="<?=base_url(); ?>validate" method="post">
                            <div class="input-group mb-3">
                                <span class="input-group-text border-0 bg-white"><img src="<?= base_url()?>assets/images/envelope.png"></span>
                                <input type="email" class="form-control" placeholder="Email" name="login_email" id="login_email">
                            </div>
                            <div class="error text-left" id="err_login_email" style="color: red;text-align: center;"></div>
                            <div class="input-group mb-3">
                                <span class="input-group-text border-0 bg-white"><img src="<?= base_url()?>assets/images/locker.png"></span>
                                <input type="password" class="form-control" placeholder="Password" name="login_password" id="login_password">
                                <div class="error text-left" id="err_login_password" style="color: red;text-align: center;"></div>
                            </div>
                            <div class=" mb-3">
                                <label><input type="checkbox"> Remember Me</label>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary w-100 text-uppercase py-2 fw-semibold" id="rLogin" onclick="return onuserLogin();">Login</button>
                            </div>
                            <div class="mb-3 text-center">
                                <a href="#">Forgot Password?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

	<script src="<?=base_url(); ?>assets/js/jquery-3.6.3.min.js"></script>
	<script src="<?=base_url(); ?>assets/js/bootstrap.bundle.min.js"></script>    
	<script src="<?=base_url(); ?>assets/js/owl.carousel.min.js"></script>       
	<script src="<?=base_url(); ?>assets/js/custom.js"></script>
    <script src="<?= base_url('assets/js/maps2.js')?>" type="text/javascript"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtg6oeRPEkRL9_CE-us3QdvXjupbgG14A&libraries=places&callback=initMap" async defer></script>
    <script type="text/javascript" src="<?= base_url('assets/custom_js/validation.js')?>"></script>
    <input type="hidden" name="base_url" id="base_url" value="<?= base_url()?>">     
</body>
</html>