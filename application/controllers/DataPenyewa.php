<?php

class DataPenyewa extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('Penyewa_model');
  }

  public function index()
  {
    if (isLoggedIn()) {
      $data['judul'] = 'Daftar Penyewa';
      $data['nav_link'] = 'Penyewa';
      $this->load->view('templates/header', $data);
      $this->load->view('templates/navs', $data);
      $this->load->view('datapenyewa/index', $data);
      $this->load->view('templates/footer');
    } else {
      header('login');
    }
  }

  public function getListPenyewa()
  {
    if (isLoggedIn()) {
      $this->responsejson->send_response_json($this->Penyewa_model->getListPenyewa(), 200);
    } else {
      redirect('login');
    }
  }

  public function pagetambah()
  {
    if (isLoggedIn()) {
      $data['judul'] = 'Tambah Penyewa Baru';
      $data['nav_link'] = 'Penyewa';
      $data['id_penyewa'] = $this->Penyewa_model->auto_id();
      $this->load->view('templates/header', $data);
      $this->load->view('templates/navs', $data);
      $this->load->view('datapenyewa/pagetambah', $data);
      $this->load->view('templates/footer');
    } else {
      redirect('login');
    }
  }

  public function pageEdit($id)
  {
    if (isLoggedIn()) {
      $data['formvalue'] = $this->Penyewa_model->getPenyewaById($id);
      $data['judul'] = 'Edit Data Penyewa';
      $data['nav_link'] = 'Penyewa';
      $this->load->view('templates/header', $data);
      $this->load->view('templates/navs', $data);
      $this->load->view('datapenyewa/pageedit', $data);
      $this->load->view('templates/footer');
    } else {
      redirect('login');
    }
  }

  public function tambah()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isLoggedIn()) {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $submittedData = [
        'id_penyewa' => $_POST['id_penyewa'],
        'nama_penyewa' => $_POST['nama_penyewa'],
        'username' => $_POST['username'],
        'alamat' => $_POST['alamat'],
        'telepon' => $_POST['telepon']
      ];

      if ($this->Penyewa_model->tambahDataPenyewa($submittedData)) {
        setFlash('Penyewa berhasil ditambahkan', 'success', 'check-circle');
        redirect('datapenyewa');
        exit;
      } else {
        setFlash('Tidak dapat menambahkan penyewa baru', 'danger', 'x-circle');
        redirect('datapenyewa');
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

      $submittedData = [
        'id_penyewa' => $_POST['id_penyewa'],
        'nama_penyewa' => $_POST['nama_penyewa'],
        'username' => $_POST['username'],
        'alamat' => $_POST['alamat'],
        'telepon' => $_POST['telepon']
      ];

      if ($this->Penyewa_model->editDataPenyewa($submittedData) > 0) {
        setFlash('Data penyewa berhasil diperbarui', 'success', 'check-circle');
        redirect('datapenyewa');
        exit;
      } else {
        setFlash('Tidak dapat memperbarui data penyewa', 'danger', 'x-circle');
        redirect('datapenyewa');
        exit;
      }
    } else {
      redirect('login');
    }
  }

  public function hapus($id)
  {
    if (isLoggedIn()) {
      if ($this->Penyewa_model->hapusDataPenyewa($id)) {
        setFlash('Penyewa berhasil dihapus', 'success', 'check-circle');
        redirect('datapenyewa');
        exit;
      } else {
        setFlash('Tidak dapat menghapus penyewa.<br>Pastikan semua sewaan dan riwayat dari orang ini dihapus terlebih dahulu.</br>', 'danger', 'x-circle');
        redirect('datapenyewa');
        exit;
      }
    } else {
      redirect('login');
    }
  }
}
