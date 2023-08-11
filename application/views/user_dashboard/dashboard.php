	<section class="breadcrumbpnl" style="background-image:url(./assets/images/f-2.jpg);">
		<div class="container">
			<div class="">
				<h3 class="fw-semibold">Profile</h3>
				<div >
					<ol class="breadcrumb mb-2">
						<li class="breadcrumb-item"><a href="<?= base_url()?>">Home</a></li>
						<li class="breadcrumb-item"><a href="<?= base_url()?>page/worker-detail/<?= base64_encode($_SESSION['authorized']['userId'])?>"><?= ucwords($_SESSION['authorized']['firstname'].' '.$_SESSION['authorized']['lastname'])?>'s Profile</a></li>
						<li class="breadcrumb-item active" aria-current="page">Profile</li>
					</ol>
				</div>
			</div>
		</div>
	</section>
	<?php $this->load->view('sidebar');?>	
	<div class="col-md-12 col-sm-12 display-table-cell v-align User_Sub">
		<div id="subscription-messages" class="text-success-msg f-20">
			<p style="color: #28a745;">Subscription Successful.</p>
		</div>
		<div id="cnclsubscription-messages" class="text-success-msg f-20">
			<p style="color: #28a745;">Successfully unsubsribed from the current plan.</p>
		</div>
		<div id="err-messages">
			<h4 style="color: red;">Error</h4>
			<p style="color: red;">Oops, something went wrong. Please try again later.</p>
		</div>
		<div class="user-dashboard">
			<div class="row row-sm">
				<div class="col-xl-12 col-lg-12 col-md-12">
					<div class="cardak custom-cardak">
						<span class="text-success-msg f-20" style="text-align: center;">
							<?php if($this->session->flashdata('message')) {
								echo $this->session->flashdata('message');
								unset($_SESSION['message']);
							} ?>
						</span>
						<div class="container">
							<!-- <ul class="navlist-profile">
								<li><a href="<?= base_url()?>profile/dashboard" class="active">Profile</a></li>
								<li><a href="<?= base_url()?>profile/teams">Teams</a></li>
								<li><a href="<?= base_url()?>profile/matches">Matches</a></li>
							</ul>
							<div class="divider my-2"></div> -->
							<div class="mt-4">
								<h3 class="h4 fw-bold text-uppercase text-center text-primary mb-4">Update Profile</h3>
								<div class="profileform">
									<form class="form" action="<?php echo base_url('user/Dashboard/update_profile')?>" method="post" id="msform" enctype="multipart/form-data">
										<ul id="progressbar">
											<li class="active">
												<div class="progressIcon"><i class="fa fa-user"></i></div>
												Profile 
											</li>
											<li >
												<div class="progressIcon"><i class="fa fa-graduation-cap"></i></div>
												Academics 
											</li>
											<li>
												<div class="progressIcon"><i class="fa fa-briefcase"></i></div>
												Exprience
											</li>
											<li>
												<div class="progressIcon"><i class="fa fa-bullhorn"></i></div>
												Reference
											</li>
										</ul>
										<fieldset>
											<div  class="form-box text-start">
												<h4 class="formheading"><span>Personal Information</span></h4>
												<div class="row">
													<div class="col-lg-6 mb-3">
														<label>First Name</label>
														<input type="text" class="form-control" name="firstname" id="firstname" placeholder= "First Name" value="<?php echo $userinfo->firstname;?>">
													</div>
													<div class="col-lg-6 mb-3">
														<label>Last Name</label>
														<input type="text" class="form-control" name="lastname" id="lastname" placeholder= "Last Name" value="<?php echo $userinfo->lastname;?>">
													</div>
													<div class="col-lg-6 mb-3">
														<?php
														if(!empty($userinfo->profilePic)) {
															if(!file_exists('uploads/users/'.$userinfo->profilePic)) {
														?>
														<img class="img-circle img-responsive" src="<?php echo base_url('uploads/no_image.png')?>" style="width: 86px;height: 86px;object-fit: cover;margin-top: -50px;" />
														<?php } else { ?>
														<img class="img-circle img-responsive" src="<?php echo base_url('uploads/users/'.$userinfo->profilePic); ?>" style="width: 86px;height: 86px;object-fit: cover;margin-top: -50px;" />
														<?php } } else { ?>
														<img class="img-circle img-responsive" src="<?php echo base_url('uploads/no_image.png')?>" style="width: 86px;height: 86px;object-fit: cover;margin-top: -50px;" />
														<?php } ?>
														<input type="hidden" name="old_image" value="<?=$userinfo->profilePic ?>">
														<input type="hidden" name="id" value="<?=$userinfo->userId  ?>">
														<div class="profile-ak" style="width: 84%; display: inline-block;">
															<?php if(!empty($userinfo->profilePic)) { ?>
															<h6>Upload a different photo</h6>
															<?php } else { ?>
															<label>Upload Profile Photo</label>
															<?php } ?>
															<input type="file" class="form-control" name="profilePic" id="profilePic" value="">
														</div>
													</div>
													<div class="col-lg-6 mb-3">
														<label>Designation</label>
														<input type="text" class="form-control" name="designation" id="designation" placeholder="Designation" value="<?php echo $userinfo->designation;?>">
													</div>
													<div class="col-lg-6 mb-3">
														<label>Email Id</label>
														<input type="email" class="form-control" name="email" id="email" placeholder="Email Address" value="<?php echo $userinfo->email;?>" readonly>
													</div>
													<div class="col-lg-6 mb-3">
														<label>Contact Number</label>
														<input type="text" class="form-control" name="mobile" id="mobile" placeholder="Contact Number" value="<?php echo $userinfo->mobile;?>">
													</div>
													<div class="col-lg-6 mb-3">
														<label>Address</label>
														<input type="text" class="form-control" name="address" id="address" placeholder="Address" value="<?php echo $userinfo->address;?>">
													</div>
													<div class="col-lg-6 mb-3" style="position:sticky;">
														<label>Location</label>
														<input type="text" class="form-control" name="location" id="location" placeholder="Legal Address" value="<?php echo $userinfo->location;?>" style="height: 49px !important;" autocomplete="off" />
														<!-- <div id="vld_location" style="color:red; margin-top: 10px;">Please enter Legal Address.</div> -->
														<input type="hidden" name="latitude" id="search_lat" value="<?= $userinfo->latitude ?>">
														<input type="hidden" name="longitude" id="search_lon" value="<?= $userinfo->longitude ?> ">
													</div>
													<div class="col-lg-3 mb-3">
														<label>Country</label>
														<div class="pf-field">
															<select class="form-control" name="country-dropdown" id="country-dropdown" style="width: 100%;">
																<option value="">Select Country</option>
																<?php $get_country = $this->Crud_model->GetData('countries', 'id, name', "");
																foreach($get_country as $val) {?>
																<option value="<?php echo $val->name; ?>" <?php if($val->name == @$userinfo->country) {echo "selected"; }?>><?php echo $val->name;?></option>
																<?php } ?>
															</select>
															<input type="hidden" id="select_country_dropdown" value="<?php echo @$userinfo->country; ?>">
														</div>
													</div>
													<div class="col-lg-3 mb-3">
														<label>State</label>
														<select class="form-control" name="state-dropdown" id="state-dropdown">
															<option>Select State</option>
														</select>
														<input type="hidden" id="select_state_dropdown" value="<?php echo @$userinfo->state; ?>">
													</div>
													<div class="col-lg-3 mb-3">
														<label>City</label>
														<select class="form-control" name="city-dropdown" id="city-dropdown">
															<option>Select City</option>
														</select>
														<input type="hidden" id="select_city_dropdown" value="<?php echo @$userinfo->city; ?>">
													</div>
													<div class="col-lg-3 mb-3">
														<label>Zip Code</label>
														<input type="text" class="form-control" placeholder= "ZIP Code" name="zipcode" id="zipcode" value="<?= $userinfo->zipcode ?>">
													</div>
													<div class="col-lg-12 mb-3">
														<label>Player Bio</label>
														<textarea class="form-control" name="short_bio" id="short_bio" placeholder="Short Bio" maxlength="500"><?= @$userinfo->short_bio ?></textarea>
														<div id="the-count">
															<span id="current">0</span>
															<span id="maximum">/ 500</span>
														</div>
													</div>
												</div>
											</div>
											<input type="button" name="next" class="next action-button" value="Next" />
										</fieldset>
										<fieldset>
											<div class="form-box text-start">
												<div class="field_wrapper">
													<h4 class="formheading"><span>ACADEMICS INFORMATION</span></h4>
													<?php if(!empty($useracademics)) { 
													for($i=0; $i < count($useracademics); $i++) {
													?>
													<div class="row" id="row1">
														<div class="col-lg-12 mb-3">
															<label>School / College Name</label>
															<input type="text" class="form-control" name="college_name[]" id="college_name" value="<?= $useracademics[$i]->college_name?>">
														</div>
														<div class="col-lg-4 mb-3">
															<label>Course Name</label>
															<input type="text" class="form-control" name="coursename[]" id="coursename" value="<?= $useracademics[$i]->coursename?>">
														</div>
														<div class="col-lg-4 mb-3">
															<label>Class Rank</label>
															<input type="text" class="form-control" name="class_rank[]" id="class_rank" value="<?= $useracademics[$i]->class_rank?>">
														</div>
														<div class="col-lg-4 mb-3">
															<label>Year of Passing </label>
															<input type="text" class="form-control" name="passing_of_year[]" id="passing_of_year" value="<?= $useracademics[$i]->passing_of_year?>">
														</div>
														<div class="col-lg-12 mb-3">
															<label>Achievement </label>
															<textarea class="form-control" name="achievement[]" id="achievement"><?= $useracademics[$i]->achievement?></textarea>
														</div>
													</div>
													<hr>
													<?php } } else { ?>
													<div class="row" id="row1">
														<div class="col-lg-12 mb-3">
															<label>School / College Name</label>
															<input type="text" class="form-control" name="college_name[]" id="college_name" value="<?= $useracademics[$i]->college_name?>">
														</div>
														<div class="col-lg-4 mb-3">
															<label>Course Name</label>
															<input type="text" class="form-control" name="coursename[]" id="coursename" value="<?= $useracademics[$i]->coursename?>">
														</div>
														<div class="col-lg-4 mb-3">
															<label>Class Rank</label>
															<input type="text" class="form-control" name="class_rank[]" id="class_rank" value="<?= $useracademics[$i]->class_rank?>">
														</div>
														<div class="col-lg-4 mb-3">
															<label>Year of Passing </label>
															<input type="text" class="form-control" name="passing_of_year[]" id="passing_of_year" value="<?= $useracademics[$i]->passing_of_year?>">
														</div>
														<div class="col-lg-12 mb-3">
															<label>Achievement </label>
															<textarea class="form-control" name="achievement[]" id="achievement"><?= $useracademics[$i]->achievement?></textarea>
														</div>
													</div>
													<hr>
													<?php } ?>
												</div>
												<div class="col-lg-12 mb-3 text-end">
													<button type="button" class="btn btn-success rounded-0 add_button">Add More <i class="fa fa-plus"></i></button>
												</div>
											</div>
											<input type="button" name="next" class="next action-button" value="Next" /> 
											<input type="button" name="previous" class="previous action-button-previous" value="Previous" />
										</fieldset>
										<fieldset>
											<div class="form-box text-start">
												<div class="field_wrapper_exp">
													<h4 class="formheading"><span>EXPRIENCE INFORMATION</span></h4>
													<?php if(!empty($userexperience)) { 
													for($j=0; $j<count($userexperience); $j++) { ?>
													<div class="row" id="exprow1">
														<div class="col-lg-6 mb-3">
															<label>Company Name</label>
															<input type="text" class="form-control" name="company_name[]" id="company_name" value="<?= $userexperience[$j]->company_name?>">
														</div>
														<div class="col-lg-6 mb-3">
															<label>Designation</label>
															<input type="text" class="form-control" name="exp_designation[]" id="exp_designation" value="<?= $userexperience[$j]->designation?>">
														</div>
														<div class="col-lg-6 mb-3">
															<label>Start Date</label>
															<input type="date" class="form-control" name="exp_start_date[]" id="exp_start_date" value="<?= $userexperience[$j]->from_date?>">
														</div>
														<div class="col-lg-6 mb-3">
															<label>End Date</label>
															<input type="date" class="form-control" name="exp_end_date[]" id="exp_end_date" value="<?= $userexperience[$j]->to_date?>">
														</div>
														<div class="col-lg-12 mb-3">
															<label>Information</label>
															<textarea class="form-control" name="exp_information[]" id="exp_information"><?= $userexperience[$j]->description?></textarea>
														</div>
													</div>
													<hr>
													<?php } } else { ?>
													<div class="row" id="exprow1">
														<div class="col-lg-6 mb-3">
															<label>Company Name</label>
															<input type="text" class="form-control" name="company_name[]" id="company_name" value="">
														</div>
														<div class="col-lg-6 mb-3">
															<label>Designation</label>
															<input type="text" class="form-control" name="exp_designation[]" id="exp_designation" value="">
														</div>
														<div class="col-lg-6 mb-3">
															<label>Start Date</label>
															<input type="date" class="form-control" name="exp_start_date[]" id="exp_start_date" value="">
														</div>
														<div class="col-lg-6 mb-3">
															<label>End Date</label>
															<input type="date" class="form-control" name="exp_end_date[]" id="exp_end_date" value="">
														</div>
														<div class="col-lg-12 mb-3">
															<label>Information</label>
															<textarea class="form-control" name="exp_information[]" id="exp_information"></textarea>
														</div>
													</div>
													<hr>
													<?php } ?>
												</div>
												<div class="col-lg-12 mb-3 text-end">
													<button type="button" class="btn btn-success rounded-0 add_expbutton">Add More <i class="fa fa-plus"></i></button>
												</div>
											</div>
											<input type="button" name="next" class="next action-button" value="Next" /> 
											<input type="button" name="previous" class="previous action-button-previous" value="Previous" />
										</fieldset>
										<fieldset>
											<div class="form-box text-start">
												<div class="field_wrapper_ref">
													<h4 class="formheading"><span>REFERENCE INFORMATION</span></h4>
													<?php if(!empty($userreference)) { 
													for ($k=0; $k< count($userreference); $k++) { ?>
													<div class="row" id="refrow1">
														<div class="col-lg-6 mb-3">
															<label>Referrer Name</label>
															<input type="text" class="form-control" name="referrer_name[]" id="referrer_name" value="<?= $userreference[$k]->referrer_name?>">
														</div>
														<div class="col-lg-6 mb-3">
															<label>Referrer Email</label>
															<input type="email" class="form-control" name="referrer_email[]" id="referrer_email" value="<?= $userreference[$k]->referrer_email?>">
														</div>
													</div>
													<hr>
													<?php } } else { ?>
													<div class="row" id="refrow1">
														<div class="col-lg-6 mb-3">
															<label>Referrer Name</label>
															<input type="text" class="form-control" name="referrer_name[]" id="referrer_name" value="">
														</div>
														<div class="col-lg-6 mb-3">
															<label>Referrer Email</label>
															<input type="email" class="form-control" name="referrer_email[]" id="referrer_email" value="">
														</div>
													</div>
													<hr>
													<?php } ?>
												</div>
												<div class="col-lg-12 mb-3 text-end">
													<button type="button" class="btn btn-success rounded-0 add_refbutton">Add More <i class="fa fa-plus"></i></button>
												</div>
											</div>
											<input type="submit" name="submit" class=" action-button" value="Submit" /> 
											<input type="button" name="previous" class="previous action-button-previous" value="Previous" />
										</fieldset>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<style>
#subscription-messages{display: none; text-align: center;}
#cnclsubscription-messages{display: none; text-align: center;}
#err-messages{display: none; text-align: center;}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
$('#short_bio').keyup(function() {
	var characterCount = $(this).val().length,
	current = $('#current'),
	maximum = $('#maximum'),
	theCount = $('#the-count');
	current.text(characterCount);
	/*This isn't entirely necessary, just playin around*/
	if (characterCount < 70) {
		current.css('color', '#666');
	}
	if (characterCount > 70 && characterCount < 90) {
		current.css('color', '#6d5555');
	}
	if (characterCount > 90 && characterCount < 100) {
		current.css('color', '#793535');
	}
	if (characterCount > 100 && characterCount < 120) {
		current.css('color', '#841c1c');
	}
	if (characterCount > 120 && characterCount < 139) {
		current.css('color', '#8f0001');
	}

	if (characterCount >= 140) {
		maximum.css('color', '#8f0001');
		current.css('color', '#8f0001');
		theCount.css('font-weight','bold');
	} else {
		maximum.css('color','#666');
		theCount.css('font-weight','normal');
	}
});	

$(document).ready(function() {
	$('#country-dropdown').on('change', function() {
		var country_name = this.value;
		$.ajax({
			url: "<?php echo base_url()?>Welcome/states_by_country",
			type: "POST",
			data: {
				country_name: country_name
			},
			cache: false,
			success: function(result){
				//console.log(result);
				$("#state-dropdown").html(result);
				$('#city-dropdown').html('<option value="">Select State First</option>');
			}
		});
	});

	$('#state-dropdown').on('change', function() {
		var state_name = this.value;
		$.ajax({
			url: "<?php echo base_url()?>Welcome/cities_by_state",
			type: "POST",
			data: {
				state_name: state_name
			},
			cache: false,
			success: function(result){
				$("#city-dropdown").html(result);
			}
		});
	});

	if($('#select_country_dropdown').val() != '') {
		var country_name = $('#select_country_dropdown').val();
		$.ajax({
			url: "<?php echo base_url()?>Welcome/states_by_country",
			type: "POST",
			data: {
				country_name: country_name
			},
			cache: false,
			success: function(result){
				//console.log(result);
				$("#state-dropdown").html(result);
				$("#state-dropdown").val(state_name);
			}
		});
	}

	if($('#select_state_dropdown').val() != '') {
		var state_name = $('#select_state_dropdown').val();
		$.ajax({
			url: "<?php echo base_url()?>Welcome/cities_by_state",
			type: "POST",
			data: {
				state_name: state_name
			},
			cache: false,
			success: function(result){
				$("#city-dropdown").html(result);
				$("#city-dropdown").val($('#select_city_dropdown').val());
			}
		});
	}

	var i=1;
	var addButton = $('.add_button'); //Add button selector
	var wrapper = $('.field_wrapper'); //Input field wrapper
	//var fieldHTML = ;
	$(addButton).click(function(){
		i++;
		$(".field_wrapper").append('<div class="row" id="row'+i+'"><div class="col-lg-12 mb-3"> <label>School / College Name</label> <input type="text" class="form-control" name="college_name[]" id="college_name" value=""> </div> <div class="col-lg-4 mb-3"> <label>Course Name</label> <input type="text" class="form-control" name="coursename[]" id="coursename" value=""> </div> <div class="col-lg-4 mb-3"> <label>Class Rank</label> <input type="text" class="form-control" name="class_rank[]" id="class_rank" value=""> </div> <div class="col-lg-4 mb-3"> <label>Year of Passing </label> <input type="text" class="form-control" name="passing_of_year[]" id="passing_of_year" value=""> </div> <div class="col-lg-12 mb-3"> <label>Achievement </label> <textarea class="form-control" name="achievement[]" id="achievement"></textarea> </div> <div class="col-lg-12 mb-3 text-end"> <a class="remove-extend-field"><button type="button" name="remove" id="'+i+'" class="btn_remove"><i class="fa fa-times" aria-hidden="true"></i></button></a></div><hr></div>'); //Add field html
	});

	$(document).on('click', '.btn_remove', function(){
		var button_id = $(this).attr("id");
		$('#row'+button_id+'').remove();
	});

	var j=1;
	var addExpButton = $('.add_expbutton'); //Add button selector
	var exPwrapper = $('.field_wrapper_exp'); //Input field wrapper
	//var fieldHTML = ;
	$(addExpButton).click(function(){
		j++;
		$(".field_wrapper_exp").append('<div class="row" id="row'+j+'"><div class="col-lg-6 mb-3"> <label>Company Name</label> <input type="text" class="form-control" name="company_name[]" id="company_name" value=""> </div> <div class="col-lg-6 mb-3"> <label>Designation</label> <input type="text" class="form-control" name="exp_designation[]" id="exp_designation" value=""> </div> <div class="col-lg-6 mb-3"> <label>Start Date</label> <input type="date" class="form-control" name="exp_start_date[]" id="exp_start_date" value=""> </div> <div class="col-lg-6 mb-3"> <label>End Date</label> <input type="date" class="form-control" name="exp_end_date[]" id="exp_end_date" value=""> </div> <div class="col-lg-12 mb-3"> <label>Information</label> <textarea class="form-control" name="exp_information[]" id="exp_information"></textarea> </div><div class="col-lg-12 mb-3 text-end"> <a class="remove-extend-field"><button type="button" name="remove" id="'+j+'" class="btn_expremove"><i class="fa fa-times" aria-hidden="true"></i></button></a></div><hr></div>'); //Add field html
	});

	$(document).on('click', '.btn_expremove', function(){
		var button_id = $(this).attr("id");
		$('#row'+button_id+'').remove();
	});

	var k=1;
	var addRefButton = $('.add_refbutton'); //Add button selector
	var reFwrapper = $('.field_wrapper_ref'); //Input field wrapper
	//var fieldHTML = ;
	$(addRefButton).click(function(){
		k++;
		$(".field_wrapper_ref").append('<div class="row" id="row'+k+'"><div class="col-lg-6 mb-3"> <label>Referrer Name</label> <input type="text" class="form-control" name="referrer_name[]" id="referrer_name" value=""> </div> <div class="col-lg-6 mb-3"> <label>Referrer Email</label> <input type="email" class="form-control" name="referrer_email[]" id="referrer_email" value=""> </div><div class="col-lg-12 mb-3 text-end"> <a class="remove-extend-field"><button type="button" name="remove" id="'+k+'" class="btn_refremove"><i class="fa fa-times" aria-hidden="true"></i></button></a></div><hr></div>'); //Add field html
	});

	$(document).on('click', '.btn_refremove', function(){
		var button_id = $(this).attr("id");
		$('#row'+button_id+'').remove();
	});
});
</script>