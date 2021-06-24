<?php

class DataPaketSewa extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('Paket_model');
  }

  public function index()
  {
    if (isLoggedIn()) {
      $data['judul'] = 'Daftar Paket Sewa';
      $data['nav_link'] = 'Paket Sewa';
      $this->load->view('templates/header', $data);
      $this->load->view('templates/navs', $data);
      $this->load->view('datapaketsewa/index', $data);
      $this->load->view('templates/footer');
    } else {
      redirect('login');
    }
  }

  public function getListPaket()
  {
    if (isLoggedIn()) {
      $data = $this->Paket_model->getListPaket();
      $output = array();
      foreach ($data as $value) {
        $output[$value['id_paket']]['id_paket'] = $value['id_paket'];
        $output[$value['id_paket']]['nama_paket'] = $value['nama_paket'];
        $output[$value['id_paket']]['harga'] = $value['harga'];
        $output[$value['id_paket']]['nama_barang'][] = $value['nama_barang'];
        $output[$value['id_paket']]['jumlah_barang'][] = $value['jumlah_barang'];
      }
      $this->responsejson->send_response_json($output, 200);
    } else {
      redirect('login');
    }
  }

  public function details($page, $id)
  {
    if (isLoggedIn()) {
      $data['judul'] = 'Paket Sewa';
      $data['nav_link'] = 'Paket Sewa';
      $data['formvalue'] = [];

      $rawData = $this->Paket_model->getPaketById($id);
      foreach ($rawData as $value) {
        $data['formvalue']['id_paket'] = $value['id_paket'];
        $data['formvalue']['nama_paket'] = $value['nama_paket'];
        $data['formvalue']['harga'] = $value['harga'];
        $data['formvalue']['id_barang'][] = $value['id_barang'];
        $data['formvalue']['nama_barang'][] = $value['nama_barang'];
        $data['formvalue']['jumlah_barang'][] = $value['jumlah_barang'];
        $data['formvalue']['foto_barang'][] = $this->Paket_model->getFotoBarang($data['formvalue']['id_barang']);
      }

      $this->load->view('templates/header', $data);
      $this->load->view('templates/navs', $data);
      $this->load->view('datapaketsewa/' . $page, $data);
      $this->load->view('templates/footer');
    } else {
      redirect('login');
    }
  }

  public function pagetambah()
  {
    if (isLoggedIn()) {
      $data['judul'] = 'Tambah Paket Sewa';
      $data['nav_link'] = 'Paket Sewa';
      $data['id_paket'] = $this->Paket_model->auto_id();
      $this->load->view('templates/header', $data);
      $this->load->view('templates/navs', $data);
      $this->load->view('datapaketsewa/pagetambah', $data);
      $this->load->view('templates/footer');
    } else {
      header('login');
    }
  }

  public function tambah()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isLoggedIn()) {
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

      if ($this->Paket_model->tambahDataPaket($submittedData) > 0) {
        setFlash('Paket sewa berhasil ditambahkan', 'success', 'check-circle');
        redirect('datapaketsewa');
        exit;
      } else {
        setFlash('Tidak dapat menambahkan paket sewa', 'danger', 'x-circle');
        redirect('datapaketsewa');
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

      if ($this->Paket_model->editDataPaket($submittedData) > 0) {
        setFlash('Paket sewa berhasil diubah', 'success', 'check-circle');
        redirect('datapaketsewa');
        exit;
      } else {
        setFlash('Tidak dapat mengubah paket sewa', 'danger', 'x-circle');
        redirect('datapaketsewa');
        exit;
      }
    } else {
      redirect('login');
    }
  }

  public function hapus($id)
  {
    if (isLoggedIn()) {
      if ($this->Paket_model->hapusDataPaket($id) > 0) {
        setFlash('Paket sewa berhasil dihapus', 'success', 'check-circle');
        redirect('datapaketsewa');
        exit;
      } else {
        setFlash('Tidak dapat menghapus paket sewa.', 'danger', 'x-circle');
        redirect('datapaketsewa');
        exit;
      }
    } else {
      redirect('login');
    }
  }
}
