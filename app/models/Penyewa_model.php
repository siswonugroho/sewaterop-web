<?php

class Penyewa_model
{

    private $db;
    private $table = 'pemesan';

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getListPenyewa()
    {
        $this->db->query("SELECT * FROM $this->table");
        return $this->db->resultSet();
    }

    public function getPenyewaById($id)
    {
        $this->db->query("SELECT * FROM $this->table WHERE id_pemesan=:id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function auto_id()
    {
        $this->db->query("SELECT max(id_pemesan) FROM $this->table");
        $id = $this->db->single();
        $angka = (int) substr($id['max(id_pemesan)'], 2, 2);
        $angka++;

        $id_penyewa = "ps" . sprintf("%02s", $angka);
        return $id_penyewa;
    }

    public function tambahDataPenyewa($data)
    {
        $query = "INSERT INTO $this->table VALUES (:id_pemesan, :nama_pemesan, :alamat, :telepon)";
        $this->db->query($query);
        $this->db->bind('id_pemesan', $data['id_penyewa']);
        $this->db->bind('nama_pemesan', $data['nama_penyewa']);
        $this->db->bind('alamat', $data['alamat']);
        $this->db->bind('telepon', $data['telepon']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function editDataPenyewa($data)
    {
        $query = "UPDATE $this->table SET 
        nama_pemesan = :nama_penyewa,
        alamat = :alamat,
        telepon = :telepon
        WHERE id_pemesan= :id_penyewa";
        $this->db->query($query);
        $this->db->bind('id_penyewa', $data['id_penyewa']);
        $this->db->bind('nama_penyewa', $data['nama_penyewa']);
        $this->db->bind('alamat', $data['alamat']);
        $this->db->bind('telepon', $data['telepon']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function hapusDataPenyewa($id)
    {
        $query = "DELETE FROM $this->table WHERE id_pemesan = :id_penyewa";
        $this->db->query($query);
        $this->db->bind('id_penyewa', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getImageById($id)
    {
        $this->db->query("SELECT foto_barang FROM $this->table WHERE id_barang = :id_barang");
        $this->db->bind('id_barang', $id);
        $this->db->execute();
        return $this->db->single();
    }
}
