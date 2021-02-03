<?php

class DataAdmin extends Controller
{

  public function index()
  {
    if (Session::isLoggedIn()) {
      $data['judul'] = 'Kelola Admin';
      $data['nav-link'] = 'Pengguna';
      $this->view('templates/header', $data);
      $this->view('templates/navs', $data);
      $this->view('dataadmin/index', $data);
      $this->view('templates/footer');
    } else {
      header('location: ' . filter_var(BASEURL . '/login', FILTER_VALIDATE_URL));
    }
  }

  public function getListAdmin()
  {
    if (Session::isLoggedIn()) {
      echo json_encode($this->model('Admin_model')->getListAdmin());
    } else {
      header('location: ' . filter_var(BASEURL . '/login', FILTER_VALIDATE_URL));
    }
  }

  public function hapus($id_admin)
  {
    if (Session::isLoggedIn()) {
      if ($this->model("Admin_model")->hapusAdmin($id_admin) > 0) {
        Flasher::setFlash('Admin berhasil dihapus', 'success', 'check-circle');
        header('location:' . filter_var(BASEURL . '/dataadmin', FILTER_VALIDATE_URL));
        exit;
      } else {
        Flasher::setFlash('Gagal menghapus admin', 'danger', 'x-circle');
        header('location:' . filter_var(BASEURL . '/dataadmin', FILTER_VALIDATE_URL));
        exit;
      }
    } else {
      header('location: ' . filter_var(BASEURL . '/login', FILTER_VALIDATE_URL));
    }
  }

  public function approveAdmin($id_admin)
  {
    if (Session::isLoggedIn()) {
      if ($this->model("Admin_model")->approveAdmin($id_admin) > 0) {
        Flasher::setFlash('Berhasil dijadikan admin', 'success', 'check-circle');
        header('location:' . filter_var(BASEURL . '/dataadmin', FILTER_VALIDATE_URL));
        exit;
      } else {
        Flasher::setFlash('Gagal menjadikan admin', 'danger', 'x-circle');
        header('location:' . filter_var(BASEURL . '/dataadmin', FILTER_VALIDATE_URL));
        exit;
      }
    } else {
      header('location: ' . filter_var(BASEURL . '/login', FILTER_VALIDATE_URL));
    }
  }
}
