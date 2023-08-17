<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ManajemenData extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ManajemenData_model');
        $this->load->library('pdf');
    }

    // DATA SERVICE //
    public function index()
    {
        $data['title'] = 'Servis';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $data['data_servis'] = $this->ManajemenData_model->get_servis();

        if ($this->input->post('keyword')) {
            $data['data_servis'] = $this->ManajemenData_model->search_servis();
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ManajemenData/index', $data);
        $this->load->view('templates/footer');
    }

    public function servis_tambah()
    {
        $data['title'] = 'Tambah data servis';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $data['barang'] = $this->ManajemenData_model->get_barang();
        $data['id_servis'] = $this->ManajemenData_model->auto_idservis();
        $data['id_pelanggan'] = $this->ManajemenData_model->auto_idpelanggan();

        $this->form_validation->set_rules('nm_pelanggan', 'Nama Pelanggan', 'required');
        $this->form_validation->set_rules('noTlp', 'No. Telepon', 'required');
        $this->form_validation->set_rules('merk', 'Merk Kendaraan', 'required');
        $this->form_validation->set_rules('no_plat', 'No. Plat', 'required');
        $this->form_validation->set_rules('keluhan', 'Keluhan', 'required');
        // $this->form_validation->set_rules('nm_mekanik', 'Nama Mekanik', 'required');
        // $this->form_validation->set_rules('id_brg', 'ID Barang', 'required');
        // $this->form_validation->set_rules('nm_brg', 'Nama Barang', 'required');
        // $this->form_validation->set_rules('harga', 'Harga', 'required');
        // $this->form_validation->set_rules('jumlah', 'Jumlah', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('ManajemenData/servis_tambah', $data);
            $this->load->view('templates/footer');
        } else {
            // $servis = [
            //     'id_servis' => $this->input->post('id_servis'),
            //     'tgl' => Date('Y-m-d h:i:s'),
            //     'id_pelanggan' => $this->input->post('id_pelanggan'),
            //     'nm_pelanggan' => $this->input->post('nm_pelanggan'),
            //     'noTlp_pelanggan' => $this->input->post('noTlp'),
            //     'merk_kendaraan' => $this->input->post('merk'),
            //     'no_plat' => $this->input->post('no_plat'),
            //     'keluhan' => $this->input->post('keluhan'),
            //     'nm_mekanik' => $this->input->post('nm_mekanik'),
            //     'id_brg' => $this->input->post('id_brg'),
            //     'nm_brg' => $this->input->post('nm_brg'),
            //     'harga_brg' => $this->input->post('harga'),
            //     'jumlah_brg' => $this->input->post('jumlah')
            // ];
            $pelanggan = [
                'id_pelanggan' => $this->input->post('id_pelanggan'),
                'nm_pelanggan' => $this->input->post('nm_pelanggan'),
                'noTlp_pelanggan' => $this->input->post('noTlp')
            ];
            $this->db->insert('pelanggan', $pelanggan);

            $this->db->set('id_servis', $this->input->post('id_servis'));
            $this->db->set('tgl', Date('Y-m-d H:i:s'));
            $this->db->set('id_pelanggan', $this->input->post('id_pelanggan'));
            $this->db->set('nm_pelanggan', $this->input->post('nm_pelanggan'));
            $this->db->set('noTlp_pelanggan', $this->input->post('noTlp'));
            $this->db->set('merk_kendaraan', $this->input->post('merk'));
            $this->db->set('no_plat', $this->input->post('no_plat'));
            $this->db->set('keluhan', $this->input->post('keluhan'));
            $this->db->insert('servis');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Data Servis berhasil ditambahkan!</div>');
            redirect('ManajemenData');
        }
    }

    public function servis_ekspor($id)
    {
        $db = new mysqli("localhost", "root", "", "db_bengkel");
        if ($db->errno == 0) {
            $servis = $this->ManajemenData_model->get_servisId($id);
            $pdf = new FPDF('P', 'mm', 'Letter');
            $pdf->AddPage();

            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(0, 10, 'DOKUMEN SERVIS', 0, 1, 'C');
            $pdf->Cell(0, 5, 'AHAYY', 0, 1, 'C');
            $pdf->Image('assets/img/login/ahayy-rounded.png', 10, 5, -300);
            $pdf->Cell(0, 7, '', 0, 1);

            $pdf->Line(10, 30, 200, 30);
            $pdf->Ln(5);
            $pdf->SetFont('Arial', '', 11);

            $pdf->Cell(30, 10, 'ID Servis', 0, 0,);
            $pdf->Cell(90, 10, ' : ' . $servis['id_servis'], 0, 0);
            $pdf->Cell(30, 10, 'Tanggal', 0, 0);
            $pdf->Cell(30, 10, ' : ' . $servis['tgl'], 0, 1);
            $pdf->Cell(30, 10, 'Nama Mekanik', 0, 0);
            $pdf->Cell(50, 10, ' : ' . $servis['nm_mekanik'], 0, 1);

            $pdf->Ln(5);
            $pdf->Cell(30, 10, 'ID Pelanggan', 0, 0);
            $pdf->Cell(90, 10, ' : ' . $servis['id_pelanggan'], 0, 0);
            $pdf->Cell(30, 10, 'ID Barang', 0, 0);
            $pdf->Cell(30, 10, ' : ' . $servis['id_brg'], 0, 1);

            $pdf->Cell(30, 10, 'Nama Pelanggan', 0, 0);
            $pdf->Cell(90, 10, ' : ' . $servis['nm_pelanggan'], 0, 0);
            $pdf->Cell(30, 10, 'Nama Barang', 0, 0);
            $pdf->Cell(30, 10, ' : ' . $servis['nm_brg'], 0, 1);

            $pdf->Cell(30, 10, 'No. Telepon', 0, 0);
            $pdf->Cell(90, 10, ' : ' . $servis['noTlp_pelanggan'], 0, 0);
            $pdf->Cell(30, 10, 'Harga', 0, 0);
            $pdf->Cell(30, 10, ' : Rp ' . number_format($servis['harga_brg'], 0, ',', '.'), 0, 1);

            $pdf->Cell(30, 10, 'Merk Kendaraan', 0, 0);
            $pdf->Cell(90, 10, ' : ' . $servis['merk_kendaraan'], 0, 0);
            $pdf->Cell(30, 10, 'Jumlah', 0, 0);
            $pdf->Cell(30, 10, ' : ' . $servis['jumlah_brg'], 0, 1);

            $pdf->Cell(30, 10, 'No. Plat', 0, 0);
            $pdf->Cell(30, 10, ' : ' . $servis['no_plat'], 0, 1);
            $pdf->Cell(30, 10, 'Keluhan', 0, 0);
            $pdf->Cell(30, 10, ' : ' . $servis['keluhan'], 0, 1);

            $pdf->Output('dokumen-servis-' . $servis['id_servis'] . '.pdf', 'I');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-circle"></i> Gagal koneksi database!</div>');
            redirect('ManajemenData');
        }
    }

    public function servis_ubah($id)
    {
        $data['title'] = 'Ubah data servis';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $data['ubah_servis'] = $this->ManajemenData_model->get_servisId($id);
        $data['barang'] = $this->ManajemenData_model->get_barang();

        $this->form_validation->set_rules('nm_pelanggan', 'Nama Pelanggan', 'required');
        $this->form_validation->set_rules('noTlp', 'No. Telepon', 'required');
        $this->form_validation->set_rules('merk', 'Merk Kendaraan', 'required');
        $this->form_validation->set_rules('no_plat', 'No. Plat', 'required');
        $this->form_validation->set_rules('keluhan', 'Keluhan', 'required');
        $this->form_validation->set_rules('nm_mekanik', 'Nama Mekanik', 'required');
        $this->form_validation->set_rules('id_brg', 'Nama Barang', 'required');
        // $this->form_validation->set_rules('nm_brg', 'Nama Barang', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required');
        $this->form_validation->set_rules('jumlah', 'Jumlah Barang', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('ManajemenData/servis_ubah', $data);
            $this->load->view('templates/footer');
        } else {
            $id_barang = $this->input->post('id_brg');
            $jumlah = $this->input->post('jumlah');
            $query = $this->db->get_where('barang', ['id_brg' => $id_barang])->row_array();

            if ($jumlah > $query['stok']) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-circle"></i> Gagal, jumlah barang melampaui ketersediaan!</div>');
                redirect('ManajemenData');
            } else {
                $this->ManajemenData_model->ubah_servis();
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Data Servis berhasil diperbarui!</div>');
                redirect('ManajemenData');
            }
        }
    }

    public function servis_detail($id)
    {
        $data['title'] = 'Detail data servis';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $data['detail_servis'] = $this->ManajemenData_model->get_servisId($id);

        $db = new mysqli("localhost", "root", "", "db_bengkel");
        if ($db->errno == 0) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('ManajemenData/servis_detail', $data);
            $this->load->view('templates/footer');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-circle"></i> Gagal koneksi database!</div>');
            redirect('ManajemenData');
        }
    }

    public function servis_hapus($id)
    {
        $db = new mysqli("localhost", "root", "", "db_bengkel");
        $row = mysqli_query($db, "DELETE FROM servis WHERE id_pelanggan = '$id'");

        if ($row) {
            $this->db->delete('pelanggan', ['id_pelanggan' => $id]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Data Servis telah terhapus!</div>');
            redirect('ManajemenData');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-circle"></i> Gagal! Data ini terpakai pada Data Pembayaran.</div>');
            redirect('ManajemenData');
        }
    }
    // END DATA SERVICE //

    // DATA PEMBAYARAN //
    public function pembayaran()
    {
        $data['title'] = 'Pembayaran';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $data['data_pembayaran'] = $this->ManajemenData_model->get_pembayaran();

        if ($this->input->post('keyword')) {
            $data['data_pembayaran'] = $this->ManajemenData_model->search_pembayaran();
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ManajemenData/pembayaran', $data);
        $this->load->view('templates/footer');
    }

    public function pembayaran_tambah()
    {
        $data['title'] = 'Tambah data pembayaran';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $data['no_nota'] = $this->ManajemenData_model->auto_nonota();

        $this->form_validation->set_rules('id_servis', 'ID Servis', 'required');
        $this->form_validation->set_rules('nm_mekanik', 'Nama Mekanik', 'required');
        $this->form_validation->set_rules('nm_brg', 'Nama Barang', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required|trim');
        $this->form_validation->set_rules('jasa', 'Harga Jasa', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('ManajemenData/pembayaran_tambah', $data);
            $this->load->view('templates/footer');
        } else {
            $pembayaran = [
                'no_nota' => $this->input->post('no_nota'),
                'tgl' => Date('Y-m-d H:i:s'),
                'nm_admin' => $this->input->post('nm_admin'),
                'id_servis' => $this->input->post('id_servis'),
                'nm_pelanggan' => $this->input->post('nm_pelanggan'),
                'merk_kendaraan' => $this->input->post('merk'),
                'nm_brg' => $this->input->post('nm_brg'),
                'harga_brg' => $this->input->post('harga'),
                'jumlah_brg' => $this->input->post('jumlah'),
                'subtotal_brg' => $this->input->post('harga') * $this->input->post('jumlah'),
                'keluhan' => $this->input->post('keluhan'),
                'nm_mekanik' => $this->input->post('nm_mekanik'),
                'harga_jasa' => $this->input->post('jasa'),
                'total' => $this->input->post('harga') * $this->input->post('jumlah') + $this->input->post('jasa')
            ];
            $this->db->insert('pembayaran', $pembayaran);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Data Pembayaran berhasil ditambahkan!</div>');
            redirect('ManajemenData/pembayaran');
        }
    }

    public function pembayaran_ekspor($id)
    {
        $db = new mysqli("localhost", "root", "", "db_bengkel");
        if ($db->errno == 0) {
            $pembayaran = $this->ManajemenData_model->get_nonota($id);
            $pdf = new FPDF('P', 'mm', 'Letter');
            $pdf->AddPage();

            $pdf->Image('assets/img/login/ahayy-rounded.png', 180, 3, -300);

            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(130, 5, 'STRUK PEMBAYARAN', 0, 1);

            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(130, 5, 'AHAYY', 0, 0);
            $pdf->Cell(59, 5, '', 0, 1);

            $pdf->Line(15, 25, 200, 25);

            $pdf->Ln(5);
            $pdf->Cell(127, 10, '', 0, 0);
            $pdf->Cell(25, 10, 'No Nota', 0, 0);
            $pdf->Cell(34, 10, ' : ' . $pembayaran['no_nota'], 0, 1);

            $pdf->Cell(40, 5, 'Nama Admin', 0, 0);
            $pdf->Cell(87, 5, ' : ' . $pembayaran['nm_admin'], 0, 0);
            $pdf->Cell(25, 8, 'Tanggal', 0, 0);
            $pdf->Cell(34, 8, ' : ' . $pembayaran['tgl'], 0, 1);

            $pdf->Cell(40, 5, 'Nama Mekanik', 0, 0);
            $pdf->Cell(87, 5, ' : ' . $pembayaran['nm_mekanik'], 0, 0);
            $pdf->Cell(25, 8, 'ID Servis', 0, 0);
            $pdf->Cell(34, 8, ' : ' . $pembayaran['id_servis'], 0, 1);

            $pdf->Ln(5);

            $pdf->Cell(40, 8, 'Nama Pelanggan', 0, 0);
            $pdf->Cell(90, 8, ' : ' . $pembayaran['nm_pelanggan'], 0, 1);

            $pdf->Cell(40, 8, 'Merk Kendaraan', 0, 0);
            $pdf->Cell(90, 8, ' : ' . $pembayaran['merk_kendaraan'], 0, 1);

            $pdf->Cell(40, 8, 'Keluhan', 0, 0);
            $pdf->Cell(90, 8, ' : ' . $pembayaran['keluhan'], 0, 1);

            $pdf->Cell(189, 10, '', 0, 1);

            $pdf->SetFont('Arial', 'B', 12);

            $pdf->Cell(124, 5, 'Barang', 1, 0);
            $pdf->Cell(31, 5, 'Jumlah', 1, 0);
            $pdf->Cell(40, 5, 'Harga', 1, 1);

            $pdf->SetFont('Arial', '', 12);

            $pdf->Cell(124, 5, '' . $pembayaran['nm_brg'], 1, 0);
            $pdf->Cell(31, 5, '' . $pembayaran['jumlah_brg'], 1, 0);
            $pdf->Cell(40, 5, 'Rp ' . number_format($pembayaran['harga_brg'], 0, ',', '.'), 1, 1, 'R');

            $pdf->Cell(120, 5, '', 0, 0);
            $pdf->Cell(35, 5, 'Subtotal Barang', 0, 0, 'R');
            $pdf->Cell(40, 5, 'Rp ' . number_format($pembayaran['subtotal_brg'], 0, ',', '.'), 1, 1, 'R');

            $pdf->Cell(120, 5, '', 0, 0);
            $pdf->Cell(35, 5, 'Jasa', 0, 0, 'R');
            $pdf->Cell(40, 5, 'Rp ' . number_format($pembayaran['harga_jasa'], 0, ',', '.'), 1, 1, 'R');

            $pdf->Cell(120, 5, '', 0, 0);
            $pdf->Cell(35, 5, 'Total', 0, 0, 'R');
            $pdf->Cell(40, 5, 'Rp ' . number_format($pembayaran['total'], 0, ',', '.'), 1, 1, 'R');

            $pdf->Line(15, 130, 200, 130);

            $pdf->Ln(5);
            $pdf->Cell(0, 40, '*** Terima Kasih ***', 0, 0, 'C');

            $pdf->Output('struk-pembayaran-' . $pembayaran['no_nota'] . '.pdf', 'I');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-circle"></i> Gagal koneksi database!</div>');
            redirect('ManajemenData/pembayaran');
        }
    }

    public function pembayaran_ubah($id)
    {
        $data['title'] = 'Ubah data pembayaran';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $data['ubah_pembayaran'] = $this->ManajemenData_model->get_nonota($id);

        $this->form_validation->set_rules('id_servis', 'ID Servis', 'required');
        $this->form_validation->set_rules('jasa', 'Harga Jasa', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('ManajemenData/pembayaran_ubah', $data);
            $this->load->view('templates/footer');
        } else {
            $this->ManajemenData_model->ubah_pembayaran();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Data Pembayaran berhasil diperbarui!</div>');
            redirect('ManajemenData/pembayaran');
        }
    }

    public function pembayaran_detail($id)
    {
        $data['title'] = 'Detail data pembayaran';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $data['detail_pembayaran'] = $this->ManajemenData_model->get_nonota($id);

        $db = new mysqli("localhost", "root", "", "db_bengkel");
        if ($db->errno == 0) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('ManajemenData/pembayaran_detail', $data);
            $this->load->view('templates/footer');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-circle"></i> Gagal koneksi database!</div>');
            redirect('ManajemenData/laporan');
        }
    }

    public function pembayaran_hapus($id)
    {
        // $this->ManajemenData_model->hapus_pembayaran($id);
        // $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Data Pembayaran telah terhapus!</div>');
        // redirect('ManajemenData/pembayaran');

        $db = new mysqli("localhost", "root", "", "db_bengkel");
        $row = mysqli_query($db, "DELETE FROM pembayaran WHERE no_nota = '$id'");

        if ($row) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Data Pembayaran telah terhapus!</div>');
            redirect('ManajemenData/pembayaran');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-circle"></i> Gagal! Data ini terpakai pada Data Laporan.</div>');
            redirect('ManajemenData/pembayaran');
        }
    }
    // END DATA PEMBAYARAN //

    // DATA LAPORAN //
    public function laporan()
    {
        $data['title'] = 'Laporan';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $data['data_laporan'] = $this->ManajemenData_model->get_laporan();

        if ($this->input->post('keyword')) {
            $data['data_laporan'] = $this->ManajemenData_model->search_laporan();
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ManajemenData/laporan', $data);
        $this->load->view('templates/footer');
    }

    public function laporan_tambah()
    {
        $data['title'] = 'Tambah data laporan';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $data['id_laporan'] = $this->ManajemenData_model->auto_idlaporan();

        $this->form_validation->set_rules('no_nota', 'No. Nota', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('ManajemenData/laporan_tambah', $data);
            $this->load->view('templates/footer');
        } else {
            $laporan = [
                'id_laporan' => $this->input->post('id_laporan'),
                'tgl' => Date('Y-m-d H:i:s'),
                'no_nota' => $this->input->post('no_nota'),
                'total' => $this->input->post('total')
            ];
            $this->db->insert('laporan', $laporan);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Data Laporan berhasil ditambahkan!</div>');
            redirect('ManajemenData/laporan');
        }
    }

    public function laporan_ubah($id)
    {
        $data['title'] = 'Ubah data laporan';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $data['ubah_laporan'] = $this->ManajemenData_model->get_laporanId($id);

        $this->form_validation->set_rules('no_nota', 'No. Nota', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('ManajemenData/laporan_ubah', $data);
            $this->load->view('templates/footer');
        } else {
            $db = new mysqli("localhost", "root", "", "db_bengkel");
            if ($db->errno == 0) {
                $this->ManajemenData_model->ubah_laporan();
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Data Laporan berhasil diperbarui!</div>');
                redirect('ManajemenData/laporan');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-circle"></i> Gagal koneksi database!</div>');
                redirect('ManajemenData/laporan');
            }
        }
    }

    public function laporan_hapus($id)
    {
        $db = new mysqli("localhost", "root", "", "db_bengkel");
        if ($db->errno == 0) {
            $this->ManajemenData_model->hapus_laporan($id);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Data Laporan telah terhapus!</div>');
            redirect('ManajemenData/laporan');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-circle"></i> Gagal koneksi database!</div>');
            redirect('ManajemenData/laporan');
        }
    }
    // END DATA LAPORAN //

    // DATA FOR AUTOFILL //
    public function barang_list()
    {
        $barang = $this->input->post('id_brg');
        $result = $this->ManajemenData_model->get_barangList($barang);
        foreach ($result as $row) {
            $data = [
                'nm_brg' => $row->nm_brg,
                'harga_brg' => $row->harga_brg,
            ];
        }
        echo json_encode($data);
    }

    public function servis_list()
    {
        $servis = $this->input->post('id_servis');
        $result = $this->ManajemenData_model->get_servisList($servis);
        foreach ($result as $row) {
            $data = [
                'nm_pelanggan' => $row->nm_pelanggan,
                'merk' => $row->merk_kendaraan,
                'keluhan' => $row->keluhan,
                'nm_brg' => $row->nm_brg,
                'harga_brg' => $row->harga_brg,
                'jumlah' => $row->jumlah_brg,
                'mekanik' => $row->nm_mekanik,
            ];
        }
        echo json_encode($data);
    }

    public function nota_list()
    {
        $nota = $this->input->post('no_nota');
        $result = $this->ManajemenData_model->get_notaList($nota);
        foreach ($result as $row) {
            $data = [
                'total' => $row->total
            ];
        }
        echo json_encode($data);
    }

    // END DATA FOR AUTOFILL //
}
