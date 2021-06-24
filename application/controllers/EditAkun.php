<?php

class EditAkun extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model("User_model");
  }

  public function changeUserInfo()
  {
    if (isLoggedIn()) {
      $data['user_info'] = $this->User_model->getUserInfo($_SESSION['user_id']);
      $data['judul'] = 'Edit Profil';
      $data['nav_link'] = 'Pengguna';

      $this->load->view('templates/header', $data);
      $this->load->view('templates/navs', $data);
      $this->load->view('dataadmin/changeuserinfo', $data);
      $this->load->view('templates/footer');
    } else {
      redirect('login');
    }
  }

  public function saveUserInfo()
  {
    if (isLoggedIn()) {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Sanitasi data post
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data['error_msg'] = 'Username ini sudah terdaftar';

        if ($this->User_model->updateUserInfo($_POST)) {
          setFlash('Profil berhasil diperbarui', 'success', 'check-circle');
          $_SESSION['nama_admin'] = $_POST['nama_admin'];
          redirect('home');
          exit;
        } else {
          setFlash('Gagal memperbarui profil', 'danger', 'x-circle');
          redirect('home');
          exit;
        }
      }
    } else {
      redirect('login');
    }
  }
}
