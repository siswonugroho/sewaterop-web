<?php

class Home_model extends CI_Model
{
    public function countSummary()
    {
        $data = [];
        $data['jumlah-sewa'] = $this->db->query("SELECT COUNT(*) FROM pesanan WHERE status='berlangsung'")->row_array()['COUNT(*)'];
        $data['jumlah-barang'] = $this->db->query("SELECT COUNT(*) FROM barang")->row_array()['COUNT(*)'];
        $data['jumlah-paket'] = $this->db->query("SELECT COUNT(*) FROM paket WHERE id_paket NOT LIKE 'sw%'")->row_array()['COUNT(*)'];
        $data['jumlah-blm-lunas'] = $this->db->query("SELECT COUNT(*) FROM transaksi WHERE status_pembayaran NOT LIKE 'L%'")->row_array()['COUNT(*)'];

        return $data;
    }

}