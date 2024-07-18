<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class chat extends CI_Controller {

    private $authorization = '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';
    private $endpoint = 'https://api.openai.com/v1/chat/completions';

	public function __construct() {
		parent::__construct();

		//cek session yang login, jika session status tidak sama dengan session admin_login,maka halaman akan di alihkan kembali ke halaman login.
		if ($this->session->userdata('status') !='siswa_login') {
			redirect(base_url().'auth?alert=belum_login');
		}
		
	}

	public function index()
	{
		$this->load->view('siswa/v_chat');
	}

	public function request(){
		$paramsFetch = json_decode(
			file_get_contents("php://input"),
			true
		);

		$folder_path = "text/";
		$textContext='';

		$materi = $this->m_data->get_data('tb_materi')->result();
		$content='';
		foreach ($materi as $item){
			$path=FCPATH.'/uploads/text/'.$item->txt_materi;
			$textContext.=file_get_contents($path);

		}

		// Prepare data for sending
		$data = [
			'messages' => [
				[
					'role' => 'system',
					'content' => 'If the user asks anything, answer based only on the following context: ' . $textContext
				],
				[
					'role' => 'user',
					'content' => $paramsFetch["message"]
				],
			],
			'model' => 'gpt-3.5-turbo'
		];


		// Set headers for the API request
		$headers = [
			'Content-Type: application/json',
			'Authorization: Bearer ' . $this->authorization,
		];

		// Send the request to the API using cURL
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->endpoint);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);

		// Check for errors in the API response
		if (curl_errno($ch)) {
			$error = curl_error($ch);
			curl_close($ch);
			throw new Exception('Error sending the message: ' . $error);
		}

		curl_close($ch);

		// Parse the API response
		$arrResult = json_decode($response, true);
		$resultMessage = $arrResult["choices"][0]["message"]["content"];

		// Return the response message

		$resMessage = $resultMessage;

		$jsonResponse = json_encode(array("responseMessage" => $resMessage));
		echo $jsonResponse;
	}


}

