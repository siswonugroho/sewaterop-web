<?php

class Signup extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User_model');
    }

    public function index()
    {
        $data = [
            'judul' => 'Buat Akun',
            'username' => '',
            'password' => '',
            'repassword' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitasi data post
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'judul' => 'Buat Akun',
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
                'repassword' => trim($_POST['repassword']),
            ];
            // Hash password
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

            //  Buat akun
            $this->userModel->register($data);
            // Arahkan ke login
            header('location:' . filter_var(BASEURL . '/signup/success', FILTER_VALIDATE_URL));
            unset($data['username'], $data['password'], $data['repassword']);
        }

        $this->view('templates/header', $data);
        $this->view('templates/navbar');
        $this->view('signup/index', $data);
        $this->view('templates/footer');
    }

    public function success()
    {
        $data = [
            'judul' => 'Akun berhasil dibuat'
        ];
        $this->view('templates/header', $data);
        $this->view('templates/navbar');
        $this->view('signup/success', $data);
        $this->view('templates/footer');
    }

    public function getUsername()
    {
        echo $this->model("User_model")->isUsernameAlreadyExists($_POST['username']);
    }
}
