<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ruang_ujian extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status') != 'siswa_login') {
			redirect(base_url() . 'auth?alert=belum_login');
		}
	}

	private function countArrayInString($array, $string) {
		$count = 0;
		foreach ($array as $element) {
			if (strpos($string, $element) !== false) {
				$count++;
			}
		}
		return $count;
	}

	public function soal()
	{
		$id_peserta = $this->uri->segment(3);
		$id = $this->db->query('SELECT * FROM tb_peserta WHERE id_peserta="' . $id_peserta . '"  ')->row_array();
		$soal_ujian = $this->db->query('SELECT * FROM tb_soal_ujian ORDER BY RAND()');
		$where = array('id_peserta' => $id_peserta);
		$data2 = array('status_ujian_ujian' => 1);
		$this->m_data->update_data($where, $data2, 'tb_peserta');
		$time = $id['timer_ujian'];
		$data = array(
			"soal" => $soal_ujian->result(),
			"total_soal" => $soal_ujian->num_rows(),
			"max_time" => $time,
			"id" => $id
		);
		$this->load->view('ujian/v_soalujian', $data);
	}

	public function jawab_aksi()
	{
		$totalScore=0;
		$id_peserta = $this->input->post('id_peserta');
		$jumlah = $_POST['jumlah_soal'];
		$id_soal = $_POST['soal'];
		$jawaban = $_POST['jawaban'];
		for ($i = 0; $i < $jumlah; $i++) {
			$nomor = $id_soal[$i];
			$jawaban[$nomor];
			$data[] = array(
				'id_peserta' => $id_peserta,
				'id_soal_ujian' => $nomor,
				'jawaban' => $jawaban[$nomor]
			);
		}
		$this->db->insert_batch('tb_jawaban', $data);
		$cek = $this->db->query('SELECT id_jawaban, jawaban, tb_soal_ujian.kunci_jawaban,tb_soal_ujian.type FROM tb_jawaban join tb_soal_ujian ON tb_jawaban.id_soal_ujian=tb_soal_ujian.id_soal_ujian WHERE id_peserta="' . $id_peserta . '"');

		$jumlah = $cek->num_rows();
		foreach ($cek->result_array() as $d) {
			$where = $d['id_jawaban'];
			if ($d['type'] != 3) {
				$totalScore++;
				if ($d['jawaban'] == $d['kunci_jawaban']) {
					$data = array(
						'skor' => 1,
					);
					$this->m_data->UpdateNilai($where, $data, 'tb_jawaban');
				} else {
					$data = array(
						'skor' => 0,
					);
					$this->m_data->UpdateNilai($where, $data, 'tb_jawaban');
				}
			} else {
				$keyword=explode(',',$d['kunci_jawaban']);

				$cekbykeyword=$this->countArrayInString($keyword, $d['jawaban']);
				if($cekbykeyword>4){
					$totalScore = $totalScore + 5;
					$data = array(
						'skor' =>5,
					);
					$this->m_data->UpdateNilai($where, $data, 'tb_jawaban');
				}else {
					$data = array(
						'skor' => 0,
					);
					$this->m_data->UpdateNilai($where, $data, 'tb_jawaban');
				}
			}
		}
		$benar = 0;
		$salah = 0;
		$total_nilai = 0;
		$cek2 = $this->db->query('SELECT id_jawaban, jawaban, skor, tb_soal_ujian.kunci_jawaban,tb_soal_ujian.type,tb_soal_ujian.pertanyaan FROM tb_jawaban join tb_soal_ujian ON tb_jawaban.id_soal_ujian=tb_soal_ujian.id_soal_ujian WHERE id_peserta="' . $id_peserta . '"');
		$jumlah = $cek2->num_rows();
		$where = $id_peserta;

		$soalEssi = [];

		foreach ($cek2->result_array() as $c) {
			if ($c['type'] != 3) {
				if ($c['jawaban'] == $c['kunci_jawaban']) {
					$benar++;
				} else {
					$salah++;
				}
			} else {
				$keyword=explode(',',$c['kunci_jawaban']);

				$cekbykeyword=$this->countArrayInString($keyword, $c['jawaban']);

				if($cekbykeyword>4){
					$benar++;
				}else {
					$soalEssi[] = [
						'question_id' => $c['id_jawaban'],
						'question' => trim(strip_tags($c['pertanyaan'])),
						'answer' => $c['jawaban'],
					];
				}
			}
		}


		if (!empty($soalEssi)) {
			$sendData['questions'] = $soalEssi;

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


			$curl = curl_init();

			$post = [
				'soal' => $sendData,
				'materi' => base_url('/uploads/final/' . $fileName)
			];

			curl_setopt_array($curl, array(
				CURLOPT_URL => 'http://127.0.0.1:5300/check',
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => '',
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 120,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => 'POST',
				CURLOPT_POSTFIELDS => json_encode($post),
				CURLOPT_HTTPHEADER => array(
					'Content-Type: application/json'
				),
			));

			$response = curl_exec($curl);
			curl_close($curl);
			if (!empty($response)) {
				$response = json_decode($response, true);
				if (!empty($response['data'])) {
					foreach ($response['data'] as $key => $value) {

						$wheres = $value['question_id'];
						if($value['evaluation']) {
							$data = array(
								'skor' => 5,
							);
							$this->m_data->UpdateNilai($wheres, $data, 'tb_jawaban');
							$totalScore = $totalScore + 5;
							$benar++;
						}else{
							$salah++;
						}
					}
				}
			}
		}

		$total_nilai += $c['skor'] / $totalScore * 100;

		$data = array(
			'benar' => $benar,
			'salah' => $salah,
			'status_ujian' => 2,
			'status_ujian_ujian' => 2,
			'nilai' => $total_nilai
		);



		$this->m_data->UpdateNilai2($where, $data, 'tb_peserta');
		redirect(base_url('jadwal_ujian'));
	}


}
