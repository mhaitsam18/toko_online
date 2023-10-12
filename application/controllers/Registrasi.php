<?php

class Registrasi extends CI_Controller{

	public function index()
	{
		$this->form_validation->set_rules('nama',' Nama', 'required', ['required' => 'Nama Wajib diisi!'
		]);
		$this->form_validation->set_rules('username',' Username', 'required|is_unique[tb_user.username]',['required' => 'Username wajib diisi!'
		]);
		$this->form_validation->set_rules('password_1',' Password', 'required|matches[password_2]',['required' => 'Password Wajib diisi!',
			'matches' => 'Password tidak cocok'
		]);
		$this->form_validation->set_rules('password_2',' Password', 'required|matches[password_1]');


		if($this->form_validation->run() == FALSE){
			$this->load->view('templates/header');
			$this->load->view('registrasi');
			$this->load->view('templates/footer');
		} else {
			$data = array(
				'nama'		=> $this->input->post('nama'),
				'username'	=> $this->input->post('username'),
				'password'	=> $this->input->post('password_1'),
				'alamat'	=> $this->input->post('alamat'),
				'role_id'	=> $this->input->post('role_id'),
				'is_active'	=> 0
			);

			$this->db->insert('tb_user',$data);
			if ($this->input->post('role_id') == 3) {
				$upload_bukti_surat_usaha = $_FILES['bukti_surat_usaha']['name'];
				if ($upload_bukti_surat_usaha) {
					$config['allowed_types'] = 'gif|jpg|png|svg|jpeg|pdf';
					$config['upload_path'] = './assets/img/bukti-surat-usaha';
					$config['max_size']     = '15000000';
					$this->load->library('upload', $config);
					if ($this->upload->do_upload('bukti_surat_usaha')) {
						$id_user = $this->db->insert_id();
						$bukti_surat_usaha = $this->upload->data('file_name');
						$this->db->insert('tb_vendor',[
							'id_user' => $id_user,
							'bukti_surat_usaha' => $bukti_surat_usaha
						]);
						$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
							Registrasi Berhasil!
							</div>');
						redirect('auth/login');
					} else{
						$this->db->delete('tb_user', ['id' => $id_user]);
						$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">'.$this->upload->display_errors().'</div>');
					}
				} else{
					$this->db->delete('tb_user', ['id' => $id_user]);
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
						Bukti Surat Usaha Wajib diupload!
						</div>');
				}
				redirect('registrasi');
			} elseif ($this->input->post('role_id') == 2) {
				$upload_kartu_identitas = $_FILES['kartu_identitas']['name'];
				if ($upload_kartu_identitas) {
					$config['allowed_types'] = 'gif|jpg|png|svg|jpeg|pdf';
					$config['upload_path'] = './assets/img/kartu-identitas';
					$config['max_size']     = '15000000';
					$this->load->library('upload', $config);
					if ($this->upload->do_upload('kartu_identitas')) {
						$id_user = $this->db->insert_id();
						$kartu_identitas = $this->upload->data('file_name');
						$this->db->insert('tb_member',[
							'id_user' => $id_user,
							'kartu_identitas' => $kartu_identitas
						]);
						$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
							Registrasi Berhasil!
							</div>');
						redirect('auth/login');
					} else{
						$this->db->delete('tb_user', ['id' => $id_user]);
						$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">'.$this->upload->display_errors().'</div>');
					}
				} else{
					$this->db->delete('tb_user', ['id' => $id_user]);
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
						Kartu Identitas Wajib diupload!
						</div>');
				}
				redirect('registrasi');	
			}
		}
	}
}