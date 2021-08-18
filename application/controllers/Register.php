<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
class Register extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('register_model');
		$this->load->model('dashboard_model');
		$this->load->library('form_validation');
	}

	function index()
	{
		$this->load->view('user_register');
	}

	function validation(){
		$post_data=$this->input->post();
		// debug($post_data);exit;
		if (isset($post_data['origin'])) {
			$result=$this->dashboard_model->update_user_data($post_data);
			$this->session->set_flashdata('message', 'User data updated successfully');
			redirect('dashboard');
		}
		else{
			$this->form_validation->set_rules('username','Username','required|trim');
			$this->form_validation->set_rules('email','Email Address','required|trim|valid_email|is_unique[users.email]');
			$this->form_validation->set_rules('mobile','Mobile Number','required|trim|is_unique[users.mobile]');
			if ($this->form_validation->run()) {
				$post_data['otp']=rand(100000,999999);
				// debug($post_data);exit;
				$post_data['status']=SUCCESS;
				$result=$this->register_model->insert_users($post_data);
				if ($result) {
					$this->load->library('common_email');
					$subject = ' Otp to verify';
					$message = 'Your otp is '.$post_data['otp'];
					$mail_status = $this->common_email->sending_email($post_data['email'],$subject,$message);
					if ($mail_status == 'success') {
						$final_data['last_inserted_id'] = $result;
						$final_data['status'] = $mail_status;
						echo json_encode($final_data);
					}
					else{
						$this->index();
					}
				}
			}
			else{
				// echo "string";exit;
				$final_data['status'] ='duplicate';
				$final_data['validation_errors'] =  validation_errors();
				echo json_encode($final_data);

				// $this->index();
			}
		}
		
	}

	function verify_otp(){
		$post_data=$this->input->post();
		$result=$this->register_model->get_user_details_by_id($post_data['id']);
		// debug($result[0]->otp);exit;
		if ($post_data['otp'] == $result[0]->otp) {
			$final_data['status'] = 'success';
		}
		else{
			$final_data['status'] = 'Invalid Otp';
		}
		echo json_encode($final_data);

	}

	function password_adding_to_registering_user(){
		$post_data=$this->input->post();
		$update_data=$this->register_model->update_user_data($post_data);
		// debug($update_data);exit;
		if ($update_data) {
			$final_data['status'] = 'success';
		}
		else{
			$final_data['status'] = 'Error While Updating Password';
		}
		echo json_encode($final_data);
	}
}
?>