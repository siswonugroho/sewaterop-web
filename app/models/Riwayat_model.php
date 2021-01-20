<?php

class Riwayat_model
{
    private $db;
    private $table = 'daftar_transaksi';

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getListRiwayat()
    {
        $this->db->query("SELECT * FROM $this->table");
        return $this->db->resultSet();
    }

    public function getRiwayatById($id_pesanan)
    {
        $this->db->query("SELECT * FROM $this->table WHERE id_pesanan = :id_pesanan");
        $this->db->bind('id_pesanan', $id_pesanan);
        $this->db->execute();
        return $this->db->single();
    }

}