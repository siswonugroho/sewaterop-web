<?php

class Riwayat_model extends CI_Model
{
    private $table = '`transaksi`.`id_pesanan` AS `id_pesanan`,`transaksi`.`total_biaya` AS `total_biaya`,`transaksi`.`jumlah_bayar` AS `jumlah_bayar`,`transaksi`.`kembalian` AS `kembalian`,`transaksi`.`status_pembayaran` AS `status_pembayaran`,`pemesan`.`nama_pemesan` AS `nama_pemesan`,`pesanan`.`id_paket` AS `id_paket`,`paket`.`nama_paket` AS `nama_paket`,DATE(`pesanan`.`tgl_mulai`) AS `tgl_mulai`,TIME(`pesanan`.`tgl_mulai`) AS `waktu_mulai`,DATE(`pesanan`.`tgl_selesai`) AS `tgl_selesai`,TIME(`pesanan`.`tgl_selesai`) AS `waktu_selesai` from (((`transaksi` join `pesanan` on(`pesanan`.`id_pesanan` = `transaksi`.`id_pesanan`)) join `pemesan` on(`pemesan`.`id_pemesan` = `pesanan`.`id_pemesan`)) join `paket` on(`pesanan`.`id_paket` = `paket`.`id_paket`))';

    public function getListRiwayat()
    {
        $query = $this->db->query("SELECT $this->table");
        return $query->result_array();
    }

    public function getRiwayatById($id_pesanan)
    {
        $query = $this->db->query("SELECT $this->table WHERE `transaksi`.`id_pesanan` = ?", array($id_pesanan));
        return $query->row_array();
    }

}