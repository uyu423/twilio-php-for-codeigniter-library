<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Using_example extends CI_Controller {
	public function send_sms_test() {
		$this->load->library('sms');
		$this->sms->send(array(
			'to' => '+820000000000',
			'from' => '+820000000000',
			'contents' => 'Hello World !!',
		));
	}
}
