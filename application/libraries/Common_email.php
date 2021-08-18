<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Common_email
{
	protected $CI;
	public function __construct()
	{
		$this->CI = & get_instance();
	}
	public function sending_email($to,$subject,$message)
	{
		$this->CI->load->library('email');

		$config = array(
				  'protocol'  => 'smtp',
				  'smtp_host' => 'ssl://smtp.googlemail.com',
				  'smtp_port' => 465,
				  'smtp_user' => 'sudheerkumar.provab@gmail.com',//email
				  'smtp_pass' => 'Provab@36500',//password
				  'mailtype'  => 'html',
				  'charset'   => 'utf-8'
		);
		$this->CI->email->initialize($config);
		$this->CI->email->set_mailtype("html");
		$this->CI->email->set_newline("\r\n");

		//Email content
		$this->CI->email->to($to);
		$this->CI->email->from('sudheerkumar.provab@gmail.com','Task One');//email
		$this->CI->email->subject($subject);
		$this->CI->email->message($message);

		//Send email
		$result = $this->CI->email->send();
		if ($result) {
			return 'success';
		}
		else{
			return $this->CI->email->print_debugger();exit;
		}
	}
}
?>