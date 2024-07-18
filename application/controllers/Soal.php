<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Soal extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status') != 'admin_login') {
			if ($this->session->userdata('status') != 'guru_login') {
				redirect('auth');
			}
		}
	}

	public function index()
	{
		$data['soal'] = $this->m_data->get_data('tb_matapelajaran')->result();
		$this->load->view('admin/v_soal', $data);
	}

	public function insert()
	{
		$soal = $this->input->post('soal');

		$a = $this->input->post('a');
		$b = $this->input->post('b');
		$c = $this->input->post('c');
		$d = $this->input->post('d');
		$e = $this->input->post('e');
		$kunci = $this->input->post('kunci');

		$type = $this->input->post('type');
		$data = array(
			'pertanyaan' => $soal,
			'a' => $a,
			'b' => $b,
			'c' => $c,
			'd' => $d,
			'e' => $e,
			'kunci_jawaban' => $kunci,
			'type' => $type,
			'taxonomy_level' => $this->input->post('taxonomy_level')
		);

		$this->m_data->insert_data($data, 'tb_soal_ujian');
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-message alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Selamat, Soal berhasil dibuat!</h4>untuk melihat soal tersebut bisa anda lihat di menu <b>Daftar Soal ujian</b>.</div>');
		redirect(base_url('soal'));
	}

	public function generate()
	{
		$data = [];
		$this->load->view('admin/v_soal_generate', $data);
	}

	public function run_generate()
	{
		$materi = $this->m_data->get_data('tb_materi')->result();
		$content = '';
		foreach ($materi as $item) {
			$path = FCPATH . '/uploads/text/' . $item->txt_materi;
			$content .= file_get_contents($path);
			$content .= '
			=========================== Materi Lainnya ================================
			';
		}

		$fileName = time() . '.txt';
		$fp = fopen(FCPATH . "/uploads/final/" . $fileName, "wb");
		fwrite($fp, $content);
		fclose($fp);

		$jmlsoal=$this->input->post('jumlah_soal_pilihan')+$this->input->post('jumlah_soal_essai');

		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => 'http://127.0.0.1:5300/generate',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 120,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => '{"jumlah":"' . $jmlsoal . '","materi":"' . base_url('/uploads/final/' . $fileName) . '"}',
			CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json'
			),
		));

		$response = curl_exec($curl);

		$taksonomi_level = [
			'Pengetahuan',
			'Pemahaman',
			'Penerapan',
			'Analisis',
			'Evaluasi',
			'Membuat',
		];

		curl_close($curl);
		if (!empty($response)) {
			$response = json_decode($response, true);
			$listOption = ['A', 'B', 'C', 'D', 'E'];
			if (!empty($response['data'])) {
				$html = '';
				foreach ($response['data'] as $key => &$value) {

					$optionHtml = '';
					foreach ($value['options_of_answer'] as $k => $option) {
						$optionHtml .= $listOption[$k] . '. ' . $option . '<br>';
					}
					if($key<$this->input->post('jumlah_soal_pilihan')){
						$value['type']=2;
					}else{
						$value['type']=3;
					}


					if($value['type']==2){
						$type='Pilihan Ganda';
					}else{
						$type='Essai';
					}


					$html .= '<tr>';
					$html .= '<td>' . ($key + 1) . '</td>';
					$html .= '<td>' . $type . '</td>';
					$html .= '<td>' . ($taksonomi_level[($value['taxonomy_level']-1)]) . '</td>';
					$html .= '<td>' . ($value['question']) . '</td>';
					if($value['type']==2) {
						$html .= '<td>' . ($optionHtml) . '</td>';
					}else{
						$html .= '<td>-</td>';
					}
					if($value['type']==2) {
						$html .= '<td>' . ($listOption[$value['correct_answer']]) . '</td>';
					}else{
						$keyword=implode(',',$value['keyword']);
						$html .= '<td>'.$keyword.'</td>';
					}
					$html .= '</tr>';
				}
				$this->session->set_userdata('temp_generate', $response['data']);

				echo $html;
			} else {
				http_response_code(400);
			}
		} else {
			http_response_code(400);
		}

	}

	public function save()
	{
		$session_soal = $this->session->userdata('temp_generate');
		$this->session->unset_userdata('temp_generate');
		if (empty($session_soal)) {
			redirect(base_url('soal/generate'));
		}
		foreach ($session_soal as $item) {
			$listOption = ['A', 'B', 'C', 'D', 'E'];
			$data = array(
				'pertanyaan' => $item['question'],
				'a' => $item['options_of_answer'][0],
				'b' => $item['options_of_answer'][1],
				'c' => $item['options_of_answer'][2],
				'd' => $item['options_of_answer'][3],
				'e' => $item['options_of_answer'][4],
				'kunci_jawaban' => $listOption[$item['correct_answer']],
				'type' => $item['type'],
				'taxonomy_level'=>$item['taxonomy_level']
			);

			if($item['type']==3){
				$data['kunci_jawaban']=implode(',',$item['keyword']);

			}

			$this->m_data->insert_data($data, 'tb_soal_ujian');
		}
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-message alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Selamat, Soal berhasil dibuat!</h4>untuk melihat soal tersebut bisa anda lihat di menu <b>Daftar Soal ujian</b>.</div>');
		redirect(base_url('soal_ujian'));
	}
}
