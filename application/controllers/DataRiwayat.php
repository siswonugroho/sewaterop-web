<?php

class DataRiwayat extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('Riwayat_model');
    $this->load->model('Sewaan_model');
    $this->load->model('Paket_model');
  }

  public function index($blmLunas = false)
  {
    if (isLoggedIn()) {
      $data['judul'] = 'Riwayat Transaksi';
      $data['nav_link'] = 'Riwayat';
      $data['is_blm_lunas'] = $blmLunas;
      $this->load->view('templates/header', $data);
      $this->load->view('templates/navs', $data);
      $this->load->view('datariwayat/index', $data);
      $this->load->view('templates/footer');
    } else {
      redirect('login');
    }
  }

  public function getListRiwayat()
  {
    $this->responsejson->send_response_json($this->Riwayat_model->getListRiwayat());
  }

  public function viewReport($id_sewaan)
  {
    if (isLoggedIn()) {
      $data['judul'] = 'Struk Transaksi';
      $data['nav_link'] = 'Riwayat';
      $data['formvalue'] = [];
      $rawData = $this->Riwayat_model->getRiwayatById($id_sewaan);

      foreach ($rawData as $key => $value) {
        $data['formvalue'][$key] = $value;
      }

      $data['formvalue']['barang_sewaan'] = [];
      $barangSewaan = $this->Sewaan_model->getBarangSewaan($data['formvalue']['id_paket']);
      foreach ($barangSewaan as $value) {
        $data['formvalue']['barang_sewaan']['id_barang'][] = $value['id_barang'];
        $data['formvalue']['barang_sewaan']['nama_barang'][] = $value['nama_barang'];
        $data['formvalue']['barang_sewaan']['harga_barang'][] = $value['harga_barang'];
        $data['formvalue']['barang_sewaan']['jumlah_barang'][] = $value['jumlah_barang'];
      }

      $this->load->view('templates/header', $data);
      $this->load->view('datariwayat/viewreport', $data);
      $this->load->view('templates/footer');
    } else {
      redirect('login');
    }
  }

  public function hapus($id, $id_paket)
  {
    if (isLoggedIn()) {
      if ($this->Sewaan_model->hapusDataSewaan($id) > 0) {
        if (startsWith($id_paket, 'sw')) {
          $this->Paket_model->hapusDataPaket($id_paket);
        }
        setFlash('Riwayat berhasil dihapus', 'success', 'check-circle');
        redirect('datariwayat');
        exit;
      } else {
        setFlash('Tidak dapat menghapus riwayat.', 'danger', 'x-circle');
        redirect('datariwayat');
        exit;
      }
    } else {
      redirect('login');
    }
  }
}
