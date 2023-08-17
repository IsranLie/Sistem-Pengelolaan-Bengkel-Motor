<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MonitoringData_model extends CI_model
{
    // DATA LAPORAN //
    public function get_laporan()
    {
        return $this->db->get('laporan')->result_array();
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

    // DATA BARANG //
    public function get_barang()
    {
        return $this->db->get('barang')->result_array();
    }

    public function get_pemasok()
    {
        return $this->db->get('pemasok')->result_array();
    }

    public function auto_nofaktur()
    {
        $this->db->select('RIGHT(no_faktur,4) as noFaktur', false);
        $this->db->order_by("no_faktur", "DESC");
        $this->db->limit(1);
        $query = $this->db->get('faktur');

        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $id = intval($data->noFaktur) + 1;
        } else {
            $id  = 1;
        }

        $numberId = str_pad($id, 4, "0", STR_PAD_LEFT);
        $wordId = "F";
        $newId  = $wordId . $numberId;
        return $newId;
    }

    public function auto_idbarang()
    {
        $this->db->select('RIGHT(id_brg,3) as idBarang', false);
        $this->db->order_by("id_brg", "DESC");
        $this->db->limit(1);
        $query = $this->db->get('barang');

        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $id = intval($data->idBarang) + 1;
        } else {
            $id  = 1;
        }

        $numberId = str_pad($id, 3, "0", STR_PAD_LEFT);
        $wordId = "B";
        $newId  = $wordId . $numberId;
        return $newId;
    }

    public function get_barangId($id)
    {
        return $this->db->get_where('barang', ['id_brg' => $id])->row_array();
    }

    public function ubah_barang()
    {
        $barang = [
            'id_brg' => $this->input->post('id_brg'),
            'nm_brg' => $this->input->post('nm_brg'),
            'stok' => $this->input->post('jumlah'),
            'harga_brg' => $this->input->post('harga')
        ];
        $this->db->where('id_brg', $this->input->post('id_brg'));
        $this->db->update('barang', $barang);
    }

    public function hapus_barang($id)
    {
        $this->db->delete('faktur', ['id_brg' => $id]);
        $this->db->delete('barang', ['id_brg' => $id]);
    }

    public function search_barang()
    {
        $keyword = $this->input->post('keyword');
        $this->db->like('id_brg', $keyword);
        $this->db->or_like('nm_brg', $keyword);
        $this->db->or_like('harga_brg', $keyword);
        $this->db->or_like('stok', $keyword);
        return $this->db->get('barang')->result_array();
    }
    // END DATA BARANG //
}
