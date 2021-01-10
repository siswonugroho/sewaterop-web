<?php

class Barang_model
{

    private $db;
    private $table = 'barang';

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getListBarang()
    {
        $this->db->query("SELECT * FROM $this->table");
        return $this->db->resultSet();
    }

    public function getBarangById($id)
    {
        $this->db->query("SELECT * FROM $this->table WHERE id_barang=:id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function auto_id()
    {
        $this->db->query("SELECT max(id_barang) FROM $this->table");
        $id = $this->db->single();
        $angka = (int) substr($id['max(id_barang)'], 2, 2);
        $angka++;

        $id_barang = "br" . sprintf("%02s", $angka);
        return $id_barang;
    }

    public function tambahDataBarang($data)
    {
        $query = "INSERT INTO $this->table VALUES (:id_barang, :nama_barang, :foto_barang, :harga, :stok)";
        $this->db->query($query);
        $this->db->bind('id_barang', $data['id_barang']);
        $this->db->bind('nama_barang', $data['nama_barang']);
        $this->db->bind('foto_barang', $data['foto_barang']);
        $this->db->bind('harga', $data['harga']);
        $this->db->bind('stok', $data['stok']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function editDataBarang($data)
    {
        $query = "UPDATE $this->table SET 
        nama_barang = :nama_barang, 
        foto_barang = :foto_barang, 
        harga = :harga, 
        stok = :stok 
        WHERE id_barang = :id_barang";
        $this->db->query($query);
        $this->db->bind('id_barang', $data['id_barang']);
        $this->db->bind('nama_barang', $data['nama_barang']);
        $this->db->bind('foto_barang', $data['foto_barang']);
        $this->db->bind('harga', $data['harga']);
        $this->db->bind('stok', $data['stok']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function hapusDataBarang($id)
    {
        $query = "DELETE FROM $this->table WHERE id_barang = :id_barang";
        $this->db->query($query);
        $this->db->bind('id_barang', $id);
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
