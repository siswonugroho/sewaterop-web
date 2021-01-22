<?php

class Home_model
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function countSummary()
    {
        $summary = [];
        $summary['jumlah-sewa'] = $this->db->queryCount("SELECT COUNT(*) FROM pesanan WHERE status='berlangsung'");
        $summary['jumlah-barang'] = $this->db->queryCount("SELECT COUNT(*) FROM barang");
        $summary['jumlah-paket'] = $this->db->queryCount("SELECT COUNT(*) FROM paket WHERE id_paket NOT LIKE 'sw%'");
        $summary['jumlah-blm-lunas'] = $this->db->queryCount("SELECT COUNT(*) FROM transaksi WHERE status_pembayaran NOT LIKE 'L%'");

        return $summary;
    }

}