<?php

class Index extends Controller {
    function  __construct() {
		parent::Controller();
	}

	function index()
	{
		$data[] = '';
		$this->load->view('admin/layout', $data);
	}
}
?>
