<?php
/**
 * 
 */
class Dashboard extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('dashboard_model');
		$this->load->library('form_validation');
		if (!$this->session->userdata('email')) {
			redirect(base_url().'login');
		}
	}

	function index(){
		$users = $this->dashboard_model->get_user_details();
		$users['data'] = json_decode(json_encode($users),true);
		// debug($users);exit;
		$this->load->view('includes/dashboard_header');
		$this->load->view('user_dashboard',$users);
		$this->load->view('includes/dashboard_footer');
	}

	function products(){
		$data['products'] = $this->dashboard_model->get_all_products();
		$this->load->view('includes/dashboard_header');
		$this->load->view('products',$data);
		$this->load->view('includes/dashboard_footer');
	}

	function add_product(){
		$post_data=$this->input->post();
		$this->form_validation->set_rules('product_name','Product Name','required|trim');
		$this->form_validation->set_rules('price','Price','required');
		$this->form_validation->set_rules('quantity','Quantity','required');
		if (empty($_FILES['product_image']['name']))
		{
		    $this->form_validation->set_rules('product_image','Product Image','required');
		}
		if ($this->form_validation->run()) { 
			$file_data=file_upload('product_image');
			$file_name=$file_data['upload_data']['file_name'];
			unset($post_data['submit']);
			$post_data['product_image'] = $file_name;
			$post_data['status'] = SUCCESS;
			$result = $this->dashboard_model->add_product($post_data);
			if ($result) {
				$this->session->set_flashdata('message','Product addedd successfully.');
			}
			else{
				$this->session->set_flashdata('message','Error while adding product.');
			}
				redirect('dashboard/add_product');
		}
		else{
			$this->products();
		}
	}

	function signout(){
		$data = $this->session->all_userdata();
		foreach ($data as $row => $value) {
			$this->session->unset_userdata($row);
		}
		redirect(base_url().'login');
	}

	function user_delete(){
		// debug($_GET['origin']);exit('sudheer');
		$this->dashboard_model->user_delete($_GET['origin']);
	}

	function single_user_details(){
		$origin = $this->input->post();
		$user_details = $this->dashboard_model->get_user_details_by_id($origin);
		$user_details = json_decode(json_encode($user_details[0]),true);
		// debug($user_details);exit;
		echo json_encode($user_details);
	}

	function active_inactive(){
		$data = $this->input->post();
		// debug($data);exit;
		$result = $this->dashboard_model->change_user_status($data);
		if ($result) {
			echo json_encode($result);
		}
	}
}
?>