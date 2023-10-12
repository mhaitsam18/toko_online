<?php

class Model_vendor extends CI_Model{

	public function view(){
		$this->db->select('*, tb_user.id AS idu, tb_vendor.id AS idv');
		$this->db->join('tb_user', 'tb_user.id=tb_vendor.id_user');
		return $this->db->get("tb_vendor"); 
	}
}