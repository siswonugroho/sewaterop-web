<?php

class DataPaketSewa extends Controller
{

    public function index()
    {
        if (Session::isLoggedIn()) {
            $data['judul'] = 'Daftar Paket Sewa';
            $data['nav-link'] = 'Paket Sewa';
            $this->view('templates/header', $data);
            $this->view('templates/navs', $data);
            $this->view('datapaketsewa/index', $data);
            $this->view('templates/footer');
        } else {
            header('location: ' . filter_var(BASEURL . '/login', FILTER_VALIDATE_URL));
        }
    }

    public function getListPaket()
    {
        $data = $this->model('Paket_model')->getListPaket();
        $output = array();
        foreach ($data as $value) {
            $output[$value['id_paket']]['id_paket'] = $value['id_paket'];
            $output[$value['id_paket']]['nama_paket'] = $value['nama_paket'];
            $output[$value['id_paket']]['harga'] = $value['harga'];
            $output[$value['id_paket']]['nama_barang'][] = $value['nama_barang'];
            $output[$value['id_paket']]['jumlah_barang'][] = $value['jumlah_barang'];
        }
        echo json_encode($output);
    }

    public function pagetambah()
    {
        if (Session::isLoggedIn()) {
            $data['judul'] = 'Tambah Paket Sewa';
            $data['nav-link'] = 'Paket Sewa';
            $data['id_paket'] = $this->model("Paket_model")->auto_id();
            $this->view('templates/header', $data);
            $this->view('templates/navs', $data);
            $this->view('datapaketsewa/pagetambah', $data);
            $this->view('templates/footer');
        } else {
            header('location: ' . filter_var(BASEURL . '/login', FILTER_VALIDATE_URL));
        }
    }

    public function details($page, $id)
    {
        if (Session::isLoggedIn()) {
            $data['judul'] = 'Paket Sewa';
            $data['nav-link'] = 'Paket Sewa';
            $data['formvalue'] = [];

            $rawData = $this->model("Paket_model")->getPaketById($id);
            foreach ($rawData as $value) {
                $data['formvalue']['id_paket'] = $value['id_paket'];
                $data['formvalue']['nama_paket'] = $value['nama_paket'];
                $data['formvalue']['harga'] = $value['harga'];
                $data['formvalue']['id_barang'][] = $value['id_barang'];
                $data['formvalue']['nama_barang'][] = $value['nama_barang'];
                $data['formvalue']['jumlah_barang'][] = $value['jumlah_barang'];
            }

            $this->view('templates/header', $data);
            $this->view('templates/navs', $data);
            $this->view('datapaketsewa/' . $page, $data);
            $this->view('templates/footer');
        } else {
            header('location: ' . filter_var(BASEURL . '/login', FILTER_VALIDATE_URL));
        }
    }

    public function tambah()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && Session::isLoggedIn()) {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


            $submittedData = [
                'id_paket' => $_POST['paket']['id_paket'],
                'nama_paket' => $_POST['paket']['nama_paket'],
                'harga' => $_POST['paket']['harga'],
                'id_barang' => [],
                'nama_barang' => [],
                'jumlah_barang' => [],
            ];

            foreach ($_POST['paket']['id_barang'] as $key => $value) {
                $submittedData['id_barang'][] = $_POST['paket']['id_barang'][$key];
                $submittedData['nama_barang'][] = $_POST['paket']['nama_barang'][$key];
                $submittedData['jumlah_barang'][] = $_POST['paket']['jumlah_barang'][$key];
            }

            if ($this->model('Paket_model')->tambahDataPaket($submittedData) > 0) {
                Flasher::setFlash('Paket sewa berhasil ditambahkan', 'success', 'check-circle');
                header('location:' . filter_var(BASEURL . '/datapaketsewa', FILTER_VALIDATE_URL));
                exit;
            } else {
                Flasher::setFlash('Tidak dapat menambahkan paket sewa', 'danger', 'x-circle');
                header('location:' . filter_var(BASEURL . '/datapaketsewa', FILTER_VALIDATE_URL));
                exit;
            }
        } else {
            header('location: ' . filter_var(BASEURL . '/login', FILTER_VALIDATE_URL));
        }
    }
    public function edit()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && Session::isLoggedIn()) {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


            $submittedData = [
                'id_paket' => $_POST['paket']['id_paket'],
                'nama_paket' => $_POST['paket']['nama_paket'],
                'harga' => $_POST['paket']['harga'],
                'id_barang' => [],
                'jumlah_barang' => [],
            ];

            foreach ($_POST['paket']['id_barang'] as $key => $value) {
                $submittedData['id_barang'][] = $_POST['paket']['id_barang'][$key];
                $submittedData['jumlah_barang'][] = $_POST['paket']['jumlah_barang'][$key];
            }

            if ($this->model('Paket_model')->editDataPaket($submittedData) > 0) {
                Flasher::setFlash('Paket sewa berhasil diubah', 'success', 'check-circle');
                header('location:' . filter_var(BASEURL . '/datapaketsewa', FILTER_VALIDATE_URL));
                exit;
            } else {
                Flasher::setFlash('Tidak dapat mengubah paket sewa', 'danger', 'x-circle');
                header('location:' . filter_var(BASEURL . '/datapaketsewa', FILTER_VALIDATE_URL));
                exit;
            }
        } else {
            header('location: ' . filter_var(BASEURL . '/login', FILTER_VALIDATE_URL));
        }
    }

    public function hapus($id)
    {
        if (Session::isLoggedIn()) {
            if ($this->model('Paket_model')->hapusDataPaket($id) > 0) {
                Flasher::setFlash('Paket sewa berhasil dihapus', 'success', 'check-circle');
                header('location:' . filter_var(BASEURL . '/datapaketsewa', FILTER_VALIDATE_URL));
                exit;
            } else {
                Flasher::setFlash('Tidak dapat menghapus paket sewa.', 'danger', 'x-circle');
                header('location:' . filter_var(BASEURL . '/datapaketsewa', FILTER_VALIDATE_URL));
                exit;
            }
        } else {
            header('location: ' . filter_var(BASEURL . '/login', FILTER_VALIDATE_URL));
        }
    }
}
