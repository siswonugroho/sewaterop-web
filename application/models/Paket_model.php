<?php

class Paket_model extends CI_Model
{

  private $table = '`paket`.`id_paket` AS `id_paket`,`paket`.`nama_paket` AS `nama_paket`,`paket`.`harga` AS `harga`,`isi_paket`.`id_barang` AS `id_barang`,`isi_paket`.`jumlah_barang` AS `jumlah_barang`,`barang`.`nama_barang` AS `nama_barang`,`barang`.`harga` AS `harga_barang`,`barang`.`foto_barang` AS `foto_barang` from ((`paket` join `isi_paket` on(`isi_paket`.`id_paket` = `paket`.`id_paket`)) join `barang` on(`isi_paket`.`id_barang` = `barang`.`id_barang`))';

  public function getListPaket()
  {
    $query = $this->db->query("SELECT $this->table WHERE `paket`.`id_paket` NOT LIKE 'sw%'");
    return $query->result_array();
  }

  public function auto_id()
  {
    $query = $this->db->query("SELECT max(id_paket) FROM paket WHERE id_paket NOT LIKE 'sw%'");
    $id = $query->row_array();
    $angka = (int) substr($id['max(id_paket)'], 2, 2);
    $angka++;

    $id_paket = "pk" . sprintf("%02s", $angka);
    return $id_paket;
  }

  public function getPaketById($id)
  {
    $query = $this->db->query("SELECT $this->table WHERE `paket`.`id_paket`=?", array($id));
    return $query->result_array();
  }

  public function getFotoBarang($id)
  {
    foreach ($id as $value) {
      $query = $this->db->query("SELECT foto_barang FROM barang WHERE id_barang=?", array($value));
    }
    return $query->row_array();
  }

  public function tambahDataPaket($data)
  {
    $this->db->query("INSERT INTO paket VALUES (?, ?, ?)", array($data['id_paket'], $data['nama_paket'], $data['harga']));

    $query_isi_paket = "INSERT INTO isi_paket VALUES (?, ?, ?)";
    foreach ($data['nama_barang'] as $key => $value) {
      $this->db->query($query_isi_paket, array($data['id_paket'], $data['id_barang'][$key], $data['jumlah_barang'][$key]));
    }
    return $this->db->affected_rows();
  }

  public function editDataPaket($data)
  {
    foreach ($data['id_barang'] as $key => $value) {
      $this->db->query("UPDATE paket SET nama_paket=?, harga=? WHERE id_paket=?",
              array($data['nama_paket'], $data['harga'], $data['id_paket']));
    }

    $this->db->query("DELETE FROM isi_paket WHERE id_paket=?", array($data['id_paket']));
    
   
    foreach ($data['id_barang'] as $key => $value) {
       $this->db->query("INSERT INTO isi_paket VALUES (?, ?, ?)",
              array($data['id_paket'], $data['id_barang'][$key], $data['jumlah_barang'][$key]));
    }
    return $this->db->affected_rows();
  }

  public function hapusDataPaket($id)
  {
    $this->db->query("SET FOREIGN_KEY_CHECKS=0");

    $queryDeletePaket = "DELETE FROM paket WHERE id_paket = ?";
    $this->db->query($queryDeletePaket, array($id));

    $queryDeleteIsiPaket = "DELETE FROM isi_paket WHERE id_paket = ?";
    $this->db->query($queryDeleteIsiPaket, array($id));

    $this->db->query("SET FOREIGN_KEY_CHECKS=0");

    return $this->db->query("SELECT COUNT(id_paket) FROM paket")->row_array()['COUNT(id_paket)'];
  }
}
