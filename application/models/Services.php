 <?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');

}
date_default_timezone_set("Asia/Jakarta");
class Services extends CI_Model
{
    public function viewData()
    {
        $this->db->order_by('id', 'ASC');
        return $this->db->from('services')
            ->join('jenis_service', 'jenis_service.jenis_id=services.jenis_id')
            ->get()
            ->result_array();

    }

    public function get_id($id = null)
    {
        $this->db->select('image');
        $this->db->where('id', $id);
        $query = $this->db->get('services');
        return $query->row_array();

    }

    public function getCleanData()
    {
        $this->db->where('jenis_id = 1');
        $query = $this->db->get('services');
        return $query->result_array();

    }

    public function getRepaintData()
    {
        $this->db->where('jenis_id = 2');
        $query = $this->db->get('services');
        return $query->result_array();

    }

    public function getBagANDCapTreatmentData()
    {
        $this->db->where('jenis_id = 3');
        $query = $this->db->get('services');
        return $query->result_array();

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
            $insert = $this->db->insert('services', $data);

            // Return the status
            return $insert ? $this->db->insert_id() : false;
        }
        return false;
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('services');
    }

    public function edit($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('services', $data);

    }

}