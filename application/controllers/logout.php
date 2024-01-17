<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class logout extends CI_Controller {

	public function index()
	{
		$this->session->unset_userdata('admin');
		$this->session->unset_userdata('suplier');
		$this->session->unset_userdata('checker');
		redirect('auth');
	}
}
