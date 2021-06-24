<?php

class Barang_model extends CI_Model
{

  private $table = 'barang';

  public function getListBarang()
  {
    $query = $this->db->query("SELECT * FROM $this->table");
    return $query->result_array();
  }

  public function getBarangById($id)
  {
    $query = $this->db->query("SELECT * FROM $this->table WHERE id_barang=?", array($id));
    return $query->row_array();
  }

  public function auto_id()
  {
    $query = $this->db->query("SELECT max(id_barang) FROM $this->table");
    $id = $query->row_array();
    $angka = (int) substr($id['max(id_barang)'], 2, 2);
    $angka++;

    $id_barang = "br" . sprintf("%02s", $angka);
    return $id_barang;
  }

  public function updateStokBarang($data)
  {
    $query = $this->db->query("UPDATE $this->table SET stok = ? WHERE id_barang = ?", array($data['stok'], $data['id_barang']));
    return $query;
  }

  public function tambahDataBarang($data)
  {
    $query = "INSERT INTO $this->table VALUES (?, ?, ?, ?, ?)";
    return $this->db->query($query, array($data['id_barang'], $data['nama_barang'], $data['foto_barang'], $data['harga'], $data['stok']));
  }

  public function editDataBarang($data)
  {
    $query = "UPDATE $this->table SET 
        nama_barang = ?, 
        foto_barang = ?, 
        harga = ?, 
        stok = ? 
        WHERE id_barang = ?";
    return $this->db->query($query, array($data['nama_barang'], $data['foto_barang'], $data['harga'], $data['stok'], $data['id_barang']));
  }

  public function hapusDataBarang($id)
  {
    $query = "DELETE FROM $this->table WHERE id_barang = ?";
    return $this->db->query($query, array($id));
  }

  public function getImageById($id)
  {
    $query = $this->db->query("SELECT foto_barang FROM $this->table WHERE id_barang = ?", array($id));
    return $query->row_array();
  }
}
