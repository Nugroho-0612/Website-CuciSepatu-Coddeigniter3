<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Load image model
        $this->load->model('gallery');
        $this->load->model('User_model');
        $this->load->model('Services');
        $this->load->model('Shop', 'sh');
        //Load library pagination
        $this->load->library('pagination');

    }

    public function index()
    {
        $data['userall'] = $this->User_model->totalAlluser();
        // echo var_dump($data);
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');

    }

    public function gallery()
    {
        $data = array();

        $con = array(
            'where' => array(
            'status' => 1,
            ),
        );
//Config
        $config['base_url'] = 'http: //localhost/toko-sepatu/Admin/gallery
';
        $config['total_row'] = $this->User_model->countAllUser();
        $config['per_page'] = 6;
//Initialize
        $this->pagination->initialize($config);

        $data['gallery'] = $this->gallery->getImage(6, 1);
        $data['links'] = $this->pagination->create_links();

        // $data['gallery'] = $this->gallery->getRows();
        $data['title'] = 'Gallery';

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/gallery', $data);
        $this->load->view('templates/footer');

    }

    public function home()
    {

        $data['title'] = 'Home';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/home', $data);
        $this->load->view('templates/footer');

    }

    public function shop()
    {

        $data['shop'] = $this->db->get('shop')->result_array();
        $data['title'] = 'Shop';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/shop', $data);
        $this->load->view('templates/footer');

    }

    public function addItem()
    {
        $data['shop'] = $this->db->get('shop')->result_array();

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required|trim|integer');
        $this->form_validation->set_rules('harga', 'Harga', 'required|trim|integer');
        $this->form_validation->set_rules('title', 'Title', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                         Add is<strong>Faill!</strong>.
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        </div>');
            redirect('Admin/shop');

        } else {
            //cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = '100000';
                $config['upload_path'] = 'assets/img/shop/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {

                    $image = $this->upload->data('file_name');

                } else {
                    echo $this->upload->display_errors();
                }
            }
            $current_datetime = date('Y-m-d H:i:s');

            $data = [
                'name' => $this->input->post('name', true),
                'jumlah' => $this->input->post('jumlah', true),
                'harga' => $this->input->post('harga', true),
                'title' => $this->input->post('title', true),
                'created' => $current_datetime,
                'image' => $image,

            ];

            $this->sh->add($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                                        Add is <strong>Success!</strong>.
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        </div>');
            redirect('Admin/shop');

        }

    }

    public function editItem()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required|trim|integer');
        $this->form_validation->set_rules('harga', 'Harga', 'required|trim|integer');
        $this->form_validation->set_rules('title', 'Title', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                        Edit is<strong>Faill!</strong>.
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        </div>');
            redirect('Admin/shop');

        } else {
            //cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];

            if (!is_null($upload_image)) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = '100000';
                $config['upload_path'] = 'assets/img/shop/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    // Uploaded file data
                    $image = $this->upload->data('file_name');
                    $current_datetime = date('Y-m-d H:i:s');
                    $data = [
                        'name' => $this->input->post('name', true),
                        'jumlah' => $this->input->post('jumlah', true),
                        'harga' => $this->input->post('harga', true),
                        'title' => $this->input->post('title', true),
                        'modified' => $current_datetime,
                        'image' => $image,
                    ];
                    $id = $this->input->post('id', true);
                    $shop_data = $this->sh->get_id($id);
                    //Replace gambar
                    unlink('assets/img/shop/' . $shop_data['image']);

                    $this->sh->edit($id, $data);
                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                                                            Edit is <strong>Success!</strong>.
                                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                            </div>');
                    redirect('Admin/shop');

                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                                                            Edit is <strong>Faill!</strong>.
                                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                            </div>');

                    redirect('Admin/shop');

                }
            }
        }

    }

    public function deleteItem($id)
    {

        $this->sh->delete($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                                        Delete <strong>Success!</strong>.
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        </div>');
        redirect('Admin/shop');

    }

    public function services()
    {
        $data['services'] = $this->Services->viewData();

        $data['title'] = 'Sevices';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/services', $data);
        $this->load->view('templates/footer');

    }

    public function addServices()
    {
        $data['services'] = $this->db->get('services')->result_array();

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('jenis/category', 'Jenis/Category', 'required|trim');
        $this->form_validation->set_rules('title', 'Title', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                         Add is<strong>Faill!</strong>.
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        </div>');
            redirect('Admin/services');

        } else {
            //cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = '100000';
                $config['upload_path'] = 'assets/img/services/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {

                    $image = $this->upload->data('file_name');

                } else {
                    echo $this->upload->display_errors();
                }
            }
            $current_datetime = date('Y-m-d H:i:s');

            $data = [
                'name' => $this->input->post('name', true),
                'jenis_id' => $this->input->post('jenis/category', true),
                'title' => $this->input->post('title', true),
                'created' => $current_datetime,
                'image' => $image,
            ];

            $this->Services->add($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                                        Add is <strong>Success!</strong>.
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        </div>');
            redirect('Admin/services');

        }

    }

    public function deleteItemServices($id)
    {

        $this->Services->delete($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                                        Delete <strong>Success!</strong>.
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        </div>');
        redirect('Admin/services');

    }

    public function editItemServices()
    {

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('jenis/category', 'Jenis/Category', 'required|trim');
        $this->form_validation->set_rules('title', 'Title', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                        Edit is<strong>Faill!</strong>.
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        </div>');
            redirect('Admin/services');

        } else {
            $name = $this->input->post('name');
            $jenis = $this->input->post('jenis/category');
            $title = $this->input->post('title');

            //cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];

            if (!is_null($upload_image)) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = '100000';
                $config['upload_path'] = 'assets/img/services/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    // Uploaded file data
                    $image = $this->upload->data('file_name');
                    $current_datetime = date('Y-m-d H:i:s');
                    $data = [
                        'name' => $this->input->post('name', true),
                        'jenis_id' => $this->input->post('jenis/category', true),
                        'title' => $this->input->post('title', true),
                        'modified' => $current_datetime,
                        'image' => $image,
                    ];
                    $id = $this->input->post('id', true);
                    $services_data = $this->Services->get_id($id);
                    //Replace gambar
                    unlink('assets/img/services/' . $services_data['image']);

                    $this->Services->edit($id, $data);
                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                                                            Edit is <strong>Success!</strong>.
                                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                            </div>');
                    redirect('Admin/services');

                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                                                            Edit is <strong>Faill!</strong>.
                                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                            </div>');

                    redirect('Admin/services');

                }
            }
        }

    }

    public function edit()
    {
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('firstname', 'Firstname', 'required|trim');
        $this->form_validation->set_rules('lastname', 'Lastname', 'required|trim');

        if ($this->form_validation->run() == false) {

            $this->load->view('edit', $data);

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

            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                                        Page home edit <strong>Success!</strong>.
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        </div>');
            redirect('Admin/edit');

        }

    }
    // Fitur User Registrations //
    public function user_registrasi()
    {

        //Config
        $config['base_url'] = 'http: //localhost/toko-sepatu/Admin/user_registrasi
';
        $config['total_row'] = $this->User_model->countAllUser();
        $config['per_page'] = 5;

        // $config['full_tag_open'] = '<ul class="pagination pagination-sm m-t-xs m-b-xs">';
        // $config['full_tag_close'] = '</ul>';

        // $config['first_link'] = 'First';
        // $config['first_tag_open'] = '<li>';
        // $config['first_tag_close'] = '</li>';

        // $config['last_link'] = 'Last';
        // $config['last_tag_open'] = '<li>';
        // $config['last_tag_close'] = '</li>';

        // $config['next_link'] = ' <i class="glyphicon glyphicon-menu-right"></i> ';
        // $config['next_tag_open'] = '<li>';
        // $config['next_tag_close'] = '</li>';

        // $config['prev_link'] = ' <i class="glyphicon glyphicon-menu-left"></i> ';
        // $config['prev_tag_open'] = '<li>';
        // $config['prev_tag_close'] = '</li>';

        // $config['cur_tag_open'] = '<li class="active"><a href="#">';
        // $config['cur_tag_close'] = '</a></li>';

        // $config['num_tag_open'] = '<li>';
        // $config['num_tag_close'] = '</li>';

        // Initialize
        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment(3);
        $data['userall'] = $this->User_model->getUser($config['per_page'], $data['start']);
        // $data['userall'] = $this->User_model->getAllUser();
        // $data['links'] = $this->pagination->create_links();
        // echo var_dump($data['links']);
        $data['title'] = 'User Registrations';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        if ($this->input->post('keyword')) {
            $data['userall'] = $this->User_model->cariDataUser();
        }
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('admin/dashboard/user_registrasi', $data);
        $this->load->view('templates/footer');

    }

    public function edit_user()
    {
        $this->form_validation->set_rules('firstname', 'Firstname', 'required');
        $this->form_validation->set_rules('lastname', 'Lastname', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                        User edit <strong>Faill!</strong>.
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        </div>');
            redirect('Admin/user_registrasi');

        } else {
            $this->User_model->edituser();
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                                        User edit <strong>Success!</strong>.
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        </div>');
            redirect('Admin/user_registrasi');

        }
    }

    public function delete_user($id)
    {

        $this->User_model->deleteuser($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                                        Delete <strong>Success!</strong>.
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        </div>');
        redirect('Admin/user_registrasi');

    }

}