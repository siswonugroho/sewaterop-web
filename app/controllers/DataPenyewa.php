<?php

class DataPenyewa extends Controller
{

    public function index()
    {
        if (Session::isLoggedIn()) {
            $data['judul'] = 'Daftar Penyewa';
            $data['nav-link'] = 'Penyewa';
            $this->view('templates/header', $data);
            $this->view('templates/navs', $data);
            $this->view('datapenyewa/index', $data);
            $this->view('templates/footer');
        } else {
            header('location: ' . filter_var(BASEURL . '/login', FILTER_VALIDATE_URL));
        }
    }

    public function pagetambah()
    {
        if (Session::isLoggedIn()) {
            $data['judul'] = 'Tambah Penyewa Baru';
            $data['nav-link'] = 'Penyewa';
            $data['id_penyewa'] = $this->model("Penyewa_model")->auto_id();
            $this->view('templates/header', $data);
            $this->view('templates/navs', $data);
            $this->view('datapenyewa/pagetambah', $data);
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
                'id_penyewa' => $_POST['id_penyewa'],
                'nama_penyewa' => $_POST['nama_penyewa'],
                'alamat' => $_POST['alamat'],
                'telepon' => $_POST['telepon']
            ];

            if ($this->model('Penyewa_model')->tambahDataPenyewa($submittedData) > 0) {
                Flasher::setFlash('Penyewa berhasil ditambahkan', 'success', 'check-circle');
                header('location:' . filter_var(BASEURL . '/datapenyewa', FILTER_VALIDATE_URL));
                exit;
            } else {
                Flasher::setFlash('Tidak dapat menambahkan penyewa baru', 'danger', 'x-circle');
                header('location:' . filter_var(BASEURL . '/datapenyewa', FILTER_VALIDATE_URL));
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
                'id_penyewa' => $_POST['id_penyewa'],
                'nama_penyewa' => $_POST['nama_penyewa'],
                'alamat' => $_POST['alamat'],
                'telepon' => $_POST['telepon']
            ];

            if ($this->model('Penyewa_model')->editDataPenyewa($submittedData) > 0) {
                Flasher::setFlash('Data penyewa berhasil diperbarui', 'success', 'check-circle');
                header('location:' . filter_var(BASEURL . '/datapenyewa', FILTER_VALIDATE_URL));
                exit;
            } else {
                Flasher::setFlash('Tidak dapat memperbarui data penyewa', 'danger', 'x-circle');
                header('location:' . filter_var(BASEURL . '/datapenyewa', FILTER_VALIDATE_URL));
                exit;
            }
        } else {
            header('location: ' . filter_var(BASEURL . '/login', FILTER_VALIDATE_URL));
        }
    }

    public function hapus($id)
    {
        if (Session::isLoggedIn()) {
            if ($this->model('Penyewa_model')->hapusDataPenyewa($id) > 0) {
                Flasher::setFlash('Penyewa berhasil dihapus', 'success', 'check-circle');
                header('location:' . filter_var(BASEURL . '/datapenyewa', FILTER_VALIDATE_URL));
                exit;
            } else {
                Flasher::setFlash('Tidak dapat menghapus penyewa', 'danger', 'x-circle');
                header('location:' . filter_var(BASEURL . '/datapenyewa', FILTER_VALIDATE_URL));
                exit;
            }
        } else {
            header('location: ' . filter_var(BASEURL . '/login', FILTER_VALIDATE_URL));
        }
    }

    public function pageEdit($id)
    {
        if (Session::isLoggedIn()) {
            $data['formvalue'] = $this->model('Penyewa_model')->getPenyewaById($id);
            $data['judul'] = 'Edit Data Penyewa';
            $data['nav-link'] = 'Penyewa';
            $this->view('templates/header', $data);
            $this->view('templates/navs', $data);
            $this->view('datapenyewa/pageedit', $data);
            $this->view('templates/footer');
        } else {
            header('location: ' . filter_var(BASEURL . '/login', FILTER_VALIDATE_URL));
        }
    }

    public function getListPenyewa()
    {
        if (Session::isLoggedIn()) {
            echo json_encode($this->model('Penyewa_model')->getListPenyewa());
        } else {
            header('location: ' . filter_var(BASEURL . '/login', FILTER_VALIDATE_URL));
        }
    }
}
