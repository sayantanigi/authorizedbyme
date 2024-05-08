<section class="breadcrumbpnl" style="background-image:url(./assets/images/f-2.jpg);">
    <div class="container">
        <div class="">
            <h3 class="fw-semibold">Chat</h3>
            <div>
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Chat</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="dashboard-gig Chat_User">
    <div class="container-fluid display-table">
        <div class="row display-table-row">
            <?php $this->load->view('sidebar'); ?>
            <div class="col-md-12 col-sm-12 display-table-cell v-align">
                <div class="user-dashboard">
                    <div class="row row-sm">
                        <div class="col-xl-12 col-lg-12 col-md-12 chat-box">
                            <div class="cardak">
                                <div class="row">
                                    <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div id="frame">
                                            <div id="sidepanel">
                                                <div id="profile">
                                                    <div class="wrap">
                                                        <?php if (@$get_user->profilePic && file_exists('uploads/users/' . @$get_user->profilePic)) { ?>
                                                            <img id="profile-img"
                                                                src="<?= base_url('uploads/users/' . @$get_user->profilePic) ?>"
                                                                class="online" alt="" />
                                                        <?php } else { ?>
                                                            <img id="profile-img"
                                                                src="<?= base_url('uploads/users/user.png') ?>"
                                                                class="online" alt="" />
                                                        <?php } ?>
                                                        <p>
                                                            <?php echo $get_user->firstname . ' ' . $get_user->lastname; ?>
                                                        </p>
                                                        <div id="status-options">
                                                            <ul>
                                                                <li id="status-online" class="active">
                                                                    <span class="status-circle"></span>
                                                                    <p>Online</p>
                                                                </li>
                                                                <li id="status-away">
                                                                    <span class="status-circle"></span>
                                                                    <p>Away</p>
                                                                </li>
                                                                <li id="status-busy">
                                                                    <span class="status-circle"></span>
                                                                    <p>Busy</p>
                                                                </li>
                                                                <li id="status-offline">
                                                                    <span class="status-circle"></span>
                                                                    <p>Offline</p>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="search">
                                                    <input type="text" placeholder="Search by Contacts and Job ID" />
                                                </div>
                                                <div id="contacts">
                                                    <ul>
                                                        <?php if (!empty($get_jobbid)) {
                                                            // echo "<pre>";
                                                            // print_r($get_jobbid);die;
                                                        
                                                            foreach ($get_jobbid as $user) {
                                                                if ($user->postjob_id == $user->post_id && $user->user_id == $_SESSION['authorized']['userId'] && ($user->bidding_status == 'Selected' || $user->bidding_status == 'Short Listed')) {
                                                                    // echo "if";
                                                                    $get_user = $this->Crud_model->get_single('users', "userId='" . $user->userid . "'");
                                                                    $get_msg = $this->Crud_model->GetData('chat', '', "userto_id='" . $user->userid . "' and userfrom_id='" . $user->user_id . "' and postjob_id = '" . $user->post_id . "' AND attachment!='' ", '', 'id desc', '', '1');
                                                                    // echo $this->db->last_query();die;
                                                                    ?>

                                                                    <li class="contact"
                                                                        onclick="return getuser('<?= $user->userid ?>','<?= $user->post_id ?>');">
                                                                        <div class="wrap">
                                                                            <span class="contact-status online"></span>
                                                                            <?php if (@$user->profilePic && file_exists('uploads/users/' . @$user->profilePic)) { ?>
                                                                                <img src="<?= base_url('uploads/users/' . @$user->profilePic) ?>"
                                                                                    alt="" />
                                                                            <?php } else { ?>
                                                                                <img src="<?= base_url('uploads/users/user.png') ?>"
                                                                                    alt="" />
                                                                            <?php } ?>
                                                                            <div class="meta">
                                                                                <p class="name">
                                                                                    <?php echo ucfirst($get_user->firstname . ' ' . $get_user->lastname); ?>
                                                                                </p>
                                                                                <p class="preview"
                                                                                    title="<?= $user->post_title; ?>">Job ID :
                                                                                    <?= "Job_" . sprintf("%03d", $user->post_id); ?>
                                                                                </p>
                                                                                <input type="hidden" name="postjob_id"
                                                                                    id="postjob_id" value="<?= $user->post_id; ?>">
                                                                            </div>
                                                                        </div>
                                                                    </li>

                                                                <?php } else if ($user->postjob_id == $user->post_id && $user->userid == $_SESSION['authorized']['userId'] && ($user->bidding_status == 'Selected' || $user->bidding_status == 'Short Listed')) {
                                                                    // echo "else if";
                                                                    $get_user = $this->Crud_model->get_single('users', "userId='" . $user->user_id . "'");
                                                                    $get_msg1 = $this->Crud_model->GetData('chat', '', "userfrom_id='" . $user->user_id . "' and userto_id='" . $user->userid . "' and postjob_id = '" . $user->post_id . "' AND attachment!='' ", '', 'id desc', '', '1');
                                                                    ?>
                                                                        <li class="contact"
                                                                            onclick="return getuser('<?= $get_user->userId ?>','<?= $user->post_id ?>');">
                                                                            <div class="wrap">
                                                                                <span class="contact-status online"></span>
                                                                            <?php if (@$get_user->profilePic && file_exists('uploads/users/' . @$get_user->profilePic)) { ?>
                                                                                    <img src="<?= base_url('uploads/users/' . @$get_user->profilePic) ?>"
                                                                                        alt="" />
                                                                            <?php } else { ?>
                                                                                    <img src="<?= base_url('uploads/users/user.png') ?>"
                                                                                        alt="" />
                                                                            <?php } ?>
                                                                                <div class="meta">
                                                                                    <p class="name">
                                                                                    <?php echo ucfirst($get_user->firstname . ' ' . $get_user->lastname); ?>
                                                                                    </p>
                                                                                    <p class="preview"
                                                                                        title="<?= $user->post_title; ?>">Job ID :
                                                                                    <?= "Job_" . sprintf("%03d", $user->post_id); ?>
                                                                                    </p>
                                                                                    <input type="hidden" name="postjob_id"
                                                                                        id="postjob_id" value="<?= $user->post_id; ?>">
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                <?php }
                                                            }
                                                        } ?>
                                                    </ul>
                                                </div>
                                            </div>


                                            <div class="content" style="height: 570px;">
                                                <img class="chat-start-img"
                                                    src="<?= base_url() ?>assets/images/chat-start-img.png">
                                                <div id="message_list"
                                                    style="height:450px; overflow-y: scroll;overflow-y: hidden;">
                                                    <!-- Messages will be displayed here -->
                                                </div>
                                                <!-- <div class="message-input">
                                                    <div class="wrap">
                                                        <input type="hidden" name="userfromid" id="userfromid"
                                                            value="<?= $_SESSION['authorized']['userId'] ?>" />
                                                        <input type="hidden" name="usertoid" id="usertoid" value="" />
                                                        <input type="hidden" name="postid" id="postid" value="" />
                                                        <input type="text" name="message" id="message"
                                                            placeholder="Write your message..." />
                                                        <input type="file" name="file" id="file"
                                                            accept=".pdf,.jpeg,.jpg,.png" />
                                                        <i class="fa fa-paperclip attachment" aria-hidden="true"></i>
                                                        <button class="submit"><i class="fa fa-paper-plane"
                                                                aria-hidden="true"></i></button>
                                                    </div>
                                                </div> -->
                                            </div>






                                            <!--end message list div -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm" role="document" style="max-width: 100%;">
        <div class="modal-content">
            <?php
            $myBidList = $this->db->query("SELECT postjob.post_title FROM job_bid JOIN postjob on job_bid.postjob_id = postjob.id where job_bid.user_id = '" . $_SESSION['authorized']['userId'] . "' and job_bid.bidding_status = 'Accept' and job_bid.status = 'Active'")->result_array();
            if (!empty($myBidList)) {
                $i = 1;
                foreach ($myBidList as $value) { ?>
                    <p>
                        <?= $i . ". " . $value['post_title'] ?>
                    </p>
                    <?php $i++;
                }
            } ?>
        </div>
    </div>
</div>

<style>
    .message-input {
        display: none;
    }

    .chatList {
        display: block !important;
        text-align: center !important;
    }

    .sent {
        display: flex;
        align-items: center;
    }

    .user-pic,
    .chat-pic {
        width: 50px;
        /* Adjust according to your preference */
        height: 50px;
        /* Adjust according to your preference */
        margin-right: 10px;
        /* Adjust according to your preference */
    }

    .chat_pic_show {
        left: 65px;
        position: relative;
        width: 90px;
    }

    .showBidListContent {
        display: block !important;
        opacity: 1 !important;
        top: 58% !important;
        left: 8% !important;
    }

    .modal-dialog {
        max-width: 60% !important;
        margin: 0 !important;
        display: contents !important;
    }

    .modal-content {
        max-width: 80% !important;
    }

    .modal-content p {
        margin: 0px !important;
        padding: 4px 20px 0 20px !important;
    }

    .social-media {
        display: none;
    }

    .notificationv {
        left: 270px !important;
        top: 6px;
        font-size: 15px !important;
        width: 20px !important;
        height: 20px !important;
    }

    .notificationf {
        left: 270px !important;
        top: 6px;
        font-size: 15px !important;
        width: 20px !important;
        height: 20px !important;
    }

    .notificationv1 {
        left: 270px !important;
        top: 6px;
        font-size: 15px !important;
        width: 20px !important;
        height: 20px !important;
    }

    .notificationf1 {
        left: 270px !important;
        top: 6px;
        font-size: 15px !important;
        width: 20px !important;
        height: 20px !important;
    }

    .EachvChat {
        display: none;
    }

    .EachfChat {
        display: none;
    }

    .search-chat {
        display: inline-block;
        float: right;
        margin-right: 30px;
    }

    .extend_search_chat {
        display: none;
        margin: 0 10px 0;
    }

    #search_chat {
        width: 100%;
        height: 30px;
        margin: 0;
        position: relative;
        z-index: 11111111;
        bottom: 0;
    }
</style>
<!-- <link rel="stylesheet" href="https://unpkg.com/placeholder-loading/dist/css/placeholder-loading.min.css"> -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<script src="https://use.typekit.net/hoy3lrg.js"></script>
<script>
    try {
        Typekit.load({
            async: true
        });
    } catch (e) { }
</script>
<script
    src='//production-assets.codepen.io/assets/common/stopExecutionOnTimeout-b2a7b3fe212eaa732349046d8416e00a9dec26eb7fd347590fbced3ab38af52e.js'></script>
<script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
<script>
    $(".content #message_list .contact-profile #chat123").click(function () {
        alert("The paragraph was clicked.");
    });

    $(document).ready(function () {
        $('.EachvChat').hide();
        $('.EachfChat').hide();
    });

    $(".messages").animate({
        scrollTop: $(document).height()
    }, "fast");
    $("#profile-img").click(function () {
        $("#status-options").toggleClass("active");
    });
    $(".expand-button").click(function () {
        $("#profile").toggleClass("expanded");
        $("#contacts").toggleClass("expanded");
    });
    $("#status-options ul li").click(function () {
        $("#profile-img").removeClass();
        $("#status-online").removeClass("active");
        $("#status-away").removeClass("active");
        $("#status-busy").removeClass("active");
        $("#status-offline").removeClass("active");
        $(this).addClass("active");
        if ($("#status-online").hasClass("active")) {
            $("#profile-img").addClass("online");
        } else if ($("#status-away").hasClass("active")) {
            $("#profile-img").addClass("away");
        } else if ($("#status-busy").hasClass("active")) {
            $("#profile-img").addClass("busy");
        } else if ($("#status-offline").hasClass("active")) {
            $("#profile-img").addClass("offline");
        } else {
            $("#profile-img").removeClass();
        };
        $("#status-options").removeClass("active");
    });
    // function newMessage() {
    //     //message = $(".message-input input").val();
    //     var userfromid = $('#userfromid').val();
    //     var usertoid = $('#usertoid').val();
    //     var postid = $('#postid').val();
    //     var message = $('#message').val();

    //     if ($.trim(message) == '') {
    //         return false;
    //     }
    //     $.ajax({
    //         url: '<?= base_url('user/dashboard/sent_message') ?>',
    //         type: 'POST',
    //         data: {
    //             userfromid: userfromid,
    //             usertoid: usertoid,
    //             postid: postid,
    //             message: message
    //         },
    //         dataType: 'json',
    //         success: function (returndata) {
    //             setInterval(function () {
    //                 getMessageCount();
    //             }, 5000);
    //             if (returndata.result == 1) {
    //                 $('<li class="sent">' + returndata.userpic + '<p>' + message + '</p></li>').appendTo($('.messages ul'));
    //                 $('#message').val(null);
    //                 $('.contact.active .preview').html('<span>You: </span>' + message);
    //                 $(".messages").scrollTop($(document).height());
    //             }
    //         }
    //     });
    // }

    function newMessage() {

        var formData = new FormData();
        var fileInput = document.getElementById('file');
        var messageInput = document.getElementById('message');
        var userfromid = document.getElementById('userfromid').value;
        var usertoid = document.getElementById('usertoid').value;
        var postid = document.getElementById('postid').value;
        // alert(fileInput.files[0]);   
        formData.append('file', fileInput.files[0]);
        formData.append('message', messageInput.value);
        formData.append('userfromid', userfromid);
        formData.append('usertoid', usertoid);
        formData.append('postid', postid);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', '<?= base_url('user/dashboard/sent_message') ?>', true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                // alert(200);

                var responseData = JSON.parse(xhr.responseText);
                var chatpic = responseData.chatpic;
                var userpic = responseData.userpic;


                $('<li class="sent">' + userpic + '<p>' + messageInput.value + '</p><span class="chat_pic_show">' + chatpic + '</span></li>').appendTo($('.messages ul'));
                $('#message').val(null);
                $('#file').val(null);
                $('.contact.active .preview').html('<span>You: </span>' + messageInput.value);
                $(".messages").scrollTop($(document).height());


                // Message sent successfully, do something if needed
            }
        };
        xhr.send(formData);
    }

    $("#message").mouseover(function () {
        $('.EachvChat').hide();
        $('.EachfChat').hide();
        setInterval(function () {
            getMessage();
            getMessageCount();
        }, 50000);
    });

    function getMessage() {
        var userfromid = $('#userfromid').val();
        var usertoid = $('#usertoid').val();
        var postid = $('#postid').val();
        $.ajax({
            url: '<?= base_url('user/dashboard/showmessage_listS') ?>',
            type: 'POST',
            data: { userfromid: userfromid, usertoid: usertoid, postid: postid },
            dataType: 'json',
            success: function (result) {
                //console.log(result);
                $('#message_list').html(result);
                // $('.message-input').show();
                // $('#frame').addClass('chat_frame');
                $(".messages").scrollTop(10000000);
            }
        });
    }

    function getMessageCount() {
        var userfromid = $('#userfromid').val();
        var usertoid = $('#usertoid').val();
        var postid = $('#postid').val();
        $.ajax({
            url: '<?= base_url('user/dashboard/showmessageCountEach') ?>',
            type: 'POST',
            data: { userfromid: userfromid, usertoid: usertoid, postid: postid },
            dataType: 'json',
            success: function (result) {
                //console.log(result);
                <?php if (@$_SESSION['authorized']['userType'] == '2') { ?>
                    if (result.count > 0) {
                        $('.EachChatv').hide();
                        $('.EachvChat').show();
                        $('.EachvChat').text(result.count);
                    } else {
                        $('.EachvChat').hide();
                        $('.EachChatv').hide();
                    }
                <?php } else { ?>
                    if (result.count > 0) {
                        $('.EachChatf').hide();
                        $('.EachfChat').show();
                        $('.EachfChat').text(result.count);
                    } else {
                        $('.EachChatf').hide();
                        $('.EachfChat').hide();
                    }
                <?php } ?>
            }
        });
    }

    $('.submit').click(function () {
        newMessage();
    });

    $(window).on('keydown', function (e) {
        if (e.which == 13) {
            newMessage();
            return false;
        }
    });
    //# sourceURL=pen.js

    function getuser(usert_id, post_id) {
        //alert(usert_id);
        searchChat();
        var displayProduct = 3;
        $('#message_list').html(createSkeleton(displayProduct));
        function createSkeleton(limit) {
            var skeletonHTML = '';
            for (var i = 0; i < limit; i++) {
                skeletonHTML += '<div class="ph-item">';
                skeletonHTML += '<div class="ph-col-4">';
                skeletonHTML += '<div class="ph-picture"></div>';
                skeletonHTML += '</div>';
                skeletonHTML += '<div>';
                skeletonHTML += '<div class="ph-row">';
                skeletonHTML += '<div class="ph-col-12 big"></div>';
                skeletonHTML += '<div class="ph-col-12"></div>';
                skeletonHTML += '<div class="ph-col-12"></div>';
                skeletonHTML += '<div class="ph-col-12"></div>';
                skeletonHTML += '<div class="ph-col-12"></div>';
                skeletonHTML += '</div>';
                skeletonHTML += '</div>';
                skeletonHTML += '</div>';
            }
            return skeletonHTML;
        }
        $('#usertoid').val(usert_id);
        $('#postid').val(post_id);
        $("#message_list").attr('class', '');
        $('#message_list').toggleClass('messageDetails' + usert_id);
        $.ajax({
            url: '<?= base_url('user/dashboard/showmessage_list_file') ?>',
            type: 'POST',
            data: {
                usert_id: usert_id, post_id: post_id
            },
            dataType: 'json',
            success: function (result) {
                $('#message_list').html(result);
                $(".messages").scrollTop(10000000);
                $('.message-input').show();
                $('#frame').addClass('chat_frame');
            }
        });
    }

    function searchChat() {
        $('.extend_search_chat').toggle();
        $('#search_chat').on('input', function (e) {
            var lists = document.querySelectorAll('.messages ul li');
            lists.forEach((list) => {
                if (!list.innerHTML.toLowerCase().includes(e.target.value.toLowerCase())) {
                    list.classList.add('d-none');
                } else {
                    list.classList.remove('d-none');
                }
            })
        })
    }

    function openVideoCallWindow(fid) {
        var callPath = "<?php echo base_url('livevideo/video/'); ?>" + fid;
        window.open(callPath, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=250,left=20,width=600,height=450");
    }

    $(function () {
        $('#showBidList').mouseover(function () {
            $(".modal").addClass('showBidListContent');
        });

        $('#showBidList').mouseout(function () {
            $(".modal").removeClass('showBidListContent');
        });
    })

</script>