<?php
if(empty($_SESSION['authorized']['userId']))
{
redirect(base_url('login'));
}
$seg2=$this->uri->segment(2);
?>
<section class="dashboard-gig User_Sidemenu max_height">
    <div class="container display-table" style="display: block;">
        <div class="completeSub">Please activate a subscription package and complete your profile to proceed with further activities within your dashboard</div>
        <div class="row display-table-row">
            <div class="col-md-12 col-md-12 col-sm-12 hidden-xs for-mobile-sidemenu display-table-cell v-align box" id="navigation">
                <div class="navi">
                    <ul>
                        <li <?php if($seg2=='subscription') { ?> class="active" <?php } ?>>
                            <span class="cover"></span>
                            <a href="<?= base_url('profile/subscription')?>"><i class="fa fa-bookmark" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Subscription</span>
                            </a>
                        </li>

                        <li <?php if($seg2=='dashboard') { ?> class="active" <?php } ?>>
                            <span class="cover"></span>
                            <?php $get_sub_data = $this->db->query("SELECT * FROM employer_subscription WHERE employer_id='".$_SESSION['authorized']['userId']."' AND (status = '1' OR status = '2')")->result_array();
                            if(!empty($get_sub_data)) {
                            ?>
                            <a href="<?= base_url('profile/dashboard')?>"><i class="fa fa-user-circle" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Dashboard</span>
                            </a>
                            <?php } else { ?>
                            <a href="javascript:void(0)" onclick="completeSub()"><i class="fa fa-user-circle" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Dashboard</span>
                            </a>
                            <?php } ?>
                        </li>

                        <!-- <?php //if(@$_SESSION['authorized']['userType']=='1') {
                        //$get_sub_data = $this->db->query("SELECT * FROM employer_subscription WHERE employer_id='".$_SESSION['authorized']['userId']."' AND (status = '1' OR status = '2')")->result_array();
                        //if(!empty($get_sub_data)) {
                        //$profile_check = $this->db->query("SELECT * FROM `users` WHERE userId = '".@$_SESSION['authorized']['userId']."'")->result_array();
                        //if(empty($profile_check[0]['firstname']) || empty($profile_check[0]['lastname']) || empty($profile_check[0]['email']) || empty($profile_check[0]['address']) || empty($profile_check[0]['short_bio'])) { ?>
                        <li <?php if($seg2=='education-list') { ?>class="active" <?php } ?>>
                            <span class="cover"></span>
                            <a href="javascript:void(0)" onclick="completeSub()"><i class="fa fa-graduation-cap" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Education</span>
                            </a>
                        </li>
                        <li <?php if($seg2=='workexperience-list') { ?>class="active" <?php } ?>>
                            <span class="cover"></span>
                            <a href="javascript:void(0)" onclick="completeSub()"><i class="fa fa-id-card" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Work Experience</span>
                            </a>
                        </li>
                        <?php //} else { ?>
                        <li <?php if($seg2=='education-list') { ?>class="active" <?php } ?>>
                            <span class="cover"></span>
                            <a href="<?= base_url('profile/education-list')?>"><i class="fa fa-graduation-cap" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Education</span>
                            </a>
                        </li>
                        <li <?php if($seg2=='workexperience-list') { ?>class="active" <?php } ?>>
                            <span class="cover"></span>
                            <a href="<?= base_url('profile/workexperience-list')?>"><i class="fa fa-id-card" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Work Experience</span>
                            </a>
                        </li>
                        <?php //} } else { ?>
                        <li <?php if($seg2=='education-list') { ?>class="active" <?php } ?>>
                            <span class="cover"></span>
                            <a href="javascript:void(0)" onclick="completeSub()"><i class="fa fa-graduation-cap" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Education</span>
                            </a>
                        </li>
                        <li <?php if($seg2=='workexperience-list') { ?>class="active" <?php } ?>>
                            <span class="cover"></span>
                            <a href="javascript:void(0)" onclick="completeSub()"><i class="fa fa-id-card" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Work Experience</span>
                            </a>
                        </li>
                        <?php //} } ?> -->

                        <?php if(@$_SESSION['authorized']['userType']=='2') {
                            // echo "333";die;
                        $get_sub_data = $this->db->query("SELECT * FROM employer_subscription WHERE employer_id='".$_SESSION['authorized']['userId']."' AND (status = '1' OR status = '2')")->result_array();
                        if(!empty($get_sub_data)) {
                        $profile_check = $this->db->query("SELECT * FROM `users` WHERE userId = '".@$_SESSION['authorized']['userId']."'")->result_array();
                        if(empty($profile_check[0]['firstname']) || empty($profile_check[0]['lastname']) || empty($profile_check[0]['email']) || empty($profile_check[0]['address']) || empty($profile_check[0]['short_bio'])) { ?>
                        <li <?php if($seg2=='myjob') { ?> class="active" <?php } ?>>
                            <span class="cover"></span>
                            <a href="javascript:void(0)" onclick="completeSub()"><i class="fa fa-briefcase" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">My Jobs</span>
                            </a>
                        </li>
                        <li <?php if($seg2=='jobbid') { ?> class="active" <?php } ?>>
                            <span class="cover"></span>
                            <a href="javascript:void(0)" onclick="completeSub()"><i class="fa fa-tasks" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">List of Bids</span>
                            </a>
                        </li>
                        <?php } else { ?>
                        <li <?php if($seg2=='myjob') { ?> class="active" <?php } ?>>
                            <span class="cover"></span>
                            <a href="<?= base_url('profile/myjob')?>"><i class="fa fa-briefcase" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">My Jobs</span>
                            </a>
                        </li>
                        <li <?php if($seg2=='jobbid') { ?> class="active" <?php } ?>>
                            <span class="cover"></span>
                            <a href="<?= base_url('profile/jobbid')?>"><i class="fa fa-tasks" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">List of Bids</span>
                            </a>
                        </li>
                        <li <?php if($seg2=='recommended-employee') { ?> class="active" <?php } ?>>
                            <span class="cover"></span>
                            <a href="<?= base_url('recommended-employee') ?>"><i class="fa fa-tasks" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Ready for Interview</span>
                            </a>
                        </li>

                        <li <?php if($seg2=='filechat') { ?>class="active" <?php } ?>>
                            <span class="cover"></span>
                            <a href="<?= base_url('profile/filechat')?>" ><i class="fa fa-commenting" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Messages(Document)</span>
                                
                            </a>
                        </li>

                        <li <?php if($seg2=='textchat') { ?>class="active" <?php } ?>>
                            <span class="cover"></span>
                            <a href="<?= base_url('profile/textchat')?>" ><i class="fa fa-commenting" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Messages(Text)</span>
                                
                            </a>
                        </li>     


                        <?php } } else { ?>
                        <li <?php if($seg2=='myjob') { ?> class="active" <?php } ?>>
                            <span class="cover"></span>
                            <a href="javascript:void(0)" onclick="completeSub()"><i class="fa fa-briefcase" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">My Jobs</span>
                            </a>
                        </li>
                        <li <?php if($seg2=='jobbid') { ?> class="active" <?php } ?>>
                            <span class="cover"></span>
                            <a href="javascript:void(0)" onclick="completeSub()"><i class="fa fa-tasks" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">List of Bids</span>
                            </a>
                        </li>
                        <?php } } else {
                        $get_sub_data = $this->db->query("SELECT * FROM employer_subscription WHERE employer_id='".$_SESSION['authorized']['userId']."' AND (status = '1' OR status = '2')")->result_array();
                        if(!empty($get_sub_data)) {
                        $profile_check = $this->db->query("SELECT * FROM `users` WHERE userId = '".@$_SESSION['authorized']['userId']."'")->result_array();
                        if(empty($profile_check[0]['firstname']) || empty($profile_check[0]['lastname']) || empty($profile_check[0]['email']) || empty($profile_check[0]['address']) || empty($profile_check[0]['short_bio'])) { ?>
                        <li <?php if($seg2=='jobbid') { ?> class="active" <?php } ?>>
                            <span class="cover"></span>
                            <a href="javascript:void(0)" onclick="completeSub()"><i class="fa fa-tasks" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">My Jobs</span>
                            </a>
                        </li>
                        <?php } else { ?>
                        <li <?php if($seg2=='jobbid') { ?> class="active" <?php } ?>>
                            <span class="cover"></span>
                            <a href="<?= base_url('profile/jobbid')?>"><i class="fa fa-tasks" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">My Jobs</span>
                            </a>
                        </li>
                        <?php } } else { ?>
                        <li <?php if($seg2=='jobbid') { ?> class="active" <?php } ?>>
                            <span class="cover"></span>
                            <a href="javascript:void(0)" onclick="completeSub()"><i class="fa fa-tasks" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">My Jobs</span>
                            </a>
                        </li>
                        <?php } } ?>

                        <?php if(@$_SESSION['authorized']['userType']=='2') {
                        $get_sub_data = $this->db->query("SELECT * FROM employer_subscription WHERE employer_id='".$_SESSION['authorized']['userId']."' AND (status = '1' OR status = '2')")->result_array();
                        if(!empty($get_sub_data)) {
                        $profile_check = $this->db->query("SELECT * FROM `users` WHERE userId = '".@$_SESSION['authorized']['userId']."'")->result_array();
                        if(empty($profile_check[0]['firstname']) || empty($profile_check[0]['lastname']) || empty($profile_check[0]['email']) || empty($profile_check[0]['address']) || empty($profile_check[0]['short_bio'])) { ?>
                        <li <?php if($seg2=='chat') { ?>class="active" <?php } ?>>
                            <span class="cover"></span>
                            <a href="javascript:void(0)" onclick="completeSub()"><i class="fa fa-commenting" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Messages</span>
                                <?php
                                $countMessage = $this->db->query("Select COUNT(id) as msgcount FROM chat WHERE userto_id ='".$_SESSION['authorized']['userId']."' AND status = '0'")->result();
                                if($countMessage[0]->msgcount != 0) { ?>
                                <span class="notification notificationv1"><?php echo $countMessage[0]->msgcount;?></span>
                                <?php } ?>
                                <span class="notification notificationv"><?php echo $countMessage[0]->msgcount;?></span>
                            </a>
                        </li>
                        <?php } else { ?>
                        <li <?php if($seg2=='chat') { ?>class="active" <?php } ?>>
                            <span class="cover"></span>
                            <a href="<?= base_url('profile/chat')?>"><i class="fa fa-commenting" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Messages</span>
                                <?php
                                $countMessage = $this->db->query("Select COUNT(id) as msgcount FROM chat WHERE userto_id ='".$_SESSION['authorized']['userId']."' AND status = '0'")->result();
                                if($countMessage[0]->msgcount != 0) { ?>
                                <span class="notification notificationv1"><?php echo $countMessage[0]->msgcount;?></span>
                                <?php } ?>
                                <span class="notification notificationv"><?php echo $countMessage[0]->msgcount;?></span>
                            </a>
                        </li>
                        <?php } } else { ?>
                        <li <?php if($seg2=='chat') { ?>class="active" <?php } ?>>
                            <span class="cover"></span>
                            <a href="javascript:void(0)" onclick="completeSub()"><i class="fa fa-commenting" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Messages</span>
                                <?php
                                $countMessage = $this->db->query("Select COUNT(id) as msgcount FROM chat WHERE userto_id ='".$_SESSION['authorized']['userId']."' AND status = '0'")->result();
                                if($countMessage[0]->msgcount != 0) { ?>
                                <span class="notification notificationv1"><?php echo $countMessage[0]->msgcount;?></span>
                                <?php } ?>
                                <span class="notification notificationv"><?php echo $countMessage[0]->msgcount;?></span>
                            </a>
                        </li>
                        <?php } } else {
                            //    echo "456";die;
                        $get_sub_data = $this->db->query("SELECT * FROM employer_subscription WHERE employer_id='".$_SESSION['authorized']['userId']."' AND (status = '1' OR status = '2')")->result_array();
                        if(!empty($get_sub_data)) {
                            // echo "ff";die;
                        $profile_check = $this->db->query("SELECT * FROM `users` WHERE userId = '".@$_SESSION['authorized']['userId']."'")->result_array();
                        if(empty($profile_check[0]['firstname']) || empty($profile_check[0]['lastname']) || empty($profile_check[0]['email']) || empty($profile_check[0]['address']) || empty($profile_check[0]['short_bio'])) { ?>
                        <li <?php if($seg2=='chat') { ?>class="active" <?php } ?>>
                            <span class="cover"></span>
                            <a href="javascript:void(0)" onclick="completeSub()"><i class="fa fa-commenting" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Messages</span>
                                <?php
                                $countMessage = $this->db->query("Select COUNT(id) as msgcount FROM chat WHERE userto_id ='".$_SESSION['authorized']['userId']."' AND status = '0'")->result();
                                if($countMessage[0]->msgcount != 0) { ?>
                                <span class="notification notificationf1"><?php echo $countMessage[0]->msgcount;?></span>
                                <?php } ?>
                                <span class="notification notificationf"><?php echo $countMessage[0]->msgcount;?></span>
                            </a>
                        </li>

                        



                       
                        <?php }  
                        
                        
                        
                        
                       else { ?>
                        <li <?php if($seg2=='chat') { ?>class="active" <?php } ?>>
                            <span class="cover"></span>
                            <a href="<?= base_url('profile/chat')?>"><i class="fa fa-commenting" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Messages</span>
                                <?php
                                $countMessage = $this->db->query("Select COUNT(id) as msgcount FROM chat WHERE userto_id ='".$_SESSION['authorized']['userId']."' AND status = '0'")->result();
                                if($countMessage[0]->msgcount != 0) { ?>
                                <span class="notification notificationf1"><?php echo $countMessage[0]->msgcount;?></span>
                                <?php } ?>
                                <span class="notification notificationf"><?php echo $countMessage[0]->msgcount;?></span>
                            </a>
                        </li>

                        <li <?php if($seg2=='filechat') { ?>class="active" <?php } ?>>
                            <span class="cover"></span>
                            <a href="<?= base_url('profile/filechat')?>" ><i class="fa fa-commenting" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Messages(Document)</span>
                                
                            </a>
                        </li>

                        <li <?php if($seg2=='textchat') { ?>class="active" <?php } ?>>
                            <span class="cover"></span>
                            <a href="<?= base_url('profile/textchat')?>" ><i class="fa fa-commenting" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Messages(Text)</span>
                                
                            </a>
                        </li>                     
                        <li <?php if ($seg1 == 'availability') { ?>class="active" <?php } ?>>

                        <a href="<?= base_url('availability') ?>"><i class="fa fa-calender" aria-hidden="true"></i>
                            <span class="hidden-xs hidden-sm">Availability</span>
                        </a>
                        </li>
                                        


                        <?php } } else {
                                //  echo "else";die;
                            ?>
                        <li <?php if($seg2=='chat') { ?>class="active" <?php } ?>>
                            <span class="cover"></span>
                            <a href="javascript:void(0)" onclick="completeSub()"><i class="fa fa-commenting" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Messages</span>
                                <?php
                                $countMessage = $this->db->query("Select COUNT(id) as msgcount FROM chat WHERE userto_id ='".$_SESSION['authorized']['userId']."' AND status = '0'")->result();
                                if($countMessage[0]->msgcount != 0) { ?>
                                <span class="notification notificationf1"><?php echo $countMessage[0]->msgcount;?></span>
                                <?php } ?>
                                <span class="notification notificationf"><?php echo $countMessage[0]->msgcount;?></span>
                            </a>
                        </li>

                        <!-- <li <?php if ($seg2 == 'availability') { ?>class="active" <?php } ?> <?php if($_SESSION['authorized']['userType'] == '2') { echo  "style='width: auto !important'"; }?>>

                        <a href="<?= base_url('availability') ?>"><i class="fa fa-calendar" aria-hidden="true"></i>
                            <span class="hidden-xs hidden-sm">Availabilityyyyy</span>
                        </a>
                        </li> -->


                        <?php } } ?>

                       
                    </ul>
                    <input type="hidden" name="userto_id" id="userto_id" value="<?php echo @$_SESSION['authorized']['userId']?>">
                </div>
            </div>
<style>
    .completeSub {display: none; text-align: center; margin-top: 20px; color: #fa5a1f; font-size: 20px;}
</style>
<script>
function completeSub() {
    $('.completeSub').show();
    setTimeout(function(){
        $('.completeSub').fadeOut('slow');
    },4000);
}

function load_unseen_notification() {
    $('.notificationv1').hide();
    $('.notificationf1').hide();
    $('.notificationfl1').hide();
    var userId = "<?php echo @$_SESSION['authorized']['userId']?>";
    $.ajax({
        url:"<?= base_url('user/dashboard/showmessage_count') ?>",
        method:"POST",
        data:{userId:userId},
        dataType:"json",
        success:function(data) {
            //console.log(userId);
            //console.log(data);
            <?php if(@$_SESSION['authorized']['userType']=='2') { ?>
            if(data.count > 0) {
                $('.notificationv').show();
                $('.notificationv').text(data.count);
            } else {
                $('.notificationv').hide();
            }
            <?php } else { ?>
            if(data.count > 0) {
                $('.notificationf').show();
                $('.notificationf').text(data.count);
            } 
            else {
                $('.notificationf').hide();
            }

            if(data.count_file>0)
            {

            $('.notificationfl').show();
            $('.notificationfl').text(data.count_file);
            } else {
            $('.notificationfl').hide();
            }

            <?php } ?>
        }
    });
}

$(document).ready(function(){
    $('.notificationv').hide();
    $('.notificationf').hide();
    setInterval(function(){
        load_unseen_notification();
    }, 5000);
})
</script>
