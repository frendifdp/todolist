<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class M_todo extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function get()
    {
        return $this->db->order_by('id DESC')->get('item')->result();
    }

    public function post()
    {
        $data['list'] = $this->input->post('list');
        $data['status'] = 0;
        $data['id_category'] = 1;
        return $this->db->insert('item', $data);
    }

    public function put()
    {
        $id = $this->input->post('id');
        $data['list'] = $this->input->post('list_new');
        $data['id_category'] = 1;
        return $this->db->where('id', $id)->update('item', $data);
    }

    public function put_status()
    {
        $id = $this->input->post('id');
        $data['status'] = $this->input->post('status');
        $data['id_category'] = 1;
        return $this->db->where('id', $id)->update('item', $data);
    }

    public function delete()
    {
        $id = $this->input->post('id');
        return $this->db->where('id', $id)->delete('item');
    }
}
                        
/* End of file M_todo.php */
    
                        