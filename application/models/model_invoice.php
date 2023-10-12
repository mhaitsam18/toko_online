<?php 

class Model_invoice extends CI_Model{
	public function index()
	{
		date_default_timezone_set('Asia/Jakarta');
		$nama	= $this->input->post('nama');
		$alamat	= $this->input->post('alamat');
		$tgl_pengiriman = $this->input->post('tgl_pengiriman');
		$tgl_pengembalian	= $this->input->post('tgl_pengembalian');
		// $upload_ktp = $_FILES['ktp']['name'];
		// $upload_mou = $_FILES['mou']['name'];
		// $upload_bukti_transfer = $_FILES['bukti_transfer']['name'];
		// if ($upload_ktp && $upload_mou && $upload_bukti_transfer) {
			// $config['allowed_types'] = 'gif|jpg|png|svg|jpeg|pdf|docx';
			// // $config['upload_path'] = './assets/img/ktp';
			// $config['upload_path'] = './assets/img/invoice';
			// $config['max_size']     = '15000000';
			// $this->load->library('upload', $config);
			// if ($this->upload->do_upload('ktp')) {
			// 	$ktp = $this->upload->data('file_name');
			// }
			// // $config['allowed_types'] = 'application/pdf|pdf|application/octet-stream|csv';
			// // $config['upload_path'] = './assets/img/mou';
			// // $config['max_size']     = '15000000';
			// $this->load->library('upload', $config);
			// if ($this->upload->do_upload('mou')) {
			// 	$mou = $this->upload->data('file_name');
			// }
			// // $config['allowed_types'] = 'gif|jpg|png|svg|jpeg|pdf';
			// // $config['upload_path'] = './assets/img/bukti_transfer';
			// // $config['max_size']     = '15000000';
			// $this->load->library('upload', $config);
			// if ($this->upload->do_upload('bukti_transfer')) {
			// 	$bukti_transfer = $this->upload->data('file_name');
			// }
			$invoice = array (
				'nama'				=> $nama,
				'alamat'			=> $alamat,
				'id_member'			=> $this->session->userdata('id_member'),
				'tgl_pengiriman'	=> $tgl_pengiriman,
				'tgl_pengembalian'	=> $tgl_pengembalian,
				'tgl_pesan'			=> date('Y-m-d H:i:s'),
				'batas_bayar'		=> date('Y-m-d H:i:s', mktime(date('H'), date('i'), date('s'), date('m'), date('d') + 1, date('Y'))),
				'status'			=> 'Belum dikonfirmasi'
			);
			$this->db->insert('tb_invoice', $invoice);
			$id_invoice = $this->db->insert_id();

			foreach ($this->cart->contents() as $item){
				$data = array(
					'id_invoice'	=>$id_invoice,
					'id_brg'		=>$item['id'],
					'nama_brg'		=>$item['name'],
					'jumlah'		=>$item['qty'],
					'harga'			=>$item['price'],
				);
				$this->db->insert('tb_pesanan', $data);
			}
			$this->db->insert('tb_administrasi', ['id_invoice' => $id_invoice]);
			// return TRUE;
			return $id_invoice;
		// } else{
		// 	$this->session->set_flashdata('flash_gagal', 'Gambar Produk Wajib diupload!');
		// 	$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
		// 		Gambar Wajib diupload!
		// 		</div>');
		// 	return false;
		// }
	}

	public function tampil_data()
	{
		$this->db->select('*, tb_invoice.id AS idi');
		$this->db->join('tb_pesanan', 'tb_invoice.id = tb_pesanan.id_invoice');
		$this->db->join('tb_barang', 'tb_barang.id_brg = tb_pesanan.id_brg');
		$this->db->join('tb_administrasi', 'tb_administrasi.id_invoice = tb_invoice.id');
		$this->db->join('tb_pembayaran', 'tb_pembayaran.id_invoice = tb_invoice.id', 'LEFT');
		$this->db->where('id_vendor', $this->session->userdata('id_vendor'));
		$this->db->order_by('tgl_pesan', 'DESC');
		$this->db->group_by('tb_invoice.id');
		$result = $this->db->get('tb_invoice');
		if($result->num_rows() > 0){
			return $result->result();
		}else{
			return $result->result();
		}
	}

	public function tampil_data_pesanan()
	{
		$this->db->select('*, tb_invoice.id AS idi');
		$this->db->order_by('tgl_pesan', 'DESC');
		$this->db->join('tb_pesanan', 'tb_invoice.id = tb_pesanan.id_invoice');
		$this->db->join('tb_barang', 'tb_barang.id_brg = tb_pesanan.id_brg');
		$this->db->join('tb_administrasi', 'tb_administrasi.id_invoice = tb_invoice.id');
		// $this->db->join('tb_pembayaran', 'tb_pembayaran.id_invoice = tb_invoice.id');
		$this->db->where('id_member', $this->session->userdata('id_member'));
		$result = $this->db->get('tb_invoice');
		if($result->num_rows() > 0){
			return $result->result();
		}else{
			return $result->result();
		}
	}

	public function getPesanan()
	{
		$this->db->join('tb_invoice', 'tb_invoice.id=tb_pesanan.id_invoice');
		$result = $this->db->get('tb_pesanan');
		if($result->num_rows() > 0){
			return $result->result();
		}else{
			return false;
		}
	}

	public function ambil_id_invoice($id_invoice)
	{
		$result = $this->db->where('id', $id_invoice)->limit(1)->get('tb_invoice');
		if($result->num_rows() > 0){
			return $result->row();
		}else{
			return false;
		}
	}

	public function ambil_id_pesanan($id_invoice)
	{
		$result = $this->db->where('id_invoice', $id_invoice)->get('tb_pesanan');
		if($result->num_rows() > 0){
			return $result->result();
		}else{
			return false;
		}
	}

	public function updateStatus($id_invoice, $status)
	{
		$this->db->where('id', $id_invoice);
		$result = $this->db->update('tb_invoice', ['status' => $status]);
		if ($result) {
			return true;
		} else{
			return false;
		}

	}
}