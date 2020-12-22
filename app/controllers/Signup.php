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
            'repassword' => '',
            'usernameError' => [],
            'passwordError' => [],
            'repasswordError' => [],
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitasi data post
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'judul' => 'Buat Akun',
                'username' => strip_tags($_POST['username']),
                'password' => strip_tags($_POST['password']),
                'repassword' => strip_tags($_POST['repassword']),
                'usernameError' => [],
                'passwordError' => [],
                'repasswordError' => [],
            ];
            $charValidation = "/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/";

            // Validasi karakter username
            if (empty($data['username'])) {
                $data['usernameError'] = ['Harap masukkan username.', 'is-invalid'];
            } else if (!preg_match($charValidation, $data['username'])) {
                $data['usernameError'] = ['Username harus terdiri dari huruf dan angka.', 'is-invalid'];
            } else if ($this->userModel->isUsernameAlreadyExists($data['username'])) {
                $data['usernameError'] = ['Username ini telah terdaftar.', 'is-invalid'];
            }


            // Validasi panjang password dan angka
            if (empty($data['password'])) {
                $data['passwordError'] = ['Harap masukkan password.', 'is-invalid'];
            } else if (strlen($data['password']) < 7) {
                $data['passwordError'] = ['Password harus minimal 8 karakter.', 'is-invalid'];
            } else if (!preg_match($charValidation, $data['password'])) {
                $data['passwordError'] = ['Password harus terdiri dari huruf dan angka.', 'is-invalid'];
            }


            // Validasi konfirmasi password
            if (empty($data['repassword'])) {
                $data['repasswordError'] = ['Harap masukkan password.', 'is-invalid'];
            } else if ($data['password'] != $data['repassword']) {
                $data['repasswordError'] = ['Password tidak cocok, coba lagi.', 'is-invalid'];
            }

            if (empty($data['usernameError']) && empty($data['passwordError']) && empty($data['repasswordError'])) {
                // Hash password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                //  Buat akun
                $this->userModel->register($data);
                // Arahkan ke login
                header('location:' . filter_var(BASEURL . '/signup/success' , FILTER_VALIDATE_URL));
            }
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
}
