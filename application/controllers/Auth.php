<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		// Load Model
		$this->load->model('user_model');
		$this->load->model('gallery');
		$this->load->model('Shop', 'sh');
		$this->load->model('Services');

		// Load helper
		$this->load->helper(array('form', 'url'));
		// Load Library
		$this->load->library('form_validation', 'session');
		require_once APPPATH . 'third_party/src/Google_Client.php';
		require_once APPPATH . 'third_party/src/contrib/Google_Oauth2Service.php';
	}

	public function index()
	{
		$data = array();

		$con = array(
			'where' => array(
				'status' => 1,
			),
		);
		//Menampilkan Data Shop
		$data['shop'] = $this->db->get('shop')->result_array();
		//Menampilkan Data Gallery
		$data['gallery'] = $this->gallery->getRows();
		//Menampilkan Data Service berdasarkan Jenis/Category
		$data['clean'] = $this->Services->getCleanData();
		$data['repaint'] = $this->Services->getRepaintData();
		$data['other'] = $this->Services->getBagANDCapTreatmentData();
		//Load page view
		$this->load->view('index', $data);
	}

	public function detail_services()
	{
		//Load page view
		$this->load->view('detail-services');
	}

	public function register()
	{
		//validasi form username, email, password

		if ($this->session->userdata('email')) {

			redirect('user');
		}

		$this->form_validation->set_rules('firstname', 'Firstname', 'required|trim');
		$this->form_validation->set_rules('lastname', 'Lastname', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
			'is_unique' => 'This email has already registrasi!'
		]);
		$this->form_validation->set_rules('password', 'Password', 'required|trim');

		$current_datetime = date('Y-m-d H:i:s');

		if ($this->form_validation->run() == false) {
			$this->load->view('sign-up');

			//memasukan inputan data ke database
		} else {
			$data = [
				'first_name' => htmlspecialchars($this->input->post('firstname', true)),
				'last_name' => htmlspecialchars($this->input->post('lastname', true)),
				'email' => htmlspecialchars($this->input->post('email', true)),
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'image' => 'default.png',
				'role_id' => 2,
				'date_create' => $current_datetime,
			];
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                                        Registrasi is <strong>Success!</strong>.
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        </div>');
			$this->db->insert('user', $data);
			redirect('Auth/login');
		}
	}

	public function login()
	{
		if ($this->session->userdata('email')) {

			redirect('user');
		}

		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		if ($this->form_validation->run() == false) {
			$this->load->view('sign-in');
		} else {
			//validasinya success
			$this->_login();
		}
	}

	private function _login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$user = $this->db->get_where('user', ['email' => $email])->row_array();

		//jika usernya ada
		if ($user) {
			//cek password
			if (password_verify($password, $user['password'])) {
				$data = [
					'email' => $user['email'],
					'role_id' => $user['role_id'],
				];
				$this->session->set_userdata($data);
				if ($user['role_id'] == 1) {
					redirect('Admin');
				} else {
					redirect('User');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password</div>');
				redirect('Auth/login');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not Registrasi!</div>');
			redirect('Auth/login');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role_id');
		redirect('Auth');
	}

	public function login_google()
	{

		$clientId = ''; //Google client ID
		$clientSecret = ''; //Google client secret
		$redirectURL = base_url() . 'Auth/login_google';

		//https://curl.haxx.se/docs/caextract.html

		//Call Google API
		$gClient = new Google_Client();
		$gClient->setApplicationName('Login');
		$gClient->setClientId($clientId);
		$gClient->setClientSecret($clientSecret);
		$gClient->setRedirectUri($redirectURL);
		$google_oauthV2 = new Google_Oauth2Service($gClient);
		if (isset($_GET['code'])) {
			$gClient->authenticate($_GET['code']);
			$_SESSION['token'] = $gClient->getAccessToken();

			header('Location: ' . filter_var($redirectURL, FILTER_SANITIZE_URL));
		}

		if (isset($_SESSION['token'])) {
			$gClient->setAccessToken($_SESSION['token']);
		}

		if ($gClient->getAccessToken()) {
			$userProfile = $google_oauthV2->userinfo->get();
			$current_datetime = date('Y-m-d H:i:s');
			$user = $this->user_model->Is_already_register($userProfile['email']);

			//jika usernya ada
			if ($user) {
				// jika usernya aktif

				$data = [
					'email' => $userProfile['email'],
					'role_id' => $user['role_id'],
				];
				$this->session->set_userdata($data);
				if ($user['role_id'] == 1) {
					redirect('Admin');
				} else {
					redirect('User');
				}
			} else {

				$data = array(
					'first_name' => $userProfile['given_name'],
					'last_name' => $userProfile['family_name'],
					'email' => $userProfile['email'],
					'image' => $userProfile['picture'],
					'role_id' => 2,
					'date_create' => $current_datetime,
				);

				$this->db->insert('user', $data);
				$this->session->set_userdata($data);

				redirect('User');
			}
		} else {
			$url = $gClient->createAuthUrl();
			header("Location: $url");
			exit;
		}
	}
}
