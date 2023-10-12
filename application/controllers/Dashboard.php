<?php

class Dashboard extends CI_Controller{

	public function __construct(){
		parent::__construct();

		if($this->session->userdata('role_id') != '2'){
			$this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
					Anda Belum Login!
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					</div>');
			redirect('auth/login');
		}
	}

	public function tambah_ke_keranjang($id)
	{
		$barang = $this->model_barang->find($id);

		$data = array(
	        'id'      => $barang->id_brg,
	        'qty'     => 1,
	        'price'   => $barang->harga,
	        'name'    => $barang->nama_brg
	       
		);

		$this->cart->insert($data);
		redirect('welcome');

	}

	public function tambah_barang($rowid, $qty)
	{
		$data = array(
	        'rowid' => $rowid,
	        'qty'   => ($qty+1)
	    );
		$this->cart->update($data);
    	redirect('Dashboard/detail_keranjang');

	}
	public function kurang_barang($rowid, $qty)
	{
		$data = array(
	        'rowid' => $rowid,
	        'qty'   => ($qty-1)
	    );
		$this->cart->update($data);
    	redirect('Dashboard/detail_keranjang');
	}
	public function hapus_barang($rowid)
	{
		$this->cart->remove($rowid);
    	redirect('Dashboard/detail_keranjang');
	}
	public function bersihkan_keranjang()
	{
		$this->cart->destroy();
    	redirect('Dashboard/detail_keranjang');
	}


	

	public function detail_keranjang()
	{
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('keranjang');
		$this->load->view('templates/footer');
	}

	// public function tambahin_barang($id)
	// {
	// 	$barang = $this->model_barang->find($id);

	// 	$data = array(
	//         'id'      => $barang->id_brg,
	//         'qty'     => 1,
	//         'price'   => $barang->harga,
	//         'name'    => $barang->nama_brg
	       
	// );
	// }

	public function hapus_keranjang()
	{
		$this->cart->destroy();
		redirect('welcome');
	}

	public function pembayaran()
	{
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('pembayaran');
		$this->load->view('templates/footer');
	}

	public function proses_pesanan()
	{
		$is_processed = $this->model_invoice->index();
		if($is_processed){
			$this->cart->destroy();
			redirect('Dashboard/administrasi/'.$is_processed);
		} else{
			redirect($_SERVER['HTTP_REFERER']);
			// echo "Maaf, Pesanan Anda Gagal diproses!";
		}
	}

	public function administrasi($id_invoice = null)
	{
		$administrasi = $this->db->get_where('tb_administrasi', ['id_invoice' => $id_invoice])->row_array();
		$data['rekening_tujuan'] = $this->db->get('tb_rekening')->result_array();
		if ($this->input->post('submit_ktp')) {
			$config['allowed_types'] = 'gif|jpg|png|svg|pdf';
			$config['upload_path'] = './assets/doc/ktp';
			$config['max_size']     = '50000000';
			$this->load->library('upload', $config);
			if ($this->upload->do_upload('ktp')) {
				$old_file = $administrasi['ktp'];
				if ($old_file !='') {
					unlink(FCPATH.'assets/doc/ktp/'.$old_file);
				} 
				$new_file = $this->upload->data('file_name');
				$this->db->set('ktp', $new_file);
				$this->db->where('id', $this->input->post('id'));
				$this->db->update('tb_administrasi');
				redirect('Dashboard/administrasi/'.$this->uri->segment(3));
			} else{
				$this->session->set_flashdata('flash_error', 'Gagal diunggah');
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">'.$this->upload->display_errors().'</div>');
				redirect('Dashboard/administrasi/'.$this->uri->segment(3));
			}
		} elseif ($this->input->post('submit_mou')) {
			$config['allowed_types'] = 'gif|jpg|png|svg|pdf';
			$config['upload_path'] = './assets/doc/mou';
			$config['max_size']     = '50000000';
			$this->load->library('upload', $config);
			if ($this->upload->do_upload('mou')) {
				$old_file = $administrasi['mou'];
				if ($old_file !='') {
					unlink(FCPATH.'assets/doc/mou/'.$old_file);
				} 
				$new_file = $this->upload->data('file_name');
				$this->db->set('mou', $new_file);
				$this->db->where('id', $this->input->post('id'));
				$this->db->update('tb_administrasi');
				redirect('Dashboard/administrasi/'.$this->uri->segment(3));
			} else{
				$this->session->set_flashdata('flash_error', 'Gagal diunggah');
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">'.$this->upload->display_errors().'</div>');
				redirect('Dashboard/administrasi/'.$this->uri->segment(3));
			}
		} else{
			$data['administrasi'] = $this->db->get_where('tb_administrasi', ['id_invoice' => $id_invoice])->row_array();
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('member/administrasi');
			$this->load->view('templates/footer');
		}
	}

	public function detail($id_brg)
	{
		$data['barang'] = $this->model_barang->detail_brg($id_brg);
		$this->cart->destroy();
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('detail_barang',$data);
		$this->load->view('templates/footer');
	}

	public function tgl_pengembalian($tgl_pengiriman)
	{
		$data['tgl_pengiriman'] = $tgl_pengiriman;
		$this->load->view('tgl_pengembalian', $data);

	}

	public function pesananSaya()
	{
		$data['invoice'] = $this->model_invoice->tampil_data_pesanan();
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('member/pesanan-saya',$data);
		$this->load->view('templates/footer');
	}

	public function detailPesanan($id_invoice)
	{
		$data['invoice'] = $this->model_invoice->ambil_id_invoice($id_invoice);
		$data['pesanan'] = $this->model_invoice->ambil_id_pesanan($id_invoice);
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('member/detail-pesanan',$data);
		$this->load->view('templates/footer');
	}

	public function uploadPembayaran()
	{
		$upload_image = $_FILES['bukti_pembayaran']['name'];
		if ($upload_image) {
			$config['allowed_types'] = 'gif|jpg|png|svg|jpeg|pdf';
			$config['upload_path'] = './assets/img/bukti-transfer';
			$config['max_size']     = '204800000';
			$this->load->library('upload', $config);
			if ($this->upload->do_upload('bukti_pembayaran')) {
				$new_image = $this->upload->data('file_name');
				$data = array(
					'id_invoice' => $this->input->post('id_invoice'),
					'id_rekening_tujuan' => $this->input->post('id_rekening_tujuan'),
					'rekening_pengirim' => $this->input->post('rekening_pengirim'),
					'bank_pengirim' => $this->input->post('bank_pengirim'),
					'nama_pengirim' => $this->input->post('nama_pengirim'),
					'waktu_transfer' => $this->input->post('tanggal_transfer').' '.$this->input->post('waktu_transfer'),
					'nominal_transfer' => $this->input->post('nominal_transfer'),
					'bukti_pembayaran' => $new_image,
					'catatan' => $this->input->post('catatan'),
					'status' => 'Belum dikonfirmasi',
				);
				$this->db->insert('tb_pembayaran', $data);

				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
					Bukti Pembayaran Terkirim
					</div>');
				redirect('Dashboard/pesananSaya');
			} else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">'.$this->upload->display_errors().'</div>');
				redirect('Dashboard/administrasi/'.$this->input->post('id_invoice'));
			}
		} else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
				Bukti Pembayaran Wajib diupload
				</div>');
			redirect('Dashboard/administrasi/'.$this->input->post('id_invoice'));
		}
	}
}