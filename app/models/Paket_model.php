<?php

class Paket_model
{

    private $db;
    private $table = 'daftar_paket';

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getListPaket()
    {
        $this->db->query("SELECT * FROM $this->table WHERE id_paket NOT LIKE 'sw%'");
        return $this->db->resultSet();
    }

    public function auto_id()
    {
        $this->db->query("SELECT max(id_paket) FROM $this->table");
        $id = $this->db->single();
        $angka = (int) substr($id['max(id_paket)'], 2, 2);
        $angka++;

        $id_paket = "pk" . sprintf("%02s", $angka);
        return $id_paket;
    }

    public function getPaketById($id)
    {
        $this->db->query("SELECT * FROM $this->table WHERE id_paket=:id_paket");
        $this->db->bind('id_paket', $id);
        return $this->db->resultSet();
    }

    public function getFotoBarang($id)
    {
        foreach ($id as $value) {
            $this->db->query("SELECT foto_barang FROM barang WHERE id_barang=:id_barang");
            $this->db->bind('id_barang', $value);
            $this->db->execute();
        }
        return $this->db->single();
    }

    public function tambahDataPaket($data)
    {
        $this->db->query("INSERT INTO paket VALUES (:id_paket, :nama_paket, :harga)");
        $this->db->bind('id_paket', $data['id_paket']);
        $this->db->bind('nama_paket', $data['nama_paket']);
        $this->db->bind('harga', $data['harga']);
        $this->db->execute();

        $this->db->query("INSERT INTO isi_paket VALUES (:id_paket, :id_barang, :jumlah_barang)");
        foreach ($data['nama_barang'] as $key => $value) {
            $this->db->bind('id_paket', $data['id_paket']);
            $this->db->bind('id_barang', $data['id_barang'][$key]);
            $this->db->bind('jumlah_barang', $data['jumlah_barang'][$key]);
            $this->db->execute();
        }
        return $this->db->rowCount();
    }

    public function editDataPaket($data)
    {
        $this->db->query("UPDATE paket 
        SET nama_paket=:nama_paket, 
        harga=:harga 
        WHERE id_paket=:id_paket");
        foreach ($data['id_barang'] as $key => $value) {
            $this->db->bind('id_paket', $data['id_paket']);
            $this->db->bind('nama_paket', $data['nama_paket']);
            $this->db->bind('harga', $data['harga']);
            $this->db->execute();
        }

        $this->db->query("DELETE FROM isi_paket WHERE id_paket=:id_paket");
        $this->db->bind('id_paket', $data['id_paket']);
        $this->db->execute();

        $this->db->query("INSERT INTO isi_paket VALUES (:id_paket, :id_barang, :jumlah_barang)");
        foreach ($data['id_barang'] as $key => $value) {
            $this->db->bind('id_paket', $data['id_paket']);
            $this->db->bind('id_barang', $data['id_barang'][$key]);
            $this->db->bind('jumlah_barang', $data['jumlah_barang'][$key]);
            $this->db->execute();
        }
        return $this->db->rowCount();
    }

    public function hapusDataPaket($id)
    {
        $this->db->query("SET FOREIGN_KEY_CHECKS=0");
        $this->db->execute();

        $query = "DELETE FROM paket WHERE id_paket = :id_paket";
        $this->db->query($query);
        $this->db->bind('id_paket', $id);
        $this->db->execute();

        $query = "DELETE FROM isi_paket WHERE id_paket = :id_paket";
        $this->db->query($query);
        $this->db->bind('id_paket', $id);
        $this->db->execute();

        $this->db->query("SET FOREIGN_KEY_CHECKS=0");
        $this->db->execute();

        $this->db->query("SELECT COUNT(*) FROM $this->table");
        $this->db->execute();
        return $this->db->single();
    }
}
