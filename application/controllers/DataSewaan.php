<?php

class DataSewaan extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('Sewaan_model');
    $this->load->model('Penyewa_model');
    $this->load->model('Paket_model');
    $this->load->model('Barang_model');
  }

  public function index()
  {
    if (isLoggedIn()) {
      $data['judul'] = 'Daftar Sewaan';
      $data['nav_link'] = 'Sewaan';
      $this->load->view('templates/header', $data);
      $this->load->view('templates/navs', $data);
      $this->load->view('datasewaan/index', $data);
      $this->load->view('templates/footer');
    } else {
      redirect('login');
    }
  }

  public function pagetambah()
  {
    if (isLoggedIn()) {
      $data['judul'] = 'Buat Sewa Baru';
      $data['nav_link'] = 'Sewaan';
      $data['id_sewaan'] = $this->Sewaan_model->auto_id();
      $this->load->view('templates/header', $data);
      $this->load->view('templates/navs', $data);
      $this->load->view('datasewaan/pagetambah', $data);
      $this->load->view('templates/footer');
    } else {
      redirect('login');
    }
  }

  public function details($page, $id)
  {
    if (isLoggedIn()) {
      $data['judul'] = 'Detail Sewaan';
      $data['nav_link'] = 'Sewaan';
      $data['formvalue'] = [];
      $rawData = $this->Sewaan_model->getSewaanById($id);

      foreach ($rawData as $key => $value) {
        $data['formvalue'][$key] = $value;
      }
      $infoPenyewa = $this->Penyewa_model->getPenyewaById($data['formvalue']['id_pemesan']);
      $data['formvalue']['alamat'] = $infoPenyewa['alamat'];
      $data['formvalue']['telepon'] = $infoPenyewa['telepon'];

      $data['formvalue']['barang_sewaan'] = [];
      $barangSewaan = $this->Sewaan_model->getBarangSewaan($data['formvalue']['id_paket']);
      foreach ($barangSewaan as $value) {
        $data['formvalue']['barang_sewaan']['id_barang'][] = $value['id_barang'];
        $data['formvalue']['barang_sewaan']['nama_barang'][] = $value['nama_barang'];
        $data['formvalue']['barang_sewaan']['foto_barang'][] = $value['foto_barang'];
        $data['formvalue']['barang_sewaan']['harga'][] = $value['harga_barang'];
        $data['formvalue']['barang_sewaan']['jumlah_barang'][] = $value['jumlah_barang'];
      }

      $this->load->view('templates/header', $data);
      $this->load->view('templates/navs', $data);
      $this->load->view('datasewaan/' . $page, $data);
      $this->load->view('templates/footer');
    } else {
      redirect('login');
    }
  }

  public function getListSewaan()
  {
    if (isLoggedIn()) {
      $data = $this->Sewaan_model->getListSewaan();
      $output = [];
      foreach ($data as $key => $value) {
        $output[$key]['id_pesanan'] = $value['id_pesanan'];
        $output[$key]['nama_pemesan'] = $value['nama_pemesan'];
        $output[$key]['tgl_mulai'] = $value['tgl_mulai'];
        $output[$key]['waktu_mulai'] = $value['waktu_mulai'];
        $output[$key]['tgl_selesai'] = $value['tgl_selesai'];
        $output[$key]['waktu_selesai'] = $value['waktu_selesai'];
        $output[$key]['id_paket'] = $value['id_paket'];
        $output[$key]['nama_paket'] = $value['nama_paket'];
        $output[$key]['barang_sewaan'] = [];

        $barangSewaan = $this->Sewaan_model->getBarangSewaan($value['id_pesanan']);
        foreach ($barangSewaan as $value) {
          $output[$key]['barang_sewaan']['nama_barang'][] = $value['nama_barang'];
          $output[$key]['barang_sewaan']['jumlah_barang'][] = $value['jumlah_barang'];
        }
      }
      $this->responsejson->send_response_json($output);
    } else {
      redirect('login');
    }
  }

  public function tambah()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isLoggedIn()) {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $submittedData = [
        'id_sewaan' => $_POST['id_sewaan'],
        'id_penyewa' => $_POST['id_penyewa'],
        'nama_penyewa' => $_POST['nama_penyewa'],
        'tgl_mulai' => $_POST['tgl_mulai'] . ' ' . $_POST['waktu_mulai'],
        'tgl_selesai' => $_POST['tgl_selesai'] . ' ' . $_POST['waktu_selesai'],
        'status' => "berlangsung"
      ];
      
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

        if ($this->Paket_model->tambahDataPaket($barangSewaan) > 0) {
          $submittedData['id_paket'] = $barangSewaan['id_paket'];
        } else {
          setFlash('Tidak dapat menambahkan sewaan', 'danger', 'x-circle');
          redirect(filter_var($_SERVER['HTTP_REFERER'], FILTER_VALIDATE_URL));
          exit;
        }
      } else if ($_POST['tipe_sewaan'] === 'paket') {
        $submittedData['id_paket'] = $_POST['id_paket'];
      }

      $this->updateStokBarang($submittedData['id_paket'], 'kurangi');

      if ($this->Sewaan_model->tambahDataSewaan($submittedData)) {
        setFlash('Sewaan berhasil ditambahkan', 'success', 'check-circle');
        redirect('datasewaan');
        exit;
      } else {
        setFlash('Tidak dapat menambahkan sewaan', 'danger', 'x-circle');
        redirect('datasewaan');
        exit;
      }
    } else {
      redirect('login');
    }
  }

  public function edit()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isLoggedIn()) {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $submittedData = [];

      $submittedData['id_sewaan'] = $_POST['id_sewaan'];
      $submittedData['id_penyewa'] = $_POST['id_penyewa'];
      $submittedData['nama_penyewa'] = $_POST['nama_penyewa'];
      $submittedData['tgl_mulai'] = $_POST['tgl_mulai'] . ' ' . $_POST['waktu_mulai'];
      $submittedData['tgl_selesai'] = $_POST['tgl_selesai'] . ' ' . $_POST['waktu_selesai'];
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

        if (count($this->Paket_model->getPaketById($barangSewaan['id_paket'])) > 0) {
          // Jika sebelumnya sudah ada barang sewaan custom, maka cukup perbarui isi barang sewaan tersebut
          if ($this->Paket_model->editDataPaket($barangSewaan) <= 0) {
            setFlash('Tidak dapat memperbarui sewaan', 'danger', 'x-circle');
            redirect('datasewaan');
            exit;
          }
        } else {
          // Jika tidak ada alias beralih dari paket sewa ke daftar barang custom, maka ganti id_paket submittedData ke id paket custom
          if ($this->Paket_model->tambahDataPaket($barangSewaan) <= 0) {
            setFlash('Tidak dapat memperbarui sewaan', 'danger', 'x-circle');
            redirect('datasewaan');
            exit;
          }
        }
        $submittedData['id_paket'] = $barangSewaan['id_paket'];
      } else if ($_POST['tipe_sewaan'] === 'paket') {
        // Jika kita beralih dari daftar custom ke paket sewa, maka hapus paket custom yang lama,
        // kemudian isi id_paket di submittedData dengan id dari paket sewa
        if (startsWith($_POST['id_paket_lama'], 'sw')) {
          if ($this->Paket_model->hapusDataPaket($_POST['id_paket_lama']) <= 0) {
            setFlash('Tidak dapat memperbarui sewaan', 'danger', 'x-circle');
            redirect('datasewaan');
            exit;
          }
        }
        $submittedData['id_paket'] = $_POST['id_paket'];
      }

      $this->updateStokBarang($submittedData['id_paket'], 'kurangi');

      if ($this->Sewaan_model->editDataSewaan($submittedData) > 0) {
        setFlash('Sewaan berhasil diperbarui', 'success', 'check-circle');
        redirect('datasewaan');
        exit;
      } else {
        setFlash('Gagal memperbarui sewaan.', 'danger', 'x-circle');
        redirect('datasewaan');
        exit;
      }
    } else {
      redirect('login');
    }
  }

  public function hapus($id, $id_paket)
  {
    if (isLoggedIn()) {
      if ($this->Sewaan_model->hapusDataSewaan($id)) {
        $this->updateStokBarang($id_paket, 'tambah');
        if (startsWith($id_paket, 'sw')) {
          $this->Paket_model->hapusDataPaket($id_paket);
        }
        setFlash('Sewaan berhasil dihapus', 'success', 'check-circle');
        redirect('datasewaan');
        exit;
      } else {
        setFlash('Tidak dapat menghapus item ini.', 'danger', 'x-circle');
        redirect('datasewaan');
        exit;
      }
    } else {
      redirect('login');
    }
  }

  public function selesaikanSewa()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isLoggedIn()) {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $submittedData = [];
      foreach ($_POST as $key => $value) {
        $submittedData[$key] = $value;
      }
      $submittedData['status_sewa'] = 'selesai';
      $this->updateStokBarang($submittedData['id_paket'], 'tambah');

      if ($this->Sewaan_model->selesaikanSewa($submittedData) > 0) {
        setFlash('Sewaan telah selesai dan dipindahkan ke riwayat. <a href="' . base_url('datariwayat/viewreport/'. $submittedData['id_sewaan'] ) . '" class="alert-link">Lihat bukti transaksi.</a>', 'success', 'check-circle');
        redirect('datasewaan');
        exit;
      } else {
        setFlash('Transaksi gagal diproses.', 'danger', 'x-circle');
        redirect('datasewaan');
        exit;
      }
    } else {
      redirect('login');
    }
  }

  private function updateStokBarang($id_paket, $operasi)
  {
    // Sebelum pesanan dibuat, potong stok barang
    $paket = $this->Paket_model->getPaketById($id_paket);
    foreach ($paket as $value) {
      $stokBaru = [];
      $stokSkrg = $this->Barang_model->getBarangById($value['id_barang']);
      $stokBaru['id_barang'] = $value['id_barang'];
      $stokBaru['nama_barang'] = $value['nama_barang'];
      if ($operasi === 'tambah') {
        $stokBaru['stok'] = intval($stokSkrg['stok'] + $value['jumlah_barang']);
      } elseif ($operasi === 'kurangi') {
        $stokBaru['stok'] = intval($stokSkrg['stok'] - $value['jumlah_barang']);
      }

      if ($stokBaru['stok'] < 0) {
        setFlash('Stok barang tidak cukup untuk barang/paket sewa yang dipilih.', 'danger', 'x-circle');
        redirect('datasewaan');
        exit;
      } else {
        if (!$this->Barang_model->updateStokBarang($stokBaru)) {
          setFlash('Kesalahan dalam memperbarui stok barang', 'danger', 'x-circle');
          redirect('datasewaan');
          exit;
        }
      }
    }
  }
}
