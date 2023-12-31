
<section class="breadcrumbpnl" style="background-image:url(./assets/images/f-2.jpg);">
    <div class="container">
        <div class="">
            <h3 class="fw-semibold">My Jobs</h3>
            <div >
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item"><a href="<?= base_url()?>">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">My Jobs</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<?php $this->load->view('sidebar');?>
<div class="col-md-12 col-md-12 col-sm-12 display-table-cell v-align">
    <div id="product-messages" class="text-success-msg f-20">
        <p style="color: #28a745;">Job Deleted Successfully.</p>
    </div>
    <div id="err-messages">
        <h4 style="color: red;">Error</h4>
        <p style="color: red;">Oops, somthing went wrong. Please try again later.</p>
    </div>
    <div class="text-success-msg f-20" style="text-align: center;">
        <?php if($this->session->flashdata('message')) {
            echo $this->session->flashdata('message');
            unset($_SESSION['message']);
        } ?>
    </div>
    <div class="user-dashboard">
        <div class="row row-sm">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="cardak custom-cardak">
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
                                            <td class="heading">
                                            <?php
                                            $string = strip_tags($key->post_title);
                                            if (strlen($string) > 100) {
                                                $stringCut = substr($string, 0, 100);
                                                $endPoint = strrpos($stringCut, ' ');
                                                $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                                $string .= '...';
                                            }
                                            echo $string;
                                            ?>
                                            </td>
                                            <td class="btn-option">
                                                <a href="<?php echo base_url('page/postdetail/'.base64_encode($key->id))?>" target="_blank"><i  class="fa fa-eye" aria-hidden="true"></i></a>
                                                <a href="<?php echo base_url('page/update-postjob/'.base64_encode($key->id))?>"><i class="fa fa-edit" aria-hidden="true" style="padding-left: 10px;"></i></a>
                                                <a href="javascript:void(0)" data-toggle="tooltip" title="Delete" onclick="jobDelete(<?php echo $key->id;?>)"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="year">
                                                <label>Duration:</label> <?=$key->duration." "; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="year">
                                                <label>Deadline:</label> <?=$key->appli_deadeline; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="bid-amount">
                                                <label>Remuneration ($):</label> <?="USD"." ".$key->charges; ?>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" class="height"></td>
                            </tr>
                            <?php $i++; }}else{?>
                                <tr>
                                    <td colspan="6">
                                        <center>No Data Found</center>
                                        <?php if($_SESSION['authorized']['userType'] == '2') {
                                        $get_sub_data = $this->db->query("SELECT * FROM employer_subscription where employer_id = ".$_SESSION['authorized']['userId']." and payment_status = 'paid'")->result_array();
                                        if(!empty($get_sub_data)) {
                                        $profile_check = $this->db->query("SELECT * FROM `users` WHERE userId = '".@$_SESSION['authorized']['userId']."'")->result_array();
                                        if(empty($profile_check[0]['firstname']) || empty($profile_check[0]['lastname']) || empty($profile_check[0]['email']) || empty($profile_check[0]['address']) || empty($profile_check[0]['short_bio'])) { ?>
                                        <button class="post-job-btn pull-right" type="submit" style="background: #294ca6;border: 0 !important;"><a style=" float: left; font-family: Open Sans; font-size: 15px; color: #ffffff; padding: 10px 27px; -webkit-border-radius: 40px; -moz-border-radius: 40px; -ms-border-radius: 40px; -o-border-radius: 40px; border-radius: 40px; font-family: 'Poppins', sans-serif;" href="javascript:void(0)" onclick="completeSub()">Post Jobs</a></button>
                                        <?php } else { ?>
                                        <button class="post-job-btn pull-right" type="submit" style="background: #294ca6;border: 0 !important;"><a style=" float: left; font-family: Open Sans; font-size: 15px; color: #ffffff; padding: 10px 27px; -webkit-border-radius: 40px; -moz-border-radius: 40px; -ms-border-radius: 40px; -o-border-radius: 40px; border-radius: 40px; font-family: 'Poppins', sans-serif;" href="<?= base_url('page/postjob')?>" title="" target="_blank">Post Jobs</a></button>
                                        <?php } } else { ?>
                                        <button class="post-job-btn pull-right" type="submit" style="background: #294ca6;border: 0 !important;"><a style=" float: left; font-family: Open Sans; font-size: 15px; color: #ffffff; padding: 10px 27px; -webkit-border-radius: 40px; -moz-border-radius: 40px; -ms-border-radius: 40px; -o-border-radius: 40px; border-radius: 40px; font-family: 'Poppins', sans-serif;" href="javascript:void(0)" onclick="completeSub()">Post Jobs</a></button>
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
<div id="add_project" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header login-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Add Project</h4>
            </div>
            <div class="modal-body">
                <input type="text" placeholder="Project Title" name="name" />
                <input type="text" placeholder="Post of Post" name="mail" />
                <input type="text" placeholder="Author" name="passsword" />
                <textarea placeholder="Desicrption"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="cancel" data-dismiss="modal">Close</button>
                <button type="button" class="add-project" data-dismiss="modal">Save</button>
            </div>
        </div>
    </div>
</div>
</section>
<style>
#product-messages{display: none; text-align: center;}
#err-messages{display: none; text-align: center;}
</style>
<script>
function jobDelete(id) {
    var p_id = id;
    $.confirm({
	    title: 'Confirm!',
	    content: confirmTextDelete,
	    buttons: {
	        confirm: function () {
                var base_url = $('#base_url').val();
                $.ajax({
                    url:base_url+"user/dashboard/delete_job",
                    method:"POST",
                    data:{id: p_id},
                    beforeSend : function(){
                        $("#loader").show();
                    },
                    success:function(data) {
                        if (data == '1'){
                            setTimeout(function () {
                                $("#loader").hide();
                                window.scroll({top: 0, behavior: "smooth"});
                                $('#product-messages').show();
                            }, 7000);
                            setTimeout(function () {
                                $('#product-messages').hide();
                            }, 9000);
                            setTimeout(function () {
                                location.reload(true);
                            }, 10000);
                        } else {
                            $('#err-messages').show();
                            setTimeout(function () {
                                window.scroll({top: 0, behavior: "smooth"})
                            }, 7000);
                            setTimeout(function () {
                                $('#err-messages').hide();
                            }, 9000);
                            setTimeout(function () {
                                location.reload(true);
                            }, 10000);
                        }
                    }

                })
	        },
	        cancel: function () {
	            location.reload();
	        },
	    }
	});
}
</script>
