<?php

class Kategori extends CI_Controller{
	public function suara()
	{
		$data['suara'] = $this->model_kategori->data_suara()->result();
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('suara',$data);
		$this->load->view('templates/footer');
	}

	public function cahaya()
	{
		$data['cahaya'] = $this->model_kategori->data_cahaya()->result();
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('cahaya',$data);
		$this->load->view('templates/footer');
	}

	public function proyektor()
	{
		$data['proyektor'] = $this->model_kategori->data_proyektor()->result();
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('proyektor',$data);
		$this->load->view('templates/footer');
	}

	public function kabel()
	{
		$data['kabel'] = $this->model_kategori->data_kabel()->result();
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('kabel',$data);
		$this->load->view('templates/footer');
	}

	public function dll()
	{
		$data['dll'] = $this->model_kategori->data_dll()->result();
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('kabel',$data);
		$this->load->view('templates/footer');
	}
}