<?php

class DataSewaan extends Controller
{

    public function index()
    {
        if (Session::isLoggedIn()) {
            $data['judul'] = 'Daftar Sewaan';
            $data['nav-link'] = 'Sewaan';
            $this->view('templates/header', $data);
            $this->view('templates/navs', $data);
            $this->view('datasewaan/index', $data);
            $this->view('templates/footer');
        } else {
            header('location: ' . filter_var(BASEURL . '/login', FILTER_VALIDATE_URL));
        }
    }

    public function pagetambah()
    {
        if (Session::isLoggedIn()) {
            $data['judul'] = 'Buat Sewa Baru';
            $data['nav-link'] = 'Sewaan';
            $data['id_sewaan'] = $this->model('Sewaan_model')->auto_id();
            $this->view('templates/header', $data);
            $this->view('templates/navs', $data);
            $this->view('datasewaan/pagetambah', $data);
            $this->view('templates/footer');
        } else {
            header('location: ' . filter_var(BASEURL . '/login', FILTER_VALIDATE_URL));
        }
    }

    public function details($page, $id)
    {
        if (Session::isLoggedIn()) {
            $data['judul'] = 'Detail Sewaan';
            $data['nav-link'] = 'Sewaan';
            $data['formvalue'] = [];
            $rawData = $this->model('Sewaan_model')->getSewaanById($id);

            foreach ($rawData as $key => $value) {
                $data['formvalue'][$key] = $value;
            }
            $infoPenyewa = $this->model('Penyewa_model')->getPenyewaById($data['formvalue']['id_pemesan']);
            $data['formvalue']['alamat'] = $infoPenyewa['alamat'];
            $data['formvalue']['telepon'] = $infoPenyewa['telepon'];

            $data['formvalue']['barang_sewaan'] = [];
            $barangSewaan = $this->model('Sewaan_model')->getBarangSewaan($data['formvalue']['id_paket']);
            foreach ($barangSewaan as $value) {
                $data['formvalue']['barang_sewaan']['id_barang'][] = $value['id_barang'];
                $data['formvalue']['barang_sewaan']['nama_barang'][] = $value['nama_barang'];
                $data['formvalue']['barang_sewaan']['foto_barang'][] = $value['foto_barang'];
                $data['formvalue']['barang_sewaan']['harga'][] = $this->model('Sewaan_model')->getHargaBarang($value['id_barang'])[$key];
                $data['formvalue']['barang_sewaan']['jumlah_barang'][] = $value['jumlah_barang'];
            }

            $this->view('templates/header', $data);
            $this->view('templates/navs', $data);
            $this->view('datasewaan/' . $page, $data);
            $this->view('templates/footer');
        } else {
            header('location: ' . filter_var(BASEURL . '/login', FILTER_VALIDATE_URL));
        }
    }

    public function getListSewaan()
    {
        if (Session::isLoggedIn()) {
            $data = $this->model('Sewaan_model')->getListSewaan();
            $output = [];
            foreach ($data as $key => $value) {
                $output[$key]['id_pesanan'] = $value['id_pesanan'];
                $output[$key]['nama_pemesan'] = $value['nama_pemesan'];
                $output[$key]['tgl_mulai'] = $value['tgl_mulai'];
                $output[$key]['tgl_selesai'] = $value['tgl_selesai'];
                $output[$key]['id_paket'] = $value['id_paket'];
                $output[$key]['nama_paket'] = $value['nama_paket'];
                $output[$key]['barang_sewaan'] = [];

                $barangSewaan = $this->model('Sewaan_model')->getBarangSewaan($value['id_pesanan']);
                foreach ($barangSewaan as $value) {
                    $output[$key]['barang_sewaan']['nama_barang'][] = $value['nama_barang'];
                    $output[$key]['barang_sewaan']['jumlah_barang'][] = $value['jumlah_barang'];
                }
            }
            echo json_encode($output);
        } else {
            header('location: ' . filter_var(BASEURL . '/login', FILTER_VALIDATE_URL));
        }
    }

    public function tambah()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && Session::isLoggedIn()) {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $submittedData = [];

            $submittedData['id_sewaan'] = $_POST['id_sewaan'];
            $submittedData['id_penyewa'] = $_POST['id_penyewa'];
            $submittedData['nama_penyewa'] = $_POST['nama_penyewa'];
            $submittedData['tgl_mulai'] = $_POST['tgl_mulai'];
            $submittedData['tgl_selesai'] = $_POST['tgl_selesai'];
            $submittedData['status'] = "berlangsung";

            // Jika sewaan berisi barang yang dipilih sendiri, buatkan sebuah paket khusus
            // yang bernama sama dengan id sewaan.
            // Jika sewaan berisi paket sewa, maka cukup 
            if ($_POST['tipe_sewaan'] === 'non-paket') {
                $barangSewaan = [];
                $barangSewaan['id_paket'] = $_POST['id_sewaan'];
                $barangSewaan['nama_paket'] = $_POST['id_sewaan'];
                $barangSewaan['harga'] = '';
                $hargaPerBarang = [];
                foreach ($_POST['paket']['id_barang'] as $key => $value) {
                    $barangSewaan['id_barang'][] = $_POST['paket']['id_barang'][$key];
                    $barangSewaan['nama_barang'][] = $_POST['paket']['nama_barang'][$key];
                    $barangSewaan['jumlah_barang'][] = $_POST['paket']['jumlah_barang'][$key];
                    $hargaPerBarang[$key] = intval($_POST['paket']['jumlah_barang'][$key]) * intval($_POST['paket']['harga'][$key]);
                }
                $barangSewaan['harga'] = array_sum($hargaPerBarang);

                if ($this->model('Paket_model')->tambahDataPaket($barangSewaan) > 0) {
                    $submittedData['id_paket'] = $barangSewaan['id_paket'];
                } else {
                    Flasher::setFlash('Tidak dapat menambahkan sewaan', 'danger', 'x-circle');
                    header('location:' . filter_var($_SERVER['HTTP_REFERER'], FILTER_VALIDATE_URL));
                    exit;
                }
            } else if ($_POST['tipe_sewaan'] === 'paket') {
                $submittedData['id_paket'] = $_POST['id_paket'];
            }

            $this->updateStokBarang($submittedData['id_paket'], 'kurangi');

            if ($this->model('Sewaan_model')->tambahDataSewaan($submittedData) > 0) {
                Flasher::setFlash('Sewaan berhasil ditambahkan', 'success', 'check-circle');
                header('location:' . filter_var(BASEURL . '/datasewaan', FILTER_VALIDATE_URL));
                exit;
            } else {
                Flasher::setFlash('Tidak dapat menambahkan sewaan', 'danger', 'x-circle');
                header('location:' . filter_var(BASEURL . '/datasewaan', FILTER_VALIDATE_URL));
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

            $submittedData = [];

            $submittedData['id_sewaan'] = $_POST['id_sewaan'];
            $submittedData['id_penyewa'] = $_POST['id_penyewa'];
            $submittedData['nama_penyewa'] = $_POST['nama_penyewa'];
            $submittedData['tgl_mulai'] = $_POST['tgl_mulai'];
            $submittedData['tgl_selesai'] = $_POST['tgl_selesai'];
            $submittedData['status'] = "berlangsung";
            $this->updateStokBarang($_POST['id_paket_lama'], 'tambah');

            // Jika sewaan berisi barang yang dipilih sendiri, buatkan sebuah paket khusus
            // yang bernama sama dengan id sewaan.
            if ($_POST['tipe_sewaan'] === 'non-paket') {
                $barangSewaan = [];
                $barangSewaan['id_paket'] = $_POST['id_sewaan'];
                $barangSewaan['nama_paket'] = $_POST['id_sewaan'];
                $barangSewaan['harga'] = '';
                $hargaPerBarang = [];
                foreach ($_POST['paket']['id_barang'] as $key => $value) {
                    $barangSewaan['id_barang'][] = $_POST['paket']['id_barang'][$key];
                    $barangSewaan['nama_barang'][] = $_POST['paket']['nama_barang'][$key];
                    $barangSewaan['jumlah_barang'][] = $_POST['paket']['jumlah_barang'][$key];
                    $hargaPerBarang[$key] = intval($_POST['paket']['jumlah_barang'][$key]) * intval($_POST['paket']['harga'][$key]);
                }
                $barangSewaan['harga'] = array_sum($hargaPerBarang);

                if (count($this->model('Paket_model')->getPaketById($barangSewaan['id_paket'])) > 0) {
                    // Jika sebelumnya sudah ada barang sewaan custom, maka cukup perbarui isi barang sewaan tersebut
                    if ($this->model('Paket_model')->editDataPaket($barangSewaan) <= 0) {
                        Flasher::setFlash('Tidak dapat memperbarui sewaan', 'danger', 'x-circle');
                        header('location:' . filter_var(BASEURL . '/datasewaan', FILTER_VALIDATE_URL));
                        exit;
                    }
                } else {
                    // Jika tidak ada alias beralih dari paket sewa ke daftar barang custom, maka ganti id_paket submittedData ke id paket custom
                    if ($this->model('Paket_model')->tambahDataPaket($barangSewaan) <= 0) {
                        Flasher::setFlash('Tidak dapat memperbarui sewaan', 'danger', 'x-circle');
                        header('location:' . filter_var(BASEURL . '/datasewaan', FILTER_VALIDATE_URL));
                        exit;
                    }
                }
                $submittedData['id_paket'] = $barangSewaan['id_paket'];
                
            } else if ($_POST['tipe_sewaan'] === 'paket') {
                // Jika kita beralih dari daftar custom ke paket sewa, maka hapus paket custom yang lama,
                // kemudian isi id_paket di submittedData dengan id dari paket sewa
                if (Formatter::startsWith($_POST['id_paket_lama'], 'sw')) {
                    if ($this->model('Paket_model')->hapusDataPaket($_POST['id_paket_lama']) <= 0) {
                        Flasher::setFlash('Tidak dapat memperbarui sewaan', 'danger', 'x-circle');
                        header('location:' . filter_var(BASEURL . '/datasewaan', FILTER_VALIDATE_URL));
                        exit;
                    }
                }
                $submittedData['id_paket'] = $_POST['id_paket'];
            }
           
            $this->updateStokBarang($submittedData['id_paket'], 'kurangi');
            
            if ($this->model('Sewaan_model')->editDataSewaan($submittedData) > 0) {
                Flasher::setFlash('Sewaan berhasil diperbarui', 'success', 'check-circle');
                header('location:' . filter_var(BASEURL . '/datasewaan', FILTER_VALIDATE_URL));
                exit;
            } else {
                Flasher::setFlash('Gagal memperbarui sewaan.' , 'danger', 'x-circle');
                header('location:' . filter_var(BASEURL . '/datasewaan', FILTER_VALIDATE_URL));
                exit;
            }
        } else {
            header('location: ' . filter_var(BASEURL . '/login', FILTER_VALIDATE_URL));
        }
    }

    public function hapus($id, $id_paket)
    {
        if (Session::isLoggedIn()) {
            if ($this->model('Sewaan_model')->hapusDataSewaan($id) > 0) {
                $this->updateStokBarang($id_paket, 'tambah');
                if (Formatter::startsWith($id_paket, 'sw')) {
                    $this->model('Paket_model')->hapusDataPaket($id_paket);
                }
                Flasher::setFlash('Sewaan berhasil dihapus', 'success', 'check-circle');
                header('location:' . filter_var(BASEURL . '/datasewaan', FILTER_VALIDATE_URL));
                exit;
            } else {
                Flasher::setFlash('Tidak dapat menghapus sewaan.', 'danger', 'x-circle');
                header('location:' . filter_var(BASEURL . '/datasewaan', FILTER_VALIDATE_URL));
                exit;
            }
        } else {
            header('location: ' . filter_var(BASEURL . '/login', FILTER_VALIDATE_URL));
        }
    }

    public function selesaikanSewa()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && Session::isLoggedIn()) {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $submittedData = [];
            foreach ($_POST as $key => $value) {
                $submittedData[$key] = $value;
            }
            $submittedData['status_sewa'] = 'selesai';
            echo json_encode($submittedData);
            die;

            if ($this->model('Sewaan_model')->selesaikanSewa($submittedData) > 0) {
                Flasher::setFlash('Sewaan dan transaksi selesai <a href="' . BASEURL . '/datariwayat/viewreport/' . $submittedData['id_sewaan'] . '"', 'success', 'check-circle');
                header('location:' . filter_var(BASEURL . '/datasewaan', FILTER_VALIDATE_URL));
                exit;
            } else {
                Flasher::setFlash('Gagal melakukan transaksi.' , 'danger', 'x-circle');
                header('location:' . filter_var(BASEURL . '/datasewaan', FILTER_VALIDATE_URL));
                exit;
            }
        } else {
            header('location: ' . filter_var(BASEURL . '/login', FILTER_VALIDATE_URL));
        }
    }

    private function updateStokBarang($id_paket, $operasi)
    {
        // Sebelum pesanan dibuat, kurangi stok barang
        $paket = $this->model('Paket_model')->getPaketById($id_paket);
        foreach ($paket as $value) {
            $stokBaru = [];
            $stokSkrg = $this->model('Barang_model')->getBarangById($value['id_barang']);
            $stokBaru['id_barang'] = $value['id_barang'];
            $stokBaru['nama_barang'] = $value['nama_barang'];
            if ($operasi === 'tambah') {
                $stokBaru['stok'] = intval($stokSkrg['stok'] + $value['jumlah_barang']);
            } elseif ($operasi === 'kurangi') {
                $stokBaru['stok'] = intval($stokSkrg['stok'] - $value['jumlah_barang']);
            }

            if ($stokBaru['stok'] < 0) {
                Flasher::setFlash('Stok barang tidak cukup untuk barang/paket sewa yang dipilih.', 'danger', 'x-circle');
                header('location:' . filter_var(BASEURL . '/datasewaan', FILTER_VALIDATE_URL));
                exit;
            } else {
                if (!$this->model('Barang_model')->updateStokBarang($stokBaru) > 0) {
                    Flasher::setFlash('Kesalahan dalam memperbarui stok barang', 'danger', 'x-circle');
                    header('location:' . filter_var(BASEURL . '/datasewaan', FILTER_VALIDATE_URL));
                    exit;
                }
            }
        }
    }
}
