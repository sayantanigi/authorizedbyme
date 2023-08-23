<?php $get_setting=$this->Crud_model->get_single('setting');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $get_setting->website_name?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="<?=base_url(); ?>uploads/logo/<?= $get_setting->favicon?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url(); ?>assets/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url(); ?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url(); ?>assets/css/owl.carousel.min.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url(); ?>assets/css/custom.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url(); ?>assets/css/chosen.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url(); ?>assets/css/colors/colors.css" />
	<link rel="stylesheet" type="text/css" href="<?=base_url(); ?>assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url(); ?>assets/css/responsive.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://unpkg.com/@mapbox/mapbox-sdk/umd/mapbox-sdk.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?=base_url(); ?>assets/rating_css.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <style>
    .completeSub {display: none; text-align: center; margin-top: 20px; color: #fa5a1f; font-size: 20px;}
    #completeSub {position: relative;display: inline-block;}
    #completeSub #completeSubtext {visibility: hidden;width: max-content;background-color: white;color: #000;text-align: center;border-radius: 6px;padding: 5px 10px;position: absolute;z-index: 1;top: 50px;font-size: 13px;right: 0;}
    #completeSub:hover #completeSubtext {visibility: visible;}
    .displayOnType {display:none}
</style>
<script>
function completeSub() {
    $('.completeSub').show();
    setTimeout(function(){
        $('.completeSub').fadeOut('slow');
    },4000);
}
// $(function () {
//     $('#completeSub').mouseover(function(){
//         $("#completeSub").css("background-color", "yellow");
//     });
// })
</script>
</head>
<body>
    <header>
		<nav class="navbar navbar-expand-lg">
		    <div class="container">
		        <a class="navbar-brand" href="<?=base_url(); ?>"><img src="<?=base_url(); ?>uploads/logo/<?= $get_setting->logo?>" alt="" /></a>
		        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		            <span class="navbar-toggler-icon"></span>
		        </button>
                <?php $url = $this->uri->segment(2);?>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link <?php if($url == "") { echo "active";}?>" aria-current="page" href="<?= base_url()?>">Home</a></li>
                        <li class="nav-item"><a class="nav-link <?php if($url == "agent_list") { echo "active";}?>" href="<?= base_url()?>page/agent_list">Agents</a></li>
                        <li class="nav-item"><a class="nav-link <?php if($url == "attorney_lists") { echo "active";}?>" href="<?= base_url()?>page/attorney_lists">Attorneys</a></li>
                        <li class="nav-item"><a class="nav-link <?php if($url == "representative_lists") { echo "active";}?>" href="<?= base_url()?>page/representative_lists">Representatives</a></li>
                        <li class="nav-item"><a class="nav-link <?php if($url == "about-us") { echo "active";}?>" href="<?= base_url()?>page/about-us">About</a></li>
                        <li class="nav-item"><a class="nav-link <?php if($url == "contact-us") { echo "active";}?>" href="<?= base_url()?>page/contact-us">Contact</a></li>
                        <?php if(!empty($_SESSION['authorized']['userId'])) { ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link btn text-capitalize" href="#" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-user"></i> Dashboard <i class="fas fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?= base_url()?>page/worker-detail/<?= base64_encode($_SESSION['authorized']['userId'])?>">Profile</a></li>
                                <?php if($_SESSION['authorized']['userType'] == 2) { ?>
                                <li><a class="dropdown-item" href="<?= base_url()?>page/postjob">Post Job</a></li>
                                <?php } else { ?>
                                <li><a class="dropdown-item" href="<?= base_url()?>page/ourjobs">Job Bid</a></li>
                                <?php } ?>
                                <?php $check_sub = $this->Crud_model->GetData('employer_subscription', '', "employer_id='".$_SESSION['authorized']['userId']."' AND status IN (1,2)");
                                if(empty($check_sub)) { ?>
                                <li><a class="dropdown-item" href="<?= base_url()?>profile/subscription">Subscription</a></li>
                                <?php } else {
                                    $profile_check = $this->db->query("SELECT `firstname`, `lastname`, `email`, `address`, `zipcode`, `short_bio` FROM `users` WHERE userId = '".@$_SESSION['authorized']['userId']."'")->result_array();
                                    if(empty($profile_check[0]['firstname']) || empty($profile_check[0]['lastname']) || empty($profile_check[0]['email']) || empty($profile_check[0]['address']) || empty($profile_check[0]['zipcode']) || empty($profile_check[0]['short_bio'])) { ?>
                                    <li><a class="dropdown-item" href="<?= base_url()?>profile/dashboard">Dashboard</a></li>
                                    <?php } else { ?>
                                    <li><a class="dropdown-item" href="<?= base_url()?>profile/dashboard">Dashboard</a></li>
                                    <?php }
                                } ?>
                                <li><a class="dropdown-item" href="<?= base_url()?>logout">Logout</a></li>
                            </ul>
                        </li>
                        <?php } else { ?>
                        <li class="nav-item"><a class="nav-link btn" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#loginModal">LOGIN</a></li>
                        <?php } ?>
                    </ul>
                </div>
		    </div>
		</nav>
	</header>
