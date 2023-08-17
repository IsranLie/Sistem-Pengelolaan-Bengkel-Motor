<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MonitoringData extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MonitoringData_model');
    }

    // DATA LAPORAN //
    public function index()
    {
        $data['title'] = 'Laporan';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $data['data_laporan'] = $this->MonitoringData_model->get_laporan();

        if ($this->input->post('keyword')) {
            $data['data_laporan'] = $this->MonitoringData_model->search_laporan();
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('MonitoringData/index', $data);
        $this->load->view('templates/footer');
    }
    // END DATA LAPORAN //

    // DATA BARANG //
    public function barang()
    {
        $data['title'] = 'Barang';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $data['data_barang'] = $this->MonitoringData_model->get_barang();

        if ($this->input->post('keyword')) {
            $data['data_barang'] = $this->MonitoringData_model->search_barang();
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('MonitoringData/barang', $data);
        $this->load->view('templates/footer');
    }

    public function barang_tambah()
    {
        $data['title'] = 'Tambah data barang';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $data['no_faktur'] = $this->MonitoringData_model->auto_nofaktur();
        $data['id_brg'] = $this->MonitoringData_model->auto_idbarang();
        $data['data_pemasok'] = $this->MonitoringData_model->get_pemasok();

        $this->form_validation->set_rules('id_pemasok', 'Pemasok', 'required');
        $this->form_validation->set_rules('nm_brg', 'Nama Barang', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('MonitoringData/barang_tambah', $data);
            $this->load->view('templates/footer');
        } else {
            $barang = [
                'id_brg' => $this->input->post('id_brg'),
                'nm_brg' => $this->input->post('nm_brg'),
                'stok' => $this->input->post('jumlah'),
                'harga_brg' => $this->input->post('harga')
            ];
            $faktur = [
                'no_faktur' => $this->input->post('no_faktur'),
                'tgl' => Date('Y-m-d h:i:s'),
                'id_pemasok' => $this->input->post('id_pemasok'),
                'id_brg' => $this->input->post('id_brg'),
                'harga_brg' => $this->input->post('harga'),
                'jumlah' => $this->input->post('jumlah'),
                'total_faktur' => $this->input->post('harga') * $this->input->post('jumlah')
            ];
            $this->db->insert('barang', $barang);
            $this->db->insert('faktur', $faktur);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Data Barang berhasil ditambahkan!</div>');
            redirect('MonitoringData/barang');
        }
    }

    public function barang_ubah($id)
    {
        $data['title'] = 'Ubah data barang';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $data['no_faktur'] = $this->MonitoringData_model->auto_nofaktur();
        $data['ubah_barang'] = $this->MonitoringData_model->get_barangId($id);
        $data['data_pemasok'] = $this->MonitoringData_model->get_pemasok();

        $this->form_validation->set_rules('id_pemasok', 'Pemasok', 'required');
        $this->form_validation->set_rules('nm_brg', 'Nama Barang', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('MonitoringData/barang_ubah', $data);
            $this->load->view('templates/footer');
        } else {
            $this->MonitoringData_model->ubah_barang();
            $faktur = [
                'no_faktur' => $this->input->post('no_faktur'),
                'tgl' => Date('Y-m-d h:i:s'),
                'id_pemasok' => $this->input->post('id_pemasok'),
                'id_brg' => $this->input->post('id_brg'),
                'harga_brg' => $this->input->post('harga'),
                'jumlah' => $this->input->post('jumlah'),
                'total_faktur' => $this->input->post('harga') * $this->input->post('jumlah')
            ];
            $this->db->insert('faktur', $faktur);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Data barang berhasil diperbarui!</div>');
            redirect('MonitoringData/barang');
        }
    }

    public function barang_hapus($id)
    {
        $db = new mysqli("localhost", "root", "", "db_bengkel");
        $faktur = mysqli_query($db, "DELETE FROM faktur WHERE id_brg = '$id'");

        if ($faktur) {
            $barang = mysqli_query($db, "DELETE FROM barang WHERE id_brg = '$id'");
            if ($barang) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Data Barang telah terhapus!</div>');
                redirect('MonitoringData/barang');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-circle"></i> Gagal! Data ini terpakai pada Data Servis.</div>');
                redirect('MonitoringData/barang');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-circle"></i> Gagal!</div>');
            redirect('MonitoringData/barang');
        }
    }
    // END DATA BARANG //
}
