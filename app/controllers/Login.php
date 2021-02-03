<?php

class Login extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User_model');
    }

    public function index()
    {
        $data = [
            'judul' => 'Login',
            'username' => '',
            'password' => '',
            'usernameError' => '',
            'passwordError' => '',
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitasi data post
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'judul' => 'Login',
                'username' => strip_tags($_POST['username']),
                'password' => strip_tags($_POST['password']),
                'usernameError' => '',
                'passwordError' => ''
            ];

            // Jika tidak ada error, login
                $userLoggedIn = $this->userModel->goLogin($data['username'], $data['password']);
                if ($userLoggedIn) {
                    if ($userLoggedIn['status_user'] === 'pending') {
                        header('location:' . filter_var(BASEURL . '/login/pendingpage' , FILTER_VALIDATE_URL));
                    } else {
                        $this->createUserSession($userLoggedIn);
                        header('location:' . filter_var(BASEURL , FILTER_VALIDATE_URL));
                    }
                } else {
                    $data['passwordError'] = 'Username atau password salah';
                    Flasher::setFlash($data['passwordError'], 'danger', 'x-circle');
                }

            unset($data['username'], $data['password']);
        }

            $this->view('templates/header', $data);
            $this->view('login/index', $data);
            $this->view('templates/footer');
    }

    public function pendingPage()
    {
        $data['judul'] = 'Menunggu Persetujuan';
        $this->view('templates/header', $data);
        $this->view('login/pendingpage');
        $this->view('templates/footer');
    }

    public function createUserSession($user)
    {
        $_SESSION['user_id'] = $user['id_admin'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['nama_admin'] = $user['nama_admin'];
        $_SESSION['status_user'] = $user['status_user'];
    }
}
