<?php

class Sewaan_model extends CI_Model
{
  private $table = '`pesanan`.`id_pesanan` AS `id_pesanan`, `pesanan`.`id_pemesan` AS `id_pemesan`, DATE(`pesanan`.`tgl_mulai`) AS `tgl_mulai`, TIME(`pesanan`.`tgl_mulai`) AS `waktu_mulai`, DATE(`pesanan`.`tgl_selesai`) AS `tgl_selesai`, TIME(`pesanan`.`tgl_selesai`) AS `waktu_selesai`, `pesanan`.`id_paket` AS `id_paket`, `pesanan`.`status` AS `status`, `pemesan`.`nama_pemesan` AS `nama_pemesan`, `paket`.`nama_paket` AS `nama_paket`, `paket`.`harga` AS `harga` FROM ( ( `pesanan` JOIN `pemesan` ON ( `pesanan`.`id_pemesan` = `pemesan`.`id_pemesan` ) ) JOIN `paket` ON ( `pesanan`.`id_paket` = `paket`.`id_paket` ) )';

  public function getListSewaan()
  {
    $query = $this->db->query("SELECT $this->table WHERE status = 'berlangsung'");
    return $query->result_array();
  }

  public function auto_id()
  {
     {
      $query = $this->db->query("SELECT max(id_pesanan) FROM pesanan");
      $id = $query->row_array();
      $angka = (int) substr($id['max(id_pesanan)'], 2, 2);
      $angka++;

      $id_sewaan = "sw" . sprintf("%02s", $angka);
      return $id_sewaan;
    }
  }

  public function getBarangSewaan($id)
  {
    $query = $this->db->query("SELECT `paket`.`id_paket` AS `id_paket`,`isi_paket`.`id_barang` AS `id_barang`,`isi_paket`.`jumlah_barang` AS `jumlah_barang`,`barang`.`nama_barang` AS `nama_barang`,`barang`.`harga` AS `harga_barang`,`barang`.`foto_barang` AS `foto_barang` from ((`paket` join `isi_paket` on(`isi_paket`.`id_paket` = `paket`.`id_paket`)) join `barang` on(`isi_paket`.`id_barang` = `barang`.`id_barang`)) WHERE `paket`.`id_paket` = ?", array($id));
    return $query->result_array();
  }

  public function getHargaBarang($id)
  {
    $query = $this->db->query("SELECT harga FROM barang WHERE id_barang = ?", array($id));
    return $query->row_array();
  }

  public function getSewaanById($id)
  {
    $query = $this->db->query("SELECT $this->table WHERE `pesanan`.`id_pesanan` = ?", array($id));
    return $query->row_array();
  }

  public function getSewaAkanBerakhir()
  {
    $query = $this->db->query("SELECT `pesanan`.`id_pesanan` AS `id_pesanan`,DATE(`pesanan`.`tgl_selesai`) AS `tgl_selesai`,TIME(`pesanan`.`tgl_selesai`) AS `waktu_selesai`,`pemesan`.`nama_pemesan` AS `nama_pemesan` from (`pesanan` join `pemesan` on(`pesanan`.`id_pemesan` = `pemesan`.`id_pemesan`)) WHERE `pesanan`.`tgl_selesai` >= CURRENT_DATE AND `pesanan`.`status` = 'berlangsung' ORDER BY `pesanan`.`tgl_selesai` LIMIT 0, 5");
    return $query->result_array();
  }

  public function getSewaTerbaru()
  {
    $query = $this->db->query("SELECT $this->table WHERE `pesanan`.`status` = 'berlangsung' ORDER BY `pesanan`.`id_pesanan` LIMIT 0, 5");
    return $query->result_array();
  }

  public function tambahDataSewaan($data)
  {
    $sql = "INSERT INTO pesanan VALUES (?, ?, ?, ?, ?, ?)";
    $query = $this->db->query($sql, array($data['id_sewaan'], $data['id_penyewa'], $data['tgl_mulai'], $data['tgl_selesai'], $data['id_paket'], $data['status']));
    return $query;
  }

  public function editDataSewaan($data)
  {
    $query = $this->db->query("UPDATE pesanan SET id_pemesan = ?,
        tgl_mulai = ?, 
        tgl_selesai = ?,
        id_paket = ?, 
        status = ?
        WHERE id_pesanan = ?",
        array($data['id_penyewa'], $data['tgl_mulai'], $data['tgl_selesai'], $data['id_paket'], $data['status'], $data['id_sewaan']));
    $countIsiPaket = $this->db->query("SELECT COUNT(*) FROM isi_paket")->row_array()['COUNT(*)'];
    return intval($this->db->affected_rows() + $countIsiPaket);
  }

  public function hapusDataSewaan($id)
  {
    $query = "DELETE FROM pesanan WHERE id_pesanan = ?";
    return $this->db->query($query, array($id));
  }

  public function selesaikanSewa($data)
  {
    $this->db->query("UPDATE pesanan SET status = ? WHERE id_pesanan = ?", array($data['status_sewa'], $data['id_sewaan']));
    $this->db->query("INSERT INTO transaksi VALUES (?, ?, ?, ?, ?)", array($data['id_sewaan'], $data['total_biaya'], $data['jumlah_bayar'], $data['kembalian'], $data['status_pembayaran']));
    return $this->db->affected_rows();
  }
}
