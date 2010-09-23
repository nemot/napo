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

}
?>
