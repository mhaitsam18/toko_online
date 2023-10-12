<?php

class Model_barang extends CI_Model{
	public function tampil_data($id_vendor = null){
		if ($id_vendor) {
			$this->db->where('id_vendor', $id_vendor);
		}
		return $this->db->get('tb_barang');
	}

	public function best_rent(){
		$this->db->select('*, COUNT(tb_pesanan.id_brg) AS tersewa');
		// $this->db->select('*, SUM(tb_pesanan.jumlah) AS tersewa');
		$this->db->join('tb_pesanan', 'tb_pesanan.id_brg=tb_barang.id_brg');
		$this->db->group_by('tb_pesanan.id_brg');
		$this->db->order_by('COUNT(tb_pesanan.id_brg)', 'DESC');
		// $this->db->order_by('SUM(tb_pesanan.jumlah)', 'DESC');
		$this->db->where('id_vendor', $this->session->userdata('id_vendor'));
		return $this->db->get('tb_barang', 4);
	}

	public function tambah_barang($data,$table){
		$this->db->insert($table,$data);
	}

	public function edit_barang($where,$table){
		return $this->db->get_where($table,$where);
	}

	public function update_data($where,$data,$table)
	{
		$this->db->where($where);
		$this->db->update($table,$data);
	}

	public function hapus_data($where,$table)
	{
		$this->db->where($where);
		$this->db->delete($table);
	}

	public function find($id)
	{
		$result = $this->db->where('id_brg', $id)
						->limit(1)
						->get('tb_barang');
		if($result->num_rows() > 0){
			return $result->row();
		}else{
			return array();
		}
	}

	public function detail_brg($id_brg)
	{
		$result = $this->db->where('id_brg',$id_brg)->get('tb_barang');
		if($result->num_rows() > 0){
			return $result->result();
		}else{
			return false;
		}
	}
}
