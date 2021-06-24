<?php

class DataAdmin extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Admin_model');
  }

  public function index()
  {
    if (isLoggedIn()) {
      $data['judul'] = 'Kelola Admin';
      $data['nav_link'] = 'Pengguna';
      $this->load->view('templates/header', $data);
      $this->load->view('templates/navs', $data);
      $this->load->view('dataadmin/index', $data);
      $this->load->view('templates/footer');
    } else {
      redirect('login');
    }
  }

  public function getListAdmin()
  {
    if (isLoggedIn()) {
      $this->responsejson->send_response_json($this->Admin_model->getListAdmin());
    } else {
      redirect('login');
    }
  }

  public function hapus($id_admin)
  {
    if (isLoggedIn()) {
      if ($this->Admin_model->hapusAdmin($id_admin)) {
        setFlash('Admin berhasil dihapus', 'success', 'check-circle');
        redirect('dataadmin');
        exit;
      } else {
        setFlash('Gagal menghapus admin', 'danger', 'x-circle');
        redirect('dataadmin');
        exit;
      }
    } else {
      redirect('login');
    }
  }

  public function approveAdmin($id_admin)
  {
    if (isLoggedIn()) {
      if ($this->Admin_model->approveAdmin($id_admin)) {
        setFlash('Berhasil dijadikan admin', 'success', 'check-circle');
        redirect('dataadmin');
        exit;
      } else {
        setFlash('Gagal menjadikan admin', 'danger', 'x-circle');
        redirect('dataadmin');
        exit;
      }
    } else {
      redirect('login');
    }
  }
}
