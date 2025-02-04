<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');

}
date_default_timezone_set("Asia/Jakarta");

class Gallery extends CI_Model
{

    public function __construct()
    {
        $this->table = 'gallery';
    }

    /*
     * Returns rows from the database based on the conditions
     * @param array filter data based on the passed parameters
     */
    public function getRows($params = array())
    {
        $this->db->select('*');
        $this->db->from($this->table);

        if (array_key_exists("where", $params)) {
            foreach ($params['where'] as $key => $val) {
                $this->db->where($key, $val);
            }
        }

        if (array_key_exists("returnType", $params) && $params['returnType'] == 'count') {
            $result = $this->db->count_all_results();
        } else {
            if (array_key_exists("id", $params)) {
                $this->db->where('id', $params['id']);
                $query = $this->db->get();
                $result = $query->row_array();
            } else {
                $this->db->order_by('created', 'desc');
                if (array_key_exists("start", $params) && array_key_exists("limit", $params)) {
                    $this->db->limit($params['limit'], $params['start']);
                } elseif (!array_key_exists("start", $params) && array_key_exists("limit", $params)) {
                    $this->db->limit($params['limit']);
                }

                $query = $this->db->get();
                $result = ($query->num_rows() > 0) ? $query->result_array() : false;
            }
        }

        // Return fetched data
        return $result;
    }

    public function getImage($limit, $start)
    {
        return $this->db->get('gallery', $limit, $start)->result_array();

    }

    /*
     * Insert image data into the database
     * @param $data data to be insert based on the passed parameters
     */
    public function insert($data = array())
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
            $insert = $this->db->insert($this->table, $data);

            // Return the status
            return $insert ? $this->db->insert_id() : false;
        }
        return false;
    }

    /*
     * Update image data into the database
     * @param $data array to be update based on the passed parameters
     * @param $id num filter data
     */
    public function update($data, $id)
    {
        if (!empty($data) && !empty($id)) {
            // Add modified date if not included
            if (!array_key_exists("modified", $data)) {
                $data['modified'] = date("Y-m-d H:i:s");
            }

            // Update member data
            $update = $this->db->update($this->table, $data, array('id' => $id));

            // Return the status
            return $update ? true : false;
        }
        return false;
    }

    /*
     * Delete image data from the database
     * @param num filter data based on the passed parameter
     */
    public function delete($id)
    {
        // Delete member data
        $delete = $this->db->delete($this->table, array('id' => $id));

        // Return the status
        return $delete ? true : false;
    }

}
