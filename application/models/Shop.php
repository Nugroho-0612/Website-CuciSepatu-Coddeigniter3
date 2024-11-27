<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');

}
date_default_timezone_set("Asia/Jakarta");

class Shop extends CI_Model
{

    public function get_id($id = null)
    {
        $this->db->select('image');
        $this->db->where('id', $id);
        $query = $this->db->get('shop');
        return $query->row_array();

    }

    public function add($data)
    {

        $current_datetime = date('Y-m-d H:i:s');

        if (!empty($data)) {
            // Add created and modified date if not included
            if (!array_key_exists("created", $data)) {
                $data['created'] = $current_datetime;
            }
            if (!array_key_exists("modified", $data)) {
                $data['modified'] = $current_datetime;
            }

            // Insert member data
            $insert = $this->db->insert('shop', $data);

            // Return the status
            return $insert ? $this->db->insert_id() : false;
        }
        return false;
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('shop');
    }

    public function edit($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('shop', $data);

    }

}
