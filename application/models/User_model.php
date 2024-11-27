<?php
class User_model extends CI_Model
{

    public function Is_already_register($email)
    {

        $query = $this->db->get_where('user', ['email' => $email]);
        return $query->row_array();

        // $this->db->where('email', $email);
        // // // $this->db->where('email', $email);
        // $query = $this->db->get('user');
        // return $query->row_array();

        // // if ($query->num_rows() > 0) {
        // //     return true;
        // // } else {
        // //     return false;
        // // }
    }

    // public function Update_user_data($data, $id)
    // {
    //     $this->db->where('login_oauth_uid', $id);
    //     $this->db->update('user', $data);
    // }

    // public function Insert_user_data($data)
    // {
    //     $this->db->insert('user', $data);
    // }

    public function getAllUser()
    {
        return $this->db->get('user')->result_array();

    }

    public function getUser($limit, $start)
    {
        return $this->db->get('user', $limit, $start)->result_array();

    }

    public function countAllUser()
    {
        return $this->db->get('user')->num_rows();
    }

    public function totalAlluser()
    {
        $query = $this->db->get('user');
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }

    }

    public function deleteuser($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user');
    }

    public function edituser()
    {
        $data = [
            'first_name' => $this->input->post('firstname', true),
            'last_name' => $this->input->post('lastname', true),
            'email' => $this->input->post('email', true),
            'role_id' => $this->input->post('role_id', true),
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('user', $data);

    }

    public function cariDataUser()
    {
        $keyword = $this->input->post('keyword', true);
        $this->db->like('first_name', $keyword);
        $this->db->or_like('last_name', $keyword);
        $this->db->or_like('email', $keyword);
        $this->db->or_like('role_id', $keyword);
        return $this->db->get('user')->result_array();
    }

    // public function detailuser($id)
    // {
    //     return $this->db->get_where('user', ['id' => $id])->row_array();
    // }
}
