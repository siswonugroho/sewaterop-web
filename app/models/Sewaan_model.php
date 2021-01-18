<?php

class Sewaan_model
{
    private $db;
    private $table = 'daftar_sewaan';

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getListSewaan()
    {
        $this->db->query("SELECT * FROM $this->table WHERE status = 'berlangsung'");
        return $this->db->resultSet();
    }

    public function auto_id()
    { {
            $this->db->query("SELECT max(id_pesanan) FROM $this->table");
            $id = $this->db->single();
            $angka = (int) substr($id['max(id_pesanan)'], 2, 2);
            $angka++;

            $id_sewaan = "sw" . sprintf("%02s", $angka);
            return $id_sewaan;
        }
    }

    public function getBarangSewaan($id)
    {
        $this->db->query("SELECT id_barang, nama_barang, jumlah_barang, foto_barang FROM daftar_paket WHERE id_paket = :id_paket");
        $this->db->bind('id_paket', $id);
        $this->db->execute();
        return $this->db->resultSet();
    }

    public function getHargaBarang($id)
    {
        $this->db->query("SELECT harga FROM barang WHERE id_barang = :id_barang");
        $this->db->bind('id_barang', $id);
        $this->db->execute();
        return $this->db->single();
    }

    public function getSewaanById($id)
    {
        $this->db->query("SELECT * FROM $this->table WHERE id_pesanan = :id_pesanan");
        $this->db->bind('id_pesanan', $id);
        $this->db->execute();
        return $this->db->single();
    }

    public function tambahDataSewaan($data)
    {
        $this->db->query("INSERT INTO pesanan VALUES (:id_pesanan, :id_pemesan, :tgl_mulai, :tgl_selesai, :id_paket, :status)");
        $this->db->bind('id_pesanan', $data['id_sewaan']);
        $this->db->bind('id_pemesan', $data['id_penyewa']);
        $this->db->bind('tgl_mulai', $data['tgl_mulai']);
        $this->db->bind('tgl_selesai', $data['tgl_selesai']);
        $this->db->bind('id_paket', $data['id_paket']);
        $this->db->bind('status', $data['status']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function editDataSewaan($data)
    {
        $this->db->query("UPDATE pesanan SET id_pemesan = :id_pemesan,
        tgl_mulai = :tgl_mulai, 
        tgl_selesai = :tgl_selesai,
        id_paket = :id_paket, 
        status = :status
        WHERE id_pesanan = :id_pesanan");
        $this->db->bind('id_pesanan', $data['id_sewaan']);
        $this->db->bind('id_pemesan', $data['id_penyewa']);
        $this->db->bind('tgl_mulai', $data['tgl_mulai']);
        $this->db->bind('tgl_selesai', $data['tgl_selesai']);
        $this->db->bind('id_paket', $data['id_paket']);
        $this->db->bind('status', $data['status']);
        $this->db->execute();

        $this->db->query("SELECT COUNT(*) FROM isi_paket");
        $this->db->execute();

        return intval($this->db->rowCount() + $this->db->single[0]);
    }

    public function hapusDataSewaan($id)
    {
        $query = "DELETE FROM pesanan WHERE id_pesanan = :id_pesanan";
        $this->db->query($query);
        $this->db->bind('id_pesanan', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function selesaikanSewa($data)
    {
        $this->db->query("UPDATE pesanan SET status = :status WHERE id_pesanan = :id_pesanan");
        $this->db->bind('status', $data['status']);
        $this->db->bind('id_pesanan', $data['id_penyewa']);
        $this->db->execute();

        $this->db->query("INSERT INTO transaksi VALUES :id_pesanan, :total_biaya, :jumlah_bayar, :status");
        $this->db->bind('id_pesanan', $data['id_penyewa']);
        $this->db->bind('total_biaya', $data['total_biaya']);
        $this->db->bind('jumlah_bayar', $data['jumlah_bayar']);
        $this->db->bind('status', $data['status']);
        $this->db->execute();

        return $this->db->rowCount();
    }
}
