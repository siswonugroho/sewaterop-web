<?php

class Signup extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('User_model');
  }

  public function index()
  {
    $data = [
      'judul' => 'Buat Akun',
      'nama_admin' => '',
      'username' => '',
      'password' => '',
      'repassword' => ''
    ];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Sanitasi data post
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $data = [
        'judul' => 'Buat Akun',
        'nama_admin' => $_POST['nama_admin'],
        'username' => $_POST['username'],
        'password' => $_POST['password'],
        'repassword' => $_POST['repassword'],
        'status_user' => 'pending'
      ];
      // Hash password
      $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

      //  Buat akun
      $this->User_model->register($data);
      // Arahkan ke login
      unset($data['username'], $data['password'], $data['repassword']);
      setFlash('Akun berhasil dibuat', 'success', 'check-circle');
      redirect('login');
    }

    $this->load->view('templates/header', $data);
    $this->load->view('signup', $data);
    $this->load->view('templates/footer');
  }

  // public function success()
  // {
  //   $data = [
  //     'judul' => 'Akun berhasil dibuat'
  //   ];
  //   $this->view('templates/header', $data);
  //   $this->view('signup/success', $data);
  //   $this->view('templates/footer');
  // }

  public function getUsername()
  {
    echo $this->User_model->isUsernameAlreadyExists($_POST['username']);
  }
}
