<?php

class Model_kategori extends CI_Model{

	public function data_suara(){
		return $this->db->get_where("tb_barang",array('kategori' => 'suara')); 
	}

	public function data_cahaya(){
		return $this->db->get_where("tb_barang",array('kategori' => 'cahaya')); 
	}

	public function data_proyektor(){
		return $this->db->get_where("tb_barang",array('kategori' => 'proyektor')); 
	}

	public function data_kabel(){
		return $this->db->get_where("tb_barang",array('kategori' => 'kabel')); 
	}
}