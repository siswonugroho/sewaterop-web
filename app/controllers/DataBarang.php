<?php

class DataBarang extends Controller{

    public function index()
    {
        if (Session::isLoggedIn()) {
            $data['judul'] = 'Daftar Barang';
            $data['nav-link'] = 'Barang';
            $this->view('templates/header', $data);
            $this->view('templates/navs', $data);
            $this->view('listbarang/index', $data);
            $this->view('templates/footer');
        } else {
            header('location: ' . filter_var(BASEURL . '/login' , FILTER_VALIDATE_URL));
        }
    }

    public function tambah()
    {
        if ($this->model('Barang_model')->tambahDataBarang($_POST) > 0) {
            Flasher::setFlash('Data barang berhasil ditambahkan', 'success');
            header('location:' . filter_var($_SERVER['HTTP_REFERER'], FILTER_VALIDATE_URL));
            exit;
        } else {
            Flasher::setFlash('Data barang gagal ditambahkan', 'danger', 'x-circle');
            header('location:' . filter_var($_SERVER['HTTP_REFERER'], FILTER_VALIDATE_URL));
            exit;
        }
    }

    public function getListBarang()
    {
        echo json_encode($this->model('Barang_model')->getListBarang());
    }
}