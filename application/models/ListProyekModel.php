<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ListProyekModel extends CI_Model
{
    public function getListProyek()
    {
        $this->db->select('*');
        $this->db->from('proyek');
        $query = $this->db->get();
        return $query->result();
    }
    public function getProyek($id)
    {
        $this->db->select('*');
        $this->db->from('proyek');
        $this->db->where('id_proyek', $id);
        $query = $this->db->get();
        return $query->first_row();
    }
}