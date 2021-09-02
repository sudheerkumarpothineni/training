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

	function razorpay(){
		$this->load->view('includes/dashboard_header');
		$this->load->view('razorpay');
		$this->load->view('includes/dashboard_footer');
	}

	function razorpay_payment_process(){
		$data=$this->input->post();
		if ($data) {
			date_default_timezone_set('Asia/Kolkata');
			$data['status']='success';
			$data['payment_date']=date('y-m-d h:i:sa');
			$result['last_insert_id']=$this->dashboard_model->razorpay_insert($data);
			$result['status']=SUCCESS;
		}
		echo json_encode($result);
	}

	function razorpay_payment_success(){
		$this->load->view('includes/dashboard_header');
		$this->load->view('razorpay_payment_success');
		$this->load->view('includes/dashboard_footer');
	}

	function nagad(){
		$this->load->view('includes/dashboard_header');
		$this->load->view('nagad');
		$this->load->view('includes/dashboard_footer');
	}

	function test_nagad(){
		define('NAGAD_MERCHANT_ID','683002007104225');
		$data=$this->input->post();
		$orderId = 'test12345';
		$sensitiveDataElements = array(
		  "merchantId" => NAGAD_MERCHANT_ID,
		  "datetime" => date("Ymdhis"),
		  "orderId" => $orderId,
		  "challenge" => bin2hex(rand(000000,99999999999))
		);
		$request_method = 'POST';
		$header = array(
			'X-KM-IP-V4'=> 'localhost',
			'X-KM-Client-Type' => 'PC_WEB',
			'X-KM-Api-Version' => 'v-0.2.0',
			'Content-Type' => 'application/json'
		);
		$request = array(
			'datetime'=> date("Ymdhis"),
			'sensitiveData' => $this->sensitiveDataEncryption($sensitiveDataElements),
			'signature' => $this->signatureCreation($sensitiveDataElements),
		);
		$header = json_encode($header);
		$request = json_encode($request);
		$url='http://sandbox.mynagad.com:10080/remote-payment-gateway-1.0/api/dfs/check-out/initialize/'.NAGAD_MERCHANT_ID.'/'.$orderId;
		
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $request);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			'X-KM-IP-V4'=> 'localhost',
			'X-KM-Client-Type' => 'PC_WEB',
			'X-KM-Api-Version' => 'v-0.2.0',
			'Content-Type' => 'application/json'
		));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    	$response__res = curl_exec($curl);
    	$response__res=json_decode($response__res,true);
	    debug($response__res);
	    exit('sudheer');
	}

	function sensitiveDataEncryption($sensitiveDataElements) 
	{
		define('NAGAD_PUBLIC_KEY','-----BEGIN PUBLIC KEY-----
			MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAjBH1pFNSSRKPuMcNxmU5jZ1x8K9LPFM4XSu11m7uCfLUSE4SEjL30w3ockFvwAcuJffCUwtSpbjr34cSTD7EFG1Jqk9Gg0fQCKvPaU54jjMJoP2toR9fGmQV7y9fz31UVxSk97AqWZZLJBT2lmv76AgpVV0k0xtb/0VIv8pd/j6TIz9SFfsTQOugHkhyRzzhvZisiKzOAAWNX8RMpG+iqQi4p9W9VrmmiCfFDmLFnMrwhncnMsvlXB8QSJCq2irrx3HG0SJJCbS5+atz+E1iqO8QaPJ05snxv82Mf4NlZ4gZK0Pq/VvJ20lSkR+0nk+s/v3BgIyle78wjZP1vWLU4wIDAQAB
			-----END PUBLIC KEY-----');
		error_reporting(E_ALL);
		ini_set('display_errors',1);
		ini_set('display_startup_errors',1);
		$publicKey = NAGAD_PUBLIC_KEY;
		$textToEncrypt = implode('',$sensitiveDataElements);
		$response = openssl_public_encrypt ($textToEncrypt,$crypted,$publicKey,OPENSSL_PKCS1_PADDING);
		$response = json_decode($response);
		$response=base64_encode($response->encryptedOutput);
		return $response;

	}
	function signatureCreation($sensitiveDataElements) 
	{
		$textToEncrypt = json_encode($sensitiveDataElements);
		$result = hash('sha256', $textToEncrypt);
		$final_res=base64_encode($result);
		return $final_res;
	}
}
?>