<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Categories extends Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->library('tank_auth');

	}

	
	function index()
	{
		$query = $this->db->get('categories');
		$data['categories'] = $query->result_array();
		$data['content'] = 'admin/categories/index';
		$this->load->view('admin/layout', $data);
	}

	function add()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('name', 'category name', 'required|trim|max_length[255]|callback_unique');

		if ($this->form_validation->run() === true) {
			$category['name'] = $this->input->post('name');
			if ($this->db->insert('categories', $category)) {
				$this->session->set_flashdata('notice', 'Category was successfully added');
			}
			else {
				$this->session->set_flashdata('notice', "Couldn't add category. Try again");
			}
			redirect(base_url().'admin/categories/index', 'refresh');
		}

		$data['content'] = 'admin/categories/add';
		$this->load->view('admin/layout', $data);
	}

	function edit()
	{
		$this->load->library('form_validation');

		$category['id'] = $this->input->get('id');
		$category['name'] = $this->input->post('name');

		$this->form_validation->set_rules('name', 'category name', 'required|trim|max_length[255]|callback_unique');

		if ($this->form_validation->run() === true) {
			$this->db->where('id', $category['id']);
			if ($this->db->update('categories', $category)) {
				$this->session->set_flashdata('notice', 'Category was successfully udated');
			}
			else {
				$this->session->set_flashdata('notice', "Couldn't update category. Try again");
			}
			redirect(base_url().'admin/categories/index', 'refresh');
		}

		$this->db->where('id', $category['id']);
		$query = $this->db->get('categories');

		$data['category'] = $query->row_array();

		$data['content'] = 'admin/categories/edit';
		$this->load->view('admin/layout', $data);
	}

	function delete()
	{
		$this->load->library('form_validation');

		$category['id'] = $this->input->get('id');

		$this->db->where('id', $category['id']);
		if ($this->db->delete('categories')) {
			$this->session->set_flashdata('notice', 'Category was successfully deleted');
		}
		else {
			$this->session->set_flashdata('notice', "Couldn't delete category. Try again");
		}
		redirect(base_url().'admin/categories/index', 'refresh');

	}

	function unique($name) {
		$this->db->where('name', $name);
		$query = $this->db->get('categories');
		if ($query->num_rows() > 0) {
			$this->form_validation->set_message('unique', 'The category with such name is already exists');
			return false;
		}
		else {
			return true;
		}
	}
}
