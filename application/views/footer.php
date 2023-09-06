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
                    <!-- <li><a href="<?= base_url()?>page/blogs">Blogs</a></li> -->
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
                <div class="modal-header border-0 userLogin">
                    <h2 class="text-uppercase text-primary fw-bold h2 mb-0">Login Here</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-header border-0 userPass">
                    <h2 class="text-uppercase text-primary fw-bold h2 mb-0">Forgot Password</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <form id="login" action="<?=base_url(); ?>validate" method="post">
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
                                <a href="javascript:void(0)" id="forgot_pass">Forgot Password?</a>
                            </div>
                        </form>

                        <form id="forgotPass" method="post">
                            <div class="input-group mb-3">
                                <span class="input-group-text border-0 bg-white"><img src="<?= base_url()?>assets/images/envelope.png"></span>
                                <input type="email" class="form-control" placeholder="Registered Email Address" name="forgot_email" id="forgot_email">
                            </div>
                            <div class="error text-left" id="err_forgot_email" style="color: red;text-align: center;margin-bottom: 15px;"></div>
                            <div class="mb-3">
                                <button type="button" class="btn btn-primary w-100 text-uppercase py-2 fw-semibold" id="rfPass" onclick="return onforgotPass();">Submit</button>
                            </div>
                            <div class="mb-3 text-center">
                                <a href="javascript:void(0)" id="user_login">Go To Login</a>
                            </div>
                            <div class="mb-3 text-center successMsg" style="color: green"></div>
                            <div class="mb-3 text-center errorMsg" style="color: red"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        #forgotPass {display: none;}
        .userPass {display: none;}
    </style>
	<script src="<?=base_url(); ?>assets/js/jquery-3.6.3.min.js"></script>
	<script src="<?=base_url(); ?>assets/js/bootstrap.bundle.min.js"></script>    
	<script src="<?=base_url(); ?>assets/js/owl.carousel.min.js"></script>       
	<script src="<?=base_url(); ?>assets/js/custom.js"></script>
    <script src="<?= base_url('assets/js/maps2.js')?>" type="text/javascript"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtg6oeRPEkRL9_CE-us3QdvXjupbgG14A&libraries=places&callback=initMap" async defer></script>
    <script type="text/javascript" src="<?= base_url('assets/custom_js/validation.js')?>"></script>
    <script src="<?= base_url('assets/js/select-chosen.js')?>" type="text/javascript"></script>
    <link rel="stylesheet" href="<?php echo base_url()?>assets/multi_select/css/modern/tail.select-dark-feather.min.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/multi_select/css/modern/tail.select-dark.min.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/multi_select/css/modern/tail.select-light-feather.min.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/multi_select/css/modern/tail.select-light.min.css" />

    <script src="<?php echo base_url()?>assets/multi_select/js/tail.select.min.js"></script>
    <!-- Languages -->
    <script src="<?php echo base_url()?>assets/multi_select/langs/tail.select-de.js"></script>
    <script src="<?php echo base_url()?>assets/multi_select/langs/tail.select-es.js"></script>
    <script src="<?php echo base_url()?>assets/multi_select/langs/tail.select-fi.js"></script>
    <script src="<?php echo base_url()?>assets/multi_select/langs/tail.select-fr.js"></script>
    <script src="<?php echo base_url()?>assets/multi_select/langs/tail.select-it.js"></script>
    <script src="<?php echo base_url()?>assets/multi_select/langs/tail.select-no.js"></script>
    <script src="<?php echo base_url()?>assets/multi_select/langs/tail.select-pt_BR.js"></script>
    <script src="<?php echo base_url()?>assets/multi_select/langs/tail.select-ru.js"></script>
    <script src="<?php echo base_url()?>assets/multi_select/langs/tail.select-tr.js"></script>
    <input type="hidden" name="base_url" id="base_url" value="<?= base_url()?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script>
    var confirmTextDelete = 'Are you sure you want to delete this record?';
    var confirmationText = 'Are you sure you want to change this status?';
    $(document).ready(function () {
        tail.select('#example',{
            startOpen: true,
            multiple: true,
            stayOpen: true,
            multiPinSelected: true,
            multiShowCount: false,
            multiShowLimit: true,
            multiContainer: true,
            search: true,
            searcgConfig: [
                "text", "value"
            ],
            searchFocus: true,
            searchMarked: true,
            searchMinLength: 1,
        });

        $('.sb-title.open').next().slideDown();
        $('.sb-title.closed').next().slideUp();
        $('.sb-title').on('click', function(){
            $(this).next().slideToggle();
            $(this).toggleClass('active');
            $(this).toggleClass('closed');
        });

        $('#forgot_pass').click(function (){
            $('#forgotPass').show();
            $('#login').hide();
            $('.userLogin').hide();
            $('.userPass').css('display','flex');
        })

        $('#user_login').click(function (){
            $('#forgotPass').hide();
            $('#login').show();
            $('.userLogin').show();
            $('.userPass').hide();
        })
    })
    </script>
</body>
</html>