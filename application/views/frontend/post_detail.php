<?php
if (!empty($get_banner->image) && file_exists('uploads/banner/' . $get_banner->image)) {
    $banner_img = base_url("uploads/banner/" . $get_banner->image);
} else {
    $banner_img = base_url("assets/images/resource/mslider1.jpg");
} ?>
<style media="screen">
.postdetail {padding: 7px 33px; border-radius: 10px; background: red; color: #fff; margin: 10px; font-size: 20px;}
.cstm_viewbid_btn {background: #294CA6 !important; border: 0; border-radius: 5px; letter-spacing: 0; font-weight: 600; width: 100%; display: block; color: #fff; padding: 10px; text-align: center;}
</style>
<section class="breadcrumbpnl" style="background-image:url('<?= $banner_img ?>');">  
    <div class="container">
        <div class="">
            <h3 class="fw-semibold">Post Job</h3>
            <div >
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item"><a href="<?= base_url()?>">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url()?>">Post Job</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                    <?php if (!empty($post_data->post_title)) {
                        echo $post_data->post_title;
                    } ?>
                    </li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="dashboard-gig Bid-page">
    <div class="text-success-msg f-20" style="text-align: center; margin-bottom: 20px;">
        <?php if ($this->session->flashdata('message')) {
            echo $this->session->flashdata('message');
            unset($_SESSION['message']);
        } ?>
    </div>
    <div class="container display-table">
        <div class="row display-table-row">
            <div class="col-md-12 col-sm-12 display-table-cell v-align">
                <div class="user-dashboard">
                    <div class="row row-sm">
                        <?php if (@$_SESSION['authorized']['userType'] == '1') { ?>
                        <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 col-12">
                        <?php } else if(@$_SESSION['authorized']['userType'] == '2'){ ?>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12">
                        <?php } else { ?>
                        <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 col-12">
                        <?php } ?>
                            <div class="bid-dis">
                                <ul>
                                    <li>
                                        <span>Job Title </span>
                                        <a href="<?= base_url('page/postdetail/' . base64_encode($post_data->id)) ?>" style="text-transform: uppercase;">
                                        <?php if (!empty($post_data->post_title)) {
                                            echo $post_data->post_title;
                                        } ?>
                                        </a>
                                    </li>
                                    <?php if (!empty($post_data->description)) { ?>
                                    <li class="cstm_desc"><span>Description</span><?php echo $post_data->description; ?>
                                    <?php } ?>
                                    </li>
                                    <div class="Bid-Data">
                                        <?php if (!empty($post_data->required_key_skills)) { ?>
                                            <li><span>Required key skills </span><?php echo ucfirst($post_data->required_key_skills); ?></li>
                                        <?php } ?>
                                        <?php if (!empty($post_data->appli_deadeline)) { ?>
                                            <li><span>Application Deadline Date </span><?php echo $post_data->appli_deadeline; ?></li>
                                        <?php } ?>
                                    </div>
                                    <div class="Bid-Data">
                                        <?php if (!empty($post_data->category_id)) { ?>
                                        <li><span>Categories </span>
                                            <?php
                                            $cname = $this->db->query("SELECT * FROM category WHERE id = '" . $post_data->category_id . "'")->result_array();
                                            echo $cname[0]['category_name'];
                                            ?>
                                        </li>
                                        <?php } ?>
                                        <?php if (!empty($post_data->subcategory_id)) { ?>
                                        <li><span>Sub Categories </span>
                                            <?php
                                            $scname = $this->db->query("SELECT * FROM sub_category WHERE id = '" . $post_data->subcategory_id . "'")->result_array();
                                            echo $scname[0]['sub_category_name'];
                                            ?>
                                        </li>
                                        <?php } ?>
                                    </div>
                                    <div class="Bid-Data">
                                        <?php if (!empty($post_data->charges)) { ?>
                                        <li><span>Charges </span><?php echo $post_data->charges." ".$post_data->currency ?></li>
                                        <?php } ?>
                                        <?php if (!empty($post_data->duration)) { ?>
                                        <li><span>Duration </span><?php echo $post_data->duration; ?></li>
                                        <?php } ?>
                                    </div>
                                    <?php if (!empty($post_data->country)) { ?>
                                    <li><span>Complete Address </span><?php echo $post_data->city . ', ' . $post_data->state . ', ' . $post_data->country; ?></li>
                                    <?php } ?>
                                </ul>
                                <?php $postedBy = $this->db->query("SELECT * FROM users WHERE userId = '" . $post_data->user_id . "'")->result_array(); ?>
                                <a class="btn btn-info" href="<?= base_url('page/employerdetail/' . base64_encode($post_data->user_id)) ?>" style="background: #294CA6;color: #fff;text-transform: uppercase;letter-spacing: .5px;border: 0;padding: 8px 16px !important;border-radius: 5px;"><?= $postedBy[0]['firstname'] . ' ' . $postedBy[0]['lastname']?> </a>
                            </div>
                            <div class="employe-about d-none">
                                <ul>
                                    <li>
                                        <span class="rat-b">0.0</span>
                                        <span class="fa fa-star checked1"></span>
                                        <span class="fa fa-star checked1"></span>
                                        <span class="fa fa-star checked1"></span>
                                        <span class="fa fa-star checked1"></span>
                                        <span class="fa fa-star checked1"></span>
                                        <span>( 0 reviews )</span>
                                    </li>
                                    <li>
                                        <div class="hope-aus">
                                            <span>
                                            <?php if (!empty($post_data->user_address)) {
                                                echo $post_data->user_address;
                                            } ?></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="hope-aus1">
                                            <ul>
                                                <li><a href="javascript:void(0)"><i class="fa fa-envelope"></i></a></li>
                                                <li><a href="javascript:void(0)"><i class="fa fa-phone"></i></a></li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <?php if (@$_SESSION['authorized']['userType'] == '1' || empty(@$_SESSION['authorized']['userType'])) { ?>
                        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 col-12">
                            <?php $userBidData = $this->db->query("SELECT * FROM `job_bid` WHERE postjob_id = '".$post_data->id."' and user_id = '".@$_SESSION['authorized']['userId']."'")->result_array();
                            if(!empty($userBidData)) { ?>
                            <div class="bd-form"><a href="<?= base_url()?>profile/jobbid" class="cstm_viewbid_btn"> View Bid</a></div>
                            <?php } else { ?>
                            <form class="bd-form" action="<?= base_url('user/dashboard/save_postbid') ?>" method="post">
                                <h3 class="job-bid">Job Bidding</h3>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <label for="" class="form-label">Bid Amount</label>
                                        <div style="width: 50px; ">
                                        <?php if($countryName == 'Nigeria') { ?>
                                            <input type="text" class="form-control f1" name="currency" id="currency" value="NGN (₦)" readonly style="float: left;">
                                        <?php } else { ?>
                                            <input type="text" class="form-control f1" name="currency" id="currency" value="USD ($)" readonly style="float: left;">
                                        <?php } ?>
                                        </div>
                                        <div style="display: inline-block;width: 82%; margin-left: 10px;">
                                            <input type="text" class="form-control f1" placeholder="Your bid Amount" name="bid_amount" id="bid_amount" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <label for="" class="form-label">Duration</label>
                                        <input type="text" class="form-control f1" placeholder="Duration" name="duration" required>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <label for="" class="form-label">Details</label>
                                        <textarea class="form-control" name="description" placeholder="Description"></textarea>
                                    </div>
                                    <input type="hidden" name="postjob_id" value="<?php if (!empty($post_data->id)) { echo $post_data->id; } ?>">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="bid-btn">
                                        <?php if (!empty(@$_SESSION['authorized']['userType'])) {
                                            if (@$_SESSION['authorized']['userType'] == '1') { ?>
                                            <input type="submit" name="">
                                            <?php } else { ?>
                                            <h2 class="job-bid" style="font-size:16px;">Verdors are not eligible to Bid for jobs</h2>
                                            <?php }
                                            } else { ?>
                                            <br />
                                            <a href="<?= base_url('login') ?>" class="btn btn-info postdetail">Submit Query</a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    <?php } }?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<style>
    textarea {
    overflow: auto;
    resize: vertical;
    max-width: 100%;
    min-height: 200px !important;
    padding: 19px 28px;
}
.bid-btn {
    text-align: center;
}
.btn:not(:disabled):not(.disabled) {
    cursor: pointer;
}
.dashboard-gig .bd-form .postdetail {
    background: #294CA6 !important;
    border: 0;
    border-radius: 25px;
    font-size: 15px;
    font-weight: 600;
    letter-spacing: 0;
}
.postdetail {
    padding: 7px 33px;
    border-radius: 10px;
    background: red;
    color: #fff;
    margin: 10px;
    font-size: 20px;
}
.btn {
    font-size: 15px !important;
    text-transform: uppercase;
    font-weight: 700;
    letter-spacing: 2.5px;
    font-family: 'Nunito', sans-serif;
    box-shadow: none !important;
    border: 0;
    padding: 10px 20px !important;
}
.dashboard-gig .user-dashboard .bd-form .bid-btn input {
    background: #294CA6 !important;
    font-size: 15px !important;
    border: 0;
    color: #fff;
    border-radius: 30px !important;
    letter-spacing: 0;
    font-weight: 600;
    border-radius: 5px !important;
    padding: 10px 25px !important;
    box-shadow: none !important;
}
.bid-btn input {
    padding: 7px 33px;
    border-radius: 10px;
    background: red;
    color: #fff;
    margin: 10px;
    font-size: 20px;
}
button, a, input[type="submit"], input[type="button"] {
    cursor: pointer;
}
</style>
<script>
$(document).ready(function(){
    $("#bid_amount").on("keypress keyup blur", function (event) {
        var patt = new RegExp(/(?<=\.\d\d).+/i);
        $(this).val($(this).val().replace(patt, ''));
        if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });
})

</script>
