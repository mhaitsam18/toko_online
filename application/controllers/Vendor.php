<?php

class Vendor extends CI_Controller{

	public function __construct(){
		parent::__construct();

		if($this->session->userdata('role_id') != 3){
			$this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
					Anda Belum Login!
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					</div>');
			redirect('auth/login');
		}
	}
	
	public function dashboard_vendor()
	{
		$data['best_rent'] = $this->model_barang->best_rent()->result();
		$data['title'] = 'Dashboard';
		$this->load->view('templates_vendor/header');
		$this->load->view('templates_vendor/sidebar', $data);
		$this->load->view('vendor/dashboard', $data);
		$this->load->view('templates_vendor/footer');
	}
	
	public function invoice()
	{
		$data['invoice'] = $this->model_invoice->tampil_data();
		$data['title'] = 'Invoice';
		$this->load->view('templates_vendor/header');
		$this->load->view('templates_vendor/sidebar', $data);
		$this->load->view('vendor/invoice',$data);
		$this->load->view('templates_vendor/footer');
	}

	public function detailInvoice($id_invoice)
	{
		$data['invoice'] = $this->model_invoice->ambil_id_invoice($id_invoice);
		$data['pesanan'] = $this->model_invoice->ambil_id_pesanan($id_invoice);
		$data['title'] = 'Invoice';
		$this->load->view('templates_vendor/header');
		$this->load->view('templates_vendor/sidebar', $data);
		$this->load->view('vendor/detail_invoice',$data);
		$this->load->view('templates_vendor/footer');
	}

	public function updateStatusInvoice($id, $status)
	{
		$data['title'] = 'Invoice';
		$update = $this->model_invoice->updateStatus($id, $status);
		if ($update) {
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
				Status Berhasil diupdate!
				</div>');
			redirect('vendor/invoice');
		} else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
				Status Gagal diupdate!
				</div>');
			redirect('vendor/invoice');
		}
	}

	public function Data_barang()
	{
		$data['title'] = 'Data Barang';
		$data['barang'] = $this->model_barang->tampil_data($this->session->userdata('id_vendor'))->result();
		$this->load->view('templates_vendor/header');
		$this->load->view('templates_vendor/sidebar', $data);
		$this->load->view('vendor/data_barang', $data);
		$this->load->view('templates_vendor/footer');
	}

	public function tambah_barang(){
		$data['title'] = 'Data Barang';
		$nama_brg		= $this->input->post('nama_brg');
		$keterangan		= $this->input->post('keterangan');
		$kategori		= $this->input->post('kategori');
		$harga			= $this->input->post('harga');
		$stok			= $this->input->post('stok');
		$gambar		= $_FILES['gambar']['name'];
		if ($gambar ='') {}else{
			$config['upload_path'] = './uploads';
			$config['allowed_types'] = 'jpg|jpeg|png|gif';

			$this->load->library('upload',$config);
			if(!$this->upload->do_upload('gambar')){
				echo "Gambar Gagal diUpload!";
			}else{
				$gambar=$this->upload->data('file_name');
			}
		}

		$data = array(
			'id_vendor'		=> $this->session->userdata('id_vendor'),
			'nama_brg'		=> $nama_brg,
			'keterangan' 	=> $keterangan,
			'kategori'		=> $kategori,
			'harga'			=> $harga,
			'stok'			=> $stok,
			'gambar' 		=> $gambar
		);

		$this->model_barang->tambah_barang($data, 'tb_barang');
		redirect('vendor/data_barang');
	}

	public function edit_barang($id)
	{
		$data['title'] = 'Data Barang';
		$where = array('id_brg' =>$id);
		$data['barang'] = $this->model_barang->edit_barang($where, 'tb_barang')->result();
		$this->load->view('templates_vendor/header');
		$this->load->view('templates_vendor/sidebar', $data);
		$this->load->view('vendor/edit_barang', $data);
		$this->load->view('templates_vendor/footer');
	}

	public function update_barang(){
		$data['title'] = 'Data Barang';
		$id 		= $this->input->post('id_brg');
		$nama_brg 	= $this->input->post('nama_brg');
		$keterangan = $this->input->post('keterangan');
		$kategori	= $this->input->post('kategori');
		$harga		= $this->input->post('harga');
		$stok		= $this->input->post('stok');

		$data = array(

			'nama_brg' => $nama_brg,
			'keterangan' => $keterangan,
			'kategori' => $kategori,
			'harga' => $harga,
			'stok' => $stok
		);

		$where = array(
			'id_brg' => $id
		);

		$this->model_barang->update_data($where,$data, 'tb_barang');
		redirect('vendor/data_barang');
	}

	public function hapus_barang($id)
	{
		$data['title'] = 'Data Barang';
		$where = array('id_brg' => $id);
		$this->model_barang->hapus_data($where, 'tb_barang');
		redirect('vendor/data_barang');
	}

	public function laporan($value='')
	{
		$data['title'] = 'Laporan';
		$data['pesanan'] = $this->model_invoice->getPesanan();
		$this->load->view('templates_vendor/header');
		$this->load->view('templates_vendor/sidebar', $data);
		$this->load->view('vendor/laporan',$data);
		$this->load->view('templates_vendor/footer');
	}
	public function cetakLaporan($value='')
	{
		$data['title'] = 'Laporan';
		$data['pesanan'] = $this->model_invoice->getPesanan();
		$this->load->view('templates_vendor/header');
		$this->load->view('vendor/cetak-laporan',$data);
		$this->load->view('templates_vendor/footer');
	}
	
}