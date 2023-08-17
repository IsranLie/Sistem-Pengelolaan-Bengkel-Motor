<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ManajemenData_model extends CI_model
{
    // DATA SERVICE //
    public function get_servis()
    {
        return $this->db->get('servis')->result_array();
    }

    public function get_servisId($id)
    {
        return $this->db->get_where('servis', ['id_servis' => $id])->row_array();
    }

    public function auto_idservis()
    {
        $this->db->select('RIGHT(id_servis,4) as idServis', false);
        $this->db->order_by("id_servis", "DESC");
        $this->db->limit(1);
        $query = $this->db->get('servis');

        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $id = intval($data->idServis) + 1;
        } else {
            $id  = 1;
        }

        $numberId = str_pad($id, 4, "0", STR_PAD_LEFT);
        $wordId = "S";
        $newId  = $wordId . $numberId;
        return $newId;
    }

    public function ubah_servis()
    {
        $pelanggan = [
            'id_pelanggan' => $this->input->post('id_pelanggan'),
            'nm_pelanggan' => $this->input->post('nm_pelanggan'),
            'noTlp_pelanggan' => $this->input->post('noTlp')
        ];
        $this->db->where('id_pelanggan', $this->input->post('id_pelanggan'));
        $this->db->update('pelanggan', $pelanggan);

        $servis = [
            'id_servis' => $this->input->post('id_servis'),
            'tgl' => Date('Y-m-d H:i:s'),
            'id_pelanggan' => $this->input->post('id_pelanggan'),
            'nm_pelanggan' => $this->input->post('nm_pelanggan'),
            'noTlp_pelanggan' => $this->input->post('noTlp'),
            'merk_kendaraan' => $this->input->post('merk'),
            'no_plat' => $this->input->post('no_plat'),
            'keluhan' => $this->input->post('keluhan'),
            'nm_mekanik' => $this->input->post('nm_mekanik'),
            'id_brg' => $this->input->post('id_brg'),
            'nm_brg' => $this->input->post('nm_brg'),
            'harga_brg' => $this->input->post('harga'),
            'jumlah_brg' => $this->input->post('jumlah')
        ];
        $this->db->where('id_servis', $this->input->post('id_servis'));
        $this->db->update('servis', $servis);
    }

    public function hapus_servis($id)
    {
        $this->db->delete('servis', ['id_pelanggan' => $id]);
        $this->db->delete('pelanggan', ['id_pelanggan' => $id]);
    }

    public function search_servis()
    {
        $keyword = $this->input->post('keyword');
        $this->db->like('id_servis', $keyword);
        $this->db->or_like('tgl', $keyword);
        $this->db->or_like('id_pelanggan', $keyword);
        $this->db->or_like('nm_pelanggan', $keyword);
        $this->db->or_like('noTlp_pelanggan', $keyword);
        $this->db->or_like('merk_kendaraan', $keyword);
        $this->db->or_like('no_plat', $keyword);
        $this->db->or_like('keluhan', $keyword);
        $this->db->or_like('nm_mekanik', $keyword);
        $this->db->or_like('id_brg', $keyword);
        $this->db->or_like('nm_brg', $keyword);
        $this->db->or_like('harga_brg', $keyword);
        $this->db->or_like('jumlah_brg', $keyword);
        return $this->db->get('servis')->result_array();
    }

    public function get_servisList($servis)
    {
        $this->db->select('*');
        $this->db->where('id_servis', $servis);
        return $this->db->get('servis')->result();
    }
    // END DATA SERVICE //

    // DATA BARANG //
    public function get_barang()
    {
        return $this->db->get('barang')->result_array();
    }

    public function get_barangList($barang)
    {
        $this->db->select('*');
        $this->db->where('id_brg', $barang);
        return $this->db->get('barang')->result();
    }
    // END DATA BARANG //

    // DATA PELANGGAN //
    public function auto_idpelanggan()
    {
        $this->db->select('RIGHT(id_pelanggan,4) as idPelanggan', false);
        $this->db->order_by("id_pelanggan", "DESC");
        $this->db->limit(1);
        $query = $this->db->get('pelanggan');

        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $id = intval($data->idPelanggan) + 1;
        } else {
            $id  = 1;
        }

        $numberId = str_pad($id, 4, "0", STR_PAD_LEFT);
        $wordId = "C";
        $newId  = $wordId . $numberId;
        return $newId;
    }
    // END DATA PELANGGAN //

    // DATA PEMBAYARAN //
    public function get_pembayaran()
    {
        return $this->db->get('pembayaran')->result_array();
    }

    public function auto_nonota()
    {
        $this->db->select('RIGHT(no_nota,4) as noNota', false);
        $this->db->order_by("no_nota", "DESC");
        $this->db->limit(1);
        $query = $this->db->get('pembayaran');

        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $id = intval($data->noNota) + 1;
        } else {
            $id  = 1;
        }

        $numberId = str_pad($id, 4, "0", STR_PAD_LEFT);
        $wordId = "N";
        $newId  = $wordId . $numberId;
        return $newId;
    }

    public function get_nonota($id)
    {
        return $this->db->get_where('pembayaran', ['no_nota' => $id])->row_array();
    }

    public function ubah_pembayaran()
    {
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
        $this->db->where('no_nota', $this->input->post('no_nota'));
        $this->db->update('pembayaran', $pembayaran);
    }

    public function hapus_pembayaran($id)
    {
        $this->db->delete('pembayaran', ['no_nota' => $id]);
    }

    public function search_pembayaran()
    {
        $keyword = $this->input->post('keyword');
        $this->db->like('no_nota', $keyword);
        $this->db->or_like('tgl', $keyword);
        $this->db->or_like('id_servis', $keyword);
        $this->db->or_like('nm_pelanggan', $keyword);
        $this->db->or_like('merk_kendaraan', $keyword);
        $this->db->or_like('keluhan', $keyword);
        $this->db->or_like('nm_mekanik', $keyword);
        $this->db->or_like('nm_brg', $keyword);
        $this->db->or_like('harga_brg', $keyword);
        $this->db->or_like('jumlah_brg', $keyword);
        $this->db->or_like('subtotal_brg', $keyword);
        $this->db->or_like('total', $keyword);
        return $this->db->get('pembayaran')->result_array();
    }
    // END DATA PEMBAYARAN //

    // DATA LAPORAN //
    public function get_laporan()
    {
        return $this->db->get('laporan')->result_array();
    }

    public function get_laporanId($id)
    {
        return $this->db->get_where('laporan', ['id_laporan' => $id])->row_array();
    }

    public function auto_idlaporan()
    {
        $this->db->select('RIGHT(id_laporan,4) as idLaporan', false);
        $this->db->order_by("id_laporan", "DESC");
        $this->db->limit(1);
        $query = $this->db->get('laporan');

        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $id = intval($data->idLaporan) + 1;
        } else {
            $id  = 1;
        }

        $numberId = str_pad($id, 4, "0", STR_PAD_LEFT);
        $wordId = "L";
        $newId  = $wordId . $numberId;
        return $newId;
    }

    public function ubah_laporan()
    {
        $laporan = [
            'id_laporan' => $this->input->post('id_laporan'),
            'tgl' => Date('Y-m-d H:i:s'),
            'no_nota' => $this->input->post('no_nota'),
            'total' => $this->input->post('total')
        ];
        $this->db->where('id_laporan', $this->input->post('id_laporan'));
        $this->db->update('laporan', $laporan);
    }

    public function get_notaList($nota)
    {
        $this->db->select('*');
        $this->db->where('no_nota', $nota);
        return $this->db->get('pembayaran')->result();
    }

    public function hapus_laporan($id)
    {
        $this->db->delete('laporan', ['id_laporan' => $id]);
    }

    public function search_laporan()
    {
        $keyword = $this->input->post('keyword');
        $this->db->like('id_laporan', $keyword);
        $this->db->or_like('tgl', $keyword);
        $this->db->or_like('no_nota', $keyword);
        $this->db->or_like('total', $keyword);
        return $this->db->get('laporan')->result_array();
    }
    // END DATA LAPORAN //
}
