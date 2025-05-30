
<section class="breadcrumbpnl" style="background-image:url(./assets/images/f-2.jpg);">
    <div class="container">
        <div class="">
            <h3 class="fw-semibold">List of Bids</h3>
            <div >
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item"><a href="<?= base_url()?>">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">List of Bids</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<?php $this->load->view('sidebar');?>
<div class="col-md-12 col-md-12 col-sm-12 display-table-cell v-align">
    <div class="text-success-msg f-20" style="text-align: center;">
        <?php if($this->session->flashdata('message')) {
            echo $this->session->flashdata('message');
            unset($_SESSION['message']);
        } ?>
    </div>
    <div class="user-dashboard" style="text-align: center;">
        <div class="row row-sm">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="cardak custom-cardak my-jobs-mobile">
                    <table class="table table-modific">
                        <tbody>
                            <?php
                            if(!empty($get_postjob)){
                                $i=1;
                                foreach ($get_postjob as $key) { ?>
                                <tr>
                                    <td class="table-modific-td">
                                        <table class="custom-table">
                                            <tr>
                                                <td class="heading"><?=$key->post_title; ?></td>
                                                <td class="btn-option" style="width: 205px;">
                                                    <!-- <?php if($_SESSION['authorized']['userType'] == '2') { ?>
                                                    <?php if(@$key->bidding_status=='Pending'){?>
                                                    <a href="#" onclick="change_biddingstatus('<?= $key->id?>');"><span class="badge badge-warning" >
                                                        <?= @$key->bidding_status; ?></span></a>
                                                    <?php } else if(@$key->bidding_status=='Accept'){ ?>
                                                        <span class="badge badge-success"><?= @$key->bidding_status; ?></span>
                                                    <?php } else if(@$key->bidding_status=='Reject'){?>
                                                        <span class="badge badge-danger"><?= @$key->bidding_status; ?></span>
                                                    <?php } ?>
                                                    <?php } else {
                                                        echo @$key->bidding_status;
                                                    } ?> -->
                                                    <?php
                                                    if($_SESSION['authorized']['userType'] == '2') {
                                                       

                                                            if (@$key->bidding_status == 'Screened In' || @$key->bidding_status == 'Pending' || empty (@$key->bidding_status)) { ?>
                                                                <select class="jobbid_select form-control" name="change_biddingstatus" id="change_biddingstatus_<?php echo @$key->id ?>" style="width: 80% !important;">
                                                                    <option value="">Select Option</option>
                                                                    <!-- <option value="Under Review" <?php if (@$key->bidding_status == 'Under Review') { echo "Selected"; } ?>>Under Review</option>
                                                                    <option value="Short Listed" <?php if (@$key->bidding_status == 'Short Listed') { echo "Selected"; } ?>>Short Listed</option>
                                                                    <option value="Rejected" <?php if (@$key->bidding_status == 'Rejected') { echo "Selected"; } ?>>Rejected</option>
                                                                    <option value="Selected" <?php if (@$key->bidding_status == 'Selected') { echo "Selected"; } ?>>Selected</option> -->
                                                                    <option value="Screened Out" <?php if (@$key->bidding_status == 'Screened Out') { echo "Selected"; } ?>>Screened Out</option>
                                                                    <option value="Screened In" <?php if (@$key->bidding_status == 'Screened In') { echo "Selected"; } ?>>Screened In</option>
                                                                    <option value="Ready for Interview" <?php if (@$key->bidding_status == 'Ready for Interview') { echo "Selected"; } ?>>Ready for Interview</option>
                                                                </select>








                                                            <input type="hidden" name="jodBidid" id="jodBidid_<?php echo @$key->id?>" value="<?php echo @$key->id?>"/>
                                                            <input type="hidden" name="postJobid" id="postJobid_<?php echo @$key->id?>" value="<?php echo @$key->postjob_id?>"/>
                                                            <input type="hidden" name="jobbiduserid" id="jobbiduserid_<?php echo @$key->id?>" value="<?php echo @$key->userid?>"/>
                                                            <input type="hidden" name="jobpostuserid" id="jobpostuserid_<?php echo @$key->id?>" value="<?php echo @$key->user_id?>"/>
                                                        <?php } else {
                                                            echo @$key->bidding_status; ?>
                                                            <a href="javascript:void(0)" id="view_<?php echo $key->id?>" data-toggle="tooltip" title="View"><i class="fa fa-eye" aria-hidden="true">
                                                        <?php }
                                                    } else {
                                                        echo @$key->bidding_status;
                                                        if(@$key->bidding_status == 'Short Listed' || @$key->bidding_status == 'Selected') { ?>
                                                            <a href="<?php echo base_url()?>page/employerdetail/<?= base64_encode(@$key->user_id)?>" target="_blank" class="post-job-btn" style='float: unset;background: #294ca6;border: 1px solid;color: #fff;padding: 10px;border-radius: 6px;'>Client Details</a>
                                                        <?php }
                                                    } ?>
                                                    <!-- <a href="javascript:void(0)" id="view_<?php echo $key->id?>" data-toggle="tooltip" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a> -->
                                                    <div class="modal fade" id="exampleModal_<?php echo $key->id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog list-job-modal">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Job Bid Details</h5>
                                                                    <button type="button" class="btn-close modalClose_<?php echo $key->id?>" data-bs-dismiss="modal" aria-label="Close">X</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 list-job-modal-col">
                                                                            <p>Bid Amount : <span>$ <?php echo $key->bid_amount?></span></p>
                                                                        </div>
                                                                        <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 list-job-modal-col">
                                                                            <p>Email : <span><?php echo $key->email?></span></p>
                                                                        </div> -->
                                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 list-job-modal-col">
                                                                            <p>Duration : <span><?php echo $key->duration?></span></p>
                                                                        </div>
                                                                        <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 list-job-modal-col">
                                                                            <p>Phone Number : <span><?php echo $key->mobile?></span></p>
                                                                        </div> -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="bid_contact-profile">
                                                    <?php 
                                                    //if(empty($key->profilePic)) 
                                                    if (@$key->profilePic && file_exists('uploads/users/' . @$key->profilePic)) { ?>
                                                    <img src="<?php echo base_url()?>uploads/users/<?php echo $key->profilePic?>" alt="" style="width: 60px; height: 60px; object-fit: cover;">
                                                    <?php } else { ?>
                                                    <img src="<?php echo base_url()?>uploads/users/user.png" alt="" style="width: 60px; height: 60px; object-fit: cover;">
                                                    <?php } ?>
                                                    <a href="<?php echo base_url()?>page/worker-detail/<?php echo base64_encode($key->userid)?>" target="_blank"><p><?=$key->fullname; ?></p></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="bid-amount">
                                                    <label>Bid Amount:</label> <?="USD"." ".$key->bid_amount; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="year">
                                                    <label>Date:</label> <?= date('d-M-Y',strtotime($key->created_date)); ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="desc">
                                                    <?php echo $key->description?>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="height"></td>
                                </tr>
                                <?php $i++; } } else { ?>
                                <tr>
                                    <td colspan="6">
                                        <center>No Data Found</center>
                                        <?php if($_SESSION['authorized']['userType'] == '1') {
                                        $get_sub_data = $this->db->query("SELECT * FROM employer_subscription where employer_id = ".$_SESSION['authorized']['userId']." and payment_status = 'paid'")->result_array();
                                        if(!empty($get_sub_data)) {
                                        $profile_check = $this->db->query("SELECT * FROM `users` WHERE userId = '".@$_SESSION['authorized']['userId']."'")->result_array();
                                        if(empty($profile_check[0]['firstname']) || empty($profile_check[0]['lastname']) || empty($profile_check[0]['email']) || empty($profile_check[0]['address']) || empty($profile_check[0]['short_bio'])) { ?>
                                        <button class="post-job-btn pull-right" type="submit" style="background: #294CA6;color: #fff;text-transform: uppercase;letter-spacing: .5px;border-radius: 5px !important;padding: 8px 16px !important;"><a href="javascript:void(0)" onclick="completeSub()" style="color:#fff;">Apply for Jobs</a></button>
                                        <?php } else { ?>
                                        <button class="post-job-btn pull-right" type="submit" style="background: #294CA6;color: #fff;text-transform: uppercase;letter-spacing: .5px;border-radius: 5px !important;padding: 8px 16px !important;"><a href="<?= base_url('page/ourjobs')?>" title="" target="_blank" style="color:#fff;">Apply for Jobs</a></button>
                                        <?php } } else { ?>
                                        <button class="post-job-btn pull-right" type="submit" style="background: #294CA6;color: #fff;text-transform: uppercase;letter-spacing: .5px;border-radius: 5px !important;padding: 8px 16px !important;"><a href="javascript:void(0)" onclick="completeSub()" style="color:#fff;">Apply for Jobs</a></button>
                                        <?php } } ?>
                                    </td>
                                </tr>
                                <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
// function change_biddingstatus(jobbid_id) {
//     var cnf = confirm('Are you sure to change the status?');
//     if(cnf==true) {
//         $.ajax({
//             type:"POST",
//             url:'<?= base_url('user/dashboard/changebiddingstatus')?>',
//             data:{jobbid_id:jobbid_id},
//             success:function(returndata) {
//                 if(returndata==1){
//                     location.reload();
//                 }
//             }
//         });
//     }
// }
$(document).ready(function(){
    <?php if(!empty($get_postjob)) {
    $i=1;
    foreach ($get_postjob as $value) { ?>
    $('#view_<?php echo $value->id?>').click(function() {
        $('#exampleModal_<?php echo $value->id?>').css("opacity", "1");
        $('#exampleModal_<?php echo $value->id?>').css("display", "block");
        $('#exampleModal_<?php echo $value->id?>').css("top", "0");
        $('#exampleModal_<?php echo $value->id?>').css("background", "#0e0d0d9e");
        $('.modal-content').css("top", "220px");
    })
    $('.modalClose_<?php echo $value->id?>').click(function() {
        $('#exampleModal_<?php echo $value->id?>').css("opacity", "0");
        $('#exampleModal_<?php echo $value->id?>').css("display", "none");
    })

    $('#change_biddingstatus_<?php echo $value->id ?>').change(function () {
                var bidstatus = $('#change_biddingstatus_<?php echo $value->id ?>').val();
                var jodBidid = $('#jodBidid_<?php echo $value->id ?>').val();
                var postJobid = $('#postJobid_<?php echo $value->id ?>').val();
                var jobbiduserid = $('#jobbiduserid_<?php echo $value->id ?>').val();
                var jobpostuserid = $('#jobpostuserid_<?php echo $value->id ?>').val();
                $.confirm({
                    title: 'Confirm!',
                    content: confirmationText,
                    buttons: {
                        confirm: function () {
                            $.ajax({
                                type: "POST",
                                url: '<?= base_url('user/dashboard/changebiddingstatus') ?>',
                                data: { bidstatus: bidstatus, jodBidid: jodBidid, postJobid: postJobid, jobbiduserid: jobbiduserid, jobpostuserid: jobpostuserid },
                                success: function (returndata) {
                                    //console.log(returndata);
                                    const aggrementmodal = new bootstrap.Modal(document.getElementById('aggrementmodal'));
                                    aggrementmodal.show();
                                    $('#bidstatus').val(bidstatus);
                                    $('#jodBidid').val(jodBidid);
                                    $('#postJobid').val(postJobid);
                                    $('#jobbiduserid').val(jobbiduserid);
                                    $('#jobpostuserid').val(jobpostuserid);
                                    // if (returndata == 1) {
                                    //     location.reload();
                                    // }
                                }
                            });
                        },
                        cancel: function () {
                            location.reload();
                        },
                    }
                });
            })
    <?php $i++; } } ?>
})
</script>
