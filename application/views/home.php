    <section class="py-2">
        <div class="container">
            <div class="topsearch position-relative">
                <form>
                    <input type="text" class="form-control" name="" placeholder="Search">
                    <button class="btn"><i class="fas fa-search"></i></button>
                </form>
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
                                    <input type="radio" name="type" id="clients" value="1" checked>
                                    <label for="clients"><span>Clients</span></label>
                                </div>
                                <div class="itemselect" style="width:50%;">
                                    <input type="radio" name="type" id="representatives" value="2">
                                    <label for="representatives"><span>Representatives</span></label>
                                </div>
                                <div class="error text-left" id="select-user-type"></div>
                            </div>
                            <div class="displayOnType">
                                <h5 class="fw-bold text-primary">Select your sub-type</h5>
                                <div class="fortabselect d-flex align-items-center mb-3 select-user-subtype">
                                    <div class="itemselect">
                                        <input type="radio" name="subtype" id="agent" value="1">
                                        <label for="agents"><span>Agent</span></label>
                                    </div>
                                    <div class="itemselect">
                                        <input type="radio" name="subtype" id="attorney" value="2">
                                        <label for="attorneys"><span>Attorney</span></label>
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

    <section class="pb-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="fw-bold text-primary mb-3 me-2 h2">Discover</h2>
                <a href="#" class="text-uppercase fw-bold btn btn-primary px-4 mb-3">View All</a>
            </div>
            <div class="discoverslide">
                <div class="owl-carousel owl-theme" id="discover">
                    <div class="item">
                        <a href="#"><img src="<?= base_url()?>assets/images/f-1.jpg"></a>
                    </div>
                    <div class="item">
                        <a href="#"><img src="<?= base_url()?>assets/images/f-2.jpg"></a>
                    </div>
                    <div class="item">
                        <a href="#"><img src="<?= base_url()?>assets/images/f-3.jpg"></a>
                    </div>
                    <div class="item">
                        <a href="#"><img src="<?= base_url()?>assets/images/f-4.jpg"></a>
                    </div>
                    <div class="item">
                        <a href="#"><img src="<?= base_url()?>assets/images/f-3.jpg"></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pb-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="fw-bold text-primary mb-3 me-2 h2">Popular Players</h2>
                <a href="#" class="text-uppercase fw-bold btn btn-primary px-4 mb-3">View All</a>
            </div>
            <div class="popular-players">
                <div class="owl-carousel owl-theme" id="players">
                    <div class="item text-center">
                        <a href="" class="listplayer">
                            <img src="<?= base_url()?>assets/images/user-1.jpg" class="listplayerimg">
                            <h4>Sam Mendes</h4>
                            <h6>Footballer, Gemini United</h6>
                        </a>
                    </div>
                    <div class="item text-center">
                        <a href="" class="listplayer">
                            <img src="<?= base_url()?>assets/images/user-2.jpg" class="listplayerimg">
                            <h4>Sam Mendes</h4>
                            <h6>Footballer, Gemini United</h6>
                        </a>
                    </div>
                    <div class="item text-center">
                        <a href="" class="listplayer">
                            <img src="<?= base_url()?>assets/images/user-3.jpg" class="listplayerimg">
                            <h4>Sam Mendes</h4>
                            <h6>Footballer, Gemini United</h6>
                        </a>
                    </div>
                    <div class="item text-center">
                        <a href="" class="listplayer">
                            <img src="<?= base_url()?>assets/images/user-1.jpg" class="listplayerimg">
                            <h4>Sam Mendes</h4>
                            <h6>Footballer, Gemini United</h6>
                        </a>
                    </div>
                    <div class="item text-center">
                        <a href="" class="listplayer">
                            <img src="<?= base_url()?>assets/images/user-2.jpg" class="listplayerimg">
                            <h4>Sam Mendes</h4>
                            <h6>Footballer, Gemini United</h6>
                        </a>
                    </div>
                    <div class="item text-center">
                        <a href="" class="listplayer">
                            <img src="<?= base_url()?>assets/images/user-3.jpg" class="listplayerimg">
                            <h4>Sam Mendes</h4>
                            <h6>Footballer, Gemini United</h6>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pb-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="fw-bold text-primary mb-3 me-2 h2">Top Scores</h2>
                <a href="#" class="text-uppercase fw-bold btn btn-primary px-4 mb-3">View All</a>
            </div>
            <div class="teamboxslide">
                <div class="owl-carousel owl-theme" id="scores">
                    <div class="item">
                        <a href="#" class="d-block">
                            <div class="topteam-1 mb-1">
                                <img src="<?= base_url()?>assets/images/team-logo1.png">
                            </div>
                            <div class="topteam-2 text-end">
                                <img src="<?= base_url()?>assets/images/team-logo2.png">
                            </div>
                        </a>
                    </div>
                    <div class="item">
                        <a href="#" class="d-block">
                            <div class="topteam-1 mb-1">
                                <img src="<?= base_url()?>assets/images/team-logo3.png">
                            </div>
                            <div class="topteam-2 text-end">
                                <img src="<?= base_url()?>assets/images/team-logo4.png">
                            </div>
                        </a>
                    </div>
                    <div class="item">
                        <a href="#" class="d-block">
                            <div class="topteam-1 mb-1">
                                <img src="<?= base_url()?>assets/images/team-logo5.png">
                            </div>
                            <div class="topteam-2 text-end">
                                <img src="<?= base_url()?>assets/images/team-logo6.png">
                            </div>
                        </a>
                    </div>
                    <div class="item">
                        <a href="#" class="d-block">
                            <div class="topteam-1 mb-1">
                                <img src="<?= base_url()?>assets/images/team-logo2.png">
                            </div>
                            <div class="topteam-2 text-end">
                                <img src="<?= base_url()?>assets/images/team-logo4.png">
                            </div>
                        </a>
                    </div>
                    <div class="item">
                        <a href="#" class="d-block">
                            <div class="topteam-1 mb-1">
                                <img src="<?= base_url()?>assets/images/team-logo5.png">
                            </div>
                            <div class="topteam-2 text-end">
                                <img src="<?= base_url()?>assets/images/team-logo1.png">
                            </div>
                        </a>
                    </div>
                    <div class="item">
                        <a href="#" class="d-block">
                            <div class="topteam-1 mb-1">
                                <img src="<?= base_url()?>assets/images/team-logo2.png">
                            </div>
                            <div class="topteam-2 text-end">
                                <img src="<?= base_url()?>assets/images/team-logo3.png">
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pb-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="fw-bold text-primary mb-3 me-2 h2">Top Teams</h2>
                <a href="#" class="text-uppercase fw-bold btn btn-primary px-4 mb-3">View All</a>
            </div>
            <div class="topteamslide">
                <div class="owl-carousel owl-theme" id="topteam">
                    <div class="item">
                        <a href="#"><img src="<?= base_url()?>assets/images/team1.jpg"></a>
                    </div>
                    <div class="item">
                        <a href="#"><img src="<?= base_url()?>assets/images/team2.jpg"></a>
                    </div>
                    <div class="item">
                        <a href="#"><img src="<?= base_url()?>assets/images/team3.jpg"></a>
                    </div>
                    <div class="item">
                        <a href="#"><img src="<?= base_url()?>assets/images/team4.jpg"></a>
                    </div>
                    <div class="item">
                        <a href="#"><img src="<?= base_url()?>assets/images/team5.jpg"></a>
                    </div>
                    <div class="item">
                        <a href="#"><img src="<?= base_url()?>assets/images/team2.jpg"></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <style>
        #register-messages {text-align: center; margin-top: 25px; display: none;}
        #err-messages {text-align: center; margin-top: 10px; display: none;}
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script type="text/javascript" src="<?= base_url('assets/custom_js/register.js')?>"></script>