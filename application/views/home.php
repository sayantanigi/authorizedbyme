<?php if(!empty($get_banner->image) && file_exists('uploads/banner/'.$get_banner->image)) { 
    $bannerImg = "uploads/banner/$get_banner->image";
} else {
    $bannerImg = "assets/images/2546_7.png";
} ?>   
    <section class="py-2" style="background: url(<?=base_url($bannerImg)?>);width: 100%;height: 400px;background-size: cover;background-repeat: no-repeat;">
        <div class="container">
            <div class="topsearch position-relative">
                <div class="job-search col-lg-6 col-md-12 col-sm-12 col-xs-12">
                    <form method="post" action="<?= base_url('page/search-job')?>">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="job-field">
                                    <div class="custom-select">
                                        <input type="text" name="search_title"  class="form-control" placeholder="Search Job title" value="" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                <div class="job-field">
                                    <div class="custom-select">
                                        <select class="chosen_country" name="country" id="country" onchange="getState(this.value)">
                                            <option value="0">Select Country</option>
                                            <?php if(!empty($countries)){ foreach($countries as $item){?>
                                            <option value="<?= $item->name ?>"><?= ucfirst($item->name)?></option>
                                            <?php } }?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                <div class="job-field">
                                    <div class="custom-select">
                                        <select class="chosen_state" name="state" id="state" onchange="getCity(this.value);filter_job();">
                                            <option value="">Select State</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                <div class="job-field">
                                    <div class="custom-select">
                                        <select class="chosen_city" name="city" id="city" onchange="filter_job();">
                                            <option value="">Select City</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 search-btn">
                                <button type="submit"><i class="la la-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="py-2">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-4">
                    <div class="banner-form">
                        <span class="text-invalid f-15" style="text-align: center;font-weight: 600;color: #0a9b16;">
                        <?php if($this->session->flashdata('message')) {
                            echo $this->session->flashdata('message');
                            unset($_SESSION['message']);
                        } ?>
                        </span>
                        <h3 class="text-primary fw-bold mb-0">Create Your</h3>
                        <h2 class="text-uppercase text-primary fw-bold h1" style="letter-spacing: 0px; text-align: unset;">RESUME NOW</h2>
                        <form id="signUp_form">
                            <h5 class="fw-bold text-primary">Select your type</h5>
                            <div class="fortabselect d-flex align-items-center mb-3 select-user-type">
                                <div class="itemselect" style="width:50%;">
                                    <input type="radio" name="type" id="clients" value="2" checked>
                                    <label for="clients"><span>Clients</span></label>
                                </div>
                                <div class="itemselect" style="width:50%;">
                                    <input type="radio" name="type" id="representatives" value="1">
                                    <label for="representatives"><span>Representatives</span></label>
                                </div>
                                <div class="error text-left" id="select-user-type"></div>
                            </div>
                            <div class="displayOnType">
                                <h5 class="fw-bold text-primary">Select your sub-type</h5>
                                <div class="fortabselect d-flex align-items-center mb-3 select-user-subtype">
                                    <div class="itemselect">
                                        <input type="radio" name="subtype" id="agent" value="1">
                                        <label for="agent"><span>Agent</span></label>
                                    </div>
                                    <div class="itemselect">
                                        <input type="radio" name="subtype" id="attorney" value="2">
                                        <label for="attorney"><span>Attorney</span></label>
                                    </div>
                                    <div class="itemselect">
                                        <input type="radio" name="subtype" id="representative" value="3">
                                        <label for="representative"><span>Representative</span></label>
                                    </div>
                                </div>
                                <div class="error text-left" id="err_select-user-subtype" style="color: red;text-align: center;"></div>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text border-0 bg-white"><img src="<?= base_url()?>assets/images/user.png"></span>
                                <input type="text" class="form-control" placeholder="First Name" name="firstname" id="firstname">
                            </div>
                            <div class="error text-left" id="err_firstname" style="color: red;text-align: center;"></div>
                            <div class="input-group mb-3">
                                <span class="input-group-text border-0 bg-white"><img src="<?= base_url()?>assets/images/user.png"></span>
                                <input type="text" class="form-control" placeholder="Last Name" name="lastname" id="lastname">
                            </div>
                            <div class="error text-left" id="err_lastname" style="color: red;text-align: center;"></div>
                            <div class="input-group mb-3">
                                <span class="input-group-text border-0 bg-white"><img src="<?= base_url()?>assets/images/envelope.png"></span>
                                <input type="email" class="form-control" placeholder="Email" name="email" id="email">
                            </div>
                            <div class="error text-left" id="err_email" style="color: red;text-align: center;"></div>
                            <div class="input-group mb-3">
                                <span class="input-group-text border-0 bg-white"><img src="<?= base_url()?>assets/images/locker.png"></span>
                                <input type="password" class="form-control" placeholder="Create Password" name="password" id="password">
                                <span class="input-group-text border-0 bg-white"><i class="fas fa-eye-slash" id="showpass"></i></span>
                            </div>
                            <div class="error text-left" id="err_password" style="color: red;text-align: center;"></div>
                            <div class="input-group mb-3">
                                <span class="input-group-text border-0 bg-white"><img src="<?= base_url()?>assets/images/locker.png"></span>
                                <input type="password" class="form-control" placeholder="Confirm Password" name="confirmpassword" id="confirmpassword">
                                <span class="input-group-text border-0 bg-white"><i class="fas fa-eye-slash" id="showconfirmpass"></i></span>
                            </div>
                            <div class="error text-left" id="err_showconfirmpass" style="color: red;text-align: center;"></div>
                            <div class="mb-3 mt-3">
                                <button type="button" class="btn btn-primary w-100 text-uppercase py-2 fw-semibold" id="rSignUp" onclick="return onuserRegistration();">Register</button>
                            </div>
                            <div id="register-messages" class="text-success-msg f-20">
                                <p style="color: #28a745;">We have sent an activation link to your account to continue with the registration process.</p>
                            </div>
                            <div id="err-messages">
                                <p style="color: red;">Oops, somthing went wrong. Please try again later.</p>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-7">
                    <img src="<?= base_url()?>assets/images/banner1.png">
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-3">
                    <div class="port-imgbox-top port-imgbox-bottom py-4 pe-4">
                        <img src="<?= base_url()?>assets/images/portfolio.png">
                    </div>
                </div>
                <div class="col-lg-6">
                    <h2 class="fw-bold text-primary mb-3">How can we help you to build your Portfolio</h2>
                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam.</p>
                    <div class="mt-4">
                        <a href="#" class="text-uppercase fw-bold btn btn-primary px-4">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php if(!empty($get_agents)) { ?>
    <section class="pb-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="fw-bold text-primary mb-3 me-2 h2">Popular Agents</h2>
                <a href="<?= base_url('page/agent_list')?>" class="text-uppercase fw-bold btn btn-primary px-4 mb-3">View All</a>
            </div>
            <div class="popular-players">
                <div class="owl-carousel owl-theme" id="scores">
                    <?php foreach($get_agents as $agents) { ?>
                    <div class="item text-center">
                        <a href="<?= base_url()?>page/worker-detail/<?= base64_encode($agents->userId)?>" class="listplayer">
                            <?php if(!empty($agents->profilePic)) { ?>
                            <img src="<?= base_url()?>uploads/users/<?= $agents->profilePic?>" class="listplayerimg">
                            <?php } else { ?>
                            <img src="<?= base_url()?>uploads/users/user.png" alt="" class="listplayerimg">
                            <?php } ?>
                            <h4><?= $agents->firstname." ".$agents->lastname?></h4>
                            <h6>Agents, <?= $agents->address?></h6>
                        </a>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
    <?php } ?>
    
    <?php if(!empty($get_attornyes)) { ?>
    <section class="pb-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="fw-bold text-primary mb-3 me-2 h2">Popular Attorneys</h2>
                <a href="<?= base_url('page/attorney_lists')?>" class="text-uppercase fw-bold btn btn-primary px-4 mb-3">View All</a>
            </div>
            <div class="popular-players">
                <div class="owl-carousel owl-theme" id="topteam">
                    <?php foreach($get_attornyes as $attorney) { ?>
                    <div class="item text-center">
                        <a href="<?= base_url()?>page/worker-detail/<?= base64_encode($attorney->userId)?>" class="listplayer">
                            <?php if(!empty($attorney->profilePic)) { ?>
                            <img src="<?= base_url()?>uploads/users/<?= $attorney->profilePic?>" class="listplayerimg">
                            <?php } else { ?>
                            <img src="<?= base_url()?>uploads/users/user.png" alt="" class="listplayerimg">
                            <?php } ?>
                            <h4><?= $attorney->firstname." ".$attorney->lastname?></h4>
                            <h6>Attorney, <?= $attorney->address?></h6>
                        </a>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
    <?php } ?>
    
    <?php if(!empty($get_representative)) { ?>
    <section class="pb-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="fw-bold text-primary mb-3 me-2 h2">Popular Representatives</h2>
                <a href="<?= base_url('page/representative_lists')?>" class="text-uppercase fw-bold btn btn-primary px-4 mb-3">View All</a>
            </div>
            <div class="popular-players">
                <div class="owl-carousel owl-theme" id="discover">
                    <?php foreach($get_representative as $representative) { ?>
                    <div class="item text-center">
                        <a href="<?= base_url()?>page/worker-detail/<?= base64_encode($representative->userId)?>" class="listplayer">
                            <?php if(!empty($representative->profilePic)) { ?>
                            <img src="<?= base_url()?>uploads/users/<?= $representative->profilePic?>" class="listplayerimg">
                            <?php } else { ?>
                            <img src="<?= base_url()?>uploads/users/user.png" alt="" class="listplayerimg">
                            <?php } ?>
                            <h4><?= $representative->firstname." ".$representative->lastname?></h4>
                            <h6>Representative, <?= $representative->address?></h6>
                        </a>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
    <?php } ?>

    <style>
        #register-messages {text-align: center; margin-top: 25px; display: none;}
        #err-messages {text-align: center; margin-top: 10px; display: none;}
        .job-search {position: relative; top: 80px; float: right; display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center;}
    </style>
    <script>
    function getState(val) {
        var base_url = $("#base_url").val();
        var id = val;
        $.ajax({
            type:"post",
            cache:false,
            url:base_url+"Welcome/states_by_country",
            data:{
                country_name:id
            },
            beforeSend:function(){},
            success:function(returndata) {
                $('.state_field').show();
                $('#state').html(returndata);
                $('#city').html('<option value="">Select State First</option>');
            }
        });
    }

    function getCity(val) {
        var base_url = $("#base_url").val();
        var id = val;
        $.ajax({
            type:"post",
            cache:false,
            url:base_url+"Welcome/cities_by_state",
            data:{
                state_name:id
            },
            beforeSend:function(){},
            success:function(returndata) {
                $('.city_field').show();
                $('#city').html(returndata);
            }
        });
    }
</script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script type="text/javascript" src="<?= base_url('assets/custom_js/register.js')?>"></script>