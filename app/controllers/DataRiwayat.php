<?php

class DataRiwayat extends Controller {

    public function index()
    {
        if (Session::isLoggedIn()) {
            $data['judul'] = 'Riwayat Transaksi';
            $data['nav-link'] = 'Riwayat';
            $this->view('templates/header', $data);
            $this->view('templates/navs', $data);
            $this->view('datariwayat/index', $data);
            $this->view('templates/footer');
        } else {
            header('location: ' . filter_var(BASEURL . '/login', FILTER_VALIDATE_URL));
        }
    }

    public function getListRiwayat()
    {
        echo json_encode($this->model('Riwayat_model')->getListRiwayat());
    }

    public function viewReport($id_sewaan)
    {
        if (Session::isLoggedIn()) {
            $data['judul'] = 'Struk Transaksi';
            $data['nav-link'] = 'Riwayat';
            $data['formvalue'] = [];
            $rawData = $this->model('Riwayat_model')->getRiwayatById($id_sewaan);

            foreach ($rawData as $key => $value) {
                $data['formvalue'][$key] = $value;
            }
            
            $data['formvalue']['barang_sewaan'] = [];
            $barangSewaan = $this->model('Sewaan_model')->getBarangSewaan($data['formvalue']['id_paket']);
            foreach ($barangSewaan as $value) {
                $data['formvalue']['barang_sewaan']['id_barang'][] = $value['id_barang'];
                $data['formvalue']['barang_sewaan']['nama_barang'][] = $value['nama_barang'];
                $data['formvalue']['barang_sewaan']['harga_barang'][] = $value['harga_barang'];
                $data['formvalue']['barang_sewaan']['jumlah_barang'][] = $value['jumlah_barang'];
            }

            $this->view('templates/header', $data);
            $this->view('datariwayat/viewreport', $data);
            $this->view('templates/footer');
        } else {
            header('location: ' . filter_var(BASEURL . '/login', FILTER_VALIDATE_URL));
        }
    }
}