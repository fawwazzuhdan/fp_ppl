<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ListProyekController extends CI_Controller {
    public function __construct()
    {
		parent::__construct();
        $this->load->model('ListProyekModel');
    }
    public function show_listProyek()
    {
        $data['listproyek'] = $this->ListProyekModel->getListProyek();
        $this->load->view('listproyek', $data);
    }
    public function show_formInputData()
    {
        $this->load->view('form_input_proyek');
    }
    public function save_proyek()
    {
        $insert_data = [
            'nama_proyek' => $this->input->post('namaproyek'),
            'lokasi_proyek' => $this->input->post('lokasiproyek'),
        ];
        try {
            $this->db->insert('proyek', $insert_data);
            $this->session->set_flashdata('message', array('type' => 'success', 'message' => 'Sukses Menambah Proyek'));
            return redirect(base_url('ListProyekController/show_listProyek'));
        } catch (Exception $e) {
            $this->session->set_flashdata('message', array('type' => 'error', 'message' => validation_errors()));
            return redirect(base_url('ListProyekController/show_formInputData'));
        }
    }
    public function get_ListProyek($id)
    {
        $proyek = $this->ListProyekModel->getProyek($id);
        $this->load->view('proyek', $proyek);
    }
    public function edit_ListProyek($id)
    {
        $proyek = $this->ListProyekModel->getProyek($id);
        $this->load->view('editproyek', $proyek);
    }
    public function delete_ListProyek($id)
    {
        $this->db->where('id_proyek', $id);
        try{
            $this->db->delete('proyek');
        }catch(Exception $e){
            return false;
        }
        $this->session->set_flashdata('message', array('type' => 'success', 'message' => 'Proyek Berhasil Dihapus'));
        return redirect(base_url('ListProyekController/show_listProyek'));
    }
    public function update_ListProyek()
    {
        $idproyek = $this->input->post('idproyek');
        $insert_data = [
            'nama_proyek' => $this->input->post('namaproyek'),
            'lokasi_proyek' => $this->input->post('lokasiproyek'),
        ];
        try{
            $this->db->where('id_proyek',$idproyek);
            $this->db->update('proyek', $insert_data);
        }catch(Exception $e)
        {
            return false;
        }
        $this->session->set_flashdata('message', array('type' => 'success', 'message' => 'Sukses Mengedit Proyek'));
        return redirect(base_url('ListProyekController/get_ListProyek/'.$idproyek));
    }
}