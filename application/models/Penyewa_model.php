<?php

class Penyewa_model extends CI_Model
{

    private $table = 'pemesan';
    private $column_selected = 'id_pemesan, nama_pemesan, username, alamat, telepon';

    public function getListPenyewa()
    {
        $query = $this->db->query("SELECT $this->column_selected FROM $this->table");
        return $query->result_array();
    }

    public function getPenyewaById($id)
    {
        $query = $this->db->query("SELECT $this->column_selected FROM $this->table WHERE id_pemesan=?", array($id));
        return $query->row_array();
    }

    public function auto_id()
    {
        $query = $this->db->query("SELECT max(id_pemesan) FROM $this->table");
        $id = $query->row_array();
        $angka = (int) substr($id['max(id_pemesan)'], 2, 2);
        $angka++;

        $id_penyewa = "ps" . sprintf("%02s", $angka);
        return $id_penyewa;
    }

    public function tambahDataPenyewa($data)
    {
        $query = "INSERT INTO $this->table (id_pemesan, nama_pemesan, username, alamat, telepon) VALUES (?, ?, ?, ?, ?)";
        return $this->db->query($query, array($data['id_penyewa'], $data['nama_penyewa'], $data['username'], $data['alamat'], $data['telepon']));
    }

    public function editDataPenyewa($data)
    {
        $query = "UPDATE $this->table SET 
        nama_pemesan = ?,
        username = ?,
        alamat = ?,
        telepon = ?
        WHERE id_pemesan= ?";
        return $this->db->query($query, array($data['nama_penyewa'], $data['username'], $data['alamat'], $data['telepon'], $data['id_penyewa']));
    }

    public function hapusDataPenyewa($id)
    {
        $query = "DELETE FROM $this->table WHERE id_pemesan = ?";
        return $this->db->query($query, array($id));
    }

    // public function getImageById($id)
    // {
    //     $this->db->query("SELECT foto_barang FROM $this->table WHERE id_barang = :id_barang");
    //     $this->db->bind('id_barang', $id);
    //     $this->db->execute();
    //     return $this->db->single();
    // }
}
