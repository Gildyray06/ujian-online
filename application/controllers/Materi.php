<?php
defined('BASEPATH') or exit('No direct script access allowed');
include 'vendor/autoload.php';
class Materi extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('status') != 'admin_login') {
			redirect(base_url('auth'));
		}
	}

	public function index()
	{		
		$data['materi'] = $this->m_data->get_data('tb_materi')->result();
		$this->load->view('admin/v_materi', $data);
	}

	public function materi_aksi()
	{
		$nama 		= $this->input->post('nama_materi');

		$data = array('nama_materi' => $nama);


		$config['upload_path']   = './uploads/';
		$config['allowed_types'] = 'pdf';
		$config['max_size']      = 10240;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('file_pdf')) {
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-message"><i class="icon fa fa-check"></i><b>Error !<br></b> Data Materi gagal ditambahkan</div>');
			redirect(base_url('materi'));
		}
		else {
			$parser = new \Smalot\PdfParser\Parser();
			$data['pdf_materi'] = $this->upload->data()['file_name'];
			$pdf = $parser->parseFile(FCPATH.'/uploads/'.$data['pdf_materi']);

			$textContent = $pdf->getText();

			$fileName=time().'.txt';
			$fp = fopen(FCPATH . "/uploads/text/".$fileName,"wb");
			fwrite($fp,$textContent);
			fclose($fp);
			$data['txt_materi']=$fileName;

		}


		$this->m_data->insert_data($data, 'tb_materi');

		$this->session->set_flashdata('message', '<div class="alert alert-success alert-message"><i class="icon fa fa-check"></i><b>Selamat !<br></b> Data Materi berhasil ditambahkan</div>');
		redirect(base_url('materi'));
	}

	public function hapus($id)
	{
		$where = array(
			'id_materi' => $id
		);
		
		$this->m_data->delete_data($where, 'tb_materi');
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-message"><i class="icon fa fa-check"></i><b>Sukses !<br></b> Data Materi berhasil dihapus</div>');
		redirect(base_url('materi'));
	}

	public function edit($id)
	{
		$where	= array('id_materi' => $id);
		$data['materi'] = $this->m_data->edit_data($where, 'tb_materi')->result();
		$this->load->view('admin/v_materi_edit', $data);
	}
	
	public function update()
	{
		$id 		= $this->input->post('id');
		$nama 		= $this->input->post('nama');

		$where = array('id_materi' => $id);

		$data = array('nama_materi' => $nama);


		$config['upload_path']   = './uploads/';
		$config['allowed_types'] = 'pdf';
		$config['max_size']      = 10240;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('file_pdf')) {

		}
		else {
			$parser = new \Smalot\PdfParser\Parser();
			$data['pdf_materi'] = $this->upload->data()['file_name'];
			$pdf = $parser->parseFile(FCPATH.'/uploads/'.$data['pdf_materi']);

			$textContent = $pdf->getText();

			$fileName=time().'.txt';
			$fp = fopen(FCPATH . "/uploads/text/".$fileName,"wb");
			fwrite($fp,$textContent);
			fclose($fp);
			$data['txt_materi']=$fileName;
		}


		$this->m_data->update_data($where, $data, 'tb_materi');
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-message"><i class="icon fa fa-check"></i><b>Sukses !<br></b> Data materi berhasil diupdate</div>');
		redirect(base_url('materi'));
	}
}
