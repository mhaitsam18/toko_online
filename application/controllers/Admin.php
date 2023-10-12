<?php 

class Admin extends CI_Controller{

	public function __construct(){
		parent::__construct();

		if($this->session->userdata('role_id') != 1){
			$this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
					Anda Belum Login!
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					</div>');
			redirect('auth/login');
		}
	}
	
	public function index()
	{
		redirect('admin/vendor');
	}

	public function vendor()
	{
		$data['vendor'] = $this->model_vendor->view()->result();
		$this->load->view('templates_admin/header');
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/vendor', $data);
		$this->load->view('templates_admin/footer');
	}

	public function updateStatusUser($id = null, $is_active)
	{
		$this->db->where('id', $id);
		$this->db->update('tb_user', ['is_active' => $is_active]);
		redirect('Admin/vendor');
	}
}