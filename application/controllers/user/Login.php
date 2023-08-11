<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Mymodel');
	}

	public function reg() {
	 	$validate=$this->Crud_model->get_single('users',"email='".$_POST['email']."'");
		if(!empty($validate)) {
			$data=array('result'=>0,'data'=>'email');
		}

		if(empty($validate)) {
			$data=array(
				'userType' => $_POST['userType'],
				'userSubtype' => $_POST['userSubtype'],
				'firstname' => $_POST['firstname'],
				'lastname' => $_POST['lastname'],
				'email' => $_POST['email'],
				'password' => md5($_POST['password']),
				'created'=> date('Y-m-d H:i:s'),
				'status'=> 0
			);
			$fullname = $_POST['firstname']." ".$_POST['lastname'];
			$result = $this->Mymodel->insert('users',$data);
			$insert_id = $this->db->insert_id();
			$get_setting=$this->Crud_model->get_single('setting');
			if(!empty($insert_id)) {
				$message = "<body><div style='width:600px;margin: 0 auto;background: #fff;font-family: 'Poppins', sans-serif; border: 1px solid #e6e6e6;'><div style='padding: 30px 30px 15px 30px;box-sizing: border-box;'><img src='cid:Logo' style='width:100px;float: right;margin-top: 0 auto;'><h3 style='padding-top:0; line-height: 25px;'>Greetings from<span style='font-weight: 900;font-size: 20px;color: #33369b; display: block;'>Authorized By Me</span></h3><p style='font-size: 15px;margin: 0 0 8px;'>Hello '".$fullname."',</p><p style='font-size: 15px;margin: 0 0 8px;'>Thank you for registration on Authorized By Me.</p><p style='font-size: 15px;margin: 0 0 8px;'>Please click the button below to verify your email address.</p><p style='text-align: center;'><a href='".base_url() . "email-verification/" . urlencode(base64_encode($insert_id))."' style='height: 50px;width: 180px;background: rgb(46 49 146);background: linear-gradient(0deg, rgb(86 91 225) 0%, rgb(46 49 146) 100%);text-align: center;font-size: 18px;color: #fff;border-radius: 12px;display: inline-block;line-height: 50px;text-decoration: none;text-transform: uppercase;font-weight: 600'>ACTIVATE</a></p><p style='font-size: 15px;margin: 0;'>Thank you!</p><p style='font-size: 15px;margin: 0;list-style: none;'>Sincerly</p><p style='list-style: none;margin: 0 0 15px;'><b>Authorized By Me</b></p><p style='list-style: none;margin: 0 0 15px;'><b>Visit us:</b> <span>$get_setting->address</span></p><p style='list-style: none;margin: 0 0 15px;'><b>Email us:</b> <span>$get_setting->email</span></p></div><table style='width: 100%;'><tr><td style='height:30px;width:100%; background: #33369b;padding: 10px 0px; font-size:13px; color: #fff; text-align: center;'>Copyright &copy; <?=date('Y')?> Authorized By Me. All rights reserved.</td></tr></table></div></body>";
				require 'vendor/autoload.php';
				$mail = new PHPMailer(true);
				try {
					//Server settings
					$mail->CharSet = 'UTF-8';
					$mail->SetFrom('no-reply@goigi.com', 'Authorized By Me');
					$mail->AddAddress($_POST['email']);
					$mail->IsHTML(true);
					$mail->Subject = 'Verify Your Email Address From Authorized By Me';
					$mail->AddEmbeddedImage('uploads/logo/'.$get_setting->flogo, 'Logo');
					$mail->Body = $message;
					//Send email via SMTP
					$mail->IsSMTP();
					$mail->SMTPAuth   = true;
					$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
					$mail->Host       = "smtp.gmail.com";
					$mail->Port       = 587; //587 465
					$mail->Username   = "no-reply@goigi.com";
					$mail->Password   = "wj8jeml3eu0z";
					$mail->send();
				} catch (Exception $e) {
					echo $e->getMessage(); //Boring error messages from anything else!
				}
				$data=array('result'=>1,'data'=>1);
			} else {
				$data=array('result'=>2,'data'=>2);
			}
		}
		echo json_encode($data); exit;
    }

    public function emailVerification($otp=null) {
		if(empty($otp)) {
			$this->session->set_flashdata('message', 'You have not permission to access this page!');
			redirect(base_url('register'), 'refresh');
		}
        $givenotp = base64_decode(urldecode($otp));
        $sql = "SELECT * FROM `users` WHERE userId = '".$givenotp."' AND status = '0' AND `email_verified` = '0'";
        $check = $this->db->query($sql)->num_rows();
        $data = array(
            'title' => 'Account Activation',
        );
        if ($check > 0) {
            $usr = $this->db->query($sql)->row();
            $result = $this->db->query("UPDATE `users` SET `email_verified` = 1, `status` = 1 where `userId` = $usr->userId");
            if ($result) {
                $this->session->set_flashdata('message', 'Your Email Address is verified successfully and your account is active. Please login.');
				redirect(base_url(), 'refresh');
            } else {
                $this->session->set_flashdata('message', 'Sorry! There is error verifying your Email Address!');
                redirect(base_url(), 'refresh');
            }
        } else {
            //$this->session->set_flashdata('message', 'Sorry! Activation link is expired!');
            $this->session->set_flashdata('message', 'Your Email Address is already verified. Please login.');
            redirect(base_url(), 'refresh');
        }
    }

	public function validate_user($pId = null) {
		$email = $this->input->post("login_email");
		$password = $this->input->post("login_password"); 
		if($this->Mymodel->check_record($email, $password)) {
			if(!empty($_SESSION['authorized']['userId'])) {
				$this->session->set_flashdata('message', 'Logged in successfully !');
				$check_sub = $this->Crud_model->GetData('employer_subscription', '', "employer_id='".$_SESSION['authorized']['userId']."' AND status IN (1,2)");
				if(empty($check_sub)) {
					redirect('profile/subscription');
				} else {
					$profile_check = $this->db->query("SELECT `firstname`, `lastname`, `email`, `address`, `zipcode`, `short_bio` FROM `users` WHERE userId = '".@$_SESSION['authorized']['userId']."'")->result_array();
					if(empty($profile_check[0]['firstname']) || empty($profile_check[0]['lastname']) || empty($profile_check[0]['email']) || empty($profile_check[0]['address']) || empty($profile_check[0]['zipcode']) || empty($profile_check[0]['short_bio'])) {
						redirect('profile/dashboard');
					} else {
						redirect('profile/jobbid');
					}
				}
			} else {
				redirect();
			}
		} else {
			$this->session->set_flashdata('message', 'Invalid email address or password !');
			redirect();
		}
	}

	public function logout() {
	    unset($_SESSION['authorized']);
		$this->session->set_flashdata('message', 'You have logged out.');
		redirect();
	}

    function forgot_password() {
   	   	$this->load->view('header');
		$this->load->view('forgot_password');
		$this->load->view('footer');
   	}

	function send_forget_password() {
    	if(!empty($this->input->post('email',TRUE))) {
     		$get_email = $this->Crud_model->get_single('users',"email='".$_POST['email']."'");
         	if(!empty($get_email)) {
             	$data=array(
					'email'=>$get_email->email
				);
				$get_setting=$this->Crud_model->get_single('setting');
				//$htmlContent = $this->load->view('email_template/forgot_password',$data,TRUE);
				$htmlContent = "<body><div style='width:600px;margin: 0 auto;background: #fff;font-family: 'Poppins', sans-serif; border: 1px solid #e6e6e6;'><div style='padding: 30px 30px 15px 30px;box-sizing: border-box;'><img src='cid:Logo' style='width:100px;float: right;margin-top: 0 auto;'><h3 style='padding-top:40px; line-height: 30px;'>Greetings from<span style='font-weight: 900;font-size: 35px;color: #F44C0D; display: block;'>Afrebay</span></h3><p style='font-size:24px;'>Hello User,</p><p style='font-size:24px;'>Trouble signing in? Resetting your password is easy.</p><p style='font-size:24px;'>Just press the button below and follow the instructions.</p><p style='text-align: center;'><a href='".base_url('new-password/'.base64_encode($get_email->email))."' style='height: 50px; width: 300px; background: rgb(253,179,2); background: linear-gradient(0deg, rgba(253,179,2,1) 0%, rgba(244,77,9,1) 100%); text-align: center; font-size: 18px; color: #fff; border-radius: 12px; display: inline-block; line-height: 50px; text-decoration: none; text-transform: uppercase; font-weight: 600;'>CLICK HERE TO RESET</a></p><p style='font-size:20px;'>Thank you!</p><p style='font-size:20px;list-style: none;'>Sincerly</p><p style='list-style: none;'><b>Afrebay</b></p><p style='list-style:none;'><b>Visit us:</b> <span>@$get_setting->address</span></p><p style='list-style:none'><b>Email us:</b> <span>@$get_setting->email</span></p></div><table style='width: 100%;'><tr><td style='height:30px;width:100%; background: red;padding: 10px 0px; font-size:13px; color: #fff; text-align: center;'>Copyright &copy; <?=date('Y')?> Afrebay. All rights reserved.</td></tr></table></div></body>";
				require 'vendor/autoload.php';
				$mail = new PHPMailer(true);
				try {
					//Server settings
					$mail->CharSet = 'UTF-8';
					$mail->SetFrom('no-reply@goigi.com', 'Afrebay');
					$mail->AddAddress($_POST['email']);
					$mail->IsHTML(true);
					$mail->Subject = "Forgot Password Confirmation message from AFREBAY";
					$mail->AddEmbeddedImage('uploads/logo/'.$get_setting->flogo, 'Logo');
					$mail->Body = $htmlContent;
					//Send email via SMTP
					$mail->IsSMTP();
					$mail->SMTPAuth   = true;
					$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
					$mail->Host       = "smtp.gmail.com";
					$mail->Port       = 587; //587 465
					$mail->Username   = "no-reply@goigi.com";
					$mail->Password   = "wj8jeml3eu0z";
					$mail->send();
					//echo $msg = '1';
					$this->session->set_flashdata('message', 'Please check your inbox. We have sent you an email to reset your password.');
				} catch (Exception $e) {
					//echo $msg = '2';
					$this->session->set_flashdata('message', 'Something went wrong. Please try again later!');
				}
         	} else {
   				//echo $msg = '3';
				$this->session->set_flashdata('error', 'invalid Email Id!');
   			}
			redirect(base_url('forgot-password'));
		}
	}

	function new_password() {
	    $data['title']='Forget Password';
		$this->load->view('header',$data);
		$this->load->view('new_password');
		$this->load->view('footer');
	}

	public function setnew_password() {
		if($this->input->post('email',TRUE)){
		 	$get_email = $this->Crud_model->GetData('users','',"email='".$_POST['email']."'",'','','','1');
			if(!empty($get_email)) {
				$data = array('password' =>md5($_POST['password']));
			 	$con="userId='".$get_email->userId."'";
			 	$this->Crud_model->SaveData('users',$data, $con);
			 	$this->session->set_flashdata('message', 'You have reset your password successfully. Please try to login.');
	           	echo "1";
            } else {
            	$this->session->set_flashdata('message', 'Something went wrong. Please try again later!');
            }
        }
	}

}//end controller
