<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Products extends Controller {
	function  __construct() {
		parent::Controller();
		$this->load->model('admin/product');
	}

	function index()
	{
		$data['products'] = $this->product->getProducts();
		
		$data['content'] = 'admin/products/index';
		$this->load->view('admin/layout', $data);
	}

	function add() {
		$this->load->library('form_validation');
		$this->load->library('image_lib');

		$this->image_lib->resize();

		$this->form_validation->set_rules('name', 'product name', 'required|trim|strip_tags|max_length[255]');
		$this->form_validation->set_rules('teaser', 'teaser', 'required|trim');
		$this->form_validation->set_rules('description', 'description', 'required|trim');

		$product['name'] = $this->input->post('name');
		$product['teaser'] = $this->input->post('teaser');
		$product['description'] = $this->input->post('description');

		if (isset($_FILES['image']['name']) and $_FILES['image']['name'] != '') {
			$image['name'] = $_FILES['image']['name'];
			$image['type'] = $_FILES['image']['type'];
			$image['tmp_name'] = $_FILES['image']['tmp_name'];
			$image['error'] = $_FILES['image']['error'];
			$image['size'] = $_FILES['image']['size'];
			$image['path'] =  $_SERVER['DOCUMENT_ROOT'].'/images/products';
			$image['new_name'] =  strtolower(time().'_'.rand().'.'.end(explode(".", $image['name'])));

		}

		if ($this->form_validation->run() === true) {
			if ($this->db->insert('products', $product)) {
				$id = $this->db->insert_id();
				if ($this->create_thumb($image) and $this->save_image($image)) {
					$this->db->insert('images', array('product_id' => $id, 'name' => $image['new_name'], 'preview' => '1'));
					$this->session->set_flashdata('notice', 'Product was successfully added');
				}
				else {
					$this->session->set_flashdata('notice', $this->image_lib->display_errors());
				}
			}
			else {
				$this->session->set_flashdata('notice', "Couldn't add product. Try again");
			}
			redirect(base_url().'admin/products/index', 'refresh');
		}

		$data['content'] = 'admin/products/add';
		$this->load->view('admin/layout', $data);
	}

	function delete() {
		$product['id'] = $this->input->get('id');
		$this->remove_images($product['id']);
		$this->db->where('id', $product['id']);
		if ($this->db->delete('products')) { 
//			$this->remove_images($product['id']);
			$this->session->set_flashdata('notice', 'Product was successfully deleted');
		}
		else {
			$this->session->set_flashdata('notice', "Couldn't delete product. Try again");
		}
		redirect(base_url().'admin/products/index', 'refresh');

	}

	private function remove_images($product_id) { 
		$this->db->where('product_id', $product_id);
		$query = $this->db->get('images');
		$images = $query->result_array();
		foreach ($images as $image) {
			echo $image_path = $_SERVER['DOCUMENT_ROOT'].'/images/products/'.$image['name'];
			echo $thumb_path = $_SERVER['DOCUMENT_ROOT'].'/images/products/thumbs/'.$image['name'];
			if (file_exists($image_path)) {
				echo unlink ($thumb_path);
				echo unlink ($image_path);
			}
		}
	}

	private function create_thumb($image) {
		$config['new_image'] = $image['path'].'/thumbs/'.$image['new_name'];
		$config['image_library'] = 'gd2';
		$config['source_image'] = $image['tmp_name'];
		$config['create_thumb'] = FALSE;
		$config['maintain_ratio'] = TRUE;
		$config['width'] = 100;
		$config['height'] = 100;

		$this->image_lib->initialize($config);
		if ($this->image_lib->resize()) {
			return true;
		}
		return false;
	}

	private function save_image($image) {
		$config['new_image'] = $image['path'].'/'.$image['new_name'];
		$config['image_library'] = 'gd2';
		$config['source_image'] = $image['tmp_name'];
		$config['create_thumb'] = FALSE;
		$config['maintain_ratio'] = TRUE;
		$config['width'] = 500;
		$config['height'] = 500;

		$this->image_lib->initialize($config);
		if ($this->image_lib->resize()) {
			return true;
		}
		return false;
	}
	
}