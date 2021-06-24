<?php

class Login extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model("User_model");
  }

  public function index()
  {
    $data['judul'] = "Login";
    $this->load->view('templates/header', $data);
    $this->load->view('login', $data);
    $this->load->view('templates/footer');
  }

  public function goLogin()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isLoggedIn()) {

      // Sanitasi data post
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $data = [
        'judul' => 'Login',
        'username' => $_POST['username'],
        'password' => $_POST['password'],
        'usernameError' => '',
        'passwordError' => ''
      ];

      // Jika tidak ada error, login
      $userLoggedIn = $this->User_model->goLogin($data['username'], $data['password']);
      if ($userLoggedIn) {
        if ($userLoggedIn->status_user === 'pending') {
          redirect('Login/pendingpage');
        } else {
          $this->createUserSession($userLoggedIn);
          redirect('Home/index');
        }
      } else {
        $data['passwordError'] = 'Username atau password salah';
        setFlash($data['passwordError'], 'danger', 'x-circle');
        redirect('Login/index');
      }

      unset($data['username'], $data['password']);
    } else {
      header('location:' . filter_var('javascript://history.go(-1)', FILTER_VALIDATE_URL));
    }
  }

  public function pendingPage()
  {
    $data['judul'] = 'Menunggu Persetujuan';
    $this->load->view('templates/header', $data);
    $this->load->view('pendingpage');
    $this->load->view('templates/footer');
  }

  public function createUserSession($user)
  {
    $_SESSION['user_id'] = $user->id_admin;
    $_SESSION['username'] = $user->username;
    $_SESSION['nama_admin'] = $user->nama_admin;
    $_SESSION['status_user'] = $user->status_user;
  }
}
