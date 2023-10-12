<?php 

class Auth extends CI_Controller{
	
	public function login(){
		$this->form_validation->set_rules('username','Username','required',['required' => 'Username wajib diisi!']);
		$this->form_validation->set_rules('password','Password','required',['required' => 'Password wajib diisi!']);
		if($this->form_validation->run() == FALSE){
			$this->load->view('templates/header');
			$this->load->view('form_login');
			$this->load->view('templates/footer');
		}else{
			$auth = $this->model_auth->cek_login();
			if($auth == FALSE){
				$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
					Username atau Password Anda salah / belum terdaftar!
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					</div>');
				redirect('auth/login');
			}else{
				$this->session->set_userdata('username', $auth->username);
				$this->session->set_userdata('role_id', $auth->role_id);

				switch($auth->role_id){
					case 1 : 
						redirect('admin/');
					break;
					case 2 :

						$this->db->where('id_user', $auth->id);
						$member = $this->db->get('tb_member')->row();
						$this->session->set_userdata('id_member', $member->id);
						redirect('welcome');
					break;
					case 3 : 
						$this->db->where('id_user', $auth->id);
						$vendor = $this->db->get('tb_vendor')->row();
						$this->session->set_userdata('id_vendor', $vendor->id);
						redirect('vendor/dashboard_vendor');
					break;
					default : break;
				}
			}
		}
	}

	public function upload($role_id)
	{
		if ($role_id == 3) {
			$this->load->view('auth/upload-surat-usaha');
		} elseif ($role_id == 2) {
			$this->load->view('auth/upload-kartu-identitas');
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('auth/login');
	}
}