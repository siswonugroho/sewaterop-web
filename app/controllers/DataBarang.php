<?php

class DataBarang extends Controller
{

    public function index()
    {
        if (Session::isLoggedIn()) {
            $data['judul'] = 'Daftar Barang';
            $data['nav-link'] = 'Barang';
            $this->view('templates/header', $data);
            $this->view('templates/navs', $data);
            $this->view('databarang/index', $data);
            $this->view('templates/footer');
        } else {
            header('location: ' . filter_var(BASEURL . '/login', FILTER_VALIDATE_URL));
        }
    }

    public function pagetambah()
    {
        if (Session::isLoggedIn()) {
            $data['judul'] = 'Tambah Barang Baru';
            $data['nav-link'] = 'Barang';
            $data['id_barang'] = $this->model("Barang_model")->auto_id();
            $this->view('templates/header', $data);
            $this->view('templates/navs', $data);
            $this->view('databarang/pagetambah', $data);
            $this->view('templates/footer');
        } else {
            header('location: ' . filter_var(BASEURL . '/login', FILTER_VALIDATE_URL));
        }
    }

    public function tambah()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $submittedData = [
                'id_barang' => $_POST['id_barang'],
                'nama_barang' => $_POST['nama_barang'],
                'foto_barang' => $this->checkAndUploadImage($_FILES['foto_barang']),
                'harga' => $_POST['harga'],
                'stok' => $_POST['stok']
            ];

            if ($this->model('Barang_model')->tambahDataBarang($submittedData) > 0) {
                Flasher::setFlash('Barang berhasil ditambahkan', 'success');
                header('location:' . filter_var(BASEURL . '/databarang', FILTER_VALIDATE_URL));
                exit;
            } else {
                Flasher::setFlash('Tidak dapat menambahkan barang', 'danger', 'x-circle');
                header('location:' . filter_var(BASEURL . '/databarang', FILTER_VALIDATE_URL));
                exit;
            }

        }
    }

    public function edit()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $submittedData = [
                'id_barang' => $_POST['id_barang'],
                'nama_barang' => $_POST['nama_barang'],
                'foto_barang_lama' => $_POST['foto_barang_lama'],
                'foto_barang' => '',
                'harga' => $_POST['harga'],
                'stok' => $_POST['stok']
            ];

            if($_FILES['foto_barang']['error'] === 4) {
                $submittedData['foto_barang'] = $submittedData['foto_barang_lama'];
            } else {
                $submittedData['foto_barang'] = $this->checkAndUploadImage($_FILES['foto_barang']);
                if (file_exists('resources/img/databarang/' . $submittedData['foto_barang_lama'])) unlink('resources/img/databarang/' . $submittedData['foto_barang_lama']);
            }

            if ($this->model('Barang_model')->editDataBarang($submittedData) > 0) {
                Flasher::setFlash('Data barang berhasil diperbarui', 'success');
                header('location:' . filter_var(BASEURL . '/databarang', FILTER_VALIDATE_URL));
                exit;
            } else {
                Flasher::setFlash('Tidak dapat memperbarui data barang', 'danger', 'x-circle');
                header('location:' . filter_var(BASEURL . '/databarang', FILTER_VALIDATE_URL));
                exit;
            }

        }
    }

    public function hapus($id)
    {
        if ($this->model('Barang_model')->hapusDataBarang($id) > 0) {
            Flasher::setFlash('Data barang berhasil dihapus', 'success');
            header('location:' . filter_var(BASEURL . '/databarang', FILTER_VALIDATE_URL));
            exit;
        } else {
            Flasher::setFlash('Tidak dapat menghapus data barang', 'danger', 'x-circle');
            header('location:' . filter_var(BASEURL . '/databarang', FILTER_VALIDATE_URL));
            exit;
        }
    }

    private function checkAndUploadImage($foto)
    {
        $namaFile = $foto['name'];
        $tipeFile = $foto['type'];
        $tipeFileValid = ['image/jpeg', 'image/jpg', 'image/png'];

        // cek apakah tipe file yg diupload berupa file gambar
        if (!in_array($tipeFile, $tipeFileValid)) return false;

        // ubah nama file menjadi random
        $ekstensiFile = explode('.', $namaFile);
        $ekstensiFile = strtolower(end($ekstensiFile));
        $namaFileBaru = uniqid();
        $namaFileBaru .= '.';
        $namaFileBaru .= $ekstensiFile;
        
        $this->uploadImage($_FILES['foto_barang']['tmp_name'], $namaFileBaru);

        return $namaFileBaru;
    }

    private function uploadImage($tmpFile, $namaFoto)
    {
        $tmpFile = $tmpFile;
        move_uploaded_file($tmpFile, 'resources/img/databarang/' . $namaFoto);
    }

    public function pageEdit($id)
    {
        if (Session::isLoggedIn()) {
            $data['formvalue']= $this->model('Barang_model')->getBarangById($id);
            $data['judul'] = 'Edit Barang';
            $data['nav-link'] = 'Barang';
            $this->view('templates/header', $data);
            $this->view('templates/navs', $data);
            $this->view('databarang/pageedit',$data);
            $this->view('templates/footer');
        } else {
            header('location: ' . filter_var(BASEURL . '/login', FILTER_VALIDATE_URL));
        }
    }

    public function getListBarang()
    {
        echo json_encode($this->model('Barang_model')->getListBarang());
    }
}
