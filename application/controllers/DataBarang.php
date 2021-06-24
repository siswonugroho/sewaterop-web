<?php

class DataBarang extends CI_Controller
{

  private $imgPath = 'assets/resources/img/databarang/';

  function __construct()
  {
    parent::__construct();
    $this->load->model('Barang_model');
  }

  public function index()
  {
    if (isLoggedIn()) {
      $data['judul'] = 'Daftar Barang';
      $data['nav_link'] = 'Barang';
      $this->load->view('templates/header', $data);
      $this->load->view('templates/navs', $data);
      $this->load->view('databarang/index', $data);
      $this->load->view('templates/footer');
    } else {
      redirect('login');
    }
  }

  public function getListBarang()
  {
    if (isLoggedIn()) {
      $this->responsejson->send_response_json($this->Barang_model->getListBarang());
    } else {
      redirect('login');
    }
  }

  public function pagetambah()
  {
    if (isLoggedIn()) {
      $data['judul'] = 'Tambah Barang Baru';
      $data['nav_link'] = 'Barang';
      $data['id_barang'] = $this->Barang_model->auto_id();
      $this->load->view('templates/header', $data);
      $this->load->view('templates/navs', $data);
      $this->load->view('databarang/pagetambah', $data);
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
        'id_barang' => $_POST['id_barang'],
        'nama_barang' => $_POST['nama_barang'],
        'foto_barang' => $this->imageuploader->checkAndUploadImage($_FILES['foto_barang'], $this->imgPath),
        'harga' => $_POST['harga'],
        'stok' => $_POST['stok']
      ];

      if ($this->Barang_model->tambahDataBarang($submittedData)) {
        setFlash('Barang berhasil ditambahkan', 'success', 'check-circle');
        redirect('databarang');
        exit;
      } else {
        setFlash('Tidak dapat menambahkan barang', 'danger', 'x-circle');
        redirect('databarang');
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
        'id_barang' => $_POST['id_barang'],
        'nama_barang' => $_POST['nama_barang'],
        'foto_barang_lama' => $_POST['foto_barang_lama'],
        'foto_barang' => '',
        'harga' => $_POST['harga'],
        'stok' => $_POST['stok']
      ];

      if ($_FILES['foto_barang']['error'] === 4) {
        $submittedData['foto_barang'] = $submittedData['foto_barang_lama'];
      } else {
        $submittedData['foto_barang'] = $this->imageuploader->checkAndUploadImage($_FILES['foto_barang'], $this->imgPath);
        if (file_exists($this->imgPath . $submittedData['foto_barang_lama'])) unlink($this->imgPath . $submittedData['foto_barang_lama']);
      }

      if ($this->Barang_model->editDataBarang($submittedData)) {
        setFlash('Data barang berhasil diperbarui', 'success', 'check-circle');
        redirect('databarang');
        exit;
      } else {
        setFlash('Tidak dapat memperbarui data barang', 'danger', 'x-circle');
        redirect('databarang');
        exit;
      }
    } else {
      redirect('login');
    }
  }

  public function hapus($id)
  {
    if (isLoggedIn()) {
      $imgFile = $this->Barang_model->getImageById($id);
      if (file_exists($this->imgPath . $imgFile['foto_barang'])) unlink($this->imgPath . $imgFile['foto_barang']);
      if ($this->Barang_model->hapusDataBarang($id) > 0) {
        setFlash('Data barang berhasil dihapus', 'success', 'check-circle');
        redirect('databarang');
        exit;
      } else {
        setFlash('Tidak dapat menghapus data barang', 'danger', 'x-circle');
        redirect('databarang');
        exit;
      }
    } else {
      redirect('login');
    }
  }

  public function pageEdit($id)
  {
    if (isLoggedIn()) {
      $data['formvalue'] = $this->Barang_model->getBarangById($id);
      $data['judul'] = 'Edit Barang';
      $data['nav_link'] = 'Barang';
      $this->load->view('templates/header', $data);
      $this->load->view('templates/navs', $data);
      $this->load->view('databarang/pageedit', $data);
      $this->load->view('templates/footer');
    } else {
      redirect('login');
    }
  }
}
