<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_todo');
	}
	
	public function index()
	{
		$this->load->view('home');
	}

	public function ajax_get()
	{
		$data = $this->M_todo->get();
		echo json_encode($data);
	}

	public function ajax_post()
	{
		echo $this->M_todo->post();
	}

	public function ajax_put()
	{
		echo $this->M_todo->put();
	}

	public function ajax_put_status()
	{
		echo $this->M_todo->put_status();
	}

	public function ajax_delete()
	{
		echo $this->M_todo->delete();
	}
}
