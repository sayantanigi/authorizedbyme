<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);
class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('post_job_model');
		$this->load->model('Users_model');
		if (empty($_SESSION['authorized'])) {
			redirect();
		}
	}

	public function index()
	{
		/*$data['get_service'] = $this->Crud_model->GetData('employer_services', '', "employer_id='" . $_SESSION['authorized']['userId'] . "'");
					$data['get_job'] = $this->Crud_model->GetData('postjob', '', "user_id='".$_SESSION['authorized']['userId']."'");
					$data['bid_job'] = $this->db->query("SELECT `postjob`.*, `job_bid`.* FROM `job_bid` JOIN `postjob` ON `postjob`.`id` = `job_bid`.`postjob_id` where `postjob`.user_id = '".$_SESSION['authorized']['userId']."' AND postjob.is_delete = '0'")->result_array();
					$data['get_subscribe'] = $this->Crud_model->GetData('employer_subscription', '', "employer_id='" . $_SESSION['authorized']['userId'] . "'");*/
		$data['get_user'] = $this->Crud_model->get_single('users', "userId = '" . $_SESSION['authorized']['userId'] . "' AND userType = '" . $_SESSION['authorized']['userType'] . "' AND usersubType = '" . $_SESSION['authorized']['usersubType'] . "'");
		$data['get_product'] = $this->Crud_model->GetData('user_product', '', "user_id='" . $_SESSION['authorized']['userId'] . "' AND status = 1 AND is_delete= 1");
		$this->load->view('header');
		$this->load->view('user_dashboard/dashboard', $data);
		$this->load->view('footer');
	}

	public function view_profile()
	{
		$user_info = $this->Crud_model->get_single('users', "userId='" . $_SESSION['authorized']['userId'] . "'");
		$data = array(
			'userinfo' => $user_info,
		);
		$this->load->view('header');
		$this->load->view('user_dashboard/view_profile', $data);
		$this->load->view('footer');
	}

	public function profile()
	{
		$user_info = $this->Crud_model->get_single('users', "userId='" . $_SESSION['authorized']['userId'] . "'");
		$user_academics = $this->Crud_model->GetData('user_education', '', "user_id='" . $_SESSION['authorized']['userId'] . "'");
		$user_experience = $this->Crud_model->GetData('user_workexperience', '', "user_id='" . $_SESSION['authorized']['userId'] . "'");
		$user_reference = $this->Crud_model->GetData('user_reference', '', "user_id='" . $_SESSION['authorized']['userId'] . "'");
		$data = array(
			'userinfo' => $user_info,
			'useracademics' => $user_academics,
			'userexperience' => $user_experience,
			'userreference' => $user_reference,
		);
		$this->load->view('header');
		$this->load->view('user_dashboard/dashboard', $data);
		$this->load->view('footer');
	}

	public function teams()
	{
		$this->load->view('header');
		$this->load->view('user_dashboard/teams');
		$this->load->view('footer');
	}

	public function team_details()
	{
		$this->load->view('header');
		$this->load->view('user_dashboard/team_details');
		$this->load->view('footer');
	}

	public function matches()
	{
		$this->load->view('header');
		$this->load->view('user_dashboard/matches');
		$this->load->view('footer');
	}

	public function update_profile()
	{
		//echo "<pre>"; print_r($this->input->post()); die();
		if ($_FILES['profilePic']['name'] != '') {
			$_POST['profilePic'] = rand(0000, 9999) . "_" . $_FILES['profilePic']['name'];
			$config2['image_library'] = 'gd2';
			$config2['source_image'] = $_FILES['profilePic']['tmp_name'];
			$config2['new_image'] = getcwd() . '/uploads/users/' . $_POST['profilePic'];
			$config2['upload_path'] = getcwd() . '/uploads/users/';
			$config2['allowed_types'] = 'JPG|PNG|JPEG|jpg|png|jpeg';
			$config2['maintain_ratio'] = FALSE;
			$this->image_lib->initialize($config2);
			if (!$this->image_lib->resize()) {
				echo ('<pre>');
				echo ($this->image_lib->display_errors());
				exit;
			} else {
				$image = $_POST['profilePic'];
				@unlink('uploads/users/' . $_POST['old_image']);
			}
		} else {
			$image = $_POST['old_image'];
		}

		if (!empty($this->input->post('key_skills'))) {
			$key_skills = $this->input->post('key_skills');
			for ($i = 0; $i < count($key_skills); $i++) {
				$get_specialist = $this->db->query("SELECT * FROM specialist WHERE specialist_name = '" . $key_skills[$i] . "'")->result();
				if (empty($get_specialist)) {
					$insrt = array(
						'specialist_name' => $key_skills[$i],
						'userType' => $_SESSION['authorized']['usersubType'],
						'created_date' => date('Y-m-d H:i:s'),
					);
					$this->db->insert('specialist', $insrt);
				}
			}
			$skills = implode(", ", $this->input->post('key_skills', TRUE));
		} else {
			$skills = '';
		}

		$data = array(
			'firstname' => $_POST['firstname'],
			'lastname' => $_POST['lastname'],
			'designation' => $_POST['designation'],
			'skills' => $skills,
			'email' => $_POST['email'],
			'mobile' => $_POST['mobile'],
			'address' => $_POST['address'],
			'location' => $_POST['location'],
			'country' => $_POST['country-dropdown'],
			'state' => $_POST['state-dropdown'],
			'city' => $_POST['city-dropdown'],
			'zipcode' => $_POST['zipcode'],
			'short_bio' => $_POST['short_bio'],
			'profilePic' => $image,
			'latitude' => $_POST['latitude'],
			'longitude' => $_POST['longitude'],
		);

		if (!empty($_POST["college_name"])) {
			$academicsitemCount = count($_POST["college_name"]);
			$delete_query = $this->db->query("DELETE FROM user_education WHERE user_id = '" . $_SESSION['authorized']['userId'] . "'");
			for ($i = 0; $i < $academicsitemCount; $i++) {
				if (!empty($_POST["college_name"][$i]) || !empty($_POST["coursename"][$i]) || !empty($_POST["class_rank"][$i]) || !empty($_POST["passing_of_year"][$i]) || !empty($_POST["achievement"][$i])) {
					$academicsinsrt = array(
						'user_id' => $_SESSION['authorized']['userId'],
						'college_name' => $_POST["college_name"][$i],
						'coursename' => $_POST["coursename"][$i],
						'class_rank' => $_POST["class_rank"][$i],
						'passing_of_year' => $_POST["passing_of_year"][$i],
						'achievement' => $_POST["achievement"][$i],
						'created_date' => date('Y-m-d H:i:s'),
					);
					$this->db->insert('user_education', $academicsinsrt);
				}
			}
		}

		if (!empty($_POST["company_name"])) {
			$experienceitemCount = count($_POST["company_name"]);
			$delete_query = $this->db->query("DELETE FROM user_workexperience WHERE user_id = '" . $_SESSION['authorized']['userId'] . "'");
			for ($j = 0; $j < $experienceitemCount; $j++) {
				if (!empty($_POST["company_name"][$j]) || !empty($_POST["exp_designation"][$j]) || !empty($_POST["exp_start_date"][$j]) || !empty($_POST["exp_end_date"][$j]) || !empty($_POST["exp_information"][$j])) {
					$experienceinsrt = array(
						'user_id' => $_SESSION['authorized']['userId'],
						'company_name' => $_POST["company_name"][$j],
						'designation' => $_POST["exp_designation"][$j],
						'from_date' => $_POST["exp_start_date"][$j],
						'to_date' => $_POST["exp_end_date"][$j],
						'description' => $_POST["exp_information"][$j],
						'created_date' => date('Y-m-d H:i:s'),
					);
					$this->db->insert('user_workexperience', $experienceinsrt);
				}
			}
		}

		if (!empty($_POST["referrer_name"])) {
			$referreritemCount = count($_POST["referrer_name"]);
			$delete_query = $this->db->query("DELETE FROM user_reference WHERE user_id = '" . $_SESSION['authorized']['userId'] . "'");
			for ($j = 0; $j < $referreritemCount; $j++) {
				if (!empty($_POST["referrer_name"][$j]) || !empty($_POST["referrer_email"][$j])) {
					$referrerinsrt = array(
						'user_id' => $_SESSION['authorized']['userId'],
						'referrer_name' => $_POST["referrer_name"][$j],
						'referrer_email' => $_POST["referrer_email"][$j],
						'created_date' => date('Y-m-d H:i:s'),
					);
					$this->db->insert('user_reference', $referrerinsrt);
				}
			}
		}

		$this->Crud_model->SaveData('users', $data, "userId='" . $_SESSION['authorized']['userId'] . "'");
		// echo $_POST['from_data_request'];die;
		if ($_POST['from_data_request'] == 'admin') {
			$this->session->set_flashdata('message', 'Profile Updated Successfull !');
			redirect(base_url('admin/users'));
		} else {
			$this->session->set_flashdata('message', 'Profile Updated Successfull !');
			redirect(base_url('profile/dashboard'));
		}
	}

	function getVisIpAddr()
	{
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			return $_SERVER['HTTP_CLIENT_IP'];
		} else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			return $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			return $_SERVER['REMOTE_ADDR'];
		}
	}

	public function subscription()
	{
		if ($_SESSION['authorized']['userType'] == '2') {
			$uType = 'Clients';
		} else {
			$uType = 'Representatives';
		}

		$data['get_subscription'] = $this->db->query("SELECT * FROM subscription WHERE subscription_user_type = '" . $uType . "'")->result();
		$data['current_plan'] = $this->Crud_model->GetData('employer_subscription', '', "employer_id='" . $_SESSION['authorized']['userId'] . "' AND status IN (1,2)");
		$data['expired_plan'] = $this->Crud_model->GetData('employer_subscription', '', "employer_id='" . $_SESSION['authorized']['userId'] . "' AND status = '3'");
		$data['subscription_check'] = $this->db->query("SELECT * FROM employer_subscription WHERE employer_id='" . $_SESSION['authorized']['userId'] . "' AND (status = '1' OR status = '2')")->result_array();
		$this->load->view('header');
		$this->load->view('user_dashboard/subscription', $data);
		$this->load->view('footer');
	}

	public function products()
	{
		$data['product_list'] = $this->Crud_model->GetData('user_product', '', "user_id='" . $_SESSION['authorized']['userId'] . "' AND status = 1 and is_delete = 1");
		$this->load->view('header');
		$this->load->view('user_dashboard/product/list', $data);
		$this->load->view('footer');
	}

	public function myservice()
	{
		$data['get_services'] = $this->Crud_model->GetData('employer_services', '', "employer_id='" . $_SESSION['authorized']['userId'] . "'");
		$this->load->view('header');
		$this->load->view('user_dashboard/my_service', $data);
		$this->load->view('footer');
	}

	public function service_form()
	{
		$get_category = $this->Crud_model->GetData('category');
		$data = array(
			'button' => 'Submit',
			'action' => base_url('user/Dashboard/save_service'),
			'service_name' => set_value('service_name'),
			'category_id' => set_value('category_id'),
			'subcategory_id' => set_value('subcategory_id'),
			'description' => set_value('description'),
			'get_category' => $get_category,
			'id' => set_value('id'),
		);
		$this->load->view('header');
		$this->load->view('user_dashboard/service_form', $data);
		$this->load->view('footer');
	}

	public function update_service_form($id)
	{
		$service_id = base64_decode($id);
		$get_category = $this->Crud_model->GetData('category');
		$get_subcategory = $this->Crud_model->GetData('sub_category');
		$get_services = $this->Crud_model->get_single('employer_services', "id='" . $service_id . "'");
		$data = array(
			'button' => 'Update',
			'action' => base_url('user/Dashboard/update_service'),
			//'action'=>admin_url('Event/create_action'),
			'service_name' => $get_services->service_name,
			'category_id' => $get_services->category_id,
			'subcategory_id' => $get_services->subcategory_id,
			'description' => $get_services->description,
			'id' => $get_services->id,
			'get_category' => $get_category,
			'get_subcategory' => $get_subcategory,
		);
		$this->load->view('header');
		$this->load->view('user_dashboard/service_form', $data);
		$this->load->view('footer');
	}

	public function save_service()
	{
		$data = array(
			'employer_id' => $_SESSION['authorized']['userId'],
			'service_name' => $_POST['service_name'],
			'category_id' => $_POST['category_id'],
			'subcategory_id' => $_POST['subcategory_id'],
			'description' => $_POST['description'],
			'created_date' => date('Y-m-d H:i:s'),
		);
		$this->Crud_model->SaveData('employer_services', $data);
		$this->session->set_flashdata('message', 'Services Created Successfull !');
		redirect(base_url('myservice'));
	}

	public function update_service()
	{
		$id = $_POST['id'];
		$data = array(
			'service_name' => $_POST['service_name'],
			'category_id' => $_POST['category_id'],
			'subcategory_id' => $_POST['subcategory_id'],
			'description' => $_POST['description'],
		);
		$this->Crud_model->SaveData('employer_services', $data, "id='" . $id . "'");
		$this->session->set_flashdata('message', 'Services Updated Successfully !');
		redirect(base_url('myservice'));
	}

	function delete_service($id)
	{

		$this->Crud_model->DeleteData('employer_services', "id='" . $id . "'");
		$this->session->set_flashdata('message', 'Service Deleted successfully !');
		redirect(base_url('myservice'));
	}

	public function myjob()
	{
		$data['get_postjob'] = $this->Crud_model->GetData('postjob', '', "user_id='" . $_SESSION['authorized']['userId'] . "' ");
		//print_r($data); die();
		$this->load->view('header');
		$this->load->view('user_dashboard/my_job', $data);
		$this->load->view('footer');
	}

	public function buy_subscription()
	{
		$employer_id = $_SESSION['authorized']['userId'];
		$data = array(
			'employer_id' => $employer_id,
			'subscription_id' => $_POST['subscription_id'],
			'amount' => $_POST['amount'],
			'created_date' => date('Y-m-d, H:i:s'),
		);
		$this->Crud_model->SaveData('employer_subscription', $data);
		$this->session->set_flashdata('message', 'Subscription purchased Successfull !');
		echo '1';
	}

	////////////////////////////////////////// start job bidding//////////////////
	function jobbid()
	{
		$this->load->model('Post_job_model');
		if ($_SESSION['authorized']['userType'] == '1') {
			$cond = "job_bid.user_id='" . $_SESSION['authorized']['userId'] . "'";
		} else {
			$cond = "postjob.user_id='" . $_SESSION['authorized']['userId'] . "'";
		}
		$data['get_postjob'] = $this->Post_job_model->postjob_bid($cond);
		$this->load->view('header');
		$this->load->view('user_dashboard/my_jobbid', $data);
		$this->load->view('footer');
	}

	function save_postbid()
	{
		$data = array(
			'postjob_id' => $_POST['postjob_id'],
			'user_id' => $_SESSION['authorized']['userId'],
			'bid_amount' => $_POST['bid_amount'],
			'currency' => $_POST['currency'],
			//'email' => $_POST['email'],
			'duration' => $_POST['duration'],
			//'phone' => $_POST['phone'],
			'description' => $_POST['description'],
			'created_date' => date('Y-m-d H:i:s'),
		);
		$this->Crud_model->SaveData('job_bid', $data);
		$insert_id = $this->db->insert_id();
		if (!empty($insert_id)) {
			$this->session->set_flashdata('message', 'Bid Submitted Successfully! You will be notified once the Client has approved your bid');
			redirect(base_url("page/postdetail/" . base64_encode($_POST['postjob_id'])), "refresh");
		} else {
			$this->session->set_flashdata('message', 'Something went wrong. Please try again later.');
			redirect(base_url("page/postdetail/" . base64_encode($_POST['postjob_id'])), "refresh");
		}

	}

	/*function changebiddingstatus() {
			  print_r($this->input->post()); die;
			  $get_data = $this->Crud_model->get_single('job_bid', "id='" . $_POST['jobbid_id'] . "'");
			  if ($get_data->bidding_status == 'Pending') {
				  $data1 = array(
					  'bidding_status' => 'Accept',
				  );
				  $this->Crud_model->SaveData('job_bid', $data1, "id='" . $_POST['jobbid_id'] . "'");
			  }
			  $updatepost = array(
				  'is_delete' => 1,
			  );
			  $this->Crud_model->SaveData('postjob', $updatepost, "id='" . $get_data->postjob_id . "'");
			  $binddingstatus = $this->Crud_model->GetData('job_bid', '', "postjob_id='" . $get_data->postjob_id . "' and bidding_status='Pending'");
			  foreach ($binddingstatus as $row) {
				  $data = array(
					  'bidding_status' => 'Reject',
				  );
				  $this->Crud_model->SaveData('job_bid', $data, "id='" . $row->id . "'");
			  }
			  echo "1";
			  exit;
		  }*/

	function changebiddingstatus()
	{
		$bidstatus = $this->input->post('bidstatus');
		$jodBidid = $this->input->post('jodBidid');
		$postJobid = $this->input->post('postJobid');
		$jobbiduserid = $this->input->post('jobbiduserid');
		$jobpostuserid = $this->input->post('jobpostuserid');
		$data1 = array(
			'bidding_status' => $bidstatus,
		);
		$this->Crud_model->SaveData('job_bid', $data1, "id='" . $jodBidid . "' AND postjob_id='" . $postJobid . "'");
		if ($bidstatus == "Selected") {
			$this->Crud_model->SaveData('job_bid', $data1, "id='" . $jodBidid . "' AND postjob_id='" . $postJobid . "'");
			$binddingstatus = $this->Crud_model->GetData('job_bid', '', "postjob_id = '" . $postJobid . "' and bidding_status IN ('Pending','Under Review','Short Listed')");
			foreach ($binddingstatus as $row) {
				$data = array(
					'bidding_status' => 'Rejected',
				);
				$this->Crud_model->SaveData('job_bid', $data, "id='" . $row->id . "'");
			}
			$updatepost = array(
				'is_delete' => 1,
			);
			$this->Crud_model->SaveData('postjob', $updatepost, "id='" . $postJobid . "'");
		}
		echo "1";
		exit;
	}

	/////////////////////////////////////////  End job bidding////////////////////
	function calender()
	{
		$this->load->view('header');
		$this->load->view('user_dashboard/calender');
		$this->load->view('footer');
	}

	////////////////////////////////// start chat functionality////////////////
	function chat()
	{
		$data['get_user'] = $this->Crud_model->get_single('users', "userId ='" . $_SESSION['authorized']['userId'] . "'");
		$cond = "job_bid.bidding_status IN ('Short Listed','Selected')";
		$data['get_jobbid'] = $this->Users_model->get_jobbidding($cond);
		$this->load->view('header');
		$this->load->view('user_dashboard/chat', $data);
		$this->load->view('footer');
	}

	function filechat()
	{
		// echo "hhhhjkl";die;
		$data['get_user'] = $this->Crud_model->get_single('users', "userId ='" . $_SESSION['authorized']['userId'] . "'");
		$cond = "job_bid.bidding_status IN ('Short Listed','Selected')";
		$data['get_jobbid'] = $this->Users_model->get_jobbidding($cond);
		$this->load->view('header');
		$this->load->view('user_dashboard/file_chat', $data);
		$this->load->view('footer');
	}

	function textchat()
	{
		// echo "hhhhjkl";die;
		$data['get_user'] = $this->Crud_model->get_single('users', "userId ='" . $_SESSION['authorized']['userId'] . "'");
		$cond = "job_bid.bidding_status IN ('Short Listed','Selected')";
		$data['get_jobbid'] = $this->Users_model->get_jobbidding($cond);
		$this->load->view('header');
		$this->load->view('user_dashboard/text_chat', $data);
		$this->load->view('footer');
	}


	

	// function showmessage_count() {
	// 	$userId = $this->input->post('userId');
	// 	$user_id = $this->input->post('usertoid');
	// 	$post_id = $this->input->post('postid');
	// 	$getUserType = $this->db->query("Select * FROM users WHERE userId ='".$user_id."'")->result();
	// 	$uType = $getUserType[0]->userType;
	// 	$countMessage = $this->db->query("Select COUNT(id) as msgcount, userfrom_id, userto_id FROM chat WHERE (userfrom_id ='".$usertoid."' AND userto_id ='".$userfromid."') OR (userto_id ='".$usertoid."' AND userfrom_id ='".$userfromid."') AND postjob_id = '".$post_id."' AND status = 0")->result();
	// 	$data = array(
	// 		'userfrom_id' => $countMessage[0]->userfrom_id,
	// 		'userto_id' => $countMessage[0]->userto_id,
	// 		'count' => $countMessage[0]->msgcount,
	// 	);
	// 	echo json_encode($data);
	// }

	function showmessage_count()
	{
		$user_id = $this->input->post('userId');
		//echo "Select COUNT(id) as msgcount, userto_id FROM chat WHERE userto_id ='".$user_id."' AND status = '0'";
		$getUserType = $this->db->query("Select * FROM users WHERE userId ='" . $user_id . "'")->result();
		$uType = $getUserType[0]->userType;
		$countMessage = $this->db->query("Select COUNT(id) as msgcount, userfrom_id, userto_id FROM chat WHERE userto_id ='" . $user_id . "' AND status = '0'")->result();

		$countMessagefile = $this->db->query("Select COUNT(id) as msgcount, userfrom_id, userto_id FROM chat WHERE userto_id ='" . $user_id . "' AND status = '0' AND attachment!=''")->result();

		$data = array(
			'userfrom_id' => $countMessage[0]->userfrom_id,
			'userto_id' => $countMessage[0]->userto_id,
			'count' => $countMessage[0]->msgcount,
			'count_file'=>$countMessagefile[0]->msgcount,
		);
		echo json_encode($data);
	}

	function showmessageCountEach()
	{
		$userfromid = $this->input->post('userfromid');
		$usertoid = $this->input->post('usertoid');
		$postid = $this->input->post('postid');
		$getEachChatCount = $this->db->query("Select COUNT(id) as msgcount, userfrom_id, userto_id, postjob_id FROM chat WHERE userto_id ='" . $userfromid . "' AND postjob_id ='" . $postid . "' AND status = '0'")->result();
		$data = array(
			'userfrom_id' => $getEachChatCount[0]->userfrom_id,
			'userto_id' => $getEachChatCount[0]->userto_id,
			'count' => $getEachChatCount[0]->msgcount,
		);
		echo json_encode($data);
	}


	function showmessage_list_text()
	{
		$userdId = $_SESSION['authorized']['userId'];
		$usert_id = $this->input->post('usert_id');
		$post_id = $this->input->post('post_id');
		$get_data = $this->Users_model->getChatfile();



		$updatastatus = $this->db->query("UPDATE chat SET status = '1' WHERE (userfrom_id ='" . $usert_id . "' AND userto_id ='" . $userdId . "') OR (userto_id ='" . $usert_id . "' AND userfrom_id ='" . $userdId . "')");
		$get_chatuser = $this->Crud_model->get_single('users', "userId='" . $_POST['usert_id'] . "'");
		if (!empty($get_chatuser->firstname)) {
			$name = $get_chatuser->firstname . ' ' . $get_chatuser->lastname;
		} else {
			$name = $get_chatuser->companyname;
		}
		if (@$get_chatuser->profilePic && file_exists('uploads/users/' . @$get_chatuser->profilePic)) {
			$userpic = '<img src="' . base_url('uploads/users/' . @$get_chatuser->profilePic) . '" alt="" />';
		} else {
			$userpic = '<img src="' . base_url('uploads/users/user.png') . '" alt="" />';
		}





		$html_data = '
		<div class="contact-profile">
			<div>' . $userpic .
			'<p>' . ucfirst($name) . '</p></div>
			<div class="social-media">
			<a href="#"><i class="fa fa-phone" aria-hidden="true"></i></a>
			<a href="javascript:void(0);" onclick="openVideoCallWindow(' . $user_id . ');"><i class="fa fa-video-camera" aria-hidden="true"></i></a>
			<a href="#"><i class="fa fa-cog" aria-hidden="true"></i></a>
			</div>
			<div class="search-chat" onclick="searchChat();">
			<i class="fa fa-search search-chatfa" aria-hidden="true"></i>
			</div>
		</div>
		<div class="extend_search_chat"><input type="text" name="search_chat" id="search_chat" placeholder="Search in chat"></div>
		<div class="messages"><ul>';
		if (!empty($get_data)) {
			foreach ($get_data as $key) {
				if (@$key->profilePic && file_exists('uploads/users/' . @$key->profilePic) && $key->postjob_id == $_POST['post_id']) {
					$from_pic = '<img src="' . base_url('uploads/users/' . @$key->profilePic) . '" alt="" />';
				} else {
					$from_pic = '<img src="' . base_url('uploads/users/user.png') . '" alt="" />';
				}
				if (@$key->profilePic && file_exists('uploads/users/' . @$key->profilePic) && $key->postjob_id == $_POST['post_id']) {
					$to_pic = '<img src="' . base_url('uploads/users/' . @$key->profilePic) . '" alt="" />';
				} else {
					$to_pic = '<img src="' . base_url('uploads/users/user.png') . '" alt="" />';
				}

				if (@$key->attachment && file_exists('uploads/chat/'.$userdId .'/shared/'. @$key->attachment) && $key->postjob_id == $_POST['post_id']) {
					$chatpicfrom = '<iframe class="chat-iframe"  src="' . base_url('uploads/chat/'.$userdId .'/shared/'. @$key->attachment) . '"></iframe>';
				} else {
					$chatpicfrom = '';
				}
				if (@$key->attachment && file_exists('uploads/chat/'.$usert_id .'/shared/'. @$key->attachment) && $key->postjob_id == $_POST['post_id']) {
					$chatpicto = '<iframe class="chat-iframe"  src="' . base_url('uploads/chat/'.$usert_id .'/shared/'. @$key->attachment) . '"></iframe>';
				} else {
					$chatpicto = '';
				}


				if ($key->userfrom_id == $_SESSION['authorized']['userId'] && $key->userto_id == $_POST['usert_id'] && $key->postjob_id == $_POST['post_id'] && $chatpicfrom=='') {

					$sent = '<li class="sent">' . $from_pic . '<p>' . $key->message . '</p><div style="font-size: 10px;">' . $key->created_date . '</li>';

					
				} else {
					$sent = '';
				}
				if ($key->userto_id == $_SESSION['authorized']['userId'] && $key->userfrom_id == $_POST['usert_id'] && $key->postjob_id == $_POST['post_id'] &&  $chatpicto=='') {

					$reply = '<li class="replies">' . $to_pic . '<p>' . $key->message . '</p><div style="font-size: 10px;">' . $key->created_date . '</li>';

				} else {
					$reply = '';
				}
				$html_data .= $sent . $reply;
			}
		} else {
			$html_data .= '<li class="sent"><center>No Messages</center></li>';
		}
		echo json_encode($html_data);
		exit;
		//  echo "<pre>";print_r($get_data);die;
		// $updatastatus = $this->db->query("UPDATE chat SET status = '1' WHERE (userfrom_id ='" . $usert_id . "' AND userto_id ='" . $userdId . "') OR (userto_id ='" . $usert_id . "' AND userfrom_id ='" . $userdId . "')");
		// $get_chatuser = $this->Crud_model->get_single('users', "userId='" . $_POST['usert_id'] . "'");
		// if (!empty($get_chatuser->firstname)) {
		// 	$name = $get_chatuser->firstname . ' ' . $get_chatuser->lastname;
		// } else {
		// 	$name = $get_chatuser->companyname;
		// }
		// if (@$get_chatuser->profilePic && file_exists('uploads/users/' . @$get_chatuser->profilePic)) {
		// 	$userpic = '<img src="' . base_url('uploads/users/' . @$get_chatuser->profilePic) . '" alt="" />';
		// } else {
		// 	$userpic = '<img src="' . base_url('uploads/users/user.png') . '" alt="" />';
		// }





		// $html_data = '
		// <div class="contact-profile">
		// 	<div>' . $userpic .
		// 	'<p>' . ucfirst($name) . '</p></div>
		// 	<div class="social-media">
		// 	<a href="#"><i class="fa fa-phone" aria-hidden="true"></i></a>
		// 	<a href="javascript:void(0);" onclick="openVideoCallWindow(' . $user_id . ');"><i class="fa fa-video-camera" aria-hidden="true"></i></a>
		// 	<a href="#"><i class="fa fa-cog" aria-hidden="true"></i></a>
		// 	</div>
		// 	<div class="search-chat" onclick="searchChat();">
		// 	<i class="fa fa-search search-chatfa" aria-hidden="true"></i>
		// 	</div>
		// </div>
		// <div class="extend_search_chat"><input type="text" name="search_chat" id="search_chat" placeholder="Search in chat"></div>
		// <div class="messages"><ul>';
		// if (!empty($get_data)) {
		// 	foreach ($get_data as $key) {
		// 		if (@$key->profilePic && file_exists('uploads/users/' . @$key->profilePic) && $key->postjob_id == $_POST['post_id']) {
		// 			$from_pic = '<img src="' . base_url('uploads/users/' . @$key->profilePic) . '" alt="" />';
		// 		} else {
		// 			$from_pic = '<img src="' . base_url('uploads/users/user.png') . '" alt="" />';
		// 		}
		// 		if (@$key->profilePic && file_exists('uploads/users/' . @$key->profilePic) && $key->postjob_id == $_POST['post_id']) {
		// 			$to_pic = '<img src="' . base_url('uploads/users/' . @$key->profilePic) . '" alt="" />';
		// 		} else {
		// 			$to_pic = '<img src="' . base_url('uploads/users/user.png') . '" alt="" />';
		// 		}

		// 		if (@$key->attachment && file_exists('uploads/chat/'.$userdId .'/shared/'. @$key->attachment) && $key->postjob_id == $_POST['post_id']) {
		// 			$chatpicfrom = '<iframe class="chat-iframe"  src="' . base_url('uploads/chat/'.$userdId .'/shared/'. @$key->attachment) . '"></iframe>';
		// 		} else {
		// 			$chatpicfrom = '';
		// 		}
		// 		if (@$key->attachment && file_exists('uploads/chat/'.$usert_id .'/shared/'. @$key->attachment) && $key->postjob_id == $_POST['post_id']) {
		// 			$chatpicto = '<iframe class="chat-iframe"  src="' . base_url('uploads/chat/'.$usert_id .'/shared/'. @$key->attachment) . '"></iframe>';
		// 		} else {
		// 			$chatpicto = '';
		// 		}










		// 		// echo $key->userfrom_id."ses_userId".$_SESSION['authorized']['userId']."</br>";
		// 		// echo $key->userto_id."usertid".$_POST['usert_id']."</br>";
		// 		// echo $key->postjob_id."postid".$_POST['post_id'];die;

		// 		if ($key->userfrom_id == $_SESSION['authorized']['userId'] && $key->userto_id == $_POST['usert_id'] && $key->postjob_id == $_POST['post_id'] ) {


		// 			// if ($key->userfrom_id == $_SESSION['authorized']['userId'] && $key->userto_id == $_POST['usert_id'] && $key->postjob_id == $_POST['post_id'] && $chatpicfrom!='') {



		// 			// echo "1111";die;
		// 			$reply = '<li class="sent">' . $to_pic . '<p>' . $key->message . '</p><div style="font-size: 10px;">' . $key->created_date . '</li>';
		// 		} else {
		// 			// echo "2222";die;
		// 			$sent = '';
		// 		}
		// 		if ($key->userto_id == $_SESSION['authorized']['userId'] && $key->userfrom_id == $_POST['usert_id'] && $key->postjob_id == $_POST['post_id'] ) {
		// 			// echo "3333";die;

		// 			$reply = '<li class="replies">' . $to_pic . '<p>' . $key->message . '</p><span class="chat_pic_show">' . $chatpicto . '</span><div style="font-size: 10px;">' . $key->created_date . '</li>';
		// 		} else {
		// 			// echo "4444";die;
		// 			$reply = '';
		// 		}
		// 		$html_data .= $sent . $reply;
		// 	}
		// } else {
		// 	$html_data .= '<li class="sent"><center>No Messages</center></li>';
		// }
		// echo json_encode($html_data);
		// exit;
	}

	function showmessage_list_file()
	{
		$userdId = $_SESSION['authorized']['userId'];
		$usert_id = $this->input->post('usert_id');
		$post_id = $this->input->post('post_id');
		$get_data = $this->Users_model->getChatfile();
		// echo "<pre>";print_r($get_data);die;
		$updatastatus = $this->db->query("UPDATE chat SET status = '1' WHERE (userfrom_id ='" . $usert_id . "' AND userto_id ='" . $userdId . "') OR (userto_id ='" . $usert_id . "' AND userfrom_id ='" . $userdId . "')");
		$get_chatuser = $this->Crud_model->get_single('users', "userId='" . $_POST['usert_id'] . "'");
		if (!empty($get_chatuser->firstname)) {
			$name = $get_chatuser->firstname . ' ' . $get_chatuser->lastname;
		} else {
			$name = $get_chatuser->companyname;
		}
		if (@$get_chatuser->profilePic && file_exists('uploads/users/' . @$get_chatuser->profilePic)) {
			$userpic = '<img src="' . base_url('uploads/users/' . @$get_chatuser->profilePic) . '" alt="" />';
		} else {
			$userpic = '<img src="' . base_url('uploads/users/user.png') . '" alt="" />';
		}





		$html_data = '
		<div class="contact-profile">
			<div>' . $userpic .
			'<p>' . ucfirst($name) . '</p></div>
			<div class="social-media">
			<a href="#"><i class="fa fa-phone" aria-hidden="true"></i></a>
			<a href="javascript:void(0);" onclick="openVideoCallWindow(' . $user_id . ');"><i class="fa fa-video-camera" aria-hidden="true"></i></a>
			<a href="#"><i class="fa fa-cog" aria-hidden="true"></i></a>
			</div>
			<div class="search-chat" onclick="searchChat();">
			<i class="fa fa-search search-chatfa" aria-hidden="true"></i>
			</div>
		</div>
		<div class="extend_search_chat"><input type="text" name="search_chat" id="search_chat" placeholder="Search in chat"></div>
		<div class="messages"><ul>';
		if (!empty($get_data)) {
			foreach ($get_data as $key) {
				if (@$key->profilePic && file_exists('uploads/users/' . @$key->profilePic) && $key->postjob_id == $_POST['post_id']) {
					$from_pic = '<img src="' . base_url('uploads/users/' . @$key->profilePic) . '" alt="" />';
				} else {
					$from_pic = '<img src="' . base_url('uploads/users/user.png') . '" alt="" />';
				}
				if (@$key->profilePic && file_exists('uploads/users/' . @$key->profilePic) && $key->postjob_id == $_POST['post_id']) {
					$to_pic = '<img src="' . base_url('uploads/users/' . @$key->profilePic) . '" alt="" />';
				} else {
					$to_pic = '<img src="' . base_url('uploads/users/user.png') . '" alt="" />';
				}

				if (@$key->attachment && file_exists('uploads/chat/'.$userdId .'/shared/'. @$key->attachment) && $key->postjob_id == $_POST['post_id']) {
					$chatpicfrom = '<iframe class="chat-iframe"  src="' . base_url('uploads/chat/'.$userdId .'/shared/'. @$key->attachment) . '"></iframe>';
				} else {
					$chatpicfrom = '';
				}
				if (@$key->attachment && file_exists('uploads/chat/'.$usert_id .'/shared/'. @$key->attachment) && $key->postjob_id == $_POST['post_id']) {
					$chatpicto = '<iframe class="chat-iframe"  src="' . base_url('uploads/chat/'.$usert_id .'/shared/'. @$key->attachment) . '"></iframe>';
				} else {
					$chatpicto = '';
				}


				if ($key->userfrom_id == $_SESSION['authorized']['userId'] && $key->userto_id == $_POST['usert_id'] && $key->postjob_id == $_POST['post_id'] && $chatpicfrom!='') {
					$sent = '<li class="sent">' . $from_pic . '<span class="chat_pic_show">' . $chatpicfrom . '</span><div style="font-size: 10px;">' . $key->created_date . '</li>';
				} else {
					$sent = '';
				}
				if ($key->userto_id == $_SESSION['authorized']['userId'] && $key->userfrom_id == $_POST['usert_id'] && $key->postjob_id == $_POST['post_id'] &&  $chatpicto!='') {
					$reply = '<li class="replies">' . $to_pic . '<span class="chat_pic_show">' . $chatpicto . '</span><div style="font-size: 10px;">' . $key->created_date . '</li>';
				} else {
					$reply = '';
				}
				$html_data .= $sent . $reply;
			}
		} else {
			$html_data .= '<li class="sent"><center>No Messages</center></li>';
		}
		echo json_encode($html_data);
		exit;
	}
	function showmessage_list()
	{
		$userdId = $_SESSION['authorized']['userId'];
		$usert_id = $this->input->post('usert_id');
		$post_id = $this->input->post('post_id');
		$get_data = $this->Users_model->getChat();
		// echo "<pre>";print_r($get_data);die;
		$updatastatus = $this->db->query("UPDATE chat SET status = '1' WHERE (userfrom_id ='" . $usert_id . "' AND userto_id ='" . $userdId . "') OR (userto_id ='" . $usert_id . "' AND userfrom_id ='" . $userdId . "')");
		$get_chatuser = $this->Crud_model->get_single('users', "userId='" . $_POST['usert_id'] . "'");
		if (!empty($get_chatuser->firstname)) {
			$name = $get_chatuser->firstname . ' ' . $get_chatuser->lastname;
		} else {
			$name = $get_chatuser->companyname;
		}
		if (@$get_chatuser->profilePic && file_exists('uploads/users/' . @$get_chatuser->profilePic)) {
			$userpic = '<img src="' . base_url('uploads/users/' . @$get_chatuser->profilePic) . '" alt="" />';
		} else {
			$userpic = '<img src="' . base_url('uploads/users/user.png') . '" alt="" />';
		}





		$html_data = '
		<div class="contact-profile">
			<div>' . $userpic .
			'<p>' . ucfirst($name) . '</p></div>
			<div class="social-media">
			<a href="#"><i class="fa fa-phone" aria-hidden="true"></i></a>
			<a href="javascript:void(0);" onclick="openVideoCallWindow(' . $user_id . ');"><i class="fa fa-video-camera" aria-hidden="true"></i></a>
			<a href="#"><i class="fa fa-cog" aria-hidden="true"></i></a>
			</div>
			<div class="search-chat" onclick="searchChat();">
			<i class="fa fa-search search-chatfa" aria-hidden="true"></i>
			</div>
		</div>
		<div class="extend_search_chat"><input type="text" name="search_chat" id="search_chat" placeholder="Search in chat"></div>
		<div class="messages"><ul>';
		if (!empty($get_data)) {
			foreach ($get_data as $key) {
				if (@$key->profilePic && file_exists('uploads/users/' . @$key->profilePic) && $key->postjob_id == $_POST['post_id']) {
					$from_pic = '<img src="' . base_url('uploads/users/' . @$key->profilePic) . '" alt="" />';
				} else {
					$from_pic = '<img src="' . base_url('uploads/users/user.png') . '" alt="" />';
				}
				if (@$key->profilePic && file_exists('uploads/users/' . @$key->profilePic) && $key->postjob_id == $_POST['post_id']) {
					$to_pic = '<img src="' . base_url('uploads/users/' . @$key->profilePic) . '" alt="" />';
				} else {
					$to_pic = '<img src="' . base_url('uploads/users/user.png') . '" alt="" />';
				}

				if (@$key->attachment && file_exists('uploads/chat/'.$userdId .'/shared/'. @$key->attachment) && $key->postjob_id == $_POST['post_id']) {
					$chatpicfrom = '<iframe class="chat-iframe"  src="' . base_url('uploads/chat/'.$userdId .'/shared/'. @$key->attachment) . '"></iframe>';
				} else {
					$chatpicfrom = '';
				}
				if (@$key->attachment && file_exists('uploads/chat/'.$usert_id .'/shared/'. @$key->attachment) && $key->postjob_id == $_POST['post_id']) {
					$chatpicto = '<iframe class="chat-iframe"  src="' . base_url('uploads/chat/'.$usert_id .'/shared/'. @$key->attachment) . '"></iframe>';
				} else {
					$chatpicto = '';
				}



				if ($key->userfrom_id == $_SESSION['authorized']['userId'] && $key->userto_id == $_POST['usert_id'] && $key->postjob_id == $_POST['post_id']) {
					$sent = '<li class="sent">' . $from_pic . '<p>' . $key->message . '</p><span class="chat_pic_show">' . $chatpicfrom . '</span><div style="font-size: 10px;">' . $key->created_date . '</li>';
				} else {
					$sent = '';
				}
				if ($key->userto_id == $_SESSION['authorized']['userId'] && $key->userfrom_id == $_POST['usert_id'] && $key->postjob_id == $_POST['post_id']) {
					$reply = '<li class="replies">' . $to_pic . '<p>' . $key->message . '</p><span class="chat_pic_show">' . $chatpicto . '</span><div style="font-size: 10px;">' . $key->created_date . '</li>';
				} else {
					$reply = '';
				}
				$html_data .= $sent . $reply;
			}
		} else {
			$html_data .= '<li class="sent"><center>No Messages</center></li>';
		}
		echo json_encode($html_data);
		exit;
	}

	function showmessage_listS()
	{
		$userfrom_id = $this->input->post('userfromid');
		$user_id = $this->input->post('usertoid');
		$post_id = $this->input->post('postid');
		$get_data = $this->Users_model->getCurrentChat($userfrom_id, $user_id, $post_id);

		$updatastatus = $this->db->query("UPDATE chat SET status = '1' WHERE (userfrom_id ='" . $usert_id . "' AND userto_id ='" . $userdId . "') OR (userto_id ='" . $usert_id . "' AND userfrom_id ='" . $userdId . "')");
		$get_chatuser = $this->Crud_model->get_single('users', "userId='" . $user_id . "'");


		if (!empty($get_chatuser->firstname)) {
			$name = $get_chatuser->firstname . ' ' . $get_chatuser->lastname;
		} else {
			$name = $get_chatuser->companyname;
		}
		if (@$get_chatuser->profilePic && file_exists('uploads/users/' . @$get_chatuser->profilePic)) {
			$userpic = '<img src="' . base_url('uploads/users/' . @$get_chatuser->profilePic) . '" alt="" />';
		} else {
			$userpic = '<img src="' . base_url('uploads/users/user.png') . '" alt="" />';
		}


		$html_data = '
		<div class="contact-profile">
			<div>' . $userpic .
			'<p>' . ucfirst($name) . '</p></div>
			<div class="social-media">
			<a href="#"><i class="fa fa-phone" aria-hidden="true"></i></a>
			<a href="javascript:void(0);" onclick="openVideoCallWindow(' . $user_id . ');"><i class="fa fa-video-camera" aria-hidden="true"></i></a>
			<a href="#"><i class="fa fa-cog" aria-hidden="true"></i></a>
			</div>
			<div class="search-chat" onclick="searchChat();">
			<i class="fa fa-search search-chatfa" aria-hidden="true"></i>
			</div>
		</div>
		<div class="extend_search_chat"><input type="text" name="search_chat" id="search_chat"></div>
		<div class="messages"><ul>';
		if (!empty($get_data)) {
			foreach ($get_data as $key) {
				if (@$key->profilePic && file_exists('uploads/users/' . @$key->profilePic) && $key->postjob_id == $post_id) {
					$from_pic = '<img src="' . base_url('uploads/users/' . @$key->profilePic) . '" alt="" />';
				} else {
					$from_pic = '<img src="' . base_url('uploads/users/user.png') . '" alt="" />';
				}
				if (@$key->profilePic && file_exists('uploads/users/' . @$key->profilePic) && $key->postjob_id == $post_id) {
					$to_pic = '<img src="' . base_url('uploads/users/' . @$key->profilePic) . '" alt="" />';
				} else {
					$to_pic = '<img src="' . base_url('uploads/users/user.png') . '" alt="" />';
				}

				// if (@$key->attachment && file_exists('uploads/chat/' . @$key->attachment) && $key->postjob_id == $post_id) {
				// 	$chatpic = '<iframe class="chat-iframe" src="' . base_url('uploads/chat/' . @$key->attachment) . '"></iframe>';
				// } else {
				// 	$chatpic = '';
				// }

				if (@$key->attachment && file_exists('uploads/chat/'.$userfrom_id .'/shared/'. @$key->attachment) && $key->postjob_id == $post_id) {
					$chatpicfrom = '<iframe class="chat-iframe"  src="' . base_url('uploads/chat/'.$userfrom_id .'/shared/'. @$key->attachment) . '"></iframe>';
				} else {
					$chatpicfrom = '';
				}
				if (@$key->attachment && file_exists('uploads/chat/'.$user_id .'/shared/'. @$key->attachment) && $key->postjob_id == $post_id) {
					$chatpicto = '<iframe class="chat-iframe"  src="' . base_url('uploads/chat/'.$user_id .'/shared/'. @$key->attachment) . '"></iframe>';
				} else {
					$chatpicto = '';
				}


				if ($key->userfrom_id == $_SESSION['authorized']['userId'] && $key->userto_id == $user_id && $key->postjob_id == $post_id) {
					// $sent = '<li class="sent">' . $from_pic . '<p>' . $key->message . '</p><div style="font-size: 10px;">' . $key->created_date . '</li>';
					$sent = '<li class="sent">' . $from_pic . '<p>' . $key->message . '</p><span class="chat_pic_show">' . $chatpicfrom . '</span><div style="font-size: 10px;">' . $key->created_date . '</li>';
				} else {
					$sent = '';
				}
				if ($key->userto_id == $_SESSION['authorized']['userId'] && $key->userfrom_id == $user_id && $key->postjob_id == $post_id) {
					// $reply = '<li class="replies">' . $to_pic . '<p>' . $key->message . '</p><div style="font-size: 10px;">' . $key->created_date . '</li>';
					$reply = '<li class="replies">' . $to_pic . '<p>' . $key->message . '</p><span class="chat_pic_show">' . $chatpicto . '</span><div style="font-size: 10px;">' . $key->created_date . '</li>';

				} else {
					$reply = '';
				}



				









				$html_data .= $sent . $reply;
			}
		} else {
			$html_data .= '<li class="sent"><center>No Messages</center></li>';
		}
		echo json_encode($html_data);
		exit;
	}

	function sent_message()
	{
		$userfromid = $this->input->post('userfromid');
		$usertoid = $this->input->post('usertoid');
		$updatastatus = $this->db->query("UPDATE chat SET status = '1' WHERE (userfrom_id ='" . $usertoid . "' AND userto_id ='" . $userfromid . "') OR (userto_id ='" . $usertoid . "' AND userfrom_id ='" . $userfromid . "')");




		if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {
			// $_POST['file'] = rand(0000, 9999) . "_" . $_FILES['file']['name'];
			// $filename = str_replace(' ', '_', $_POST['file']); // Replace spaces with underscores
			// $_POST['file'] = $filename;
			// // $config2['upload_path'] = getcwd().'/uploads/chat/';
			// $config2['upload_path'] = './uploads/chat/'.$userfromid.'/shared/';
			// $config2['allowed_types'] = 'jpg|jpeg|png|pdf';

			// // $config['allowed_types']        = 'gif|jpg|jpeg|png|pdf|doc|docx';
			// $config2['max_size'] = 6144; // 6MB, adjust as needed
			// $config2['file_name'] = $_POST['file'];
			// $this->upload->initialize($config2);
			// $this->load->library('upload', $config2);

			// if (!$this->upload->do_upload('file')) {
			// 	// Upload failed, handle the error
			// 	$error = $this->upload->display_errors();
			// 	echo $error;
			// 	exit;
			// } else {
			// 	// Upload successful, proceed with further processing
			// 	$image = $_POST['file'];

			// }
			$_POST['file'] = rand(0000, 9999) . "_" . $_FILES['file']['name'];
			$filename = str_replace(' ', '_', $_POST['file']); // Replace spaces with underscores
			$_POST['file'] = $filename;
			$upload_directory = './uploads/chat/' . $userfromid . '/shared/';
			// Check if the directory exists, if not, create it
			if (!is_dir($upload_directory)) {
				mkdir($upload_directory, 0777, true); // Create directory recursively
			}

			$config2['upload_path'] = $upload_directory;
			$config2['allowed_types'] = 'jpg|jpeg|png|pdf';
			$config2['max_size'] = 6144; // 6MB, adjust as needed
			$config2['file_name'] = $_POST['file'];
			$this->upload->initialize($config2);
			$this->load->library('upload', $config2);

			if (!$this->upload->do_upload('file')) {
				// Upload failed, handle the error
				$error = $this->upload->display_errors();
				echo $error;
				exit;
			} else {
				// Upload successful, proceed with further processing
				$image = $_POST['file'];
			}
		} else {
			$image = "";
		}


		//  echo $image;die;
		if (!empty($this->input->post('usertoid'))) {


			$data = array(
				'userfrom_id' => $userfromid,
				'userto_id' => $usertoid,
				'postjob_id' => $this->input->post('postid'),
				'message' => $this->input->post('message'),
				'attachment' => $image,
				'created_date' => date('Y-m-d H:i:s'),
			);
			$this->db->insert('chat', $data);
			$lastid = $this->db->insert_id();
			$con = "id='" . $lastid . "'";
			$getdata = $this->Users_model->getmessage($con);
			if (@$getdata->profilePic && file_exists('uploads/users/' . @$getdata->profilePic)) {
				$from_pic = '<img src="' . base_url('uploads/users/' . @$getdata->profilePic) . '" alt="" />';
			} else {
				$from_pic = '<img src="' . base_url('uploads/users/user.png') . '" alt="" />';
			}

			// if (@$getdata->attachment && file_exists('uploads/chat/' . @$getdata->attachment)) {



			// 	$chat_pic = '<iframe class="chat-iframe" src="' . base_url('uploads/chat/' . @$getdata->attachment) . '"></iframe>';

			// } else {
			// 	$chat_pic = ''; 
			// }


			if (@$getdata->attachment && file_exists('uploads/chat/'.$userfromid .'/shared/'. @$getdata->attachment)) {
				$chat_pic = '<iframe class="chat-iframe"  src="' . base_url('uploads/chat/'.$userfromid .'/shared/'. @$getdata->attachment) . '"></iframe>';
			} else {
				$chat_pic = '';
			}
			





			$data = array(
				'result' => 1,
				'userpic' => $from_pic,
				'chatpic' => $chat_pic,
			);

			// echo "<pre>";
			// print_r($data);die;
			echo json_encode($data);
			exit;
		}
	}
	///////////////////////////////////// end chat/////////////////////////////////
	function video_call()
	{
		$this->load->view('header');
		$this->load->view('user_dashboard/video_call');
		$this->load->view('footer');
	}

	public function save_event()
	{
		// $starttime=$_POST['starthours'].':'.$_POST['startminute'].' '.$_POST['starttype'];
		// $endtime=$_POST['endhours'].':'.$_POST['endminute'].' '.$_POST['endtype'];
		$data = array(
			'user_id' => $_SESSION['authorized']['userId'],
			'event_name' => $_POST['event_name'],
			'event_date' => date('Y-m-d', strtotime($_POST['event_date'])),
			'start_time' => date('H:i', strtotime($_POST['start_time'])),
			'end_time' => date('H:i', strtotime($_POST['end_time'])),
			'description' => $_POST['description'],
			'event_color' => $_POST['event_color'],
			'event_icon' => $_POST['event_icon'],
			'created_date' => date('Y-m-d H:i:s'),
		);
		$this->Crud_model->SaveData('appointment_scheduling', $data);
		$this->session->set_flashdata('message', 'Appointment Created Successfully !');
		redirect(base_url('calender'));
	}

	public function get_events()
	{
		$events = $this->db->query("select * from appointment_scheduling where user_id='" . $_SESSION['authorized']['userId'] . "'")->result();
		$data_events = array();

		foreach ($events as $r) {
			$data_events[] = array(
				"id" => $r->id,
				"title" => $r->event_name,
				"start" => date('Y-m-d', strtotime($r->event_date)),
				"description" => $r->description,
				"className" => $r->event_color,
				"icon" => $r->event_icon,
			);
		}
		echo json_encode($data_events);
		exit();
	}

	function change_password()
	{
		$this->load->view('header');
		$this->load->view('user_dashboard/change_password');
		$this->load->view('footer');
	}

	function update_password()
	{
		$get_user = $this->Crud_model->get_single('users', "userId='" . $_SESSION['authorized']['userId'] . "'");
		if ($get_user->password == md5($_POST['cur_password'])) {
			$data = array(
				'password' => md5($_POST['new_password']),
			);
			$this->Crud_model->SaveData('users', $data, "userId='" . $_SESSION['authorized']['userId'] . "'");
			$this->session->set_flashdata('message', 'Password Reset Successfully !');
			echo "1";
		} else {
			$this->session->set_flashdata('message', 'Something went wrong. Please try again later!');
			echo "0";
		}
	}

	////////////////////////////////// start rating /////////////////////////////////////
	function save_employer_rating()
	{
		if (!empty($this->input->post('rating'))) {
			$data = array(
				'employer_id' => $_SESSION['authorized']['userId'],
				'worker_id' => $_POST['user_id'],
				'rating' => $this->input->post('rating', TRUE),
				'subject' => $this->input->post('subject', TRUE),
				'review' => $this->input->post('review', TRUE),
				'created_date' => date('Y-m-d H:i:s'),
			);
			$this->Crud_model->SaveData('employer_rating', $data);
			$this->session->set_flashdata('message', 'Rating successfully');
		} else {
			$this->session->set_flashdata('message', 'Something went wrong. Please try again later!');
		}
		redirect(base_url('worker-detail/' . base64_encode($_POST['user_id'])));
	}
	////////////////////////////////// end rating /////////////////////////////////////

	//////////////////////////////// start education ///////////////////////////
	function education_list()
	{
		$data['education_list'] = $this->Crud_model->GetData('user_education', '', "user_id='" . $_SESSION['authorized']['userId'] . "' order by id DESC");
		$this->load->view('header');
		$this->load->view('user_dashboard/education/list', $data);
		$this->load->view('footer');
	}
	function add_education()
	{
		$get_education = $this->Crud_model->GetData('user_education', 'id,education', "");
		$get_passing = $this->Crud_model->GetData('user_education', 'id,passing_of_year', "");
		$get_college = $this->Crud_model->GetData('user_education', 'id,college_name', "");
		$get_department = $this->Crud_model->GetData('user_education', 'id,department', "");
		$data = array(
			'button' => 'submit',
			'action' => base_url('user/Dashboard/save_education'),
			'education' => set_value('education'),
			'passing_of_year' => set_value('passing_of_year'),
			'college_name' => set_value('college_name'),
			'department' => set_value('department'),
			'description' => set_value('description'),

			'id' => set_value('id'),
			'get_education' => $get_education,
			'get_passing' => $get_passing,
			'get_college' => $get_college,
			'get_department' => $get_department,
		);

		$this->load->view('header');
		$this->load->view('user_dashboard/education/form', $data);
		$this->load->view('footer');
	}

	public function save_education()
	{
		$data = array(
			'user_id' => $_SESSION['authorized']['userId'],
			'education' => $this->input->post('education', TRUE),
			'passing_of_year' => $this->input->post('passing_of_year', TRUE),
			'college_name' => $this->input->post('college_name', TRUE),
			'department' => $this->input->post('department', TRUE),
			'description' => $this->input->post('description', TRUE),

			'created_date' => date('Y-m-d H:i:s'),
		);
		$this->Crud_model->SaveData('user_education', $data);
		$this->session->set_flashdata('message', 'Education Created Successfully !');
		redirect(base_url('education-list'));
	}



	public function update_education($id)
	{
		$education_id = base64_decode($id);

		$update_education = $this->Crud_model->get_single('user_education', "id='" . $education_id . "'");
		$get_education = $this->Crud_model->GetData('user_education', 'id,education', "");
		$get_passing = $this->Crud_model->GetData('user_education', 'id,passing_of_year', "");
		$get_college = $this->Crud_model->GetData('user_education', 'id,college_name', "");
		$get_department = $this->Crud_model->GetData('user_education', 'id,department', "");
		$data = array(

			'button' => 'update',
			'action' => base_url('user/Dashboard/edit_education'),
			'education' => $update_education->education,
			'passing_of_year' => $update_education->passing_of_year,
			'college_name' => $update_education->college_name,
			'department' => $update_education->department,
			'description' => $update_education->description,
			'id' => $update_education->id,
			'get_education' => $get_education,
			'get_passing' => $get_passing,
			'get_college' => $get_college,
			'get_department' => $get_department,
		);

		$this->load->view('header');
		$this->load->view('user_dashboard/education/form', $data);
		$this->load->view('footer');
	}


	public function edit_education()
	{
		$id = $_POST['id'];
		$data = array(
			'education' => $this->input->post('education', TRUE),
			'passing_of_year' => $this->input->post('passing_of_year', TRUE),
			'college_name' => $this->input->post('college_name', TRUE),
			'department' => $this->input->post('department', TRUE),
			'description' => $this->input->post('description', TRUE),

		);
		$this->Crud_model->SaveData('user_education', $data, "id='" . $id . "'");
		$this->session->set_flashdata('message', 'Education Updated Successfully !');
		redirect(base_url('education-list'));
	}

	function delete_education()
	{
		$id = $this->input->post('id');
		$this->Crud_model->DeleteData('user_education', "id='" . $id . "'");
		$this->session->set_flashdata('message', 'Education Deleted successfully !');
		echo '1';
		//redirect(base_url('education-list'));
	}

	//////////////////////////////// end education ///////////////////////////


	///////////////// start work experience //////////////////////////

	function workexperience_list()
	{
		$data['workexperience_list'] = $this->Crud_model->GetData('user_workexperience', '', "user_id='" . $_SESSION['authorized']['userId'] . "' order by id DESC");
		$this->load->view('header');
		$this->load->view('user_dashboard/work_experience/list', $data);
		$this->load->view('footer');
	}

	function add_workexperience()
	{
		$get_designation = $this->Crud_model->GetData('user_workexperience', 'id,designation', "");
		$get_companyname = $this->Crud_model->GetData('user_workexperience', 'id,company_name', "");
		$get_duration = $this->Crud_model->GetData('user_workexperience', 'id,duration', "");

		$data = array(
			'button' => 'submit',
			'action' => base_url('user/Dashboard/save_workexperience'),
			'designation' => set_value('designation'),
			'company_name' => set_value('company_name'),
			//'duration' => set_value('duration'),
			'from_date' => set_value('from_date'),
			'to_date' => set_value('to_date'),
			'description' => set_value('description'),
			'id' => set_value('id'),
			'get_designation' => $get_designation,
			'get_companyname' => $get_companyname,
			'get_duration' => $get_duration,

		);

		$this->load->view('header');
		$this->load->view('user_dashboard/work_experience/form', $data);
		$this->load->view('footer');
	}

	public function save_workexperience()
	{
		$data = array(
			'user_id' => $_SESSION['authorized']['userId'],
			'designation' => $this->input->post('designation', TRUE),
			'company_name' => $this->input->post('company_name', TRUE),
			//'duration' => $this->input->post('duration', TRUE),
			'from_date' => $this->input->post('from_date', TRUE),
			'to_date' => $this->input->post('to_date', TRUE),
			'description' => $this->input->post('description', TRUE),
			'created_date' => date('Y-m-d H:i:s'),
		);
		$this->Crud_model->SaveData('user_workexperience', $data);
		$this->session->set_flashdata('message', 'Work Experience Created Successfully !');
		redirect(base_url('workexperience-list'));
	}

	public function update_workexperience($id)
	{
		$work_id = base64_decode($id);
		$update_data = $this->Crud_model->get_single('user_workexperience', "id='" . $work_id . "'");
		$get_designation = $this->Crud_model->GetData('user_workexperience', 'id,designation', "");
		$get_companyname = $this->Crud_model->GetData('user_workexperience', 'id,company_name', "");
		$get_duration = $this->Crud_model->GetData('user_workexperience', 'id,duration', "");
		$data = array(
			'button' => 'update',
			'action' => base_url('user/Dashboard/edit_workexperience'),
			'designation' => $update_data->designation,
			'company_name' => $update_data->company_name,
			//'duration' => $update_data->duration,
			'from_date' => $update_data->from_date,
			'to_date' => $update_data->to_date,
			'description' => $update_data->description,
			'id' => $update_data->id,
			'get_designation' => $get_designation,
			'get_companyname' => $get_companyname,
			'get_duration' => $get_duration,

		);
		$this->load->view('header');
		$this->load->view('user_dashboard/work_experience/form', $data);
		$this->load->view('footer');
	}


	public function edit_workexperience()
	{
		$id = $_POST['id'];
		$data = array(
			'designation' => $this->input->post('designation', TRUE),
			'company_name' => $this->input->post('company_name', TRUE),
			//'duration' => $this->input->post('duration', TRUE),
			'from_date' => $this->input->post('from_date', TRUE),
			'to_date' => $this->input->post('to_date', TRUE),
			'description' => $this->input->post('description', TRUE),
		);
		$this->Crud_model->SaveData('user_workexperience', $data, "id='" . $id . "'");
		$this->session->set_flashdata('message', 'Work experience updated successfully !');
		redirect(base_url('workexperience-list'));
	}

	function delete_workexperience()
	{
		$id = $this->input->post('id');
		$this->Crud_model->DeleteData('user_workexperience', "id='" . $id . "'");
		$this->session->set_flashdata('message', 'Work experience deleted successfully !');
		echo "1";
		// redirect(base_url('workexperience-list'));
	}

	///////////////// end work experience //////////////////////////

	///////////////// User Subscription //////////////////////////
	function userSubscription()
	{
		$paymentDate = date('Y-m-d H:i:s');
		$n = 24;
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomString = '';
		for ($i = 0; $i < $n; $i++) {
			$index = rand(0, strlen($characters) - 1);
			$randomString .= $characters[$index];
		}
		;
		$data = array(
			'employer_id' => $this->input->post('user_id'),
			'subscription_id' => $this->input->post('sub_id'),
			'name_of_card' => $this->input->post('sub_name'),
			'email' => $this->input->post('user_email'),
			'amount' => $this->input->post('sub_price'),
			'duration' => $this->input->post('sub_duration'),
			'transaction_id' => "sub_" . $randomString,
			'payment_date' => $paymentDate,
			'created_date' => $paymentDate,
			'duration' => $this->input->post('sub_duration'),
			'payment_status' => 'paid',
			'expiry_date' => date("Y-m-d", strtotime('+' . $this->input->post('sub_duration') . 'days'))
		);
		//print_r($data); die();
		$this->Crud_model->SaveData('employer_subscription', $data);
		$insert_id = $this->db->insert_id();
		if (!empty($insert_id)) {
			echo '1';
		} else {
			echo '2';
		}
	}

	function cancelSubscription()
	{
		$id = $this->input->post('id');
		$sub_id = $this->input->post('sub_id');
		$amount = $this->input->post('amount');
		if ($amount < '1') {
			$subStatus = $this->db->query("UPDATE employer_subscription SET status = '2' WHERE `id` ='" . $id . "'");
			if ($subStatus) {
				echo '1';
			} else {
				echo '2';
			}
		} else {
			require 'vendor/autoload.php';
			require_once APPPATH . "third_party/stripe/init.php";
			$stripe = new \Stripe\StripeClient('sk_test_835fqzvcLuirPvH0KqHeQz9K');
			$cnclsubData = $stripe->subscriptions->cancel("$sub_id", []);
			if ($cnclsubData['status'] == 'canceled') {
				$subStatus = $this->db->query("UPDATE employer_subscription SET status = '2' WHERE `id` ='" . $id . "'");
				if ($subStatus) {
					echo '1';
				} else {
					echo '2';
				}
			}
		}
	}

	function checkSubscriptionForUser()
	{
		//echo "SELECT * FROM employer_subscription WHERE status = '1'"; echo "<br>";
		$getAllSubscription = $this->db->query("SELECT * FROM employer_subscription WHERE status = '1'")->result_array();
		foreach ($getAllSubscription as $value) {
			$sub_id = $value['transaction_id'];
			$now_date = date('Y-m-d');
			$expiry_date = date('Y-m-d', strtotime($value['expiry_date']));
			$amount = $value['amount'];

			if ($expire_date > $now_date) {
				if ($amount < '1') {
					$subStatus = $this->db->query("UPDATE employer_subscription SET status = '3' where status = '1'");
					if ($subStatus) {
						echo '1';
					} else {
						echo '2';
					}
				} else {
					require 'vendor/autoload.php';
					require_once APPPATH . "third_party/stripe/init.php";
					$stripe = new \Stripe\StripeClient('sk_test_835fqzvcLuirPvH0KqHeQz9K');
					$cnclsubData = $stripe->subscriptions->cancel("$sub_id", []);
					if ($cnclsubData['status'] == 'canceled') {
						$subStatus = $this->db->query("UPDATE employer_subscription SET status = '3' where status = '1'");
						if ($subStatus) {
							echo '1';
						} else {
							echo '2';
						}
					}
				}
			}
		}
	}
	///////////////// End User Subscription //////////////////////////

	///////////////// User Product //////////////////////////

	function add_product()
	{
		//print_r($this->input->post()); die;
		if (!empty($this->input->post())) {
			$data = array(
				'user_id' => $_SESSION['authorized']['userId'],
				'prod_name' => $this->input->post('prod_name'),
				'prod_description' => $this->input->post('prod_description'),
				'created_date' => date("Y-m-d H:i:s"),
			);
			$this->Crud_model->SaveData('user_product', $data);
			$insert_id = $this->db->insert_id();
			if (!empty($insert_id)) {
				if ($_FILES['prod_image']['name'] != '') {
					$cpt = count($_FILES['prod_image']['name']);
					for ($i = 0; $i < $cpt; $i++) {
						$_POST['prod_image'] = rand(0000, 9999) . "_" . $_FILES['prod_image']['name'][$i];
						$config2['image_library'] = 'gd2';
						$config2['source_image'] = $_FILES['prod_image']['tmp_name'][$i];
						$config2['new_image'] = getcwd() . '/uploads/products/' . $_POST['prod_image'];
						$config2['upload_path'] = getcwd() . '/uploads/products/';
						$config2['allowed_types'] = 'JPG|PNG|JPEG|jpg|png|jpeg';
						$config2['maintain_ratio'] = FALSE;
						$this->image_lib->initialize($config2);
						//$this->load->library('image_lib', $config2);
						if (!$this->image_lib->resize()) {
							echo ('<pre>');
							echo ($this->image_lib->display_errors());
							exit;
						} else {
							$image = $_POST['prod_image'];
							@unlink('uploads/products/' . $_POST['old_image']);
						}
						$data_image = array(
							'prod_id' => $insert_id,
							'prod_image' => $image,
							'created_date' => date("Y-m-d H:i:s"),
						);
						$this->Crud_model->SaveData('user_product_image', $data_image);
						$this->session->set_flashdata('message', 'Product Created Successfully !');
					}
				}
			}
			redirect(base_url('profile/product'));
		}
		$this->load->view('header');
		$this->load->view('user_dashboard/product/form', $data);
		$this->load->view('footer');
	}

	public function update_product($id)
	{
		$product_id = base64_decode($id);
		$update_product = $this->Crud_model->get_single('user_product', "id='" . $product_id . "'");
		$data = array(
			'button' => 'update',
			'action' => base_url('user/Dashboard/edit_product'),
			'product' => $update_product->prod_name,
			'description' => $update_product->prod_description,
			'id' => $update_product->id,
		);
		$this->load->view('header');
		$this->load->view('user_dashboard/product/form', $data);
		$this->load->view('footer');
	}

	public function recommended_employee() {
		$data['jobTitleByemployer'] = $this->db->query("SELECT id, post_title, required_key_skills FROM postjob WHERE user_id = '".@$_SESSION['afrebay']['userId']."'")->result_array();
		//$data['jobListByemployer'] = $this->db->query("SELECT * FROM users WHERE userType = '1'")->result_array();
		$data['jobListByemployer'] = $this->db->query("SELECT * FROM job_bid WHERE bidding_status = 'Ready for Interview'")->result_array();
		$this->load->view('header');
		$this->load->view('user_dashboard/recommended_employee', $data);
		$this->load->view('footer');
	}

	public function edit_product()
	{
		$id = $_POST['id'];
		$data = array(
			'prod_name' => $this->input->post('prod_name', TRUE),
			'prod_description' => $this->input->post('prod_description', TRUE),
		);
		$updateQuery = $this->Crud_model->SaveData('user_product', $data, "id='" . $id . "'");
		if (!empty($_FILES['prod_image']['name'][0])) {
			$cpt = count($_FILES['prod_image']['name']);
			for ($i = 0; $i < $cpt; $i++) {
				$_POST['prod_image'] = rand(0000, 9999) . "_" . $_FILES['prod_image']['name'][$i];
				$config2['image_library'] = 'gd2';
				$config2['source_image'] = $_FILES['prod_image']['tmp_name'][$i];
				$config2['new_image'] = getcwd() . '/uploads/products/' . $_POST['prod_image'];
				$config2['upload_path'] = getcwd() . '/uploads/products/';
				$config2['allowed_types'] = 'JPG|PNG|JPEG|jpg|png|jpeg';
				$config2['maintain_ratio'] = FALSE;
				$this->image_lib->initialize($config2);
				//$this->load->library('image_lib', $config2);
				if (!$this->image_lib->resize()) {
					echo ('<pre>');
					echo ($this->image_lib->display_errors());
					exit;
				} else {
					$image = $_POST['prod_image'];
					@unlink('uploads/products/' . $_POST['old_image']);
				}
				$data_image = array(
					'prod_id' => $_POST['id'],
					'prod_image' => $image,
					'created_date' => date("Y-m-d H:i:s"),
				);
				$this->Crud_model->SaveData('user_product_image', $data_image);
			}
		}
		$this->session->set_flashdata('message', 'Product Updated Successfully !');
		redirect(base_url('profile/product'));
	}

	function delete_product()
	{
		$p_id = $this->input->post('id');
		$delete_prod = $this->db->query("UPDATE user_product SET is_delete = '2' WHERE id = '$p_id'");
		if ($delete_prod > 0) {
			echo '1';
		} else {
			echo '2';
		}
	}

	function delete_job()
	{
		$p_id = $this->input->post('id');
		$delete_prod = $this->db->query("DELETE FROM postjob WHERE id = '$p_id'");
		if ($delete_prod > 0) {
			echo '1';
		} else {
			echo '2';
		}
	}

	function delete_product_image()
	{
		$p_id = $this->input->post('id');
		$delete_prod = $this->db->query("DELETE FROM user_product_image WHERE id = '$p_id'");
	}

	function availability() {
		$this->load->view('header');
		$this->load->view('user_dashboard/calender');
		$this->load->view('footer');
	}


	public function create_availability() {
		$user_id = $_POST['user_id'];
		$start_date = explode(",", $_POST['start_date']);
		$from_time = explode(",", $_POST['from_time']);
		$end_date = explode(",", $_POST['end_date']);
		$to_time = explode(",", $_POST['to_time']);
		$result = count($start_date);
		for($i=0; $i<$result; $i++) {
			$data = array(
				'user_id' => $user_id,
				'start_date' => $start_date[$i],
				'from_time' => $from_time[$i],
				'end_date' => $end_date[$i],
				'to_time' => $to_time[$i],
			);
			$this->Crud_model->SaveData('user_availability', $data);
		}
		echo "1";
	}


	public function edit_availability() {
		$avail_id = $_POST['avail_id'];
		$checkBookSlot = $this->db->query("SELECT user_availability.*, user_booking.* FROM user_booking JOIN user_availability ON user_availability.id = user_booking.available_id WHERE user_booking.available_id = '".$avail_id."'")->result_array();
		if(!empty($checkBookSlot)) {
			echo '1';
		} else {
			$getAvailableData = $this->db->query("SELECT * FROM user_availability WHERE id='".$_POST['avail_id']."'")->result_array();
			echo json_encode($getAvailableData);
			//echo '2';
		}
	}

	public function update_availability() {
		//echo "<pre>"; print_r($_POST); die();
		$user_id = $_POST['user_id'];
		$avail_id = $_POST['avail_id'];
		$start_date = $_POST['start_date'];
		$from_time = $_POST['from_time'];
		$end_date = $_POST['end_date'];
		$to_time = $_POST['to_time'];
		$data = array(
			'user_id' => $user_id,
			'start_date' => $start_date,
			'from_time' => $from_time,
			'end_date' => $end_date,
			'to_time' => $to_time,
		);
		//$this->Crud_model->SaveData('user_availability', $data);
		$this->Crud_model->SaveData('user_availability', $data, "id='".$avail_id."'");
		echo "1";
	}


	public function delete_availability() {
		//echo "<pre>"; print_r($_POST); die();
		$avail_id = $_POST['avail_id'];
		$checkBookSlot = $this->db->query("SELECT user_availability.*, user_booking.* FROM user_booking JOIN user_availability ON user_availability.id = user_booking.available_id WHERE user_booking.available_id = '".$avail_id."'")->result_array();
		if(!empty($checkBookSlot)) {
			echo '1';
		} else {
			$this->Crud_model->DeleteData('user_availability', "id='".$_POST['avail_id']."'");
			echo '2';
		}
	}


	public function getUserAvailability() {
		//print_r($this->input->post()); die();
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$user_id = $this->input->post('userID');
		//echo "SELECT user_availability.start_date, user_availability.from_time, user_availability.end_date, user_availability.to_time, user_booking.employee_id, user_booking.employer_id, user_booking.available_id, user_booking.bookingTime FROM user_booking RIGHT JOIN user_availability ON user_availability.id = user_booking.available_id where user_availability.user_id = '".$user_id."' AND user_availability.start_date = '".$start_date."' AND user_availability.end_date = '".$end_date."'"; die();
		$getTime = $this->db->query("SELECT user_availability.id, user_availability.start_date, user_availability.from_time, user_availability.end_date, user_availability.to_time, user_booking.employee_id, user_booking.employer_id, user_booking.available_id, user_booking.bookingTime FROM user_booking RIGHT JOIN user_availability ON user_availability.id = user_booking.available_id where user_availability.user_id = '".$user_id."' AND user_availability.start_date = '".$start_date."' AND user_availability.end_date = '".$end_date."'")->result_array();
		// echo $this->db->last_query();die;
		echo json_encode($getTime);
	}

	public function paymentforslotbook() {
		$avail_id = $this->input->post('avail_id');
		$employeeID = $this->input->post('employeeID');
		$employerID = $this->input->post('employerID');
		$rate = $this->input->post('rate');
		$getBookinID = $this->db->query("SELECT * FROM user_booking WHERE available_id = '".$avail_id."' AND employee_id = '".$employeeID."' AND employer_id = '".$employerID."'")->result_array();
		$length = 24;
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[random_int(0, $charactersLength - 1)];
	    }
	    $txn = "txn_".$randomString;
		$data = array(
			'booking_id'=> $getBookinID[0]['id'],
			'rate'=> $rate,
			'txn_id'=> $txn,
		);
		$this->Crud_model->SaveData('user_booking_txn', $data);
		// create miting link
		$getavailDate = $this->db->query("SELECT * FROM user_availability WHERE id = '" . $avail_id . "'")->row();
		$getbiduser = $this->db->query("SELECT * FROM users WHERE userId = '" . $employeeID . "'")->row();
		$getbidemail = $getbiduser->email;
		$getbidname = $getbiduser->firstname. ' '.$getbiduser->lastname;
		$getpostuser = $this->db->query("SELECT * FROM users WHERE userId = '" . $employerID . "'")->row();
		$getpostemail = $getpostuser->email;
		$getpostname = $getpostuser->companyname;

		$bookingTime = $getBookinID[0]['bookingTime'];
		$bt = explode(",", $bookingTime);

		$meetingLink = array();
		$meetingPass = array();
		for ($i=0; $i<count($bt); $i++){
			$postData = [
				"topic" => 'Meeting Link1',
				"type" => 2,
				"start_time" => $getavailDate->start_date.'T'.$bt[$i].':00Z',
				"duration" => 30,
				"settings" => [
					"waiting_room" => false,
					"host_video" => true,
					"participant_video" => true,
					"join_before_host" => true,
					"mute_upon_entry" => true,
					"watermark" => true,
					"audio" => "voip",
					"auto_recording" => "cloud",
					"allow_multiple_devices" => true,
					"registration_type" => 2,
				]
			];
			$curl = curl_init();
			curl_setopt_array($curl,
				array(
					CURLOPT_URL => 'https://api.zoom.us/v2/users/me/meetings',
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => '',
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 0,
					CURLOPT_FOLLOWLOCATION => true,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => 'POST',
					CURLOPT_POSTFIELDS => json_encode($postData),
				    // CURLOPT_HTTPHEADER => array(
					//     'Content-Type: application/json',
					//     'Authorization: Bearer eyJzdiI6IjAwMDAwMSIsImFsZyI6IkhTNTEyIiwidiI6IjIuMCIsImtpZCI6Ijg1YjA2MTFhLThiYWUtNGU3ZS1hYjliLTk1YjQ1ZTllYzc1ZiJ9.eyJ2ZXIiOjksImF1aWQiOiI1ZDM5MzViODBjNzEwY2ZlZmQ4ZDhjZWExZDgzNWY0ZiIsImNvZGUiOiI4V3c1eThHcnR3R2dFQ0tLdThyUmNHZWI5WDN4VTZsSkEiLCJpc3MiOiJ6bTpjaWQ6M1BzQlk1ZFNRb09WWnR5Yl85V0k4dyIsImdubyI6MCwidHlwZSI6MCwidGlkIjoxNywiYXVkIjoiaHR0cHM6Ly9vYXV0aC56b29tLnVzIiwidWlkIjoiODBDMmloZTJUVy1sbWpvTU9nQm5GUSIsIm5iZiI6MTcxMjA2NDU1NiwiZXhwIjoxNzEyMDY4MTU2LCJpYXQiOjE3MTIwNjQ1NTYsImFpZCI6IjczSC1MbDlEU3NlRFdGNmRnVWVUOUEifQ.Z0vdAj3WFho9CAs5UhIHPgsGTGrVOXFUnkpB0XRLNT8dHlgk0h39MxoYUwfPzDobG-jBGVSgyI5xwLN2-4al6Q',
					//     'Cookie: __cf_bm=dogY7BT95jHsoHT2r3.AlHOXDR7MDnd8w5WCiYoherQ-1712064556-1.0.1.1-xcx0BiDwSDGTfYjY8n3lTmp1tBguTSDXQpJTG5E17nbmd__EtzwusNhO4bq3QpR5Y1kv2EaV0C6iXAQ_xSqBXw; _zm_chtaid=664; _zm_ctaid=boFLjf8VQGeGsNtECKRBrA.1712064556426.598e820caa06968b6f841139d2e9b782; _zm_mtk_guid=c133062e5fbc412eace34da570f36f5b; _zm_page_auth=us04_c_yWiphD5kR5e4JIRJo0dSCw; _zm_ssid=us04_c_DS96iBNNTzK788Q-9Ct5HQ; _zm_visitor_guid=c133062e5fbc412eace34da570f36f5b'
				  	// )
					  CURLOPT_HTTPHEADER => array(
						'Content-Type: application/json',
						'Authorization: Bearer eyJzdiI6IjAwMDAwMSIsImFsZyI6IkhTNTEyIiwidiI6IjIuMCIsImtpZCI6IjRiZjE3YTZiLThmMzMtNDc0Ni04MDM5LTc1YWNiODVkNzEzZSJ9.eyJ2ZXIiOjksImF1aWQiOiI1ZDM5MzViODBjNzEwY2ZlZmQ4ZDhjZWExZDgzNWY0ZiIsImNvZGUiOiI4V3c1eThHcnR3R2dFQ0tLdThyUmNHZWI5WDN4VTZsSkEiLCJpc3MiOiJ6bTpjaWQ6M1BzQlk1ZFNRb09WWnR5Yl85V0k4dyIsImdubyI6MCwidHlwZSI6MCwidGlkIjozNiwiYXVkIjoiaHR0cHM6Ly9vYXV0aC56b29tLnVzIiwidWlkIjoiODBDMmloZTJUVy1sbWpvTU9nQm5GUSIsIm5iZiI6MTcxMjgyNjk3NCwiZXhwIjoxNzEyODMwNTc0LCJpYXQiOjE3MTI4MjY5NzQsImFpZCI6IjczSC1MbDlEU3NlRFdGNmRnVWVUOUEifQ.jZjhlkH6XR0CiA53S7jRZ2C9GI2cP3xBvUJHaCNwOrdJxWMn764dDBaJdkhKZ7dd_rnrWhEahIeaGZPx-0Nnjw',
						'Cookie: __cf_bm=d4Zs_a8rVAVMds0.PTY4ln6.WoThpzu3Pt5i800v1SI-1712826974-1.0.1.1-tBGXXBg8etmJJ6MjZe_ePwFsicIm0Tot63ggm_HGCvdZBF6BGFQynMQZaPF7dkKa.44NKIb4VKT5fSn7bsso4g; _zm_chtaid=457; _zm_ctaid=Zty_iuI8SuKtIzCxrmr9VQ.1712826974338.6a602a05561973ee432bb7fd3cee55e0; _zm_mtk_guid=c133062e5fbc412eace34da570f36f5b; _zm_page_auth=us04_c_6OAKYhJIS3mPYgzNCsL9kQ; _zm_ssid=us04_c_AWVnLHhKQ-yUv5lE6lP3lA; _zm_visitor_guid=c133062e5fbc412eace34da570f36f5b'
					  )
				)
			);
			$response = curl_exec($curl);
			curl_close($curl);
			$decodedData = json_decode($response, true);
			//$meetingLink[$i]= $decodedData['join_url'];
			$joinUrl = "https://us04web.zoom.us/j/".$decodedData['id'];
			$meetingLink[$i]= $joinUrl;
			$meetingpass[$i]= $decodedData['password'];
			if(!empty($decodedData['join_url'])) {
				$this->db->query("UPDATE user_booking SET meeting_link = '".$joinUrl."', meeting_pass = '".$meetingpass."' WHERE id = '".$getBookinID[0]['id']."'");
				$get_setting=$this->Crud_model->get_single('setting');
				$htmlContent = "
				<div style='width:600px; margin: 0 auto;background: #fff;border: 1px solid #e6e6e6;'>
					<div style='padding: 30px 30px 15px 30px;box-sizing: border-box;'>
					<img src='cid:Logo' style='width:100px;float: right;margin-top: 0 auto;'>
					<h3 style='padding-top:40px; line-height: 30px;'>Greetings from<span style='font-weight: 900;font-size: 35px;color: #F44C0D; display: block;'>PayPer LLC</span></h3>
					<p style='font-size:24px;'>Hello User,</p>
					<p style='font-size:24px;'>Please find the below meeting info for $getpostname->post_title</p>
					<p style='font-size:24px;'>Just press the button below and follow the instructions.</p>
					<p style='text-align: center;'><a href='".$joinUrl."' style='height: 50px; width: 300px; background: rgb(253,179,2); background: linear-gradient(0deg, rgba(253,179,2,1) 0%, rgba(244,77,9,1) 100%); text-align: center; font-size: 18px; color: #fff; border-radius: 12px; display: inline-block; line-height: 50px; text-decoration: none; text-transform: uppercase; font-weight: 600;'>Meeting Link</a></p>
					<p style='font-size:24px;'>Meeting Passcode: ".$decodedData['password']."</p>
					<p style='font-size:20px;'>Thank you!</p>
					<p style='font-size:20px;list-style: none;'>Sincerly</p>
					<p style='list-style: none;'><b>PayPer LLC</b></p>
					<p style='list-style:none;'><b>Visit us:</b> <span>$get_setting->address</span></p>
					<p style='list-style:none'><b>Email us:</b> <span>$get_setting->email</span></p>
					</div>
					<table style='width: 100%;'>
						<tr>
							<td style='height:30px;width:100%; background: red;padding: 10px 0px; font-size:13px; color: #fff; text-align: center;'>Copyright &copy; <?=date('Y')?> Pay Per Dialog. All rights reserved.</td>
						</tr>
					</table>
				</div>";
				// require 'vendor/autoload.php';
				// $mail = new PHPMailer(true);
				// try {
				// 	//Server settings
				// 	$mail->CharSet = 'UTF-8';
				// 	$mail->SetFrom('info@payperdialog.com', 'Pay Per Dialog');
				// 	$mail->AddAddress($getbidemail, $getbidname);
				// 	$mail->AddAddress($getpostemail, $getpostemail);
				// 	$mail->IsHTML(true);
				// 	$mail->Subject = "Meeting Link from Pay Per Dialog";
				// 	$mail->AddEmbeddedImage('uploads/logo/'.$get_setting->flogo, 'Logo');
				// 	$mail->Body = $htmlContent;
				// 	//Send email via SMTP
				// 	$mail->IsSMTP();
				// 	$mail->SMTPAuth = true;
				// 	$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
				// 	$mail->Host = "smtp.hostinger.com";
				// 	$mail->Port = 587; //587 465
				// 	$mail->Username = "info@payperdialog.com";
				// 	$mail->Password = "PayperLLC@2024";
				// 	$mail->send();
				// } catch (Exception $e) {
				// }
			}
		}
		$meetingLink = implode(',', $meetingLink);
		$meetingpass = implode(',', $meetingpass);
		$this->db->query("UPDATE user_booking SET meeting_link = '".$meetingLink."', meeting_pass = '".$meetingpass."' WHERE id = '".$getBookinID[0]['id']."'");
		echo "1";
	}


	public function addBookingTimeData() {
		//echo "<pre>"; print_r($_POST); die();
		$avail_id = $this->input->post('avail_id');
		$start_date = $this->input->post('startDate');
		$employeeID = $this->input->post('employeeID');
		$employerID = $this->input->post('employerID');
		$book_time = $this->input->post('bookTime');
		$getuser_booking = $this->db->query("SELECT * FROM user_booking WHERE available_id = '".$avail_id."' AND employee_id = '".$employeeID."' AND employer_id = '".$employerID."'")->result_array();
		if(!empty($getuser_booking)) {
			//$this->Crud_model->DeleteData('user_booking', "available_id='".$avail_id."'");
			$data = array(
				'employee_id' => $employeeID,
				'employer_id' => $employerID,
				'available_id' => $avail_id,
				'bookingTime' => $book_time,
			);
			$this->Crud_model->SaveData('user_booking', $data, "id='".$getuser_booking[0]['id']."'");
		} else {
			$data = array(
				'employee_id' => $employeeID,
				'employer_id' => $employerID,
				'available_id' => $avail_id,
				'bookingTime' => $book_time,
			);
			$this->Crud_model->SaveData('user_booking', $data);
		}
		echo "1";
	}

}
