<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Load image model
        $this->load->model('gallery');
        // $this->load->model('User_model');

        // // Default controller name
        // $this->controller = 'gallery';
    }

    public function index()
    {

        $data = array();

        $con = array(
            'where' => array(
                'status' => 1,
            ),
        );

        $data['gallery'] = $this->gallery->getRows();
        $data['shop'] = $this->db->get('shop')->result_array();
        $data['title'] = 'Sneacare.ID';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('user/index', $data);
        // echo var_dump($data);
    }

    public function edit()
    {
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('firstname', 'Firstname', 'required|trim');
        $this->form_validation->set_rules('lastname', 'Lastname', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('edit-user', $data);

        } else {
            $firstname = $this->input->post('firstname');
            $lastname = $this->input->post('lastname');
            $email = $this->input->post('email');

            //cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '2048';
                $config['upload_path'] = './assets/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {

                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.png') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('first_name', $firstname);
            $this->db->set('last_name', $lastname);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your profile has been updated!</div>');
            redirect('User/edit');

        }

    }

    public function checkout()
    {

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('user/checkout', $data);

    }
}