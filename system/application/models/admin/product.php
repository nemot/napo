<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Product extends Model {

	function  __construct() {
		parent::Model();
	}

	function getProducts() {
		$sql = 'SELECT p.*, i.name as preview from products p, images i WHERE i.product_id = p.id';
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	function getProduct($id) {
		$sql = 'SELECT p.*, i.name as preview from products p, images i WHERE i.product_id = p.id and p.id = ?';
		$query = $this->db->query($sql, $id);
		return $query->row_array();
	}

	function getImages($id) {
		$sql = 'SELECT * from images WHERE product_id = id and preview = 0';
		$query = $this->db->query($sql);
		return $query->result_array();
	}

}
?>
